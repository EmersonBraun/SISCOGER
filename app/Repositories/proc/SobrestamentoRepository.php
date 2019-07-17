<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\proc\Repositories;

use Illuminate\Support\Facades\DB;

use Cache;
use App\Models\Sjd\Proc\Sobrestamento;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Route;

class SobrestamentoRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected static $expiration = 60 * 24;//um dia 

	public function __construct(Sobrestamento $model)
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
    
    public function all()
	{
        $unidade = $this->unidade;
        $verTodasUnidades = $this->verTodasUnidades;

        if($verTodasUnidades)
        {
            $registros = Cache::tags('sobrestamento')->remember('todos_sobrestamento', self::$expiration, function() {
                return $this->model->all();
            });
        }
        else 
        {
            $registros = Cache::tags('sobrestamento')->remember('todos_sobrestamento_'.$unidade, self::$expiration, function() use ($unidade) {
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
            $registros = Cache::tags('sobrestamento')->remember('todos_sobrestamento'.$ano, self::$expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano','=',$ano)->get();
            });
        }
        else 
        {
            $registros = Cache::tags('sobrestamento')->remember('todos_sobrestamento_'.$unidade.$ano, self::$expiration, function() use ($unidade, $ano) {
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
            $registros = Cache::tags('sobrestamento')->remember('andamento_sobrestamento', self::$expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_sobrestamento', '=', 'sobrestamento.id_sobrestamento')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::tags('sobrestamento')->remember('andamento_sobrestamento_'.$unidade, self::$expiration, function() use ($unidade) {
                return $this->model->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_sobrestamento', '=', 'sobrestamento.id_sobrestamento')
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
            $registros = Cache::tags('sobrestamento')->remember('andamento_sobrestamento', self::$expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_sobrestamento', '=', 'sobrestamento.id_sobrestamento')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::tags('sobrestamento')->remember('andamento_sobrestamento_'.$unidade, self::$expiration, function() use ($unidade, $ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_sobrestamento', '=', 'sobrestamento.id_sobrestamento')
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
            $registros = Cache::tags('sobrestamento')->remember('julgamento_sobrestamento', self::$expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_sobrestamento', '=', 'sobrestamento.id_sobrestamento')
                                ->where('envolvido.id_sobrestamento', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','sobrestamento'))
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::tags('sobrestamento')->remember('julgamento_sobrestamento_'.$unidade, self::$expiration, function() use ($unidade) {
                return $this->model->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_sobrestamento', '=', 'sobrestamento.id_sobrestamento')
                                ->where('envolvido.id_sobrestamento', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','sobrestamento'))
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
            $registros = Cache::tags('sobrestamento')->remember('julgamento_sobrestamento', self::$expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_sobrestamento', '=', 'sobrestamento.id_sobrestamento')
                                ->where('envolvido.id_sobrestamento', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','sobrestamento'))
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::tags('sobrestamento')->remember('julgamento_sobrestamento_'.$unidade, self::$expiration, function() use ($unidade,$ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_sobrestamento', '=', 'sobrestamento.id_sobrestamento')
                                ->where('envolvido.id_sobrestamento', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','sobrestamento'))
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

            $registros = Cache::tags('sobrestamento')->remember('sobrestamento_prazo_opm', self::$expiration, function() {
                return $this->model
                    ->selectRaw('sobrestamento.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_sobrestamento=sobrestamento.id_sobrestamento ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_sobrestamento=sobrestamento.id_sobrestamento ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_sobrestamento, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data !=:termino_data AND id_sobrestamento!=:id_sobrestamento GROUP BY id_sobrestamento ORDER BY id_sobrestamento ASC LIMIT 1) b"),
                        'b.id_sobrestamento', '=', 'sobrestamento.id_sobrestamento')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_sobrestamento', '=', 'sobrestamento.id_sobrestamento')
                            ->where('envolvido.situacao', '=', 'Presidente')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->get();

                 
            });
                    
        }
        else 
        {
            $registros = Cache::tags('sobrestamento')->remember('sobrestamento'.$unidade.'_prazo_topm', self::$expiration, function() use ($unidade){
                return $this->model
                ->selectRaw('sobrestamento.*, 
                (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_sobrestamento=sobrestamento.id_sobrestamento ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_sobrestamento=sobrestamento.id_sobrestamento ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                ->leftJoin(
                    DB::raw("(SELECT id_sobrestamento, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                    WHERE termino_data !=:termino_data AND id_sobrestamento!=:id_sobrestamento GROUP BY id_sobrestamento ORDER BY id_sobrestamento ASC LIMIT 1) b"),
                    'b.id_sobrestamento', '=', 'sobrestamento.id_sobrestamento')
                ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_sobrestamento', '=', 'sobrestamento.id_sobrestamento')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', '');
                })
                ->where('sobrestamento.cdopm','like',$unidade.'%')
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

            $registros = Cache::tags('sobrestamento')->remember('sobrestamento_prazo_opm'.$ano, self::$expiration, function() use ($ano) {
                return $this->model
                ->selectRaw('sobrestamento.*, 
                (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_sobrestamento=sobrestamento.id_sobrestamento ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_sobrestamento=sobrestamento.id_sobrestamento ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                ->leftJoin(
                    DB::raw("(SELECT id_sobrestamento, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                    WHERE termino_data !=:termino_data AND id_sobrestamento!=:id_sobrestamento GROUP BY id_sobrestamento ORDER BY id_sobrestamento ASC LIMIT 1) b"),
                    'b.id_sobrestamento', '=', 'sobrestamento.id_sobrestamento')
                ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_sobrestamento', '=', 'sobrestamento.id_sobrestamento')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', '');
                })
                ->where('sobrestamento.sjd_ref_ano','=',$ano)
                ->get(); 
            });
                    
        }
        else 
        {
            $registros = Cache::tags('sobrestamento')->remember('sobrestamento'.$unidade.'_prazo_topm', self::$expiration, function() use ($unidade, $ano){
                return $this->model
                    ->selectRaw('sobrestamento.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_sobrestamento=sobrestamento.id_sobrestamento ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_sobrestamento=sobrestamento.id_sobrestamento ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_sobrestamento, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data !=:termino_data AND id_sobrestamento!=:id_sobrestamento GROUP BY id_sobrestamento ORDER BY id_sobrestamento ASC LIMIT 1) b"),
                        'b.id_sobrestamento', '=', 'sobrestamento.id_sobrestamento')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_sobrestamento', '=', 'sobrestamento.id_sobrestamento')
                            ->where('envolvido.situacao', '=', 'Presidente')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('sobrestamento.sjd_ref_ano','=',$ano)
                    ->where('sobrestamento.cdopm','like',$unidade.'%')
                    ->get(); 

            });   
        }
        return $registros;
    }


}
