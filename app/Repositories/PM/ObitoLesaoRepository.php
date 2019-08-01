<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\PM;

use Cache;
use App\Models\Sjd\Policiais\ObitoLesao;
use App\Repositories\BaseRepository;

class ObitoLesaoRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected $expiration = 60 * 24;//um dia; 

	public function __construct(ObitoLesao $model)
	{
        $this->model = $model;      
    }

    public function cleanCache()
	{
        Cache::tags('obitolesao')->flush();
    }
    
    public function all()
	{

        $registros = Cache::tags('obitolesao')->remember('todos_obitolesao', $this->expiration, function() {
            return $this->model->all();
        });

        return $registros;
    } 

}

