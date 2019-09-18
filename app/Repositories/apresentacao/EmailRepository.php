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

    public function ano($ano)
	{

        $registros = Cache::tags('email')->remember('todos_email:'.$ano, self::$expiration, function() use ($ano) {
            return $this->model->where('dh','like',$ano.'-%')->orderBy('id_email','DESC')->get();
        });

        return $registros;
    } 


}

