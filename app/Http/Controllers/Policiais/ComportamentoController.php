<?php

namespace App\Http\Controllers\Policiais;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PM\ComportamentoRepository;

class ComportamentoController extends Controller
{
    protected $repository;
    protected $proc = 'comportamento';
    protected $nome = 'Comportamento';
    protected $index = 'comportamento.index';

    public function __construct(ComportamentoRepository $repository)
	{
        $this->repository = $repository;
    }

    public function index()
    {
        $registros = $this->repository->all();
        return view('policiais.comportamento.index', compact('registros'));
    }


    public function create()
    {
        return view('policiais.comportamento.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'data' => 'required',
        ]);
        
        $dados = $request->all();
        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->cleanCache();
            toast()->success('N° ',$this->name.' Inserido');
            return redirect()->route($this->index);
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
    }

    public function edit($id)
    {
        $proc = $this->repository->findOrFail($id);
        if(!$proc) abort('404');
        
        return view('policiais.comportamento.edit', compact('proc'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'data' => 'required',
        ]);

        $dados = $request->all();
        $update = $this->repository->findOrFail($id)->update($dados);
        
        if($update)
        {
            $this->repository->cleanCache();
            toast()->success($this->name.' atualizado!');
            return redirect()->route($this->index);
        }

        toast()->warning($this->name.' NÃO atualizado!');
        return redirect()->route($this->index);
    }

    public function destroy($id)
    {
        $destroy = $this->repository->findOrFail($id)->delete();

        if($destroy) {
            $this->repository->cleanCache();
            toast()->success($this->name.' Apagado');
            return redirect()->route($this->index);
        }

        toast()->warning('erro ao apagar comportamento');
        return redirect()->route($this->index);
    }

    public function restore($id)
    {
        $restore = $this->repository->findAndRestore($id);
        
        if($restore){
            $this->repository->cleanCache();
            toast()->success($this->name.' Recuperado!');
            return redirect()->route($this->index);  
        }

        toast()->warning('Houve um erro ao recuperar!');
        return redirect()->route($this->index); 
    }

    public function forceDelete($id)
    {
        $forceDelete = $this->repository->findAndDestroy($id);
    
        if($forceDelete){
            $this->repository->cleanCache();
            toast()->success($this->name.' Apagado definitivo!');
            return redirect()->route($this->index);  
        }

        toast()->warning('Houve um erro ao Apagar definitivo!');
        return redirect()->route($this->index);
    }
}
