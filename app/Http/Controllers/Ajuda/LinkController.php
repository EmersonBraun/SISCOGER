<?php

namespace App\Http\Controllers\Ajuda;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ajuda\LinkRepository;

class LinkController extends Controller
{
    protected $repository;
    public function __construct(LinkRepository $repository)
	{
        $this->repository = $repository;
    }

    public function index()
    {
        $registros = $this->repository->all();
        return view('ajuda.link.index', compact('registros','ano'));
    }

    public function create()
    {
        return view('ajuda.link.form.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'id_andamento' => 'required',
            'sintese_txt' => 'required',
        ]);

        //dados do formulário
        $dados = $request->all(); 
        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->cleanCache();
            toast()->success('N° '.$dados['sjd_ref'].'/'.'Nota COGER Inserido');
            return redirect()->route('link.lista');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
    }

    public function show($id)
    {
        $proc = $this->repository->findOrFail($id)->first();
        if(!$proc) abort('404');

        return view('ajuda.link.form.show', compact('proc'));
    }

    public function edit($id)
    {
        $proc = $this->repository->findOrFail($id)->first();
        if(!$proc) abort('404');
        
        return view('ajuda.link.form.edit', compact('proc'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'id_andamento' => 'required',
            'sintese_txt' => 'required',
        ]);

        $dados = $request->all();
        //busca procedimento e atualiza
        $update = $this->repository->findOrFail($id)->update($dados);
        
        if($update)
        {
            $this->repository->cleanCache();
            toast()->success('Nota COGER atualizada!');
            return redirect()->route('link.lista');
        }

        toast()->warning('Nota COGER NÃO atualizada!');
        return redirect()->route('link.lista');
    }

    public function destroy($id)
    {
        $destroy = $this->repository->findOrFail($id)->delete();

        if($destroy) {
            $this->repository->cleanCache();
            toast()->success('Nota COGER Apagada');
            return redirect()->route('link.lista');
        }

        toast()->warning('erro ao apagar Nota COGER');
        return redirect()->route('link.lista');
    }

}
