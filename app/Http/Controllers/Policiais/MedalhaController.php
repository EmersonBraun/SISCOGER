<?php

namespace App\Http\Controllers\Policiais;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PM\MedalhaRepository;

class MedalhaController extends Controller
{
    protected $repository;
    public function __construct(MedalhaRepository $repository)
	{
        $this->repository = $repository;
    }

    public function index()
    {
        $registros = $this->repository->all();
        return view('policiais.medalha.list.index', compact('registros'));
    }

    public function apagados()
    {
        $registros = $this->repository->apagados();
        return view('policiais.medalha.list.apagados', compact('registros'));
    }


    public function create()
    {
        return view('policiais.medalha.form.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'rg' => 'required',
        ]);
        
        $dados = $request->all();
        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->cleanCache();
            toast()->success('N° ','medalha Inserido');
            return redirect()->route('medalha.index');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
    }

    public function edit($id)
    {
        $proc = $this->repository->findOrFail($id);
        if(!$proc) abort('404');
        
        return view('policiais.medalha.form.edit', compact('proc'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'rg' => 'required',
        ]);

        $dados = $request->all();
        $update = $this->repository->findOrFail($id)->update($dados);
        
        if($update)
        {
            $this->repository->cleanCache();
            toast()->success('medalha atualizado!');
            return redirect()->route('medalha.index');
        }

        toast()->warning('medalha NÃO atualizado!');
        return redirect()->route('medalha.index');
    }

    public function destroy($id)
    {
        $destroy = $this->repository->findOrFail($id)->delete();

        if($destroy) {
            $this->repository->cleanCache();
            toast()->success('Apagado');
            return redirect()->route('medalha.index');
        }

        toast()->warning('erro ao apagar medalha');
        return redirect()->route('medalha.index');
    }

    public function restore($id)
    {
        $restore = $this->repository->findAndRestore($id);
        
        if($restore){
            $this->repository->cleanCache();
            toast()->success('Recuperado!');
            return redirect()->route('medalha.index');  
        }

        toast()->warning('Houve um erro ao recuperar!');
        return redirect()->route('medalha.index'); 
    }

    public function forceDelete($id)
    {
        $forceDelete = $this->repository->findAndDestroy($id);
    
        if($forceDelete){
            $this->repository->cleanCache();
            toast()->success('Apagado definitivo!');
            return redirect()->route('medalha.index');  
        }

        toast()->warning('Houve um erro ao Apagar definitivo!');
        return redirect()->route('medalha.index');
    }

    // API

    public function list($rg)
    {
        $data = $this->repository->medalhas($rg);
        return response()->json($data);
    }

    public function storeAPI(Request $request)
    {
        $dados = $request->all();
        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->cleanCache();
            return response()->json(['success' => true,200]);
        }
        return response()->json(['success' => false,200]);
    }

    public function updateAPI(Request $request, $id)
    {
        $dados = $request->all();
        $update = $this->repository->findOrFail($id)->update($dados);
        
        if($update)
        {
            $this->repository->cleanCache();
            return response()->json(['success' => true,200]);
        }

        return response()->json(['success' => false,200]);
    }

    public function destroyAPI($id)
    {
        $destroy = $this->repository->findOrFail($id)->delete();

        if($destroy) {
            $this->repository->cleanCache();
            return response()->json(['success' => true,200]);
        }

        return response()->json(['success' => false,200]);
    }
}
