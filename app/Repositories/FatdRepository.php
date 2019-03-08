<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Auth;
use Cache;
use App\User;
use App\Models\Sjd\Proc\Fatd;
use App\Repositories\BaseRepository;

class FatdRepository extends BaseRepository
{
    protected $model;
    protected static $expiration = 60; 

	public function __construct(Fatd $model)
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
            $registros = Cache::remember('todos_fatd', self::$expiration, function() {
                return $this->model->all();
            });
        }
        else 
        {
            $registros = Cache::remember('todos_fatd_'.$unidade, self::$expiration, function() use ($unidade) {
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
            $registros = Cache::remember('todos_fatd'.$ano, self::$expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano','=',$ano)->get();
            });
        }
        else 
        {
            $registros = Cache::remember('todos_fatd_'.$unidade.$ano, self::$expiration, function() use ($unidade, $ano) {
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
            $registros = Cache::remember('andamento_fatd', self::$expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_fatd', '=', 'fatd.id_fatd')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::remember('andamento_fatd_'.$unidade, self::$expiration, function() use ($unidade) {
                return $this->model->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_fatd', '=', 'fatd.id_fatd')
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
            $registros = Cache::remember('andamento_fatd', self::$expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_fatd', '=', 'fatd.id_fatd')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::remember('andamento_fatd_'.$unidade, self::$expiration, function() use ($unidade, $ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_fatd', '=', 'fatd.id_fatd')
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
            $registros = Cache::remember('julgamento_fatd', self::$expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_fatd', '=', 'fatd.id_fatd')
                                ->where('envolvido.id_fatd', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','fatd'))
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::remember('julgamento_fatd_'.$unidade, self::$expiration, function() use ($unidade) {
                return $this->model->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_fatd', '=', 'fatd.id_fatd')
                                ->where('envolvido.id_fatd', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','fatd'))
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
            $registros = Cache::remember('julgamento_fatd', self::$expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_fatd', '=', 'fatd.id_fatd')
                                ->where('envolvido.id_fatd', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','fatd'))
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::remember('julgamento_fatd_'.$unidade, self::$expiration, function() use ($unidade,$ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_fatd', '=', 'fatd.id_fatd')
                                ->where('envolvido.id_fatd', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','fatd'))
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

            $registros = Cache::remember('fatd_prazo_opm', self::$expiration, function() {
                return DB::connection('sjd')->select('SELECT DISTINCT fatd.*,
                (SELECT  motivo FROM    sobrestamento WHERE   sobrestamento.id_fatd=fatd.id_fatd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                (SELECT  motivo_outros FROM    sobrestamento WHERE sobrestamento.id_cj=cj.id_cj ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros,
                envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW()))+1 AS dutotal, 
                b.dusobrestado, 
                (dias_uteis(abertura_data,DATE(NOW()))+1-IFNULL(b.dusobrestado,0)) AS diasuteis FROM fatd
                LEFT JOIN
                (SELECT id_fatd, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                    WHERE termino_data != :termino_data AND id_fatd!= :id_fatd GROUP BY id_fatd) b ON b.id_fatd = fatd.id_fatd
                LEFT JOIN envolvido ON
                    envolvido.id_fatd=fatd.id_fatd AND envolvido.situacao = :situacao AND rg_substituto = :rg_substituto ORDER BY id_fatd DESC', 
                    [
                        'termino_data' => '0000-00-00',
                        'id_fatd' => '',
                        'situacao' => 'Encarregado',
                        'rg_substituto' => '',
                        'id_andamento' => '1'
                    ]); 
                });
                    
        }
        else 
        {
            $registros = Cache::remember('fatd'.$unidade.'_prazo_topm', self::$expiration, function() use ($unidade){
                    return DB::connection('sjd')->select('SELECT * FROM
                    (SELECT fatd.*, envolvido.cargo, envolvido.nome, 
                        dias_uteis(abertura_data,DATE(NOW()))+1 AS dutotal,b.dusobrestado,
                        (dias_uteis(abertura_data,DATE(NOW()))+1-IFNULL(b.dusobrestado,0)) AS diasuteis 
                        FROM fatd
                        LEFT JOIN
                        (SELECT id_fatd, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado 
                        FROM sobrestamento
                            WHERE termino_data != :termino_data AND id_fatd != :id_fatd
                            GROUP BY id_fatd) b
                            ON b.id_fatd = fatd.id_fatd
                        LEFT JOIN envolvido ON
                            envolvido.id_fatd = fatd.id_fatd 
                            AND envolvido.situacao = :situacao 
                            AND rg_substituto = :rg_substituto
                        WHERE fatd.id_andamento = :id_andamento
                        AND fatd.cdopm like :unidade%) 
                        AS dt WHERE dt.diasuteis > :diasuteis', 
                        [
                            'termino_data' => '0000-00-00',
                            'id_fatd' => '',
                            'situacao' => 'Encarregado',
                            'rg_substituto' => '',
                            'id_andamento' => '1',
                            'diasuteis' => '30',
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

            $registros = Cache::remember('fatd_prazo_opm'.$ano, self::$expiration, function() use ($ano) {
                return DB::connection('sjd')->select('SELECT DISTINCT fatd.*,
                (SELECT  motivo FROM    sobrestamento WHERE   sobrestamento.id_fatd=fatd.id_fatd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                (SELECT  motivo_outros FROM    sobrestamento WHERE sobrestamento.id_cj=cj.id_cj ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros,
                envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW()))+1 AS dutotal, 
                b.dusobrestado, 
                (dias_uteis(abertura_data,DATE(NOW()))+1-IFNULL(b.dusobrestado,0)) AS diasuteis FROM fatd
                LEFT JOIN
                (SELECT id_fatd, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                    WHERE termino_data != :termino_data AND id_fatd!= :id_fatd GROUP BY id_fatd) b ON b.id_fatd = fatd.id_fatd
                LEFT JOIN envolvido ON
                    envolvido.id_fatd=fatd.id_fatd AND envolvido.situacao = :situacao AND rg_substituto = :rg_substituto
                WHERE  sjd_ref_ano  = :ano  ORDER BY id_fatd DESC', 
                    [
                        'termino_data' => '0000-00-00',
                        'id_fatd' => '',
                        'situacao' => 'Encarregado',
                        'rg_substituto' => '',
                        'id_andamento' => '1',
                        'ano' => $ano
                    ]); 
                });
                    
        }
        else 
        {
            $registros = Cache::remember('fatd'.$unidade.'_prazo_topm', self::$expiration, function() use ($unidade, $ano){
                return DB::connection('sjd')->select('SELECT * FROM
                (SELECT fatd.*, envolvido.cargo, envolvido.nome, 
                    dias_uteis(abertura_data,DATE(NOW()))+1 AS dutotal,b.dusobrestado,
                    (dias_uteis(abertura_data,DATE(NOW()))+1-IFNULL(b.dusobrestado,0)) AS diasuteis 
                    FROM fatd
                    LEFT JOIN
                    (SELECT id_fatd, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado 
                    FROM sobrestamento
                        WHERE termino_data != :termino_data AND id_fatd != :id_fatd
                        GROUP BY id_fatd) b
                        ON b.id_fatd = fatd.id_fatd
                    LEFT JOIN envolvido ON
                        envolvido.id_fatd = fatd.id_fatd 
                        AND envolvido.situacao = :situacao 
                        AND rg_substituto = :rg_substituto
                    WHERE fatd.id_andamento = :id_andamento
                    AND fatd.sjd_ref_ano = :ano 
                    AND fatd.cdopm like :unidade%) 
                    AS dt WHERE dt.diasuteis > :diasuteis', 
                    [
                        'termino_data' => '0000-00-00',
                        'id_fatd' => '',
                        'situacao' => 'Encarregado',
                        'rg_substituto' => '',
                        'id_andamento' => '1',
                        'ano' => $ano,
                        'diasuteis' => '30',
                        'unidade' => $unidade
                    ]); 

            });   
        }
        return $registros;
    }

}

