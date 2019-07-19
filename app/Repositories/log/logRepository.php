<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\log;

use App\Models\Sjd\Administracao\ActivityLog as Activity;
use App\Models\Sjd\Administracao\LogAcesso as LogAcesso;
use App\Models\Sjd\Administracao\LogBloqueio as LogBloqueio;

use Cache;

use App\Repositories\BaseRepository;

class logRepository extends BaseRepository
{
    protected $model;
    protected static $expiration = 60 * 24;//um dia; 

	public function __construct(Activity $model)
	{
        $this->model = $model;
    }

    public static function cleanCache($name)
	{
        Cache::tags('log:'.$name)->flush();
    }
    
    public function all()
	{
        $registros = Cache::tags('log')->remember('todos_log', self::$expiration, function() {
            return $this->model->all();
        });
        return $registros;
    } 

    public function created($name)
    {
        if($name == 'acessos') {
            $registros = Cache::tags('log')->remember('log:acessos', 1, function() use ($name) {
                return LogAcesso::all();
            });
        }
        elseif($name == 'bloqueios') {
            $registros = Cache::tags('log')->remember('log:bloqueios', 1, function() {
                return LogBloqueio::all();
            });
        }
        else {
            $registros = Cache::tags('log')->remember('log:created:'.$name, 1, function() use ($name) {
                return $this->model->where('log_name' , $name)->where('description','created')->get();
            }); 
        }

        return $registros;
    }

    public function updated($name) {
        return $this->model->where('log_name' , $name)->where('description','updated')->get();
    }

    public function deleted($name) {
        return $this->model->where('log_name' , $name)->where('description','deleted')->get();
    }

    public function restored($name) {
        return $this->model->where('log_name' , $name)->where('description','restored')->get();
    }



}

