<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\proc;

use Illuminate\Support\Facades\DB;

use Cache;
use App\Models\Sjd\Proc\Desercao;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Route;
use App\Services\AutorizationService;

class DesercaoRepository extends BaseRepository
{
    protected $model;
    protected $service;
    protected $unidade;
    protected $verTodasUnidades;
    protected static $expiration = 60 * 24;//um dia 

	public function __construct(
        Desercao $model,
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

    public function cleanCache()
	{
        Cache::tags('desercao')->flush();
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
            $registros = Cache::tags('desercao')->remember('todos_desercao', self::$expiration, function() {
                return $this->model->join('envolvido', 'desercao.id_desercao', '=', 'envolvido.id_desercao')->get();
            });
        }
        else 
        {
            $registros = Cache::tags('desercao')->remember('todos_desercao:'.$this->unidade, self::$expiration, function()  {
                return $this->model->where('cdopm','like',$this->unidade.'%')->join('envolvido', 'desercao.id_desercao', '=', 'envolvido.id_desercao')->get();
            });
        }

        return $registros;
    } 

    public function ano($ano)
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('desercao')->remember('todos_desercao:'.$ano, self::$expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano','=',$ano)
                ->join('envolvido', 'desercao.id_desercao', '=', 'envolvido.id_desercao')->get();
            });
        }
        else 
        {
            $registros = Cache::tags('desercao')->remember('todos_desercao:'.$ano.':'.$this->unidade, self::$expiration, function() use ($ano) {
                return $this->model->where('cdopm','like',$this->unidade.'%')->where('sjd_ref_ano','=',$ano)
                ->join('envolvido', 'desercao.id_desercao', '=', 'envolvido.id_desercao')->get();
            });
        }
        return $registros;
    } 

    public function andamento()
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('desercao')->remember('andamento_desercao', self::$expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_desercao', '=', 'desercao.id_desercao')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::tags('desercao')->remember('andamento_desercao:'.$this->unidade, self::$expiration, function()  {
                return $this->model->where('cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_desercao', '=', 'desercao.id_desercao')
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
            $registros = Cache::tags('desercao')->remember('andamento_desercao:'.$ano, self::$expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_desercao', '=', 'desercao.id_desercao')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::tags('desercao')->remember('andamento_desercao:'.$ano.':'.$this->unidade, self::$expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_desercao', '=', 'desercao.id_desercao')
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
            $registros = Cache::tags('desercao')->remember('julgamento_desercao', self::$expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_desercao', '=', 'desercao.id_desercao')
                                ->where('envolvido.id_desercao', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','desercao'))
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::tags('desercao')->remember('julgamento_desercao:'.$this->unidade, self::$expiration, function()  {
                return $this->model->where('cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_desercao', '=', 'desercao.id_desercao')
                                ->where('envolvido.id_desercao', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','desercao'))
                    ->get();
            });
        }
        return $registros;
    }

    public function julgamentoAno($ano)
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('desercao')->remember('julgamento_desercao:'.$ano, self::$expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_desercao', '=', 'desercao.id_desercao')
                                ->where('envolvido.id_desercao', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','desercao'))
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::tags('desercao')->remember('julgamento_desercao:'.$ano.':'.$this->unidade, self::$expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_desercao', '=', 'desercao.id_desercao')
                                ->where('envolvido.id_desercao', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','desercao'))
                    ->get();
            });
        }
        return $registros;
    }

    public function prazos()
    {
        if($this->verTodasUnidades)
        {

            $registros = Cache::tags('desercao')->remember('prazo_desercao', self::$expiration, function() {
                return $this->model
                    ->selectRaw('desercao.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_desercao=desercao.id_desercao ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_desercao=desercao.id_desercao ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_desercao, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_desercao != '' GROUP BY id_desercao ORDER BY sobrestamento.id_desercao ASC LIMIT 1) b"),
                        'b.id_desercao', '=', 'desercao.id_desercao')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_desercao', '=', 'desercao.id_desercao')
                            ->where('envolvido.situacao', '=', 'Presidente')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->get();   
                });           
        }
        else 
        {
            $registros = Cache::tags('desercao')->remember('prazo_desercao:'.$this->unidade, self::$expiration, function() {
                return $this->model
                ->selectRaw('desercao.*, 
                (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_desercao=desercao.id_desercao ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_desercao=desercao.id_desercao ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                ->leftJoin(
                    DB::raw("(SELECT id_desercao, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                    WHERE termino_data != '0000-00-00' AND id_desercao != '' GROUP BY id_desercao ORDER BY sobrestamento.id_desercao ASC LIMIT 1) b"),
                    'b.id_desercao', '=', 'desercao.id_desercao')
                ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_desercao', '=', 'desercao.id_desercao')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', '');
                })
                ->where('adl.cdopm','like',$this->unidade.'%')
                ->get();

            });   
        }
        return $registros;
    }

    public function prazosAno($ano)
    {
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('desercao')->remember('prazo_desercao:'.$ano, self::$expiration, function() use ($ano){
                return $this->model
                    ->selectRaw('desercao.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_desercao=desercao.id_desercao ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_desercao=desercao.id_desercao ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_desercao, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_desercao != '' GROUP BY id_desercao ORDER BY sobrestamento.id_desercao ASC LIMIT 1) b"),
                        'b.id_desercao', '=', 'desercao.id_desercao')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_desercao', '=', 'desercao.id_desercao')
                            ->where('envolvido.situacao', '=', 'Presidente')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('adl.sjd_ref_ano','=',$ano)
                    ->get();
                });         
        }
        else 
        {
            $registros = Cache::tags('desercao')->remember('prazo_desercao:'.$ano.':'.$this->unidade, self::$expiration, function() use ($ano){
                return $this->model
                    ->selectRaw('desercao.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_desercao=desercao.id_desercao ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_desercao=desercao.id_desercao ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_desercao, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_desercao != '' GROUP BY id_desercao ORDER BY sobrestamento.id_desercao ASC LIMIT 1) b"),
                        'b.id_desercao', '=', 'desercao.id_desercao')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_desercao', '=', 'desercao.id_desercao')
                            ->where('envolvido.situacao', '=', 'Presidente')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('adl.sjd_ref_ano','=',$ano)
                    ->where('adl.cdopm','like',$this->unidade.'%')
                    ->get(); 

            });   
        }
        return $registros;
    }

}

