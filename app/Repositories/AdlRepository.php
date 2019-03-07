<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Auth;
use Cache;
use App\User;
use App\Models\Sjd\Proc\Adl;

class AdlRepository
{
    private $model;
    private static $expiration = 60; 

	public function __construct(Adl $model)
	{
		$this->model = $model;
    }
    
    public function find($id)
	{
        $unidade = session('cdopmbase');
        //verifica se o usuário tem permissão para ver todas unidades
        $verTodasUnidades = session('ver_todas_unidades');

        $proc = $this->model->findOrFail($id);

        //verificar se a opm de login é diferente da unidade do procedimento
        if($proc instanceof Illuminate\Database\Eloquent\Collection) 
        {
            $opm = ($proc->cdopm != session()->get('cdopmbase')) ? 1 : 0;
        } 
        else 
        {
            $opm = ($proc['cdopm'] != session()->get('cdopmbase')) ? 1 : 0;
        }

        /*não pode ver todas unidades e a unidade do procedimento diferente da opm do login
        *redireciona o erro de acesso não permitido */
        if ($verTodasUnidades == 0 && $opm == 1) 
        {
            return abort(403);
        }
        else
        {
            return $proc;
        }

    }

    public function refAno($ref, $ano)
	{
        $unidade = session('cdopmbase');
        //verifica se o usuário tem permissão para ver todas unidades
        $verTodasUnidades = session('ver_todas_unidades');

        $proc = $this->model->where('sjd_ref','=',$ref)->where('sjd_ref_ano','=',$ano)->first();

        //verificar se a opm de login é diferente da unidade do procedimento
        if($proc instanceof Illuminate\Database\Eloquent\Collection) 
        {
            $opm = ($proc->cdopm != session()->get('cdopmbase')) ? 1 : 0;
        } 
        else 
        {
            $opm = ($proc['cdopm'] != session()->get('cdopmbase')) ? 1 : 0;
        }

        /*não pode ver todas unidades e a unidade do procedimento diferente da opm do login
        *redireciona o erro de acesso não permitido */
        if ($verTodasUnidades == 0 && $opm == 1) 
        {
            return abort(403);
        }
        else
        {
            return $proc;
        }

    }

    public function proxId()
    {
        //ano atual
        $ano = (int) date('Y');

        //última referência de adl inserida
        $ref = $this->model->where('sjd_ref_ano','=',$ano)->max('sjd_ref');
        $ref = $ref+1;

        return $ref;
    }

