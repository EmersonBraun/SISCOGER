<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Auth;
use Cache;
use App\User;
use App\Models\Sjd\Proc\Pj;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Route;

class PjRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected static $expiration = 60 * 24;//um dia  

	public function __construct(Pj $model)
	{
		$this->model = $model;
        
        // ver se vem da api (não logada)
        $proc = Route::currentRouteName(); //listar.algo
        $proc = explode ('.', $proc); //divide em [0] -> listar e [1]-> algo
        $proc = $proc[0];

        $isapi = ($proc == 'api') ? 1 : 0;
        $verTodasUnidades = session('ver_todas_unidades');

        $this->verTodasUnidades = ($verTodasUnidades || $isapi) ? 1 : 0;
        $this->unidade = ($isapi) ? '0' : session('cdopmbase');
    }

    public static function cleanCache()
	{
        Cache::tags('pj')->flush();
    }
    
    public function all()
	{
        $unidade = $this->unidade;
        $verTodasUnidades = $this->verTodasUnidades;

        if($verTodasUnidades)
        {
            $registros = Cache::tags('pj')->remember('todos_pj', self::$expiration, function() {
                return $this->model->all();
            });
        }
        else 
        {
            $registros = Cache::tags('pj')->remember('todos_pj:'.$unidade, self::$expiration, function() use ($unidade) {
                return $this->model->where('cdopm','like',$unidade.'%')->get();
            });
        }

        return $registros;
    } 

    public function ano($ano)
	{
        $unidade = $this->unidade;
        $verTodasUnidades = $this->verTodasUnidades;

        if($verTodasUnidades)
        {
            $registros = Cache::tags('pj')->remember('todos_pj:'.$ano, self::$expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano','=',$ano)->get();
            });
        }
        else 
        {
            $registros = Cache::tags('pj')->remember('todos_pj:'.$ano.':'.$unidade, self::$expiration, function() use ($unidade, $ano) {
                return $this->model->where('cdopm','like',$unidade.'%')->where('sjd_ref_ano','=',$ano)->get();
            });
        }
        return $registros;
    } 

    public function andamento()
	{
        $unidade = $this->unidade;
        $verTodasUnidades = $this->verTodasUnidades;

        if($verTodasUnidades)
        {
            $registros = Cache::tags('pj')->remember('andamento_pj', self::$expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_pj', '=', 'pj.id_pj')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::tags('pj')->remember('andamento_pj:'.$unidade, self::$expiration, function() use ($unidade) {
                return $this->model->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_pj', '=', 'pj.id_pj')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        return $registros;
    }

    public function andamentoAno($ano)
	{
        $unidade = $this->unidade;
        $verTodasUnidades = $this->verTodasUnidades;

        if($verTodasUnidades)
        {
            $registros = Cache::tags('pj')->remember('andamento_pj:'.$ano, self::$expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_pj', '=', 'pj.id_pj')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::tags('pj')->remember('andamento_pj:'.$ano.':'.$unidade, self::$expiration, function() use ($unidade, $ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_pj', '=', 'pj.id_pj')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        return $registros;
    }

    public function julgamento()
	{
        $unidade = $this->unidade;
        $verTodasUnidades = $this->verTodasUnidades;

        if($verTodasUnidades)
        {
            $registros = Cache::tags('pj')->remember('julgamento_pj', self::$expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_pj', '=', 'pj.id_pj')
                                ->where('envolvido.id_pj', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','pj'))
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::tags('pj')->remember('julgamento_pj:'.$unidade, self::$expiration, function() use ($unidade) {
                return $this->model->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_pj', '=', 'pj.id_pj')
                                ->where('envolvido.id_pj', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','pj'))
                    ->get();
            });
        }
        return $registros;
    }

    public function julgamentoAno($ano)
	{
        $unidade = $this->unidade;
        $verTodasUnidades = $this->verTodasUnidades;

        if($verTodasUnidades)
        {
            $registros = Cache::tags('pj')->remember('julgamento_pj:'.$ano, self::$expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_pj', '=', 'pj.id_pj')
                                ->where('envolvido.id_pj', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','pj'))
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::tags('pj')->remember('julgamento_pj:'.$ano.':'.$unidade, self::$expiration, function() use ($unidade,$ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_pj', '=', 'pj.id_pj')
                                ->where('envolvido.id_pj', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','pj'))
                    ->get();
            });
        }
        return $registros;
    }

    public function prazos()
    {
        //traz os dados do usuário
        $unidade = session()->get('cdopmbase');

        //verifica se o usuário tem permissão para ver todas unidades
        $verTodasUnidades = session('ver_todas_unidades');

        if($verTodasUnidades)
        {

            $registros = Cache::tags('pj')->remember('prazo_pj', self::$expiration, function() {
                return $this->model
                    ->selectRaw('pj.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_pj=pj.id_pj ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_pj=pj.id_pj ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_pj, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data !=:termino_data AND id_pj!=:id_pj GROUP BY id_pj ORDER BY id_pj ASC LIMIT 1) b"),
                        'b.id_pj', '=', 'pj.id_pj')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_pj', '=', 'pj.id_pj')
                            ->where('envolvido.situacao', '=', 'Presidente')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->get();
            });
                    
        }
        else 
        {
            $registros = Cache::tags('pj')->remember('prazo_pj:'.$unidade, self::$expiration, function() use ($unidade){
                return $this->model
                ->selectRaw('pj.*, 
                (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_pj=pj.id_pj ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_pj=pj.id_pj ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                ->leftJoin(
                    DB::raw("(SELECT id_pj, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                    WHERE termino_data !=:termino_data AND id_pj!=:id_pj GROUP BY id_pj ORDER BY id_pj ASC LIMIT 1) b"),
                    'b.id_pj', '=', 'pj.id_pj')
                ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_pj', '=', 'pj.id_pj')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', '');
                })
                ->where('pj.cdopm','like',$unidade.'%')
                ->get(); 

            });   
        }
        return $registros;
    }

    public function prazosAno($ano)
    {
        //traz os dados do usuário
        $unidade = session()->get('cdopmbase');

        //verifica se o usuário tem permissão para ver todas unidades
        $verTodasUnidades = session('ver_todas_unidades');

        if($verTodasUnidades)
        {

            $registros = Cache::tags('pj')->remember('prazo_pj:'.$ano, self::$expiration, function() use ($ano) {
                return $this->model
                ->selectRaw('pj.*, 
                (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_pj=pj.id_pj ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_pj=pj.id_pj ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                ->leftJoin(
                    DB::raw("(SELECT id_pj, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                    WHERE termino_data !=:termino_data AND id_pj!=:id_pj GROUP BY id_pj ORDER BY id_pj ASC LIMIT 1) b"),
                    'b.id_pj', '=', 'pj.id_pj')
                ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_pj', '=', 'pj.id_pj')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', '');
                })
                ->where('pj.sjd_ref_ano','=',$ano)
                ->get(); 
            });
                    
        }
        else 
        {
            $registros = Cache::tags('pj')->remember('prazo_pj:'.$ano.':'.$unidade, self::$expiration, function() use ($unidade, $ano){
                return $this->model
                    ->selectRaw('pj.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_pj=pj.id_pj ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_pj=pj.id_pj ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_pj, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data !=:termino_data AND id_pj!=:id_pj GROUP BY id_pj ORDER BY id_pj ASC LIMIT 1) b"),
                        'b.id_pj', '=', 'pj.id_pj')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_pj', '=', 'pj.id_pj')
                            ->where('envolvido.situacao', '=', 'Presidente')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('pj.sjd_ref_ano','=',$ano)
                    ->where('pj.cdopm','like',$unidade.'%')
                    ->get(); 

            });   
        }
        return $registros;
    }


}

