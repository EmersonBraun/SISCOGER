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
use Illuminate\Support\Facades\Route;

class FatdRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected static $expiration = 60 * 24;//um dia  

	public function __construct(Fatd $model)
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
        $proc = 'fatd';
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
            'fora_prazo_'.$proc,
            'fora_prazo_'.$proc.$unidade,
            'punidos_'.$proc.$unidade,
            'aberturas_'.$proc.$unidade,
        ];

        foreach ($caches as $cache) 
        {
           $clean = Cache::forget($cache);
           $fail = (!$clean) ? true : false;
        }
        return $fail;
    }
    
    public function all()
	{
        $unidade = $this->unidade;
        $verTodasUnidades = $this->verTodasUnidades;

        if($verTodasUnidades)
        {
            $registros = Cache::remember('todos_fatd', self::$expiration, function() {
                return $this->model->all();
            });
        }
        else 
        {
            $registros = Cache::remember('todos_fatd'.$unidade, self::$expiration, function() use ($unidade) {
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
            $registros = Cache::remember('todos_fatd'.$ano, self::$expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano','=',$ano)->get();
            });
        }
        else 
        {
            $registros = Cache::remember('todos_fatd'.$ano.$unidade, self::$expiration, function() use ($unidade, $ano) {
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
            $registros = Cache::remember('andamento_fatd'.$unidade, self::$expiration, function() use ($unidade) {
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
        $unidade = $this->unidade;
        $verTodasUnidades = $this->verTodasUnidades;

        if($verTodasUnidades)
        {
            $registros = Cache::remember('andamento_fatd'.$ano, self::$expiration, function() use ($ano){
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
            $registros = Cache::remember('andamento_fatd'.$ano.$unidade, self::$expiration, function() use ($unidade, $ano) {
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
        $unidade = $this->unidade;
        $verTodasUnidades = $this->verTodasUnidades;

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
            $registros = Cache::remember('julgamento_fatd'.$unidade, self::$expiration, function() use ($unidade) {
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
        $unidade = $this->unidade;
        $verTodasUnidades = $this->verTodasUnidades;

        if($verTodasUnidades)
        {
            $registros = Cache::remember('julgamento_fatd'.$ano, self::$expiration, function() use ($ano){
                return $this->model->where('fatd.sjd_ref_ano', '=' ,$ano)
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
            $registros = Cache::remember('julgamento_fatd'.$ano.$unidade, self::$expiration, function() use ($unidade,$ano) {
                return $this->model->where('fatd.sjd_ref_ano', '=' ,$ano)
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

    public function prazos()
    {
        $unidade = $this->unidade;
        $verTodasUnidades = $this->verTodasUnidades;

        if($verTodasUnidades)
        {

            $registros = Cache::remember('prazo_fatd', self::$expiration, function() {
                return $this->model
                    ->selectRaw('DISTINCT fatd.*,
                    (SELECT  motivo FROM    sobrestamento WHERE   sobrestamento.id_fatd=fatd.id_fatd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM    sobrestamento WHERE sobrestamento.id_fatd=fatd.id_fatd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros,
                    envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW()))+1 AS dutotal, 
                    b.dusobrestado, 
                    (dias_uteis(abertura_data,DATE(NOW()))+1-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_fatd, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_fatd!= '' GROUP BY id_fatd) b"),
                        'b.id_fatd', '=', 'fatd.id_fatd')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_fatd', '=', 'fatd.id_fatd')
                            ->where('envolvido.situacao', '=', 'Encarregado')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->get();
            });
                    
        }
        else 
        {
            $registros = Cache::remember('prazo_fatd'.$unidade, self::$expiration, function() use ($unidade){
                return $this->model
                    ->selectRaw('DISTINCT fatd.*,
                    (SELECT  motivo FROM    sobrestamento WHERE   sobrestamento.id_fatd=fatd.id_fatd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM    sobrestamento WHERE sobrestamento.id_fatd=fatd.id_fatd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros,
                    envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW()))+1 AS dutotal, 
                    b.dusobrestado, 
                    (dias_uteis(abertura_data,DATE(NOW()))+1-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_fatd, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_fatd!= '' GROUP BY id_fatd) b"),
                        'b.id_fatd', '=', 'fatd.id_fatd')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_fatd', '=', 'fatd.id_fatd')
                            ->where('envolvido.situacao', '=', 'Encarregado')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('fatd.cdopm','like',$unidade.'%')
                    ->get();

            });   
        }
        return $registros;
    }

    public function prazosAno($ano)
    {
        $unidade = $this->unidade;
        $verTodasUnidades = $this->verTodasUnidades;

        if($verTodasUnidades)
        {

            $registros = Cache::remember('prazo_fatd'.$ano, self::$expiration, function() use ($ano) {
                return $this->model
                    ->selectRaw('DISTINCT fatd.*,
                    (SELECT  motivo FROM    sobrestamento WHERE   sobrestamento.id_fatd=fatd.id_fatd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM    sobrestamento WHERE sobrestamento.id_fatd=fatd.id_fatd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros,
                    envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW()))+1 AS dutotal, 
                    b.dusobrestado, 
                    (dias_uteis(abertura_data,DATE(NOW()))+1-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_fatd, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_fatd!= '' GROUP BY id_fatd) b"),
                        'b.id_fatd', '=', 'fatd.id_fatd')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_fatd', '=', 'fatd.id_fatd')
                            ->where('envolvido.situacao', '=', 'Encarregado')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('fatd.sjd_ref_ano','=',$ano)
                    ->get();

                
                });
                    
        }
        else 
        {
            $registros = Cache::remember('prazo_fatd'.$ano.$unidade, self::$expiration, function() use ($unidade, $ano){
                return $this->model
                    ->selectRaw('DISTINCT fatd.*,
                    (SELECT  motivo FROM    sobrestamento WHERE   sobrestamento.id_fatd=fatd.id_fatd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM    sobrestamento WHERE sobrestamento.id_fatd=fatd.id_fatd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros,
                    envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW()))+1 AS dutotal, 
                    b.dusobrestado, 
                    (dias_uteis(abertura_data,DATE(NOW()))+1-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_fatd, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_fatd!= '' GROUP BY id_fatd) b"),
                        'b.id_fatd', '=', 'fatd.id_fatd')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_fatd', '=', 'fatd.id_fatd')
                            ->where('envolvido.situacao', '=', 'Encarregado')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('fatd.sjd_ref_ano','=',$ano)
                    ->where('fatd.cdopm','like',$unidade.'%')
                    ->get();

            });   
        }
        return $registros;
    }

    public function foraDoPrazo($unidade)
    {
        $unidade = $this->unidade;
        $verTodasUnidades = $this->verTodasUnidades;

        if($verTodasUnidades)
        {

            $registros = Cache::remember('fora_prazo_fatd', self::$expiration, function() {
                return $this->model
                    ->selectRaw('DISTINCT fatd.*,
                    (SELECT  motivo FROM    sobrestamento WHERE   sobrestamento.id_fatd=fatd.id_fatd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM    sobrestamento WHERE sobrestamento.id_fatd=fatd.id_fatd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros,
                    envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW()))+1 AS dutotal, 
                    b.dusobrestado, 
                    (dias_uteis(abertura_data,DATE(NOW()))+1-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_fatd, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_fatd!= '' GROUP BY id_fatd) b"),
                        'b.id_fatd', '=', 'fatd.id_fatd')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_fatd', '=', 'fatd.id_fatd')
                            ->where('envolvido.situacao', '=', 'Encarregado')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('diasuteis', '>', 30)
                    ->get();
            });
                    
        }
        else 
        {
            $registros = Cache::remember('fora_prazo_fatd'.$unidade, self::$expiration, function() use ($unidade){
                return $this->model
                    ->selectRaw('DISTINCT fatd.*,
                    (SELECT  motivo FROM    sobrestamento WHERE   sobrestamento.id_fatd=fatd.id_fatd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM    sobrestamento WHERE sobrestamento.id_fatd=fatd.id_fatd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros,
                    envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW()))+1 AS dutotal, 
                    b.dusobrestado, 
                    (dias_uteis(abertura_data,DATE(NOW()))+1-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_fatd, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_fatd!= '' GROUP BY id_fatd) b"),
                        'b.id_fatd', '=', 'fatd.id_fatd')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_fatd', '=', 'fatd.id_fatd')
                            ->where('envolvido.situacao', '=', 'Encarregado')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('fatd.cdopm','like',$unidade.'%')
                    ->where('diasuteis', '>', 30)
                    ->get();

            });   
        }
        return $registros;
    }

    public static function punidos($unidade)
    {
        $registros = Cache::remember('punidos_fatd'.$unidade, 60, function() use ($unidade){
            return DB::connection('sjd')
            ->table('view_fatd_punicao')
            ->where('cdopm', 'LIKE', $unidade.'%') 
            ->where('id_punicao','=','0')
            ->get();
        });  
        
        return $registros;
    }
 
    public function aberturas($unidade){    
        $registros = Cache::remember('aberturas_fatd'.$unidade, 60, function() use ($unidade){
            return $this->model
            ->where('cdopm', 'LIKE', $unidade.'%') 
            ->where('abertura_data','=','0000-00-00')
            ->get(); 
        });
        return $registros;
    }

    public static function QtdOMAnos($unidade, $ano='')
    {
        //inicializar a variável
        $registros = [];
        if($ano != '')
        {
            $registros = $this->model
            ->select(DB::raw('count(sjd_ref) AS qtd'))
            ->where('sjd_ref_ano','=',$ano)
            ->where('cdopm','like',$unidade.'%')
            ->groupBy('sjd_ref_ano')
            ->first();
        }
        else
        {
            for($i = 2008; $i <= date('Y'); $i++)
            {
                //Quantidade de por ano
                $qtd_ano = $this->model
                ->select(DB::raw('count(sjd_ref) AS qtd'))
                ->where('sjd_ref_ano','=',$i)
                ->where('cdopm','like',$unidade.'%')
                ->groupBy('sjd_ref_ano')
                ->first();
                //insere no array para ficar 'ano' => 'qtd'
                $registros = array_add($registros,$i, $qtd_ano['qtd']);
            }
        }
        
        return $registros;
    }

}

