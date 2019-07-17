<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\PM;

use Illuminate\Support\Facades\DB;

use Cache;
use App\Models\Sjd\Policiais\Comportamento;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Route;

class ComportamentoRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected static $expiration = 60 * 24 * 7;  //uma semana

	public function __construct(Comportamento $model)
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
        Cache::tags('comportamento')->flush();
    }

    public static function comportamentos($unidade)
    {
        $rgs = Cache::tags('comportamento')->remember('rgs:'.$unidade, self::$expiration, function() use ($unidade){

            try {
                $rgs = DB::connection('rhparana')
                ->table('POLICIAL') 
                ->select('rg')
                ->where('cdopm', 'LIKE', $unidade.'%')
                ->where([
                    ['cargo', '<>', 'CELAGREG'],
                    ['cargo', '<>', 'CEL'],
                    ['cargo', '<>', 'TENCEL'],
                    ['cargo', '<>', 'MAJ'],
                    ['cargo', '<>', 'CAP'],
                    ['cargo', '<>', '1TEN'],
                    ['cargo', '<>', '2TEN'],
                ])->get();
            } catch (\Exception $e) {
                if ($e instanceof QueryException) {
                    dd(intval($e->getStatusCode()));
                }
            }
            
            return $rgs;

        });

        //dd($rgs);

        $comportamentos = Cache::tags('comportamento')->remember('comportamentos:'.$unidade, self::$expiration, function() use ($rgs){
           /*busca na VIEW comportamento_tempo que é a junção das tabelas 
            *comportamento e comportamentopm
            */
            return DB::connection('sjd')
            ->table('comportamento_tempo')
            ->whereIn('rg',$rgs)
            ->latest('recente')
            ->orderBy('recente','DESC')
            ->get();
        });

        return $comportamentos;
    }


}

