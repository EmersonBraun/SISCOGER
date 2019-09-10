<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\PM;

use Cache;

use App\Repositories\BaseRepository;
use App\Models\Sjd\Busca\Tramitacaoopm;

class TramitacaoopmRepository extends BaseRepository
{
    protected $model;
    protected $expiration = 60 * 24 * 7;  //uma semana

	public function __construct(Tramitacaoopm $model)
	{
        $this->model = $model;    
    }
    
    public function cleanCache()
	{
        Cache::tags('tramitacao_opm')->flush();
    }

    public function opm()
	{
        $registros = Cache::tags('tramitacao_opm')->remember('todos_tramitacao_opm', $this->expiration, function() {
            return $this->model->all();
        });

        return $registros;
    }

    public function tramitacaoopmPM($rg)
    {
        $registros = Cache::tags('tramitacao_opm')->remember('tramitacao_opm:rg'.$rg, $this->expiration, function() use ($rg){
            return $this->model
                ->where('rg','=', $rg)
                ->orderByRaw('data - id_tramitacaoopm DESC')
                ->get();
        });

        return $registros;
    }

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

}

