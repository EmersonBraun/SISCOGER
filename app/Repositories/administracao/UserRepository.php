<?php
//Aqui ficam as consultas de banco de dados
namespace App\Repositories\administracao;

use Cache;
use App\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository
{
    protected $model;
    protected $role;
    protected $permission;
    protected $unidade;
    protected $verTodasUnidades;
    protected $expiration = 60 * 24;//um dia; 

	public function __construct(
        User $model,
        RoleRepository $role,
        PermissionRepository $permission
    )
	{
        $this->model = $model;   
        $this->role = $role;
        $this->permission = $permission;   
    }

    public function clearCache()
	{
        Cache::tags('user')->flush();
    }

    public function all()
	{

        $registros = Cache::tags('user')->remember('todos_user', $this->expiration, function() {
            return $this->model->all();
        });

        return $registros;
    }  

    public function getRg($rg)
	{

        // $registros = Cache::remember('user:'.$rg, $this->expiration, function() use ($rg){
            return $this->model->where('rg', $rg)->first();
        // });

        // return $registros;
    }

    public function findAndDelete($id)
	{
        try {
            $this->model->findOrFail($id)->delete();
            return true;
        } catch (\Throwable $th) {
            toast()->error($th->getMessage(),'ERRO');
            return false;
        }
    }
}