<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Auth;
use Cache;
use App\User;
use App\Models\Sjd\Proc\Sindicancia;
use App\Repositories\BaseRepository;

class SindicanciaRepository extends BaseRepository
{
    protected $model;
    protected static $expiration = 60; 

	public function __construct(Sindicancia $model)
	{
		$this->model = $model;
    }
    
    public function all()
	{
        $unidade = session('cdopmbase');
        //verifica se o usuário tem permissão para ver todas unidades
        $verTodasUnidades = session('ver_todas_unidades');

        if($verTodasUnidades)
        {
            $registros = Cache::remember('todos_sindicancia', self::$expiration, function() {
                return $this->model->all();
            });
        }
        else 
        {
            $registros = Cache::remember('todos_sindicancia_'.$unidade, self::$expiration, function() use ($unidade) {
                return $this->model->where('cdopm','like',$unidade.'%')->get();
            });
        }

        return $registros;
    } 

    public function ano($ano)
	{
        $unidade = session('cdopmbase');
        //verifica se o usuário tem permissão para ver todas unidades
        $verTodasUnidades = session('ver_todas_unidades');

        if($verTodasUnidades)
        {
            $registros = Cache::remember('todos_sindicancia'.$ano, self::$expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano','=',$ano)->get();
            });
        }
        else 
        {
            $registros = Cache::remember('todos_sindicancia_'.$unidade.$ano, self::$expiration, function() use ($unidade, $ano) {
                return $this->model->where('cdopm','like',$unidade.'%')->where('sjd_ref_ano','=',$ano)->get();
            });
        }
        return $registros;
    } 

    public function andamento()
	{
        $unidade = session('cdopmbase');
        //verifica se o usuário tem permissão para ver todas unidades
        $verTodasUnidades = session('ver_todas_unidades');

        if($verTodasUnidades)
        {
            $registros = Cache::remember('andamento_sindicancia', self::$expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_sindicancia', '=', 'sindicancia.id_sindicancia')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::remember('andamento_sindicancia_'.$unidade, self::$expiration, function() use ($unidade) {
                return $this->model->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_sindicancia', '=', 'sindicancia.id_sindicancia')
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
        //verifica se o usuário tem permissão para ver todas unidades
        $verTodasUnidades = session('ver_todas_unidades');

        if($verTodasUnidades)
        {
            $registros = Cache::remember('andamento_sindicancia', self::$expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_sindicancia', '=', 'sindicancia.id_sindicancia')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::remember('andamento_sindicancia_'.$unidade, self::$expiration, function() use ($unidade, $ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_sindicancia', '=', 'sindicancia.id_sindicancia')
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
        //verifica se o usuário tem permissão para ver todas unidades
        $verTodasUnidades = session('ver_todas_unidades');

        if($verTodasUnidades)
        {
            $registros = Cache::remember('julgamento_sindicancia', self::$expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_sindicancia', '=', 'sindicancia.id_sindicancia')
                                ->where('envolvido.id_sindicancia', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','sindicancia'))
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::remember('julgamento_sindicancia_'.$unidade, self::$expiration, function() use ($unidade) {
                return $this->model->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_sindicancia', '=', 'sindicancia.id_sindicancia')
                                ->where('envolvido.id_sindicancia', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','sindicancia'))
                    ->get();
            });
        }
        return $registros;
    }

    public function julgamentoAno($ano)
	{
        $unidade = session('cdopmbase');
        //verifica se o usuário tem permissão para ver todas unidades
        $verTodasUnidades = session('ver_todas_unidades');

        if($verTodasUnidades)
        {
            $registros = Cache::remember('julgamento_sindicancia', self::$expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_sindicancia', '=', 'sindicancia.id_sindicancia')
                                ->where('envolvido.id_sindicancia', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','sindicancia'))
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::remember('julgamento_sindicancia_'.$unidade, self::$expiration, function() use ($unidade,$ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_sindicancia', '=', 'sindicancia.id_sindicancia')
                                ->where('envolvido.id_sindicancia', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','sindicancia'))
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

            $registros = Cache::remember('sindicancia_prazo_opm', self::$expiration, function() {
                return $this->model
                    ->selectRaw('sindicancia.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_sindicancia=sindicancia.id_sindicancia ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_sindicancia=sindicancia.id_sindicancia ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_sindicancia, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data !=:termino_data AND id_sindicancia!=:id_sindicancia GROUP BY id_sindicancia ORDER BY id_sindicancia ASC LIMIT 1) b"),
                        'b.id_sindicancia', '=', 'sindicancia.id_sindicancia')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_sindicancia', '=', 'sindicancia.id_sindicancia')
                            ->where('envolvido.situacao', '=', 'Presidente')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->get();
            });
                    
        }
        else 
        {
            $registros = Cache::remember('sindicancia'.$unidade.'_prazo_topm', self::$expiration, function() use ($unidade){
                return $this->model
                ->selectRaw('sindicancia.*, 
                (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_sindicancia=sindicancia.id_sindicancia ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_sindicancia=sindicancia.id_sindicancia ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                ->leftJoin(
                    DB::raw("(SELECT id_sindicancia, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                    WHERE termino_data !=:termino_data AND id_sindicancia!=:id_sindicancia GROUP BY id_sindicancia ORDER BY id_sindicancia ASC LIMIT 1) b"),
                    'b.id_sindicancia', '=', 'sindicancia.id_sindicancia')
                ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_sindicancia', '=', 'sindicancia.id_sindicancia')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', '');
                })
                ->where('sindicancia.cdopm','like',$unidade.'%')
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

            $registros = Cache::remember('sindicancia_prazo_opm'.$ano, self::$expiration, function() use ($ano) {
                return $this->model
                    ->selectRaw('sindicancia.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_sindicancia=sindicancia.id_sindicancia ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_sindicancia=sindicancia.id_sindicancia ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_sindicancia, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data !=:termino_data AND id_sindicancia!=:id_sindicancia GROUP BY id_sindicancia ORDER BY id_sindicancia ASC LIMIT 1) b"),
                        'b.id_sindicancia', '=', 'sindicancia.id_sindicancia')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_sindicancia', '=', 'sindicancia.id_sindicancia')
                            ->where('envolvido.situacao', '=', 'Presidente')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('sindicancia.sjd_ref_ano','=',$ano)
                    ->get(); 
                });
                    
        }
        else 
        {
            $registros = Cache::remember('sindicancia'.$unidade.'_prazo_topm', self::$expiration, function() use ($unidade, $ano){
                return $this->model
                    ->selectRaw('sindicancia.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_sindicancia=sindicancia.id_sindicancia ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_sindicancia=sindicancia.id_sindicancia ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_sindicancia, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data !=:termino_data AND id_sindicancia!=:id_sindicancia GROUP BY id_sindicancia ORDER BY id_sindicancia ASC LIMIT 1) b"),
                        'b.id_sindicancia', '=', 'sindicancia.id_sindicancia')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_sindicancia', '=', 'sindicancia.id_sindicancia')
                            ->where('envolvido.situacao', '=', 'Presidente')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('sindicancia.sjd_ref_ano','=',$ano)
                    ->where('sindicancia.cdopm','like',$unidade.'%')
                    ->get(); 

            });   
        }
        return $registros;
    }


}

