<?php
//Aqui ficam as consultas de banco de dados
namespace App\Repositories\administracao;

use Cache;
use Spatie\Permission\Models\Permission;
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
    
    public function getByName($name)
	{

        $registros = Cache::tags('permission')->remember('permission:'.$name, $this->expiration, function() use ($name){
            return $this->model->where('name', $name)->first();
        });

        return $registros;
    }

    public function treeview()
    {
        $relateds = $this->relateds();
        foreach ($relateds as $r) {
            $permissions[$r->related] = $this->relation($r->related);
        }

        return $permissions;
    }

    public function relateds()
    {
        $registros = Cache::tags('permission')->remember('permission:relateds', $this->expiration, function() {
            return $this->model->distinct()->orderBy('related')->get(['related']);
        });

        return $registros; 
    }

    public function relation($related)
    {
        $registros = Cache::tags('permission')->remember('permission:relations:'.$related, $this->expiration, function() use ($related){
            return $this->model->where('related',$related)->get(['id','name'])->toArray();
        });
        return $registros; 
    }
}

