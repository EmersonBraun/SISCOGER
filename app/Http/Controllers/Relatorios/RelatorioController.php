<?php

namespace App\Http\Controllers\Relatorios;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PM\EnvolvidoRepository;
use App\Repositories\PM\OfendidoRepository;
use App\Services\QueryService;

class RelatorioController extends Controller
{
    protected $envolvido;
    protected $ofendido;
    protected $service;
    public function __construct(
        EnvolvidoRepository $envolvido,
        OfendidoRepository $ofendido,
        QueryService $service
    )
	{
        $this->envolvido = $envolvido;
        $this->ofendido = $ofendido;
        $this->service = $service;
    }
    
    public function defensor()
    {
        $registros = $this->envolvido->situacao('defensor');
        return view('relatorios.defensor.index',compact('registros'));   
    }

    public function searchEncarregado()
    {
        return view('relatorios.encarregado.search');   
    }

    public function resultEncarregado(Request $request)
    {
        $proc = $request->input('procedimento');
        $opm = $request->input('cdopm');
        $ano = $request->input('sjd_ref_ano');

        $registros = $this->envolvido->relatorioEncarregados($proc, $opm, $ano);
       
        return view('relatorios.encarregado.result',compact('registros'));   
    }

    public function searchOfendido()
    {
        return view('relatorios.ofendido.search');   
    }

    public function resultOfendido(Request $request)
    {
        $query = $this->service->mount($request->except(['_token','procedimento']));
        $proc = $request->input(['procedimento']);

        $registros = $this->ofendido->relatorio($query, $proc);
       
        return view('relatorios.ofendido.result',compact('registros','proc'));   
    }

}
