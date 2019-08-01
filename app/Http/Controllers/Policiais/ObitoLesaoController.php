<?php

namespace App\Http\Controllers\Policiais;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PM\ObitoLesaoRepository;

class ObitoLesaoController extends Controller
{
    protected $repository;
    public function __construct(ObitoLesaoRepository $repository)
	{
        $this->repository = $repository;
    }

    public function index()
    {
        $registros = $this->repository->all();
        $page = 'lista';
        return view('policiais.obitolesao.index', compact('registros','page'));
    }

    public function apagados()
    {
        $registros = $this->repository->apagados();
        $page = 'apagados';
        return view('policiais.obitolesao.apagados',compact('registros','page'));
    }

    public function create()
    {
        return view('policiais.obitolesao.create');
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
            toast()->success('N° ','obitolesao Inserido');
            return redirect()->route('obitolesao.index');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
    }

    public function edit($id)
    {
        $proc = $this->repository->findOrFail($id);
        if(!$proc) abort('404');
        
        return view('policiais.obitolesao.edit', compact('proc'));
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
            toast()->success('obitolesao atualizado!');
            return redirect()->route('obitolesao.index');
        }

        toast()->warning('obitolesao NÃO atualizado!');
        return redirect()->route('obitolesao.index');
    }

    public function destroy($id)
    {
        $destroy = $this->repository->findOrFail($id)->delete();

        if($destroy) {
            $this->repository->cleanCache();
            toast()->success('obitolesao Apagado');
            return redirect()->route('obitolesao.index');
        }

        toast()->warning('erro ao apagar obitolesao');
        return redirect()->route('obitolesao.index');
    }

    public function restore($id)
    {
        $restore = $this->repository->findAndRestore($id);
        
        if($restore){
            $this->repository->cleanCache();
            toast()->success('Óbito/Lesões Recuperado!');
            return redirect()->route('obitolesao.index');  
        }

        toast()->warning('Houve um erro ao recuperar!');
        return redirect()->route('obitolesao.index'); 
    }

    public function forceDelete($id)
    {
        $forceDelete = $this->repository->findAndDestroy($id);
    
        if($forceDelete){
            $this->repository->cleanCache();
            toast()->success('Óbito/Lesões Apagado definitivo!');
            return redirect()->route('obitolesao.index');  
        }

        toast()->warning('Houve um erro ao Apagar definitivo!');
        return redirect()->route('obitolesao.index');
    }
}
