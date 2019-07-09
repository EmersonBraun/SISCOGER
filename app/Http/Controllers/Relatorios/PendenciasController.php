<?php

namespace App\Http\Controllers\Relatorios;

use Cache;
use App\User;
use App\Models\Sjd\Relatorios\Pendencia as Pendencia;

// dados via API
use ApiTransferencias;
use ApiComportamento;
use ApiFatd;
use ApiIpm;
use ApiSindicancia;
use ApiCd;
use ApiEfetivo;
use ApiPM;
use ApiOPM;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
class PendenciasController extends Controller
{
    //tempo de cahe em minutos
    private static $expiration = 60; 

    public function index($unidade)
    {
        $unidade = corta_zeros($unidade);

        //nome da unidade caso não seja a logada
        $nome_unidade = ($unidade != session('cdopmbase')) ? opm($unidade) : '';


        // pendências
        //PENDENCIA #0: TRANSFERIDOS obs: arrumar a pesquisa

        //$transferidos = TransferenciasApi::transferencias($unidade);
        $transferidos = [];

        //PENDENCIA #1: COMPORTAMENTO
        $comportamentos = ApiComportamento::comportamentos($unidade);

        //PENDENCIA #2: CADASTRO DE PUNICAO NO FATD MARCADO COMO PUNIDO
        $fatd_punidos = ApiFatd::punidos($unidade);
        
        //PENDENCIA #2.1: PRAZO DO FATD
        $fatd_prazos = ApiFatd::prazos($unidade);
        
        //PENDENCIA #2.2: FATD SEM DATA DE ABERTURA
        $fatd_aberturas = ApiFatd::aberturas($unidade);

        //PENDENCIA #3: PERDA DE PRAZO EM IPM
        $ipm_prazos = ApiIpm::prazos($unidade);
        
        //PENDENCIA #3.1: ipm SEM DATA DE ABERTURA
        $ipm_aberturas = ApiIpm::aberturas($unidade);

        //PENDENCIA #4: PRAZO DAS SINDICANCIAS
        $sindicancia_prazos = ApiSindicancia::prazos($unidade);

        //PENDENCIA #4.1: SINDICANCIA SEM DATA DE ABERTURA
        $sindicancia_aberturas = ApiSindicancia::aberturas($unidade);

        //PENDENCIA #5: CONSELHOS DE DISCIPLINA SEM DATA DE ABERTURA
        $cd_aberturas = ApiCd::aberturas($unidade);

        //PENDENCIA #5.1: CONSELHOS DE DISCIPLINA - PRAZO
        $cd_prazos = ApiCd::prazos($unidade);

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

        // totais para as infobox
        $fatd_total = $tfatd_punidos + $tfatd_prazos + $tfatd_aberturas;
        $ipm_total = $tipm_prazos + $tipm_aberturas;
        $sindicancia_total = $tsindicancia_prazos + $tsindicancia_aberturas;
        $cd_total = $tcd_aberturas + $tcd_prazos;

        $total_efetivo =  ApiPM::totalEfetivoOPM($unidade);
        
        // gráficos
        $efetivo_chartjs = PendenciasController::graficoEfetivo($unidade);
        $chartjs = PendenciasController::graficoProcAnos($unidade);

        //ATUALIZAR PENDÊNCIAS GERAIS
        //aproveita que já tem as somas de pendências para inserir na tabela de pendências gerais
        $pendencia = [
            'fatd_punicao' => $tfatd_punidos, 
            'fatd_prazo' => $tfatd_prazos,
            'fatd_abertura' => $tfatd_aberturas,
            'ipm_prazo' => $tipm_prazos,
            'ipm_abertura' => $tipm_aberturas,
            'sindicancia_prazo' => $tsindicancia_prazos, 
            'sindicancia_abertura' => $tsindicancia_aberturas
        ];

        Pendencia::where('cdopm','=',$unidade)->update($pendencia);

        return view('home',compact(
            'transferidos', 
            'comportamentos',
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

        
    public function graficoEfetivo($unidade)
    {
        $efetivo = ApiPM::efetivoOPM($unidade);

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
        return $efetivo_chartjs;
    }

    public function graficoProcAnos($unidade)
    {
        $fatd_ano = ApiFatd::QtdOMAnos($unidade);
        $ipm_ano = ApiIpm::QtdOMAnos($unidade);
        $sindicancia_ano = ApiSindicancia::QtdOMAnos($unidade);
        $cd_ano = ApiCd::QtdOMAnos($unidade);

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

            return $chartjs;
    }
        

    public function trocaropm(Request $request)
    {
        // include 'app/includes/opms.php';
        $opms = ApiOPM::get();
        //dd($opms);
        return view('relatorios.trocar_opm',compact('opms'));
    }

    public function geral()
    {
        //tempo de cahe em minutos
        self::$expiration = 60;

        $pendencias = Cache::remember('total_pendencias_gerais', self::$expiration, function(){
            return Pendencia::select('pendencias.*',DB::raw ('(fatd_punicao+fatd_prazo+fatd_abertura+ipm_prazo+ipm_abertura+sindicancia_prazo+sindicancia_abertura) AS total'))->get();
        });

        //buscas para os gráficos
        $cg = Cache::remember('cg_pendencias', self::$expiration, function(){
            return 
            Pendencia::select(DB::raw ('
            IFNULL(sum(comportamento),0) comportamento, IFNULL(sum(fatd_punicao),0) fatd_punicao,IFNULL(sum(fatd_prazo),0) fatd_prazo, 
            IFNULL(sum(fatd_abertura),0) fatd_abertura, IFNULL(sum(ipm_prazo),0) ipm_prazo, IFNULL(sum(ipm_abertura),0) ipm_abertura, 
            IFNULL(sum(sindicancia_prazo),0) sindicancia_prazo, IFNULL(sum(sindicancia_abertura ),0) sindicancia_abertura,
            (fatd_punicao+fatd_prazo+fatd_abertura+ipm_prazo+ipm_abertura+sindicancia_prazo+sindicancia_abertura) AS total'))
            ->where('cdopm','like',0)
            ->first();
        });
        
        $em = Cache::remember('em_pendencias', self::$expiration, function(){
            return 
            Pendencia::select(DB::raw ('
            IFNULL(sum(comportamento),0) comportamento, IFNULL(sum(fatd_punicao),0) fatd_punicao,IFNULL(sum(fatd_prazo),0) fatd_prazo, 
            IFNULL(sum(fatd_abertura),0) fatd_abertura, IFNULL(sum(ipm_prazo),0) ipm_prazo, IFNULL(sum(ipm_abertura),0) ipm_abertura, 
            IFNULL(sum(sindicancia_prazo),0) sindicancia_prazo, IFNULL(sum(sindicancia_abertura ),0) sindicancia_abertura,
            (fatd_punicao+fatd_prazo+fatd_abertura+ipm_prazo+ipm_abertura+sindicancia_prazo+sindicancia_abertura) AS total'))
            ->where('cdopm','like',1)
            ->first();
        });

        $crpm1 = Cache::remember('c1_pendencias', self::$expiration, function(){
            return 
            Pendencia::select(DB::raw ('
            IFNULL(sum(comportamento),0) comportamento, IFNULL(sum(fatd_punicao),0) fatd_punicao,IFNULL(sum(fatd_prazo),0) fatd_prazo, 
            IFNULL(sum(fatd_abertura),0) fatd_abertura, IFNULL(sum(ipm_prazo),0) ipm_prazo, IFNULL(sum(ipm_abertura),0) ipm_abertura, 
            IFNULL(sum(sindicancia_prazo),0) sindicancia_prazo, IFNULL(sum(sindicancia_abertura ),0) sindicancia_abertura,
            (fatd_punicao+fatd_prazo+fatd_abertura+ipm_prazo+ipm_abertura+sindicancia_prazo+sindicancia_abertura) AS total'))
            ->where('cdopm','like',2)
            ->first();
        });

        $crpm2 = Cache::remember('c2_pendencias', self::$expiration, function(){
            return 
            Pendencia::select(DB::raw ('
            IFNULL(sum(comportamento),0) comportamento, IFNULL(sum(fatd_punicao),0) fatd_punicao,IFNULL(sum(fatd_prazo),0) fatd_prazo, 
            IFNULL(sum(fatd_abertura),0) fatd_abertura, IFNULL(sum(ipm_prazo),0) ipm_prazo, IFNULL(sum(ipm_abertura),0) ipm_abertura, 
            IFNULL(sum(sindicancia_prazo),0) sindicancia_prazo, IFNULL(sum(sindicancia_abertura ),0) sindicancia_abertura,
            (fatd_punicao+fatd_prazo+fatd_abertura+ipm_prazo+ipm_abertura+sindicancia_prazo+sindicancia_abertura) AS total'))
            ->where('cdopm','like',3)
            ->first();
        });

        $crpm3 = Cache::remember('c3_pendencias', self::$expiration, function(){
            return 
            Pendencia::select(DB::raw ('
            IFNULL(sum(comportamento),0) comportamento, IFNULL(sum(fatd_punicao),0) fatd_punicao,IFNULL(sum(fatd_prazo),0) fatd_prazo, 
            IFNULL(sum(fatd_abertura),0) fatd_abertura, IFNULL(sum(ipm_prazo),0) ipm_prazo, IFNULL(sum(ipm_abertura),0) ipm_abertura, 
            IFNULL(sum(sindicancia_prazo),0) sindicancia_prazo, IFNULL(sum(sindicancia_abertura ),0) sindicancia_abertura,
            (fatd_punicao+fatd_prazo+fatd_abertura+ipm_prazo+ipm_abertura+sindicancia_prazo+sindicancia_abertura) AS total'))
            ->where('cdopm','like',4)
            ->first();
        });

        $crpm4 = Cache::remember('c4_pendencias', self::$expiration, function(){
            return 
            Pendencia::select(DB::raw ('
            IFNULL(sum(comportamento),0) comportamento, IFNULL(sum(fatd_punicao),0) fatd_punicao,IFNULL(sum(fatd_prazo),0) fatd_prazo, 
            IFNULL(sum(fatd_abertura),0) fatd_abertura, IFNULL(sum(ipm_prazo),0) ipm_prazo, IFNULL(sum(ipm_abertura),0) ipm_abertura, 
            IFNULL(sum(sindicancia_prazo),0) sindicancia_prazo, IFNULL(sum(sindicancia_abertura ),0) sindicancia_abertura,
            (fatd_punicao+fatd_prazo+fatd_abertura+ipm_prazo+ipm_abertura+sindicancia_prazo+sindicancia_abertura) AS total'))
            ->where('cdopm','like',5)
            ->first();
        });

        $crpm5 = Cache::remember('c5_pendencias', self::$expiration, function(){
            return 
            Pendencia::select(DB::raw ('
            IFNULL(sum(comportamento),0) comportamento, IFNULL(sum(fatd_punicao),0) fatd_punicao,IFNULL(sum(fatd_prazo),0) fatd_prazo, 
            IFNULL(sum(fatd_abertura),0) fatd_abertura, IFNULL(sum(ipm_prazo),0) ipm_prazo, IFNULL(sum(ipm_abertura),0) ipm_abertura, 
            IFNULL(sum(sindicancia_prazo),0) sindicancia_prazo, IFNULL(sum(sindicancia_abertura ),0) sindicancia_abertura,
            (fatd_punicao+fatd_prazo+fatd_abertura+ipm_prazo+ipm_abertura+sindicancia_prazo+sindicancia_abertura) AS total'))
            ->where('cdopm','like',6)
            ->first();
        });
        
        $crpm6 = Cache::remember('c6_pendencias', self::$expiration, function(){
            return 
            Pendencia::select(DB::raw ('
            IFNULL(sum(comportamento),0) comportamento, IFNULL(sum(fatd_punicao),0) fatd_punicao,IFNULL(sum(fatd_prazo),0) fatd_prazo, 
            IFNULL(sum(fatd_abertura),0) fatd_abertura, IFNULL(sum(ipm_prazo),0) ipm_prazo, IFNULL(sum(ipm_abertura),0) ipm_abertura, 
            IFNULL(sum(sindicancia_prazo),0) sindicancia_prazo, IFNULL(sum(sindicancia_abertura ),0) sindicancia_abertura,
            (fatd_punicao+fatd_prazo+fatd_abertura+ipm_prazo+ipm_abertura+sindicancia_prazo+sindicancia_abertura) AS total'))
            ->where('cdopm','like',7)
            ->first();
        });

        $ccb = Cache::remember('ccb_pendencias', self::$expiration, function(){
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

    public function comportamento() {
        return true;
    }

    public function punicoes() {
        return true;
    }

    public function quantidade() {
        return true;
    }

    public function prioritarios() {
        return true;
    }

    public function sobrestamentos() {
        return true;
    }

    public function processos() {
        return true;
    }

    public function postograd() {
        return true;
    }

    public function encarregados() {
        return true;
    }

    public function defensores() {
        return true;
    }

    public function ofendidos() {
        return true;
    }
}
