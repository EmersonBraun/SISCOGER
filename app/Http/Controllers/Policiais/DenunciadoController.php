<?php

namespace App\Http\Controllers\Policiais;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PM\DenunciacivilRepository;

class DenunciadoController extends Controller
{
    protected $repository;
    public function __construct(DenunciacivilRepository $repository)
	{
        $this->repository = $repository;
    }

    public function index()
    {
        $registros = $this->repository->all();
        return view('policiais.denunciacivil.index', compact('registros'));
    }


    public function create()
    {
        return view('policiais.denunciacivil.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'data' => 'required',
            'denunciacivil' => 'required',
        ]);
        
        $dados = $request->all();
        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->cleanCache();
            toast()->success('N° ','denunciacivil Inserido');
            return redirect()->route('denunciacivil.index');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
    }

    public function edit($id)
    {
        $proc = $this->repository->findOrFail($id);
        if(!$proc) abort('404');
        
        return view('policiais.denunciacivil.edit', compact('proc'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'data' => 'required',
            'denunciacivil' => 'required',
        ]);

        $dados = $request->all();
        $update = $this->repository->findOrFail($id)->update($dados);
        
        if($update)
        {
            $this->repository->cleanCache();
            toast()->success('denunciacivil atualizado!');
            return redirect()->route('denunciacivil.index');
        }

        toast()->warning('denunciacivil NÃO atualizado!');
        return redirect()->route('denunciacivil.index');
    }

    public function destroy($id)
    {
        $destroy = $this->repository->findOrFail($id)->delete();

        if($destroy) {
            $this->repository->cleanCache();
            toast()->success('denunciacivil Apagado');
            return redirect()->route('denunciacivil.index');
        }

        toast()->warning('erro ao apagar denunciacivil');
        return redirect()->route('denunciacivil.index');
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
