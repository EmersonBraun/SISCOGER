<?php

namespace App\Http\Controllers\_Api\SJD\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Repositories\Proc;
use App\Models\Sjd\Proc\Ipm;
use App\Models\Sjd\Busca\Envolvido;
use App\Models\Sjd\Busca\Ofendido;
use App\Models\Sjd\Busca\Ligacao;
use App\Models\Sjd\Proc\Movimento;
use App\Models\Sjd\Proc\Sobrestamento;
use App\Models\Sjd\Arquivo\ArquivosApagado;

use DB;
use Cache;

class IpmApiController extends Controller
{
    //tempo de cahe em minutos
    private static $expiration = 60; 

    public function index()
    {
        return redirect()->route('ipm.lista');
    }

    public function lista()
    {
        $registros = Proc::lista('ipm');
        return view('procedimentos.ipm.list.index',compact('registros'));
    }

    public function andamento( )
    {
        $registros = Proc::andamento('ipm');
        return view('procedimentos.ipm.list.andamento',compact('registros'));
    }

    // public function prazos()
    // {
    //     $registros = Proc::prazos('ipm');;
    //     return view('procedimentos.ipm.list.prazos',compact('registros'));
    // }

    public function rel_situacao()
    {
        $registros = Proc::lista('ipm');
        return view('procedimentos.ipm.list.rel_situacao',compact('registros'));
    }

    public function resultado()
    {
        $registros = Proc::julgamento('ipm');

        return view('procedimentos.ipm.list.resultado',compact('registros'));
    }

     public static function prazos($unidade)
     {
         $ipm_prazos = Cache::remember('ipm_prazos'.$unidade, self::$expiration, function() use ($unidade){
 
         return DB::table('view_ipm_prazo')
             ->where('cdopm', 'LIKE', $unidade.'%') 
             ->where('diasuteis','>','60')
             ->get();
             
         });
 
         return $ipm_prazos;
     }
 
     public static function aberturas($unidade)
     {
         $ipm_aberturas = Cache::remember('ipm_aberturas'.$unidade, self::$expiration, function() use ($unidade){
 
         return DB::table('ipm')
             ->where('cdopm', 'LIKE', $unidade.'%') 
             ->where('autuacao_data','=','0000-00-00')
             ->get();
 
         });
 
         return $ipm_aberturas;
     }

     public static function QtdOMAnos($unidade, $ano='')
    {
        //inicializar a variável
        $ipm_ano = [];

        if($ano != '')
        {
            $ipm_ano = DB::connection('sjd')
            ->table('ipm')
            ->select(DB::raw('count(sjd_ref) AS qtd'))
            ->where('sjd_ref_ano','=',$ano)
            ->where('cdopm','like',$unidade.'%')
            ->groupBy('sjd_ref_ano')
            ->first();
        }
        else
        {
            for($i = 2008; $i <= date('Y'); $i++)
            {
                //Quantidade de ipm por ano
                $qtd_ipm_ano = DB::connection('sjd')
                ->table('ipm')
                ->select(DB::raw('count(sjd_ref) AS qtd'))
                ->where('sjd_ref_ano','=',$i)
                ->where('cdopm','like',$unidade.'%')
                ->groupBy('sjd_ref_ano')
                ->first();
                //insere no array para ficar 'ano' => 'qtd'
                $ipm_ano = array_add($ipm_ano,$i, $qtd_ipm_ano['qtd']);
            }
        }
        
        return $ipm_ano;
    }

    

}
