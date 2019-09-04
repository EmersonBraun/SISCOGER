<?php

namespace App\Http\Controllers\Policiais;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PM\ProtocoloRepository;

class ProtocoloController extends Controller
{
    protected $repository;
    public function __construct(ProtocoloRepository $repository)
	{
        $this->repository = $repository;
    }

    public function list($rg)
    {
        return $this->repository->protocolo($rg);
    }

    public function store(Request $request)
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

    public function edit($id)
    {
        $proc = $this->repository->findOrFail($id);
        if(!$proc) abort('404');
        
        return view('policiais.preso_outro.form.edit', compact('proc'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'rg' => 'required',
            'nome' => 'required',
            'cdopm_prisao' => 'required',
            'inicio_data' => 'required',
        ]);

        $dados = $request->all();
        $update = $this->repository->findOrFail($id)->update($dados);
        
        if($update)
        {
            $this->repository->cleanCache();
            toast()->success('preso atualizado!');
            return redirect()->route('presooutro.index');
        }

        toast()->warning('preso NÃO atualizado!');
        return redirect()->route('presooutro.index');
    }

    public function destroy($id)
    {
        $destroy = $this->repository->findOrFail($id)->delete();

        if($destroy) {
            $this->repository->cleanCache();
            toast()->success('preso Apagado');
            return redirect()->route('presooutro.index');
        }

        toast()->warning('erro ao apagar preso');
        return redirect()->route('presooutro.index');
    }

    public function restore($id)
    {
        $restore = $this->repository->findAndRestore($id);
        
        if($restore){
            $this->repository->cleanCache();
            toast()->success('Preso Recuperado!');
            return redirect()->route('presooutro.index');  
        }

        toast()->warning('Houve um erro ao recuperar!');
        return redirect()->route('presooutro.index'); 
    }

    public function forceDelete($id)
    {
        $forceDelete = $this->repository->findAndDestroy($id);
    
        if($forceDelete){
            $this->repository->cleanCache();
            toast()->success('Preso Apagado definitivo!');
            return redirect()->route('presooutro.index');  
        }

        toast()->warning('Houve um erro ao Apagar definitivo!');
        return redirect()->route('presooutro.index');
    }
}
