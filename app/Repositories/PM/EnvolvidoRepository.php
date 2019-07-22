<?php

use Cache;
use App\Models\Sjd\Policiais\Envolvido;
use App\Repositories\BaseRepository;

class EnvolvidoRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected $expiration = 60 * 24;//um dia; 

	public function __construct(Envolvido $model)
	{
        $this->model = $model;      
    }

    public function cleanCache()
	{
        Cache::tags('envolvido')->flush();
    }
    
    public function all()
	{
        $registros = Cache::tags('envolvido')->remember('todos_envolvido', $this->expiration, function() {
            return $this->model->all();
        });
        return $registros;
    } 

    public function situacao($situacao)
	{
        $registros = Cache::tags('envolvido')->remember('envolvido:'.$situacao, $this->expiration, function() use($situacao) {
            return $this->model->where('situacao','=',$situacao)->get();
        });
		return $registros;
	}

	public function acusado()
	{
        $registros = Cache::tags('envolvido')->remember('todos_envolvido', $this->expiration, function() {
            return $this->model->where('situacao','=','Acusado')->get();
        });
		return $registros;
	}

	public function ofendido()
	{
        $registros = Cache::tags('envolvido')->remember('todos_envolvido', $this->expiration, function() {
            return $this->model->where('situacao','=','Ofendido')->get();
        });
		return $registros;
	}

	public function encarregado()
	{
        $registros = Cache::tags('envolvido')->remember('todos_envolvido', $this->expiration, function() {
            return $this->model->where('rg_substituto', '=','')->where('situacao','=','Encarregado')->get();
        });
		return $registros;
	}

	public function acusador()
	{
        $registros = Cache::tags('envolvido')->remember('todos_envolvido', $this->expiration, function() {
            return $this->model->where('rg_substituto', '=','')->where('situacao','=','Acusador')->get();
        });
		return $registros;
	}

	public function defensor()
	{
        $registros = Cache::tags('envolvido')->remember('todos_envolvido', $this->expiration, function() {
            return $this->model->where('rg_substituto', '=','')->where('situacao','=','Defensor')->get();
        });
		return $registros;
	}

	public function presidente()
	{
        $registros = Cache::tags('envolvido')->remember('todos_envolvido', $this->expiration, function() {
            return $this->model->where('rg_substituto', '=','')->where('situacao','=','Presidente')->get();
        });
		return $registros;
	}

	public function escrivao()
	{
        $registros = Cache::tags('envolvido')->remember('todos_envolvido', $this->expiration, function() {
            return $this->model->where('rg_substituto', '=','')->where('situacao','=','Escrivao')->get();
        });
		return $registros;
	}

}