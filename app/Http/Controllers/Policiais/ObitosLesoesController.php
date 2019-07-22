<?php

namespace App\Http\Controllers\Policiais;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PM\ObitoLesoesRepository;

class ObitosLesoesController extends Controller
{
    protected $repository;
    public function __construct(ObitoLesoesRepository $repository)
	{
        $this->repository = $repository;
    }

    public function index()
    {
        $registros = $this->repository->all();
        return view('policiais.obitolesoes.index', compact('registros'));
    }


    public function create()
    {
        return view('policiais.obitolesoes.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'data' => 'required',
            'obitolesoes' => 'required',
        ]);
        
        $dados = $request->all();
        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->cleanCache();
            toast()->success('N° ','obitolesoes Inserido');
            return redirect()->route('obitolesoes.index');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
    }

    public function edit($id)
    {
        $proc = $this->repository->findOrFail($id);
        if(!$proc) abort('404');
        
        return view('policiais.obitolesoes.edit', compact('proc'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'data' => 'required',
            'obitolesoes' => 'required',
        ]);

        $dados = $request->all();
        $update = $this->repository->findOrFail($id)->update($dados);
        
        if($update)
        {
            $this->repository->cleanCache();
            toast()->success('obitolesoes atualizado!');
            return redirect()->route('obitolesoes.index');
        }

        toast()->warning('obitolesoes NÃO atualizado!');
        return redirect()->route('obitolesoes.index');
    }

    public function destroy($id)
    {
        $destroy = $this->repository->findOrFail($id)->delete();

        if($destroy) {
            $this->repository->cleanCache();
            toast()->success('obitolesoes Apagado');
            return redirect()->route('obitolesoes.index');
        }

        toast()->warning('erro ao apagar obitolesoes');
        return redirect()->route('obitolesoes.index');
    }
}
