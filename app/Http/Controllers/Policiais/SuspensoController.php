<?php

namespace App\Http\Controllers\Policiais;

use App\Http\Controllers\Controller;
use App\Repositories\PM\SuspensoRepository;
use Illuminate\Http\Request;

class SuspensoController extends Controller
{
    protected $repository;
    public function __construct(SuspensoRepository $repository)
	{
        $this->repository = $repository;
    }

    public function index()
    {
        $registros = $this->repository->all();
        $page = 'lista';
        return view('policiais.suspenso.list.index', compact('registros','page'));
    }

    public function apagados()
    {
        $registros = $this->repository->apagados();
        $page = 'apagados';
        return view('policiais.suspenso.list.apagados',compact('registros','page'));
    }


    public function create()
    {
        return view('policiais.suspenso.form.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'rg' => 'required',
            'nome' => 'required',
            'cargo' => 'required',
            'inicio_data' => 'required',
        ]);
        
        $dados = $request->all();
        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->cleanCache();
            toast()->success('N° ','Suspenso Inserido');
            return redirect()->route('suspenso.index');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
    }

    public function edit($id)
    {
        $proc = $this->repository->findOrFail($id);
        if(!$proc) abort('404');
        
        return view('policiais.suspenso.form.edit', compact('proc'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'rg' => 'required',
            'nome' => 'required',
            'cargo' => 'required',
            'inicio_data' => 'required',
        ]);

        $dados = $request->all();
        $update = $this->repository->findAndUpdate( $id, $dados);
        
        if($update)
        {
            $this->repository->cleanCache();
            toast()->success('Suspenso atualizado!');
            return redirect()->route('suspenso.index');
        }

        toast()->warning('Suspenso NÃO atualizado!');
        return redirect()->route('suspenso.index');
    }

    public function destroy($id)
    {
        $destroy = $this->repository->findAndDelete($id);

        if($destroy) {
            $this->repository->cleanCache();
            toast()->success('Suspenso Apagado');
            return redirect()->route('suspenso.index');
        }

        toast()->warning('erro ao apagar suspenso');
        return redirect()->route('suspenso.index');
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
