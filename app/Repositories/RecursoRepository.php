<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Auth;
use Cache;
use App\User;
use App\Models\Sjd\Proc\Recurso;
use App\Repositories\BaseRepository;

class RecursoRepository extends BaseRepository
{
    protected $model;
    protected static $expiration = 60; 

	public function __construct(Recurso $model)
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
            $registros = Cache::remember('todos_recurso', self::$expiration, function() {
                return $this->model->all();
            });
        }
        else 
        {
            $registros = Cache::remember('todos_recurso_'.$unidade, self::$expiration, function() use ($unidade) {
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
            $registros = Cache::remember('todos_recurso'.$ano, self::$expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano','=',$ano)->get();
            });
        }
        else 
        {
            $registros = Cache::remember('todos_recurso_'.$unidade.$ano, self::$expiration, function() use ($unidade, $ano) {
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
            $registros = Cache::remember('andamento_recurso', self::$expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_recurso', '=', 'recurso.id_recurso')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::remember('andamento_recurso_'.$unidade, self::$expiration, function() use ($unidade) {
                return $this->model->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_recurso', '=', 'recurso.id_recurso')
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
            $registros = Cache::remember('andamento_recurso', self::$expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_recurso', '=', 'recurso.id_recurso')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::remember('andamento_recurso_'.$unidade, self::$expiration, function() use ($unidade, $ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_recurso', '=', 'recurso.id_recurso')
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
            $registros = Cache::remember('julgamento_recurso', self::$expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_recurso', '=', 'recurso.id_recurso')
                                ->where('envolvido.id_recurso', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','recurso'))
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::remember('julgamento_recurso_'.$unidade, self::$expiration, function() use ($unidade) {
                return $this->model->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_recurso', '=', 'recurso.id_recurso')
                                ->where('envolvido.id_recurso', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','recurso'))
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
            $registros = Cache::remember('julgamento_recurso', self::$expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_recurso', '=', 'recurso.id_recurso')
                                ->where('envolvido.id_recurso', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','recurso'))
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::remember('julgamento_recurso_'.$unidade, self::$expiration, function() use ($unidade,$ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_recurso', '=', 'recurso.id_recurso')
                                ->where('envolvido.id_recurso', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','recurso'))
                    ->get();
            });
        }
        return $registros;
    }

    public static function prazos()
    {
        //traz os dados do usuário
        $unidade = session()->get('cdopmbase');

        //verifica se o usuário tem permissão para ver todas unidades
        $verTodasUnidades = session('ver_todas_unidades');

        if($verTodasUnidades)
        {

            $registros = Cache::remember('recurso_prazo_opm', self::$expiration, function() {
                return DB::connection('sjd')->select('SELECT recurso.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_recurso=recurso.id_recurso ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_recurso=recurso.id_recurso ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis FROM recurso
                    LEFT JOIN
                    (SELECT id_recurso, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                    WHERE termino_data !=:termino_data AND id_recurso!=:id_recurso GROUP BY id_recurso ORDER BY id_recurso ASC LIMIT 1) b
                    ON b.id_recurso = recurso.id_recurso
                    LEFT JOIN envolvido ON
                        envolvido.id_recurso=recurso.id_recurso AND envolvido.situacao=:situacao AND rg_substituto=:rg_substituto', 
                        [
                            'termino_data' => '0000-00-00',
                            'id_recurso' => '',
                            'situacao' => 'Presidente',
                            'rg_substituto' => ''
                        ]); 
                    });
                    
        }
        else 
        {
                $registros = Cache::remember('recurso'.$unidade.'_prazo_topm', self::$expiration, function() use ($unidade){
                        return DB::connection('sjd')->select('SELECT recurso.id_recurso, recurso.id_andamento, recurso.id_andamentocoger, 
                        (
                            SELECT  motivo
                            FROM    sobrestamento
                            WHERE   sobrestamento.id_recurso=recurso.id_recurso 
                            ORDER BY sobrestamento.id_sobrestamento DESC
                            LIMIT 1
                        ) AS motivo,  
                        (
                            SELECT  motivo_outros
                            FROM    sobrestamento
                            WHERE   sobrestamento.id_recurso=recurso.id_recurso 
                            ORDER BY sobrestamento.id_sobrestamento DESC
                            LIMIT 1
                        ) AS motivo_outros, envolvido.cargo, envolvido.nome, cdopm, sjd_ref, sjd_ref_ano, abertura_data, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                        b.dusobrestado, 
                        (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis FROM recurso
                        LEFT JOIN
                        (SELECT id_recurso, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                            WHERE termino_data !=:termino_data AND id_recurso!=:id_recurso 
                            GROUP BY id_recurso
                            ORDER BY id_recurso ASC
                            LIMIT 1) b
                            ON b.id_recurso = recurso.id_recurso 
                            AND recurso.cdopm like :unidade%
                        LEFT JOIN envolvido ON
                            envolvido.id_recurso=recurso.id_recurso 
                            AND envolvido.situacao=:situacao 
                            AND rg_substituto=:rg_substituto
                            ', 
                            [
                                'termino_data' => '0000-00-00',
                                'id_recurso' => '',
                                'situacao' => 'Presidente',
                                'rg_substituto' => '',
                                'unidade' => $unidade
                            ]); 
    
                });   
        }
        return $registros;
    }

    public static function prazosAno($ano)
    {
        //traz os dados do usuário
        $unidade = session()->get('cdopmbase');

        //verifica se o usuário tem permissão para ver todas unidades
        $verTodasUnidades = session('ver_todas_unidades');

        if($verTodasUnidades)
        {

            $registros = Cache::remember('recurso_prazo_opm'.$ano, self::$expiration, function() use ($ano) {
                return DB::connection('sjd')->select('SELECT recurso.id_recurso, recurso.id_andamento, recurso.id_andamentocoger, 
                (SELECT  motivo FROM    sobrestamento WHERE   sobrestamento.id_recurso=recurso.id_recurso ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                (SELECT  motivo_outros FROM sobrestamento WHERE sobrestamento.id_recurso=recurso.id_recurso ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1
                ) AS motivo_outros, envolvido.cargo, envolvido.nome, cdopm, sjd_ref, sjd_ref_ano, abertura_data, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis FROM recurso
                LEFT JOIN
                (SELECT id_recurso, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento WHERE termino_data !=:termino_data AND id_recurso!=:id_recurso GROUP BY id_recurso ORDER BY id_recurso ASC LIMIT 1) b ON b.id_recurso = recurso.id_recurso
                LEFT JOIN envolvido ON envolvido.id_recurso=recurso.id_recurso AND envolvido.situacao=:situacao AND rg_substituto=:rg_substituto
                WHERE recurso.sjd_ref_ano = :ano', 
                    [
                        'termino_data' => '0000-00-00',
                        'id_recurso' => '',
                        'situacao' => 'Presidente',
                        'rg_substituto' => '',
                        'ano' => $ano
                    ]); 
                });
                    
        }
        else 
        {
            $registros = Cache::remember('recurso'.$unidade.'_prazo_topm', self::$expiration, function() use ($unidade, $ano){
                return DB::connection('sjd')->select('SELECT recurso.id_recurso, recurso.id_andamento, recurso.id_andamentocoger, 
                (
                    SELECT  motivo
                    FROM    sobrestamento
                    WHERE   sobrestamento.id_recurso=recurso.id_recurso 
                    ORDER BY sobrestamento.id_sobrestamento DESC
                    LIMIT 1
                ) AS motivo,  
                (
                    SELECT  motivo_outros
                    FROM    sobrestamento
                    WHERE   sobrestamento.id_recurso=recurso.id_recurso 
                    ORDER BY sobrestamento.id_sobrestamento DESC
                    LIMIT 1
                ) AS motivo_outros, envolvido.cargo, envolvido.nome, cdopm, sjd_ref, sjd_ref_ano, abertura_data, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                b.dusobrestado, 
                (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis FROM recurso
                LEFT JOIN
                (SELECT id_recurso, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                    WHERE termino_data !=:termino_data AND id_recurso!=:id_recurso 
                    GROUP BY id_recurso
                    ORDER BY id_recurso ASC
                    LIMIT 1) b
                    ON b.id_recurso = recurso.id_recurso 
                    AND recurso.cdopm like :unidade%
                LEFT JOIN envolvido ON
                    envolvido.id_recurso=recurso.id_recurso 
                    AND envolvido.situacao=:situacao 
                    AND rg_substituto=:rg_substituto
                    WHERE recurso.sjd_ref_ano = :ano
                    ', 
                    [
                        'termino_data' => '0000-00-00',
                        'id_recurso' => '',
                        'situacao' => 'Presidente',
                        'rg_substituto' => '',
                        'unidade' => $unidade,
                        'ano' => $ano
                    ]); 

            });   
        }
        return $registros;
    }


}

