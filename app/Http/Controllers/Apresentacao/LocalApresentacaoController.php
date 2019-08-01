<?php

namespace App\Http\Controllers\Apresentacao;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\apresentacao\LocalApresentacaoRepository;
use App\Model\Apresentacao\Apresentacao;

class LocalApresentacaoController extends Controller
{
    protected $repository;
    public function __construct(LinkRepository $repository)
	{
        $this->repository = $repository;
    }

    public function index()
    {
        $registros = $this->repository->all();
        return view('apresentacao.local.index', compact('registros'));
    }

    public function create()
    {
        return view('apresentacao.local.form.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'id_andamento' => 'required',
            'sintese_txt' => 'required',
        ]);

        //dados do formulário
        $dados = $this->datesToCreate($request); 

        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->cleanCache();
            toast()->success('N° '.$dados['sjd_ref'].'/'.'Local apresentacao Inserida');
            return redirect()->route('local.lista');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
    }

    public function show($id)
    {
        $proc = $this->repository->findOrFail($id)->first();
        if(!$proc) abort('404');

        return view('apresentacao.local.form.show', compact('proc'));
    }

    public function edit($id)
    {
        $proc = $this->repository->findOrFail($id)->first();
        if(!$proc) abort('404');
        
        return view('apresentacao.local.form.edit', compact('proc'));
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
            toast()->success('Local apresentacao atualizada!');
            return redirect()->route('local.lista');
        }

        toast()->warning('Local apresentacao NÃO atualizada!');
        return redirect()->route('local.lista');
    }

    public function destroy($id)
    {
        $destroy = $this->repository->findOrFail($id)->delete();

        if($destroy) {
            $this->repository->cleanCache();
            toast()->success('Local apresentacao Apagada');
            return redirect()->route('local.lista');
        }

        toast()->warning('erro ao apagar Apresentacao');
        return redirect()->route('local.lista');
    }
}
