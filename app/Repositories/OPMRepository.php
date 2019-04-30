<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Cache;
use App\Models\rhparana\Opmpmpr;
use Illuminate\Support\Facades\Route;

class OPMRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected static $expiration = 60 * 24; 
 
	public function __construct(Opmpmpr $model)
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

    //dados para formulários
    public static function get()
    {
        //tempo de cahe
        $expiration = 60 * 24 * 7; //uma semana

        $opms = Cache::remember('opms_sjd', $expiration, function(){
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

            return $opms;
        });

        return $opms;
    }

    public static function codigo($cdopm)
    {
        //tempo de cahe
        $expiration = 60 * 24 * 7; //uma semana

        $opms = Cache::remember('opms_'.$cdopm, $expiration, function() use($cdopm){
            return Opmpmpr::where('CODIGO','like',$cdopm.'%')->first();
        });

        return $opms;
    }

    public static function abreviatura($cdopm)
    {
        $abreviatura = OPMRepository::codigo($cdopm);
        return $abreviatura->ABREVIATURA;
    }

    public static function uabreviatura($cdopm)
    {
        $abreviatura = Opmpmpr::where('CODIGO','=',$cdopm)->first();
        if(!$abreviatura){
            return 'Não encontrada';
        }else { 
            return $abreviatura->ABREVIATURA;
        }
    }

    public static function descricao($cdopm)
    {
        $descricao = OPMRepository::codigo($cdopm);
        return $descricao->DESCRICAO;
    }


}