<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\PM;

use Cache;

use App\Repositories\BaseRepository;
use App\Models\Sjd\Busca\Tramitacao;

class TramitacaoRepository extends BaseRepository
{
    protected $geral;
    protected $expiration = 60 * 24 * 7;  //uma semana

	public function __construct(Tramitacao $geral)
	{  
        $this->geral = $geral;  
    }
    
    public function cleanCache()
	{
        Cache::tags('tramitacao_geral')->flush();
    }

    public function geral()
	{
        $registros = Cache::tags('tramitacao_geral')->remember('todos_tramitacao_geral', $this->expiration, function() {
            return $this->geral->all();
        });

        return $registros;
    }

    public function tramitacaoPM($rg)
    {
        $registros = Cache::tags('tramitacao_geral')->remember('tramitacao_geral:rg'.$rg, $this->expiration, function() use ($rg){
            return $this->geral
                ->where('rg','=', $rg)
                ->orderByRaw('data - id_tramitacao DESC')
                ->get();
        });

        return $registros;
    }
}

