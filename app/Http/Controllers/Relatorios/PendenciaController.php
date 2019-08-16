<?php

namespace App\Http\Controllers\Relatorios;

use Cache;
use App\User;
use App\Models\Sjd\Relatorios\Pendencia as Pendencia;

use App\Repositories\OPM\OPMRepository;
use App\Repositories\relatorios\PendenciaRepository;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
class PendenciaController extends Controller
{
    //tempo de cahe em minutos
    private static $expiration = 60; 
    private $opm;
    private $repository;

    public function __construct(OPMRepository $opm, PendenciaRepository $repository)
    {
      $this->opm = $opm; 
      $this->repository = $repository; 
    }

    public function trocaropm(Request $request)
    {
        $opms = $this->opm->get();
        return view('relatorios.trocar_opm',compact('opms'));
    }

    public function homeOutraOM(Request $request)
    {
        $dados = $request->all();
        $opm = corta_zeros($dados['opm']);
        return redirect()->route('home.opm',$opm);
    }

    public function geral()
    {
        $pendencias = $this->repository->gerais();
        return view('relatorios.pendencias.lista',compact('pendencias'));
    }

    public function graficos()
    {
        $totais = $this->repository->total(); 
        $fatd_abertura = $this->repository->fatd_abertura();
        $fatd_punicao = $this->repository->fatd_punicao();
        $fatd_prazo = $this->repository->fatd_prazo(); 
        $ipm_prazo = $this->repository->ipm_prazo();
        $ipm_abertura = $this->repository->ipm_abertura();
        $sindicancia_abertura = $this->repository->sindicancia_abertura();
        $sindicancia_prazo = $this->repository->sindicancia_prazo();

        return view('relatorios.pendencias.graficos',
        compact('totais',
        'fatd_abertura','fatd_punicao','fatd_prazo',
        'ipm_prazo','ipm_abertura',
        'sindicancia_prazo','sindicancia_abertura'
        ));
    //   $cd_abertura = $this->repository->cd_abertura();
    //   $cd_prazo = $this->repository->cd_prazo();

    // return view('relatorios.pendencias_gerais',compact(''));

        // //gráficos
        // //TOTAL
        // $chartjs_pendencia_total = app()->chartjs
        // ->name('chartjs_pendencia_total')
        // ->type('bar')
        // ->size(['width' => 400, 'height' => 200])
        // ->labels(['Pendências Total'])
        // ->datasets([
        //     [
        //         "label" => "CG",
        //         'backgroundColor' => '#3366CC',
        //         'data' => [$cg->total]            
        //     ],
        //     [
        //     "label" => "EM",
        //     'backgroundColor' => '#DC3912',
        //     'data' => [$em->total]            
        // ],
        // [
        //     "label" => "1CRPM",
        //     'backgroundColor' => '#FF9900',
        //     'data' => [$crpm1->total]            
        // ],
        // [
        //     "label" => "2CRPM",
        //     'backgroundColor' => '#990099',
        //     'data' => [$crpm2->total]            
        // ],
        // [
        //     "label" => "3CRPM",
        //     'backgroundColor' => '#3B3EAC',
        //     'data' => [$crpm3->total]            
        // ],
        // [
        //     "label" => "4CRPM",
        //     'backgroundColor' => '#0099C6',
        //     'data' => [$crpm4->total]            
        // ],
        // [
        //     "label" => "5CRPM",
        //     'backgroundColor' => '#DD4477',
        //     'data' => [$crpm5->total]            
        // ],
        // [
        //     "label" => "6CRPM",
        //     'backgroundColor' => '#66AA00',
        //     'data' => [$crpm6->total]            
        // ],
        // [
        //     "label" => "CCB",
        //     'backgroundColor' => '#B82E2E',
        //     'data' => [$ccb->total]            
        // ],
        
        // ])
        // ->options([
        //     'legend' => [
        //             'display' => true,
        //             'position' => 'left'
        //         ]
        // ]);

        // //FATD PUNICAO
        // $chartjs_pendencia_fatd_punicao = app()->chartjs
        // ->name('chartjs_pendencia_fatd_punicao')
        // ->type('bar')
        // ->size(['width' => 400, 'height' => 200])
        // ->labels(['FATD Punição'])
        // ->datasets([
        //     [
        //         "label" => "CG",
        //         'backgroundColor' => '#3366CC',
        //         'data' => [$cg->fatd_punicao]            
        //     ],
        //     [
        //     "label" => "EM",
        //     'backgroundColor' => '#DC3912',
        //     'data' => [$em->fatd_punicao]            
        // ],
        // [
        //     "label" => "1CRPM",
        //     'backgroundColor' => '#FF9900',
        //     'data' => [$crpm1->fatd_punicao]            
        // ],
        // [
        //     "label" => "2CRPM",
        //     'backgroundColor' => '#990099',
        //     'data' => [$crpm2->fatd_punicao]            
        // ],
        // [
        //     "label" => "3CRPM",
        //     'backgroundColor' => '#3B3EAC',
        //     'data' => [$crpm3->fatd_punicao]            
        // ],
        // [
        //     "label" => "4CRPM",
        //     'backgroundColor' => '#0099C6',
        //     'data' => [$crpm4->fatd_punicao]            
        // ],
        // [
        //     "label" => "5CRPM",
        //     'backgroundColor' => '#DD4477',
        //     'data' => [$crpm5->fatd_punicao]            
        // ],
        // [
        //     "label" => "6CRPM",
        //     'backgroundColor' => '#66AA00',
        //     'data' => [$crpm6->fatd_punicao]            
        // ],
        // [
        //     "label" => "CCB",
        //     'backgroundColor' => '#B82E2E',
        //     'data' => [$ccb->fatd_punicao]            
        // ],
        
        // ])
        // ->options([
        //     'legend' => [
        //             'display' => true,
        //             'position' => 'left'
        //         ]
        // ]);

        // //FATD abertura
        // $chartjs_pendencia_fatd_abertura = app()->chartjs
        // ->name('chartjs_pendencia_fatd_abertura')
        // ->type('bar')
        // ->size(['width' => 400, 'height' => 200])
        // ->labels(['FATD Abertura'])
        // ->datasets([
        //     [
        //         "label" => "CG",
        //         'backgroundColor' => '#3366CC',
        //         'data' => [$cg->fatd_abertura]            
        //     ],
        //     [
        //     "label" => "EM",
        //     'backgroundColor' => '#DC3912',
        //     'data' => [$em->fatd_abertura]            
        // ],
        // [
        //     "label" => "1CRPM",
        //     'backgroundColor' => '#FF9900',
        //     'data' => [$crpm1->fatd_abertura]            
        // ],
        // [
        //     "label" => "2CRPM",
        //     'backgroundColor' => '#990099',
        //     'data' => [$crpm2->fatd_abertura]            
        // ],
        // [
        //     "label" => "3CRPM",
        //     'backgroundColor' => '#3B3EAC',
        //     'data' => [$crpm3->fatd_abertura]            
        // ],
        // [
        //     "label" => "4CRPM",
        //     'backgroundColor' => '#0099C6',
        //     'data' => [$crpm4->fatd_abertura]            
        // ],
        // [
        //     "label" => "5CRPM",
        //     'backgroundColor' => '#DD4477',
        //     'data' => [$crpm5->fatd_abertura]            
        // ],
        // [
        //     "label" => "6CRPM",
        //     'backgroundColor' => '#66AA00',
        //     'data' => [$crpm6->fatd_abertura]            
        // ],
        // [
        //     "label" => "CCB",
        //     'backgroundColor' => '#B82E2E',
        //     'data' => [$ccb->fatd_abertura]            
        // ],
        
        // ])
        // ->options([
        //     'legend' => [
        //             'display' => true,
        //             'position' => 'left'
        //         ]
        // ]);

        // //FATD prazo
        // $chartjs_pendencia_fatd_prazo = app()->chartjs
        // ->name('chartjs_pendencia_fatd_prazo')
        // ->type('bar')
        // ->size(['width' => 400, 'height' => 200])
        // ->labels(['FATD Prazo'])
        // ->datasets([
        //     [
        //         "label" => "CG",
        //         'backgroundColor' => '#3366CC',
        //         'data' => [$cg->fatd_prazo]            
        //     ],
        //     [
        //     "label" => "EM",
        //     'backgroundColor' => '#DC3912',
        //     'data' => [$em->fatd_prazo]            
        // ],
        // [
        //     "label" => "1CRPM",
        //     'backgroundColor' => '#FF9900',
        //     'data' => [$crpm1->fatd_prazo]            
        // ],
        // [
        //     "label" => "2CRPM",
        //     'backgroundColor' => '#990099',
        //     'data' => [$crpm2->fatd_prazo]            
        // ],
        // [
        //     "label" => "3CRPM",
        //     'backgroundColor' => '#3B3EAC',
        //     'data' => [$crpm3->fatd_prazo]            
        // ],
        // [
        //     "label" => "4CRPM",
        //     'backgroundColor' => '#0099C6',
        //     'data' => [$crpm4->fatd_prazo]            
        // ],
        // [
        //     "label" => "5CRPM",
        //     'backgroundColor' => '#DD4477',
        //     'data' => [$crpm5->fatd_prazo]            
        // ],
        // [
        //     "label" => "6CRPM",
        //     'backgroundColor' => '#66AA00',
        //     'data' => [$crpm6->fatd_prazo]            
        // ],
        // [
        //     "label" => "CCB",
        //     'backgroundColor' => '#B82E2E',
        //     'data' => [$ccb->fatd_prazo]            
        // ],
        
        // ])
        // ->options([
        //     'legend' => [
        //             'display' => true,
        //             'position' => 'left'
        //         ]
        // ]);

        // //IPM abertura
        // $chartjs_pendencia_ipm_abertura = app()->chartjs
        // ->name('chartjs_pendencia_ipm_abertura')
        // ->type('bar')
        // ->size(['width' => 400, 'height' => 200])
        // ->labels(['IPM Abertura'])
        // ->datasets([
        //     [
        //         "label" => "CG",
        //         'backgroundColor' => '#3366CC',
        //         'data' => [$cg->ipm_abertura]            
        //     ],
        //     [
        //     "label" => "EM",
        //     'backgroundColor' => '#DC3912',
        //     'data' => [$em->ipm_abertura]            
        // ],
        // [
        //     "label" => "1CRPM",
        //     'backgroundColor' => '#FF9900',
        //     'data' => [$crpm1->ipm_abertura]            
        // ],
        // [
        //     "label" => "2CRPM",
        //     'backgroundColor' => '#990099',
        //     'data' => [$crpm2->ipm_abertura]            
        // ],
        // [
        //     "label" => "3CRPM",
        //     'backgroundColor' => '#3B3EAC',
        //     'data' => [$crpm3->ipm_abertura]            
        // ],
        // [
        //     "label" => "4CRPM",
        //     'backgroundColor' => '#0099C6',
        //     'data' => [$crpm4->ipm_abertura]            
        // ],
        // [
        //     "label" => "5CRPM",
        //     'backgroundColor' => '#DD4477',
        //     'data' => [$crpm5->ipm_abertura]            
        // ],
        // [
        //     "label" => "6CRPM",
        //     'backgroundColor' => '#66AA00',
        //     'data' => [$crpm6->ipm_abertura]            
        // ],
        // [
        //     "label" => "CCB",
        //     'backgroundColor' => '#B82E2E',
        //     'data' => [$ccb->ipm_abertura]            
        // ],
        
        // ])
        // ->options([
        //     'legend' => [
        //             'display' => true,
        //             'position' => 'left'
        //         ]
        // ]);

        // //IPM prazo
        // $chartjs_pendencia_ipm_prazo = app()->chartjs
        // ->name('chartjs_pendencia_ipm_prazo')
        // ->type('bar')
        // ->size(['width' => 400, 'height' => 200])
        // ->labels(['IPM prazo'])
        // ->datasets([
        //     [
        //         "label" => "CG",
        //         'backgroundColor' => '#3366CC',
        //         'data' => [$cg->ipm_prazo]            
        //     ],
        //     [
        //     "label" => "EM",
        //     'backgroundColor' => '#DC3912',
        //     'data' => [$em->ipm_prazo]            
        // ],
        // [
        //     "label" => "1CRPM",
        //     'backgroundColor' => '#FF9900',
        //     'data' => [$crpm1->ipm_prazo]            
        // ],
        // [
        //     "label" => "2CRPM",
        //     'backgroundColor' => '#990099',
        //     'data' => [$crpm2->ipm_prazo]            
        // ],
        // [
        //     "label" => "3CRPM",
        //     'backgroundColor' => '#3B3EAC',
        //     'data' => [$crpm3->ipm_prazo]            
        // ],
        // [
        //     "label" => "4CRPM",
        //     'backgroundColor' => '#0099C6',
        //     'data' => [$crpm4->ipm_prazo]            
        // ],
        // [
        //     "label" => "5CRPM",
        //     'backgroundColor' => '#DD4477',
        //     'data' => [$crpm5->ipm_prazo]            
        // ],
        // [
        //     "label" => "6CRPM",
        //     'backgroundColor' => '#66AA00',
        //     'data' => [$crpm6->ipm_prazo]            
        // ],
        // [
        //     "label" => "CCB",
        //     'backgroundColor' => '#B82E2E',
        //     'data' => [$ccb->ipm_prazo]            
        // ],
        
        // ])
        // ->options([
        //     'legend' => [
        //             'display' => true,
        //             'position' => 'left'
        //         ]
        // ]);
        
        // //sindicancia abertura
        // $chartjs_pendencia_s_abertura = app()->chartjs
        // ->name('chartjs_pendencia_s_abertura')
        // ->type('bar')
        // ->size(['width' => 400, 'height' => 200])
        // ->labels(['Sindicância Abertura'])
        // ->datasets([
        //     [
        //         "label" => "CG",
        //         'backgroundColor' => '#3366CC',
        //         'data' => [$cg->sindicancia_abertura]            
        //     ],
        //     [
        //     "label" => "EM",
        //     'backgroundColor' => '#DC3912',
        //     'data' => [$em->sindicancia_abertura]            
        // ],
        // [
        //     "label" => "1CRPM",
        //     'backgroundColor' => '#FF9900',
        //     'data' => [$crpm1->sindicancia_abertura]            
        // ],
        // [
        //     "label" => "2CRPM",
        //     'backgroundColor' => '#990099',
        //     'data' => [$crpm2->sindicancia_abertura]            
        // ],
        // [
        //     "label" => "3CRPM",
        //     'backgroundColor' => '#3B3EAC',
        //     'data' => [$crpm3->sindicancia_abertura]            
        // ],
        // [
        //     "label" => "4CRPM",
        //     'backgroundColor' => '#0099C6',
        //     'data' => [$crpm4->sindicancia_abertura]            
        // ],
        // [
        //     "label" => "5CRPM",
        //     'backgroundColor' => '#DD4477',
        //     'data' => [$crpm5->sindicancia_abertura]            
        // ],
        // [
        //     "label" => "6CRPM",
        //     'backgroundColor' => '#66AA00',
        //     'data' => [$crpm6->sindicancia_abertura]            
        // ],
        // [
        //     "label" => "CCB",
        //     'backgroundColor' => '#B82E2E',
        //     'data' => [$ccb->sindicancia_abertura]            
        // ],
        
        // ])
        // ->options([
        //     'legend' => [
        //             'display' => true,
        //             'position' => 'left'
        //         ]
        // ]);

        // //sindicancia prazo
        // $chartjs_pendencia_s_prazo = app()->chartjs
        // ->name('chartjs_pendencia_s_prazo')
        // ->type('bar')
        // ->size(['width' => 400, 'height' => 200])
        // ->labels(['Sindicância Prazo'])
        // ->datasets([
        //     [
        //         "label" => "CG",
        //         'backgroundColor' => '#3366CC',
        //         'data' => [$cg->sindicancia_prazo]            
        //     ],
        //     [
        //     "label" => "EM",
        //     'backgroundColor' => '#DC3912',
        //     'data' => [$em->sindicancia_prazo]            
        // ],
        // [
        //     "label" => "1CRPM",
        //     'backgroundColor' => '#FF9900',
        //     'data' => [$crpm1->sindicancia_prazo]            
        // ],
        // [
        //     "label" => "2CRPM",
        //     'backgroundColor' => '#990099',
        //     'data' => [$crpm2->sindicancia_prazo]            
        // ],
        // [
        //     "label" => "3CRPM",
        //     'backgroundColor' => '#3B3EAC',
        //     'data' => [$crpm3->sindicancia_prazo]            
        // ],
        // [
        //     "label" => "4CRPM",
        //     'backgroundColor' => '#0099C6',
        //     'data' => [$crpm4->sindicancia_prazo]            
        // ],
        // [
        //     "label" => "5CRPM",
        //     'backgroundColor' => '#DD4477',
        //     'data' => [$crpm5->sindicancia_prazo]            
        // ],
        // [
        //     "label" => "6CRPM",
        //     'backgroundColor' => '#66AA00',
        //     'data' => [$crpm6->sindicancia_prazo]            
        // ],
        // [
        //     "label" => "CCB",
        //     'backgroundColor' => '#B82E2E',
        //     'data' => [$ccb->sindicancia_prazo]            
        // ],
        
        // ])
        // ->options([
        //     'legend' => [
        //             'display' => true,
        //             'position' => 'left'
        //         ]
        // ]);

        // //Somatórios
        // $tp_total = $cg->total + $em->total + $crpm1->total + $crpm2->total + $crpm3->total + $crpm4->total + $crpm5->total + $crpm6->total + $ccb->total;
        // $tpfatd_punicao = $cg->fatd_punicao + $em->fatd_punicao + $crpm1->fatd_punicao + $crpm2->fatd_punicao + $crpm3->fatd_punicao + $crpm4->fatd_punicao + $crpm5->fatd_punicao + $crpm6->fatd_punicao + $ccb->fatd_punicao;
        // $tpfatd_abertura = $cg->fatd_abertura + $em->fatd_abertura + $crpm1->fatd_abertura + $crpm2->fatd_abertura + $crpm3->fatd_abertura + $crpm4->fatd_abertura + $crpm5->fatd_abertura + $crpm6->fatd_abertura + $ccb->fatd_abertura;
        // $tpfatd_prazo = $cg->fatd_prazo + $em->fatd_prazo + $crpm1->fatd_prazo + $crpm2->fatd_prazo + $crpm3->fatd_prazo + $crpm4->fatd_prazo + $crpm5->fatd_prazo + $crpm6->fatd_prazo + $ccb->fatd_prazo;
        // $tpipm_abertura = $cg->ipm_abertura + $em->ipm_abertura + $crpm1->ipm_abertura + $crpm2->ipm_abertura + $crpm3->ipm_abertura + $crpm4->ipm_abertura + $crpm5->ipm_abertura + $crpm6->ipm_abertura + $ccb->ipm_abertura;
        // $tpipm_prazo = $cg->ipm_prazo + $em->ipm_prazo + $crpm1->ipm_prazo + $crpm2->ipm_prazo + $crpm3->ipm_prazo + $crpm4->ipm_prazo + $crpm5->ipm_prazo + $crpm6->ipm_prazo + $ccb->ipm_prazo;
        // $tps_abertura = $cg->sindicancia_abertura + $em->sindicancia_abertura + $crpm1->sindicancia_abertura + $crpm2->sindicancia_abertura + $crpm3->sindicancia_abertura + $crpm4->sindicancia_abertura + $crpm5->sindicancia_abertura + $crpm6->sindicancia_abertura + $ccb->sindicancia_abertura;
        // $tps_prazo = $cg->sindicancia_prazo + $em->sindicancia_prazo + $crpm1->sindicancia_prazo + $crpm2->sindicancia_prazo + $crpm3->sindicancia_prazo + $crpm4->sindicancia_prazo + $crpm5->sindicancia_prazo + $crpm6->sindicancia_prazo + $ccb->sindicancia_prazo;

        // return view('relatorios.pendencias_gerais',compact(
        //     'pendencias',
        //     'chartjs_pendencia_total',
        //     'chartjs_pendencia_fatd_punicao',
        //     'chartjs_pendencia_fatd_abertura',
        //     'chartjs_pendencia_fatd_prazo',
        //     'chartjs_pendencia_ipm_abertura',
        //     'chartjs_pendencia_ipm_prazo',
        //     'chartjs_pendencia_s_abertura',
        //     'chartjs_pendencia_s_prazo',
        //     'tp_total',
        //     'tpfatd_punicao',
        //     'tpfatd_abertura',
        //     'tpfatd_prazo',
        //     'tpipm_abertura',
        //     'tpipm_prazo',
        //     'tps_abertura',
        //     'tps_prazo'
        // ));
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
