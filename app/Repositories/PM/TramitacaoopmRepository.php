<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\PM;

use Cache;

use App\Repositories\BaseRepository;
use App\Models\Sjd\Busca\Tramitacaoopm;

class TramitacaoopmRepository extends BaseRepository
{
    protected $opm;
    protected $expiration = 60 * 24 * 7;  //uma semana

	public function __construct(Tramitacaoopm $opm)
	{
        $this->opm = $opm;    
    }
    
    public function cleanCache()
	{
        Cache::tags('tramitacao_opm')->flush();
    }

    public function opm()
	{
        $registros = Cache::tags('tramitacao_opm')->remember('todos_tramitacao_opm', $this->expiration, function() {
            return $this->opm->all();
        });

        return $registros;
    }

    public function tramitacaoopmPM($rg)
    {
        $registros = Cache::tags('tramitacao_opm')->remember('tramitacao_opm:rg'.$rg, $this->expiration, function() use ($rg){
            return $this->opm
                ->where('rg','=', $rg)
                ->orderByRaw('data - id_tramitacaoopm DESC')
                ->get();
        });

        return $registros;
    }

}

