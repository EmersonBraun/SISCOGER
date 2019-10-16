<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\apresentacao;

use Cache;
use App\Models\Sjd\Apresentacao\Email;
use App\Repositories\BaseRepository;

class EmailRepository extends BaseRepository
{
    protected $model;
    protected static $expiration = 60 * 24;//um dia; 

	public function __construct(Email $model)
	{
        $this->model = $model;
    }

    public function cleanCache()
	{
        Cache::tags('email')->flush();
    }
    
    public function all()
	{
        $registros = Cache::tags('email')->remember('todos_email', self::$expiration, function() {
            return $this->model->all();
        });


        return $registros;
    } 

    public function paginate($paginate=10)
	{
        return $this->model->orderBy('id_email','DESC')->paginate($paginate);
    } 


}

