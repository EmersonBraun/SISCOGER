<?php

namespace App\Http\Controllers\_Api\SJD\PM;

use Cache;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ComportamentoApiController extends Controller
{
    private static $expiration = 60;

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
