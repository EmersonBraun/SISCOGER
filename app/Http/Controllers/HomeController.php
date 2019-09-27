<?php
/**
 * Esse controle precisa ser refatorado para não ficar com tanta responsbilidade
 * uma solução é recriar o dashboard com Vue e traser os dados via API
 */
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Sjd\Relatorios\Pendencia as Pendencia;
// dados via API
use Auth;
use ApiTransferencias;
use App\Repositories\PM\TransferidosRepository;
use App\Repositories\PM\ComportamentoRepository;
use App\Repositories\PM\PolicialRepository;
use App\Repositories\proc\FatdRepository;
use App\Repositories\proc\IpmRepository;
use App\Repositories\proc\SindicanciaRepository;
use App\Repositories\proc\CdRepository;

class HomeController extends Controller
{
    protected $transferidos;
    protected $comportamentos;
    protected $fatd;
    protected $ipm;
    protected $cd;
    protected $sindicancia;
    protected $pm;

    public function __construct(
        TransferidosRepository $transferidos,
        ComportamentoRepository $comportamentos,
        PolicialRepository $pm,
        FatdRepository $fatd,
        IpmRepository $ipm,
        SindicanciaRepository $sindicancia,
        CdRepository $cd
    )
    {
        $this->middleware('auth');
        $this->transferidos = $transferidos;
        $this->comportamentos = $comportamentos;
        $this->fatd = $fatd;
        $this->ipm = $ipm;
        $this->cd = $cd;
        $this->sindicancia = $sindicancia;
        $this->pm = $pm;
    }

    public function isLoged($unidade) {
        if($unidade == NULL || $unidade == '')
        {
            Auth::logout();
            return redirect()->intended('login');
        }
    }

    public function index()
    {
        //caso não tenha argumentos a função pega a unidade do login
        $unidade = (func_num_args() <= 0 ) ? $unidade = session()->get('cdopmbase') : func_get_args();
        //os argumentos vem em array assim faz o cast para string
        $unidade = (is_array($unidade)) ? head($unidade) : $unidade;
        //nome da unidade caso não seja a logada
        $nome_unidade = ($unidade != session()->get('cdopmbase')) ? opm($unidade) : '';
        //caso não tenha unidade desloga
        $this->isLoged($unidade);

        // pendências
        $pendencias = $this->pendencias($unidade);

        //contagens
        $totais = $this->totais($unidade, $pendencias);

        // somatórios
        $totais_proc = $this->somatorio($totais);

        // gráficos
        $efetivo = $this->graficoEfetivo($unidade);
        $procedimentos = $this->graficoProcAnos($unidade);

        //ATUALIZAR PENDÊNCIAS GERAIS
        //aproveita que já tem as somas de pendências para inserir na tabela de pendências gerais
        $this->atualizaPendencias($totais);

        return view('home',compact(
            'efetivo', // gráfico efetivo
            'procedimentos', // grafico procedimentos
            'pendencias' ,  // listagens de pendências
            'totais', // quantidade de pendencias
            'totais_proc', // somatório das pendencias
            'nome_unidade', 
            'unidade' 
        ));
    }

