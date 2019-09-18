<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\apresentacao;

use Cache;
use App\Models\Sjd\Apresentacao\LocalApresentacao;
use App\Repositories\BaseRepository;

class LocalApresentacaoRepository extends BaseRepository
{
    protected $model;
    protected static $expiration = 60 * 24;//um dia; 

	public function __construct(LocalApresentacao $model)
	{
        $this->model = $model;
    }

    public function cleanCache()
	{
        Cache::tags('local')->flush();
    }
    
    public function all()
	{
        $registros = Cache::tags('local')->remember('todos_local', self::$expiration, function() {
            return $this->model->orderBy('id_localdeapresentacao','DESC')->get();
        });


        return $registros;
    } 

}

