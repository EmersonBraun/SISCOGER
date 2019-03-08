<?php

namespace App\Http\Controllers\_Api\SJD\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Cache;
use DB;
use App\User;
use App\Repositories\FatdRepository;

class FatdApiController extends Controller
{
    public function find($id, FatdRepository $repository)
    {
        return $repository->find($id);
    }

    public function refAno($ref, $ano, FatdRepository $repository)
    {
        return $repository->refAno($ref, $ano);
    }

    public function all(FatdRepository $repository)
    {
        return $repository->all();
    }

    public function ano($ano, FatdRepository $repository)
    {
        return $repository->ano($ano);
    }

    public function andamento(FatdRepository $repository)
    {
        return $repository->andamento();
    }

    public function andamentoAno($ano, FatdRepository $repository)
    {
        return $repository->andamentoAno($ano);
    }

    // public function prazos(FatdRepository $repository)
    // {
    //     return $repository->prazos();
    // }

    public function prazosAno($ano)
    {
        return $repository->prazosAno($ano);
    }

    public function relSituacao(FatdRepository $repository)
    {
        return $repository->relSituacao($ano);
    }

    public function relSituacaoAno($ano, FatdRepository $repository)
    {
        return $repository->relSituacaoAno($ano);
    }

    public function julgamento(FatdRepository $repository)
    {
        return $repository->julgamento();
    }

    public function julgamentoAno($ano, FatdRepository $repository)
    {
        return $repository->julgamentoAno($ano);
    }

    public static function punidos($unidade)
    {
        $fatd_punidos = Cache::remember('fatd_punidos'.$unidade, 60, function() use ($unidade){
            return DB::connection('sjd')
            ->table('view_fatd_punicao')
            ->where('cdopm', 'LIKE', $unidade.'%') 
            ->where('id_punicao','=','0')
            ->get();
        });  
        
        return $fatd_punidos;
    }

    public static function prazos($unidade)
    {
        $fatd_prazos = Cache::remember('fatd_prazo'.$unidade, 60, function() use ($unidade){
        return DB::connection('sjd')->select('SELECT * FROM
        (SELECT fatd.id_fatd, envolvido.cargo, envolvido.nome, cdopm, 
            sjd_ref, sjd_ref_ano, abertura_data, 
            DIASUTEIS(abertura_data,DATE(NOW()))+1 AS dutotal,
            b.dusobrestado,
            (DIASUTEIS(abertura_data,DATE(NOW()))+1-IFNULL(b.dusobrestado,0)) AS diasuteis 
            FROM fatd
            LEFT JOIN
            (SELECT id_fatd, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado 
            FROM sobrestamento
                WHERE termino_data != :termino_data AND id_fatd != :id_fatd
                GROUP BY id_fatd) b
                ON b.id_fatd = fatd.id_fatd
            LEFT JOIN envolvido ON
                envolvido.id_fatd = fatd.id_fatd 
                AND envolvido.situacao = :situacao 
                AND rg_substituto = :rg_substituto
            WHERE fatd.id_andamento = :id_andamento 
            AND fatd.cdopm LIKE :opm) 
            AS dt WHERE dt.diasuteis > :diasuteis', 
            [
                'termino_data' => '0000-00-00',
                'id_fatd' => '',
                'situacao' => 'Encarregado',
                'rg_substituto' => '',
                'id_andamento' => '1',
                'opm' => $unidade.'%',
                'diasuteis' => '30'
            ]);
        });
        return $fatd_prazos;
    }  
    public static function aberturas($unidade){    
        $fatd_aberturas = Cache::remember('fatd_aberturas'.$unidade, 60, function() use ($unidade){
            return DB::table('fatd')
            ->where('cdopm', 'LIKE', $unidade.'%') 
            ->where('abertura_data','=','0000-00-00')
            ->get(); 
        });
        return $fatd_aberturas;
    }
    public static function QtdOMAnos($unidade, $ano='')
    {
        //inicializar a variável
        $fatd_ano = [];
        if($ano != '')
        {
            $fatd_ano = DB::connection('sjd')
            ->table('fatd')
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
                //Quantidade de FATD por ano
                $qtd_fatd_ano = DB::connection('sjd')
                ->table('fatd')
                ->select(DB::raw('count(sjd_ref) AS qtd'))
                ->where('sjd_ref_ano','=',$i)
                ->where('cdopm','like',$unidade.'%')
                ->groupBy('sjd_ref_ano')
                ->first();
                //insere no array para ficar 'ano' => 'qtd'
                $fatd_ano = array_add($fatd_ano,$i, $qtd_fatd_ano['qtd']);
            }
        }
        
        return $fatd_ano;
    }
}
