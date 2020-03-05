<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\proc;

use Cache;
use App\Models\Sjd\Proc\Recurso;
use App\Repositories\BaseRepository;
use App\Services\AutorizationService;

class RecursoRepository extends BaseRepository
{
    protected $model;
    protected $service;
    protected $unidade;
    protected $verTodasUnidades;
    protected static $expiration = 60 * 24;//um dia  

	public function __construct(
        Recurso $model,
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
        Cache::tags('recurso')->flush();
    }

    public function procRefAno($ref, $ano = '', $name)
    {
        if(!$ano) $proc = $this->model->findOrFail($ref);
        else $proc = $this->model->where([['sjd_ref',$ref],['sjd_ref_ano',$ano]])->first();

        if(!$proc) abort(404);
        return $proc;
    }
   
    public function all()
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('recurso')->remember('todos_recurso', self::$expiration, function() {
                return $this->model->all();
            });
        }
        else 
        {
            $registros = Cache::tags('recurso')->remember('todos_recurso'.$this->unidade, self::$expiration, function()  {
                return $this->model->where('cdopm','like',$this->unidade.'%')->get();
            });
        }

        return $registros;
    } 

    public function ano($ano)
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('recurso')->remember('todos_recurso'.$ano, self::$expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano','=',$ano)->get();
            });
        }
        else 
        {
            $registros = Cache::tags('recurso')->remember('todos_recurso'.$ano.$this->unidade, self::$expiration, function() use ($ano) {
                return $this->model->where('cdopm','like',$this->unidade.'%')->where('sjd_ref_ano','=',$ano)->get();
            });
        }
        return $registros;
    } 

    public function distinctProcs()
    {
        $registros = Cache::tags('recurso')->remember('recurso:procs', self::$expiration, function() {
            return $this->model->distinct()->orderBy('procedimento')->get(['procedimento']);
        });
        return $registros;
    }

    public function proc($proc)
    {
        // $registros = Cache::tags('recurso')->remember('recurso:'.$proc, self::$expiration, function() use ($proc) {
            return $this->model->where('procedimento',$proc)->get();
        // });
        return $registros;
    }


}

