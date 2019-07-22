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
        return view('policiais.suspenso.index', compact('registros'));
    }


    public function create()
    {
        return view('policiais.suspenso.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'data' => 'required',
            'suspenso' => 'required',
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
        
        return view('policiais.suspenso.edit', compact('proc'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'data' => 'required',
            'suspenso' => 'required',
        ]);

        $dados = $request->all();
        $update = $this->repository->findOrFail($id)->update($dados);
        
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
        $destroy = $this->repository->findOrFail($id)->delete();

        if($destroy) {
            $this->repository->cleanCache();
            toast()->success('Suspenso Apagado');
            return redirect()->route('suspenso.index');
        }

        toast()->warning('erro ao apagar suspenso');
        return redirect()->route('suspenso.index');
    }

}
