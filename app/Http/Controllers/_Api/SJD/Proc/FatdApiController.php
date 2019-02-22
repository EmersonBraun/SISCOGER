<?php

namespace App\Http\Controllers\_Api\SJD\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Repositories\Proc;

use DB;
use Cache;

class FatdApiController extends Controller
{
    //tempo de cahe em minutos
    private static $expiration = 60; 

    public static function lista($ano)
    {
        $registros = Proc::lista('fatd', $ano);

        return view('procedimentos.fatd.list.index',compact('registros','ano'));
    }

    public static function andamento( $ano)
    {
        $registros = Proc::lista('fatd', $ano);

        return view('procedimentos.fatd.list.andamento',compact('registros','ano'));
    }

    // public static function prazos($ano)
    // {

    //     $registros = Proc::prazos('fatd', $ano);

    //     return view('procedimentos.fatd.list.prazos',compact('registros','ano'));
    // }

    public static function rel_situacao( $ano)
    {
        $registros = Proc::lista('fatd', $ano);
        return view('procedimentos.fatd.list.rel_situacao',compact('registros','ano'));
    }

    public static function julgamento( $ano)
    {
        $registros = Proc::julgamento('fatd', $ano);

        return view('procedimentos.fatd.list.julgamento',compact('registros','ano'));
    }

    public static function punidos($unidade)
    {
        $fatd_punidos = Cache::remember('fatd_punidos'.$unidade, self::$expiration, function() use ($unidade){
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
        $fatd_prazos = Cache::remember('fatd_prazo'.$unidade, self::$expiration, function() use ($unidade){

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
        $fatd_aberturas = Cache::remember('fatd_aberturas'.$unidade, self::$expiration, function() use ($unidade){
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
