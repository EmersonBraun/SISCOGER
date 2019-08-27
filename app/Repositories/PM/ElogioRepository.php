<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\PM;

use Cache;
use App\Models\Sjd\Policiais\Elogio;
use App\Repositories\BaseRepository;

class ElogioRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected $expiration = 60 * 24;//um dia; 

	public function __construct(Elogio $model)
	{
        $this->model = $model;      
    }

    public function cleanCache()
	{
        Cache::tags('elogio')->flush();
    }
    
    public function search($query)
	{
        return $this->model
            ->where($query)
            ->orderBy('rg','DESC')
            ->get();
    } 

}