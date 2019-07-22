<?php

use Cache;
use App\Models\Sjd\Policiais\Ofendido;
use App\Repositories\BaseRepository;

class OfendidoRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected $expiration = 60 * 24;//um dia; 

	public function __construct(Ofendido $model)
	{
        $this->model = $model;      
    }

    public function cleanCache()
	{
        Cache::tags('ofendido')->flush();
    }
    
    public function all()
	{

        $registros = Cache::tags('ofendido')->remember('todos_ofendido', $this->expiration, function() {
            return $this->model->all();
        });

        return $registros;
    } 

    public function ofendidoProc($id_proc, $id)
	{
        $registros = Cache::tags('ofendido')->remember('ofendido:proc', $this->expiration, function() use($id_proc, $id) {
            return $this->model->where('situacao','Ofendido')->where($id_proc,$id)->get();
        });

        return $registros;
	}

}
