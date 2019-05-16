<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Auth;
use Cache;
use App\User;
use App\Models\Sjd\Proc\Ipm;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Route;

class IpmRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected static $expiration = 60 * 24;//um dia 

	public function __construct(Ipm $model)
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
        $proc = 'ipm';
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
    
    public function all()
	{
        $unidade = $this->unidade;
        $verTodasUnidades = $this->verTodasUnidades;

        if($verTodasUnidades)
        {
            $registros = Cache::remember('todos_ipm', 60, function() {
                return $this->model->all();
            });
        }
        else 
        {
            $registros = Cache::remember('todos_ipm'.$unidade, 60, function() use ($unidade) {
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
            $registros = Cache::remember('todos_ipm'.$ano, 60, function() use ($ano) {
                return $this->model->where('sjd_ref_ano','=',$ano)->get();
            });
        }
        else 
        {
            $registros = Cache::remember('todos_ipm'.$ano.$unidade, 60, function() use ($unidade, $ano) {
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
            $registros = Cache::remember('andamento_ipm', 60, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_ipm', '=', 'ipm.id_ipm')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::remember('andamento_ipm'.$unidade, 60, function() use ($unidade) {
                return $this->model->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_ipm', '=', 'ipm.id_ipm')
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
            $registros = Cache::remember('andamento_ipm'.$ano, 60, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_ipm', '=', 'ipm.id_ipm')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::remember('andamento_ipm'.$ano.$unidade, 60, function() use ($unidade, $ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_ipm', '=', 'ipm.id_ipm')
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
            $registros = Cache::remember('julgamento_ipm', 60, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_ipm', '=', 'ipm.id_ipm')
                                ->where('envolvido.id_ipm', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','ipm'))
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::remember('julgamento_ipm'.$unidade, 60, function() use ($unidade) {
                return $this->model->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_ipm', '=', 'ipm.id_ipm')
                                ->where('envolvido.id_ipm', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','ipm'))
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
            $registros = Cache::remember('julgamento_ipm'.$ano, 60, function() use ($ano){
                return $this->model
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_ipm', '=', 'ipm.id_ipm')
                                ->where('envolvido.id_ipm', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','ipm'))
                    ->where('ipm.sjd_ref_ano', '=' ,$ano)
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::remember('julgamento_ipm'.$ano.$unidade, 60, function() use ($unidade,$ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_ipm', '=', 'ipm.id_ipm')
                                ->where('envolvido.id_ipm', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','ipm'))
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

            $registros = Cache::remember('prazo_ipm', 60, function() {
                return $this->model
                    ->selectRaw('ipm.*, envolvido.cargo, envolvido.nome, 
                    (DATEDIFF(DATE(NOW()),autuacao_data)+1) AS diasuteis')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_ipm', '=', 'ipm.id_ipm')
                            ->where('envolvido.situacao', '=', 'Encarregado')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->get();

            });
                    
        }
        else 
        {
            $registros = Cache::remember('prazo_ipm'.$unidade, 60, function() use ($unidade){
                return $this->model
                    ->selectRaw('ipm.*, envolvido.cargo, envolvido.nome, 
                    (DATEDIFF(DATE(NOW()),autuacao_data)+1) AS diasuteis')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_ipm', '=', 'ipm.id_ipm')
                            ->where('envolvido.situacao', '=', 'Encarregado')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('ipm.cdopm','like',$unidade.'%')
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

            $registros = Cache::remember('prazo_ipm'.$ano, 60, function() use ($ano) {
                return $this->model
                    ->selectRaw('ipm.*, envolvido.cargo, envolvido.nome, 
                    (DATEDIFF(DATE(NOW()),autuacao_data)+1) AS diasuteis')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_ipm', '=', 'ipm.id_ipm')
                            ->where('envolvido.situacao', '=', 'Encarregado')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('ipm.sjd_ref_ano','=',$ano)
                    ->get();
                });
                    
        }
        else 
        {
            $registros = Cache::remember('prazo_ipm'.$ano.$unidade, 60, function() use ($unidade, $ano){
                return $this->model
                    ->selectRaw('ipm.*, envolvido.cargo, envolvido.nome, 
                    (DATEDIFF(DATE(NOW()),autuacao_data)+1) AS diasuteis')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_ipm', '=', 'ipm.id_ipm')
                            ->where('envolvido.situacao', '=', 'Encarregado')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('ipm.sjd_ref_ano','=',$ano)
                    ->where('ipm.cdopm','like',$unidade.'%')
                    ->get();

            });   
        }
        return $registros;
    }


}

