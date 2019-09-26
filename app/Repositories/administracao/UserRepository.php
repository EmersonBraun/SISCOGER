<?php
//Aqui ficam as consultas de banco de dados
namespace App\Repositories\administracao;

use Cache;
use App\User;
use App\Repositories\BaseRepository;

use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Sjd\Administracao\LogAcesso;
use App\Models\Sjd\Administracao\LogBloqueio as LogBloqueio;

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

    public function cleanCache()
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

        $registros = Cache::remember('user:'.$rg, $this->expiration, function() use ($rg){
            return $this->model->where('rg', '=', $rg)->first();
        });

        return $registros;
    }
}