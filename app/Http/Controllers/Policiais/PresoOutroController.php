<?php

namespace App\Http\Controllers\Policiais;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PM\PresoOutroRepository;

class PresoOutroController extends Controller
{
    protected $repository;
    public function __construct(PresoOutroRepository $repository)
	{
        $this->repository = $repository;
    }

    public function index()
    {
        $registros = $this->repository->all();
        return view('policiais.preso_outro.list.index', compact('registros'));
    }

    public function apagados()
    {
        $registros = $this->repository->apagados();
        return view('policiais.preso_outro.list.apagados', compact('registros'));
    }


    public function create()
    {
        return view('policiais.preso_outro.form.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'rg' => 'required',
            'nome' => 'required',
            'cdopm_prisao' => 'required',
            'inicio_data' => 'required',
        ]);
        
        $dados = $request->all();
        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->cleanCache();
            toast()->success('N° '.$create->id_preso_outros,'Inserido');
            return redirect()->route('presooutro.index');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
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
        $update = $this->repository->findAndUpdate( $id, $dados);
        
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
        $destroy = $this->repository->findAndDelete($id);

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
