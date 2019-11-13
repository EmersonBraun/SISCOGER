<?php

namespace App\Repositories\OPM;

use Cache;
use App\Models\rhparana\Opmpmpr;
use Illuminate\Support\Facades\Route;

class OPMRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected $expiration = 60 * 24; 
 
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

    public static function cleanCache()
	{
        Cache::tags('opm')->flush();
    }

    public function opmIntermediaria($cdopm)
    {
        $opms_intermediarias = [
            '00' => "COMANDO GERAL",
            '01' => "SUBCOMANDO GERAL",
            '1' => "ESTADO MAIOR",
            '2' => "1º COMANDO REGIONAL DE POLÍCIA MILITAR",
            '3' => "2º COMANDO REGIONAL DE POLÍCIA MILITAR",
            '4' => "3º COMANDO REGIONAL DE POLÍCIA MILITAR",
            '5' => "4º COMANDO REGIONAL DE POLÍCIA MILITAR",
            '6' => "5º COMANDO REGIONAL DE POLÍCIA MILITAR",
            '7' => "6º COMANDO REGIONAL DE POLÍCIA MILITAR",
            '8' => "7º COMANDO REGIONAL DE POLÍCIA MILITAR",
            '9' => "COMANDO DO CORPO DE BOMBEIROS",
        ];
        }
    
    //dados para formulários
    public function get()
    {
        $opms = [
            'CG' => $this->comandoGeral(), 
            'SUBCG' => $this->subComandoGeral(), 
            'EM' => $this->estadoMaior(), 
            '1° CRPM' => $this->crpm1(), 
            '2° CRPM' => $this->crpm2(), 
            '3° CRPM' => $this->crpm3(), 
            '4° CRPM' => $this->crpm4(), 
            '5° CRPM' => $this->crpm5(), 
            '6° CRPM' => $this->crpm6(), 
            'CCB' => $this->ccb()
        ];

        return $opms;
    }

    public function comandoGeral()
    {
        $registros = Cache::tags('opm')->remember('opms_sjd:cg', $this->expiration, function(){
            return $this->model->where('CODIGO','like','00%')
            ->where('CODIGO','like', '%0000000')
            ->orWhere('CODIGO','=','0010130000')  // AJ GER COMPANHIA DE COMANDO E SERVICOS
            ->orderBy('CODIGO')
            ->get();
        });
        return $registros->pluck('ABREVIATURA','CODIGO')->toArray();
    }
    
    public function subComandoGeral()
    {
        $opms = Cache::tags('opm')->remember('opms_sjd:subcg', $this->expiration, function(){
            return $this->model->where('CODIGO','like','0%')
                    ->where('CODIGO','like', '%0000000')
                    ->where('CODIGO','not like', '00%')
                    ->get();
        });
        return $opms->pluck('ABREVIATURA','CODIGO')->toArray();
    }

    public function estadoMaior()
    {
        $opms = Cache::tags('opm')->remember('opms_sjd:em', $this->expiration, function(){
            return $this->model->where('CODIGO','like','1%')
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
        });
        $em = $opms->pluck('ABREVIATURA','CODIGO')->toArray();

        //$cpm2 = $this->model->where('CODIGO','=','1110800000')->pluck('DESCRICAO','CODIGO'); ->toArray()// CPM 2
        $em = array_add($em,'1110800000','CPM2');//inserido no braço pq está sem 'ABREVIATURA'
        return $em;
    }

    public function crpm1()
    {
        $opms = Cache::tags('opm')->remember('opms_sjd:crpm1', $this->expiration, function(){
            return $this->model->where('CODIGO','like','2%')
                    ->where('CODIGO','like', '%000000')
                    ->orderBy('CODIGO')
                    ->get();
        });
        return $opms->pluck('ABREVIATURA','CODIGO')->toArray();    
    }

    public function crpm2()
    {
        $opms = Cache::tags('opm')->remember('opms_sjd:crpm2', $this->expiration, function(){
            return $this->model->where('CODIGO','like','3%')
                ->where('CODIGO','like', '%000000')
                ->orderBy('CODIGO')
                ->get();
        });
        return $opms->pluck('ABREVIATURA','CODIGO')->toArray(); 
    }

    public function crpm3()
    {
        $opms = Cache::tags('opm')->remember('opms_sjd:crpm3', $this->expiration, function(){
            return $this->model->where('CODIGO','like','4%')
                    ->where('CODIGO','like', '%000000')
                    ->orderBy('CODIGO')
                    ->get();
        });
        return $opms->pluck('ABREVIATURA','CODIGO')->toArray();     
    }

    public function crpm4()
    {
        $opms = Cache::tags('opm')->remember('opms_sjd:crpm4', $this->expiration, function(){
            return $this->model->where('CODIGO','like','5%')
                    ->where('CODIGO','like', '%000000')
                    ->orderBy('CODIGO')
                    ->get();
        });
        return $opms->pluck('ABREVIATURA','CODIGO')->toArray();    
    }

    public function crpm5()
    {
        $opms = Cache::tags('opm')->remember('opms_sjd:crpm5', $this->expiration, function(){
            return $this->model->where('CODIGO','like','6%')
                ->where('CODIGO','like', '%000000')
                ->orderBy('CODIGO')
                ->get();
        });
        return $opms->pluck('ABREVIATURA','CODIGO')->toArray();      
    }

    public function crpm6()
    {
        $opms = Cache::tags('opm')->remember('opms_sjd:crpm6', $this->expiration, function(){
            return $this->model->where('CODIGO','like','7%')
                ->where('CODIGO','like', '%000000')
                ->orderBy('CODIGO')
                ->get();

        });
        return $opms->pluck('ABREVIATURA','CODIGO')->toArray();
    }

    public function ccb()
    {
        $opms = Cache::tags('opm')->remember('opms_sjd:ccb', $this->expiration, function(){
            return $this->model->where('CODIGO','like','9%')
                ->where('CODIGO','like', '%000000')
                ->orWhere('CODIGO','=','9000000800')  // GRUPO DE OPERACOES DE SOCORRO TATICO
                ->orderBy('CODIGO')
                ->get();       
        });
        return $opms->pluck('ABREVIATURA','CODIGO')->toArray();
    }

    public function pluckReturn($data)
    {
        return $data->pluck('ABREVIATURA','CODIGO')->toArray();
    }

    public function all()
    {
        //tempo de cahe
        $this->expiration = 60 * 24 * 7; //uma semana

        $registros = Cache::tags('opm')->remember('todas_unidade', $this->expiration, function(){
            return $this->model->all();
        });

        return $registros;
    }

    public function getByName($name)
    {
        //tempo de cahe
        $this->expiration = 60 * 24 * 7; //uma semana

        $registros = Cache::tags('opm')->remember('unidade:'.$name, $this->expiration, function() use ($name){
            return $this->model->where('ABREVIATURA','like',$name.'%')->first();
        });

        return $registros;
    }

    public static function codigo($cdopm)
    {
        //tempo de cahe
        $expiration = 60 * 24 * 7; //uma semana

        $opms = Cache::tags('opm')->remember('codigo:'.$cdopm, $expiration, function() use($cdopm){
            return Opmpmpr::where('CODIGO','like',$cdopm.'%')->first();
        });

        return $opms;
    }

    public static function abreviatura($cdopm)
    {
        //tempo de cahe
        $expiration = 60 * 24 * 7; //uma semana
        $opmCodigo = Cache::tags('opm')->remember('opm:abreviatura:'.$cdopm, $expiration, function() use($cdopm){
                $opm = Opmpmpr::where('CODIGO','like',$cdopm.'%')->first();
                if($opm) return $opm->ABREVIATURA;

                return 'Não encontrado';
        });
        return $opmCodigo;    
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