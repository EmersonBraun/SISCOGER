<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Auth;
use Cache;
use App\User;
use App\Models\Sjd\Proc\It;
use App\Repositories\BaseRepository;

class ItRepository extends BaseRepository
{
    private $model;
    private static $expiration = 60; 

	public function __construct(It $model)
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
            $registros = Cache::remember('todos_it', self::$expiration, function() {
                return $this->model->all();
            });
        }
        else 
        {
            $registros = Cache::remember('todos_it_'.$unidade, self::$expiration, function() use ($unidade) {
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
            $registros = Cache::remember('todos_it'.$ano, self::$expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano','=',$ano)->get();
            });
        }
        else 
        {
            $registros = Cache::remember('todos_it_'.$unidade.$ano, self::$expiration, function() use ($unidade, $ano) {
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
            $registros = Cache::remember('andamento_it', self::$expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_it', '=', 'it.id_it')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::remember('andamento_it_'.$unidade, self::$expiration, function() use ($unidade) {
                return $this->model->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_it', '=', 'it.id_it')
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
            $registros = Cache::remember('andamento_it', self::$expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_it', '=', 'it.id_it')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::remember('andamento_it_'.$unidade, self::$expiration, function() use ($unidade, $ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_it', '=', 'it.id_it')
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
            $registros = Cache::remember('julgamento_it', self::$expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_it', '=', 'it.id_it')
                                ->where('envolvido.id_it', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','it'))
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::remember('julgamento_it_'.$unidade, self::$expiration, function() use ($unidade) {
                return $this->model->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_it', '=', 'it.id_it')
                                ->where('envolvido.id_it', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','it'))
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
            $registros = Cache::remember('julgamento_it', self::$expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_it', '=', 'it.id_it')
                                ->where('envolvido.id_it', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','it'))
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::remember('julgamento_it_'.$unidade, self::$expiration, function() use ($unidade,$ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_it', '=', 'it.id_it')
                                ->where('envolvido.id_it', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','it'))
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

            $registros = Cache::remember('it_prazo_opm', self::$expiration, function() {
                return DB::connection('sjd')->select('SELECT DISTINCT it.*, 
                    (SELECT  motivo FROM    sobrestamento WHERE   sobrestamento.id_it=it.id_it ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM    sobrestamento WHERE   sobrestamento.id_it=it.id_it ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis 
                    FROM it
                    LEFT JOIN
                    (SELECT id_it, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado 
                    FROM sobrestamento WHERE termino_data !=:termino_data AND id_it!=:id_it GROUP BY id_it) b ON b.id_it = it.id_it
                    LEFT JOIN envolvido ON envolvido.id_it=it.id_it AND envolvido.situacao=:situacao AND rg_substituto=:rg_substituto', 
                        [
                            'termino_data' => '0000-00-00',
                            'id_it' => '',
                            'situacao' => 'Encarregado',
                            'rg_substituto' => ''
                        ]); 
                    });
                    
        }
        else 
        {
                $registros = Cache::remember('it'.$unidade.'_prazo_topm', self::$expiration, function() use ($unidade){
                        return DB::connection('sjd')->select('SELECT DISTINCT it.*, 
                            (
                                SELECT  motivo
                                FROM    sobrestamento
                                WHERE   sobrestamento.id_it=it.id_it 
                                ORDER BY sobrestamento.id_sobrestamento DESC
                                LIMIT 1
                            ) AS motivo,  
                            (
                                SELECT  motivo_outros
                                FROM    sobrestamento
                                WHERE   sobrestamento.id_it=it.id_it 
                                ORDER BY sobrestamento.id_sobrestamento DESC
                                LIMIT 1
                            ) AS motivo_outros, 
                            envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                            b.dusobrestado, 
                            (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis 
                            FROM it
                            LEFT JOIN
                            (SELECT id_it, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado 
                            FROM sobrestamento
                                WHERE termino_data !=:termino_data AND id_it!=:id_it 
                                GROUP BY id_it) b	
                                ON b.id_it = it.id_it 
                                AND it.cdopm like :unidade%
                            LEFT JOIN envolvido ON
                                envolvido.id_it=it.id_it AND envolvido.situacao=:situacao AND rg_substituto=:rg_substituto', 
                                [
                                    'termino_data' => '0000-00-00',
                                    'id_it' => '',
                                    'situacao' => 'Encarregado',
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

            $registros = Cache::remember('it_prazo_opm'.$ano, self::$expiration, function() use ($ano) {
                return DB::connection('sjd')->select('SELECT DISTINCT it.*, 
                    (SELECT  motivo
                        FROM    sobrestamento
                        WHERE   sobrestamento.id_it=it.id_it 
                        ORDER BY sobrestamento.id_sobrestamento DESC
                        LIMIT 1
                    ) AS motivo,  
                    (
                        SELECT  motivo_outros
                        FROM    sobrestamento
                        WHERE   sobrestamento.id_it=it.id_it 
                        ORDER BY sobrestamento.id_sobrestamento DESC
                        LIMIT 1
                    ) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, 
                    (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis 
                    FROM it
                    LEFT JOIN
                    (SELECT id_it, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado 
                    FROM sobrestamento
                        WHERE termino_data !=:termino_data AND id_it!=:id_it 
                        GROUP BY id_it) b	
                        ON b.id_it = it.id_it
                    LEFT JOIN envolvido ON
                        envolvido.id_it=it.id_it AND envolvido.situacao=:situacao AND rg_substituto=:rg_substituto
                    WHERE it.sjd_ref_ano = :ano', 
                        [
                            'termino_data' => '0000-00-00',
                            'id_it' => '',
                            'situacao' => 'Encarregado',
                            'rg_substituto' => '',
                            'ano' => $ano
                        ]); 
                });
                    
        }
        else 
        {
            $registros = Cache::remember('it'.$unidade.'_prazo_topm', self::$expiration, function() use ($unidade, $ano){
                return DB::connection('sjd')->select('SELECT DISTINCT it.*, 
                    (
                        SELECT  motivo
                        FROM    sobrestamento
                        WHERE   sobrestamento.id_it=it.id_it 
                        ORDER BY sobrestamento.id_sobrestamento DESC
                        LIMIT 1
                    ) AS motivo,  
                    (
                        SELECT  motivo_outros
                        FROM    sobrestamento
                        WHERE   sobrestamento.id_it=it.id_it 
                        ORDER BY sobrestamento.id_sobrestamento DESC
                        LIMIT 1
                    ) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, 
                    (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis 
                    FROM it
                    LEFT JOIN
                    (SELECT id_it, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado 
                    FROM sobrestamento
                        WHERE termino_data !=:termino_data AND id_it!=:id_it 
                        GROUP BY id_it) b	
                        ON b.id_it = it.id_it 
                        AND it.cdopm like :unidade%
                    LEFT JOIN envolvido ON
                        envolvido.id_it=it.id_it AND envolvido.situacao=:situacao AND rg_substituto=:rg_substituto
                    WHERE sjd_ref_ano = :ano', 
                        [
                            'termino_data' => '0000-00-00',
                            'id_it' => '',
                            'situacao' => 'Encarregado',
                            'rg_substituto' => '',
                            'unidade' => $unidade,
                            'ano' => $ano
                        ]); 

            });   
        }
        return $registros;
    }


}

