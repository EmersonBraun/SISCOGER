<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\PM;

use Cache;
use App\Models\Sjd\Policiais\Falecimento;
use App\Repositories\BaseRepository;

class MortoFeridoRepository extends BaseRepository
{
    protected $model;
    protected $expiration = 60 * 24;//um dia; 

	public function __construct(Falecimento $model)
	{
        $this->model = $model;      
    }

    public function cleanCache()
	{
        Cache::tags('falecimento')->flush();
    }
    
    public function all()
	{

        $registros = Cache::tags('falecimento')->remember('todos_falecimento', $this->expiration, function() {
            return $this->model->all();
        });

        return $registros;
    } 

}