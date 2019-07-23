<?php

namespace App\Http\Controllers\Relatorios;

use App\Http\Controllers\Controller;
use App\Repositories\proc\AdlRepository;
use App\Repositories\proc\CdRepository;
use App\Repositories\proc\CjRepository;
use App\Repositories\proc\FatdRepository;
use App\Repositories\proc\ItRepository;
use App\Repositories\proc\SindicanciaRepository;

class SobrestamentoController extends Controller
{

    public function adl(AdlRepository $repository) 
    {
        $resistros = $repository->sobrestado();
        $proc = 'adl';
        return view('relatorios.sobrestamento.index',compact('registros','proc'));
    }

    public function cd(CdRepository $repository) 
    {
        $resistros = $repository->sobrestado();
        $proc = 'cd';
        return view('relatorios.sobrestamento.index',compact('registros','proc'));
    }

    public function cj(CjRepository $repository) 
    {
        $resistros = $repository->sobrestado();
        $proc = 'cj';
        return view('relatorios.sobrestamento.index',compact('registros','proc'));
    }

    public function fatd(FatdRepository $repository) 
    {
        $resistros = $repository->sobrestado();
        $proc = 'fatd';
        return view('relatorios.sobrestamento.index',compact('registros','proc'));
    }

    public function it(ItRepository $repository) 
    {
        $resistros = $repository->sobrestado();
        $proc = 'it';
        return view('relatorios.sobrestamento.index',compact('registros','proc'));
    }

    public function sindicancia(SindicanciaRepository $repository) {
        $resistros = $repository->sobrestado();
        $proc = 'sindicancia';
        return view('relatorios.sobrestamento.index',compact('registros','proc'));
    }
}
