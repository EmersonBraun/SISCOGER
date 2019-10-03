<?php

namespace App\Http\Controllers\Administracao;

use App\Http\Controllers\Controller;
use App\Repositories\administracao\FeriadoRepository;
use Illuminate\Http\Request;

class FeriadoController extends Controller
{
    protected $repository;
    public function __construct(FeriadoRepository $repository)
	{
        $this->repository = $repository;
    }

    public function index()
    {
        $registros = $this->repository->all();
        return view('administracao.feriado.index', compact('registros'));
    }


    public function create()
    {
        return view('administracao.feriado.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'data' => 'required',
            'feriado' => 'required',
        ]);
        
        $dados = $request->all();
        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->cleanCache();
            toast()->success('N° ','Feriado Inserido');
            return redirect()->route('feriado.index');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
    }

    public function edit($id)
    {
        $proc = $this->repository->findOrFail($id);        
        return view('administracao.feriado.edit', compact('proc'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'data' => 'required',
            'feriado' => 'required',
        ]);

        $dados = $request->all();
        $update = $this->repository->findAndUpdate( $id, $dados);
        
        if($update)
        {
            $this->repository->cleanCache();
            toast()->success('Feriado atualizado!');
            return redirect()->route('feriado.index');
        }

        toast()->warning('Feriado NÃO atualizado!');
        return redirect()->route('feriado.index');
    }

    public function destroy($id)
    {
        $destroy = $this->repository->findAndDelete($id);

        if($destroy) {
            $this->repository->cleanCache();
            toast()->success('Feriado Apagado');
            return redirect()->route('feriado.index');
        }

        toast()->warning('erro ao apagar feriado');
        return redirect()->route('feriado.index');
    }

}
