<?php

namespace App\Http\Controllers\_Api\SJD\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Cache;
use DB;
use App\User;
use App\Repositories\IpmRepository;

class IpmApiController extends Controller
{
    public function find($id, IpmRepository $repository)
    {
        return $repository->find($id);
    }

    public function refAno($ref, $ano, IpmRepository $repository)
    {
        return $repository->refAno($ref, $ano);
    }

    public function all(IpmRepository $repository)
    {
        return $repository->all();
    }

    public function ano($ano, IpmRepository $repository)
    {
        return $repository->ano($ano);
    }

    public function andamento(IpmRepository $repository)
    {
        return $repository->andamento();
    }

    public function andamentoAno($ano, IpmRepository $repository)
    {
        return $repository->andamentoAno($ano);
    }

    // public function prazos(IpmRepository $repository)
    // {
    //     return $repository->prazos();
    // }

    public function prazosAno($ano)
    {
        return $repository->prazosAno($ano);
    }

    public function relSituacao(IpmRepository $repository)
    {
        return $repository->relSituacao($ano);
    }

    public function relSituacaoAno($ano, IpmRepository $repository)
    {
        return $repository->relSituacaoAno($ano);
    }

    public function julgamento(IpmRepository $repository)
    {
        return $repository->julgamento();
    }

    public function julgamentoAno($ano, IpmRepository $repository)
    {
        return $repository->julgamentoAno($ano);
    }

    public static function prazos($unidade)
     {
         $ipm_prazos = Cache::remember('ipm_prazos'.$unidade, 60, function() use ($unidade){
 
         return DB::table('view_ipm_prazo')
             ->where('cdopm', 'LIKE', $unidade.'%') 
             ->where('diasuteis','>','60')
             ->get();
             
         });
 
         return $ipm_prazos;
     }
 
     public static function aberturas($unidade)
     {
         $ipm_aberturas = Cache::remember('ipm_aberturas'.$unidade, 60, function() use ($unidade){
 
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
