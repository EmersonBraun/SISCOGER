<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\proc;

use Cache;

use App\Repositories\BaseRepository;
use App\Models\Sjd\Proc\Encaminhamento;

class EncaminhamentoRepository extends BaseRepository
{
    protected $model;
    protected $expiration = 60 * 24;//um dia 

	public function __construct(
        Encaminhamento $model
    )
	{
		$this->model = $model;
    }

    public function cleanCache()
	{
        Cache::tags('encaminhamentos')->flush();
    }
    
    public function all()
	{

        $registros = Cache::tags('encaminhamentos')->remember('todos_encaminhamentos', $this->expiration, function() {
            return $this->model->all();
        });

        return $registros;
    }

    public function getByProcId($proc, $id)
	{

        $registros = Cache::tags('encaminhamentos')->remember('encaminhamentos:'.$proc.$id, $this->expiration, function() use ($proc, $id){
            return $this->model->where([
                ['proc',$proc],
                ['id_proc',$id]
            ])
            ->orderBy('id','DESC')
            ->first();
        });

        return $registros;
    }

}

