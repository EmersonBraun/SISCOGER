<?php

namespace App\Http\Controllers\Policiais;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PM\RestricaoRepository;

class RestricaoController extends Controller
{
    protected $repository;
    public function __construct(RestricaoRepository $repository)
	{
        $this->repository = $repository;
    }

    public function index()
    {
        $registros = $this->repository->all();
        return view('policiais.restricao.index', compact('registros'));
    }


    public function create()
    {
        return view('policiais.restricao.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'data' => 'required'
        ]);
        
        $dados = $request->all();
        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->cleanCache();
            toast()->success('N° ','restricao Inserido');
            return redirect()->route('restricao.index');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
    }

    public function edit($id)
    {
        $proc = $this->repository->findOrFail($id);
        if(!$proc) abort('404');
        
        return view('policiais.restricao.edit', compact('proc'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'data' => 'required'
        ]);

        $dados = $request->all();
        $update = $this->repository->findOrFail($id)->update($dados);
        
        if($update)
        {
            $this->repository->cleanCache();
            toast()->success('restricao atualizado!');
            return redirect()->route('restricao.index');
        }

        toast()->warning('restricao NÃO atualizado!');
        return redirect()->route('restricao.index');
    }

    public function destroy($id)
    {
        $destroy = $this->repository->findOrFail($id)->delete();

        if($destroy) {
            $this->repository->cleanCache();
            toast()->success('restricao Apagado');
            return redirect()->route('restricao.index');
        }

        toast()->warning('erro ao apagar restricao');
        return redirect()->route('restricao.index');
    }

    public function restore($id)
    {
        $restore = $this->repository->findAndRestore($id);
        
        if($restore){
            $this->repository->cleanCache();
            toast()->success('Restrição Recuperado!');
            return redirect()->route('restricao.index');  
        }

        toast()->warning('Houve um erro ao recuperar!');
        return redirect()->route('restricao.index'); 
    }

    public function forceDelete($id)
    {
        $forceDelete = $this->repository->findAndDestroy($id);
    
        if($forceDelete){
            $this->repository->cleanCache();
            toast()->success('Restrição Apagado definitivo!');
            return redirect()->route('restricao.index');  
        }

        toast()->warning('Houve um erro ao Apagar definitivo!');
        return redirect()->route('restricao.index');
    }
}
