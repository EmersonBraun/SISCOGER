<?php

namespace App\Http\Controllers\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repositories\proc\ExclusaoRepository;

class ExclusaoController extends Controller
{
    protected $repository;
    public function __construct(ExclusaoRepository $repository)
	{
        $this->repository = $repository;
    }

    public function index()
    {
        return redirect()->route('exclusao.lista');
    }

    public function lista()
    {
        $registros = $this->repository->all();
        return view('procedimentos.exclusao.list.index',compact('registros'));
    }

    public function apagados()
    {
        $registros = $this->repository->apagados();
        return view('procedimentos.exclusao.list.apagados',compact('registros'));
    }

    public function create()
    {
        return view('procedimentos.exclusao.form.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'rg' => 'required',
            'processo' => 'required',
            'complemento' => 'required',
            'vara' => 'required',
            'numerounico' => 'required',
            'obs_txt' => 'required',
            ]);
       
        //dados do formulário
        $dados = $request->all(); 
        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->cleanCache();
            toast()->success('Exclusão Inserida');
            return redirect()->route('exclusao.lista');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
        
    }
    
    public function show($id)
    {
        $proc = $this->repository->findOrFail($id);
        return view('procedimentos.exclusao.form.show', compact('proc'));
    }

    public function edit($id)
    {
        $proc = $this->repository->findOrFail($id);
        return view('procedimentos.exclusao.form.edit', compact('proc'));

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'rg' => 'required',
            'processo' => 'required',
            'complemento' => 'required',
            'vara' => 'required',
            'numerounico' => 'required',
            'obs_txt' => 'required',
            ]);

        $dados = $request->all();
        $update = $this->repository->findAndUpdate( $id, $dados);
        
        if($update)
        {
            $this->repository->cleanCache();
            toast()->success('Exclusão atualizada!');
            return redirect()->route('exclusao.lista');
        }

        toast()->warning('Exclusão NÃO atualizada!');
        return redirect()->route('exclusao.lista');

    }

    public function destroy($id)
    {
        $destroy = $this->repository->findAndDelete($id);

        if($destroy) {
            $this->repository->cleanCache();
            toast()->success('Exclusão Apagado');
            return redirect()->route('exclusao.lista');
        }

        toast()->warning('erro ao apagar Exclusão');
        return redirect()->route('exclusao.lista');

    }

    public function restore($id)
    {
        $restore = $this->repository->findAndRestore($id);
    
        if($restore){
            $this->repository->cleanCache();
            toast()->success('Exclusão Recuperado!');
            return redirect()->route('exclusao.lista');  
        }

        toast()->warning('Houve um erro ao recuperar!');
        return redirect()->route('exclusao.lista'); 
    }

    public function forceDelete($id)
    {
        $forceDelete = $this->repository->findAndDestroy($id);
    
        if($forceDelete){
            $this->repository->cleanCache();
            toast()->success('Exclusão apagado DEFINITIVO!');
            return redirect()->route('exclusao.lista');  
        }

        toast()->warning('Houve um erro ao Apagar definitivo!');
        return redirect()->route('exclusao.lista');
    }
}
