<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Sjd\Relatorios\Pendencia as Pendencia;
// dados via API
use Auth;
use ApiTransferencias;
use ApiComportamento;
use ApiFatd;
use ApiIpm;
use ApiSindicancia;
use ApiCd;
use ApiEfetivo;
use ApiPM;
use ApiOPM;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        // pendências
        //PENDENCIA #0: TRANSFERIDOS obs: arrumar a pesquisa
        $transferidos = ApiTransferencias::transferencias($unidade);
        //$transferidos = [];
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
        $efetivo_chartjs = HomeController::graficoEfetivo($unidade);
        $chartjs = HomeController::graficoProcAnos($unidade);
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

    public function logout(User $user)
    {
        Auth::logout();
        return redirect()->intended('login');
    }
}