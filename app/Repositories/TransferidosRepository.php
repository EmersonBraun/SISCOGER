<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Auth;
use Cache;
use App\User;
use App\Models\Sjd\Proc\Adl;
use App\Repositories\BaseRepository;

class TransferidosRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected static $expiration = 60; 

	public function __construct(Adl $model)
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
    
    public static function semana($unidade)
    {
        //buscar dados do cache
        $transferidos = Cache::remember('transferidos'.$unidade, self::$expiration, function() use ($unidade){
            
            $date = \Carbon\Carbon::today()->subDays(7);
            $query = DB::connection('pass')->table('movimentos');
            $query->where(function($subquery1) use ($unidade){
                $subquery1->orWhere('opmorigem','like',$unidade.'%')
                    ->orWhere('opmdestino','like',$unidade.'%');
            });
            $query->where(function($subquery)
            {
                $subquery = DB::connection('pass')->table('PPusuarios');
                $subquery->select('UserRG');
                $subquery->join('PPUsuarioGrupo', function ($join)
                {
                    $join->on('PPUsuarioGrupo.UserID', '=', 'PPUsuarios.UserID')
                            ->where([
                                ['PPUsuarioGrupo.GrupoID', '=','31'],//CTI - Ordens de Serviço
                                ['PPUsuarioGrupo.GrupoID', '=','71'],//CTI - INVENTARIO
                                ['PPUsuarioGrupo.GrupoID', '=','90'],//SJD - PROCESSOS
                                ['PPUsuarioGrupo.GrupoID', '=','95'],//CTI - DESENVOLVIMENTO
                                ['PPUsuarioGrupo.GrupoID', '=','95'],//CTI - SUPORTE
                                ['PPUsuarioGrupo.GrupoID', '=','97'],//CTI - INVENTARIO
                                ['PPUsuarioGrupo.GrupoID', '=','100'],//CPP - Sistema de Controle
                                ['PPUsuarioGrupo.GrupoID', '=','116'],//PROXY 02
                        ]);
                });  
            });
            $query->where('data','>=',$date);

            return $query->get();

       });
       /*$transferidos = [
           ['rg' => '0000000',
           'nome' => 'Arrumar',
           'opmorigem' => '0',
           'opmdestino' => '0',]
        ];*/
        return $transferidos;
    } 

}

