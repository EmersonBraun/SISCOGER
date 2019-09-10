<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\PM;

use Cache;
use App\Models\Sjd\Policiais\Denunciacivil;
use App\Repositories\BaseRepository;

class DenunciacivilRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected $expiration = 60 * 24;//um dia; 

	public function __construct(Denunciacivil $model)
	{
        $this->model = $model;      
    }

    public function cleanCache()
	{
        Cache::tags('denunciacivil')->flush();
    }
    
    public function all()
	{

        $registros = Cache::tags('denunciacivil')->remember('todos_denunciacivil', $this->expiration, function() {
            return $this->model->all();
        });

        return $registros;
    } 

    public function listDenuncias($rg)
    {
        $registros = Cache::tags('denunciacivil')->remember('denunciacivil:rg'.$rg, $this->expiration, function() use ($rg){
            return $this->model
                ->where('rg','=', $rg)
                ->get();
        });

        return $registros;
    }

    public function estaDenunciado($rg)
    {
        $registros = Cache::tags('denunciacivil')->remember('denunciacivil:estadenunciado'.$rg, $this->expiration, function() use ($rg){
            return $this->model
                ->where([
                    ['rg', $rg],
                    ['transitojulgado_bl','<>','S'],
                    ['julgamento','<>','Absolvido'],
                    ['processocrime','<>','Absolvido']
                ])
                ->count();
        });
        
        return $registros;
    }

}
