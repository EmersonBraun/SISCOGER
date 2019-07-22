<?php

use Cache;
use App\Models\Sjd\Policiais\Sai;
use App\Repositories\BaseRepository;

class SaiRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected $expiration = 60 * 24;//um dia; 

	public function __construct(Sai $model)
	{
        $this->model = $model;      
    }

    public function cleanCache()
	{
        Cache::tags('sai')->flush();
    }
    
    public function all()
	{

        $registros = Cache::tags('sai')->remember('todos_sai', $this->expiration, function() {
            return $this->model->all();
        });

        return $registros;
    } 
}
