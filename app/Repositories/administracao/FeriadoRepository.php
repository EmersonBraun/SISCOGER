<?php
//Aqui ficam as consultas de banco de dados
namespace App\Repositories\administracao;

use Cache;
use App\Models\Sjd\Administracao\Feriado;
use App\Repositories\BaseRepository;

class FeriadoRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected $expiration = 60 * 24;//um dia; 

	public function __construct(Feriado $model)
	{
        $this->model = $model;      
    }

    public function cleanCache()
	{
        Cache::tags('feriado')->flush();
    }
    
    public function all()
	{

        $registros = Cache::tags('feriado')->remember('todos_feriado', $this->expiration, function() {
            return $this->model->all();
        });

        return $registros;
    } 

    public function ano($ano)
	{

        $registros = Cache::tags('feriado')->remember('todos_feriado:'.$ano, $this->expiration, function() use ($ano) {
            return $this->model->whereYear('data', $ano)->get();
        });

        return $registros;
    } 

    public function mes($mes)
	{

        $registros = Cache::tags('feriado')->remember('todos_feriado:'.$mes, $this->expiration, function() use ($mes) {
            return $this->model->whereMonth('data', $mes)->get();
        });

        return $registros;
    } 

    public function date($date)
	{

        $registros = Cache::tags('feriado')->remember('todos_feriado:'.$date, $this->expiration, function() use ($date) {
            return $this->model->whereDate('data', $date)->get();
        });

        return $registros;
    } 

}

