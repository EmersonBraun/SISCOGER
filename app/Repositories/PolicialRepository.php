<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Auth;
use Cache;
use App\User;
use App\Models\rhparana\Policial;
use App\Repositories\BaseRepository;

class PolicialRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected static $expiration = 60;  

	public function __construct(Policial $model)
	{
		$this->model = $model;
        
        // ver se vem da api (não logada)
        $proc = Route::currentRouteName(); //listar.algo
        $proc = explode ('.', $proc); //divide em [0] -> listar e [1]-> algo
        $proc = $proc[0];

        $isapi = ($proc == 'api') ? 1 : 0;
        $verTodasUnidades = session('ver_todas_unidades');

        $this->verTodasUnidades = ($verTodasUnidades || $isapi) ? 1 : 0;
        $this->unidade = ($isapi) ? '0' : sessiona('cdopmbase');
    }
     
    //EFETIVO
    public static function efetivoOPM($unidade)
    {
        $efetivo = Cache::remember('efetivo'.$unidade, self::$expiration, function() use ($unidade){

            return $this->model
            ->select('cargo', DB::raw('count(cargo) AS qtd'))
                    ->where('cdopm','like',$unidade.'%')
                    ->groupBy('cargo')
                    ->havingRaw('count(cargo) > ?', [0])
                    ->orderBy('qtd','asc')
                    ->get();
            });

        return $efetivo;
    }

    //TOTAL EFETIVO
    public static function totalEfetivoOPM($unidade)
    {
        $total_efetivo = Cache::remember('total_efetivo'.$unidade, self::$expiration, function() use ($unidade){

            return $this->model
            ->select(DB::raw('count(cargo) AS qtd'))
                    ->where('cdopm','like',$unidade.'%')
                    ->first();
        });
        return $total_efetivo;
    }
}

