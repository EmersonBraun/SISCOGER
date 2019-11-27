<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\proc;

use Illuminate\Support\Facades\DB;

use Cache;
use App\Models\Sjd\Proc\Sindicancia;
use App\Repositories\BaseRepository;
use App\Services\AutorizationService;

class SindicanciaRepository extends BaseRepository
{
    protected $model;
    protected $service;
    protected $unidade;
    protected $verTodasUnidades;
    protected $expiration = 60 * 24;//um dia 

	public function __construct(
        Sindicancia $model,
        AutorizationService $service
    )
	{
		$this->model = $model;
        $this->service = $service;

        $isapi = $this->service->isApi();
        $verTodasUnidades = $this->service->verTodasOPM();

        $this->verTodasUnidades = ($verTodasUnidades || $isapi) ? 1 : 0;
        $this->unidade = ($isapi) ? '0' : session('cdopmbase');
    }

    public function clearCache()
	{
        Cache::tags('sindicancia')->flush();
    }

    public function procRefAno($ref, $ano = '', $name)
    {
        if(!$ano) $proc = $this->model->findOrFail($ref);
        else $proc = $this->model->where([['sjd_ref',$ref],['sjd_ref_ano',$ano]])->first();

        if(!$proc) abort(404);
        $canSee = $this->service->canSee($proc, $name);
        if(!$canSee) abort(403);
        return $proc;
    }
    
