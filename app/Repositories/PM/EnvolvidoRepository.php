<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\PM;

use Cache;
use App\Models\Sjd\Policiais\Envolvido;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class EnvolvidoRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected $expiration = 60 * 24;//um dia; 

	public function __construct(Envolvido $model)
	{
        $this->model = $model;      
    }

    public function cleanCache()
	{
        Cache::tags('envolvido')->flush();
    }
    
    public function all()
	{
        $registros = Cache::tags('envolvido')->remember('todos_envolvido', $this->expiration, function() {
            return $this->model->all();
        });
        return $registros;
    } 

    public function getByNameId($name, $id)
	{
        $registros = Cache::tags('envolvido')->remember('envolvido:nameid'.$name.$id, $this->expiration, function() use ($name, $id){
            return $this->model->where('id_'.$name,$id)->get();
        });
        return $registros;
    }

    public function relatorioEncarregados($proc, $opm, $ano)
	{
        $registros = $this->model
        ->select(DB::raw("COUNT(*) AS quantidade, CONCAT(envolvido.cargo, ' ',envolvido.nome) AS grupo, ".$proc.".cdopm"))
        ->join($proc,$proc.'.id_'.$proc,'envolvido.id_'.$proc)
        ->where([
            ['situacao','like','%Encarregado%'],
            ['envolvido.id_'.$proc,'<>','0'],
            ['cdopm','like',$opm.'%'],
            ['sjd_ref_ano','like',$ano.'%'],
        ])
        ->groupBy('nome')
        ->orderBy('quantidade','DESC')
        ->get();

        return $registros;
    }

    public function maxPosto($proc, $id)
    {
        $registro = $this->model
        ->join('posto','posto.posto','envolvido.cargo')
        ->where('envolvido.id_'.$proc, $id)
        ->whereNotIn('situacao', ['Acusador', 'Encarregado','Escrivão','Membro','Presidente'])
        ->orderBy('id_posto')
        ->first();

        return $registro;
    }

    public function resultSearch($query, $proc)
	{
        $adc = ['envolvido.id_'.$proc,'<>','0'];
        array_push($query,$adc);

        $registros = $this->model
            ->join($proc,$proc.'.id_'.$proc,'envolvido.id_'.$proc)
            ->where($query)
            ->orderBy('id_envolvido','DESC')
            ->get();

        return $registros;
    }

    public function buscaNominal($nome)
    {
        $registros = $this->model
            ->select(DB::raw("envolvido.*, 
            CASE
                WHEN id_ipm THEN 'ipm'
                WHEN id_sindicancia THEN 'sindicancia'
                WHEN id_cj THEN 'cj'
                WHEN id_cd THEN 'cd'
                WHEN id_it THEN 'it'
                WHEN id_adl THEN 'adl'
                WHEN id_apfd THEN 'apfd'
                WHEN id_fatd THEN 'fatd'
                WHEN id_iso THEN 'iso'
                WHEN id_desercao THEN 'desercao'
            END AS proc
                    "))
            ->where('nome','like','%'.$nome.'%')
            ->orderBy('id_envolvido','DESC')
            ->get();

        return $registros;
    }

    public function membro()
	{
        $registros = Cache::tags('envolvido')->remember('envolvido:membro', $this->expiration, function() {
            return $this->model->where('situacao','')->get();
        });
        return $registros;
    } 

    public function list($proc, $id, $situacao="")
	{
        // $registros = Cache::tags('envolvido')->remember('envolvido:membro', $this->expiration, function() use($proc, $id, $situacao){
            return $this->model->where('id_'.$proc,'=',$id)->where('situacao','=',$situacao)->get();
        // });
        // return $registros;
    } 

    public function membrosUsados($proc, $id)
    {
        // membros envolvidos
        $result = $this->atual($proc, $id);
        $subs = $this->substituidos($proc, $id);
        
        if(!$result) return response()->json(null, 400);
        // situações usadas
        $usados = [];
        foreach ($result as $r) 
        {
            if(!$r['rg_substituto']) 
            {
                array_push($usados,$r['situacao']);
            }
        }
    }

    public function membroAtual($proc, $id)
    {
        return $this->model->where('id_'.$proc,'=',$id)
                    ->whereIn('situacao', ['Acusador', 'Encarregado','Escrivão','Membro','Presidente'])
                    ->where('rg_substituto','')
                    ->get();
    }

    public function membroSubstituido($proc, $id)
    {
        return $this->model->where('id_'.$proc,'=',$id)
                    ->whereIn('situacao', ['Acusador', 'Encarregado','Escrivão','Membro','Presidente'])
                    ->where('rg_substituto','<>','')
                    ->get();
    }

    public function situacoesUsadas($situacoes)
    {
        $usados = [];
        foreach ($situacoes as $s) 
        {
            if(!$s['rg_substituto']) 
            {
                array_push($usados,$s['situacao']);
            }
        }
        return $usados;
    }

    public function situacao($situacao)
	{
        
        $registros = Cache::tags('envolvido')->remember('envolvido:'.$situacao, $this->expiration, function() use($situacao) {
            return $this->model->where([
                ['rg_substituto',''],
                ['rg','<>',''],
                ['nome','<>',''],
                ['situacao', ucwords($situacao)]]
            )->get();
        });
		return $registros;
	}

    public function estaSubjudice($rg)
    {
        $registros = Cache::tags('envolvido')->remember('envolvido:subjudice:rg'.$rg, $this->expiration, function() use($rg){
            return DB::table('envolvido')
                    ->join('ipm','ipm.id_ipm','=','envolvido.id_ipm')
                    ->join('apfd','apfd.id_apfd','=','envolvido.id_apfd')
                    ->join('desercao','desercao.id_desercao','=','envolvido.id_desercao')
                    ->where('ipm_processocrime','=', 'Denunciado')
                    ->where('rg','=', $rg)
                    ->get();
        });

        $registros = (is_null($registros) || !count($registros)) ? false : (object) $registros;
        return $registros;
        
    }

    public function subJudice()
    {
        $registros = Cache::tags('envolvido')->remember('envolvido:subjudice', $this->expiration, function() {
            return DB::table('envolvido')
                    ->join('ipm','ipm.id_ipm','=','envolvido.id_ipm')
                    ->join('apfd','apfd.id_apfd','=','envolvido.id_apfd')
                    ->join('desercao','desercao.id_desercao','=','envolvido.id_desercao')
                    ->where('ipm_processocrime','=', 'Denunciado')
                    ->get();
        });

        if(!count($registros)) return [];
        return $registros;
    }

    public function sai($rg)
    {
        $registros = Cache::tags('envolvido')->remember('envolvido:sai:rg'.$rg, $this->expiration, function() use ($rg){
            return DB::table('envolvido')
                    ->leftJoin('sai', 'sai.id_sai', '=', 'envolvido.id_sai')
                    ->leftJoin('ligacao', 'ligacao.id_sai', '=', 'envolvido.id_sai')
                    ->where('envolvido.rg','=', $rg)
                    ->where('envolvido.id_sai','<>', 0)
                    ->get();
        });

        return $registros;
    }

    public function objetos($rg)
    {
        $situacao = ['Acusado', 'Indiciado', 'Sindicado','Paciente'];
        $envolvido = $this->envolvidos($rg, $situacao);
                
        $objetos = array();
        if(count($envolvido) > 0){
        $i=0;
            foreach ($envolvido as $e) {
                $procedimento = $this->procedimento($e);
                $proc = $this->envolvido($procedimento, $e);
                //correções de possíveis erros
                $subs = ($e['rg_substituto']) ? $e['rg_substituto'] : null;
                
                $objetos[$i] =  [
                    'rg_sustituto' =>  $subs,
                    'nome' => $e['nome'],
                    'rg' => $e['rg'],
                    'situacao' => $e['situacao'],
                    'resultado' => $e['resultado'],
                    'procedimento' => $procedimento,
                    'sjd_ref' => $proc['sjd_ref'],
                    'sjd_ref_ano' => $proc['sjd_ref_ano'],
                    'sintese_txt' => $proc['sintese_txt'],
                    'id_andamento' => $proc['id_andamento'],
                    'id_andamentocoger' => $proc['id_andamentocoger'],
                    'cdopm' => $proc['cdopm']
                ];
                $i++;     
            }
            return $objetos;
        }
        return $objetos;
    
    }

    public function membros($rg)
    {
        $situacao = ['Encarregado', 'Presidente', 'Acusador'];
        $envolvido = $this->envolvidos($rg, $situacao);
        $membros = array();
        if(count($envolvido) > 0){
        $i=0;
            foreach ($envolvido as $e) {
                $procedimento = $this->procedimento($e);
                $proc = $this->envolvido($procedimento, $e);
                //correções de possíveis erros
                $subs = ($e['rg_substituto']) ? $e['rg_substituto'] : null;
    
                $membros[$i] =  [
                    'rg_sustituto' =>  $subs,
                    'nome' => $e['nome'],
                    'rg' => $e['rg'],
                    'situacao' => $e['situacao'],
                    'resultado' => $e['resultado'],
                    'procedimento' => $procedimento,
                    'sjd_ref' => $proc['sjd_ref'],
                    'sjd_ref_ano' => $proc['sjd_ref_ano'],
                    'sintese_txt' => $proc['sintese_txt'],
                    'id_andamento' => $proc['id_andamento'],
                    'id_andamentocoger' => $proc['id_andamentocoger'],
                    'cdopm' => $proc['cdopm']
                ];
                $i++;

                
            }
            return $membros;
        }
        return $membros;
    }

    public function envolvidos($rg, $situacao)
    {
        return DB::table('envolvido')
                ->whereIn('situacao', $situacao)
                ->where('rg','=', $rg)
                ->get();
    }

    public function envolvido($procedimento, $e)
    {
        if($procedimento == 'Apagado') {
            return [
                'sjd_ref' => 'Apagado',
                'sjd_ref_ano' => 'Apagado',
                'sintese_txt' => 'Apagado',
                'id_andamento' => 'Apagado',
                'id_andamentocoger' => 'Apagado',
                'cdopm' => 'Apagado',
            ];
        }

        $proc = DB::table($procedimento)->where('id_'.$procedimento,'=', $e['id_'.$procedimento])->first();
        $proc = $this->procedimentoFormatadoParaRetorno($proc);
        return $proc;
    }

    public function procedimento($e)
    {
        if ($e['id_ipm'] !== 0) return 'ipm';
        elseif ($e['id_cj'] !== 0) return 'cj';
        elseif ($e['id_cd'] !== 0) return 'cd';
        elseif ($e['id_adl'] !== 0) return 'adl';
        elseif ($e['id_sindicancia'] !== 0) return 'sindicancia';
        elseif ($e['id_fatd'] !== 0) return 'fatd';
        elseif ($e['id_desercao'] !== 0) return 'desercao';
        elseif ($e['id_apfd'] !== 0) return 'apfd';
        elseif ($e['id_iso'] !== 0) return 'iso';
        elseif ($e['id_it'] !== 0) return 'it';
        elseif ($e['id_pad'] !== 0) return 'pad';
        elseif ($e['id_sai'] !== 0) return 'sai';
        elseif ($e['id_proc_outros'] !== 0) return 'proc_outros';
        else return 'Apagado';
    }

    public function procedimentoFormatadoParaRetorno($proc)
    {
        if(isset($proc['id_andamento'])) $proc['id_andamento'] = ($proc['id_andamento'] == 'Apagado') ? 'Apagado' : sistema('andamento',$proc['id_andamento']);
        if(isset($proc['id_andamentocoger'])) $proc['id_andamentocoger'] = ($proc['id_andamentocoger'] == 'Apagado') ? 'Apagado' : sistema('andamentocoger',$proc['id_andamentocoger']);
        if(isset($proc['cdopm'])) $proc['cdopm'] = ($proc['cdopm'] == 'Apagado') ? 'Apagado' : opm($proc['cdopm']);

        return $proc;
    }

    public function procOutros($rg)
    {
        $outros =  DB::table('proc_outros')
        ->leftJoin('envolvido', 'envolvido.id_proc_outros', '=', 'proc_outros.id_proc_outros')
        ->leftJoin('ligacao', 'ligacao.id_proc_outros', '=', 'envolvido.id_proc_outros')
        ->where('rg','=', $rg)
        ->where('envolvido.id_proc_outros','<>', 0)
        ->get();

        return $outros;
    }
}
