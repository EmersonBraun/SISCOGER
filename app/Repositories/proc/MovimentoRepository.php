<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\proc;

use Cache;
use App\Models\Sjd\Proc\Movimento;
use App\Repositories\BaseRepository;
use App\Services\AutorizationService;

class MovimentoRepository extends BaseRepository
{
    protected $model;
    protected $service;
    protected $unidade;
    protected $verTodasUnidades;
    protected static $expiration = 60 * 24;//um dia 

	public function __construct(
        Movimento $model,
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
        Cache::tags('movimento')->flush();
    }

    public function getById($id_proc, $id)
    {
        return $this->model->where('id_'.$id_proc,$id)->get();
    }

    public function allProc($id, $proc)
	{

        $registros = Cache::tags('movimento')->remember('movimentos:'.$proc.':'.$id, 1, function() use($id, $proc) {
            return $this->model->where('id_'.$proc,'=',$id)->get();
        });

        return $registros;
    }
    
    public function all()
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('movimento')->remember('todos_movimento', self::$expiration, function() {
                return $this->model->all();
            });
        }
        else 
        {
            $registros = Cache::tags('movimento')->remember('todos_movimento::'.$this->unidade, self::$expiration, function()  {
                return $this->model->where('cdopm','like',$this->unidade.'%')->get();
            });
        }

        return $registros;
    } 


}

