<?php

namespace App\Http\Controllers\Policiais;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PM\PresoRepository;

class PresosController extends Controller
{
    protected $repository;
    public function __construct(PresoRepository $repository)
	{
        $this->repository = $repository;
    }

    public function index()
    {
        $registros = $this->repository->all();
        return view('policiais.preso.index', compact('registros'));
    }


    public function create()
    {
        return view('policiais.preso.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'data' => 'required',
            'preso' => 'required',
        ]);
        
        $dados = $request->all();
        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->cleanCache();
            toast()->success('N° ','preso Inserido');
            return redirect()->route('preso.index');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
    }

    public function edit($id)
    {
        $proc = $this->repository->findOrFail($id);
        if(!$proc) abort('404');
        
        return view('policiais.preso.edit', compact('proc'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'data' => 'required',
            'preso' => 'required',
        ]);

        $dados = $request->all();
        $update = $this->repository->findOrFail($id)->update($dados);
        
        if($update)
        {
            $this->repository->cleanCache();
            toast()->success('preso atualizado!');
            return redirect()->route('preso.index');
        }

        toast()->warning('preso NÃO atualizado!');
        return redirect()->route('preso.index');
    }

    public function destroy($id)
    {
        $destroy = $this->repository->findOrFail($id)->delete();

        if($destroy) {
            $this->repository->cleanCache();
            toast()->success('preso Apagado');
            return redirect()->route('preso.index');
        }

        toast()->warning('erro ao apagar preso');
        return redirect()->route('preso.index');
    }
}
