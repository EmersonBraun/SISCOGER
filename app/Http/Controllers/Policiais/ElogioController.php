<?php

namespace App\Http\Controllers\Policiais;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PM\ElogioRepository;
use App\Services\QueryService;

class ElogioController extends Controller
{
    protected $repository;
    protected $query;
    public function __construct(
        ElogioRepository $repository,
        QueryService $query
    )
	{
        $this->repository = $repository;
        $this->query = $query;
    }

    public function index()
    {
        return view('policiais.elogio.list.search');
    }

    public function search(Request $request)
    {
        $query = $this->query->mount($request->except(['_token']));

        $registros = $this->repository->search($query);

        return view('policiais.elogio.list.index', compact('registros','query'));
    }

    public function create()
    {
        return view('policiais.elogio.form.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'rg' => 'required',
            'cdopm' => 'required'
        ]);
        
        $dados = $request->all();
        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->cleanCache();
            toast()->success('N° ','elogio Inserido');
            return redirect()->route('elogio.index');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
    }

    public function edit($id)
    {
        $proc = $this->repository->findOrFail($id);
        if(!$proc) abort('404');
        return view('policiais.elogio.form.edit', compact('proc'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'rg' => 'required',
            'cdopm' => 'required'
        ]);

        $dados = $request->all();
        $update = $this->repository->findOrFail($id)->update($dados);
        
        if($update)
        {
            $this->repository->cleanCache();
            toast()->success('elogio atualizado!');
            return redirect()->route('elogio.index');
        }

        toast()->warning('elogio NÃO atualizado!');
        return redirect()->route('elogio.index');
    }

    public function destroy($id)
    {
        $destroy = $this->repository->findOrFail($id)->delete();

        if($destroy) {
            $this->repository->cleanCache();
            toast()->success('elogio Apagado');
            return redirect()->route('elogio.index');
        }

        toast()->warning('erro ao apagar elogio');
        return redirect()->route('elogio.index');
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
