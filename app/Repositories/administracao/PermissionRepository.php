<?php
//Aqui ficam as consultas de banco de dados
namespace App\Repositories\administracao;

use Cache;
use App\Models\Sjd\Administracao\Permission;
use App\Repositories\BaseRepository;

class PermissionRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected $expiration = 60 * 24;//um dia; 

	public function __construct(Permission $model)
	{
        $this->model = $model;      
    }

    public function cleanCache()
	{
        Cache::tags('permission')->flush();
    }
    
    public function all()
	{

        $registros = Cache::tags('permission')->remember('todos_permission', $this->expiration, function() {
            return $this->model->all();
        });

        return $registros;
    }  
}