    public function all()
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('sindicancia')->remember('todos_sindicancia', $this->expiration, function() {
                return $this->model->all();
            });
        }
        else 
        {
            $registros = Cache::tags('sindicancia')->remember('todos_sindicancia'.$this->unidade, $this->expiration, function()  {
                return $this->model->where('cdopm','like',$this->unidade.'%')->get();
            });
        }

        return $registros;
    } 

    public function ano($ano)
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('sindicancia')->remember('todos_sindicancia'.$ano, $this->expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano','=',$ano)->get();
            });
        }
        else 
        {
            $registros = Cache::tags('sindicancia')->remember('todos_sindicancia'.$ano.$this->unidade, $this->expiration, function() use ($ano) {
                return $this->model->where('cdopm','like',$this->unidade.'%')->where('sjd_ref_ano','=',$ano)->get();
            });
        }
        return $registros;
    } 

    public function andamento()
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('sindicancia')->remember('andamento_sindicancia', $this->expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_sindicancia', '=', 'sindicancia.id_sindicancia')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::tags('sindicancia')->remember('andamento_sindicancia'.$this->unidade, $this->expiration, function()  {
                return $this->model->where('cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_sindicancia', '=', 'sindicancia.id_sindicancia')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        return $registros;
    }

    public function andamentoAno($ano)
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('sindicancia')->remember('andamento_sindicancia'.$ano, $this->expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_sindicancia', '=', 'sindicancia.id_sindicancia')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::tags('sindicancia')->remember('andamento_sindicancia'.$ano.$this->unidade, $this->expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_sindicancia', '=', 'sindicancia.id_sindicancia')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        return $registros;
    }

    public function julgamento()
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('sindicancia')->remember('julgamento_sindicancia', $this->expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_sindicancia', '=', 'sindicancia.id_sindicancia')
                                ->where('envolvido.id_sindicancia', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','sindicancia'))
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::tags('sindicancia')->remember('julgamento_sindicancia'.$this->unidade, $this->expiration, function()  {
                return $this->model->where('cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_sindicancia', '=', 'sindicancia.id_sindicancia')
                                ->where('envolvido.id_sindicancia', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','sindicancia'))
                    ->get();
            });
        }
        return $registros;
    }

    public function julgamentoAno($ano)
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('sindicancia')->remember('julgamento_sindicancia'.$ano, $this->expiration, function() use ($ano){
                return $this->model
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_sindicancia', '=', 'sindicancia.id_sindicancia')
                                ->where('envolvido.id_sindicancia', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','sindicancia'))
                    ->where('sindicancia.sjd_ref_ano', '=' ,$ano)
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::tags('sindicancia')->remember('julgamento_sindicancia'.$ano.$this->unidade, $this->expiration, function() use ($ano) {
                return $this->model
                    ->where('cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_sindicancia', '=', 'sindicancia.id_sindicancia')
                                ->where('envolvido.id_sindicancia', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','sindicancia'))
                    ->where('sindicancia.sjd_ref_ano', '=' ,$ano)
                    ->get();
            });
        }
        return $registros;
    }

    public function prazos()
    {
        if($this->verTodasUnidades)
        {

            $registros = Cache::tags('sindicancia')->remember('prazo_sindicancia', $this->expiration, function() {
                return $this->model
                    ->selectRaw('sindicancia.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_sindicancia=sindicancia.id_sindicancia ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_sindicancia=sindicancia.id_sindicancia ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, DIASUTEIS(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (DIASUTEIS(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_sindicancia, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data !='0000-00-00' AND id_sindicancia!='' GROUP BY id_sindicancia ORDER BY id_sindicancia ASC LIMIT 1) b"),
                        'b.id_sindicancia', '=', 'sindicancia.id_sindicancia')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_sindicancia', '=', 'sindicancia.id_sindicancia')
                            ->where('envolvido.situacao', '=', 'Presidente')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->get();
            });                    
        }
        else 
        {
            $registros = Cache::tags('sindicancia')->remember('prazo_sindicancia'.$this->unidade, $this->expiration, function() {
                return $this->model
                ->selectRaw('sindicancia.*, 
                (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_sindicancia=sindicancia.id_sindicancia ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_sindicancia=sindicancia.id_sindicancia ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                envolvido.cargo, envolvido.nome, DIASUTEIS(abertura_data,DATE(NOW())) AS dutotal, 
                b.dusobrestado, (DIASUTEIS(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                ->leftJoin(
                    DB::raw("(SELECT id_sindicancia, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                    WHERE termino_data !='0000-00-00' AND id_sindicancia!='' GROUP BY id_sindicancia ORDER BY id_sindicancia ASC LIMIT 1) b"),
                    'b.id_sindicancia', '=', 'sindicancia.id_sindicancia')
                ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_sindicancia', '=', 'sindicancia.id_sindicancia')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', '');
                })
                ->where('sindicancia.cdopm','like',$this->unidade.'%')
                ->get();

            });   
        }
        return $registros;
    }

    public function prazosAno($ano)
    {
        if($this->verTodasUnidades)
        {

            $registros = Cache::tags('sindicancia')->remember('prazo_sindicancia:'.$ano, $this->expiration, function() use ($ano) {
                return $this->model
                    ->selectRaw('sindicancia.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_sindicancia=sindicancia.id_sindicancia ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_sindicancia=sindicancia.id_sindicancia ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, DIASUTEIS(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (DIASUTEIS(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_sindicancia, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data !='0000-00-00' AND id_sindicancia!='' GROUP BY id_sindicancia ORDER BY id_sindicancia ASC LIMIT 1) b"),
                        'b.id_sindicancia', '=', 'sindicancia.id_sindicancia')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_sindicancia', '=', 'sindicancia.id_sindicancia')
                            ->where('envolvido.situacao', '=', 'Presidente')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('sindicancia.sjd_ref_ano','=',$ano)
                    ->get(); 
                });
                    
        }
        else 
        {
            $registros = Cache::tags('sindicancia')->remember('prazo_sindicancia:'.$this->unidade.':'.$ano, $this->expiration, function() use ($ano){
                return $this->model
                    ->selectRaw('sindicancia.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_sindicancia=sindicancia.id_sindicancia ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_sindicancia=sindicancia.id_sindicancia ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, DIASUTEIS(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (DIASUTEIS(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_sindicancia, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data !='0000-00-00' AND id_sindicancia!='' GROUP BY id_sindicancia ORDER BY id_sindicancia ASC LIMIT 1) b"),
                        'b.id_sindicancia', '=', 'sindicancia.id_sindicancia')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_sindicancia', '=', 'sindicancia.id_sindicancia')
                            ->where('envolvido.situacao', '=', 'Presidente')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('sindicancia.cdopm','like',$this->unidade.'%')
                    ->where('sindicancia.sjd_ref_ano','=',$ano)
                    ->get(); 

            });   
        }
        return $registros;
    }

    public function foraDoPrazo($unidade)
     {
        $unidade = !$unidade ? $this->unidade : $unidade;
         $sindicancia_prazos = Cache::remember('sindicancia_prazos'.$unidade, 60, function() use($unidade){
         
         return DB::connection('sjd')
         ->select('SELECT * FROM (
             SELECT sindicancia.id_sindicancia, andamento, envolvido.cargo, 
             envolvido.nome, cdopm, sjd_ref, sjd_ref_ano, abertura_data, 
             DIASUTEIS(abertura_data,DATE(NOW())) AS dutotal,
             b.dusobrestado,
             (DIASUTEIS(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis 
             FROM sindicancia
             LEFT JOIN
             (SELECT id_sindicancia, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado 
             FROM sobrestamento
             WHERE termino_data != :termino_data AND id_sindicancia!=:id_sindicancia
             GROUP BY id_sindicancia) b
             ON b.id_sindicancia = sindicancia.id_sindicancia
             LEFT JOIN envolvido ON
             envolvido.id_sindicancia=sindicancia.id_sindicancia 
             AND envolvido.situacao=:situacao AND rg_substituto=:rg_substituto
             LEFT JOIN andamento ON
             andamento.id_andamento=sindicancia.id_andamento
             WHERE sindicancia.id_andamento=:id_andamento
             ) dt
             WHERE cdopm LIKE :opm AND dt.diasuteis > :diasuteis',
             [
                 'termino_data' => '0000-00-00',
                 'id_sindicancia' => '',
                 'situacao' => 'Encarregado',
                 'rg_substituto' => '',
                 'id_andamento' => '6',
                 'opm' => $unidade.'%',
                 'diasuteis' => '30'
             ]);
 
         });
 
         return $sindicancia_prazos;
     }
         
    public function aberturas($unidade='')
     {
        $unidade = !$unidade ? $this->unidade : $unidade;
         $sindicancia_aberturas = Cache::remember('sindicancias_aberturas'.$unidade, 60, function() use($unidade){
         
             return DB::table('sindicancia')
             ->where('cdopm', 'LIKE', $unidade.'%') 
             ->where('abertura_data','=','0000-00-00')
             ->get();
 
         });
 
         return $sindicancia_aberturas;
     }
    public function QtdOMAnos($unidade='', $ano='')
    {
        $unidade = !$unidade ? $this->unidade : $unidade;
        //inicializar a variável
        $sindicancia_ano = [];
        if($ano != '')
        {
            $sindicancia_ano = DB::connection('sjd')
            ->table('sindicancia')
            ->select(DB::raw('count(sjd_ref) AS qtd'))
            ->where('sjd_ref_ano','=',$ano)
            ->where('cdopm','like',$unidade.'%')
            ->groupBy('sjd_ref_ano')
            ->first();
        }
        else
        {
            for($i = 2008; $i <= date('Y'); $i++)
            {
                //Quantidade de sindicancia por ano
                $qtd_sindicancia_ano = DB::connection('sjd')
                ->table('sindicancia')
                ->select(DB::raw('count(sjd_ref) AS qtd'))
                ->where('sjd_ref_ano','=',$i)
                ->where('cdopm','like',$unidade.'%')
                ->groupBy('sjd_ref_ano')
                ->first();
                //insere no array para ficar 'ano' => 'qtd'
                $sindicancia_ano = array_add($sindicancia_ano,$i, $qtd_sindicancia_ano['qtd']);
            }
        }
        
        return $sindicancia_ano;
    }


}

