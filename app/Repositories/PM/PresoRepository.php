<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\PM;

use Cache;
use App\Models\Sjd\Policiais\Preso;
use App\Repositories\BaseRepository;

class PresoRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected $expiration = 60 * 24;//um dia; 

	public function __construct(Preso $model)
	{
        $this->model = $model;    
    }

    public function cleanCache()
	{
        Cache::tags('preso')->flush();
    }
    
    public function all()
	{

        $registros = Cache::tags('preso')->remember('todos_preso', $this->expiration, function() {
            return $this->model->all();
        });

        return $registros;
    } 

}
