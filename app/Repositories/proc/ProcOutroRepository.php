<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\proc;

use Cache;
use App\Models\Sjd\Proc\ProcOutro;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Route;

class ProcOutroRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected static $expiration = 60 * 24;//um dia 

	public function __construct(ProcOutro $model)
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

    public static function cleanCache()
	{
        Cache::tags('proc_outro')->flush();
    }
    
    public function all()
	{
        $unidade = $this->unidade;
        $verTodasUnidades = $this->verTodasUnidades;

        if($verTodasUnidades)
        {
            $registros = Cache::tags('proc_outro')->remember('todos_proc_outro', self::$expiration, function() {
                return $this->model->all();
            });
        }
        else 
        {
            $registros = Cache::tags('proc_outro')->remember('todos_proc_outro'.$unidade, self::$expiration, function() use ($unidade) {
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
            $registros = Cache::tags('proc_outro')->remember('todos_proc_outro'.$ano, self::$expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano','=',$ano)->get();
            });
        }
        else 
        {
            $registros = Cache::tags('proc_outro')->remember('todos_proc_outro'.$ano.$unidade, self::$expiration, function() use ($unidade, $ano) {
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
            $registros = Cache::tags('proc_outro')->remember('andamento_proc_outro', self::$expiration, function() {
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
            $registros = Cache::tags('proc_outro')->remember('andamento_proc_outro'.$unidade, self::$expiration, function() use ($unidade) {
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
        $unidade = $this->unidade;
        $verTodasUnidades = $this->verTodasUnidades;

        if($verTodasUnidades)
        {
            $registros = Cache::tags('proc_outro')->remember('andamento_proc_outro'.$ano, self::$expiration, function() use ($ano){
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
            $registros = Cache::tags('proc_outro')->remember('andamento_proc_outro'.$ano.$unidade, self::$expiration, function() use ($unidade, $ano) {
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
        $unidade = $this->unidade;
        $verTodasUnidades = $this->verTodasUnidades;

        if($verTodasUnidades)
        {
            $registros = Cache::tags('proc_outro')->remember('julgamento_proc_outro', self::$expiration, function() {
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
            $registros = Cache::tags('proc_outro')->remember('julgamento_proc_outro'.$unidade, self::$expiration, function() use ($unidade) {
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
        $unidade = $this->unidade;
        $verTodasUnidades = $this->verTodasUnidades;

        if($verTodasUnidades)
        {
            $registros = Cache::tags('proc_outro')->remember('julgamento_proc_outro'.$ano, self::$expiration, function() use ($ano){
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
            $registros = Cache::tags('proc_outro')->remember('julgamento_proc_outro'.$ano.$unidade, self::$expiration, function() use ($unidade,$ano) {
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

    public function prazos()
    {
        //traz os dados do usuário
        $unidade = session()->get('cdopmbase');

        //verifica se o usuário tem permissão para ver todas unidades
        $verTodasUnidades = session('ver_todas_unidades');

        if($verTodasUnidades)
        {

            $registros = Cache::tags('proc_outro')->remember('prazo_proc_outro', self::$expiration, function() {
                return $this->model->selectRaw('DISTINCT proc_outros.*,
                    dias_uteis(abertura_data,DATE(NOW())) AS ducorridos,
                    DATEDIFF(DATE(NOW()),abertura_data) AS dtcorridos,
                    dias_uteis(abertura_data,limite_data) AS dutotal,
                    DATEDIFF(limite_data,abertura_data) AS dttotal ,
                    dias_uteis(DATE(NOW()),limite_data) AS dufaltando,
                    DATEDIFF(limite_data,DATE(NOW())) AS dtfaltando')
                    ->get(); 
                });
                    
        }
        else 
        {
            $registros = Cache::tags('proc_outro')->remember('prazo_proc_outro'.$unidade.'_prazo_topm', self::$expiration, function() use ($unidade){
                return $this->model->selectRaw('DISTINCT proc_outros.*,
                    dias_uteis(abertura_data,DATE(NOW())) AS ducorridos,
                    DATEDIFF(DATE(NOW()),abertura_data) AS dtcorridos,
                    dias_uteis(abertura_data,limite_data) AS dutotal,
                    DATEDIFF(limite_data,abertura_data) AS dttotal ,
                    dias_uteis(DATE(NOW()),limite_data) AS dufaltando,
                    DATEDIFF(limite_data,DATE(NOW())) AS dtfaltando')
                    ->where('proc_outros.cdopm','like',$unidade.'%')
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

            $registros = Cache::tags('proc_outro')->remember('prazo_proc_outro'.$ano, self::$expiration, function() use ($ano) {
                return $this->model->selectRaw('DISTINCT proc_outros.*,
                    dias_uteis(abertura_data,DATE(NOW())) AS ducorridos,
                    DATEDIFF(DATE(NOW()),abertura_data) AS dtcorridos,
                    dias_uteis(abertura_data,limite_data) AS dutotal,
                    DATEDIFF(limite_data,abertura_data) AS dttotal ,
                    dias_uteis(DATE(NOW()),limite_data) AS dufaltando,
                    DATEDIFF(limite_data,DATE(NOW())) AS dtfaltando')
                    ->where('proc_outros.sjd_ref_ano','=',$ano)
                    ->get();
            });
                    
        }
        else 
        {
            $registros = Cache::tags('proc_outro')->remember('prazo_proc_outro'.$ano.$unidade, self::$expiration, function() use ($unidade, $ano){
                return $this->model->selectRaw('DISTINCT proc_outros.*,
                    dias_uteis(abertura_data,DATE(NOW())) AS ducorridos,
                    DATEDIFF(DATE(NOW()),abertura_data) AS dtcorridos,
                    dias_uteis(abertura_data,limite_data) AS dutotal,
                    DATEDIFF(limite_data,abertura_data) AS dttotal ,
                    dias_uteis(DATE(NOW()),limite_data) AS dufaltando,
                    DATEDIFF(limite_data,DATE(NOW())) AS dtfaltando')
                    ->where('proc_outros.cdopm','like',$unidade.'%')
                    ->where('proc_outros.sjd_ref_ano','=',$ano)
                    ->get();

            });   
        }
        return $registros;
    }


}

