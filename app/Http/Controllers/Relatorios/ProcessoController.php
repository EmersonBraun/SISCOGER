<?php

namespace App\Http\Controllers\Relatorios;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\proc\ProcRepository;

class ProcessoController extends Controller
{
    protected $repository;
    public function __construct(ProcRepository $repository)
	{
        $this->repository = $repository;
    }
    
    public function search()
    {
        return view('relatorios.processo.search');   
    }

    public function result(Request $request)
    {
        $inicio = $request->input('sjd_ref_ano_ini');
        $fim = $request->input('sjd_ref_ano_fim');
        $opm = $request->input('cdopm');
        $om = !$opm ? 'Todas' : opm($opm);

        $registros = $this->repository->search($inicio, $fim, $opm);

        return view('relatorios.processo.result', compact('registros','inicio','fim','om'));
    }


}
