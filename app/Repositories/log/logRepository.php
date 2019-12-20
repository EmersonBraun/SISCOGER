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
        try {
            $exec = $this->acesso->create($data);
            if($exec) $this->cleanCache('acessos');
            return true;
        } catch (\Throwable $th) {
            //dd($th)
            return false;
        }
    } 

    public function createBloqueio(array $data)
    {
        try {
            $exec = $this->bloqueio->create($data);
            if($exec) $this->cleanCache('bloqueios');
            return true;
        } catch (\Throwable $th) {
            //dd($th)
            return false;
        }
    } 

    public function createFdi(array $data)
    {
        try {
            $exec = $this->fdi->create($data);
            if($exec) $this->cleanCache('fdi');
            return true;
        } catch (\Throwable $th) {
            //dd($th)
            return false;
        }
    } 

    public function created($name)
    {
        if($name == 'acessos') $registros = $this->LogAcessos();
        if($name == 'bloqueios') $registros = $this->LogBloqueios();
        if($name == 'fdi') $registros = $this->LogFdi();

        if($name !== 'acessos' && $name !== 'bloqueios' && $name !== 'fdi') $registros = $this->geral($name);

        return $registros;
    }

    public function geral($name) 
    {
        $registros = Cache::tags('log')->remember('log:created:'.$name, 1, function() use ($name) {
            return $this->model->where('log_name' , $name)->where('description','created')->get();
        }); 

        return $registros;
    }

    public function LogAcessos()
    {
        $registros = Cache::tags('log')->remember('log:acessos', 1, function() {
            return $this->acesso->all();
        });

        return $registros;
    }

    public function ultimoAcesso()
    {
        $usuarios = $this->acesso
            ->selectRaw('distinct(log_acessos.rg), users.id')
            ->join('users', 'users.rg', '=', 'log_acessos.rg')
            ->get();
        foreach ($usuarios as $usuario) {
            $result = $this->acesso
            ->selectRaw('max(created_at) ultimo_acesso, DATEDIFF(now(), max(created_at)) qtd_dias,rg')
            ->where('rg',$usuario['rg'])
            ->orderBy('created_at','DESC')
            ->first()->toArray(); 
            $result['id'] = $usuario['id'];

            $registros[$usuario['rg']] = $result;
        }
        return $registros;
    }

    public function LogBloqueios()
    {
        $registros = Cache::tags('log')->remember('log:bloqueios', 1, function() {
            return $this->bloqueio->all();
        });

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