    public function all()
	{
        $unidade = session('cdopmbase');
        //verifica se o usuário tem permissão para ver todas unidades
        $verTodasUnidades = session('ver_todas_unidades');

        if($verTodasUnidades)
        {
            $registros = Cache::remember('todos_adl', self::$expiration, function() {
                return $this->model->all();
            });
        }
        else 
        {
            $registros = Cache::remember('todos_adl_'.$unidade, self::$expiration, function() use ($unidade) {
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
            $registros = Cache::remember('todos_adl'.$ano, self::$expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano','=',$ano)->get();
            });
        }
        else 
        {
            $registros = Cache::remember('todos_adl_'.$unidade.$ano, self::$expiration, function() use ($unidade, $ano) {
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
            $registros = Cache::remember('andamento_adl', self::$expiration, function() {
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
            $registros = Cache::remember('andamento_adl_'.$unidade, self::$expiration, function() use ($unidade) {
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
        //verifica se o usuário tem permissão para ver todas unidades
        $verTodasUnidades = session('ver_todas_unidades');

        if($verTodasUnidades)
        {
            $registros = Cache::remember('andamento_adl', self::$expiration, function() use ($ano){
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
            $registros = Cache::remember('andamento_adl_'.$unidade, self::$expiration, function() use ($unidade, $ano) {
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
        //verifica se o usuário tem permissão para ver todas unidades
        $verTodasUnidades = session('ver_todas_unidades');

        if($verTodasUnidades)
        {
            $registros = Cache::remember('julgamento_adl', self::$expiration, function() {
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
            $registros = Cache::remember('julgamento_adl_'.$unidade, self::$expiration, function() use ($unidade) {
                return $this->model->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_adl', '=', 'adl.id_adl')
                                ->where('envolvido.id_adl', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','adl'))
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
            $registros = Cache::remember('julgamento_adl', self::$expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
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
            $registros = Cache::remember('julgamento_adl_'.$unidade, self::$expiration, function() use ($unidade,$ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_adl', '=', 'adl.id_adl')
                                ->where('envolvido.id_adl', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','adl'))
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

            $registros = Cache::remember('adl_prazo_opm', self::$expiration, function() {
                return DB::connection('sjd')->select('SELECT adl.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_adl=adl.id_adl ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_adl=adl.id_adl ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis FROM adl
                    LEFT JOIN
                    (SELECT id_adl, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                    WHERE termino_data !=:termino_data AND id_adl!=:id_adl GROUP BY id_adl ORDER BY id_adl ASC LIMIT 1) b
                    ON b.id_adl = adl.id_adl
                    LEFT JOIN envolvido ON
                        envolvido.id_adl=adl.id_adl AND envolvido.situacao=:situacao AND rg_substituto=:rg_substituto', 
                        [
                            'termino_data' => '0000-00-00',
                            'id_adl' => '',
                            'situacao' => 'Presidente',
                            'rg_substituto' => ''
                        ]); 
                    });
                    
        }
        else 
        {
                $registros = Cache::remember('adl'.$unidade.'_prazo_topm', self::$expiration, function() use ($unidade){
                        return DB::connection('sjd')->select('SELECT adl.id_adl, adl.id_andamento, adl.id_andamentocoger, 
                        (
                            SELECT  motivo
                            FROM    sobrestamento
                            WHERE   sobrestamento.id_adl=adl.id_adl 
                            ORDER BY sobrestamento.id_sobrestamento DESC
                            LIMIT 1
                        ) AS motivo,  
                        (
                            SELECT  motivo_outros
                            FROM    sobrestamento
                            WHERE   sobrestamento.id_adl=adl.id_adl 
                            ORDER BY sobrestamento.id_sobrestamento DESC
                            LIMIT 1
                        ) AS motivo_outros, envolvido.cargo, envolvido.nome, cdopm, sjd_ref, sjd_ref_ano, abertura_data, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                        b.dusobrestado, 
                        (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis FROM adl
                        LEFT JOIN
                        (SELECT id_adl, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                            WHERE termino_data !=:termino_data AND id_adl!=:id_adl 
                            GROUP BY id_adl
                            ORDER BY id_adl ASC
                            LIMIT 1) b
                            ON b.id_adl = adl.id_adl 
                            AND adl.cdopm like :unidade%
                        LEFT JOIN envolvido ON
                            envolvido.id_adl=adl.id_adl 
                            AND envolvido.situacao=:situacao 
                            AND rg_substituto=:rg_substituto
                            ', 
                            [
                                'termino_data' => '0000-00-00',
                                'id_adl' => '',
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

            $registros = Cache::remember('adl_prazo_opm'.$ano, self::$expiration, function() use ($ano) {
                return DB::connection('sjd')->select('SELECT adl.id_adl, adl.id_andamento, adl.id_andamentocoger, 
                (SELECT  motivo FROM    sobrestamento WHERE   sobrestamento.id_adl=adl.id_adl ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                (SELECT  motivo_outros FROM sobrestamento WHERE sobrestamento.id_adl=adl.id_adl ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1
                ) AS motivo_outros, envolvido.cargo, envolvido.nome, cdopm, sjd_ref, sjd_ref_ano, abertura_data, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis FROM adl
                LEFT JOIN
                (SELECT id_adl, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento WHERE termino_data !=:termino_data AND id_adl!=:id_adl GROUP BY id_adl ORDER BY id_adl ASC LIMIT 1) b ON b.id_adl = adl.id_adl
                LEFT JOIN envolvido ON envolvido.id_adl=adl.id_adl AND envolvido.situacao=:situacao AND rg_substituto=:rg_substituto
                WHERE adl.sjd_ref_ano = :ano', 
                    [
                        'termino_data' => '0000-00-00',
                        'id_adl' => '',
                        'situacao' => 'Presidente',
                        'rg_substituto' => '',
                        'ano' => $ano
                    ]); 
                });
                    
        }
        else 
        {
            $registros = Cache::remember('adl'.$unidade.'_prazo_topm', self::$expiration, function() use ($unidade, $ano){
                return DB::connection('sjd')->select('SELECT adl.id_adl, adl.id_andamento, adl.id_andamentocoger, 
                (
                    SELECT  motivo
                    FROM    sobrestamento
                    WHERE   sobrestamento.id_adl=adl.id_adl 
                    ORDER BY sobrestamento.id_sobrestamento DESC
                    LIMIT 1
                ) AS motivo,  
                (
                    SELECT  motivo_outros
                    FROM    sobrestamento
                    WHERE   sobrestamento.id_adl=adl.id_adl 
                    ORDER BY sobrestamento.id_sobrestamento DESC
                    LIMIT 1
                ) AS motivo_outros, envolvido.cargo, envolvido.nome, cdopm, sjd_ref, sjd_ref_ano, abertura_data, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                b.dusobrestado, 
                (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis FROM adl
                LEFT JOIN
                (SELECT id_adl, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                    WHERE termino_data !=:termino_data AND id_adl!=:id_adl 
                    GROUP BY id_adl
                    ORDER BY id_adl ASC
                    LIMIT 1) b
                    ON b.id_adl = adl.id_adl 
                    AND adl.cdopm like :unidade%
                LEFT JOIN envolvido ON
                    envolvido.id_adl=adl.id_adl 
                    AND envolvido.situacao=:situacao 
                    AND rg_substituto=:rg_substituto
                    WHERE adl.sjd_ref_ano = :ano
                    ', 
                    [
                        'termino_data' => '0000-00-00',
                        'id_adl' => '',
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

