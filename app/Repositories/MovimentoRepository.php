<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Auth;
use Cache;
use App\User;
use App\Models\Sjd\Proc\Adl;
use App\Models\Sjd\Proc\Apfd;
use App\Models\Sjd\Proc\Cd;
use App\Models\Sjd\Proc\Cj;
use App\Models\Sjd\Proc\Desercao;
use App\Models\Sjd\Proc\Fatd;
use App\Models\Sjd\Proc\Ipm;
use App\Models\Sjd\Proc\Iso;
use App\Models\Sjd\Proc\It;
use App\Models\Sjd\Proc\Pad;
use App\Models\Sjd\Proc\ProcOutros;
use App\Models\Sjd\Proc\Sai;
use App\Models\Sjd\Proc\Sindicancia;

class Proc extends Controller
{
    
    
    public static function lista($proc, $ano='', $adc='')
    {
        //tempo de cahe
        $expiration = 60;
        //traz os dados do usuário
        $unidade = session('cdopmbase');
        //verifica se o usuário tem permissão para ver todas unidades
        $verTodasUnidades = session('ver_todas_unidades');

        //montar nome
        $todos = ($verTodasUnidades) ? 'todos_' : '';
        $ano = ($ano) ? $ano : '';
        $nadc = ($adc) ? $adc[0] : '';

        $nome = $todos.$proc.$ano.$nadc;

        $registros = Cache::remember($nome, $expiration, function() use ($proc, $todos, $unidade, $adc, $ano) {
            $query = DB::table($proc);
            if($proc == 'desercao') $query->join('envolvido', 'desercao.id_desercao', '=', 'envolvido.id_desercao');
            if(!$todos) $query->where('cdopm','like',$unidade.'%');
            if($adc) $query->where($adc[0], $adc[1], $adc[2]);
            if($ano) $query->where('sjd_ref_ano', $ano);
            return $query->get();
        });
        return $registros;
    }

