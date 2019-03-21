<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Auth;
use Cache;
use App\User;
use App\Models\Sjd\Policiais\Comportamento;
use App\Repositories\BaseRepository;

class ComportamentoRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected static $expiration = 60;  

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
    
    public static function comportamentos($unidade)
    {
        $rgs = Cache::remember('rgs'.$unidade, self::$expiration, function() use ($unidade){

            //rgs dos praças da unidade
            return DB::connection('rhparana')
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

        });

        $comportamentos = Cache::remember('comportamentos'.$unidade, self::$expiration, function() use ($rgs){
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

