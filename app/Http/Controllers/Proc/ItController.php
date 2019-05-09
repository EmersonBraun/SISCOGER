<?php

namespace App\Http\Controllers\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Repositories\ItRepository;
use App\Models\Sjd\Proc\It;
use App\Models\Sjd\Busca\Envolvido;
use App\Models\Sjd\Busca\Ofendido;
use App\Models\Sjd\Busca\Ligacao;
use App\Models\Sjd\Proc\Movimento;
use App\Models\Sjd\Proc\Sobrestamento;
use App\Models\Sjd\Arquivo\ArquivosApagado;

use Illuminate\Support\Facades\DB;
use Cache;

class ItController extends Controller
{
    public function index()
    {
        return redirect()->route('it.lista');
    }

    public function lista(ItRepository $repository)
    {
        $registros = $repository->all();
        return view('procedimentos.it.list.index',compact('registros'));
    }

    public function andamento(ItRepository $repository)
    {
        $registros = $repository->andamento();
        return view('procedimentos.it.list.andamento',compact('registros'));
    }

    public function prazos(ItRepository $repository)
    {
        $registros = $repository->prazos();
        return view('procedimentos.it.list.prazos',compact('registros'));
    }

    public function rel_valores(ItRepository $repository)
    {
        $registros = $repository->relValores();
        return view('procedimentos.it.list.rel_valores',compact('registros'));
    }

    public function julgamento(ItRepository $repository)
    {
        $registros = Proc::julgamento('it');
        return view('procedimentos.it.list.julgamento',compact('registros'));
    }

    public function create(Request $request)
    {
        return view('procedimentos.it.form.create');
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

        //última referência de it inserida
        $ref = It::where('sjd_ref_ano','=',$ano)->max('sjd_ref');
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
        It::create($dados);

        toast()->success('N° '.$ref.'/'.'it Inserido');
        return redirect()->route('it.lista');
        
    }

    
    public function show($ref, $ano)
    {
        
        //----levantar procedimento
        $proc = It::ref_ano($ref,$ano)->first();

        //teste para verificar se pode ver outras unidades, caso não possa aborta
        ver_unidade($proc);

        //----envolvido do procedimento
        $envolvido = Envolvido::acusado()->where('id_it','=',$proc->id_it)->get();

        return view('procedimentos.it.form.show', compact('proc'));
    }

    public function edit($ref, $ano)
    {
        
        //----levantar procedimento
        $proc = It::ref_ano($ref,$ano)->first();

        //teste para verificar se pode ver outras unidades, caso não possa aborta
        ver_unidade($proc);

        //----envolvido do procedimento
        $envolvido = Envolvido::acusado()->where('id_it','=',$proc->id_it)->get();

        return view('procedimentos.it.form.edit', compact('proc'));
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
            if ($request->hasFile($a)) $dados[$a] = arquivo($request,$a,'it',$id);

        }

        //busca procedimento e atualiza
    	It::find($id)->update($dados);
        //mensagem
        toast()->success('it atualizado!');

        return redirect()->route('it.lista');
    }


    public function destroy($id)
    {
        //busca procedimento e apaga
        It::find($id)->delete();

        //mensagem
    	toast()->success('IT Apagado');
        return redirect()->route('it.lista');
    }
}
