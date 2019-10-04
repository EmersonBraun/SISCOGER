<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\proc;

use Cache;
use App\Models\Sjd\Proc\Iso;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Route;
use App\Services\AutorizationService;

class IsoRepository extends BaseRepository
{
    protected $model;
    protected $service;
    protected $unidade;
    protected $verTodasUnidades;
    protected static $expiration = 60 * 24;//um dia  

	public function __construct(
        Iso $model,
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
        Cache::tags('iso')->flush();
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
            $registros = Cache::tags('iso')->remember('todos_iso', self::$expiration, function() {
                return $this->model->all();
            });
        }
        else 
        {
            $registros = Cache::tags('iso')->remember('todos_iso:'.$this->unidade, self::$expiration, function()  {
                return $this->model->where('cdopm','like',$this->unidade.'%')->get();
            });
        }

        return $registros;
    } 

    public function ano($ano)
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('iso')->remember('todos_iso:'.$ano, self::$expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano','=',$ano)->get();
            });
        }
        else 
        {
            $registros = Cache::tags('iso')->remember('todos_iso:'.$ano.':'.$this->unidade, self::$expiration, function() use ($ano) {
                return $this->model->where('cdopm','like',$this->unidade.'%')->where('sjd_ref_ano','=',$ano)->get();
            });
        }
        return $registros;
    } 

    public function andamento()
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('iso')->remember('andamento_iso', self::$expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_iso', '=', 'iso.id_iso')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::tags('iso')->remember('andamento_iso:'.$this->unidade, self::$expiration, function()  {
                return $this->model->where('cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_iso', '=', 'iso.id_iso')
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
            $registros = Cache::tags('iso')->remember('andamento_iso:'.$ano, self::$expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_iso', '=', 'iso.id_iso')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::tags('iso')->remember('andamento_iso:'.$ano.':'.$this->unidade, self::$expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_iso', '=', 'iso.id_iso')
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
            $registros = Cache::tags('iso')->remember('julgamento_iso', self::$expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_iso', '=', 'iso.id_iso')
                                ->where('envolvido.id_iso', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','iso'))
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::tags('iso')->remember('julgamento_iso:'.$this->unidade, self::$expiration, function()  {
                return $this->model->where('cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_iso', '=', 'iso.id_iso')
                                ->where('envolvido.id_iso', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','iso'))
                    ->get();
            });
        }
        return $registros;
    }

    public function julgamentoAno($ano)
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('iso')->remember('julgamento_iso:'.$ano, self::$expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_iso', '=', 'iso.id_iso')
                                ->where('envolvido.id_iso', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','iso'))
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::tags('iso')->remember('julgamento_iso:'.$ano.':'.$this->unidade, self::$expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_iso', '=', 'iso.id_iso')
                                ->where('envolvido.id_iso', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','iso'))
                    ->get();
            });
        }
        return $registros;
    }

    public function prazos()
    {
        if($this->verTodasUnidades)
        {

            $registros = Cache::tags('iso')->remember('prazo_iso', self::$expiration, function() {
                return $this->model
                    ->selectRaw('iso.*, envolvido.cargo, envolvido.nome, 
                    (DATEDIFF(DATE(NOW()),abertura_data)+1) AS diasuteis')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_iso', '=', 'iso.id_iso')
                            ->where('envolvido.situacao', '=', 'Encarregado')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->get();
            });
                    
        }
        else 
        {
            $registros = Cache::tags('iso')->remember('prazo_iso:'.$this->unidade, self::$expiration, function() {
                return $this->model
                    ->selectRaw('iso.*, envolvido.cargo, envolvido.nome, 
                    (DATEDIFF(DATE(NOW()),abertura_data)+1) AS diasuteis')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_iso', '=', 'iso.id_iso')
                            ->where('envolvido.situacao', '=', 'Encarregado')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('iso.cdopm','like',$this->unidade.'%')
                    ->get();

            });   
        }
        return $registros;
    }

    public function prazosAno($ano)
    {
        if($this->verTodasUnidades)
        {

            $registros = Cache::tags('iso')->remember('prazo_iso:'.$ano, self::$expiration, function() use ($ano) {
                return $this->model
                    ->selectRaw('iso.*, envolvido.cargo, envolvido.nome, 
                    (DATEDIFF(DATE(NOW()),abertura_data)+1) AS diasuteis')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_iso', '=', 'iso.id_iso')
                            ->where('envolvido.situacao', '=', 'Encarregado')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('iso.sjd_ref_ano','=',$ano)
                    ->get();
            });
                    
        }
        else 
        {
            $registros = Cache::tags('iso')->remember('prazo_iso:'.$ano.':'.$this->unidade, self::$expiration, function() use ($ano){
                return $this->model
                    ->selectRaw('iso.*, envolvido.cargo, envolvido.nome, 
                    (DATEDIFF(DATE(NOW()),abertura_data)+1) AS diasuteis')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_iso', '=', 'iso.id_iso')
                            ->where('envolvido.situacao', '=', 'Encarregado')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('iso.sjd_ref_ano','=',$ano)
                    ->where('iso.cdopm','like',$this->unidade.'%')
                    ->get();

            });   
        }
        return $registros;
    }
}

