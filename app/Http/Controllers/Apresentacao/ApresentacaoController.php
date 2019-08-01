<?php

namespace App\Http\Controllers\Apresentacao;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\apresentacao\ApresentacaoRepository;

class ApresentacaoController extends Controller
{
    protected $repository;
    public function __construct(ApresentacaoRepository $repository)
	{
        $this->repository = $repository;
    }

    public function index($ano="")
    {
        if(!$ano) $ano = (int) date('Y');
        $registros = $this->repository->ano($ano);
        return view('apresentacao.apresentacao.index', compact('registros','ano'));
    }


    public function create()
    {
        return view('apresentacao.apresentacao.form.create');
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
            toast()->success('N° '.$dados['sjd_ref'].'/'.'Apresentacao Inserida');
            return redirect()->route('apresentacao.lista');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
    }

    public function show($ref,$ano)
    {
        $proc = $this->repository->ref_ano($ref,$ano)->first();
        if(!$proc) abort('404');

        return view('apresentacao.apresentacao.form.show', compact('proc'));
    }

    public function edit($ref,$ano)
    {
        $proc = $this->repository->ref_ano($ref,$ano)->first();
        if(!$proc) abort('404');
        
        return view('apresentacao.apresentacao.form.edit', compact('proc'));
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
            toast()->success('Apresentacao atualizada!');
            return redirect()->route('apresentacao.lista');
        }

        toast()->warning('Apresentacao NÃO atualizada!');
        return redirect()->route('apresentacao.lista');
    }

    public function destroy($id)
    {
        $destroy = $this->repository->findOrFail($id)->delete();

        if($destroy) {
            $this->repository->cleanCache();
            toast()->success('Apresentacao Apagada');
            return redirect()->route('apresentacao.lista');
        }

        toast()->warning('erro ao apagar Apresentacao');
        return redirect()->route('apresentacao.lista');
    }

    public function datesToCreate($request) {
        //dados do formulário
        $dados = $request->all();
        $ano = (int) date('Y');

        $ref = $this->repository->maxRef();
        //referência e ano
        $dados['sjd_ref'] = $ref+1;
        $dados['sjd_ref_ano'] = $ano;
        
        return $dados;
    }
}
