<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\proc;

use Illuminate\Support\Facades\DB;

use Cache;
use App\Models\Sjd\Proc\Ligacao;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Route;

class LigacaoRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected static $expiration = 60 * 24;//um dia  

	public function __construct(Ligacao $model)
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

    public function cleanCache()
	{
        Cache::tags('ligacao')->flush();
    }
    
    public function all()
	{
        $unidade = session('cdopmbase');
        $verTodasUnidades = session('ver_todas_unidades');

        if($verTodasUnidades)
        {
            $registros = Cache::tags('ligacao')->remember('todos_ligacao', self::$expiration, function() {
                return $this->model->all();
            });
        }
        else 
        {
            $registros = Cache::tags('ligacao')->remember('todos_ligacao:'.$unidade, self::$expiration, function() use ($unidade) {
                return $this->model->where('cdopm','like',$unidade.'%')->get();
            });
        }

        return $registros;
    } 

    public function refAno($proc, $ref, $ano='')
	{
        if(!$ano) $this->getByProcId($proc, $ref);

        $registros = Cache::tags('ligacao')->remember('ligacao:'.$proc.$ref.$ano, self::$expiration, function() use($proc, $ref, $ano){
            return $this->model->where('destino_proc','=',$proc)
            ->where('destino_sjd_ref','=',$ref)
            ->where('destino_sjd_ref_ano','=',$ano)
            ->get();
        });
        return $registros;
    } 

    public function getByProcId($proc, $id)
    {
        $registros = Cache::tags('ligacao')->remember('ligacao:'.$proc.$id, self::$expiration, function() use($proc, $id){
            return $this->model->where('destino_proc','=',$proc)
                    ->where('id_'.$proc,'=',$id)->get();
        });
        return $registros;
    }

    public function ano($ano)
	{
        $unidade = session('cdopmbase');
        $verTodasUnidades = session('ver_todas_unidades');

        if($verTodasUnidades)
        {
            $registros = Cache::tags('ligacao')->remember('todos_ligacao:'.$ano, self::$expiration, function() use ($ano) {
                return $this->model->where('destino_sjd_ref_ano','=',$ano)->get();
            });
        }
        else 
        {
            $registros = Cache::tags('ligacao')->remember('todos_ligacao:'.$ano.':'.$unidade, self::$expiration, function() use ($unidade, $ano) {
                return $this->model->where('cdopm','like',$unidade.'%')->where('destino_sjd_ref_ano','=',$ano)->get();
            });
        }
        return $registros;
    } 

    public function proc($proc)
	{
    } 

    public static function ligacao($proc, $id)
	{
        $registros = Cache::tags('ligacao')->remember('todos_ligacao:'.$id, self::$expiration, function() use ($proc, $id) {
            return $this->model
            ->where('id_'.$proc,$id)
            ->get();
        });

        return $registros;
    } 

    


}

