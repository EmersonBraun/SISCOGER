<?php

namespace App\Http\Controllers\Policiais;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PM\MortosFeridosRepository;

class MortoFeridoController extends Controller
{
    protected $repository;
    public function __construct(MortosFeridosRepository $repository)
	{
        $this->repository = $repository;
    }

    public function index()
    {
        $registros = $this->repository->all();
        return view('policiais.mortosferidos.index', compact('registros'));
    }


    public function create()
    {
        return view('policiais.mortosferidos.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'data' => 'required',
            'mortosferidos' => 'required',
        ]);
        
        $dados = $request->all();
        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->cleanCache();
            toast()->success('N° ','mortosferidos Inserido');
            return redirect()->route('mortosferidos.index');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
    }

    public function edit($id)
    {
        $proc = $this->repository->findOrFail($id);
        if(!$proc) abort('404');
        
        return view('policiais.mortosferidos.edit', compact('proc'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'data' => 'required',
            'mortosferidos' => 'required',
        ]);

        $dados = $request->all();
        $update = $this->repository->findOrFail($id)->update($dados);
        
        if($update)
        {
            $this->repository->cleanCache();
            toast()->success('mortosferidos atualizado!');
            return redirect()->route('mortosferidos.index');
        }

        toast()->warning('mortosferidos NÃO atualizado!');
        return redirect()->route('mortosferidos.index');
    }

    public function destroy($id)
    {
        $destroy = $this->repository->findOrFail($id)->delete();

        if($destroy) {
            $this->repository->cleanCache();
            toast()->success('mortosferidos Apagado');
            return redirect()->route('mortosferidos.index');
        }

        toast()->warning('erro ao apagar mortosferidos');
        return redirect()->route('mortosferidos.index');
    }

    public function restore($id)
    {
        $restore = $this->repository->findAndRestore($id);
        
        if($restore){
            $this->repository->cleanCache();
            toast()->success('Suspenso Recuperado!');
            return redirect()->route('suspenso.index');  
        }

        toast()->warning('Houve um erro ao recuperar!');
        return redirect()->route('suspenso.index'); 
    }

    public function forceDelete($id)
    {
        $forceDelete = $this->repository->findAndDestroy($id);
    
        if($forceDelete){
            $this->repository->cleanCache();
            toast()->success('Suspenso Apagado definitivo!');
            return redirect()->route('suspenso.index');  
        }

        toast()->warning('Houve um erro ao Apagar definitivo!');
        return redirect()->route('suspenso.index');
    }
}
