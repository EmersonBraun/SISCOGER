<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\PM;

use Cache;

use App\Repositories\BaseRepository;
use App\Models\meta4\Ausencia;

class AfastamentoRepository extends BaseRepository
{
    protected $model;
    protected $expiration = 60 * 24 * 7;  //uma semana

	public function __construct(Ausencia $model)
	{
        $this->model = $model;     
    }
    
    public function cleanCache()
	{
        Cache::tags('afastamento')->flush();
    }

    public function all()
	{
        $registros = Cache::tags('afastamento')->remember('todos_afastamento', $this->expiration, function() {
            return $this->model->all();
        });

        return $registros;
    }

    public function afastamentos($rg)
	{
        $registros = Cache::tags('afastamento')->remember('afastamento:rg'.$rg, $this->expiration, function() use($rg){
            return $this->model->where('rg','=', $rg)->get();
        });

        return $registros;
    }
}

