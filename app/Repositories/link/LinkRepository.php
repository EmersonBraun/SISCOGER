<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\link;

use Cache;

use App\Repositories\BaseRepository;
use App\Models\Sjd\Link\LinkUtil;

class LinkRepository extends BaseRepository
{
    protected $model;
    protected static $expiration = 60 * 24;//um dia; 

	public function __construct(LinkUtil $model)
	{
        $this->model = $model;
    }

    public function cleanCache()
	{
        Cache::tags('link')->flush();
    }
    
    public function all()
	{
        $registros = Cache::tags('link')->remember('todos_link', self::$expiration, function() {
            return $this->model->all();
        });
        return $registros;
    } 

}

