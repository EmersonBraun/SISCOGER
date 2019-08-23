<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\PM;

use Cache;
use App\Repositories\BaseRepository;
use App\Models\Sjd\Proc\Reintegrado;

class ReintegradoRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected $expiration = 60 * 24;//um dia; 

	public function __construct(Reintegrado $model)
	{
        $this->model = $model;    
    }

    public function cleanCache()
	{
        Cache::tags('reintegrado')->flush();
    }
    
    public function all()
	{

        $registros = Cache::tags('reintegrado')->remember('todos_reintegrado', $this->expiration, function() {
            return $this->model->all();
        });

        return $registros;
    } 

}
