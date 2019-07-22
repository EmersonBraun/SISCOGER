<?php

use Cache;
use App\Models\Sjd\Policiais\Falecimento;
use App\Repositories\BaseRepository;

class ObitoLesoesRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected $expiration = 60 * 24;//um dia; 

	public function __construct(Falecimento $model)
	{
        $this->model = $model;      
    }

    public function cleanCache()
	{
        Cache::tags('falecimento')->flush();
    }
    
    public function all()
	{

        $registros = Cache::tags('falecimento')->remember('todos_falecimento', $this->expiration, function() {
            return $this->model->all();
        });

        return $registros;
    } 

}

