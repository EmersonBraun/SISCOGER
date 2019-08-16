<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\proc;

use Illuminate\Support\Facades\DB;

use Cache;
use App\Models\Sjd\Proc\Adl;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;

class AdlRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected static $expiration = 60 * 24;//um dia; 

	public function __construct(Adl $model)
	{
        $this->model = $model;
    }

    public function cleanCache()
	{
        Cache::tags('adl')->flush();
    }
    
    public static function transferencias($unidade)
    {
        //buscar dados do cache
    //     $transferidos = Cache::remember('transferidos:'.$unidade, self::$expiration, function() use ($unidade){
    //         /*SELECT * FROM movimentos 
    //         WHERE data >= DATEADD ( DAY ,-7, getdate() ) AND rg 
    //         IN (SELECT PPusuarios.UserRG FROM PPUsuarios INNER JOIN
    //             PPUsuarioGrupo ON PPUsuarioGrupo.UserID=PPUsuarios.UserID AND PPUsuarioGrupo.GrupoID=116) */

    //         $date = \Carbon\Carbon::today()->subDays(7);

    //         $grupos = [
    //             '31',//CTI - Ordens de Serviço
    //             '71',//CTI - INVENTARIO
    //             '90',//SJD - PROCESSOS
    //             '95',//CTI - DESENVOLVIMENTO
    //             '95',//CTI - SUPORTE
    //             '97',//CTI - INVENTARIO
    //             '100',//CPP - Sistema de Controle
    //             '116'//PROXY 02
    //         ];

    //         $registros = new Collection();

    //         foreach ($grupos as $grupo) {
    //             $query = DB::connection('pass')->table('movimentos');
    //             $query->orWhere('opmorigem','like',$unidade.'%')
    //                     ->orWhere('opmdestino','like',$unidade.'%');
    //             $query->where(function($subquery)
    //             {
    //                 $subquery = DB::connection('pass')->table('PPusuarios');
    //                 $subquery->select('UserRG');
    //                 $subquery->join('PPUsuarioGrupo', function ($join)
    //                 {
    //                     $join->on('PPUsuarioGrupo.UserID', '=', 'PPUsuarios.UserID')
    //                             ->where([
    //                                 ['PPUsuarioGrupo.GrupoID', '=','31'],//CTI - Ordens de Serviço
    //                         ]);
    //                 });  
    //             });
    //             $result = $query->where('data','>=',$date)->get();
    //             if($result) $registros = $registros->merge($result);
    //             return $query->get(); 
    //         }
    //         return $registros;
    //    });
       
       $transferidos = [
           ['rg' => '0000000',
           'nome' => 'Arrumar',
           'opmorigem' => '0',
           'opmdestino' => '0',]
        ];
        return $transferidos;
    }

    public function all()
	{
        $unidade = session('cdopmbase');
        $verTodasUnidades = session('ver_todas_unidades');

        if($verTodasUnidades)
        {
            $registros = Cache::tags('adl')->remember('todos_adl', self::$expiration, function() {
                return $this->model->all();
            });
        }
        else 
        {
            $registros = Cache::tags('adl')->remember('todos_adl:'.$unidade, self::$expiration, function() use ($unidade) {
                return $this->model->where('cdopm','like',$unidade.'%')->get();
            });
        }

        return $registros;
    } 

}

