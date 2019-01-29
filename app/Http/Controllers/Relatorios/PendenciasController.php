<?php

namespace App\Http\Controllers\Relatorios;

use Cache;
use App\User;
use App\Models\Sjd\Relatorios\Pendencia as Pendencia;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
class PendenciasController extends Controller
{
    public function index()
    {
        //tempo de cahe em minutos
        $expiration = 60; 

        //caso não tenha argumentos a função pega a unidade do login
        $unidade = (func_num_args() <= 0 ) ? $unidade = session()->get('cdopmbase') : func_get_args();

        //os argumentos vem em array assim faz o cast para string
        $unidade = (is_array($unidade)) ? head($unidade) : $unidade;

        //nome da unidade caso não seja a logada
        $nome_unidade = ($unidade != session()->get('cdopmbase')) ? opm($unidade) : '';

        //caso não tenha unidade desloga
        if($unidade == NULL || $unidade == '')
        {
            Auth::logout();
            return redirect()->intended('login');
        }

        //PENDENCIA #0: TRANSFERIDOS

        //buscar dados do cache
        $transferidos = Cache::remember('transferidos'.$unidade, $expiration, function() use ($unidade){
            
            $date = \Carbon\Carbon::today()->subDays(7);
            $query = DB::connection('pass')->table('movimentos');
            $query->orWhere('opmorigem','like',$unidade.'%')
                    ->orWhere('opmdestino','like',$unidade.'%');
            $query->orWhere(function($subquery)
            {
                $subquery = DB::connection('pass')->table('PPusuarios');
                $subquery->select('UserRG');
                $subquery->join('PPUsuarioGrupo', function ($join)
                {
                    $join->on('PPUsuarioGrupo.UserID', '=', 'PPUsuarios.UserID')
                            ->where([
                                ['PPUsuarioGrupo.GrupoID', '=','31'],//CTI - Ordens de Serviço
                                ['PPUsuarioGrupo.GrupoID', '=','71'],//CTI - INVENTARIO
                                ['PPUsuarioGrupo.GrupoID', '=','90'],//SJD - PROCESSOS
                                ['PPUsuarioGrupo.GrupoID', '=','95'],//CTI - DESENVOLVIMENTO
                                ['PPUsuarioGrupo.GrupoID', '=','95'],//CTI - SUPORTE
                                ['PPUsuarioGrupo.GrupoID', '=','97'],//CTI - INVENTARIO
                                ['PPUsuarioGrupo.GrupoID', '=','100'],//CPP - Sistema de Controle
                                ['PPUsuarioGrupo.GrupoID', '=','116'],//PROXY 02
                        ]);
                });  
            });
            $query->where('data','>=',$date);

            return $query->get();

        });

        
        //PENDENCIA #1: COMPORTAMENTO
        $rgs = Cache::remember('rgs'.$unidade, $expiration, function() use ($unidade){

            //rgs dos praças da unidade
            return DB::connection('rhparana')
            ->table('POLICIAL') 
            ->select('rg')
            ->where('cdopm', 'LIKE', $unidade.'%')
            ->where([
                ['cargo', '<>', 'CELAGREG'],
                ['cargo', '<>', 'CEL'],
                ['cargo', '<>', 'TENCEL'],
                ['cargo', '<>', 'MAJ'],
                ['cargo', '<>', 'CAP'],
                ['cargo', '<>', '1TEN'],
                ['cargo', '<>', '2TEN'],
            ])->get();

        });

        $comportamentos = Cache::remember('comportamentos'.$unidade, $expiration, function() use ($rgs){
           /*busca na VIEW comportamento_tempo que é a junção das tabelas 
            *comportamento e comportamentopm
            */
            return DB::connection('sjd')
            ->table('comportamento_tempo')
            ->whereIn('rg',$rgs)
            ->latest('recente')
            ->orderBy('recente','DESC')
            ->get();
        });
        
        //PENDENCIA #2: CADASTRO DE PUNICAO NO FATD MARCADO COMO PUNIDO

       $fatd_punidos = Cache::remember('fatd_punidos'.$unidade, $expiration, function() use ($unidade){
            return DB::connection('sjd')
            ->table('view_fatd_punicao')
            ->where('cdopm', 'LIKE', $unidade.'%') 
            ->where('id_punicao','=','0')
            ->get();
        });      

        //PENDENCIA #2.1: PRAZO DO FATD
        $fatd_prazos = Cache::remember('fatd_prazo'.$unidade, $expiration, function() use ($unidade){

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

        //PENDENCIA #2.2: FATD SEM DATA DE ABERTURA
        
        $fatd_aberturas = Cache::remember('fatd_aberturas'.$unidade, $expiration, function() use ($unidade){
            return DB::table('fatd')
            ->where('cdopm', 'LIKE', $unidade.'%') 
            ->where('abertura_data','=','0000-00-00')
            ->get(); 
        });

        
        //PENDENCIA #3: PERDA DE PRAZO EM IPM
        $ipm_prazos = Cache::remember('ipm_prazos'.$unidade, $expiration, function() use ($unidade){

        return DB::table('view_ipm_prazo')
            ->where('cdopm', 'LIKE', $unidade.'%') 
            ->where('diasuteis','>','60')
            ->get();
            
        });

        //PENDENCIA #3.1: ipm SEM DATA DE ABERTURA

        $ipm_aberturas = Cache::remember('ipm_aberturas'.$unidade, $expiration, function() use ($unidade){

        return DB::table('ipm')
            ->where('cdopm', 'LIKE', $unidade.'%') 
            ->where('autuacao_data','=','0000-00-00')
            ->get();

        });
        

        //PENDENCIA #4: PRAZO DAS SINDICANCIAS
        $sindicancia_prazos = Cache::remember('sindicancia_prazos'.$unidade, $expiration, function() use ($unidade){
        
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

        //PENDENCIA #4.1: SINDICANCIA SEM DATA DE ABERTURA
        $sindicancia_aberturas = Cache::remember('sindicancias_aberturas'.$unidade, $expiration, function() use ($unidade){
        
            return DB::table('ipm')
            ->where('cdopm', 'LIKE', $unidade.'%') 
            ->where('abertura_data','=','0000-00-00')
            ->get();

        });

        //PENDENCIA #5: CONSELHOS DE DISCIPLINA SEM DATA DE ABERTURA
        $cd_aberturas = Cache::remember('cd_aberturas'.$unidade, $expiration, function() use ($unidade){

            return DB::table('cd')
                ->where('cdopm', 'LIKE', $unidade.'%') 
                ->where('abertura_data','=','0000-00-00')
                ->get();

        });

        //PENDENCIA #5.1: CONSELHOS DE DISCIPLINA - PRAZO
        $cd_prazos = Cache::remember('cd_prazos'.$unidade, $expiration, function() use ($unidade){

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

        //EFETIVO
        $efetivo = Cache::remember('efetivo'.$unidade, $expiration, function() use ($unidade){

        return DB::connection('rhparana')
        ->table('policial')
        ->select('cargo', DB::raw('count(cargo) AS qtd'))
                ->where('cdopm','like',$unidade.'%')
                ->groupBy('cargo')
                ->havingRaw('count(cargo) > ?', [0])
                ->orderBy('qtd','asc')
                ->get();
        });

        //TOTAL EFETIVO
        $total_efetivo = Cache::remember('total_efetivo'.$unidade, $expiration, function() use ($unidade){

            return DB::connection('rhparana')
            ->table('policial')
            ->select(DB::raw('count(cargo) AS qtd'))
                    ->where('cdopm','like',$unidade.'%')
                    ->first();
        });

        //cast para objeto
        $total_efetivo = (object) $total_efetivo;

        //formatar array para o gráfico
        $qtd = array_pluck($efetivo, 'qtd');
        $cargo = array_pluck($efetivo, 'cargo');

        //criar dados do gráfico
        $efetivo_chartjs = app()->chartjs
            ->name('efetivo')
            ->type('pie')
            ->size(['width' => 600, 'height' => 200])
            ->labels($cargo)
            ->datasets([
                [
                    'backgroundColor' => config('sistema.default_colors'),
                    'hoverBackgroundColor' => config('sistema.default_colors'),
                    'data' => $qtd
                ]
            ])
            ->options([
                'animationEasing'      => 'easeOutCirc',
                'legend' => [
                    'display' => true,
                    'position' => 'left'
                ]
            ]);

        //Quantidade de procedimentos por ano

        //inicializar a variável
        $fatd_ano = [];

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

        //inicializar a variável
        $ipm_ano = [];

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

        //inicializar a variável
        $sindicancia_ano = [];

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

        //inicializar a variável
        $cd_ano = [];

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

        //divide o array para usar no gráfico
        [$anos, $fatd_ano] = array_divide($fatd_ano);
        [$anos, $ipm_ano] = array_divide($ipm_ano);
        [$anos, $sindicancia_ano] = array_divide($sindicancia_ano);
        [$anos, $cd_ano] = array_divide($cd_ano);
        

        $chartjs = app()->chartjs
        ->name('lineChartTest')
        ->type('line')
        ->size(['width' => 500, 'height' => 200])
        ->labels($anos)
        ->datasets([
            [
                "label" => "FATD",
                'backgroundColor' => "rgba(0, 0, 0, 0.05)",
                'borderColor' => "rgba(51, 102, 204, 0.5)",
                "pointBorderColor" => "rgba(51, 102, 204, 0.5)",
                "pointBackgroundColor" => "rgba(51, 102, 204, 0.5)",
                "pointHoverBackgroundColor" => "rgba(51, 102, 204, 0.5)",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $fatd_ano,
            ],
            [
                "label" => "IPM",
                'backgroundColor' => "rgba(0, 0, 0, 0.05)",
                'borderColor' => "rgba(220, 57, 18, 0.5)",
                "pointBorderColor" => "rgba(220, 57, 18, 0.5)",
                "pointBackgroundColor" => "rgba(220, 57, 18, 0.5)",
                "pointHoverBackgroundColor" => "rgba(220, 57, 18, 0.5)",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $ipm_ano,
            ],
            [
                "label" => "Sindicância",
                'backgroundColor' => "rgba(0, 0, 0, 0.05)",
                'borderColor' => "rgba(255, 153, 0, 0.5)",
                "pointBorderColor" => "rgba(255, 153, 0, 0.5)",
                "pointBackgroundColor" => "rgba(255, 153, 0, 0.5)",
                "pointHoverBackgroundColor" => "rgba(255, 153, 0, 0.5)",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $sindicancia_ano,
            ],
            [
                "label" => "CD",
                'backgroundColor' => "rgba(0, 0, 0, 0.05)",
                'borderColor' => "rgba(16, 150, 24, 0.5)",
                "pointBorderColor" => "rgba(16, 150, 24, 0.5)",
                "pointBackgroundColor" => "rgba(16, 150, 24, 0.5)",
                "pointHoverBackgroundColor" => "rgba(16, 150, 24, 0.5)",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $cd_ano,
            ]
        ])
        ->options([]);
        
        //contagens
        $ttransferidos = count($transferidos);
        $tfatd_punidos = count($fatd_punidos);
        $tfatd_prazos = count($fatd_prazos);
        $tfatd_aberturas = count($fatd_aberturas);
        $tipm_prazos = count($ipm_prazos);
        $tipm_aberturas = count($ipm_aberturas);
        $tsindicancia_prazos = count($sindicancia_prazos);
        $tsindicancia_aberturas = count($sindicancia_aberturas);
        $tcd_aberturas = count($cd_aberturas);
        $tcd_prazos = count($cd_prazos);

        $fatd_total = $tfatd_punidos + $tfatd_prazos + $tfatd_aberturas;
        $ipm_total = $tipm_prazos + $tipm_aberturas;
        $sindicancia_total = $tsindicancia_prazos + $tsindicancia_aberturas;
        $cd_total = $tcd_aberturas + $tcd_prazos;
        
        //ATUALIZAR PENDÊNCIAS GERAIS
        //aproveita que já tem as somas de pendências para inserir na tabela de pendências gerais
        $pendencia = Pendencia::where('cdopm','=',$unidade)->first();
        $pendencia->fatd_punicao = $tfatd_punidos; 
        $pendencia->fatd_prazo = $tfatd_prazos;
        $pendencia->fatd_abertura = $tfatd_aberturas;
        $pendencia->ipm_prazo = $tipm_prazos;
        $pendencia->ipm_abertura = $tipm_aberturas;
        $pendencia->sindicancia_prazo = $tsindicancia_prazos; 
        $pendencia->sindicancia_abertura = $tsindicancia_aberturas; 
        $pendencia->save();

        return view('home',compact(
            'transferidos', 
            'comportamentos',
            'fatd_punidos',
            'fatd_punidos',
            'fatd_prazos',
            'fatd_aberturas',
            'fatd_total',
            'ipm_prazos',
            'ipm_aberturas',
            'ipm_total',
            'sindicancia_prazos',
            'sindicancia_aberturas',
            'sindicancia_total',
            'cd_aberturas',
            'cd_prazos',
            'cd_total',
            'efetivo_chartjs',
            'chartjs',
            'total_efetivo',
            'ttransferidos',
            'tfatd_punidos',
            'tfatd_punidos',
            'tfatd_prazos',
            'tfatd_aberturas',
            'tfatd_total',
            'tipm_prazos',
            'tipm_aberturas',
            'tipm_total',
            'tsindicancia_prazos',
            'tsindicancia_aberturas',
            'tsindicancia_total',
            'tcd_aberturas',
            'tcd_prazos',
            'tcd_total',
            'nome_unidade', 
            'unidade' 
            ));
    }

    public function trocaropm(Request $request)
    {
        include 'app/includes/opms.php';
        return view('relatorios.trocar_opm',compact('opms','selected','firstGroup'));
    }

    public function geral()
    {
        //tempo de cahe em minutos
        $expiration = 60;

        $pendencias = Cache::remember('total_pendencias_gerais', $expiration, function(){
            return Pendencia::select('pendencias.*',DB::raw ('(fatd_punicao+fatd_prazo+fatd_abertura+ipm_prazo+ipm_abertura+sindicancia_prazo+sindicancia_abertura) AS total'))->get();
        });

        //buscas para os gráficos
        $cg = Cache::remember('cg_pendencias', $expiration, function(){
            return 
            Pendencia::select(DB::raw ('
            IFNULL(sum(comportamento),0) comportamento, IFNULL(sum(fatd_punicao),0) fatd_punicao,IFNULL(sum(fatd_prazo),0) fatd_prazo, 
            IFNULL(sum(fatd_abertura),0) fatd_abertura, IFNULL(sum(ipm_prazo),0) ipm_prazo, IFNULL(sum(ipm_abertura),0) ipm_abertura, 
            IFNULL(sum(sindicancia_prazo),0) sindicancia_prazo, IFNULL(sum(sindicancia_abertura ),0) sindicancia_abertura,
            (fatd_punicao+fatd_prazo+fatd_abertura+ipm_prazo+ipm_abertura+sindicancia_prazo+sindicancia_abertura) AS total'))
            ->where('cdopm','like',0)
            ->first();
        });
        
        $em = Cache::remember('em_pendencias', $expiration, function(){
            return 
            Pendencia::select(DB::raw ('
            IFNULL(sum(comportamento),0) comportamento, IFNULL(sum(fatd_punicao),0) fatd_punicao,IFNULL(sum(fatd_prazo),0) fatd_prazo, 
            IFNULL(sum(fatd_abertura),0) fatd_abertura, IFNULL(sum(ipm_prazo),0) ipm_prazo, IFNULL(sum(ipm_abertura),0) ipm_abertura, 
            IFNULL(sum(sindicancia_prazo),0) sindicancia_prazo, IFNULL(sum(sindicancia_abertura ),0) sindicancia_abertura,
            (fatd_punicao+fatd_prazo+fatd_abertura+ipm_prazo+ipm_abertura+sindicancia_prazo+sindicancia_abertura) AS total'))
            ->where('cdopm','like',1)
            ->first();
        });

        $crpm1 = Cache::remember('c1_pendencias', $expiration, function(){
            return 
            Pendencia::select(DB::raw ('
            IFNULL(sum(comportamento),0) comportamento, IFNULL(sum(fatd_punicao),0) fatd_punicao,IFNULL(sum(fatd_prazo),0) fatd_prazo, 
            IFNULL(sum(fatd_abertura),0) fatd_abertura, IFNULL(sum(ipm_prazo),0) ipm_prazo, IFNULL(sum(ipm_abertura),0) ipm_abertura, 
            IFNULL(sum(sindicancia_prazo),0) sindicancia_prazo, IFNULL(sum(sindicancia_abertura ),0) sindicancia_abertura,
            (fatd_punicao+fatd_prazo+fatd_abertura+ipm_prazo+ipm_abertura+sindicancia_prazo+sindicancia_abertura) AS total'))
            ->where('cdopm','like',2)
            ->first();
        });

        $crpm2 = Cache::remember('c2_pendencias', $expiration, function(){
            return 
            Pendencia::select(DB::raw ('
            IFNULL(sum(comportamento),0) comportamento, IFNULL(sum(fatd_punicao),0) fatd_punicao,IFNULL(sum(fatd_prazo),0) fatd_prazo, 
            IFNULL(sum(fatd_abertura),0) fatd_abertura, IFNULL(sum(ipm_prazo),0) ipm_prazo, IFNULL(sum(ipm_abertura),0) ipm_abertura, 
            IFNULL(sum(sindicancia_prazo),0) sindicancia_prazo, IFNULL(sum(sindicancia_abertura ),0) sindicancia_abertura,
            (fatd_punicao+fatd_prazo+fatd_abertura+ipm_prazo+ipm_abertura+sindicancia_prazo+sindicancia_abertura) AS total'))
            ->where('cdopm','like',3)
            ->first();
        });

        $crpm3 = Cache::remember('c3_pendencias', $expiration, function(){
            return 
            Pendencia::select(DB::raw ('
            IFNULL(sum(comportamento),0) comportamento, IFNULL(sum(fatd_punicao),0) fatd_punicao,IFNULL(sum(fatd_prazo),0) fatd_prazo, 
            IFNULL(sum(fatd_abertura),0) fatd_abertura, IFNULL(sum(ipm_prazo),0) ipm_prazo, IFNULL(sum(ipm_abertura),0) ipm_abertura, 
            IFNULL(sum(sindicancia_prazo),0) sindicancia_prazo, IFNULL(sum(sindicancia_abertura ),0) sindicancia_abertura,
            (fatd_punicao+fatd_prazo+fatd_abertura+ipm_prazo+ipm_abertura+sindicancia_prazo+sindicancia_abertura) AS total'))
            ->where('cdopm','like',4)
            ->first();
        });

        $crpm4 = Cache::remember('c4_pendencias', $expiration, function(){
            return 
            Pendencia::select(DB::raw ('
            IFNULL(sum(comportamento),0) comportamento, IFNULL(sum(fatd_punicao),0) fatd_punicao,IFNULL(sum(fatd_prazo),0) fatd_prazo, 
            IFNULL(sum(fatd_abertura),0) fatd_abertura, IFNULL(sum(ipm_prazo),0) ipm_prazo, IFNULL(sum(ipm_abertura),0) ipm_abertura, 
            IFNULL(sum(sindicancia_prazo),0) sindicancia_prazo, IFNULL(sum(sindicancia_abertura ),0) sindicancia_abertura,
            (fatd_punicao+fatd_prazo+fatd_abertura+ipm_prazo+ipm_abertura+sindicancia_prazo+sindicancia_abertura) AS total'))
            ->where('cdopm','like',5)
            ->first();
        });

        $crpm5 = Cache::remember('c5_pendencias', $expiration, function(){
            return 
            Pendencia::select(DB::raw ('
            IFNULL(sum(comportamento),0) comportamento, IFNULL(sum(fatd_punicao),0) fatd_punicao,IFNULL(sum(fatd_prazo),0) fatd_prazo, 
            IFNULL(sum(fatd_abertura),0) fatd_abertura, IFNULL(sum(ipm_prazo),0) ipm_prazo, IFNULL(sum(ipm_abertura),0) ipm_abertura, 
            IFNULL(sum(sindicancia_prazo),0) sindicancia_prazo, IFNULL(sum(sindicancia_abertura ),0) sindicancia_abertura,
            (fatd_punicao+fatd_prazo+fatd_abertura+ipm_prazo+ipm_abertura+sindicancia_prazo+sindicancia_abertura) AS total'))
            ->where('cdopm','like',6)
            ->first();
        });
        
        $crpm6 = Cache::remember('c6_pendencias', $expiration, function(){
            return 
            Pendencia::select(DB::raw ('
            IFNULL(sum(comportamento),0) comportamento, IFNULL(sum(fatd_punicao),0) fatd_punicao,IFNULL(sum(fatd_prazo),0) fatd_prazo, 
            IFNULL(sum(fatd_abertura),0) fatd_abertura, IFNULL(sum(ipm_prazo),0) ipm_prazo, IFNULL(sum(ipm_abertura),0) ipm_abertura, 
            IFNULL(sum(sindicancia_prazo),0) sindicancia_prazo, IFNULL(sum(sindicancia_abertura ),0) sindicancia_abertura,
            (fatd_punicao+fatd_prazo+fatd_abertura+ipm_prazo+ipm_abertura+sindicancia_prazo+sindicancia_abertura) AS total'))
            ->where('cdopm','like',7)
            ->first();
        });

        $ccb = Cache::remember('ccb_pendencias', $expiration, function(){
            return 
            Pendencia::select(DB::raw ('
            IFNULL(sum(comportamento),0) comportamento, IFNULL(sum(fatd_punicao),0) fatd_punicao,IFNULL(sum(fatd_prazo),0) fatd_prazo, 
            IFNULL(sum(fatd_abertura),0) fatd_abertura, IFNULL(sum(ipm_prazo),0) ipm_prazo, IFNULL(sum(ipm_abertura),0) ipm_abertura, 
            IFNULL(sum(sindicancia_prazo),0) sindicancia_prazo, IFNULL(sum(sindicancia_abertura ),0) sindicancia_abertura,
            (fatd_punicao+fatd_prazo+fatd_abertura+ipm_prazo+ipm_abertura+sindicancia_prazo+sindicancia_abertura) AS total'))
            ->where('cdopm','like',9)
            ->first();
        });

        //gráficos
        //TOTAL
        $chartjs_pendencia_total = app()->chartjs
        ->name('chartjs_pendencia_total')
        ->type('bar')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['Pendências Total'])
        ->datasets([
            [
                "label" => "CG",
                'backgroundColor' => '#3366CC',
                'data' => [$cg->total]            
            ],
            [
            "label" => "EM",
            'backgroundColor' => '#DC3912',
            'data' => [$em->total]            
        ],
        [
            "label" => "1CRPM",
            'backgroundColor' => '#FF9900',
            'data' => [$crpm1->total]            
        ],
        [
            "label" => "2CRPM",
            'backgroundColor' => '#990099',
            'data' => [$crpm2->total]            
        ],
        [
            "label" => "3CRPM",
            'backgroundColor' => '#3B3EAC',
            'data' => [$crpm3->total]            
        ],
        [
            "label" => "4CRPM",
            'backgroundColor' => '#0099C6',
            'data' => [$crpm4->total]            
        ],
        [
            "label" => "5CRPM",
            'backgroundColor' => '#DD4477',
            'data' => [$crpm5->total]            
        ],
        [
            "label" => "6CRPM",
            'backgroundColor' => '#66AA00',
            'data' => [$crpm6->total]            
        ],
        [
            "label" => "CCB",
            'backgroundColor' => '#B82E2E',
            'data' => [$ccb->total]            
        ],
        
        ])
        ->options([
            'legend' => [
                    'display' => true,
                    'position' => 'left'
                ]
        ]);

        //FATD PUNICAO
        $chartjs_pendencia_fatd_punicao = app()->chartjs
        ->name('chartjs_pendencia_fatd_punicao')
        ->type('bar')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['FATD Punição'])
        ->datasets([
            [
                "label" => "CG",
                'backgroundColor' => '#3366CC',
                'data' => [$cg->fatd_punicao]            
            ],
            [
            "label" => "EM",
            'backgroundColor' => '#DC3912',
            'data' => [$em->fatd_punicao]            
        ],
        [
            "label" => "1CRPM",
            'backgroundColor' => '#FF9900',
            'data' => [$crpm1->fatd_punicao]            
        ],
        [
            "label" => "2CRPM",
            'backgroundColor' => '#990099',
            'data' => [$crpm2->fatd_punicao]            
        ],
        [
            "label" => "3CRPM",
            'backgroundColor' => '#3B3EAC',
            'data' => [$crpm3->fatd_punicao]            
        ],
        [
            "label" => "4CRPM",
            'backgroundColor' => '#0099C6',
            'data' => [$crpm4->fatd_punicao]            
        ],
        [
            "label" => "5CRPM",
            'backgroundColor' => '#DD4477',
            'data' => [$crpm5->fatd_punicao]            
        ],
        [
            "label" => "6CRPM",
            'backgroundColor' => '#66AA00',
            'data' => [$crpm6->fatd_punicao]            
        ],
        [
            "label" => "CCB",
            'backgroundColor' => '#B82E2E',
            'data' => [$ccb->fatd_punicao]            
        ],
        
        ])
        ->options([
            'legend' => [
                    'display' => true,
                    'position' => 'left'
                ]
        ]);

        //FATD abertura
        $chartjs_pendencia_fatd_abertura = app()->chartjs
        ->name('chartjs_pendencia_fatd_abertura')
        ->type('bar')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['FATD Abertura'])
        ->datasets([
            [
                "label" => "CG",
                'backgroundColor' => '#3366CC',
                'data' => [$cg->fatd_abertura]            
            ],
            [
            "label" => "EM",
            'backgroundColor' => '#DC3912',
            'data' => [$em->fatd_abertura]            
        ],
        [
            "label" => "1CRPM",
            'backgroundColor' => '#FF9900',
            'data' => [$crpm1->fatd_abertura]            
        ],
        [
            "label" => "2CRPM",
            'backgroundColor' => '#990099',
            'data' => [$crpm2->fatd_abertura]            
        ],
        [
            "label" => "3CRPM",
            'backgroundColor' => '#3B3EAC',
            'data' => [$crpm3->fatd_abertura]            
        ],
        [
            "label" => "4CRPM",
            'backgroundColor' => '#0099C6',
            'data' => [$crpm4->fatd_abertura]            
        ],
        [
            "label" => "5CRPM",
            'backgroundColor' => '#DD4477',
            'data' => [$crpm5->fatd_abertura]            
        ],
        [
            "label" => "6CRPM",
            'backgroundColor' => '#66AA00',
            'data' => [$crpm6->fatd_abertura]            
        ],
        [
            "label" => "CCB",
            'backgroundColor' => '#B82E2E',
            'data' => [$ccb->fatd_abertura]            
        ],
        
        ])
        ->options([
            'legend' => [
                    'display' => true,
                    'position' => 'left'
                ]
        ]);

        //FATD prazo
        $chartjs_pendencia_fatd_prazo = app()->chartjs
        ->name('chartjs_pendencia_fatd_prazo')
        ->type('bar')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['FATD Prazo'])
        ->datasets([
            [
                "label" => "CG",
                'backgroundColor' => '#3366CC',
                'data' => [$cg->fatd_prazo]            
            ],
            [
            "label" => "EM",
            'backgroundColor' => '#DC3912',
            'data' => [$em->fatd_prazo]            
        ],
        [
            "label" => "1CRPM",
            'backgroundColor' => '#FF9900',
            'data' => [$crpm1->fatd_prazo]            
        ],
        [
            "label" => "2CRPM",
            'backgroundColor' => '#990099',
            'data' => [$crpm2->fatd_prazo]            
        ],
        [
            "label" => "3CRPM",
            'backgroundColor' => '#3B3EAC',
            'data' => [$crpm3->fatd_prazo]            
        ],
        [
            "label" => "4CRPM",
            'backgroundColor' => '#0099C6',
            'data' => [$crpm4->fatd_prazo]            
        ],
        [
            "label" => "5CRPM",
            'backgroundColor' => '#DD4477',
            'data' => [$crpm5->fatd_prazo]            
        ],
        [
            "label" => "6CRPM",
            'backgroundColor' => '#66AA00',
            'data' => [$crpm6->fatd_prazo]            
        ],
        [
            "label" => "CCB",
            'backgroundColor' => '#B82E2E',
            'data' => [$ccb->fatd_prazo]            
        ],
        
        ])
        ->options([
            'legend' => [
                    'display' => true,
                    'position' => 'left'
                ]
        ]);

        //IPM abertura
        $chartjs_pendencia_ipm_abertura = app()->chartjs
        ->name('chartjs_pendencia_ipm_abertura')
        ->type('bar')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['IPM Abertura'])
        ->datasets([
            [
                "label" => "CG",
                'backgroundColor' => '#3366CC',
                'data' => [$cg->ipm_abertura]            
            ],
            [
            "label" => "EM",
            'backgroundColor' => '#DC3912',
            'data' => [$em->ipm_abertura]            
        ],
        [
            "label" => "1CRPM",
            'backgroundColor' => '#FF9900',
            'data' => [$crpm1->ipm_abertura]            
        ],
        [
            "label" => "2CRPM",
            'backgroundColor' => '#990099',
            'data' => [$crpm2->ipm_abertura]            
        ],
        [
            "label" => "3CRPM",
            'backgroundColor' => '#3B3EAC',
            'data' => [$crpm3->ipm_abertura]            
        ],
        [
            "label" => "4CRPM",
            'backgroundColor' => '#0099C6',
            'data' => [$crpm4->ipm_abertura]            
        ],
        [
            "label" => "5CRPM",
            'backgroundColor' => '#DD4477',
            'data' => [$crpm5->ipm_abertura]            
        ],
        [
            "label" => "6CRPM",
            'backgroundColor' => '#66AA00',
            'data' => [$crpm6->ipm_abertura]            
        ],
        [
            "label" => "CCB",
            'backgroundColor' => '#B82E2E',
            'data' => [$ccb->ipm_abertura]            
        ],
        
        ])
        ->options([
            'legend' => [
                    'display' => true,
                    'position' => 'left'
                ]
        ]);

        //IPM prazo
        $chartjs_pendencia_ipm_prazo = app()->chartjs
        ->name('chartjs_pendencia_ipm_prazo')
        ->type('bar')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['IPM prazo'])
        ->datasets([
            [
                "label" => "CG",
                'backgroundColor' => '#3366CC',
                'data' => [$cg->ipm_prazo]            
            ],
            [
            "label" => "EM",
            'backgroundColor' => '#DC3912',
            'data' => [$em->ipm_prazo]            
        ],
        [
            "label" => "1CRPM",
            'backgroundColor' => '#FF9900',
            'data' => [$crpm1->ipm_prazo]            
        ],
        [
            "label" => "2CRPM",
            'backgroundColor' => '#990099',
            'data' => [$crpm2->ipm_prazo]            
        ],
        [
            "label" => "3CRPM",
            'backgroundColor' => '#3B3EAC',
            'data' => [$crpm3->ipm_prazo]            
        ],
        [
            "label" => "4CRPM",
            'backgroundColor' => '#0099C6',
            'data' => [$crpm4->ipm_prazo]            
        ],
        [
            "label" => "5CRPM",
            'backgroundColor' => '#DD4477',
            'data' => [$crpm5->ipm_prazo]            
        ],
        [
            "label" => "6CRPM",
            'backgroundColor' => '#66AA00',
            'data' => [$crpm6->ipm_prazo]            
        ],
        [
            "label" => "CCB",
            'backgroundColor' => '#B82E2E',
            'data' => [$ccb->ipm_prazo]            
        ],
        
        ])
        ->options([
            'legend' => [
                    'display' => true,
                    'position' => 'left'
                ]
        ]);
        
        //sindicancia abertura
        $chartjs_pendencia_s_abertura = app()->chartjs
        ->name('chartjs_pendencia_s_abertura')
        ->type('bar')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['Sindicância Abertura'])
        ->datasets([
            [
                "label" => "CG",
                'backgroundColor' => '#3366CC',
                'data' => [$cg->sindicancia_abertura]            
            ],
            [
            "label" => "EM",
            'backgroundColor' => '#DC3912',
            'data' => [$em->sindicancia_abertura]            
        ],
        [
            "label" => "1CRPM",
            'backgroundColor' => '#FF9900',
            'data' => [$crpm1->sindicancia_abertura]            
        ],
        [
            "label" => "2CRPM",
            'backgroundColor' => '#990099',
            'data' => [$crpm2->sindicancia_abertura]            
        ],
        [
            "label" => "3CRPM",
            'backgroundColor' => '#3B3EAC',
            'data' => [$crpm3->sindicancia_abertura]            
        ],
        [
            "label" => "4CRPM",
            'backgroundColor' => '#0099C6',
            'data' => [$crpm4->sindicancia_abertura]            
        ],
        [
            "label" => "5CRPM",
            'backgroundColor' => '#DD4477',
            'data' => [$crpm5->sindicancia_abertura]            
        ],
        [
            "label" => "6CRPM",
            'backgroundColor' => '#66AA00',
            'data' => [$crpm6->sindicancia_abertura]            
        ],
        [
            "label" => "CCB",
            'backgroundColor' => '#B82E2E',
            'data' => [$ccb->sindicancia_abertura]            
        ],
        
        ])
        ->options([
            'legend' => [
                    'display' => true,
                    'position' => 'left'
                ]
        ]);

        //sindicancia prazo
        $chartjs_pendencia_s_prazo = app()->chartjs
        ->name('chartjs_pendencia_s_prazo')
        ->type('bar')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['Sindicância Prazo'])
        ->datasets([
            [
                "label" => "CG",
                'backgroundColor' => '#3366CC',
                'data' => [$cg->sindicancia_prazo]            
            ],
            [
            "label" => "EM",
            'backgroundColor' => '#DC3912',
            'data' => [$em->sindicancia_prazo]            
        ],
        [
            "label" => "1CRPM",
            'backgroundColor' => '#FF9900',
            'data' => [$crpm1->sindicancia_prazo]            
        ],
        [
            "label" => "2CRPM",
            'backgroundColor' => '#990099',
            'data' => [$crpm2->sindicancia_prazo]            
        ],
        [
            "label" => "3CRPM",
            'backgroundColor' => '#3B3EAC',
            'data' => [$crpm3->sindicancia_prazo]            
        ],
        [
            "label" => "4CRPM",
            'backgroundColor' => '#0099C6',
            'data' => [$crpm4->sindicancia_prazo]            
        ],
        [
            "label" => "5CRPM",
            'backgroundColor' => '#DD4477',
            'data' => [$crpm5->sindicancia_prazo]            
        ],
        [
            "label" => "6CRPM",
            'backgroundColor' => '#66AA00',
            'data' => [$crpm6->sindicancia_prazo]            
        ],
        [
            "label" => "CCB",
            'backgroundColor' => '#B82E2E',
            'data' => [$ccb->sindicancia_prazo]            
        ],
        
        ])
        ->options([
            'legend' => [
                    'display' => true,
                    'position' => 'left'
                ]
        ]);

        //Somatórios
        $tp_total = $cg->total + $em->total + $crpm1->total + $crpm2->total + $crpm3->total + $crpm4->total + $crpm5->total + $crpm6->total + $ccb->total;
        $tpfatd_punicao = $cg->fatd_punicao + $em->fatd_punicao + $crpm1->fatd_punicao + $crpm2->fatd_punicao + $crpm3->fatd_punicao + $crpm4->fatd_punicao + $crpm5->fatd_punicao + $crpm6->fatd_punicao + $ccb->fatd_punicao;
        $tpfatd_abertura = $cg->fatd_abertura + $em->fatd_abertura + $crpm1->fatd_abertura + $crpm2->fatd_abertura + $crpm3->fatd_abertura + $crpm4->fatd_abertura + $crpm5->fatd_abertura + $crpm6->fatd_abertura + $ccb->fatd_abertura;
        $tpfatd_prazo = $cg->fatd_prazo + $em->fatd_prazo + $crpm1->fatd_prazo + $crpm2->fatd_prazo + $crpm3->fatd_prazo + $crpm4->fatd_prazo + $crpm5->fatd_prazo + $crpm6->fatd_prazo + $ccb->fatd_prazo;
        $tpipm_abertura = $cg->ipm_abertura + $em->ipm_abertura + $crpm1->ipm_abertura + $crpm2->ipm_abertura + $crpm3->ipm_abertura + $crpm4->ipm_abertura + $crpm5->ipm_abertura + $crpm6->ipm_abertura + $ccb->ipm_abertura;
        $tpipm_prazo = $cg->ipm_prazo + $em->ipm_prazo + $crpm1->ipm_prazo + $crpm2->ipm_prazo + $crpm3->ipm_prazo + $crpm4->ipm_prazo + $crpm5->ipm_prazo + $crpm6->ipm_prazo + $ccb->ipm_prazo;
        $tps_abertura = $cg->sindicancia_abertura + $em->sindicancia_abertura + $crpm1->sindicancia_abertura + $crpm2->sindicancia_abertura + $crpm3->sindicancia_abertura + $crpm4->sindicancia_abertura + $crpm5->sindicancia_abertura + $crpm6->sindicancia_abertura + $ccb->sindicancia_abertura;
        $tps_prazo = $cg->sindicancia_prazo + $em->sindicancia_prazo + $crpm1->sindicancia_prazo + $crpm2->sindicancia_prazo + $crpm3->sindicancia_prazo + $crpm4->sindicancia_prazo + $crpm5->sindicancia_prazo + $crpm6->sindicancia_prazo + $ccb->sindicancia_prazo;

        return view('relatorios.pendencias_gerais',compact(
            'pendencias',
            'chartjs_pendencia_total',
            'chartjs_pendencia_fatd_punicao',
            'chartjs_pendencia_fatd_abertura',
            'chartjs_pendencia_fatd_prazo',
            'chartjs_pendencia_ipm_abertura',
            'chartjs_pendencia_ipm_prazo',
            'chartjs_pendencia_s_abertura',
            'chartjs_pendencia_s_prazo',
            'tp_total',
            'tpfatd_punicao',
            'tpfatd_abertura',
            'tpfatd_prazo',
            'tpipm_abertura',
            'tpipm_prazo',
            'tps_abertura',
            'tps_prazo'
        ));
    }

    public function comportamento()
    {
        
    }

    public function punicoes()
    {
        
    }

    public function quantidade()
    {
        
    }

    public function prioritarios()
    {
        
    }

    public function sobrestamentos()
    {
        
    }

    public function processos()
    {
        
    }

    public function postograd()
    {
        
    }

    public function encarregados()
    {
        
    }

    public function defensores()
    {
        
    }

    public function ofendidos()
    {
        
    }

}
