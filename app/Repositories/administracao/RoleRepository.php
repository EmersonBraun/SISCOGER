<?php
//Aqui ficam as consultas de banco de dados
namespace App\Repositories\administracao;

use Cache;
// use App\Models\Sjd\Administracao\Role;
use Spatie\Permission\Models\Role;
use App\Repositories\BaseRepository;

class RoleRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected $expiration = 60 * 24;//um dia; 

	public function __construct(Role $model)
	{
        $this->model = $model;      
    }

    public function clearCache()
	{
        Cache::tags('role')->flush();
    }
    
    public function all()
	{

        $registros = Cache::tags('role')->remember('todos_role', $this->expiration, function() {
            return $this->model->all();
        });

        return $registros;
    }  

    public function getById($id)  
    {
        $registros = Cache::tags('role')->remember('role:'.$id, $this->expiration, function() use ($id){
            return $this->model->where('id',$id)->firstOrFail();
        });

        return $registros; 
    }

    public function getByName($name)
    {
        $registros = Cache::tags('role')->remember('role:'.$name, $this->expiration, function() use ($name){
            return $this->model->where('name',$name)->firstOrFail();
        });

        return $registros;
    }
}

