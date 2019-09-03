<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\log;

use App\Models\Sjd\Administracao\ActivityLog as Activity;
use App\Models\Sjd\Administracao\LogAcesso;
use App\Models\Sjd\Administracao\LogBloqueio;
use App\Models\Sjd\Log\LogFdi;

use Cache;

use App\Repositories\BaseRepository;

class logRepository extends BaseRepository
{
    protected $model;
    protected $acesso;
    protected $bloqueio;
    protected $fdi;
    protected static $expiration = 60 * 24;//um dia; 

	public function __construct(
        Activity $model,
        LogAcesso $acesso,
        LogBloqueio $bloqueio,
        LogFdi $fdi
    )
	{
        $this->model = $model;
        $this->acesso = $acesso;
        $this->bloqueio = $bloqueio;
        $this->fdi = $fdi;
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

    public function createAcesso(array $data)
    {
        return $this->acesso->create($data);
    } 

    public function createBloqueio(array $data)
    {
        return $this->bloqueio->create($data);
    } 

    public function createFdi(array $data)
    {
        return $this->fdi->create($data);
    } 

    public function created($name)
    {
        if($name == 'acessos') {
            $registros = Cache::tags('log')->remember('log:acessos', 1, function() use ($name) {
                return $this->acesso->all();
            });
        }
        elseif($name == 'bloqueios') {
            $registros = Cache::tags('log')->remember('log:bloqueios', 1, function() {
                return $this->bloqueio->all();
            });
        }
        else {
            $registros = Cache::tags('log')->remember('log:created:'.$name, 1, function() use ($name) {
                return $this->model->where('log_name' , $name)->where('description','created')->get();
            }); 
        }

        return $registros;
    }

    public function LogFdi()
    {
        $registros = Cache::tags('log')->remember('log:fdi', 1, function() {
            return $this->fdi->all();
        });

        return $registros;
    }

    public function LogFdiRG($rg)
    {
        $registros = Cache::tags('log')->remember('log:fdi:'.$rg, 1, function()  use ($rg){
            return $this->fdi->where('rg_ficha',$rg)->get();
        });

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

