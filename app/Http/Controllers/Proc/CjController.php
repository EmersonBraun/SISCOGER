<?php

namespace App\Http\Controllers\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Repositories\CjRepository;
use App\Models\Sjd\Proc\Cj;
use App\Models\Sjd\Busca\Envolvido;
use App\Models\Sjd\Busca\Ofendido;
use App\Models\Sjd\Busca\Ligacao;
use App\Models\Sjd\Proc\Movimento;
use App\Models\Sjd\Proc\Sobrestamento;
use App\Models\Sjd\Arquivo\ArquivosApagado;

use Illuminate\Support\Facades\DB;
use Cache;

class CjController extends Controller
{
    public function index()
    {
        return redirect()->route('cj.lista');
    }

    public function lista(CjRepository $repository)
    {
        $registros = $repository->all();
        return view('procedimentos.cj.list.index',compact('registros'));
    }

    public function andamento(CjRepository $repository )
    {
        $registros = $repository->andamento();
        return view('procedimentos.cj.list.andamento',compact('registros'));
    }

    public function prazos(CjRepository $repository)
    {
        $registros = $repository->prazos();
        return view('procedimentos.cj.list.prazos',compact('registros'));
    }

    public function rel_situacao(CjRepository $repository)
    {
        $registros = $repository->all();
        return view('procedimentos.cj.list.rel_situacao',compact('registros'));
    }

    public function julgamento(CjRepository $repository)
    {
        $registros = $repository->julgamento();
        return view('procedimentos.cj.list.julgamento',compact('registros'));
    }

    public function create(Request $request)
    {
        return view('procedimentos.cj.form.create');
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

        //última referência de cj inserida
        $ref = Cj::where('sjd_ref_ano','=',$ano)->max('sjd_ref');
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
        Cj::create($dados);

        toast()->success('N° '.$ref.'/'.'cj Inserido');
        return redirect()->route('cj.lista');
        
    }

    
    public function show($ref, $ano)
    {
        
        //----levantar procedimento
        $proc = Cj::ref_ano($ref,$ano)->first();

        //teste para verificar se pode ver outras unidades, caso não possa aborta
        ver_unidade($proc);

        //----envolvido do procedimento
        $envolvido = Envolvido::acusado()->where('id_cj','=',$proc->id_cj)->get();

        return view('procedimentos.cj.form.show', compact('proc'));
    }

    public function edit($ref, $ano)
    {
        
        //----levantar procedimento
        $proc = Cj::ref_ano($ref,$ano)->first();

        //teste para verificar se pode ver outras unidades, caso não possa aborta
        ver_unidade($proc);

        //----envolvido do procedimento
        $envolvido = Envolvido::acusado()->where('id_cj','=',$proc->id_cj)->get();

        return view('procedimentos.cj.form.edit', compact('proc'));
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
            if ($request->hasFile($a)) $dados[$a] = arquivo($request,$a,'cj',$id);

        }

        //busca procedimento e atualiza
    	Cj::find($id)->update($dados);
        //mensagem
        toast()->success('cj atualizado!');

        return redirect()->route('cj.lista');
    }


    public function destroy($id)
    {
        //busca procedimento e apaga
        Cj::find($id)->delete();

        //mensagem
    	toast()->success('CJ Apagado');
        return redirect()->route('cj.lista');
    }

}
