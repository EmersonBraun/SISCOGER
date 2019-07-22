<?php

namespace App\Http\Controllers\Policiais;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PM\ElogioRepository;

class ElogiosController extends Controller
{
    protected $repository;
    public function __construct(ElogioRepository $repository)
	{
        $this->repository = $repository;
    }

    public function index()
    {
        $registros = $this->repository->all();
        return view('policiais.elogio.index', compact('registros'));
    }


    public function create()
    {
        return view('policiais.elogio.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'data' => 'required',
            'elogio' => 'required',
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
        
        return view('policiais.elogio.edit', compact('proc'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'data' => 'required',
            'elogio' => 'required',
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
}
