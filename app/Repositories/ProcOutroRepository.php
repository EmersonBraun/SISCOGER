<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Auth;
use Cache;
use App\User;
use App\Models\Sjd\Proc\ProcOutro;
use App\Repositories\BaseRepository;

class ProcOutroRepository extends BaseRepository
{
    private $model;
    private static $expiration = 60; 

	public function __construct(ProcOutro $model)
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
            $registros = Cache::remember('todos_proc_outro', self::$expiration, function() {
                return $this->model->all();
            });
        }
        else 
        {
            $registros = Cache::remember('todos_proc_outro_'.$unidade, self::$expiration, function() use ($unidade) {
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
            $registros = Cache::remember('todos_proc_outro'.$ano, self::$expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano','=',$ano)->get();
            });
        }
        else 
        {
            $registros = Cache::remember('todos_proc_outro_'.$unidade.$ano, self::$expiration, function() use ($unidade, $ano) {
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
            $registros = Cache::remember('andamento_proc_outro', self::$expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_proc_outro', '=', 'proc_outro.id_proc_outro')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::remember('andamento_proc_outro_'.$unidade, self::$expiration, function() use ($unidade) {
                return $this->model->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_proc_outro', '=', 'proc_outro.id_proc_outro')
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
            $registros = Cache::remember('andamento_proc_outro', self::$expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_proc_outro', '=', 'proc_outro.id_proc_outro')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::remember('andamento_proc_outro_'.$unidade, self::$expiration, function() use ($unidade, $ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_proc_outro', '=', 'proc_outro.id_proc_outro')
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
            $registros = Cache::remember('julgamento_proc_outro', self::$expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_proc_outro', '=', 'proc_outro.id_proc_outro')
                                ->where('envolvido.id_proc_outro', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','proc_outro'))
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::remember('julgamento_proc_outro_'.$unidade, self::$expiration, function() use ($unidade) {
                return $this->model->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_proc_outro', '=', 'proc_outro.id_proc_outro')
                                ->where('envolvido.id_proc_outro', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','proc_outro'))
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
            $registros = Cache::remember('julgamento_proc_outro', self::$expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_proc_outro', '=', 'proc_outro.id_proc_outro')
                                ->where('envolvido.id_proc_outro', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','proc_outro'))
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::remember('julgamento_proc_outro_'.$unidade, self::$expiration, function() use ($unidade,$ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_proc_outro', '=', 'proc_outro.id_proc_outro')
                                ->where('envolvido.id_proc_outro', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','proc_outro'))
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

            $registros = Cache::remember('proc_outro_prazo_opm', self::$expiration, function() {
                return DB::connection('sjd')->select('SELECT DISTINCT proc_outros.*,
                    dias_uteis(abertura_data,DATE(NOW())) AS ducorridos,
                    DATEDIFF(DATE(NOW()),abertura_data) AS dtcorridos,
                    dias_uteis(abertura_data,limite_data) AS dutotal,
                    DATEDIFF(limite_data,abertura_data) AS dttotal ,
                    dias_uteis(DATE(NOW()),limite_data) AS dufaltando,
                    DATEDIFF(limite_data,DATE(NOW())) AS dtfaltando
                    FROM proc_outros'); 
                });
                    
        }
        else 
        {
            $registros = Cache::remember('proc_outro'.$unidade.'_prazo_topm', self::$expiration, function() use ($unidade){
                    return DB::connection('sjd')->select('SELECT DISTINCT proc_outros.*,
                    dias_uteis(abertura_data,DATE(NOW())) AS ducorridos,
                    DATEDIFF(DATE(NOW()),abertura_data) AS dtcorridos,
                    dias_uteis(abertura_data,limite_data) AS dutotal,
                    DATEDIFF(limite_data,abertura_data) AS dttotal ,
                    dias_uteis(DATE(NOW()),limite_data) AS dufaltando,
                    DATEDIFF(limite_data,DATE(NOW())) AS dtfaltando
                    FROM proc_outros WHERE proc_outros.cdopm like :unidade%',
                    [
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

            $registros = Cache::remember('proc_outro_prazo_opm'.$ano, self::$expiration, function() use ($ano) {
                return DB::connection('sjd')->select('SELECT DISTINCT proc_outros.*,
                    dias_uteis(abertura_data,DATE(NOW())) AS ducorridos,
                    DATEDIFF(DATE(NOW()),abertura_data) AS dtcorridos,
                    dias_uteis(abertura_data,limite_data) AS dutotal,
                    DATEDIFF(limite_data,abertura_data) AS dttotal ,
                    dias_uteis(DATE(NOW()),limite_data) AS dufaltando,
                    DATEDIFF(limite_data,DATE(NOW())) AS dtfaltando
                    FROM proc_outros WHERE proc_outros.sjd_ref_ano = :ano',[
                        'ano' => $ano
                    ]); 
                });
                    
        }
        else 
        {
            $registros = Cache::remember('proc_outro'.$unidade.'_prazo_topm', self::$expiration, function() use ($unidade, $ano){
                return DB::connection('sjd')->select('SELECT DISTINCT proc_outros.*,
                dias_uteis(abertura_data,DATE(NOW())) AS ducorridos,
                DATEDIFF(DATE(NOW()),abertura_data) AS dtcorridos,
                dias_uteis(abertura_data,limite_data) AS dutotal,
                DATEDIFF(limite_data,abertura_data) AS dttotal ,
                dias_uteis(DATE(NOW()),limite_data) AS dufaltando,
                DATEDIFF(limite_data,DATE(NOW())) AS dtfaltando
                FROM proc_outros WHERE proc_outros.cdopm like :unidade% AND sjd_ref_ano = :ano',
                [
                    'unidade' => $unidade,
                    'ano' => $ano
                ]); 

            });   
        }
        return $registros;
    }


}

