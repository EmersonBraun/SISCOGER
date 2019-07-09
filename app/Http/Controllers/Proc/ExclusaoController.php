<?php

namespace App\Http\Controllers\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Repositories\ExclusaoRepository;
use App\Models\Sjd\Proc\Exclusaojudicial;
use App\Models\Sjd\Busca\Envolvido;
use App\Models\Sjd\Busca\Ofendido;
use App\Models\Sjd\Busca\Ligacao;
use App\Models\Sjd\Proc\Movimento;
use App\Models\Sjd\Proc\Sobrestamento;
use App\Models\Sjd\Arquivo\ArquivosApagado;

use Illuminate\Support\Facades\DB;
use Cache;

class ExclusaoController extends Controller
{
    public function index()
    {
        return redirect()->route('exclusao.lista');
    }

    public function lista(ExclusaoRepository $repository)
    {
        $registros = $repository->all();
        return view('procedimentos.exclusao.list.index',compact('registros'));
    }

    public function apagados(ExclusaoRepository $repository)
    {
        $registros = $repository->apagados();
        return view('procedimentos.exclusao.list.apagados',compact('registros'));
    }

    public function create(Request $request)
    {
        return view('procedimentos.exclusao.form.create');
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

        //última referência de exclusao inserida
        $ref = Exclusaojudicial::where('sjd_ref_ano','=',$ano)->max('sjd_ref');
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

        //datas
        $datas = ['abertura_data','fato_data','portaria_data','prescricao_data'];

        foreach ($datas as $d) 
        {
            $dados[$d] = ($dados[$d] != '0000-00-00') ? data_bd($dados[$d]) : '0000-00-00'; 
        }

        //cria o novo procedimento
        Exclusaojudicial::create($dados);

        toast()->success('N° '.$ref.'/'.'exclusao Inserido');
        return redirect()->route('exclusao.lista');
        
    }

    
    public function show($id)
    {
        
        //----levantar procedimento
        $proc = Exclusaojudicial::find($id)->first();

        //teste para verificar se pode ver outras unidades, caso não possa aborta
        ver_unidade($proc);

        //----envolvido do procedimento
        //$envolvido = Envolvido::acusado()->where('id_exclusaojudicial','=',$proc->id_exclusaojudicial)->get();

        return view('procedimentos.exclusao.form.show', compact('proc'));
    }

    public function edit($id)
    {
        
        //----levantar procedimento
        $proc = Exclusaojudicial::find($id)->first();
        //teste para verificar se pode ver outras unidades, caso não possa aborta
        ver_unidade($proc);

        //----envolvido do procedimento
        //$envolvido = Envolvido::acusado()->where('id_exclusaojudicial','=',$proc->id_exclusaojudicial)->get();

        return view('procedimentos.exclusao.form.edit', compact('proc'));
    }


    public function update(Request $request, $id)
    {
        //dd(\Request::all());
        $dados = $request->all();

        //datas
        $datas = ['fato_data','portaria_data','prescricao_data'];

        foreach ($datas as $d) 
        {
            $dados[$d] = ($dados[$d] != '0000-00-00') ? data_bd($dados[$d]) : '0000-00-00'; 
        }

        //arquivos
        $arquivos = ['libelo_file','parecer_file','decisao_file','tjpr_file','stj_file'];

        foreach ($arquivos as $a) 
        {
            if ($request->hasFile($a)) $dados[$a] = arquivo($request,$a,'exclusao',$id);

        }

        //busca procedimento e atualiza
    	Exclusaojudicial::find($id)->update($dados);
        //mensagem
        toast()->success('exclusao atualizado!');

        return redirect()->route('exclusao.lista');
    }


    public function destroy($id)
    {
        //busca procedimento e apaga
        Exclusaojudicial::find($id)->delete();

        //mensagem
    	toast()->success('Exclusão Apagado');
        return redirect()->route('exclusao.lista');
    }
}
