<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\proc;

use Cache;
use Illuminate\Support\Facades\DB;

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

    public function getByRefAno($proc, $ref, $ano)
    {
        return DB::table($proc)->where([['sjd_ref',$ref],['sjd_ref_ano',$ano]])->first(); 
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

}

