<?php
namespace App\Http\Controllers\Busca;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repositories\PM\OfendidoRepository;
use App\Repositories\PM\EnvolvidoRepository;
use App\Repositories\PM\TramitacaoopmRepository;
use App\Repositories\PM\TramitacaoRepository;
use App\Repositories\PM\PolicialRepository;
use App\Services\QueryService;

class BuscaController extends Controller
{
    protected $ofendido;
    protected $envolvido;
    protected $opm;
    protected $coger;
    protected $pm;
    protected $service;
    public function __construct(
        OfendidoRepository $ofendido,
        EnvolvidoRepository $envolvido,
        TramitacaoopmRepository $opm,
        TramitacaoRepository $coger,
        PolicialRepository $pm,
        QueryService $service
    )
	{
        $this->ofendido = $ofendido;
        $this->envolvido = $envolvido;
        $this->opm = $opm;
        $this->coger = $coger;
        $this->pm = $pm;
        $this->service = $service;
    }

    public function pm()
    {
        return view('busca.pm');
    }

    public function fdi(Request $request)
    {
        $rg = $request->rg;
        return redirect()->route('fdi.show',$rg);
    }

    public function searchOfendido()
    {
        return view('busca.ofendido.search');   
    }

    public function resultOfendido(Request $request)
    {
        $query = $this->service->mount($request->except(['_token','procedimento']));
        $proc = $request->input(['procedimento']);
        $registros = $this->ofendido->list($query, $proc);
       
        return view('busca.ofendido.result',compact('registros','proc'));   
    }

    public function searchEnvolvido()
    {
        return view('busca.envolvido.search');   
    }

    public function resultEnvolvido(Request $request)
    {
        $query = $this->service->mount($request->except(['_token','procedimento']));
        $proc = $request->input(['procedimento']);
        $registros = $this->envolvido->resultSearch($query, $proc);
       
        return view('busca.envolvido.result',compact('registros','proc'));   
    }

    public function searchNominal()
    {
        return view('busca.nominal.search');   
    }

    public function resultNominal(Request $request)
    {
        $registros = $this->envolvido->buscaNominal($request->input(['rg'])); 
        return view('busca.nominal.result',compact('registros','proc'));   
    }

    public function tramitacao($ano)
    {
        $registros = $this->opm->ano($ano);
        return view('busca.tramitacao.index',compact('registros','ano'));   
    }

    public function tramitacaoCoger($ano)
    {
        $registros = $this->coger->ano($ano);  
        return view('busca.tramitacaocoger.index',compact('registros','ano'));   
    }

    public function opcoesnome($nome)
    {
        $pm = $this->pm->opcoes($nome,'nome');
        return response()->json($pm);
        
    }
    public function opcoesrg($rg)
    {
        $pm = $this->pm->opcoes($rg,'rg');
        return response()->json($pm);
        
    }
    
    public function completadados(Request $request)
    {

        $pm = $this->pm->get($request->rg); 
        $pm = (!$pm || is_null($pm)) ? '' : $pm;
        return $pm;
    }
    public function completarg($nome, Request $request)
    {
        $pm = $this->pm->getByName($nome);
        $pm = (!$pm || is_null($pm)) ? '' : $pm;
        if($pm) return Response($pm->RG);
        return '';
    }
    
    public function completanome($rg, Request $request)
    {
        $pm = $this->pm->get($rg);
        $pm = (!$pm || is_null($pm)) ? '' : $pm;
        return $pm;
    }
}