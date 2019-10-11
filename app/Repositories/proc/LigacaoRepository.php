<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\proc;

use App\Models\Sjd\Busca\Ligacao;
use Cache;
use App\Repositories\BaseRepository;
use App\Services\AutorizationService;

class LigacaoRepository extends BaseRepository
{
    protected $model;
    protected $service;
    protected $unidade;
    protected $verTodasUnidades;
    protected static $expiration = 60 * 24;//um dia  

	public function __construct(
        Ligacao $model,
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
        Cache::tags('ligacao')->flush();
    }
    
    public function all()
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('ligacao')->remember('todos_ligacao', self::$expiration, function() {
                return $this->model->all();
            });
        }
        else 
        {
            $registros = Cache::tags('ligacao')->remember('todos_ligacao:'.$this->unidade, self::$expiration, function()  {
                return $this->model->where('cdopm','like',$this->unidade.'%')->get();
            });
        }

        return $registros;
    } 

    public function procRefAno($proc, $ref, $ano='')
	{
        if(!$ano) $this->getByProcId($proc, $ref);

        $registros = Cache::tags('ligacao')->remember('ligacao:'.$proc.$ref.$ano, self::$expiration, function() use($proc, $ref, $ano){
            return $this->model->where('destino_proc','=',$proc)
            ->where('destino_sjd_ref','=',$ref)
            ->where('destino_sjd_ref_ano','=',$ano)
            ->get();
        });
        return $registros;
    } 

    public function getByProcId($proc, $id)
    {
        $registros = Cache::tags('ligacao')->remember('ligacao:'.$proc.$id, self::$expiration, function() use($proc, $id){
            return $this->model->where('destino_proc','=',$proc)
                    ->where('id_'.$proc,'=',$id)->get();
        });
        return $registros;
    }

    public function ano($ano)
	{
         if($this->verTodasUnidades)
        {
            $registros = Cache::tags('ligacao')->remember('todos_ligacao:'.$ano, self::$expiration, function() use ($ano) {
                return $this->model->where('destino_sjd_ref_ano','=',$ano)->get();
            });
        }
        else 
        {
            $registros = Cache::tags('ligacao')->remember('todos_ligacao:'.$ano.':'.$this->unidade, self::$expiration, function() use ($ano) {
                return $this->model->where('cdopm','like',$this->unidade.'%')->where('destino_sjd_ref_ano','=',$ano)->get();
            });
        }
        return $registros;
    } 

    public static function ligacao($proc, $id)
	{
        $registros = Cache::tags('ligacao')->remember('todos_ligacao:'.$id, self::$expiration, function() use ($proc, $id) {
            return $this->model
            ->where('id_'.$proc,$id)
            ->get();
        });

        return $registros;
    } 

    


}

