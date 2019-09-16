<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\PM;

use Cache;

use App\Repositories\BaseRepository;
use App\Models\Sjd\Policiais\Tramitacao;

class TramitacaoRepository extends BaseRepository
{
    protected $model;
    protected $expiration = 60 * 24 * 7;  //uma semana

	public function __construct(Tramitacao $model)
	{  
        $this->model = $model;  
    }
    
    public function cleanCache()
	{
        Cache::tags('tramitacao_geral')->flush();
    }

    public function geral()
	{
        $registros = Cache::tags('tramitacao_geral')->remember('todos_tramitacao_geral', $this->expiration, function() {
            return $this->model->all();
        });

        return $registros;
    }

    public function tramitacaoPM($rg)
    {
        $registros = Cache::tags('tramitacao_geral')->remember('tramitacao_geral:rg'.$rg, $this->expiration, function() use ($rg){
            return $this->model
                ->where('rg','=', $rg)
                ->orderByRaw('data - id_tramitacao DESC')
                ->get();
        });

        return $registros;
    }

    public function ano($ano)
    {
        $registros = Cache::tags('tramitacao_geral')->remember('tramitacao_geral:ano'.$ano, $this->expiration, function() use ($ano){
            return $this->model
                ->where('data','like', $ano.'-%')
                ->orderByRaw('data - id_tramitacao DESC')
                ->get();
        });

        return $registros;
    }

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }
}

