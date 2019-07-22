<?php

namespace App\Http\Controllers\Policiais;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PM\RespondendoRepository;

class RespondendoController extends Controller
{
    protected $repository;
    public function __construct(RespondendoRepository $repository)
	{
        $this->repository = $repository;
    }

    public function index()
    {
        $registros = $this->repository->all();
        return view('policiais.respondendo.index', compact('registros'));
    }


    public function create()
    {
        return view('policiais.respondendo.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'data' => 'required',
            'respondendo' => 'required',
        ]);
        
        $dados = $request->all();
        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->cleanCache();
            toast()->success('N° ','respondendo Inserido');
            return redirect()->route('respondendo.index');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
    }

    public function edit($id)
    {
        $proc = $this->repository->findOrFail($id);
        if(!$proc) abort('404');
        
        return view('policiais.respondendo.edit', compact('proc'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'data' => 'required',
            'respondendo' => 'required',
        ]);

        $dados = $request->all();
        $update = $this->repository->findOrFail($id)->update($dados);
        
        if($update)
        {
            $this->repository->cleanCache();
            toast()->success('respondendo atualizado!');
            return redirect()->route('respondendo.index');
        }

        toast()->warning('respondendo NÃO atualizado!');
        return redirect()->route('respondendo.index');
    }

    public function destroy($id)
    {
        $destroy = $this->repository->findOrFail($id)->delete();

        if($destroy) {
            $this->repository->cleanCache();
            toast()->success('respondendo Apagado');
            return redirect()->route('respondendo.index');
        }

        toast()->warning('erro ao apagar respondendo');
        return redirect()->route('respondendo.index');
    }
}
