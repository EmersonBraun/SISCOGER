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

    public function elogiosPM($rg)
    {
        $registros = Cache::tags('elogio')->remember('elogio:rg'.$rg, $this->expiration, function() use ($rg){
            return $this->model->where('rg','=', $rg)
            ->orderBy('elogio_data', 'DESC')
            ->get();
        });

        return $registros;
    }

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    public function elosgiosGerais()
    {
        return 'Muitos registros, use search';
    }

}