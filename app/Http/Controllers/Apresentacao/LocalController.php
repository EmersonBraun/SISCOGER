<?php

namespace App\Http\Controllers\Apresentacao;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\apresentacao\LocalApresentacaoRepository;

class LocalController extends Controller
{
    protected $repository;
    public function __construct(LocalApresentacaoRepository $repository)
	{
        $this->repository = $repository;
    }

    public function index()
    {
        $registros = $this->repository->all();
        return view('apresentacao.local.list.index', compact('registros'));
    }

    public function apagados()
    {
        $registros = $this->repository->apagados();
        return view('apresentacao.local.list.apagados', compact('registros'));
    }

    public function create()
    {
        return view('apresentacao.local.form.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'localdeapresentacao' => 'required'
        ]);

        //dados do formulário
        $dados = $request->all(); 
        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->cleanCache();
            toast()->success('Local apresentacao Inserida');
            return redirect()->route('local.index');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
    }

    public function edit($id)
    {
        $proc = $this->repository->findOrFail($id);
        if(!$proc) abort('404');
        
        return view('apresentacao.local.form.edit', compact('proc'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'localdeapresentacao' => 'required'
        ]);

        $dados = $request->all();
        //busca procedimento e atualiza
        $update = $this->repository->findOrFail($id)->update($dados);
        
        if($update)
        {
            $this->repository->cleanCache();
            toast()->success('Local apresentacao atualizada!');
            return redirect()->route('local.index');
        }

        toast()->warning('Local apresentacao NÃO atualizada!');
        return redirect()->route('local.index');
    }

    public function destroy($id)
    {
        $destroy = $this->repository->findOrFail($id)->delete();

        if($destroy) {
            $this->repository->cleanCache();
            toast()->success('Local apresentacao Apagada');
            return redirect()->route('local.index');
        }

        toast()->warning('erro ao apagar Apresentacao');
        return redirect()->route('local.index');
    }

    public function restore($id)
    {
        // Recupera o post pelo ID
        $restore = $this->repository->findAndRestore($id);
    
        if($restore){
            $this->repository->cleanCache();
            toast()->success('Local Recuperado!');
            return redirect()->route('local.index');  
        }

        toast()->warning('Houve um erro ao recuperar!');
        return redirect()->route('local.index'); 
    }

    public function forceDelete($id)
    {
        // Recupera o post pelo ID
        $forceDelete = $this->repository->findAndDestroy($id);
    
        if($forceDelete){
            $this->repository->cleanCache();
            toast()->success('Local apagado DEFINITIVO!');
            return redirect()->route('local.index');  
        }

        toast()->warning('Houve um erro ao Apagar definitivo!');
        return redirect()->route('local.index');
    }
}
