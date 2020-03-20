<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\proc;

use Cache;
use App\Models\Sjd\Proc\ProcOutro;
use App\Repositories\BaseRepository;
use App\Services\AutorizationService;

class ProcOutroRepository extends BaseRepository
{
    protected $model;
    protected $service;
    protected $unidade;
    protected $verTodasUnidades;
    protected static $expiration = 60 * 24;//um dia 

	public function __construct(
        ProcOutro $model,
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
        Cache::tags('proc_outro')->flush();
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
            $registros = Cache::tags('proc_outro')->remember('todos_proc_outro', self::$expiration, function() {
                return $this->model
                ->all();
            });
        }
        else 
        {
            $registros = Cache::tags('proc_outro')->remember('todos_proc_outro'.$this->unidade, self::$expiration, function()  {
                return $this->model->where('cdopm','like',$this->unidade.'%')->get();
            });
        }

        return $registros;
    } 

    public function ano($ano)
	{
         if($this->verTodasUnidades)
        {
            $registros = Cache::tags('proc_outro')->remember('todos_proc_outro'.$ano, self::$expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano','=',$ano)
                ->get();
            });
        }
        else 
        {
            $registros = Cache::tags('proc_outro')->remember('todos_proc_outro'.$ano.$this->unidade, self::$expiration, function() use ($ano) {
                return $this->model->where('cdopm','like',$this->unidade.'%')->where('sjd_ref_ano','=',$ano)
                ->get();
            });
        }
        return $registros;
    } 

    public function andamento()
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('proc_outro')->remember('andamento_proc_outro', self::$expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_proc_outro', '=', 'proc_outro.id_proc_outro')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::tags('proc_outro')->remember('andamento_proc_outro'.$this->unidade, self::$expiration, function()  {
                return $this->model->where('cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_proc_outro', '=', 'proc_outro.id_proc_outro')
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
            $registros = Cache::tags('proc_outro')->remember('andamento_proc_outro'.$ano, self::$expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_proc_outro', '=', 'proc_outro.id_proc_outro')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::tags('proc_outro')->remember('andamento_proc_outro'.$ano.$this->unidade, self::$expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_proc_outro', '=', 'proc_outro.id_proc_outro')
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
            $registros = Cache::tags('proc_outro')->remember('julgamento_proc_outro', self::$expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_proc_outro', '=', 'proc_outro.id_proc_outro')
                                ->where('envolvido.id_proc_outro', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','proc_outro'))
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::tags('proc_outro')->remember('julgamento_proc_outro'.$this->unidade, self::$expiration, function()  {
                return $this->model->where('cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_proc_outro', '=', 'proc_outro.id_proc_outro')
                                ->where('envolvido.id_proc_outro', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','proc_outro'))
                    ->get();
            });
        }
        return $registros;
    }

    public function julgamentoAno($ano)
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('proc_outro')->remember('julgamento_proc_outro'.$ano, self::$expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_proc_outro', '=', 'proc_outro.id_proc_outro')
                                ->where('envolvido.id_proc_outro', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','proc_outro'))
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::tags('proc_outro')->remember('julgamento_proc_outro'.$ano.$this->unidade, self::$expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_proc_outro', '=', 'proc_outro.id_proc_outro')
                                ->where('envolvido.id_proc_outro', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','proc_outro'))
                    ->get();
            });
        }
        return $registros;
    }

    public function prazos()
    {
        if($this->verTodasUnidades)
        {

            $registros = Cache::tags('proc_outro')->remember('prazo_proc_outro', self::$expiration, function() {
                return $this->model->selectRaw('DISTINCT proc_outros.*,
                    DIASUTEIS(abertura_data,DATE(NOW())) AS ducorridos,
                    DATEDIFF(DATE(NOW()),abertura_data) AS dtcorridos,
                    DIASUTEIS(abertura_data,limite_data) AS dutotal,
                    DATEDIFF(limite_data,abertura_data) AS dttotal ,
                    DIASUTEIS(DATE(NOW()),limite_data) AS dufaltando,
                    DATEDIFF(limite_data,DATE(NOW())) AS dtfaltando')
                    ->get(); 
                });
                    
        }
        else 
        {
            $registros = Cache::tags('proc_outro')->remember('prazo_proc_outro'.$this->unidade.'_prazo_topm', self::$expiration, function() {
                return $this->model->selectRaw('DISTINCT proc_outros.*,
                    DIASUTEIS(abertura_data,DATE(NOW())) AS ducorridos,
                    DATEDIFF(DATE(NOW()),abertura_data) AS dtcorridos,
                    DIASUTEIS(abertura_data,limite_data) AS dutotal,
                    DATEDIFF(limite_data,abertura_data) AS dttotal ,
                    DIASUTEIS(DATE(NOW()),limite_data) AS dufaltando,
                    DATEDIFF(limite_data,DATE(NOW())) AS dtfaltando')
                    ->where('proc_outros.cdopm','like',$this->unidade.'%')
                    ->get(); 
            });   
        }
        return $registros;
    }

    public function prazosAno($ano)
    {
        if($this->verTodasUnidades)
        {

            $registros = Cache::tags('proc_outro')->remember('prazo_proc_outro'.$ano, self::$expiration, function() use ($ano) {
                return $this->model->selectRaw('DISTINCT proc_outros.*,
                    DIASUTEIS(abertura_data,DATE(NOW())) AS ducorridos,
                    DATEDIFF(DATE(NOW()),abertura_data) AS dtcorridos,
                    DIASUTEIS(abertura_data,limite_data) AS dutotal,
                    DATEDIFF(limite_data,abertura_data) AS dttotal ,
                    DIASUTEIS(DATE(NOW()),limite_data) AS dufaltando,
                    DATEDIFF(limite_data,DATE(NOW())) AS dtfaltando')
                    ->where('proc_outros.sjd_ref_ano','=',$ano)
                    ->get();
            });
                    
        }
        else 
        {
            $registros = Cache::tags('proc_outro')->remember('prazo_proc_outro'.$ano.$this->unidade, self::$expiration, function() use ($ano){
                return $this->model->selectRaw('DISTINCT proc_outros.*,
                    DIASUTEIS(abertura_data,DATE(NOW())) AS ducorridos,
                    DATEDIFF(DATE(NOW()),abertura_data) AS dtcorridos,
                    DIASUTEIS(abertura_data,limite_data) AS dutotal,
                    DATEDIFF(limite_data,abertura_data) AS dttotal ,
                    DIASUTEIS(DATE(NOW()),limite_data) AS dufaltando,
                    DATEDIFF(limite_data,DATE(NOW())) AS dtfaltando')
                    ->where('proc_outros.cdopm','like',$this->unidade.'%')
                    ->where('proc_outros.sjd_ref_ano','=',$ano)
                    ->get();

            });   
        }
        return $registros;
    }
}

