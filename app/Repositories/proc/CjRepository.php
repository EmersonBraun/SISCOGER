<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\proc;

use Illuminate\Support\Facades\DB;

use Cache;
use App\Models\Sjd\Proc\Cj;
use App\Repositories\BaseRepository;
use App\Services\AutorizationService;

class CjRepository extends BaseRepository
{
    protected $model;
    protected $service;
    protected $unidade;
    protected $verTodasUnidades;
    protected static $expiration = 60 * 24;//um dia  

	public function __construct(
        Cj $model,
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
        Cache::tags('cj')->flush();
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
            $registros = Cache::tags('cj')->remember('todos_cj', self::$expiration, function() {
                return $this->model->all();
            });
        }
        else 
        {
            $registros = Cache::tags('cj')->remember('todos_cj'.$this->unidade, self::$expiration, function()  {
                return $this->model->where('cdopm','like',$this->unidade.'%')->get();
            });
        }

        return $registros;
    } 

    public function ano($ano)
	{      
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('cj')->remember('todos_cj'.$ano, self::$expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano','=',$ano)->get();
            });
        }
        else 
        {
            $registros = Cache::tags('cj')->remember('todos_cj'.$ano.$this->unidade, self::$expiration, function() use ($ano) {
                return $this->model->where('cdopm','like',$this->unidade.'%')->where('sjd_ref_ano','=',$ano)->get();
            });
        }
        return $registros;
    } 

    public function andamento()
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('cj')->remember('andamento_cj', self::$expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_cj', '=', 'cj.id_cj')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::tags('cj')->remember('andamento_cj'.$this->unidade, self::$expiration, function()  {
                return $this->model->where('cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_cj', '=', 'cj.id_cj')
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
            $registros = Cache::tags('cj')->remember('andamento_cj'.$ano, self::$expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_cj', '=', 'cj.id_cj')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::tags('cj')->remember('andamento_cj'.$ano.$this->unidade, self::$expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_cj', '=', 'cj.id_cj')
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
            $registros = Cache::tags('cj')->remember('julgamento_cj', self::$expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_cj', '=', 'cj.id_cj')
                                ->where('envolvido.id_cj', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','cj'))
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::tags('cj')->remember('julgamento_cj'.$this->unidade, self::$expiration, function()  {
                return $this->model->where('cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_cj', '=', 'cj.id_cj')
                                ->where('envolvido.id_cj', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','cj'))
                    ->get();
            });
        }
        return $registros;
    }

    public function julgamentoAno($ano)
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('cj')->remember('julgamento_cj'.$ano, self::$expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_cj', '=', 'cj.id_cj')
                                ->where('envolvido.id_cj', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','cj'))
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::tags('cj')->remember('julgamento_cj'.$ano.$this->unidade, self::$expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_cj', '=', 'cj.id_cj')
                                ->where('envolvido.id_cj', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','cj'))
                    ->get();
            });
        }
        return $registros;
    }

    public function prazos()
    {
        if($this->verTodasUnidades)
        {

            $registros = Cache::tags('cj')->remember('prazo_cj', self::$expiration, function() {
                return $this->model
                    ->selectRaw('cj.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_cj=cj.id_cj ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_cj=cj.id_cj ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, DIASUTEIS(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (DIASUTEIS(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_cj, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_cj != '' GROUP BY id_cj ORDER BY sobrestamento.id_cj ASC LIMIT 1) b"),
                        'b.id_cj', '=', 'cj.id_cj')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_cj', '=', 'cj.id_cj')
                            ->where('envolvido.situacao', '=', 'Presidente')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->get();

            });
                    
        }
        else 
        {
            $registros = Cache::tags('cj')->remember('prazo_cj'.$this->unidade, self::$expiration, function() {
                return $this->model
                    ->selectRaw('cj.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_cj=cj.id_cj ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_cj=cj.id_cj ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, DIASUTEIS(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (DIASUTEIS(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_cj, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_cj != '' GROUP BY id_cj ORDER BY sobrestamento.id_cj ASC LIMIT 1) b"),
                        'b.id_cj', '=', 'cj.id_cj')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_cj', '=', 'cj.id_cj')
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

            $registros = Cache::tags('cj')->remember('prazo_cj'.$ano, self::$expiration, function() use ($ano) {
                return $this->model
                    ->selectRaw('cj.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_cj=cj.id_cj ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_cj=cj.id_cj ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, DIASUTEIS(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (DIASUTEIS(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_cj, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_cj != '' GROUP BY id_cj ORDER BY sobrestamento.id_cj ASC LIMIT 1) b"),
                        'b.id_cj', '=', 'cj.id_cj')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_cj', '=', 'cj.id_cj')
                            ->where('envolvido.situacao', '=', 'Presidente')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('adl.sjd_ref_ano','=',$ano)
                    ->get();
                });
                    
        }
        else 
        {
            $registros = Cache::tags('cj')->remember('prazo_cj'.$ano.$this->unidade, self::$expiration, function() use ($ano){
                return $this->model
                    ->selectRaw('cj.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_cj=cj.id_cj ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_cj=cj.id_cj ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, DIASUTEIS(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (DIASUTEIS(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_cj, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_cj != '' GROUP BY id_cj ORDER BY sobrestamento.id_cj ASC LIMIT 1) b"),
                        'b.id_cj', '=', 'cj.id_cj')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_cj', '=', 'cj.id_cj')
                            ->where('envolvido.situacao', '=', 'Presidente')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('adl.cdopm','like',$this->unidade.'%')
                    ->where('adl.sjd_ref_ano','=',$ano)
                    ->get();

            });   
        }
        return $registros;
    }
}

