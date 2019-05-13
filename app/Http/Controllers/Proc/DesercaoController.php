<?php

namespace App\Http\Controllers\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Repositories\DesercaoRepository;
use App\Models\Sjd\Proc\Desercao;
use App\Models\Sjd\Busca\Envolvido;
use App\Models\Sjd\Busca\Ofendido;
use App\Models\Sjd\Busca\Ligacao;
use App\Models\Sjd\Proc\Movimento;
use App\Models\Sjd\Proc\Sobrestamento;
use App\Models\Sjd\Arquivo\ArquivosApagado;

use Illuminate\Support\Facades\DB;
use Cache;

class DesercaoController extends Controller
{
    public function index()
    {
        return redirect()->route('desercao.lista');
    }

    public function lista(DesercaoRepository $repository)
    {
        $registros = $repository->all();
        return view('procedimentos.desercao.list.index',compact('registros'));
    }


    public function rel_situacao(DesercaoRepository $repository)
    {
        $registros = $repository->all();
        return view('procedimentos.desercao.list.rel_situacao',compact('registros'));
    }


    public function create(Request $request)
    {
        return view('procedimentos.desercao.form.create');
    }


    public function store(Request $request)
    {
        
        //andamento (concluído) alguns campos ficam obrigatórios
        if(sistema('andamento',$request['id_andamento']) != 'CONCLUÍDO' )
        {
            $this->validate($request, [
                'id_andamento' => 'required',
                'sintese_txt' => 'required',
                ]);
        }
        else
        {
            $this->validate($request, [
                'sintese_txt' => 'required',
                'libelo_file' => 'required',
                'parecer_file' => 'required',
                ]);
        }
        //ano atual
        $ano = (int) date('Y');

        //última referência de desercao inserida
        $ref = Desercao::where('sjd_ref_ano','=',$ano)->max('sjd_ref');
        $ref = $ref+1;

        //dados do formulário
        $dados = $request->all();

        //referência e ano
        $dados['sjd_ref'] = $ref;
        $dados['sjd_ref_ano'] = $ano;

        //preenchimento de dados vazios
        $vazios = ['id_andamentocoger','outromotivo','portaria_numero','doc_tipo','doc_numero'];

        foreach ($vazios as $v) 
        {
            $dados[$v] = ($dados[$v] == NULL) ? '' : $dados[$v]; 
        }

        //cria o novo procedimento
        Desercao::create($dados);

        toast()->success('N° '.$ref.'/'.'desercao Inserido');
        return redirect()->route('desercao.lista');
        
    }

    
    public function show($ref, $ano)
    {
        
        //----levantar procedimento
        $proc = Desercao::ref_ano($ref,$ano)->first();

        //teste para verificar se pode ver outras unidades, caso não possa aborta
        ver_unidade($proc);

        //----envolvido do procedimento
        $envolvido = Envolvido::acusado()->where('id_desercao','=',$proc->id_desercao)->get();

        return view('procedimentos.desercao.form.show', compact('proc'));
    }

    public function edit($ref, $ano)
    {
        
        //----levantar procedimento
        $proc = Desercao::ref_ano($ref,$ano)->first();

        //teste para verificar se pode ver outras unidades, caso não possa aborta
        ver_unidade($proc);

        //----envolvido do procedimento
        $envolvido = Envolvido::acusado()->where('id_desercao','=',$proc->id_desercao)->get();

        return view('procedimentos.desercao.form.edit', compact('proc'));
    }


    public function update(Request $request, $id)
    {
        //dd(\Request::all());
        $dados = $request->all();
        //busca procedimento e atualiza
    	Desercao::find($id)->update($dados);
        //mensagem
        toast()->success('desercao atualizado!');

        return redirect()->route('desercao.lista');
    }


    public function destroy($id)
    {
        //busca procedimento e apaga
        Desercao::find($id)->delete();

        //mensagem
    	toast()->success('Deserção Apagado');
        return redirect()->route('desercao.lista');
    }

}
