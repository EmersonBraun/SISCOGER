<?php

namespace App\Http\Controllers\Policiais;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PM\PunidoRepository;

class PunidoController extends Controller
{
    protected $repository;
    public function __construct(PunidoRepository $repository)
	{
        $this->repository = $repository;
    }

    public function index()
    {
        $registros = $this->repository->all();
        return view('policiais.punido.index', compact('registros'));
    }


    public function create()
    {
        return view('policiais.punido.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'data' => 'required',
            'punido' => 'required',
        ]);
        
        $dados = $request->all();
        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->cleanCache();
            toast()->success('N° ','punido Inserido');
            return redirect()->route('punido.index');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
    }

    public function edit($id)
    {
        $proc = $this->repository->findOrFail($id);
        if(!$proc) abort('404');
        
        return view('policiais.punido.edit', compact('proc'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'data' => 'required',
            'punido' => 'required',
        ]);

        $dados = $request->all();
        $update = $this->repository->findOrFail($id)->update($dados);
        
        if($update)
        {
            $this->repository->cleanCache();
            toast()->success('punido atualizado!');
            return redirect()->route('punido.index');
        }

        toast()->warning('punido NÃO atualizado!');
        return redirect()->route('punido.index');
    }

    public function destroy($id)
    {
        $destroy = $this->repository->findOrFail($id)->delete();

        if($destroy) {
            $this->repository->cleanCache();
            toast()->success('punido Apagado');
            return redirect()->route('punido.index');
        }

        toast()->warning('erro ao apagar punido');
        return redirect()->route('punido.index');
    }

    public function restore($id)
    {
        $restore = $this->repository->findAndRestore($id);
        
        if($restore){
            $this->repository->cleanCache();
            toast()->success('Punido Recuperado!');
            return redirect()->route('punido.index');  
        }

        toast()->warning('Houve um erro ao recuperar!');
        return redirect()->route('punido.index'); 
    }

    public function forceDelete($id)
    {
        $forceDelete = $this->repository->findAndDestroy($id);
    
        if($forceDelete){
            $this->repository->cleanCache();
            toast()->success('Punido Apagado definitivo!');
            return redirect()->route('punido.index');  
        }

        toast()->warning('Houve um erro ao Apagar definitivo!');
        return redirect()->route('punido.index');
    }
}
