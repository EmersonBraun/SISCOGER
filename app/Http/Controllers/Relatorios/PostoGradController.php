<?php

namespace App\Http\Controllers\Relatorios;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\proc\ProcRepository;

class PostoGradController extends Controller
{
    protected $repository;
    public function __construct(ProcRepository $repository)
	{
        $this->repository = $repository;
    }
    
    public function search()
    {
        return view('relatorios.postograd.search');   
    }

    public function result(Request $request)
    {
        $inicio = $request->input('sjd_ref_ano_ini');
        $fim = $request->input('sjd_ref_ano_fim');
        $opm = $request->input('cdopm');
        $procedimento = $request->input('procedimento');
        $om = !$opm ? 'Todas' : opm($opm);

        $registros = $this->repository->searchPostoGrad($inicio, $fim, $opm, $procedimento);

        return view('relatorios.postograd.result', compact('registros','inicio','fim','om','procedimento'));
    }


}
