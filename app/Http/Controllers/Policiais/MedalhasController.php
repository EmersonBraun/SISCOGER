<?php

namespace App\Http\Controllers\Policiais;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PM\MedalhaRepository;

class MedalhasController extends Controller
{
    protected $repository;
    public function __construct(MedalhaRepository $repository)
	{
        $this->repository = $repository;
    }

    public function index()
    {
        $registros = $this->repository->all();
        return view('policiais.medalha.index', compact('registros'));
    }


    public function create()
    {
        return view('policiais.medalha.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'data' => 'required',
            'medalha' => 'required',
        ]);
        
        $dados = $request->all();
        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->cleanCache();
            toast()->success('N° ','medalha Inserido');
            return redirect()->route('medalha.index');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
    }

    public function edit($id)
    {
        $proc = $this->repository->findOrFail($id);
        if(!$proc) abort('404');
        
        return view('policiais.medalha.edit', compact('proc'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'data' => 'required',
            'medalha' => 'required',
        ]);

        $dados = $request->all();
        $update = $this->repository->findOrFail($id)->update($dados);
        
        if($update)
        {
            $this->repository->cleanCache();
            toast()->success('medalha atualizado!');
            return redirect()->route('medalha.index');
        }

        toast()->warning('medalha NÃO atualizado!');
        return redirect()->route('medalha.index');
    }

    public function destroy($id)
    {
        $destroy = $this->repository->findOrFail($id)->delete();

        if($destroy) {
            $this->repository->cleanCache();
            toast()->success('medalha Apagado');
            return redirect()->route('medalha.index');
        }

        toast()->warning('erro ao apagar medalha');
        return redirect()->route('medalha.index');
    }
}
