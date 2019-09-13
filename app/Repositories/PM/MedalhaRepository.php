<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\PM;

use Cache;
use App\Models\Sjd\Policiais\Medalha;
use App\Repositories\BaseRepository;

class MedalhaRepository extends BaseRepository
{
    protected $model;
    protected $expiration = 60 * 24;//um dia; 

	public function __construct(Medalha $model)
	{
        $this->model = $model;      
    }

    public function cleanCache()
	{
        Cache::tags('medalha')->flush();
    }
    
    public function all()
	{

        $registros = Cache::tags('medalha')->remember('todos_medalha', $this->expiration, function() {
            return $this->model->all();
        });

        return $registros;
    } 

    public function medalhas($rg)
	{

        $registros = Cache::tags('medalha')->remember('medalha:'.$rg, $this->expiration, function() use ($rg){
            return $this->model->where('rg',$rg)->get();
        });

        return $registros;
    }

}