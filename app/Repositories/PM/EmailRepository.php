<?php

use Cache;
use App\Models\Sjd\Policiais\Email;
use App\Repositories\BaseRepository;

class EmailRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected $expiration = 60 * 24;//um dia; 

	public function __construct(Email $model)
	{
        $this->model = $model;      
    }

    public function cleanCache()
	{
        Cache::tags('email')->flush();
    }
    
    public function all()
	{

        $registros = Cache::tags('email')->remember('todos_email', $this->expiration, function() {
            return $this->model->all();
        });

        return $registros;
    } 

}
