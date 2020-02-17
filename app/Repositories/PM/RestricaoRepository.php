<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\PM;

use Cache;
use App\Models\Sjd\Policiais\Restricao;
use App\Repositories\BaseRepository;

class RestricaoRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected $expiration = 60 * 24;//um dia; 

	public function __construct(Restricao $model)
	{
        $this->model = $model;      
    }

    public function cleanCache()
	{
        Cache::tags('restricao')->flush();
    }
    
    public function all()
	{

        $registros = Cache::tags('restricao')->remember('todos_restricao', $this->expiration, function() {
            return $this->model->all();
        });

        return $registros;
    } 

    public function ano($ano)
	{

        $registros = Cache::tags('restricao')->remember('restricao:ano:'.$ano, $this->expiration, function() use ($ano){
            return $this->model->whereYear('cadastro_data',$ano)->get();
        });

        return $registros;
    }

    public function list($rg)
	{

        $registros = Cache::tags('restricao')->remember('restricao:rg'.$rg, $this->expiration, function() use ($rg){
            return $this->model->where('rg','=', $rg)->get();
        });

        return $registros;
    }

    public function restricoes($rg)
    {
        $registros = (object) [
            'arma' => $this->arma($rg),
            'fardamento' => $this->fardamento($rg)
        ];

        return $registros;
    }

    public function arma($rg)
    {
        $registros = Cache::tags('restricao')->remember('restricao:arma'.$rg, $this->expiration, function() use ($rg){
            return $this->model->where([
                ['arma_bl', 'S'],
                ['rg', $rg],
                ['retirada_data','0000-00-00'],
                ['fim_data','0000-00-00']
            ])->count();
        });
        

        if($registros) return true;
        return false;
    }

    public function fardamento($rg)
    {
        $registros = Cache::tags('restricao')->remember('restricao:fardamento'.$rg, $this->expiration, function() use ($rg){
            return $this->model->where([
                ['fardamento_bl', 'S'],
                ['rg', $rg],
                ['retirada_data','0000-00-00'],
                ['fim_data','0000-00-00']
            ])->count();
        });

        if($registros) return true;
        return false;
    }
}
