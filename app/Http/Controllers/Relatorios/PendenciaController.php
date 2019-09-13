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
