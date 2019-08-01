<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\PM;

use Cache;
use App\Models\Sjd\Policiais\Restricao;
use App\Repositories\BaseRepository;

class RestricaoRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected $expiration = 60 * 24;//um dia; 

	public function __construct(Restricao $model)
	{
        $this->model = $model;      
    }

    public function cleanCache()
	{
        Cache::tags('restricao')->flush();
    }
    
    public function all()
	{

        $registros = Cache::tags('restricao')->remember('todos_restricao', $this->expiration, function() {
            return $this->model->all();
        });

        return $registros;
    } 
}
