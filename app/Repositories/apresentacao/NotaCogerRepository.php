<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\apresentacao\Repositories;

use Illuminate\Support\Facades\DB;

use Cache;
use App\Models\Sjd\apresentacao\NotaCoger;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Route;

class NotaCogerRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected static $expiration = 60 * 24;//um dia; 

	public function __construct(NotaCoger $model)
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
        Cache::tags('nota_comparecimento')->flush();
    }
    
    public function all()
	{
        $unidade = $this->unidade;
        $verTodasUnidades = $this->verTodasUnidades;

        if($verTodasUnidades)
        {
            $registros = Cache::tags('nota_comparecimento')->remember('todos_nota_comparecimento', self::$expiration, function() {
                return $this->model->all();
            });
        }
        else 
        {
            $registros = Cache::tags('nota_comparecimento')->remember('todos_nota_comparecimento:'.$unidade, self::$expiration, function() use ($unidade) {
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
            $registros = Cache::tags('nota_comparecimento')->remember('todos_nota_comparecimento:'.$ano, self::$expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano','=',$ano)->get();
            });
        }
        else 
        {
            $registros = Cache::tags('nota_comparecimento')->remember('todos_nota_comparecimento:'.$ano.':'.$unidade, self::$expiration, function() use ($unidade, $ano) {
                return $this->model->where('cdopm','like',$unidade.'%')->where('sjd_ref_ano','=',$ano)->get();
            });
        }
        return $registros;
    } 

}

