<?php

namespace App\Http\Controllers\_Api\SJD\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use DB;
use Cache;
use App\User;
use App\Repositories\SindicanciaRepository;

class SindicanciaApiController extends Controller
{
    public function find($id, SindicanciaRepository $repository)
    {
        return $repository->find($id);
    }

    public function refAno($ref, $ano, SindicanciaRepository $repository)
    {
        return $repository->refAno($ref, $ano);
    }

    public function all(SindicanciaRepository $repository)
    {
        return $repository->all();
    }

    public function ano($ano, SindicanciaRepository $repository)
    {
        return $repository->ano($ano);
    }

    public function andamento(SindicanciaRepository $repository)
    {
        return $repository->andamento();
    }

    public function andamentoAno($ano, SindicanciaRepository $repository)
    {
        return $repository->andamentoAno($ano);
    }

    // public function prazos(SindicanciaRepository $repository)
    // {
    //     return $repository->prazos();
    // }

    public function prazosAno($ano)
    {
        return $repository->prazosAno($ano);
    }

    public function relSituacao(SindicanciaRepository $repository)
    {
        return $repository->relSituacao($ano);
    }

    public function relSituacaoAno($ano, SindicanciaRepository $repository)
    {
        return $repository->relSituacaoAno($ano);
    }

    public function julgamento(SindicanciaRepository $repository)
    {
        return $repository->julgamento();
    }

    public function julgamentoAno($ano, SindicanciaRepository $repository)
    {
        return $repository->julgamentoAno($ano);
    }

    public function resultado()
    {
        $registros = Proc::julgamento('sindicancia');
        return view('procedimentos.sindicancia.list.resultado',compact('registros'));
    }
     public static function prazos($unidade)
     {
         $sindicancia_prazos = Cache::remember('sindicancia_prazos'.$unidade, 60, function() use ($unidade){
         
         return DB::connection('sjd')
         ->select('SELECT * FROM (
             SELECT sindicancia.id_sindicancia, andamento, envolvido.cargo, 
             envolvido.nome, cdopm, sjd_ref, sjd_ref_ano, abertura_data, 
             DIASUTEIS(abertura_data,DATE(NOW())) AS dutotal,
             b.dusobrestado,
             (DIASUTEIS(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis 
             FROM sindicancia
             LEFT JOIN
             (SELECT id_sindicancia, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado 
             FROM sobrestamento
             WHERE termino_data != :termino_data AND id_sindicancia!=:id_sindicancia
             GROUP BY id_sindicancia) b
             ON b.id_sindicancia = sindicancia.id_sindicancia
             LEFT JOIN envolvido ON
             envolvido.id_sindicancia=sindicancia.id_sindicancia 
             AND envolvido.situacao=:situacao AND rg_substituto=:rg_substituto
             LEFT JOIN andamento ON
             andamento.id_andamento=sindicancia.id_andamento
             WHERE sindicancia.id_andamento=:id_andamento
             ) dt
             WHERE cdopm LIKE :opm AND dt.diasuteis > :diasuteis',
             [
                 'termino_data' => '0000-00-00',
                 'id_sindicancia' => '',
                 'situacao' => 'Encarregado',
                 'rg_substituto' => '',
                 'id_andamento' => '6',
                 'opm' => $unidade.'%',
                 'diasuteis' => '30'
             ]);
 
         });
 
         return $sindicancia_prazos;
     }
         
    public static function aberturas($unidade)
     {
         $sindicancia_aberturas = Cache::remember('sindicancias_aberturas'.$unidade, 60, function() use ($unidade){
         
             return DB::table('sindicancia')
             ->where('cdopm', 'LIKE', $unidade.'%') 
             ->where('abertura_data','=','0000-00-00')
             ->get();
 
         });
 
         return $sindicancia_aberturas;
     }
    public static function QtdOMAnos($unidade, $ano='')
    {
        //inicializar a variável
        $sindicancia_ano = [];
        if($ano != '')
        {
            $sindicancia_ano = DB::connection('sjd')
            ->table('sindicancia')
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
                //Quantidade de sindicancia por ano
                $qtd_sindicancia_ano = DB::connection('sjd')
                ->table('sindicancia')
                ->select(DB::raw('count(sjd_ref) AS qtd'))
                ->where('sjd_ref_ano','=',$i)
                ->where('cdopm','like',$unidade.'%')
                ->groupBy('sjd_ref_ano')
                ->first();
                //insere no array para ficar 'ano' => 'qtd'
                $sindicancia_ano = array_add($sindicancia_ano,$i, $qtd_sindicancia_ano['qtd']);
            }
        }
        
        return $sindicancia_ano;
    }
}
