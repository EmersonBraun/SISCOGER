<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\proc;

use Illuminate\Support\Facades\DB;

use Cache;
use App\Models\Sjd\Proc\Adl;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Route;

class AdllRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected static $expiration = 60 * 24;//um dia; 

	public function __construct(Adl $model)
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

    public function cleanCache()
	{
        Cache::tags('adl')->flush();
    }
    
    public function all()
	{
        $unidade = session('cdopmbase');
        $verTodasUnidades = session('ver_todas_unidades');

        if($verTodasUnidades)
        {
            $registros = Cache::tags('adl')->remember('todos_adl', self::$expiration, function() {
                return $this->model->all();
            });
        }
        else 
        {
            $registros = Cache::tags('adl')->remember('todos_adl:'.$unidade, self::$expiration, function() use ($unidade) {
                return $this->model->where('cdopm','like',$unidade.'%')->get();
            });
        }

        return $registros;
    } 

    public function ano($ano)
	{
        $unidade = session('cdopmbase');
        $verTodasUnidades = session('ver_todas_unidades');
        

        if($verTodasUnidades)
        {
            $registros = Cache::tags('adl')->remember('todos_adl:'.$ano, self::$expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano','=',$ano)->get();
            });
        }
        else 
        {
            $registros = Cache::tags('adl')->remember('todos_adl:'.$ano.':'.$unidade, self::$expiration, function() use ($unidade, $ano) {
                return $this->model->where('cdopm','like',$unidade.'%')->where('sjd_ref_ano','=',$ano)->get();
            });
        }
        return $registros;
    } 

    public function andamento()
	{
        $unidade = session('cdopmbase');
        $verTodasUnidades = session('ver_todas_unidades');

        if($verTodasUnidades)
        {
            $registros = Cache::tags('adl')->remember('andamento_adl', self::$expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_adl', '=', 'adl.id_adl')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::tags('adl')->remember('andamento_adl:'.$unidade, self::$expiration, function() use ($unidade) {
                return $this->model->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_adl', '=', 'adl.id_adl')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        return $registros;
    }
   
    public function andamentoAno($ano)
	{
        $unidade = session('cdopmbase');
        $verTodasUnidades = session('ver_todas_unidades');
        

        if($verTodasUnidades)
        {
            $registros = Cache::tags('adl')->remember('andamento_adl:'.$ano, self::$expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_adl', '=', 'adl.id_adl')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::tags('adl')->remember('andamento_adl:'.$ano.':'.$unidade, self::$expiration, function() use ($unidade, $ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_adl', '=', 'adl.id_adl')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        return $registros;
    }

    public function julgamento()
	{
        $unidade = session('cdopmbase');
        $verTodasUnidades = session('ver_todas_unidades');
        

        if($verTodasUnidades)
        {
            $registros = Cache::tags('adl')->remember('julgamento_adl', self::$expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_adl', '=', 'adl.id_adl')
                                ->where('envolvido.id_adl', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','adl'))
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::tags('adl')->remember('julgamento_adl:'.$unidade, self::$expiration, function() use ($unidade) {
                return $this->model
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_adl', '=', 'adl.id_adl')
                                ->where('envolvido.id_adl', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','adl'))
                    ->where('cdopm','like',$unidade.'%')
                    ->get();
            });
        }
        return $registros;
    }

    public function julgamentoAno($ano)
	{
        $unidade = session('cdopmbase');
        $verTodasUnidades = session('ver_todas_unidades');
        

        if($verTodasUnidades)
        {
            $registros = Cache::tags('adl')->remember('julgamento_adl:'.$ano, self::$expiration, function() use ($ano){
                return $this->model
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_adl', '=', 'adl.id_adl')
                                ->where('envolvido.id_adl', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','adl'))
                    ->where('sjd_ref_ano', '=' ,$ano)
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::tags('adl')->remember('julgamento_adl:'.$ano.':'.$unidade, self::$expiration, function() use ($unidade,$ano) {
                return $this->model
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_adl', '=', 'adl.id_adl')
                                ->where('envolvido.id_adl', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','adl'))
                    ->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$unidade.'%')
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
            $registros = Cache::tags('adl')->remember('prazo_adl', self::$expiration, function() {
                
                return $this->model
                    ->selectRaw('adl.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_adl=adl.id_adl ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_adl=adl.id_adl ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_adl, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_adl != '' GROUP BY id_adl ORDER BY sobrestamento.id_adl ASC LIMIT 1) b"),
                        'b.id_adl', '=', 'adl.id_adl')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_adl', '=', 'adl.id_adl')
                            ->where('envolvido.situacao', '=', 'Presidente')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->get();
            });
                    
        }
        else 
        {
            $registros = Cache::tags('adl')->remember('prazo_adl:'.$unidade, self::$expiration, function() use ($unidade){
                return $this->model
                ->selectRaw('adl.*, 
                (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_adl=adl.id_adl ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_adl=adl.id_adl ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                ->leftJoin(
                    DB::raw("(SELECT id_adl, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                    WHERE termino_data != '0000-00-00' AND id_adl != '' GROUP BY id_adl ORDER BY sobrestamento.id_adl ASC LIMIT 1) b"),
                    'b.id_adl', '=', 'adl.id_adl')
                ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_adl', '=', 'adl.id_adl')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', '');
                })
                ->where('adl.cdopm','like',$unidade.'%')
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
            $registros = Cache::tags('adl')->remember('prazo_adl:'.$ano, self::$expiration, function() use ($ano){
                
                return $this->model
                    ->selectRaw('adl.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_adl=adl.id_adl ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_adl=adl.id_adl ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_adl, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_adl != '' GROUP BY id_adl ORDER BY sobrestamento.id_adl ASC LIMIT 1) b"),
                        'b.id_adl', '=', 'adl.id_adl')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_adl', '=', 'adl.id_adl')
                            ->where('envolvido.situacao', '=', 'Presidente')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('adl.sjd_ref_ano','=',$ano)
                    ->get();

            });             
        }
        else 
        {
            $registros = Cache::tags('adl')->remember('prazo_adl:'.$ano.':'.$unidade, self::$expiration, function() use ($unidade, $ano){
                return $this->model
                    ->selectRaw('adl.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_adl=adl.id_adl ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_adl=adl.id_adl ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_adl, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_adl != '' GROUP BY id_adl ORDER BY sobrestamento.id_adl ASC LIMIT 1) b"),
                        'b.id_adl', '=', 'adl.id_adl')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_adl', '=', 'adl.id_adl')
                            ->where('envolvido.situacao', '=', 'Presidente')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('adl.sjd_ref_ano','=',$ano)
                    ->where('adl.cdopm','like',$unidade.'%')
                    ->get();

            });   
        }
        return $registros;
    }

}

