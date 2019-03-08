<?php

namespace App\Http\Controllers\_Api\SJD\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Cache;
use DB;
use App\User;
use App\Repositories\CdRepository;

class CdApiController extends Controller
{
    public function find($id, CdRepository $repository)
    {
        return $repository->find($id);
    }

    public function refAno($ref, $ano, CdRepository $repository)
    {
        return $repository->refAno($ref, $ano);
    }

    public function all(CdRepository $repository)
    {
        return $repository->all();
    }

    public function ano($ano, CdRepository $repository)
    {
        return $repository->ano($ano);
    }

    public function andamento(CdRepository $repository)
    {
        return $repository->andamento();
    }

    public function andamentoAno($ano, CdRepository $repository)
    {
        return $repository->andamentoAno($ano);
    }

    // public function prazos(CdRepository $repository)
    // {
    //     return $repository->prazos();
    // }

    public function prazosAno($ano)
    {
        return $repository->prazosAno($ano);
    }

    public function relSituacao(CdRepository $repository)
    {
        return $repository->relSituacao($ano);
    }

    public function relSituacaoAno($ano, CdRepository $repository)
    {
        return $repository->relSituacaoAno($ano);
    }

    public function julgamento(CdRepository $repository)
    {
        return $repository->julgamento();
    }

    public function julgamentoAno($ano, CdRepository $repository)
    {
        return $repository->julgamentoAno($ano);
    }

    public static function aberturas($unidade)
    {
        $cd_aberturas = Cache::remember('cd_aberturas'.$unidade, 60, function() use ($unidade){
            return DB::table('cd')
                ->where('cdopm', 'LIKE', $unidade.'%') 
                ->where('abertura_data','=','0000-00-00')
                ->get();
        });
        return $cd_aberturas;
    }

    public static function prazos($unidade)
    {
        $cd_prazos = Cache::remember('cd_prazos'.$unidade, 60, function() use ($unidade){
            return DB::connection('sjd')
            ->select('SELECT * FROM (
            SELECT cd.id_cd, andamento, andamentocoger, envolvido.cargo, envolvido.nome, 
            cdopm, sjd_ref, sjd_ref_ano, abertura_data, DIASUTEIS(abertura_data,DATE(NOW())) AS dutotal,
            b.dusobrestado,
            (DIASUTEIS(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis FROM cd
            LEFT JOIN
            (SELECT id_cd, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado fROM sobrestamento
            WHERE termino_data !=:termino_data AND id_cd!=:id_cd
            GROUP BY id_cd) b
            ON b.id_cd = cd.id_cd
            LEFT JOIN envolvido ON
                envolvido.id_cd=cd.id_cd AND envolvido.situacao=:situacao AND rg_substituto=:rg_substituto
            LEFT JOIN andamento ON
                andamento.id_andamento=cd.id_andamento
            LEFT JOIN andamentocoger ON
                andamentocoger.id_andamentocoger=cd.id_andamentocoger 
                WHERE cd.id_andamento=:id_andamento) dt
            WHERE dt.cdopm LIKE :opm AND dt.diasuteis>:diasuteis',
            [
                'termino_data' => '0000-00-00',
                'id_cd' => '',
                'situacao' => 'Presidente',
                'rg_substituto' => '',
                'id_andamento' => '9',
                'opm' => $unidade.'%',
                'diasuteis' => '60'
            ]);
        });
        return $cd_prazos;
    }
    public static function QtdOMAnos($unidade, $ano='')
    {
        //inicializar a variável
        $cd_ano = [];
        if($ano != '')
        {
            $cd_ano = DB::connection('sjd')
            ->table('cd')
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
                //Quantidade de cd por ano
                $qtd_cd_ano = DB::connection('sjd')
                ->table('cd')
                ->select(DB::raw('count(sjd_ref) AS qtd'))
                ->where('sjd_ref_ano','=',$i)
                ->where('cdopm','like',$unidade.'%')
                ->groupBy('sjd_ref_ano')
                ->first();
                //insere no array para ficar 'ano' => 'qtd'
                $cd_ano = array_add($cd_ano,$i, $qtd_cd_ano['qtd']);
            }
        }
        
        return $cd_ano;
    }
}
