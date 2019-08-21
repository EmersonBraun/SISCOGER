<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\PM;

use Cache;
use App\Models\Sjd\Policiais\PresoOutro;
use App\Repositories\BaseRepository;

class PresoOutroRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected $expiration = 60 * 24;//um dia; 

	public function __construct(PresoOutro $model)
	{
        $this->model = $model;    
    }

    public function cleanCache()
	{
        Cache::tags('preso_outros')->flush();
    }
    
    public function all()
	{

        $registros = Cache::tags('preso_outros')->remember('todos_preso_outros', $this->expiration, function() {
            return $this->model->all();
        });

        return $registros;
    } 
}
