<?php

namespace App\Http\Controllers\Apresentacao;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\apresentacao\ApresentacaoRepository;
use App\Model\Apresentacao\Apresentacao;

class ApresentacaoController extends Controller
{
    public function index(ApresentacaoRepository $repository, $ano=date('Y'))
    {
        $registros = $repository->ano($ano);
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

        $create = Apresentacao::create($dados);

        if($create)
        {
            ApresentacaoRepository::cleanCache();
            toast()->success('N° '.$dados['sjd_ref'].'/'.'Apresentacao Inserida');
            return redirect()->route('apresentacao.lista');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
    }

    public function show($ref,$ano)
    {
        $proc = Apresentacao::ref_ano($ref,$ano)->first();
        if(!$proc) abort('404');

        return view('apresentacao.apresentacao.form.show', compact('proc'));
    }

    public function edit($ref,$ano)
    {
        $proc = Apresentacao::ref_ano($ref,$ano)->first();
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
        $update = Apresentacao::findOrFail($id)->update($dados);
        
        if($update)
        {
            ApresentacaoRepository::cleanCache();
            toast()->success('Apresentacao atualizada!');
            return redirect()->route('apresentacao.lista');
        }

        toast()->warning('Apresentacao NÃO atualizada!');
        return redirect()->route('apresentacao.lista');
    }

    public function destroy($id)
    {
        $destroy = Apresentacao::findOrFail($id)->delete();

        if($destroy) {
            ApresentacaoRepository::cleanCache();
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

        $ref = Apresentacao::where('sjd_ref_ano','=',$ano)->max('sjd_ref');
        //referência e ano
        $dados['sjd_ref'] = $ref+1;
        $dados['sjd_ref_ano'] = $ano;
        
        return $dados;
    }
}
