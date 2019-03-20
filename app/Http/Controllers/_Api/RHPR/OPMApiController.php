<?php

namespace App\Http\Controllers\_Api\RHPR;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Repositories\Proc;

use DB;
use Cache;
use App\Models\rhparana\Opmpmpr;

class OPMApiController extends Controller
{
    //tempo de cahe em minutos
    private static $expiration = 60; 

    //dados para formulários
    public static function get()
    {
        //tempo de cahe
        $expiration = 60 * 24 * 7; //uma semana

        //$opms = Cache::remember('cg', $expiration, function(){
            $opmscg = Opmpmpr::where('CODIGO','like','00%')
            ->where('CODIGO','like', '%0000000')
            ->orWhere('CODIGO','=','0010130000')  // AJ GER COMPANHIA DE COMANDO E SERVICOS
            ->orderBy('CODIGO')
            ->get();

                $cg = $opmscg->pluck('ABREVIATURA','CODIGO')->toArray();  

            $opmssubcg = Opmpmpr::where('CODIGO','like','0%')
                ->where('CODIGO','like', '%0000000')
                ->where('CODIGO','not like', '00%')
                ->get();
            
                $subcg = $opmssubcg->pluck('ABREVIATURA','CODIGO')->toArray(); 

            $opmsem = Opmpmpr::where('CODIGO','like','1%')
                ->where('CODIGO','like', '%000000')
                ->orWhere('CODIGO','=','11006000')    // PM6
                ->orWhere('CODIGO','=','1110500000')  // ACADEMIA POLICIAL MILITAR DO GUATUPE
                ->orWhere('CODIGO','=','1100000900')  // SESP
                ->orWhere('CODIGO','=','1110540300')  // APMG DIV ALUNOS ESCOLA DE OFICIAIS
                ->orWhere('CODIGO','=','1110540400')  // APMG DIV ALUNOS 1 ESFAEP
                ->orWhere('CODIGO','=','1150200000')  // DS HOSPITAL DA POLICIA MILITAR
                ->orWhere('CODIGO','=','1110540500')  // APMG DIV ALUNOS 2 ESFAEP
                ->orderBy('CODIGO')
                ->get();

                $em = $opmsem->pluck('ABREVIATURA','CODIGO')->toArray();

                //$cpm2 = Opmpmpr::where('CODIGO','=','1110800000')->pluck('DESCRICAO','CODIGO'); ->toArray()// CPM 2
                $em = array_add($em,'1110800000','CPM2');//inserido no braço pq está sem 'ABREVIATURA'
            $opmscrpm1 = Opmpmpr::where('CODIGO','like','2%')
                ->where('CODIGO','like', '%000000')
                ->orderBy('CODIGO')
                ->get();

                $crpm1 = $opmscrpm1->pluck('ABREVIATURA','CODIGO')->toArray();

            $opmscrpm2 = Opmpmpr::where('CODIGO','like','3%')
                ->where('CODIGO','like', '%000000')
                ->orderBy('CODIGO')
                ->get();

                $crpm2 = $opmscrpm2->pluck('ABREVIATURA','CODIGO')->toArray();

            $opmscrpm3 = Opmpmpr::where('CODIGO','like','4%')
                ->where('CODIGO','like', '%000000')
                ->orderBy('CODIGO')
                ->get();

                $crpm3 = $opmscrpm3->pluck('ABREVIATURA','CODIGO')->toArray();

            $opmscrpm4 = Opmpmpr::where('CODIGO','like','5%')
                ->where('CODIGO','like', '%000000')
                ->orderBy('CODIGO')
                ->get();

                $crpm4 = $opmscrpm4->pluck('ABREVIATURA','CODIGO')->toArray();

            $opmscrpm5 = Opmpmpr::where('CODIGO','like','6%')
                ->where('CODIGO','like', '%000000')
                ->orderBy('CODIGO')
                ->get();

                $crpm5 = $opmscrpm5->pluck('ABREVIATURA','CODIGO')->toArray();

            $opmscrpm6 = Opmpmpr::where('CODIGO','like','7%')
                ->where('CODIGO','like', '%000000')
                ->orderBy('CODIGO')
                ->get();

                $crpm6 = $opmscrpm6->pluck('ABREVIATURA','CODIGO')->toArray();

            $opmsccb = Opmpmpr::where('CODIGO','like','9%')
                ->where('CODIGO','like', '%000000')
                ->orWhere('CODIGO','=','9000000800')  // GRUPO DE OPERACOES DE SOCORRO TATICO
                ->orderBy('CODIGO')
                ->get();
                
                $ccb = $opmsccb->pluck('ABREVIATURA','CODIGO')->toArray();

            $opms = [
                'CG' => $cg, 
                'SUBCG' => $subcg, 
                'EM' => $em, 
                '1° CRPM' => $crpm1, 
                '2° CRPM' => $crpm2, 
                '3° CRPM' => $crpm3, 
                '4° CRPM' => $crpm4, 
                '5° CRPM' => $crpm5, 
                '6° CRPM' => $crpm6, 
                'CCB' => $ccb
            ];

        //});

        return $opms;
    }

    public static function codigo($codigo)
    {
        $expiration = 60 * 24; //uma vez por dia
        $opms = Cache::remember('opm', $expiration, function(){
            return Opmpmpr::all();
        });
        //return array_get($opms, $codigo)
    }

    public function omsjd($name)
    {
        $omsjd = Opmpmpr::where('ABREVIATURA','like',$name.'%')
                // ->whereIn('CODIGO', 
                // [
                //     '0000000', // AJ GER COMPANHIA DE COMANDO E SERVICOS
                //     '0010130000', // PM6
                //     '11006000', // ACADEMIA POLICIAL MILITAR DO GUATUPE
                //     '1110500000', // SESP
                //     '1100000900', // APMG DIV ALUNOS ESCOLA DE OFICIAIS
                //     '1110540300', // APMG DIV ALUNOS 1 ESFAEP
                //     '1110540400', // DS HOSPITAL DA POLICIA MILITAR
                //     '1150200000', // APMG DIV ALUNOS 2 ESFAEP
                //     '110540500', // GRUPO DE OPERACOES DE SOCORRO TATICO
                //     '9000000800',
                // ])
                ->get();

        //});
        //dd(json_encode($omsjd));
        return $omsjd;
    }
   

}
