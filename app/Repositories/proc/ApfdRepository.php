<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\proc\Repositories;

use Illuminate\Support\Facades\DB;

use Cache;
use App\Models\Sjd\Proc\Apfd;
use App\Repositories\BaseRepository;
use App\Services\AutorizationService;

class ApfdRepository extends BaseRepository
{
    protected $model;
    protected $service;
    protected $unidade;
    protected $verTodasUnidades;
    protected static $expiration = 60 * 24;//um dia 

	public function __construct(
        Apfd $model,
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
        Cache::tags('apfd')->flush();
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
            $registros = Cache::tags('apfd')->remember('todos_apfd', self::$expiration, function() {
                return $this->model->all();
            });
        }
        else 
        {
            $registros = Cache::tags('apfd')->remember('todos_apfd:'.$this->unidade, self::$expiration, function()  {
                return $this->model->where('cdopm','like',$this->unidade.'%')->get();
            });
        }

        return $registros;
    } 

    public function ano($ano)
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('apfd')->remember('todos_apfd:'.$ano, self::$expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano','=',$ano)->get();
            });
        }
        else 
        {
            $registros = Cache::tags('apfd')->remember('todos_apfd:'.$ano.':'.$this->unidade, self::$expiration, function() use ($ano) {
                return $this->model->where('cdopm','like',$this->unidade.'%')->where('sjd_ref_ano','=',$ano)->get();
            });
        }
        return $registros;
    } 

    public function andamento()
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('apfd')->remember('andamento_apfd', self::$expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_apfd', '=', 'apfd.id_apfd')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::tags('apfd')->remember('andamento_apfd_:'.$this->unidade, self::$expiration, function()  {
                return $this->model->where('cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_apfd', '=', 'apfd.id_apfd')
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
            $registros = Cache::tags('apfd')->remember('andamento_apfd:'.$ano, self::$expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_apfd', '=', 'apfd.id_apfd')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::tags('apfd')->remember('andamento_apfd:'.$ano.':'.$this->unidade, self::$expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_apfd', '=', 'apfd.id_apfd')
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
            $registros = Cache::tags('apfd')->remember('julgamento_apfd', self::$expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_apfd', '=', 'apfd.id_apfd')
                                ->where('envolvido.id_apfd', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','apfd'))
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::tags('apfd')->remember('julgamento_apfd:'.$this->unidade, self::$expiration, function()  {
                return $this->model->where('cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_apfd', '=', 'apfd.id_apfd')
                                ->where('envolvido.id_apfd', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','apfd'))
                    ->get();
            });
        }
        return $registros;
    }

    public function julgamentoAno($ano)
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('apfd')->remember('julgamento_apfd', self::$expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_apfd', '=', 'apfd.id_apfd')
                                ->where('envolvido.id_apfd', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','apfd'))
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::tags('apfd')->remember('julgamento_apfd:'.$ano.':'.$this->unidade, self::$expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_apfd', '=', 'apfd.id_apfd')
                                ->where('envolvido.id_apfd', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','apfd'))
                    ->get();
            });
        }
        return $registros;
    }

    public function prazos()
    {
        if($this->verTodasUnidades)
        {

            $registros = Cache::tags('apfd')->remember('prazo_apfd', self::$expiration, function() {
                return $this->model
                    ->selectRaw('apfd.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_apfd=apfd.id_apfd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_apfd=apfd.id_apfd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, DIASUTEIS(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (DIASUTEIS(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_apfd, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_apfd != '' GROUP BY id_apfd ORDER BY sobrestamento.id_apfd ASC LIMIT 1) b"),
                        'b.id_apfd', '=', 'apfd.id_apfd')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_apfd', '=', 'apfd.id_apfd')
                            ->where('envolvido.situacao', '=', 'Presidente')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->get();
            });
                    
        }
        else 
        {
            $registros = Cache::tags('apfd')->remember('prazo_apfd:'.$this->unidade, self::$expiration, function() {
                return $this->model
                ->selectRaw('apfd.*, 
                (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_apfd=apfd.id_apfd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_apfd=apfd.id_apfd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                envolvido.cargo, envolvido.nome, DIASUTEIS(abertura_data,DATE(NOW())) AS dutotal, 
                b.dusobrestado, (DIASUTEIS(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                ->leftJoin(
                    DB::raw("(SELECT id_apfd, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                    WHERE termino_data != '0000-00-00' AND id_apfd != '' GROUP BY id_apfd ORDER BY sobrestamento.id_apfd ASC LIMIT 1) b"),
                    'b.id_apfd', '=', 'apfd.id_apfd')
                ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_apfd', '=', 'apfd.id_apfd')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', '');
                })
                ->where('apfd.cdopm','like',$this->unidade.'%')
                ->get();

            });   
        }
        return $registros;
    }

    public function prazosAno($ano)
    {
        if($this->verTodasUnidades)
        {

            $registros = Cache::tags('apfd')->remember('prazo_apfd:'.$ano, self::$expiration, function() use ($ano) {
                return $this->model
                    ->selectRaw('apfd.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_apfd=apfd.id_apfd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_apfd=apfd.id_apfd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, DIASUTEIS(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (DIASUTEIS(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_apfd, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_apfd != '' GROUP BY id_apfd ORDER BY sobrestamento.id_apfd ASC LIMIT 1) b"),
                        'b.id_apfd', '=', 'apfd.id_apfd')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_apfd', '=', 'apfd.id_apfd')
                            ->where('envolvido.situacao', '=', 'Presidente')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('apfd.sjd_ref_ano','=',$ano)
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::tags('apfd')->remember('prazo_apfd:'.$ano.':'.$this->unidade, self::$expiration, function() use ($ano){
                return $this->model
                    ->selectRaw('apfd.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_apfd=apfd.id_apfd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_apfd=apfd.id_apfd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, DIASUTEIS(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (DIASUTEIS(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_apfd, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_apfd != '' GROUP BY id_apfd ORDER BY sobrestamento.id_apfd ASC LIMIT 1) b"),
                        'b.id_apfd', '=', 'apfd.id_apfd')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_apfd', '=', 'apfd.id_apfd')
                            ->where('envolvido.situacao', '=', 'Presidente')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('apfd.sjd_ref_ano','=',$ano)
                    ->where('apfd.cdopm','like',$this->unidade.'%')
                    ->get();

            });   
        }
        return $registros;
    }

}

