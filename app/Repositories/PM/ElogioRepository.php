<?php

use Cache;
use App\Models\Sjd\Policiais\Elogio;
use App\Repositories\BaseRepository;

class ElogioRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected $expiration = 60 * 24;//um dia; 

	public function __construct(Elogio $model)
	{
        $this->model = $model;      
    }

    public function cleanCache()
	{
        Cache::tags('elogio')->flush();
    }
    
    public function all()
	{

        $registros = Cache::tags('elogio')->remember('todos_elogio', $this->expiration, function() {
            return $this->model->all();
        });

        return $registros;
    } 

}