    public function pendencias($unidade)
    {
        $pendencias = [
            'transferidos' => $this->transferidos->semana($unidade),
            //PENDENCIA #1: COMPORTAMENTO
            'comportamentos' => $this->comportamentos->comportamentos($unidade),
            //PENDENCIA #2: CADASTRO DE PUNICAO NO FATD MARCADO COMO PUNIDO
            'fatd_punidos' => $this->fatd->punidos($unidade),
            //PENDENCIA #2.1: PRAZO DO FATD
            'fatd_prazos' => $this->fatd->foraDoPrazoUnidade($unidade),
            //PENDENCIA #2.2: FATD SEM DATA DE ABERTURA
            'fatd_aberturas' => $this->fatd->aberturas($unidade),
            //PENDENCIA #3: PERDA DE PRAZO EM IPM
            'ipm_prazos' => $this->ipm->foraDoPrazo($unidade),
            //PENDENCIA #3.1: ipm SEM DATA DE ABERTURA
            'ipm_aberturas' => $this->ipm->instauracao($unidade),
            //PENDENCIA #4: PRAZO DAS SINDICANCIAS
            'sindicancia_prazos' => $this->sindicancia->foraDoPrazo($unidade),
            //PENDENCIA #4.1: SINDICANCIA SEM DATA DE ABERTURA
            'sindicancia_aberturas' => $this->sindicancia->foraDoPrazo($unidade),
            //PENDENCIA #5: CONSELHOS DE DISCIPLINA SEM DATA DE ABERTURA
            'cd_aberturas' => $this->cd->aberturas($unidade),
            //PENDENCIA #5.1: CONSELHOS DE DISCIPLINA - PRAZO
            'cd_prazos' => $this->cd->foraDoPrazo($unidade)
        ];
        return $pendencias;
    }

    public function totais($unidade, $pendencias)
    {
        $totais = [
            'cdopm' => completa_zeros($unidade),
            'comportamento' => count($pendencias['comportamentos']),
            'fatd_punicao' => count($pendencias['fatd_punidos']),
            'fatd_prazo' => count($pendencias['fatd_prazos']),
            'fatd_abertura' => count($pendencias['fatd_aberturas']),
            'ipm_abertura' => count($pendencias['ipm_aberturas']),
            'ipm_prazo' => count($pendencias['ipm_prazos']),
            'sindicancia_abertura' => count($pendencias['sindicancia_aberturas']),
            'sindicancia_prazo' => count($pendencias['sindicancia_prazos']),
            'cd_abertura' => count($pendencias['cd_aberturas']),
            'cd_prazo' => count($pendencias['cd_prazos'])
        ];

        return $totais;
    }

    public function somatorio($totais)
    {
        $totais_proc = [
            'fatd' => $totais['fatd_punicao'] + $totais['fatd_prazo'] + $totais['fatd_abertura'],
            'ipm' => $totais['ipm_prazo'] + $totais['ipm_abertura'],
            'sindicancia' => $totais['sindicancia_prazo'] + $totais['sindicancia_abertura'],
            'cd' => $totais['cd_prazo'] + $totais['cd_abertura'],
        ];

        return $totais_proc;
    }

    public function graficoEfetivo($unidade)
    {
        $e = $this->pm->efetivoOPM($unidade);
        //formatar array para o gráfico
        $efetivo =[
            'qtd' => array_pluck($e, 'qtd'),
            'cargos' => array_pluck($e, 'cargo')
        ]; 

        return $efetivo;
    }

    public function graficoProcAnos($unidade)
    {
        $fatd_ano = $this->fatd->QtdOMAnos($unidade);
        $ipm_ano = $this->ipm->QtdOMAnos($unidade);
        $sindicancia_ano = $this->sindicancia->QtdOMAnos($unidade);
        $cd_ano = $this->cd->QtdOMAnos($unidade);
        //divide o array para usar no gráfico
        [$anos, $fatd_ano] = array_divide($fatd_ano);
        [$anos, $ipm_ano] = array_divide($ipm_ano);
        [$anos, $sindicancia_ano] = array_divide($sindicancia_ano);
        [$anos, $cd_ano] = array_divide($cd_ano);
            
        $procedimentos = [
            'fatd_ano' => $fatd_ano,
           'ipm_ano' => $ipm_ano,
           'sindicancia_ano' => $sindicancia_ano,
           'cd_ano' => $cd_ano,
           'anos' => $anos
        ];

        return $procedimentos;
    }

    public function atualizaPendencias($totais)
    {
        // dd($totais);
        /*$pendencia = Pendencia::where('cdopm',$totais['cdopm'])->first();
        if($pendencia) {
            unset($totais['cdopm']);
            $pendencia->update($totais);
        }
        Pendencia::create($totais);*/
        return true;
    }

    public function logout(User $user)
    {
        Auth::logout();
        return redirect()->intended('login');
    }
}