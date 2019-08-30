<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\PM;

use Cache;
use App\Models\Sjd\Policiais\Suspenso;
use App\Repositories\BaseRepository;

class SuspensoRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected $expiration = 60 * 24;//um dia; 

	public function __construct(Suspenso $model)
	{
        $this->model = $model;      
    }

    public function cleanCache()
	{
        Cache::tags('suspenso')->flush();
    }
    
    public function all()
	{

        $registros = Cache::tags('suspenso')->remember('todos_suspenso', $this->expiration, function() {
           return $this->model->all();
        });

        return $registros;
    } 

    public function estaoSuspensos()
	{

        $registros = Cache::tags('suspenso')->remember('todos_suspenso_atual', $this->expiration, function() {
           return $this->model
                    ->where('inicio_data','<=', date("Y-m-d"))
                    ->where('fim_data','=', '')
                    ->get();
        });

        return $registros;
    }

    public function estaSuspenso($rg)
    {
        $registros = Cache::tags('suspenso')->remember('suspenso:rg'.$rg, $this->expiration, function() use ($rg){
            return $this->model->where('inicio_data','<=', date("Y-m-d"))
                        ->where('fim_data','=', '')
                        ->where('rg','=', $rg)
                        ->first();
         });

        $registros = (is_null($registros)) ? false : (object) $registros;
        return $registros;
    }

}

