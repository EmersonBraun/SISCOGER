<?php
namespace App\Http\Controllers\Busca;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PM\OfendidoRepository;
use App\Repositories\PM\EnvolvidoRepository;
use App\Repositories\PM\TramitacaoopmRepository;
use App\Repositories\PM\TramitacaoRepository;
use App\Services\QueryService;
use DB;
class BuscaController extends Controller
{
    protected $ofendido;
    protected $envolvido;
    protected $opm;
    protected $coger;
    protected $service;
    public function __construct(
        OfendidoRepository $ofendido,
        EnvolvidoRepository $envolvido,
        TramitacaoopmRepository $opm,
        TramitacaoRepository $coger,
        QueryService $service
    )
	{
        $this->ofendido = $ofendido;
        $this->envolvido = $envolvido;
        $this->opm = $opm;
        $this->coger = $coger;
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
        $rg = $request->input(['rg']);
        $registros = $this->envolvido->buscaNominal($rg);
       
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

    public function opcoesnome(Request $request,$nome)
    {
        //código da opm sem os zeros
        $codigoOPM = $request->session()->get('cdopmbase');
        //verifica se o usuário tem permissão para ver todas unidades
        $verTodasUnidades = User::permission('todas-unidades')->count();
        if ($verTodasUnidades) 
        {
        $pm = BackupEfetivo::where('nome','like', "%".$nome."%")
            ->limit(10)
            ->get();
        } 
        else 
        {
            $pm = BackupEfetivo::where('nome','like', "%".$nome."%")
            ->where('cdopm', 'like', $codigoOPM.'%')
            ->limit(10)
            ->get();           
        }
        return response()->json($pm);
        
    }
    public function opcoesrg(Request $request,$rg)
    {
        //código da opm sem os zeros
        $codigoOPM = $request->session()->get('cdopmbase');
        //verifica se o usuário tem permissão para ver todas unidades
        $verTodasUnidades = User::permission('todas-unidades')->count();
        
        if ($verTodasUnidades) 
        {
        $pm = BackupEfetivo::where('rg','like', "%".$rg."%")
            ->limit(10)
            ->get();
        dd($pm);
        } 
        else 
        {
            $pm = BackupEfetivo::where('rg','like', "%".$rg."%")
            ->where('cdopm', 'like', $codigoOPM.'%')
            ->limit(10)
            ->get();           
        }
        return response()->json($pm);
        
    }
    
    public function completadados(Request $request)
    {
        //dd(\Request::all());
        //$rg = $request->rg;
        $pm = DB::connection('rhparana')
        ->table('policial')
        ->where('rg','=', $request->rg)
        ->first();
        //verificar se teve resultado
        $pm = (!$pm || is_null($pm)) ? '' : $pm;
        return $pm;
    }
    public function completarg($nome, Request $request)
    {
        $pm = DB::connection('rhparana')
        ->table('policial')
        ->where('nome','like', '%'.$nome.'%')
        ->first();
        $pm = (object) $pm;
        return Response($pm->RG);
    }
    
    public function completanome($rg, Request $request)
    {
        $pm = DB::connection('rhparana')
        ->table('policial')
        ->where('rg','like', '%'.$rg.'%')
        ->first();
        $pm = (object) $pm;
        return $pm;
    }
}