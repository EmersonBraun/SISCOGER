<?php

namespace App\Http\Controllers\Policiais;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PM\SaiRepository;

class SaiController extends Controller
{
    protected $repository;
    public function __construct(SaiRepository $repository)
	{
        $this->repository = $repository;
    }

    public function index()
    {
        $registros = $this->repository->all();
        return view('policiais.sai.index', compact('registros'));
    }


    public function create()
    {
        return view('policiais.sai.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'data' => 'required',
            'sai' => 'required',
        ]);
        
        $dados = $request->all();
        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->cleanCache();
            toast()->success('N° ','SAI Inserido');
            return redirect()->route('sai.index');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
    }

    public function edit($id)
    {
        $proc = $this->repository->findOrFail($id);
        if(!$proc) abort('404');
        
        return view('policiais.sai.edit', compact('proc'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'data' => 'required',
            'sai' => 'required',
        ]);

        $dados = $request->all();
        $update = $this->repository->findOrFail($id)->update($dados);
        
        if($update)
        {
            $this->repository->cleanCache();
            toast()->success('SAI atualizado!');
            return redirect()->route('sai.index');
        }

        toast()->warning('SAI NÃO atualizado!');
        return redirect()->route('sai.index');
    }

    public function destroy($id)
    {
        $destroy = $this->repository->findOrFail($id)->delete();

        if($destroy) {
            $this->repository->cleanCache();
            toast()->success('SAI Apagado');
            return redirect()->route('sai.index');
        }

        toast()->warning('erro ao apagar SAI');
        return redirect()->route('sai.index');
    }

    public function restore($id)
    {
        $restore = $this->repository->findAndRestore($id);
        
        if($restore){
            $this->repository->cleanCache();
            toast()->success('Sai Recuperado!');
            return redirect()->route('sai.index');  
        }

        toast()->warning('Houve um erro ao recuperar!');
        return redirect()->route('sai.index'); 
    }

    public function forceDelete($id)
    {
        $forceDelete = $this->repository->findAndDestroy($id);
    
        if($forceDelete){
            $this->repository->cleanCache();
            toast()->success('Sai Apagado definitivo!');
            return redirect()->route('sai.index');  
        }

        toast()->warning('Houve um erro ao Apagar definitivo!');
        return redirect()->route('sai.index');
    }
}
