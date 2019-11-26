<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\proc;

use Cache;
use Illuminate\Support\Facades\DB;
use App\Repositories\OPM\OPMRepository;

class ProcRepository
{
    public function prioritario($proc)
    {
        return DB::table($proc)->where('prioridade',1)->get(); 
    }

    public function getById($proc, $id)
    {
        return DB::table($proc)->where('id_'.$proc,$id)->first(); 
    }

    public function getByRefAno($proc, $ref, $ano='')
    {
        // $a = [
        //     'proc' => $proc,
        //     'ref' => $ref,
        //     'ano' => $ano
        // ];
        // dd($a);
        if(!$ano) $proc = $this->getById($proc, $ref);
        else $proc = DB::table($proc)->where([['sjd_ref',$ref],['sjd_ref_ano',$ano]])->first();

        if($proc) return $proc;
        return false; 
    }

    public function procedimentos($rg)
    {
        $envolvido = DB::table('envolvido')
        ->select('envolvido.rg',
                'envolvido.rg_substituto',
                'envolvido.nome',
                'envolvido.situacao',
                'envolvido.resultado',
                'envolvido.id_ipm',
                'envolvido.id_cj',
                'envolvido.id_cd',
                'envolvido.id_adl',
                'envolvido.id_sindicancia',
                'envolvido.id_fatd',
                'envolvido.id_desercao',
                'envolvido.id_apfd',
                'envolvido.id_iso',
                'envolvido.id_it',
                'envolvido.id_pad',
                'envolvido.id_proc_outros')
                ->where('rg','=', $rg);

        $procedimentos = DB::table('ofendido')
                ->unionAll($envolvido)
                ->select(DB::raw('rg, rg as rg2,
                ofendido.nome,
                ofendido.situacao,
                ofendido.resultado,
                ofendido.id_ipm,
                ofendido.id_cj,
                ofendido.id_cd,
                ofendido.id_adl,
                ofendido.id_sindicancia,
                ofendido.id_fatd,
                ofendido.id_desercao,
                ofendido.id_apfd,
                ofendido.id_iso,
                ofendido.id_it,
                ofendido.id_pad,
                ofendido.id_proc_outros'))
                ->where('rg','=', $rg)
                ->get();


        return $procedimentos;
    }

    public function search($inicio, $fim, $opm)
    {
        $procedimentos = config('sistema.procedimentos');

        foreach ($procedimentos as $procedimento) {
            $registros[$procedimento] = $this->getResults($procedimento, $inicio, $fim, $opm);
        }

        return $registros; 
    }

    public function getResults($procedimento, $inicio, $fim, $opm) 
    {

        for ($i=$inicio; $i <= $fim ; $i++) { 
            if($opm) {
                $registros[$i] = Cache::tags('qtd_proc')->remember('qtd_proc:ano'.$i.':'.$opm, 360, function() use ($procedimento, $opm, $i){
                    return DB::table($procedimento)->where([['sjd_ref_ano',$i],['cdopm',$opm]])->count();
                });
            } else {
                $registros[$i] = Cache::tags('qtd_proc')->remember('qtd_proc:ano'.$i, 360, function() use ($procedimento, $i){
                    return DB::table($procedimento)->where('sjd_ref_ano',$i)->count();
                });
            }
        }

        return $registros;
    }



    public function searchPostoGrad($inicio, $fim, $opm, $procedimento)
    {
        $postos = [
            'CELAGREG',
            'CEL',
            'TENCEL',
            'MAJ',
            'CAP',
            '1TEN',
            '2TEN',
            'ASPOF',
            'ALUNO',
            'ALUNO3A',
            'ALUNO2A',
            'ALUNO1A',
            'SUBTEN',
            '1SGT',
            '2SGT',
            '3SGT',
            'CABO',
            'SD1C',
            'SD2C'
        ];

        foreach ($postos as $posto) {
            $registros[$posto] = $this->getResultsPostoGrad($procedimento, $inicio, $fim, $opm, $posto);
        }

        return $registros; 
    }

    public function getResultsPostoGrad($procedimento, $inicio, $fim, $opm, $posto) 
    {
        $situacao = sistema('procSituacao',$procedimento);
        for ($i=$inicio; $i <= $fim ; $i++) { 
            if($opm) {
                $registros[$i] = Cache::tags('qtd_env_posto')->remember('qtd_env_posto:'.$i.':'.$posto.':'.$procedimento.'.$opm.'.$opm, 360, function() use ($procedimento, $opm, $i, $situacao, $posto){
                    return DB::table($procedimento)
                    ->join('envolvido', $procedimento.'.id_'.$procedimento, '=', 'envolvido.id_'.$procedimento)
                    ->where([
                        ['sjd_ref_ano',$i],
                        ['situacao',$situacao],
                        ['cargo',$posto],
                        ['cdopm',$opm]
                    ])->count();
                });
            } else {
                $registros[$i] = Cache::tags('qtd_env_posto')->remember('qtd_env_posto:'.$i.':'.$posto.':'.$procedimento, 360, function() use ($procedimento, $i, $situacao, $posto){
                    return DB::table($procedimento)
                    ->join('envolvido', $procedimento.'.id_'.$procedimento, '=', 'envolvido.id_'.$procedimento)
                    ->where([
                        ['sjd_ref_ano',$i],
                        ['situacao',$situacao],
                        ['cargo',$posto]
                    ])->count();
                });
            }
        }

        return $registros;
    }

    public function changeAndamento(Array $dados, $type)
    {
        $proc = $dados['procc'];
        $id = $dados['id_'.$proc];

        $search = array_search(strtoupper($type),config('sistema.andamento'.strtoupper($proc)),true);
        $andamento = DB::table($proc)->where('id_'.$proc,$id)->update(['id_andamento' => $search]);
        if($andamento) return true;
        return false;
    }

    public function dados($proc, $ref, $ano)
    {
        if(is_numeric($proc)) $proc = sistema('pocedimentosOpcoes',$proc);
        
        // validações
        if(!in_array($proc,config('sistema.pocedimentosOpcoes'))) return $this->formatReturn(null, null, 'Procedimento inválido');
        if($ano < 2008 || $ano > date('Y')) return $this->formatReturn(null, null, 'Ano inválido');
        if ($proc=="apfdc" || $proc=="apfdm") $proc="apfd";  

        $result = $this->getByRefAno($proc, $ref, $ano);

        if(!$result) return $this->formatReturn(null, null, 'Referência inválida');

        $opm = OPMRepository::abreviatura(completa_zeros($result['cdopm']));

        if(!$opm) return $this->formatReturn(null, null, 'OPM não encontrada');  

        return $this->formatReturn($result, $proc, $opm);
    }

    public function formatReturn($result, $proc, $opm)
    {
        if($result) $id = $result['id_'.$proc];
        $situacao = ($proc) ? sistema('procSituacao',$proc) : null;

        if($result && $situacao) {
            return [
                'proc' => $result,
                'id' => $id,
                'situacao' => $situacao,
                'opm' => $opm,
                'success' => true,
            ];
        }

        return [
            'opm' => $opm,
            'success' => false
        ];
    }

    public function updateCampo($proc, $id, $campo, $input)
    {
        $update = DB::table($proc)
            ->where('id_'.$proc,$id)
            ->update([$campo => $input]);

        if(!$update) return ['success' => false,];
        return ['success' => true,];
    }

    public function dadocampo($proc, $id, $campo)
    {
        $index = DB::table($proc)->where('id_'.$proc,$id)->first();

        if(!$index)
        {
            return [
                'input' => '',
                'success' => false,
            ];
        }

        return [
            'input' => $index[$campo],
            'success' => true,
        ];
    }

    public function andamento($proc)
    {
        if($proc == 'adl') $andamento = '17';
        if($proc == 'cd') $andamento = '11';
        if($proc == 'cj') $andamento = '14';
        if($proc == 'fatd') $andamento = '3';
        if($proc == 'it') $andamento = '23';
        if($proc == 'sindicancia') $andamento = '8';

        return $andamento;
    }

    public function relatorioAbuso()
    {
        $registros = $this->searchRelatorio('assédio','assedio','abuso sexual');
        return $registros;
    }

    public function relatorioViolenciaDomestica()
    {
        $registros = $this->searchRelatorio('violencia domestica','violência doméstica','Lei nº 11.340/2006');
        return $registros;
    }

    public function searchRelatorio($termo1, $termo2, $termo3='', $termo4='', $termo5='')
    {
        $procedimentos = ["ipm","sindicancia","cd","cj","apfd","fatd","iso","it","adl","pad","sai"];
        $registros = collect();
        foreach ($procedimentos as $procedimento) {
            $query = DB::table($procedimento)
            ->join('envolvido', function ($join) use($procedimento){
                $join->on($procedimento.'.id_'.$procedimento, '=', 'envolvido.id_'.$procedimento)
                ->whereNotIn('envolvido.situacao', ['Acusador', 'Encarregado','Escrivão','Membro','Presidente'])
                ->where('envolvido.rg','<>','');
            })
            ->orWhere('sintese_txt','like','%'.$termo1.'%')
            ->orWhere('sintese_txt','like','%'.$termo2.'%');
            if($termo3) $query->orWhere('sintese_txt','like','%'.$termo3.'%');
            if($termo4) $query->orWhere('sintese_txt','like','%'.$termo4.'%');
            if($termo5) $query->orWhere('sintese_txt','like','%'.$termo5.'%');
            $search = $query->get();
            if($search) $registros[$procedimento] = $search;
            
        }
        return $registros;
    }

}

