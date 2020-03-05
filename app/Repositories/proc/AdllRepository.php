<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\proc;

use Illuminate\Support\Facades\DB;

use Cache;
use App\Models\Sjd\Proc\Adl;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Route;
use App\Services\AutorizationService;

class AdllRepository extends BaseRepository
{
    protected $model;
    protected $service;
    protected $unidade;
    protected $verTodasUnidades;
    protected static $expiration = 60 * 24;//um dia; 

	public function __construct(
        Adl $model,
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
        Cache::tags('adl')->flush();
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
        $this->cleanCache();
        if($this->verTodasUnidades)
        { 
            
            $registros = Cache::tags('adl')->remember('todos_adl', self::$expiration, function() {
                return $this->model
                ->orderBy('adl.id_adl','DESC')
                ->get();
            });
        }
        else 
        {
            $registros = Cache::tags('adl')->remember('todos_adl:'.$this->unidade, self::$expiration, function()  {
                return $this->model->where('cdopm','like',$this->unidade.'%')
                ->orderBy('adl.id_adl','DESC')
                ->get();
            });
        }

        return $registros;
    } 

    public function ano($ano)
	{
        
        if($this->verTodasUnidades)
        {
            
            $registros = Cache::tags('adl')->remember('todos_adl:'.$ano, self::$expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano','=',$ano)
                ->orderBy('adl.id_adl','DESC')
                ->get();
            });
        }
        else 
        {
            $registros = Cache::tags('adl')->remember('todos_adl:'.$ano.':'.$this->unidade, self::$expiration, function() use ($ano) {
                return $this->model->where('cdopm','like',$this->unidade.'%')->where('sjd_ref_ano','=',$ano)
                ->orderBy('adl.id_adl','DESC')
                ->get();
            });
        }
        return $registros;
    } 

    public function andamento()
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('adl')->remember('andamento_adl', self::$expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_adl', '=', 'adl.id_adl')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', '')
                        ->orderBy('adl.id_adl','DESC');     
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::tags('adl')->remember('andamento_adl:'.$this->unidade, self::$expiration, function()  {
                return $this->model->where('cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_adl', '=', 'adl.id_adl')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', '')
                        ->orderBy('adl.id_adl','DESC');
                    })->get();
            });
        }
        return $registros;
    }
   
    public function andamentoAno($ano)
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('adl')->remember('andamento_adl:'.$ano, self::$expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_adl', '=', 'adl.id_adl')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', '')
                        ->orderBy('adl.id_adl','DESC'); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::tags('adl')->remember('andamento_adl:'.$ano.':'.$this->unidade, self::$expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_adl', '=', 'adl.id_adl')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', '')
                        ->orderBy('adl.id_adl','DESC'); 
                    })->get();
            });
        }
        return $registros;
    }

    public function julgamento()
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('adl')->remember('julgamento_adl', self::$expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_adl', '=', 'adl.id_adl')
                                ->where('envolvido.id_adl', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','adl'))
                    ->orderBy('adl.id_adl','DESC')
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::tags('adl')->remember('julgamento_adl:'.$this->unidade, self::$expiration, function()  {
                return $this->model
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_adl', '=', 'adl.id_adl')
                                ->where('envolvido.id_adl', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','adl'))
                    ->where('adl.cdopm','like',$this->unidade.'%')
                    ->orderBy('adl.id_adl','DESC')
                    ->get();
            });
        }
        return $registros;
    }

    public function julgamentoAno($ano)
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('adl')->remember('julgamento_adl:'.$ano, self::$expiration, function() use ($ano){
                return $this->model
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_adl', '=', 'adl.id_adl')
                                ->where('envolvido.id_adl', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','adl'))
                    ->where('sjd_ref_ano', '=' ,$ano)
                    ->orderBy('adl.id_adl','DESC')
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::tags('adl')->remember('julgamento_adl:'.$ano.':'.$this->unidade, self::$expiration, function() use ($ano) {
                return $this->model
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_adl', '=', 'adl.id_adl')
                                ->where('envolvido.id_adl', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','adl'))
                    ->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$this->unidade.'%')
                    ->orderBy('adl.id_adl','DESC')
                    ->get();
            });
        }
        return $registros;
    }

    public function prazos()
    {
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('adl')->remember('prazo_adl', self::$expiration, function() {
                
                return $this->model
                    ->selectRaw('adl.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_adl=adl.id_adl ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE sobrestamento.id_adl=adl.id_adl ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, DIASUTEIS(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (DIASUTEIS(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_adl, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_adl != '' GROUP BY id_adl ORDER BY sobrestamento.id_adl ASC LIMIT 1) b"),
                        'b.id_adl', '=', 'adl.id_adl')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_adl', '=', 'adl.id_adl')
                            ->where('envolvido.situacao', '=', 'Presidente')
                            ->where('envolvido.rg_substituto', '=', '')
                            ->orderBy('adl.id_adl','DESC');
                    })
                    ->get();
            });
                    
        }
        else 
        {
            $registros = Cache::tags('adl')->remember('prazo_adl:'.$this->unidade, self::$expiration, function() {
                return $this->model
                ->selectRaw('adl.*, 
                (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_adl=adl.id_adl ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_adl=adl.id_adl ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                envolvido.cargo, envolvido.nome, DIASUTEIS(abertura_data,DATE(NOW())) AS dutotal, 
                b.dusobrestado, (DIASUTEIS(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                ->leftJoin(
                    DB::raw("(SELECT id_adl, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                    WHERE termino_data != '0000-00-00' AND id_adl != '' GROUP BY id_adl ORDER BY sobrestamento.id_adl ASC LIMIT 1) b"),
                    'b.id_adl', '=', 'adl.id_adl')
                ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_adl', '=', 'adl.id_adl')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', '');
                })
                ->where('adl.cdopm','like',$this->unidade.'%')
                ->orderBy('adl.id_adl','DESC')
                ->get();

            });   
        }
        return $registros;
    }

    public function prazosAno($ano)
    {
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('adl')->remember('prazo_adl:'.$ano, self::$expiration, function() use ($ano){
                
                return $this->model
                    ->selectRaw('adl.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_adl=adl.id_adl ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_adl=adl.id_adl ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, DIASUTEIS(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (DIASUTEIS(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_adl, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_adl != '' GROUP BY id_adl ORDER BY sobrestamento.id_adl ASC LIMIT 1) b"),
                        'b.id_adl', '=', 'adl.id_adl')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_adl', '=', 'adl.id_adl')
                            ->where('envolvido.situacao', '=', 'Presidente')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('adl.sjd_ref_ano','=',$ano)
                    ->orderBy('adl.id_adl','DESC')
                    ->get();

            });             
        }
        else 
        {
            $registros = Cache::tags('adl')->remember('prazo_adl:'.$ano.':'.$this->unidade, self::$expiration, function() use ($ano){
                return $this->model
                    ->selectRaw('adl.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_adl=adl.id_adl ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_adl=adl.id_adl ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, DIASUTEIS(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (DIASUTEIS(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_adl, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_adl != '' GROUP BY id_adl ORDER BY sobrestamento.id_adl ASC LIMIT 1) b"),
                        'b.id_adl', '=', 'adl.id_adl')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_adl', '=', 'adl.id_adl')
                            ->where('envolvido.situacao', '=', 'Presidente')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('adl.sjd_ref_ano','=',$ano)
                    ->where('adl.cdopm','like',$this->unidade.'%')
                    ->orderBy('adl.id_adl','DESC')
                    ->get();

            });   
        }
        return $registros;
    }

}

