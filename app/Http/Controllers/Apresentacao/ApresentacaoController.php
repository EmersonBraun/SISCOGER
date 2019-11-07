<?php

namespace App\Http\Controllers\Apresentacao;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\apresentacao\ApresentacaoRepository;

class ApresentacaoController extends Controller
{
    protected $repository;
    public function __construct(ApresentacaoRepository $repository)
	{
        $this->repository = $repository;
    }

    public function index($ano="",$cdopm="")
    {
        if(!$ano) $ano = (int) date('Y');
        if(!$cdopm) $cdopm = session('cdopmbase');
        $registros = $this->repository->opmAno($cdopm, $ano);

        return view('apresentacao.apresentacao.list.index', compact('registros','ano','cdopm'));
    }

    public function apagados($ano="",$cdopm="")
    {
        if(!$ano) $ano = (int) date('Y');
        if(!$cdopm) $cdopm = session('cdopmbase');
        $registros = $this->repository->apagados();

        return view('apresentacao.apresentacao.list.apagados', compact('registros','ano','cdopm'));
    }

    public function search(Request $request)
    {
        $dados = $request->all();
        if(!$dados['ano']) $dados['ano'] = (int) date('Y');
        if(!$dados['cdopm']) $dados['cdopm'] = session('cdopmbase');
        
        return redirect()->route('apresentacao.index',['ano' => $dados['ano'], 'cdopm' => corta_zeros($dados['cdopm'])]);
    }

    public function create()
    {
        return view('apresentacao.apresentacao.form.create');
    }

    public function store(Request $request)
    { 
        $dados = $this->repository->datesToCreate($request->all()); 
        // $dados['comprarecimento_dh'] = $dados['comparecimento_data']." ".$dados['comparecimento_hora'];
        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->clearCache();
            // toast()->success('N° '.$dados['sjd_ref'].'/'.'Apresentacao Inserida');
            return response()->json(['success'=> true], 200);
        }
        return response()->json(['success'=> false], 500);
    }

    public function dadosApresentacao($ref,$ano="")
    {
        $search = $this->repository->refAno($ref, $ano);
        $search->pessoa_opm_codigo = corta_zeros($search->pessoa_opm_codigo);
        return response()->json($search, 200);
    }

    public function listNota($id)
    {
        $this->repository->clearCache();
        $search = $this->repository->listNota($id);
        return response()->json($search, 200);
    }

    public function edit($ref,$ano="")
    {       
        return view('apresentacao.apresentacao.form.edit', compact('ref','ano'));
    }

    public function update(Request $request, $id)
    {

        $dados = $request->all();
        $update = $this->repository->findAndUpdate( $id, $dados);
        
        if($update)
        {
            $this->repository->clearCache();
            // toast()->success('Apresentacao atualizada!');
            return response()->json(['success'=> true], 200);
        }

        return response()->json(['success'=> false], 500);
    }

    public function destroy($id)
    {
        $destroy = $this->repository->findAndDelete($id);
        if($destroy) {
            $this->repository->clearCache();
            toast()->success('Apresentacao Apagada');
            return redirect()->route('apresentacao.index');
        }
        
        toast()->warning('erro ao apagar Apresentacao');
        return redirect()->route('apresentacao.index');
    }

    public function destroyApi($id)
    {
        $destroy = $this->repository->findAndDelete($id);
        if($destroy) {
            $this->repository->clearCache();
            return response()->json(['success'=> true], 200);
        }
        
        return response()->json(['success'=> false], 200);
    }

    public function restore($id)
    {
        $restore = $this->repository->findAndRestore($id);
    
        if($restore){
            $this->repository->cleanCache();
            toast()->success('Apresentação Recuperado!');
            return redirect()->route('apresentacao.index');  
        }

        toast()->warning('Houve um erro ao recuperar!');
        return redirect()->route('apresentacao.index'); 
    }

    public function forceDelete($id)
    {
        $forceDelete = $this->repository->findAndDestroy($id);
    
        if($forceDelete){
            $this->repository->cleanCache();
            toast()->success('Apresentação apagado DEFINITIVO!');
            return redirect()->route('apresentacao.index');  
        }

        toast()->warning('Houve um erro ao Apagar definitivo!');
        return redirect()->route('apresentacao.index');
    }

}
