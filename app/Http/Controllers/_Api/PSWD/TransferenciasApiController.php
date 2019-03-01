<?php

namespace App\Http\Controllers\_Api\PSWD;

use Cache;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
class TransferenciasApiController extends Controller
{
    //tempo de cahe em minutos
    private static $expiration = 60; 

    public static function transferencias($unidade)
    {
        //buscar dados do cache
        /*$transferidos = Cache::remember('transferidos'.$unidade, self::$expiration, function() use ($unidade){
            
            $date = \Carbon\Carbon::today()->subDays(7);
            $query = DB::connection('pass')->table('movimentos');
            $query->orWhere('opmorigem','like',$unidade.'%')
                    ->orWhere('opmdestino','like',$unidade.'%');
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

       });*/
       $transferidos = [
           ['rg' => '0000000',
           'nome' => 'Arrumar',
           'opmorigem' => '0',
           'opmdestino' => '0',]
        ];
        return $transferidos;
    }

}
