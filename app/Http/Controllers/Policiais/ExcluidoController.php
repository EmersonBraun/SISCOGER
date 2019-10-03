<?php

namespace App\Http\Controllers\Policiais;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PM\ExcluidoRepository;
use App\Repositories\PM\EnvolvidoRepository;

class ExcluidoController extends Controller
{
    protected $repository;
    protected $excluido;

    public function __construct(
        EnvolvidoRepository $repository,
        ExcluidoRepository $excluido
    )
	{
        $this->repository = $repository;
        $this->excluido = $excluido;
    }

    public function conselho()
    {
        $registros = $this->excluido->conselhos();
        return view('policiais.excluido.list.conselhos',compact('registros'));
    }

    public function judicial()
    {
        $registros = $this->excluido->judicial();
        return view('policiais.excluido.list.judicial',compact('registros'));
    }

    public function create()
    {
        return view('policiais.excluido.form.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'rg' => 'required'
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
        
        return view('policiais.excluido.form.edit', compact('proc'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'rg' => 'required'
        ]);

        $dados = $request->all();
        $update = $this->repository->findAndUpdate( $id, $dados);
        
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
        $destroy = $this->repository->findAndDelete($id);

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
            toast()->success('excluido Recuperado!');
            return redirect()->route('excluido.index');  
        }

        toast()->warning('Houve um erro ao recuperar!');
        return redirect()->route('excluido.index'); 
    }

    public function forceDelete($id)
    {
        $forceDelete = $this->repository->findAndDestroy($id);
    
        if($forceDelete){
            $this->repository->cleanCache();
            toast()->success('excluido Apagado definitivo!');
            return redirect()->route('excluido.index');  
        }

        toast()->warning('Houve um erro ao Apagar definitivo!');
        return redirect()->route('excluido.index');
    }
}
