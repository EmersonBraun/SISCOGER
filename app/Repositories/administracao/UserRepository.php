<?php
//Aqui ficam as consultas de banco de dados
namespace App\Repositories\administracao;

use Cache;
use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected $expiration = 60 * 24;//um dia; 

	public function __construct(User $model)
	{
        $this->model = $model;      
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
}