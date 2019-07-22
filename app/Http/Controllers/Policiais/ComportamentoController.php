<?php

namespace App\Http\Controllers\Policiais;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PM\ComportamentoRepository;

class ComportamentoController extends Controller
{
    protected $repository;
    public function __construct(ComportamentoRepository $repository)
	{
        $this->repository = $repository;
    }

    public function index()
    {
        $registros = $this->repository->all();
        return view('policiais.comportamento.index', compact('registros'));
    }


    public function create()
    {
        return view('policiais.comportamento.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'data' => 'required',
            'comportamento' => 'required',
        ]);
        
        $dados = $request->all();
        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->cleanCache();
            toast()->success('N° ','comportamento Inserido');
            return redirect()->route('comportamento.index');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
    }

    public function edit($id)
    {
        $proc = $this->repository->findOrFail($id);
        if(!$proc) abort('404');
        
        return view('policiais.comportamento.edit', compact('proc'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'data' => 'required',
            'comportamento' => 'required',
        ]);

        $dados = $request->all();
        $update = $this->repository->findOrFail($id)->update($dados);
        
        if($update)
        {
            $this->repository->cleanCache();
            toast()->success('comportamento atualizado!');
            return redirect()->route('comportamento.index');
        }

        toast()->warning('comportamento NÃO atualizado!');
        return redirect()->route('comportamento.index');
    }

    public function destroy($id)
    {
        $destroy = $this->repository->findOrFail($id)->delete();

        if($destroy) {
            $this->repository->cleanCache();
            toast()->success('comportamento Apagado');
            return redirect()->route('comportamento.index');
        }

        toast()->warning('erro ao apagar comportamento');
        return redirect()->route('comportamento.index');
    }
}
