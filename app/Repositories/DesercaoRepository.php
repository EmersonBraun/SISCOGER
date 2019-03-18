<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Auth;
use Cache;
use App\User;
use App\Models\Sjd\Proc\Desercao;
use App\Repositories\BaseRepository;

class DesercaoRepository extends BaseRepository
{
    protected $model;
    protected static $expiration = 60; 

	public function __construct(Desercao $model)
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
            $registros = Cache::remember('todos_desercao', self::$expiration, function() {
                return $this->model->join('envolvido', 'desercao.id_desercao', '=', 'envolvido.id_desercao')->get();
            });
        }
        else 
        {
            $registros = Cache::remember('todos_desercao_'.$unidade, self::$expiration, function() use ($unidade) {
                return $this->model->where('cdopm','like',$unidade.'%')->join('envolvido', 'desercao.id_desercao', '=', 'envolvido.id_desercao')->get();
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
            $registros = Cache::remember('todos_desercao'.$ano, self::$expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano','=',$ano)
                ->join('envolvido', 'desercao.id_desercao', '=', 'envolvido.id_desercao')->get();
            });
        }
        else 
        {
            $registros = Cache::remember('todos_desercao_'.$unidade.$ano, self::$expiration, function() use ($unidade, $ano) {
                return $this->model->where('cdopm','like',$unidade.'%')->where('sjd_ref_ano','=',$ano)
                ->join('envolvido', 'desercao.id_desercao', '=', 'envolvido.id_desercao')->get();
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
            $registros = Cache::remember('andamento_desercao', self::$expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_desercao', '=', 'desercao.id_desercao')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::remember('andamento_desercao_'.$unidade, self::$expiration, function() use ($unidade) {
                return $this->model->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_desercao', '=', 'desercao.id_desercao')
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
            $registros = Cache::remember('andamento_desercao', self::$expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_desercao', '=', 'desercao.id_desercao')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::remember('andamento_desercao_'.$unidade, self::$expiration, function() use ($unidade, $ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_desercao', '=', 'desercao.id_desercao')
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
            $registros = Cache::remember('julgamento_desercao', self::$expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_desercao', '=', 'desercao.id_desercao')
                                ->where('envolvido.id_desercao', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','desercao'))
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::remember('julgamento_desercao_'.$unidade, self::$expiration, function() use ($unidade) {
                return $this->model->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_desercao', '=', 'desercao.id_desercao')
                                ->where('envolvido.id_desercao', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','desercao'))
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
            $registros = Cache::remember('julgamento_desercao', self::$expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_desercao', '=', 'desercao.id_desercao')
                                ->where('envolvido.id_desercao', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','desercao'))
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::remember('julgamento_desercao_'.$unidade, self::$expiration, function() use ($unidade,$ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_desercao', '=', 'desercao.id_desercao')
                                ->where('envolvido.id_desercao', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','desercao'))
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

            $registros = Cache::remember('desercao_prazo_opm', self::$expiration, function() {
                return $this->model
                    ->selectRaw('desercao.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_desercao=desercao.id_desercao ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_desercao=desercao.id_desercao ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_desercao, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_desercao != '' GROUP BY id_desercao ORDER BY sobrestamento.id_desercao ASC LIMIT 1) b"),
                        'b.id_desercao', '=', 'desercao.id_desercao')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_desercao', '=', 'desercao.id_desercao')
                            ->where('envolvido.situacao', '=', 'Presidente')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->get();              
        }
        else 
        {
            $registros = Cache::remember('desercao'.$unidade.'_prazo_topm', self::$expiration, function() use ($unidade){
                return $this->model
                ->selectRaw('desercao.*, 
                (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_desercao=desercao.id_desercao ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_desercao=desercao.id_desercao ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                ->leftJoin(
                    DB::raw("(SELECT id_desercao, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                    WHERE termino_data != '0000-00-00' AND id_desercao != '' GROUP BY id_desercao ORDER BY sobrestamento.id_desercao ASC LIMIT 1) b"),
                    'b.id_desercao', '=', 'desercao.id_desercao')
                ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_desercao', '=', 'desercao.id_desercao')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', '');
                })
                ->where('adl.cdopm','=',$unidade)
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

            return $this->model
                ->selectRaw('desercao.*, 
                (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_desercao=desercao.id_desercao ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_desercao=desercao.id_desercao ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                ->leftJoin(
                    DB::raw("(SELECT id_desercao, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                    WHERE termino_data != '0000-00-00' AND id_desercao != '' GROUP BY id_desercao ORDER BY sobrestamento.id_desercao ASC LIMIT 1) b"),
                    'b.id_desercao', '=', 'desercao.id_desercao')
                ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_desercao', '=', 'desercao.id_desercao')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', '');
                })
                ->where('adl.sjd_ref_ano','=',$ano)
                ->get();         
        }
        else 
        {
            $registros = Cache::remember('desercao'.$unidade.'_prazo_topm', self::$expiration, function() use ($unidade, $ano){
                return $this->model
                    ->selectRaw('desercao.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_desercao=desercao.id_desercao ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_desercao=desercao.id_desercao ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_desercao, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_desercao != '' GROUP BY id_desercao ORDER BY sobrestamento.id_desercao ASC LIMIT 1) b"),
                        'b.id_desercao', '=', 'desercao.id_desercao')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_desercao', '=', 'desercao.id_desercao')
                            ->where('envolvido.situacao', '=', 'Presidente')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('adl.sjd_ref_ano','=',$ano)
                    ->where('adl.cdopm','=',$unidade)
                    ->get(); 

            });   
        }
        return $registros;
    }


}

