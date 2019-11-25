<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\proc;

use Illuminate\Support\Facades\DB;

use Cache;
use App\Models\Sjd\Proc\Exclusaojudicial;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Route;
use App\Services\AutorizationService;

class ExclusaoRepository extends BaseRepository
{
    protected $model;
    protected $service;
    protected $unidade;
    protected $verTodasUnidades;
    protected static $expiration = 60 * 24;//um dia 

	public function __construct(
        Exclusaojudicial $model,
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
        Cache::tags('exclusao')->flush();
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
            $registros = Cache::tags('exclusao')->remember('todos_exclusao', self::$expiration, function() {
                return $this->model->all();
            });
        }
        else 
        {
            $registros = Cache::tags('exclusao')->remember('todos_exclusao:'.$this->unidade, self::$expiration, function()  {
                return $this->model->where('cdopm','like',$this->unidade.'%')->get();
            });
        }

        return $registros;
    }
    
    public function ano($ano)
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('exclusao')->remember('todos_exclusao:'.$ano, self::$expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano','=',$ano)->get();
            });
        }
        else 
        {
            $registros = Cache::tags('exclusao')->remember('todos_exclusao:'.$ano.':'.$this->unidade, self::$expiration, function() use ($ano) {
                return $this->model->where('cdopm','like',$this->unidade.'%')->where('sjd_ref_ano','=',$ano)->get();
            });
        }
        return $registros;
    } 

    public function andamento()
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('exclusao')->remember('andamento_exclusao', self::$expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_exclusao', '=', 'exclusao.id_exclusao')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::tags('exclusao')->remember('andamento_exclusao:'.$this->unidade, self::$expiration, function()  {
                return $this->model->where('cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_exclusao', '=', 'exclusao.id_exclusao')
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
            $registros = Cache::tags('exclusao')->remember('andamento_exclusao:'.$ano, self::$expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_exclusao', '=', 'exclusao.id_exclusao')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::tags('exclusao')->remember('andamento_exclusao:'.$ano.':'.$this->unidade, self::$expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_exclusao', '=', 'exclusao.id_exclusao')
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
            $registros = Cache::tags('exclusao')->remember('julgamento_exclusao', self::$expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_exclusao', '=', 'exclusao.id_exclusao')
                                ->where('envolvido.id_exclusao', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','exclusao'))
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::tags('exclusao')->remember('julgamento_exclusao:'.$this->unidade, self::$expiration, function()  {
                return $this->model->where('cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_exclusao', '=', 'exclusao.id_exclusao')
                                ->where('envolvido.id_exclusao', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','exclusao'))
                    ->get();
            });
        }
        return $registros;
    }

    public function julgamentoAno($ano)
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('exclusao')->remember('julgamento_exclusao:'.$ano, self::$expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_exclusao', '=', 'exclusao.id_exclusao')
                                ->where('envolvido.id_exclusao', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','exclusao'))
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::tags('exclusao')->remember('julgamento_exclusao:'.$ano.':'.$this->unidade, self::$expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_exclusao', '=', 'exclusao.id_exclusao')
                                ->where('envolvido.id_exclusao', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','exclusao'))
                    ->get();
            });
        }
        return $registros;
    }

   public function prazos()
    {
        if($this->verTodasUnidades)
        {

            $registros = Cache::tags('exclusao')->remember('prazo_exclusao', self::$expiration, function() {
                return $this->model
                    ->selectRaw('exclusao.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_exclusao=exclusao.id_exclusao ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_exclusao=exclusao.id_exclusao ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, DIASUTEIS(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (DIASUTEIS(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_exclusao, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_exclusao != '' GROUP BY id_exclusao ORDER BY sobrestamento.id_exclusao ASC LIMIT 1) b"),
                        'b.id_exclusao', '=', 'exclusao.id_exclusao')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_exclusao', '=', 'exclusao.id_exclusao')
                            ->where('envolvido.situacao', '=', 'Presidente')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->get(); 
            });
                    
        }
        else 
        {
            $registros = Cache::tags('exclusao')->remember('prazo_exclusao:'.$this->unidade, self::$expiration, function() {
                return $this->model
                    ->selectRaw('exclusao.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_exclusao=exclusao.id_exclusao ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_exclusao=exclusao.id_exclusao ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, DIASUTEIS(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (DIASUTEIS(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_exclusao, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_exclusao != '' GROUP BY id_exclusao ORDER BY sobrestamento.id_exclusao ASC LIMIT 1) b"),
                        'b.id_exclusao', '=', 'exclusao.id_exclusao')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_exclusao', '=', 'exclusao.id_exclusao')
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

            $registros = Cache::tags('exclusao')->remember('prazo_exclusao:'.$ano, self::$expiration, function() use ($ano) {
                return $this->model
                    ->selectRaw('exclusao.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_exclusao=exclusao.id_exclusao ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_exclusao=exclusao.id_exclusao ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, DIASUTEIS(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (DIASUTEIS(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_exclusao, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_exclusao != '' GROUP BY id_exclusao ORDER BY sobrestamento.id_exclusao ASC LIMIT 1) b"),
                        'b.id_exclusao', '=', 'exclusao.id_exclusao')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_exclusao', '=', 'exclusao.id_exclusao')
                            ->where('envolvido.situacao', '=', 'Presidente')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('adl.sjd_ref_ano','=',$ano)
                    ->get();
            });
                    
        }
        else 
        {
            $registros = Cache::tags('exclusao')->remember('prazo_exclusao:'.$ano.':'.$this->unidade, self::$expiration, function() use ($ano){
                return $this->model
                    ->selectRaw('exclusao.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_exclusao=exclusao.id_exclusao ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_exclusao=exclusao.id_exclusao ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, DIASUTEIS(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (DIASUTEIS(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_exclusao, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_exclusao != '' GROUP BY id_exclusao ORDER BY sobrestamento.id_exclusao ASC LIMIT 1) b"),
                        'b.id_exclusao', '=', 'exclusao.id_exclusao')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_exclusao', '=', 'exclusao.id_exclusao')
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

