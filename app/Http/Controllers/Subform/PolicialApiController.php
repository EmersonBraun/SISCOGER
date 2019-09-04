<?php

namespace App\Http\Controllers\Subform;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Repositories\Proc;

use DB;
use Cache;

class PolicialApiController extends Controller
{
    //tempo de cahe em minutos
    private static $expiration = 60; 

    //EFETIVO
    public static function efetivoOPM($unidade)
    {
        $efetivo = Cache::remember('efetivo'.$unidade, self::$expiration, function() use ($unidade){

            return DB::connection('rhparana')
            ->table('policial')
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

            return DB::connection('rhparana')
            ->table('policial')
            ->select(DB::raw('count(cargo) AS qtd'))
                    ->where('cdopm','like',$unidade.'%')
                    ->first();
        });
        //cast para objeto
        $total_efetivo = (object) $total_efetivo;

        return $total_efetivo;
    }
    

}
