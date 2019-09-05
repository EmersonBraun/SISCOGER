<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\PM;

use Cache;
use App\Models\Sjd\Policiais\Protocolo;
use App\Repositories\BaseRepository;

class ProtocoloRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected $expiration = 60 * 24;//um dia; 

	public function __construct(Protocolo $model)
	{
        $this->model = $model;    
    }

    public function cleanCache()
	{
        Cache::tags('protocolo')->flush();
    }
    
    public function all()
	{

        $registros = Cache::tags('protocolo')->remember('todos_protocolo', $this->expiration, function() {
            return $this->model->all();
        });

        return $registros;
    } 

    public function protocolo($rg)
    {
        if(!$rg) return 'falta RG';

        $registros = Cache::tags('protocolo')->remember('protocolo:rg'.$rg, $this->expiration, function() use ($rg){
            return $this->model->where('rg','=', $rg)->get();
        });

        return $registros;
    }


}
