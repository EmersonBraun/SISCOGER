<?php

namespace App\Http\Controllers\Policiais;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PM\ExcluidoRepository;

class ExcluidoController extends Controller
{
    protected $repository;
    public function __construct(ExcluidoRepository $repository)
	{
        $this->repository = $repository;
    }

    public function index()
    {
        $registros = $this->repository->all();
        return view('policiais.excluido.index', compact('registros'));
    }


    public function create()
    {
        return view('policiais.excluido.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'data' => 'required',
            'excluido' => 'required',
        ]);
        
        $dados = $request->all();
        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->cleanCache();
            toast()->success('N° ','excluido Inserido');
            return redirect()->route('excluido.index');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
    }

    public function edit($id)
    {
        $proc = $this->repository->findOrFail($id);
        if(!$proc) abort('404');
        
        return view('policiais.excluido.edit', compact('proc'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'data' => 'required',
            'excluido' => 'required',
        ]);

        $dados = $request->all();
        $update = $this->repository->findOrFail($id)->update($dados);
        
        if($update)
        {
            $this->repository->cleanCache();
            toast()->success('excluido atualizado!');
            return redirect()->route('excluido.index');
        }

        toast()->warning('excluido NÃO atualizado!');
        return redirect()->route('excluido.index');
    }

    public function destroy($id)
    {
        $destroy = $this->repository->findOrFail($id)->delete();

        if($destroy) {
            $this->repository->cleanCache();
            toast()->success('excluido Apagado');
            return redirect()->route('excluido.index');
        }

        toast()->warning('erro ao apagar excluido');
        return redirect()->route('excluido.index');
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
