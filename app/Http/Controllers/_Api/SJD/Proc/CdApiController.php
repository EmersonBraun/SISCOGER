<?php

namespace App\Http\Controllers\_Api\SJD\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Repositories\Proc;
use App\Models\Sjd\Proc\Cd;
use App\Models\Sjd\Busca\Envolvido;
use App\Models\Sjd\Busca\Ofendido;
use App\Models\Sjd\Busca\Ligacao;
use App\Models\Sjd\Proc\Movimento;
use App\Models\Sjd\Proc\Sobrestamento;
use App\Models\Sjd\Arquivo\ArquivosApagado;

use DB;
use Cache;

class CdApiController extends Controller
{
    //tempo de cahe em minutos
    private static $expiration = 60; 

    public function index()
    {
        return redirect()->route('cd.lista');
    }

    public function lista()
    {
        $registros = Proc::lista('cd');
        //dd($registros);
        return view('procedimentos.cd.list.index',compact('registros'));
    }

    public function andamento( )
    {
        $registros = Proc::andamento('cd');
        return view('procedimentos.cd.list.andamento',compact('registros'));
    }

    // public function prazos()
    // {
    //     $registros = Proc::prazos('cd');
    //     //dd($registros);
    //     return view('procedimentos.cd.list.prazos',compact('registros'));
    // }

    public function rel_situacao()
    {
        $registros = Proc::lista('cd');
        return view('procedimentos.cd.list.rel_situacao',compact('registros'));
    }

    public function julgamento()
    {
        $registros = Proc::julgamento('cd');

        return view('procedimentos.cd.list.julgamento',compact('registros'));
    }

    public static function aberturas($unidade)
    {
        $cd_aberturas = Cache::remember('cd_aberturas'.$unidade, self::$expiration, function() use ($unidade){

            return DB::table('cd')
                ->where('cdopm', 'LIKE', $unidade.'%') 
                ->where('abertura_data','=','0000-00-00')
                ->get();

        });

        return $cd_aberturas;
    }

    public static function prazos($unidade)
    {
        $cd_prazos = Cache::remember('cd_prazos'.$unidade, self::$expiration, function() use ($unidade){

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
