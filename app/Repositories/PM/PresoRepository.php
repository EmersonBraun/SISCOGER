<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\PM;

use Cache;
use App\Models\Sjd\Policiais\Preso;
use App\Repositories\BaseRepository;

class PresoRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected $expiration = 60 * 24;//um dia; 

	public function __construct(Preso $model)
	{
        $this->model = $model;    
    }

    public function cleanCache()
	{
        Cache::tags('preso')->flush();
    }
    
    public function all()
	{

        $registros = Cache::tags('preso')->remember('todos_preso', $this->expiration, function() {
            return $this->model->all();
        });

        return $registros;
    } 

    public function estaPreso($rg)
    {
        if(!$rg) return 'falta RG';

        $registros = Cache::tags('preso')->remember('preso:rg'.$rg, $this->expiration, function() use ($rg){
            return $this->model->where('inicio_data','<=', date("Y-m-d"))
                        ->where('fim_data','=', '0000-00-00')
                        ->where('rg','=', $rg)
                        ->count();
        });

        return $registros;
    }

    public function estaoPresos()
    {
        $registros = Cache::tags('preso')->remember('preso:atual', $this->expiration, function(){
            return $this->model->where('inicio_data','<=', date("Y-m-d"))
                        ->where('fim_data','=', '')
                        ->first();
        });

        $registros = (is_null($registros)) ? false : (object) $registros;
        return $registros;
    }

    
    public function prisoes($rg)
    {
        $registros = Cache::tags('preso')->remember('prisoes:rg'.$rg, $this->expiration, function() use ($rg){
            return $this->model->where('rg','=', $rg)->get();
        });

        $registros = (is_null($registros)) ? false : (object) $registros;
        return $registros;
    }

}
