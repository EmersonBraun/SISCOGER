<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Auth;
use Cache;
use App\User;
use App\Models\Sjd\Proc\Movimento;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Route;

class MovimentoRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected static $expiration = 60 * 24;//um dia 

	public function __construct(Movimento $model)
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

    public static function cleanCache($ano)
	{
        $proc = 'movimento';
        $unidade = session('cdopmbase');
        $ano = (int) date('Y');
        $caches = [
            'todos_'.$proc,
            'todos_'.$proc.$unidade,
            'todos_'.$proc.$ano,
            'todos_'.$proc.$ano.$unidade,
            'andamento_'.$proc,
            'andamento_'.$proc.$unidade,
            'andamento_'.$proc.$ano,
            'andamento_'.$proc.$ano.$unidade,
            'julgamento_'.$proc,
            'julgamento_'.$proc.$unidade,
            'julgamento_'.$proc.$ano,
            'julgamento_'.$proc.$ano.$unidade,
            'prazo_'.$proc,
            'prazo_'.$proc.$unidade,
            'prazo_'.$proc.$ano,
            'prazo_'.$proc.$ano.$unidade,
        ];

        foreach ($caches as $cache) 
        {
           $clean = Cache::forget($cache);
           $fail = (!$clean) ? true : false;
        }
        return $fail;
    }

    public function allProc($id, $proc)
	{

        $registros = Cache::remember('movimentos'.$proc.$id, 5, function() use($id, $proc) {
            return $this->model->where('id_'.$proc,'=',$id)->get();
        });

        return $registros;
    }
    
    public function all()
	{
        $unidade = $this->unidade;
        $verTodasUnidades = $this->verTodasUnidades;

        if($verTodasUnidades)
        {
            $registros = Cache::remember('todos_movimento', self::$expiration, function() {
                return $this->model->all();
            });
        }
        else 
        {
            $registros = Cache::remember('todos_movimento'.$unidade, self::$expiration, function() use ($unidade) {
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
            $registros = Cache::remember('todos_movimento'.$ano, self::$expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano','=',$ano)->get();
            });
        }
        else 
        {
            $registros = Cache::remember('todos_movimento'.$ano.$unidade, self::$expiration, function() use ($unidade, $ano) {
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
            $registros = Cache::remember('andamento_movimento', self::$expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_movimento', '=', 'movimento.id_movimento')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::remember('andamento_movimento'.$unidade, self::$expiration, function() use ($unidade) {
                return $this->model->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_movimento', '=', 'movimento.id_movimento')
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
            $registros = Cache::remember('andamento_movimento'.$ano, self::$expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_movimento', '=', 'movimento.id_movimento')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::remember('andamento_movimento'.$ano.$unidade, self::$expiration, function() use ($unidade, $ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_movimento', '=', 'movimento.id_movimento')
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
            $registros = Cache::remember('julgamento_movimento', self::$expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_movimento', '=', 'movimento.id_movimento')
                                ->where('envolvido.id_movimento', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','movimento'))
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::remember('julgamento_movimento'.$unidade, self::$expiration, function() use ($unidade) {
                return $this->model->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_movimento', '=', 'movimento.id_movimento')
                                ->where('envolvido.id_movimento', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','movimento'))
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
            $registros = Cache::remember('julgamento_movimento'.$ano, self::$expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_movimento', '=', 'movimento.id_movimento')
                                ->where('envolvido.id_movimento', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','movimento'))
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::remember('julgamento_movimento'.$ano.$unidade, self::$expiration, function() use ($unidade,$ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_movimento', '=', 'movimento.id_movimento')
                                ->where('envolvido.id_movimento', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','movimento'))
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

            $registros = Cache::remember('prazo_movimento', self::$expiration, function() {
                return $this->model
                    ->selectRaw('movimento.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_movimento=movimento.id_movimento ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_movimento=movimento.id_movimento ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_movimento, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_movimento!= '' GROUP BY id_movimento) b"),
                        'b.id_movimento', '=', 'movimento.id_movimento')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_movimento', '=', 'movimento.id_movimento')
                            ->where('envolvido.situacao', '=', 'Presidente')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->get();

                });
                    
        }
        else 
        {
            $registros = Cache::remember('prazo_movimento'.$unidade, self::$expiration, function() use ($unidade){
                return $this->model
                    ->selectRaw('movimento.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_movimento=movimento.id_movimento ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_movimento=movimento.id_movimento ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_movimento, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_movimento!= '' GROUP BY id_movimento) b"),
                        'b.id_movimento', '=', 'movimento.id_movimento')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_movimento', '=', 'movimento.id_movimento')
                            ->where('envolvido.situacao', '=', 'Presidente')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('it.cdopm','like',$unidade.'%')
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

            $registros = Cache::remember('prazo_movimento'.$ano, self::$expiration, function() use ($ano) {
                return $this->model
                    ->selectRaw('movimento.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_movimento=movimento.id_movimento ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_movimento=movimento.id_movimento ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_movimento, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_movimento!= '' GROUP BY id_movimento) b"),
                        'b.id_movimento', '=', 'movimento.id_movimento')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_movimento', '=', 'movimento.id_movimento')
                            ->where('envolvido.situacao', '=', 'Presidente')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('it.sjd_ref_ano','=',$ano)
                    ->get();
                });
                    
        }
        else 
        {
            $registros = Cache::remember('prazo_movimento'.$ano.$unidade, self::$expiration, function() use ($unidade, $ano){
                return $this->model
                    ->selectRaw('movimento.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_movimento=movimento.id_movimento ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_movimento=movimento.id_movimento ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_movimento, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_movimento!= '' GROUP BY id_movimento) b"),
                        'b.id_movimento', '=', 'movimento.id_movimento')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_movimento', '=', 'movimento.id_movimento')
                            ->where('envolvido.situacao', '=', 'Presidente')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('it.cdopm','like',$unidade.'%')
                    ->where('it.sjd_ref_ano','=',$ano)
                    ->get();

            });   
        }
        return $registros;
    }


}

