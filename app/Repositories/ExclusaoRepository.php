<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Auth;
use Cache;
use App\User;
use App\Models\Sjd\Proc\Exclusao;
use App\Repositories\BaseRepository;

class ExclusaoRepository extends BaseRepository
{
    protected $model;
    protected static $expiration = 60; 

	public function __construct(Exclusao $model)
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
            $registros = Cache::remember('todos_exclusao', self::$expiration, function() {
                return $this->model->all();
            });
        }
        else 
        {
            $registros = Cache::remember('todos_exclusao_'.$unidade, self::$expiration, function() use ($unidade) {
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
            $registros = Cache::remember('todos_exclusao'.$ano, self::$expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano','=',$ano)->get();
            });
        }
        else 
        {
            $registros = Cache::remember('todos_exclusao_'.$unidade.$ano, self::$expiration, function() use ($unidade, $ano) {
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
            $registros = Cache::remember('andamento_exclusao', self::$expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_exclusao', '=', 'exclusao.id_exclusao')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::remember('andamento_exclusao_'.$unidade, self::$expiration, function() use ($unidade) {
                return $this->model->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_exclusao', '=', 'exclusao.id_exclusao')
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
            $registros = Cache::remember('andamento_exclusao', self::$expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_exclusao', '=', 'exclusao.id_exclusao')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::remember('andamento_exclusao_'.$unidade, self::$expiration, function() use ($unidade, $ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_exclusao', '=', 'exclusao.id_exclusao')
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
            $registros = Cache::remember('julgamento_exclusao', self::$expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_exclusao', '=', 'exclusao.id_exclusao')
                                ->where('envolvido.id_exclusao', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','exclusao'))
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::remember('julgamento_exclusao_'.$unidade, self::$expiration, function() use ($unidade) {
                return $this->model->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_exclusao', '=', 'exclusao.id_exclusao')
                                ->where('envolvido.id_exclusao', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','exclusao'))
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
            $registros = Cache::remember('julgamento_exclusao', self::$expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_exclusao', '=', 'exclusao.id_exclusao')
                                ->where('envolvido.id_exclusao', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','exclusao'))
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::remember('julgamento_exclusao_'.$unidade, self::$expiration, function() use ($unidade,$ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_exclusao', '=', 'exclusao.id_exclusao')
                                ->where('envolvido.id_exclusao', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','exclusao'))
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

            $registros = Cache::remember('exclusao_prazo_opm', self::$expiration, function() {
                return DB::connection('sjd')->select('SELECT exclusao.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_exclusao=exclusao.id_exclusao ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_exclusao=exclusao.id_exclusao ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis FROM exclusao
                    LEFT JOIN
                    (SELECT id_exclusao, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                    WHERE termino_data !=:termino_data AND id_exclusao!=:id_exclusao GROUP BY id_exclusao ORDER BY id_exclusao ASC LIMIT 1) b
                    ON b.id_exclusao = exclusao.id_exclusao
                    LEFT JOIN envolvido ON
                        envolvido.id_exclusao=exclusao.id_exclusao AND envolvido.situacao=:situacao AND rg_substituto=:rg_substituto', 
                        [
                            'termino_data' => '0000-00-00',
                            'id_exclusao' => '',
                            'situacao' => 'Presidente',
                            'rg_substituto' => ''
                        ]); 
                    });
                    
        }
        else 
        {
                $registros = Cache::remember('exclusao'.$unidade.'_prazo_topm', self::$expiration, function() use ($unidade){
                        return DB::connection('sjd')->select('SELECT exclusao.id_exclusao, exclusao.id_andamento, exclusao.id_andamentocoger, 
                        (
                            SELECT  motivo
                            FROM    sobrestamento
                            WHERE   sobrestamento.id_exclusao=exclusao.id_exclusao 
                            ORDER BY sobrestamento.id_sobrestamento DESC
                            LIMIT 1
                        ) AS motivo,  
                        (
                            SELECT  motivo_outros
                            FROM    sobrestamento
                            WHERE   sobrestamento.id_exclusao=exclusao.id_exclusao 
                            ORDER BY sobrestamento.id_sobrestamento DESC
                            LIMIT 1
                        ) AS motivo_outros, envolvido.cargo, envolvido.nome, cdopm, sjd_ref, sjd_ref_ano, abertura_data, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                        b.dusobrestado, 
                        (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis FROM exclusao
                        LEFT JOIN
                        (SELECT id_exclusao, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                            WHERE termino_data !=:termino_data AND id_exclusao!=:id_exclusao 
                            GROUP BY id_exclusao
                            ORDER BY id_exclusao ASC
                            LIMIT 1) b
                            ON b.id_exclusao = exclusao.id_exclusao 
                            AND exclusao.cdopm like :unidade%
                        LEFT JOIN envolvido ON
                            envolvido.id_exclusao=exclusao.id_exclusao 
                            AND envolvido.situacao=:situacao 
                            AND rg_substituto=:rg_substituto
                            ', 
                            [
                                'termino_data' => '0000-00-00',
                                'id_exclusao' => '',
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

            $registros = Cache::remember('exclusao_prazo_opm'.$ano, self::$expiration, function() use ($ano) {
                return DB::connection('sjd')->select('SELECT exclusao.id_exclusao, exclusao.id_andamento, exclusao.id_andamentocoger, 
                (SELECT  motivo FROM    sobrestamento WHERE   sobrestamento.id_exclusao=exclusao.id_exclusao ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                (SELECT  motivo_outros FROM sobrestamento WHERE sobrestamento.id_exclusao=exclusao.id_exclusao ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1
                ) AS motivo_outros, envolvido.cargo, envolvido.nome, cdopm, sjd_ref, sjd_ref_ano, abertura_data, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis FROM exclusao
                LEFT JOIN
                (SELECT id_exclusao, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento WHERE termino_data !=:termino_data AND id_exclusao!=:id_exclusao GROUP BY id_exclusao ORDER BY id_exclusao ASC LIMIT 1) b ON b.id_exclusao = exclusao.id_exclusao
                LEFT JOIN envolvido ON envolvido.id_exclusao=exclusao.id_exclusao AND envolvido.situacao=:situacao AND rg_substituto=:rg_substituto
                WHERE exclusao.sjd_ref_ano = :ano', 
                    [
                        'termino_data' => '0000-00-00',
                        'id_exclusao' => '',
                        'situacao' => 'Presidente',
                        'rg_substituto' => '',
                        'ano' => $ano
                    ]); 
                });
                    
        }
        else 
        {
            $registros = Cache::remember('exclusao'.$unidade.'_prazo_topm', self::$expiration, function() use ($unidade, $ano){
                return DB::connection('sjd')->select('SELECT exclusao.id_exclusao, exclusao.id_andamento, exclusao.id_andamentocoger, 
                (
                    SELECT  motivo
                    FROM    sobrestamento
                    WHERE   sobrestamento.id_exclusao=exclusao.id_exclusao 
                    ORDER BY sobrestamento.id_sobrestamento DESC
                    LIMIT 1
                ) AS motivo,  
                (
                    SELECT  motivo_outros
                    FROM    sobrestamento
                    WHERE   sobrestamento.id_exclusao=exclusao.id_exclusao 
                    ORDER BY sobrestamento.id_sobrestamento DESC
                    LIMIT 1
                ) AS motivo_outros, envolvido.cargo, envolvido.nome, cdopm, sjd_ref, sjd_ref_ano, abertura_data, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                b.dusobrestado, 
                (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis FROM exclusao
                LEFT JOIN
                (SELECT id_exclusao, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                    WHERE termino_data !=:termino_data AND id_exclusao!=:id_exclusao 
                    GROUP BY id_exclusao
                    ORDER BY id_exclusao ASC
                    LIMIT 1) b
                    ON b.id_exclusao = exclusao.id_exclusao 
                    AND exclusao.cdopm like :unidade%
                LEFT JOIN envolvido ON
                    envolvido.id_exclusao=exclusao.id_exclusao 
                    AND envolvido.situacao=:situacao 
                    AND rg_substituto=:rg_substituto
                    WHERE exclusao.sjd_ref_ano = :ano
                    ', 
                    [
                        'termino_data' => '0000-00-00',
                        'id_exclusao' => '',
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

