<?php

namespace App\Http\Controllers\Policiais;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PM\ReintegradoRepository;

class ReintegradoController extends Controller
{
    protected $repository;
    public function __construct(ReintegradoRepository $repository)
	{
        $this->repository = $repository;
    }

    public function index()
    {
        $registros = $this->repository->all();
        return view('policiais.reintegrado.list.index', compact('registros'));
    }

    public function apagados()
    {
        $registros = $this->repository->apagados();
        return view('policiais.reintegrado.list.apagados', compact('registros'));
    }


    public function create()
    {
        return view('policiais.reintegrado.form.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'rg' => 'required',
            'motivo' => 'required',
        ]);
        
        $dados = $request->all();
        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->cleanCache();
            toast()->success(special_ucwords($create->nome),'reintegrado Inserido');
            return redirect()->route('reintegrado.index');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
    }

    public function edit($id)
    {
        $proc = $this->repository->findOrFail($id);
        if(!$proc) abort('404');
        
        return view('policiais.reintegrado.form.edit', compact('proc'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'rg' => 'required',
            'motivo' => 'required',
        ]);

        $dados = $request->all();
        $update = $this->repository->findAndUpdate( $id, $dados);
        
        if($update)
        {
            $this->repository->cleanCache();
            toast()->success(special_ucwords($update->nome),'reintegrado atualizado!');
            return redirect()->route('reintegrado.index');
        }

        toast()->warning('reintegrado NÃO atualizado!');
        return redirect()->route('reintegrado.index');
    }

    public function destroy($id)
    {
        $destroy = $this->repository->findAndDelete($id);

        if($destroy) {
            $this->repository->cleanCache();
            toast()->success('reintegrado Apagado');
            return redirect()->route('reintegrado.index');
        }

        toast()->warning('erro ao apagar reintegrado');
        return redirect()->route('reintegrado.index');
    }

    public function restore($id)
    {
        $restore = $this->repository->findAndRestore($id);
        
        if($restore){
            $this->repository->cleanCache();
            toast()->success('Reintegrado Recuperado!');
            return redirect()->route('reintegrado.index');  
        }

        toast()->warning('Houve um erro ao recuperar!');
        return redirect()->route('reintegrado.index'); 
    }

    public function forceDelete($id)
    {
        $forceDelete = $this->repository->findAndDestroy($id);
    
        if($forceDelete){
            $this->repository->cleanCache();
            toast()->success('Reintegrado Apagado definitivo!');
            return redirect()->route('reintegrado.index');  
        }

        toast()->warning('Houve um erro ao Apagar definitivo!');
        return redirect()->route('reintegrado.index');
    }
}