    public static function prazos($proc, $ano='')
    {
        //traz os dados do usuário
        $unidade = session()->get('cdopmbase');
        //tempo de cahe
        $expiration = 60;

        //verifica se o usuário tem permissão para ver todas unidades
        $verTodasUnidades = session('ver_todas_unidades');
        $situacao = sistema('procSituacao',$proc);
        //dd($situacao);
        // $query = DB::table($proc)->select($proc.'.*');
        // $query->selectRaw('(SELECT motivo FROM sobrestamento WHERE sobrestamento.id_'.$proc.'='.$proc.'.id_'.$proc.' ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo');
        // $query->selectRaw('(SELECT motivo_outros FROM sobrestamento WHERE   sobrestamento.id_'.$proc.'='.$proc.'.id_'.$proc.' ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros');
        // $query->selectRaw('dias_uteis(abertura_data,DATE(NOW())) AS dutotal');
        // $query->join(DB::raw('(SELECT id_'.$proc.', SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado  
        // FROM sobrestamento WHERE termino_data != \'0000-00-00\' AND id_'.$proc.'!= \'\' GROUP BY id_'.$proc.' ORDER BY id_'.$proc.' ASC LIMIT 1) AS b'),function($join) use ($proc){
        //   $join->on('b.id_'.$proc, '=', $proc.'.id_'.$proc);
        // });
        // $query->join('envolvido', function ($join2) use ($proc, $situacao){
        //     $join2->on('envolvido.id_'.$proc, '=', $proc.'.id_'.$proc)
        //     ->where('envolvido.situacao', '=', $situacao)
        //     ->where('rg_substituto', '=', '');   
        // });
        // dd($query->get());
        if($verTodasUnidades)
        {
            if(!$ano)
            {
                $registros = Cache::remember($proc.'_prazo_opm', $expiration, function() use ($proc){
                    switch ($proc) {
                        case 'adl': 
                            return DB::connection('sjd')->select('SELECT adl.*, 
                            (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_adl=adl.id_adl ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                            (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_adl=adl.id_adl ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                            envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                            b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis FROM adl
                            LEFT JOIN
                            (SELECT id_adl, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                            WHERE termino_data !=:termino_data AND id_adl!=:id_adl GROUP BY id_adl ORDER BY id_adl ASC LIMIT 1) b
                            ON b.id_adl = adl.id_adl
                            LEFT JOIN envolvido ON
                                envolvido.id_adl=adl.id_adl AND envolvido.situacao=:situacao AND rg_substituto=:rg_substituto', 
                                [
                                    'termino_data' => '0000-00-00',
                                    'id_adl' => '',
                                    'situacao' => 'Presidente',
                                    'rg_substituto' => ''
                                ]); 
                            break;

                        case 'cd': 
                            return DB::connection('sjd')->select('SELECT cd.*, 
                            (SELECT  motivo FROM    sobrestamento WHERE  sobrestamento.id_cd=cd.id_cd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                            (SELECT  motivo_outros FROM  sobrestamento WHERE   sobrestamento.id_cd=cd.id_cd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                            envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                            b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis FROM cd
                            LEFT JOIN
                            (SELECT id_cd, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado fROM sobrestamento
                                WHERE termino_data !=:termino_data AND id_cd!=:id_cd GROUP BY id_cd) b ON b.id_cd = cd.id_cd
                            LEFT JOIN envolvido ON envolvido.id_cd=cd.id_cd AND envolvido.situacao=:situacao AND rg_substituto=:rg_substituto', 
                                [
                                    'termino_data' => '0000-00-00',
                                    'id_cd' => '',
                                    'situacao' => 'Presidente',
                                    'rg_substituto' => ''
                                ]); 
                        break;

                        case 'cj': 
                            return DB::connection('sjd')->select('SELECT cj.*, 
                            (SELECT  motivo FROM    sobrestamento WHERE   sobrestamento.id_cj=cj.id_cj ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                            (SELECT  motivo_outros FROM    sobrestamento WHERE   sobrestamento.id_cj=cj.id_cj ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                            envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                            b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis FROM cj
                            LEFT JOIN
                            (SELECT id_cj, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                                WHERE termino_data !=:termino_data AND id_cj!=:id_cj GROUP BY id_cj ORDER BY id_cj ASC LIMIT 1) b ON b.id_cj = cj.id_cj
                            LEFT JOIN envolvido ON envolvido.id_cj=cj.id_cj AND envolvido.situacao=:situacao AND rg_substituto=:rg_substituto', 
                                [
                                    'termino_data' => '0000-00-00',
                                    'id_cj' => '',
                                    'situacao' => 'Presidente',
                                    'rg_substituto' => ''
                                ]); 
                        break;

                        case 'fatd': 
                            return DB::connection('sjd')->select('SELECT DISTINCT fatd.*,
                            (SELECT  motivo FROM    sobrestamento WHERE   sobrestamento.id_fatd=fatd.id_fatd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                            (SELECT  motivo_outros FROM    sobrestamento WHERE sobrestamento.id_cj=cj.id_cj ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros,
                            envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW()))+1 AS dutotal, 
                            b.dusobrestado, 
                            (dias_uteis(abertura_data,DATE(NOW()))+1-IFNULL(b.dusobrestado,0)) AS diasuteis FROM fatd
                            LEFT JOIN
                            (SELECT id_fatd, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                                WHERE termino_data != :termino_data AND id_fatd!= :id_fatd GROUP BY id_fatd) b ON b.id_fatd = fatd.id_fatd
                            LEFT JOIN envolvido ON
                                envolvido.id_fatd=fatd.id_fatd AND envolvido.situacao = :situacao AND rg_substituto = :rg_substituto
                            WHERE  sjd_ref_ano  = :ano  ORDER BY id_fatd DESC', 
                                [
                                    'termino_data' => '0000-00-00',
                                    'id_fatd' => '',
                                    'situacao' => 'Encarregado',
                                    'rg_substituto' => '',
                                    'id_andamento' => '1',
                                    'ano' => $ano
                                ]);
                            break;

                        case 'ipm': 
                            return DB::connection('sjd')->select('SELECT ipm.*, envolvido.cargo, envolvido.nome, 
                            (DATEDIFF(DATE(NOW()),autuacao_data)+1) AS diasuteis FROM ipm
                            LEFT JOIN envolvido ON envolvido.id_ipm=ipm.id_ipm AND envolvido.situacao=:situacao AND rg_substituto=:rg_substituto', 
                                [
                                    'situacao' => 'Encarregado',
                                    'rg_substituto' => ''
                                ]); 
                        break;

                        case 'iso': 
                            return DB::connection('sjd')->select('SELECT iso.*, envolvido.cargo, envolvido.nome, 
                            (DATEDIFF(DATE(NOW()),abertura_data)+1) AS diasuteis FROM iso
                            LEFT JOIN envolvido ON envolvido.id_iso=iso.id_iso AND envolvido.situacao=:situacao AND rg_substituto=:rg_substituto', 
                                [
                                    'situacao' => 'Encarregado',
                                    'rg_substituto' => ''
                                ]); 
                        break;

                        case 'it': 
                            return DB::connection('sjd')->select('SELECT DISTINCT it.*, 
                            (SELECT  motivo FROM    sobrestamento WHERE   sobrestamento.id_it=it.id_it ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                            (SELECT  motivo_outros FROM    sobrestamento WHERE   sobrestamento.id_it=it.id_it ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                            envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                            b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis 
                            FROM it
                            LEFT JOIN
                            (SELECT id_it, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado 
                            FROM sobrestamento WHERE termino_data !=:termino_data AND id_it!=:id_it GROUP BY id_it) b ON b.id_it = it.id_it
                            LEFT JOIN envolvido ON envolvido.id_it=it.id_it AND envolvido.situacao=:situacao AND rg_substituto=:rg_substituto', 
                                [
                                    'termino_data' => '0000-00-00',
                                    'id_it' => '',
                                    'situacao' => 'Encarregado',
                                    'rg_substituto' => ''
                                ]); 
                        break;

                        case 'proc_outros': 
                            return DB::connection('sjd')->select('SELECT DISTINCT proc_outros.*,
                            dias_uteis(abertura_data,DATE(NOW())) AS ducorridos,
                            DATEDIFF(DATE(NOW()),abertura_data) AS dtcorridos,
                            dias_uteis(abertura_data,limite_data) AS dutotal,
                            DATEDIFF(limite_data,abertura_data) AS dttotal ,
                            dias_uteis(DATE(NOW()),limite_data) AS dufaltando,
                            DATEDIFF(limite_data,DATE(NOW())) AS dtfaltando
                            FROM proc_outros');
                        break;

                        //case 'sai': return Sai::get(); break;

                        case 'sindicancia': 
                            return DB::connection('sjd')->select('SELECT sindicancia.id_sindicancia, sindicancia.id_andamento, sindicancia.id_andamentocoger, 
                            (SELECT  motivo FROM    sobrestamento WHERE   sobrestamento.id_sindicancia=sindicancia.id_sindicancia ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                            (SELECT  motivo_outros FROM    sobrestamento WHERE sobrestamento.id_sindicancia=sindicancia.id_sindicancia ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                            envolvido.cargo, envolvido.nome, cdopm, sjd_ref, sjd_ref_ano, abertura_data, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                            b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis FROM sindicancia
                            LEFT JOIN
                            (SELECT id_sindicancia, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                                WHERE termino_data !=:termino_data AND id_sindicancia!=:id_sindicancia GROUP BY id_sindicancia ORDER BY id_sindicancia ASC LIMIT 1) b
                                ON b.id_sindicancia = sindicancia.id_sindicancia
                            LEFT JOIN envolvido ON envolvido.id_sindicancia=sindicancia.id_sindicancia AND envolvido.situacao=:situacao AND rg_substituto=:rg_substituto', 
                                [
                                    'termino_data' => '0000-00-00',
                                    'id_sindicancia' => '',
                                    'situacao' => 'Presidente',
                                    'rg_substituto' => ''
                                ]); 
                            break;
                        
                        case 'iso':
                            return DB::connection('sjd')->select('SELECT iso.*, envolvido.cargo, envolvido.nome, 
                            (DATEDIFF(DATE(NOW()),abertura_data)+1) AS diasuteis FROM iso
                            LEFT JOIN envolvido ON
                                envolvido.id_iso=iso.id_iso AND envolvido.situacao=:situacao AND rg_substituto=:rg_substituto', 
                                [
                                    'situacao' => 'Encarregado',
                                    'rg_substituto' => ''
                                ]);
                            break;

                        default: return 'Erro'; break;
                    }
                });
            }
            else
            {
                $registros = Cache::remember($proc.'_prazo_topm'.$ano, $expiration, function() use ($proc, $ano){
                    switch ($proc) {
                        case 'adl': 
                            return DB::connection('sjd')->select('SELECT adl.id_adl, adl.id_andamento, adl.id_andamentocoger, 
                            (SELECT  motivo FROM    sobrestamento WHERE   sobrestamento.id_adl=adl.id_adl ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                            (SELECT  motivo_outros FROM sobrestamento WHERE sobrestamento.id_adl=adl.id_adl ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1
                            ) AS motivo_outros, envolvido.cargo, envolvido.nome, cdopm, sjd_ref, sjd_ref_ano, abertura_data, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                            b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis FROM adl
                            LEFT JOIN
                            (SELECT id_adl, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento WHERE termino_data !=:termino_data AND id_adl!=:id_adl GROUP BY id_adl ORDER BY id_adl ASC LIMIT 1) b ON b.id_adl = adl.id_adl
                            LEFT JOIN envolvido ON envolvido.id_adl=adl.id_adl AND envolvido.situacao=:situacao AND rg_substituto=:rg_substituto
                            WHERE adl.sjd_ref_ano = :ano', 
                                [
                                    'termino_data' => '0000-00-00',
                                    'id_adl' => '',
                                    'situacao' => 'Presidente',
                                    'rg_substituto' => '',
                                    'ano' => $ano
                                ]); 
                        break;
    
                        case 'cd': 
                            return DB::connection('sjd')->select('SELECT cd.*, 
                            (SELECT  motivo FROM sobrestamento WHERE   sobrestamento.id_cd=cd.id_cd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                            (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_cd=cd.id_cd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1
                            ) AS motivo_outros, envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                            b.dusobrestado, 
                            (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis FROM cd
                            LEFT JOIN
                            (SELECT id_cd, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado fROM sobrestamento WHERE termino_data !=:termino_data AND id_cd!=:id_cd GROUP BY id_cd) b ON b.id_cd = cd.id_cd
                            LEFT JOIN envolvido ON envolvido.id_cd=cd.id_cd AND envolvido.situacao=:situacao AND rg_substituto=:rg_substituto
                            WHERE cd.sjd_ref_ano :ano', 
                                [
                                    'termino_data' => '0000-00-00',
                                    'id_cd' => '',
                                    'situacao' => 'Presidente',
                                    'rg_substituto' => '',
                                    'ano' => $ano
                                ]); 
                        break;
    
                        case 'cj': 
                            return DB::connection('sjd')->select('SELECT cj.*, 
                            (SELECT  motivo FROM sobrestamento WHERE   sobrestamento.id_cj=cj.id_cj ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                            (SELECT  motivo_outros FROM    sobrestamento WHERE sobrestamento.id_cj=cj.id_cj ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1
                            ) AS motivo_outros, envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                            b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis FROM cj
                            LEFT JOIN
                            (SELECT id_cj, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                                WHERE termino_data !=:termino_data AND id_cj!=:id_cj GROUP BY id_cj ORDER BY id_cj ASC LIMIT 1) b ON b.id_cj = cj.id_cj
                            LEFT JOIN envolvido ON envolvido.id_cj=cj.id_cj AND envolvido.situacao=:situacao AND rg_substituto=:rg_substituto
                            WHERE cj.sjd_ref_ano = :ano
                                ', 
                                [
                                    'termino_data' => '0000-00-00',
                                    'id_cj' => '',
                                    'situacao' => 'Presidente',
                                    'rg_substituto' => '',
                                    'ano' => $ano
                                ]); 
                        break;
                        

                        case 'fatd': 
                            return DB::connection('sjd')->select('SELECT DISTINCT fatd.*,
                            (SELECT  motivo FROM    sobrestamento WHERE   sobrestamento.id_fatd=fatd.id_fatd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                            (SELECT  motivo_outros FROM    sobrestamento WHERE sobrestamento.id_fatd=fatd.id_fatd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros,
                            envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW()))+1 AS dutotal, 
                            b.dusobrestado, 
                            (dias_uteis(abertura_data,DATE(NOW()))+1-IFNULL(b.dusobrestado,0)) AS diasuteis FROM fatd
                            LEFT JOIN
                            (SELECT id_fatd, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                                WHERE termino_data != :termino_data AND id_fatd!= :id_fatd GROUP BY id_fatd) b ON b.id_fatd = fatd.id_fatd
                            LEFT JOIN envolvido ON
                                envolvido.id_fatd=fatd.id_fatd AND envolvido.situacao = :situacao AND rg_substituto = :rg_substituto
                             WHERE  sjd_ref_ano  = :ano  ORDER BY id_fatd DESC', 
                                [
                                    'termino_data' => '0000-00-00',
                                    'id_fatd' => '',
                                    'situacao' => 'Encarregado',
                                    'rg_substituto' => '',
                                    'ano' => $ano
                                ]);
                            break;
    
                        case 'ipm': 
                            return DB::connection('sjd')->select('SELECT ipm.*, envolvido.cargo, envolvido.nome, 
                            (DATEDIFF(DATE(NOW()),autuacao_data)+1) AS diasuteis FROM ipm
                            LEFT JOIN envolvido ON envolvido.id_ipm=ipm.id_ipm AND envolvido.situacao=:situacao AND rg_substituto=:rg_substituto
                            WHERE ipm.sjd_ref_ano = :ano', 
                                [
                                    'situacao' => 'Encarregado',
                                    'rg_substituto' => '',
                                    'ano' => $ano
                                ]); 
                        break;
    
                        case 'iso': 
                            return DB::connection('sjd')->select('SELECT iso.*, envolvido.cargo, envolvido.nome, 
                            (DATEDIFF(DATE(NOW()),abertura_data)+1) AS diasuteis FROM iso
                            LEFT JOIN envolvido ON envolvido.id_iso=iso.id_iso AND envolvido.situacao=:situacao AND rg_substituto=:rg_substituto 
                            WHERE iso.sjd_ref_ano = :ano', 
                                [
                                    'situacao' => 'Encarregado',
                                    'rg_substituto' => '',
                                    'ano' => $ano
                                ]); 
                        break;
    
                        case 'it': 
                        return DB::connection('sjd')->select('SELECT DISTINCT it.*, 
                        (SELECT  motivo
                            FROM    sobrestamento
                            WHERE   sobrestamento.id_it=it.id_it 
                            ORDER BY sobrestamento.id_sobrestamento DESC
                            LIMIT 1
                        ) AS motivo,  
                        (
                            SELECT  motivo_outros
                            FROM    sobrestamento
                            WHERE   sobrestamento.id_it=it.id_it 
                            ORDER BY sobrestamento.id_sobrestamento DESC
                            LIMIT 1
                        ) AS motivo_outros, 
                        envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                        b.dusobrestado, 
                        (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis 
                        FROM it
                        LEFT JOIN
                        (SELECT id_it, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado 
                        FROM sobrestamento
                            WHERE termino_data !=:termino_data AND id_it!=:id_it 
                            GROUP BY id_it) b	
                            ON b.id_it = it.id_it
                        LEFT JOIN envolvido ON
                            envolvido.id_it=it.id_it AND envolvido.situacao=:situacao AND rg_substituto=:rg_substituto
                        WHERE it.sjd_ref_ano = :ano', 
                            [
                                'termino_data' => '0000-00-00',
                                'id_it' => '',
                                'situacao' => 'Encarregado',
                                'rg_substituto' => '',
                                'ano' => $ano
                            ]); 
                        break;
    
                        case 'proc_outros': 
                            return DB::connection('sjd')->select('SELECT DISTINCT proc_outros.*,
                            dias_uteis(abertura_data,DATE(NOW())) AS ducorridos,
                            DATEDIFF(DATE(NOW()),abertura_data) AS dtcorridos,
                            dias_uteis(abertura_data,limite_data) AS dutotal,
                            DATEDIFF(limite_data,abertura_data) AS dttotal ,
                            dias_uteis(DATE(NOW()),limite_data) AS dufaltando,
                            DATEDIFF(limite_data,DATE(NOW())) AS dtfaltando
                            FROM proc_outros WHERE proc_outros.sjd_ref_ano = :ano',[
                                'ano' => $ano
                            ]);
                            break;
    
                        //case 'sai': return Sai::get(); break;
    
                        case 'sindicancia': 
                        return DB::connection('sjd')->select('SELECT sindicancia.id_sindicancia, sindicancia.id_andamento, sindicancia.id_andamentocoger, 
                        (
                            SELECT  motivo
                            FROM    sobrestamento
                            WHERE   sobrestamento.id_sindicancia=sindicancia.id_sindicancia 
                            ORDER BY sobrestamento.id_sobrestamento DESC
                            LIMIT 1
                        ) AS motivo,  
                        (
                            SELECT  motivo_outros
                            FROM    sobrestamento
                            WHERE   sobrestamento.id_sindicancia=sindicancia.id_sindicancia 
                            ORDER BY sobrestamento.id_sobrestamento DESC
                            LIMIT 1
                        ) AS motivo_outros, envolvido.cargo, envolvido.nome, cdopm, sjd_ref, sjd_ref_ano, abertura_data, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                        b.dusobrestado, 
                        (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis FROM sindicancia
                        LEFT JOIN
                        (SELECT id_sindicancia, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                            WHERE termino_data !=:termino_data AND id_sindicancia!=:id_sindicancia 
                            GROUP BY id_sindicancia
                            ORDER BY id_sindicancia ASC
                            LIMIT 1) b
                            ON b.id_sindicancia = sindicancia.id_sindicancia
                        LEFT JOIN envolvido ON
                            envolvido.id_sindicancia=sindicancia.id_sindicancia 
                            AND envolvido.situacao=:situacao 
                            AND rg_substituto=:rg_substituto
                        WHERE sindicancia.sjd_ref_ano = :ano
                            ', 
                            [
                                'termino_data' => '0000-00-00',
                                'id_sindicancia' => '',
                                'situacao' => 'Presidente',
                                'rg_substituto' => '',
                                'ano' => $ano
                            ]); 
                        break;
    
                        default: return 'Erro'; break;
                    }
                });
            }
        }
        else 
        {
            if(!$ano)
            {
                $registros = Cache::remember($proc.$unidade.'_prazo_topm', $expiration, function() use ($proc, $unidade){
                    switch ($proc) {
                        case 'adl': 
                        return DB::connection('sjd')->select('SELECT adl.id_adl, adl.id_andamento, adl.id_andamentocoger, 
                        (
                            SELECT  motivo
                            FROM    sobrestamento
                            WHERE   sobrestamento.id_adl=adl.id_adl 
                            ORDER BY sobrestamento.id_sobrestamento DESC
                            LIMIT 1
                        ) AS motivo,  
                        (
                            SELECT  motivo_outros
                            FROM    sobrestamento
                            WHERE   sobrestamento.id_adl=adl.id_adl 
                            ORDER BY sobrestamento.id_sobrestamento DESC
                            LIMIT 1
                        ) AS motivo_outros, envolvido.cargo, envolvido.nome, cdopm, sjd_ref, sjd_ref_ano, abertura_data, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                        b.dusobrestado, 
                        (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis FROM adl
                        LEFT JOIN
                        (SELECT id_adl, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                            WHERE termino_data !=:termino_data AND id_adl!=:id_adl 
                            GROUP BY id_adl
                            ORDER BY id_adl ASC
                            LIMIT 1) b
                            ON b.id_adl = adl.id_adl 
                            AND adl.cdopm like :unidade%
                        LEFT JOIN envolvido ON
                            envolvido.id_adl=adl.id_adl 
                            AND envolvido.situacao=:situacao 
                            AND rg_substituto=:rg_substituto
                            ', 
                            [
                                'termino_data' => '0000-00-00',
                                'id_adl' => '',
                                'situacao' => 'Presidente',
                                'rg_substituto' => '',
                                'unidade' => $unidade
                            ]); 
                            break;
    
                        case 'cd': 
                        return DB::connection('sjd')->select('SELECT cd.*, 
                        (
                            SELECT  motivo
                            FROM    sobrestamento
                            WHERE   sobrestamento.id_cd=cd.id_cd 
                            ORDER BY sobrestamento.id_sobrestamento DESC
                            LIMIT 1
                        ) AS motivo,  
                        (
                            SELECT  motivo_outros
                            FROM    sobrestamento
                            WHERE   sobrestamento.id_cd=cd.id_cd 
                            ORDER BY sobrestamento.id_sobrestamento DESC
                            LIMIT 1
                        ) AS motivo_outros, envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                        b.dusobrestado, 
                        (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis FROM cd
                        LEFT JOIN
                        (SELECT id_cd, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado fROM sobrestamento
                            WHERE termino_data !=:termino_data AND id_cd!=:id_cd 
                            GROUP BY id_cd) b  
                            ON b.id_cd = cd.id_cd 
                            AND cd.cdopm like :unidade%
                        LEFT JOIN envolvido ON
                            envolvido.id_cd=cd.id_cd AND envolvido.situacao=:situacao AND rg_substituto=:rg_substituto', 
                            [
                                'termino_data' => '0000-00-00',
                                'id_cd' => '',
                                'situacao' => 'Presidente',
                                'rg_substituto' => '',
                                'unidade' => $unidade
                            ]); 
                        break;
    
                        case 'cj': 
                        return DB::connection('sjd')->select('SELECT cj.id_cj, cj.id_andamento, cj.id_andamentocoger, 
                        (
                            SELECT  motivo
                            FROM    sobrestamento
                            WHERE   sobrestamento.id_cj=cj.id_cj 
                            ORDER BY sobrestamento.id_sobrestamento DESC
                            LIMIT 1
                        ) AS motivo,  
                        (
                            SELECT  motivo_outros
                            FROM    sobrestamento
                            WHERE   sobrestamento.id_cj=cj.id_cj 
                            ORDER BY sobrestamento.id_sobrestamento DESC
                            LIMIT 1
                        ) AS motivo_outros, envolvido.cargo, envolvido.nome, cdopm, sjd_ref, sjd_ref_ano, abertura_data, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                        b.dusobrestado, 
                        (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis FROM cj
                        LEFT JOIN
                        (SELECT id_cj, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                            WHERE termino_data !=:termino_data AND id_cj!=:id_cj 
                            GROUP BY id_cj
                            ORDER BY id_cj ASC
                            LIMIT 1) b
                            ON b.id_cj = cj.id_cj
                            AND cj.cdopm like :unidade%
                        LEFT JOIN envolvido ON
                            envolvido.id_cj=cj.id_cj 
                            AND envolvido.situacao=:situacao 
                            AND rg_substituto=:rg_substituto
                            ', 
                            [
                                'termino_data' => '0000-00-00',
                                'id_cj' => '',
                                'situacao' => 'Presidente',
                                'rg_substituto' => '',
                                'unidade' => $unidade
                            ]); 
                        break;
    
                        case 'fatd': 
                        return DB::connection('sjd')->select('SELECT * FROM
                        (SELECT fatd.*, envolvido.cargo, envolvido.nome, 
                            dias_uteis(abertura_data,DATE(NOW()))+1 AS dutotal,b.dusobrestado,
                            (dias_uteis(abertura_data,DATE(NOW()))+1-IFNULL(b.dusobrestado,0)) AS diasuteis 
                            FROM fatd
                            LEFT JOIN
                            (SELECT id_fatd, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado 
                            FROM sobrestamento
                                WHERE termino_data != :termino_data AND id_fatd != :id_fatd
                                GROUP BY id_fatd) b
                                ON b.id_fatd = fatd.id_fatd
                            LEFT JOIN envolvido ON
                                envolvido.id_fatd = fatd.id_fatd 
                                AND envolvido.situacao = :situacao 
                                AND rg_substituto = :rg_substituto
                            WHERE fatd.id_andamento = :id_andamento
                            AND fatd.sjd_ref_ano = :ano 
                            AND fatd.cdopm like :unidade%) 
                            AS dt WHERE dt.diasuteis > :diasuteis', 
                            [
                                'termino_data' => '0000-00-00',
                                'id_fatd' => '',
                                'situacao' => 'Encarregado',
                                'rg_substituto' => '',
                                'id_andamento' => '1',
                                'ano' => $ano,
                                'diasuteis' => '30',
                                'unidade' => $unidade
                            ]);
                        break;
    
                        case 'ipm': 
                        return DB::connection('sjd')->select('SELECT ipm.*, envolvido.cargo, envolvido.nome, 
                        (DATEDIFF(DATE(NOW()),autuacao_data)+1) AS diasuteis FROM ipm
                        LEFT JOIN envolvido ON
                            envolvido.id_ipm=ipm.id_ipm AND envolvido.situacao=:situacao AND rg_substituto=:rg_substituto
                        WHERE ipm.cdopm like :unidade%', 
                            [
                                'situacao' => 'Encarregado',
                                'rg_substituto' => '',
                                'unidade' => $unidade
                            ]); 
                        break;
    
                        case 'iso': 
                        return DB::connection('sjd')->select('SELECT iso.*, envolvido.cargo, envolvido.nome, 
                        (DATEDIFF(DATE(NOW()),abertura_data)+1) AS diasuteis FROM iso
                        LEFT JOIN envolvido ON
                            envolvido.id_iso=iso.id_iso AND envolvido.situacao=:situacao AND rg_substituto=:rg_substituto
                        WHERE ipm.cdopm like :unidade%', 
                            [
                                'situacao' => 'Encarregado',
                                'rg_substituto' => '',
                                'unidade' => $unidade
                            ]); 
                        break;
    
                        case 'it': 
                        return DB::connection('sjd')->select('SELECT DISTINCT it.*, 
                        (
                            SELECT  motivo
                            FROM    sobrestamento
                            WHERE   sobrestamento.id_it=it.id_it 
                            ORDER BY sobrestamento.id_sobrestamento DESC
                            LIMIT 1
                        ) AS motivo,  
                        (
                            SELECT  motivo_outros
                            FROM    sobrestamento
                            WHERE   sobrestamento.id_it=it.id_it 
                            ORDER BY sobrestamento.id_sobrestamento DESC
                            LIMIT 1
                        ) AS motivo_outros, 
                        envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                        b.dusobrestado, 
                        (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis 
                        FROM it
                        LEFT JOIN
                        (SELECT id_it, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado 
                        FROM sobrestamento
                            WHERE termino_data !=:termino_data AND id_it!=:id_it 
                            GROUP BY id_it) b	
                            ON b.id_it = it.id_it 
                            AND it.cdopm like :unidade%
                        LEFT JOIN envolvido ON
                            envolvido.id_it=it.id_it AND envolvido.situacao=:situacao AND rg_substituto=:rg_substituto', 
                            [
                                'termino_data' => '0000-00-00',
                                'id_it' => '',
                                'situacao' => 'Encarregado',
                                'rg_substituto' => '',
                                'unidade' => $unidade
                            ]); 
                        break;
    
                        case 'proc_outros': 
                        return DB::connection('sjd')->select('SELECT DISTINCT proc_outros.*,
                        dias_uteis(abertura_data,DATE(NOW())) AS ducorridos,
                        DATEDIFF(DATE(NOW()),abertura_data) AS dtcorridos,
                        dias_uteis(abertura_data,limite_data) AS dutotal,
                        DATEDIFF(limite_data,abertura_data) AS dttotal ,
                        dias_uteis(DATE(NOW()),limite_data) AS dufaltando,
                        DATEDIFF(limite_data,DATE(NOW())) AS dtfaltando
                        FROM proc_outros WHERE proc_outros.cdopm like :unidade%',
                        [
                            'unidade' => $unidade
                        ]);
                        break;
    
                        //case 'sai': return Sai::get(); break;
    
                        case 'sindicancia': 
                        return DB::connection('sjd')->select('SELECT sindicancia.id_sindicancia, sindicancia.id_andamento, sindicancia.id_andamentocoger, 
                        (
                            SELECT  motivo
                            FROM    sobrestamento
                            WHERE   sobrestamento.id_sindicancia=sindicancia.id_sindicancia 
                            ORDER BY sobrestamento.id_sobrestamento DESC
                            LIMIT 1
                        ) AS motivo,  
                        (
                            SELECT  motivo_outros
                            FROM    sobrestamento
                            WHERE   sobrestamento.id_sindicancia=sindicancia.id_sindicancia 
                            ORDER BY sobrestamento.id_sobrestamento DESC
                            LIMIT 1
                        ) AS motivo_outros, envolvido.cargo, envolvido.nome, cdopm, sjd_ref, sjd_ref_ano, abertura_data, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                        b.dusobrestado, 
                        (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis FROM sindicancia
                        LEFT JOIN
                        (SELECT id_sindicancia, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                            WHERE termino_data !=:termino_data AND id_sindicancia!=:id_sindicancia 
                            GROUP BY id_sindicancia
                            ORDER BY id_sindicancia ASC
                            LIMIT 1) b
                            ON b.id_sindicancia = sindicancia.id_sindicancia 
                            AND sindicancia.cdopm like :unidade%
                        LEFT JOIN envolvido ON
                            envolvido.id_sindicancia=sindicancia.id_sindicancia 
                            AND envolvido.situacao=:situacao 
                            AND rg_substituto=:rg_substituto
                            ', 
                            [
                                'termino_data' => '0000-00-00',
                                'id_sindicancia' => '',
                                'situacao' => 'Presidente',
                                'rg_substituto' => '',
                                'unidade' => $unidade
                            ]); 
                        break;
    
                        default: return 'Erro'; break;
                    }
                }); 
            }
            else
            {
                //$registros = Cache::remember($proc.$unidade.'_prazo_topm', $expiration, function() use ($proc, $unidade, $ano){
                    switch ($proc) {
                        case 'adl': 
                        return DB::connection('sjd')->select('SELECT adl.id_adl, adl.id_andamento, adl.id_andamentocoger, 
                        (
                            SELECT  motivo
                            FROM    sobrestamento
                            WHERE   sobrestamento.id_adl=adl.id_adl 
                            ORDER BY sobrestamento.id_sobrestamento DESC
                            LIMIT 1
                        ) AS motivo,  
                        (
                            SELECT  motivo_outros
                            FROM    sobrestamento
                            WHERE   sobrestamento.id_adl=adl.id_adl 
                            ORDER BY sobrestamento.id_sobrestamento DESC
                            LIMIT 1
                        ) AS motivo_outros, envolvido.cargo, envolvido.nome, cdopm, sjd_ref, sjd_ref_ano, abertura_data, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                        b.dusobrestado, 
                        (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis FROM adl
                        LEFT JOIN
                        (SELECT id_adl, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                            WHERE termino_data !=:termino_data AND id_adl!=:id_adl 
                            GROUP BY id_adl
                            ORDER BY id_adl ASC
                            LIMIT 1) b
                            ON b.id_adl = adl.id_adl 
                            AND adl.cdopm like :unidade%
                        LEFT JOIN envolvido ON
                            envolvido.id_adl=adl.id_adl 
                            AND envolvido.situacao=:situacao 
                            AND rg_substituto=:rg_substituto
                            WHERE adl.sjd_ref_ano = :ano
                            ', 
                            [
                                'termino_data' => '0000-00-00',
                                'id_adl' => '',
                                'situacao' => 'Presidente',
                                'rg_substituto' => '',
                                'unidade' => $unidade,
                                'ano' => $ano
                            ]); 
                            break;
    
                        case 'cd': 
                        return DB::connection('sjd')->select('SELECT cd.*, 
                        (
                            SELECT  motivo
                            FROM    sobrestamento
                            WHERE   sobrestamento.id_cd=cd.id_cd 
                            ORDER BY sobrestamento.id_sobrestamento DESC
                            LIMIT 1
                        ) AS motivo,  
                        (
                            SELECT  motivo_outros
                            FROM    sobrestamento
                            WHERE   sobrestamento.id_cd=cd.id_cd 
                            ORDER BY sobrestamento.id_sobrestamento DESC
                            LIMIT 1
                        ) AS motivo_outros, envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                        b.dusobrestado, 
                        (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis FROM cd
                        LEFT JOIN
                        (SELECT id_cd, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado fROM sobrestamento
                            WHERE termino_data !=:termino_data AND id_cd!=:id_cd 
                            GROUP BY id_cd) b  
                            ON b.id_cd = cd.id_cd 
                            AND cd.cdopm like :unidade%
                        LEFT JOIN envolvido ON
                            envolvido.id_cd=cd.id_cd AND envolvido.situacao=:situacao AND rg_substituto=:rg_substituto
                        WHERE sjd_ref_ano = :ano', 
                            [
                                'termino_data' => '0000-00-00',
                                'id_cd' => '',
                                'situacao' => 'Presidente',
                                'rg_substituto' => '',
                                'unidade' => $unidade,
                                'ano' => $ano
                            ]); 
                        break;
    
                        case 'cj': 
                        return DB::connection('sjd')->select('SELECT cj.id_cj, cj.id_andamento, cj.id_andamentocoger, 
                        (
                            SELECT  motivo
                            FROM    sobrestamento
                            WHERE   sobrestamento.id_cj=cj.id_cj 
                            ORDER BY sobrestamento.id_sobrestamento DESC
                            LIMIT 1
                        ) AS motivo,  
                        (
                            SELECT  motivo_outros
                            FROM    sobrestamento
                            WHERE   sobrestamento.id_cj=cj.id_cj 
                            ORDER BY sobrestamento.id_sobrestamento DESC
                            LIMIT 1
                        ) AS motivo_outros, envolvido.cargo, envolvido.nome, cdopm, sjd_ref, sjd_ref_ano, abertura_data, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                        b.dusobrestado, 
                        (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis FROM cj
                        LEFT JOIN
                        (SELECT id_cj, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                            WHERE termino_data !=:termino_data AND id_cj!=:id_cj 
                            GROUP BY id_cj
                            ORDER BY id_cj ASC
                            LIMIT 1) b
                            ON b.id_cj = cj.id_cj
                            AND cj.cdopm like :unidade%
                        LEFT JOIN envolvido ON
                            envolvido.id_cj=cj.id_cj 
                            AND envolvido.situacao=:situacao 
                            AND rg_substituto=:rg_substituto
                        WHERE sjd_ref_ano = :ano', 
                            [
                                'termino_data' => '0000-00-00',
                                'id_cj' => '',
                                'situacao' => 'Presidente',
                                'rg_substituto' => '',
                                'unidade' => $unidade,
                                'ano' => $ano
                            ]); 
                        break;
    
                        case 'fatd': 
                        return DB::connection('sjd')->select('SELECT * FROM
                        (SELECT fatd.*, envolvido.cargo, envolvido.nome, 
                            dias_uteis(abertura_data,DATE(NOW()))+1 AS dutotal,b.dusobrestado,
                            (dias_uteis(abertura_data,DATE(NOW()))+1-IFNULL(b.dusobrestado,0)) AS diasuteis 
                            FROM fatd
                            LEFT JOIN
                            (SELECT id_fatd, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado 
                            FROM sobrestamento
                                WHERE termino_data != :termino_data AND id_fatd != :id_fatd
                                GROUP BY id_fatd) b
                                ON b.id_fatd = fatd.id_fatd
                            LEFT JOIN envolvido ON
                                envolvido.id_fatd = fatd.id_fatd 
                                AND envolvido.situacao = :situacao 
                                AND rg_substituto = :rg_substituto
                            WHERE fatd.id_andamento = :id_andamento
                            AND fatd.sjd_ref_ano = :ano 
                            AND fatd.cdopm like :unidade% 
                            AND sjd_ref_ano = :ano) 
                            AS dt WHERE dt.diasuteis > :diasuteis', 
                            [
                                'termino_data' => '0000-00-00',
                                'id_fatd' => '',
                                'situacao' => 'Encarregado',
                                'rg_substituto' => '',
                                'id_andamento' => '1',
                                'ano' => $ano,
                                'diasuteis' => '30',
                                'unidade' => $unidade,
                                'ano' => $ano
                            ]);
                        break;
    
                        case 'ipm': 
                        return DB::connection('sjd')->select('SELECT ipm.*, envolvido.cargo, envolvido.nome, 
                        (DATEDIFF(DATE(NOW()),autuacao_data)+1) AS diasuteis FROM ipm
                        LEFT JOIN envolvido ON
                            envolvido.id_ipm=ipm.id_ipm AND envolvido.situacao=:situacao AND rg_substituto=:rg_substituto
                        WHERE ipm.cdopm like :unidade% AND sjd_ref_ano = :ano', 
                            [
                                'situacao' => 'Encarregado',
                                'rg_substituto' => '',
                                'unidade' => $unidade,
                                'ano' => $ano
                            ]); 
                        break;
    
                        case 'iso': 
                        return DB::connection('sjd')->select('SELECT iso.*, envolvido.cargo, envolvido.nome, 
                        (DATEDIFF(DATE(NOW()),abertura_data)+1) AS diasuteis FROM iso
                        LEFT JOIN envolvido ON
                            envolvido.id_iso=iso.id_iso AND envolvido.situacao=:situacao AND rg_substituto=:rg_substituto
                        WHERE ipm.cdopm like :unidade% AND sjd_ref_ano = :ano', 
                            [
                                'situacao' => 'Encarregado',
                                'rg_substituto' => '',
                                'unidade' => $unidade,
                                'ano' => $ano
                            ]); 
                        break;
    
                        case 'it': 
                        return DB::connection('sjd')->select('SELECT DISTINCT it.*, 
                        (
                            SELECT  motivo
                            FROM    sobrestamento
                            WHERE   sobrestamento.id_it=it.id_it 
                            ORDER BY sobrestamento.id_sobrestamento DESC
                            LIMIT 1
                        ) AS motivo,  
                        (
                            SELECT  motivo_outros
                            FROM    sobrestamento
                            WHERE   sobrestamento.id_it=it.id_it 
                            ORDER BY sobrestamento.id_sobrestamento DESC
                            LIMIT 1
                        ) AS motivo_outros, 
                        envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                        b.dusobrestado, 
                        (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis 
                        FROM it
                        LEFT JOIN
                        (SELECT id_it, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado 
                        FROM sobrestamento
                            WHERE termino_data !=:termino_data AND id_it!=:id_it 
                            GROUP BY id_it) b	
                            ON b.id_it = it.id_it 
                            AND it.cdopm like :unidade%
                        LEFT JOIN envolvido ON
                            envolvido.id_it=it.id_it AND envolvido.situacao=:situacao AND rg_substituto=:rg_substituto
                        WHERE sjd_ref_ano = :ano', 
                            [
                                'termino_data' => '0000-00-00',
                                'id_it' => '',
                                'situacao' => 'Encarregado',
                                'rg_substituto' => '',
                                'unidade' => $unidade,
                                'ano' => $ano
                            ]); 
                        break;
    
                        case 'proc_outros': 
                        return DB::connection('sjd')->select('SELECT DISTINCT proc_outros.*,
                        dias_uteis(abertura_data,DATE(NOW())) AS ducorridos,
                        DATEDIFF(DATE(NOW()),abertura_data) AS dtcorridos,
                        dias_uteis(abertura_data,limite_data) AS dutotal,
                        DATEDIFF(limite_data,abertura_data) AS dttotal ,
                        dias_uteis(DATE(NOW()),limite_data) AS dufaltando,
                        DATEDIFF(limite_data,DATE(NOW())) AS dtfaltando
                        FROM proc_outros WHERE proc_outros.cdopm like :unidade% AND sjd_ref_ano = :ano',
                        [
                            'unidade' => $unidade,
                            'ano' => $ano
                        ]);
                        break;
    
                        //case 'sai': return Sai::get(); break;
    
                        case 'sindicancia': 
                        return DB::connection('sjd')->select('SELECT sindicancia.id_sindicancia, sindicancia.id_andamento, sindicancia.id_andamentocoger, 
                        (
                            SELECT  motivo
                            FROM    sobrestamento
                            WHERE   sobrestamento.id_sindicancia=sindicancia.id_sindicancia 
                            ORDER BY sobrestamento.id_sobrestamento DESC
                            LIMIT 1
                        ) AS motivo,  
                        (
                            SELECT  motivo_outros
                            FROM    sobrestamento
                            WHERE   sobrestamento.id_sindicancia=sindicancia.id_sindicancia 
                            ORDER BY sobrestamento.id_sobrestamento DESC
                            LIMIT 1
                        ) AS motivo_outros, envolvido.cargo, envolvido.nome, cdopm, sjd_ref, sjd_ref_ano, abertura_data, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                        b.dusobrestado, 
                        (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis FROM sindicancia
                        LEFT JOIN
                        (SELECT id_sindicancia, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                            WHERE termino_data !=:termino_data AND id_sindicancia!=:id_sindicancia 
                            GROUP BY id_sindicancia
                            ORDER BY id_sindicancia ASC
                            LIMIT 1) b
                            ON b.id_sindicancia = sindicancia.id_sindicancia 
                            AND sindicancia.cdopm like :unidade%
                        LEFT JOIN envolvido ON
                            envolvido.id_sindicancia=sindicancia.id_sindicancia 
                            AND envolvido.situacao=:situacao 
                            AND rg_substituto=:rg_substituto
                            AND sjd_ref_ano = :ano', 
                            [
                                'termino_data' => '0000-00-00',
                                'id_sindicancia' => '',
                                'situacao' => 'Presidente',
                                'rg_substituto' => '',
                                'unidade' => $unidade,
                                'ano' => $ano
                            ]); 
                        break;
    
                        default: return 'Erro'; break;
                    }
                //}); 
            }
            
        }
        return $registros;
    }

    public static function andamento($proc, $ano='', $adc='')
    {
        //tempo de cahe
        $expiration = 60;
        //traz os dados do usuário
        $unidade = session()->get('cdopmbase');
        //verifica se o usuário tem permissão para ver todas unidades
        $verTodasUnidades = session('ver_todas_unidades');

        //montar nome
        $todos = ($verTodasUnidades) ? 'todos_' : '';
        $ano = ($ano) ? $ano : '';
        $nadc = ($adc) ? $adc[0] : '';

        $nome = 'andamentos'.$todos.$proc.$ano.$nadc;

        $registros = Cache::remember($nome, $expiration, function() use ($proc, $todos, $unidade, $adc, $ano) {
            $query = DB::table($proc);
            if(!$todos) $query->where('cdopm','like',$unidade.'%');
            if($adc) $query->where($adc[0], $adc[1], $adc[2]);
            if($ano) $query->where('sjd_ref_ano', '=' ,$ano);
            if($proc == 'adl' || $proc == 'cd' || $proc == 'cj') 
            {
                $query->leftJoin('envolvido', function ($join) use ($proc){
                    $join->on('envolvido.id_'.$proc, '=', $proc.'.id_'.$proc)
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                });
            }
            if($proc == 'ipm' || $proc == 'iso' || $proc == 'it')
            {
                $query->join('envolvido', function ($join) {
                    $join->on('envolvido.id_'.$proc, '=', $proc.'.id_'.$proc)
                            ->where('envolvido.id_'.$proc, '<>', 0);
                })
                ->where('envolvido.situacao','=','Encarregado');
            } 

            return $query->get();
        });
        return $registros;

    }


    public static function julgamento($proc, $ano='', $adc='')
    {
        //tempo de cahe
        $expiration = 60;
        //traz os dados do usuário
        $unidade = session('cdopmbase');
        //verifica se o usuário tem permissão para ver todas unidades
        $verTodasUnidades = session('ver_todas_unidades');

        //montar nome
        $todos = ($verTodasUnidades) ? 'todos_' : '';
        $ano = ($ano) ? $ano : '';
        $nadc = ($adc) ? $adc[0] : '';

        $nome = $todos.'julgamento'.$proc.$ano.$nadc;

        $registros = Cache::remember($nome, $expiration, function() use ($proc, $todos, $unidade, $adc, $ano) {
            $query = DB::table($proc);
            if(!$todos) $query->where('cdopm','like',$unidade.'%');
            if($adc) $query->where($adc[0], $adc[1], $adc[2]);
            if($ano) $query->where('sjd_ref_ano','=',$ano);
            if($proc != 'desercao') 
            {
                $query->leftJoin('envolvido', function ($join) use ($proc) {
                    $join->on('envolvido.id_'.$proc, '=', $proc.'.id_'.$proc)
                            ->where('envolvido.id_'.$proc, '<>', 0);
                })
                ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                ->where('envolvido.situacao','=',sistema('procSituacao',$proc));
            }
            else
            {
                $query->join('envolvido', 'desercao.id_desercao', '=', 'envolvido.id_desercao');
            } 

            return $query->get(); 
        });

        return $registros;
    }

}
