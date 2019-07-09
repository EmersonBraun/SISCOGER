<?php

namespace App\Http\Controllers\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Repositories\ProcOutroRepository;
use App\Models\Sjd\Proc\ProcOutro;
use App\Models\Sjd\Busca\Envolvido;
use App\Models\Sjd\Busca\Ofendido;
use App\Models\Sjd\Busca\Ligacao;
use App\Models\Sjd\Proc\Movimento;
use App\Models\Sjd\Proc\Sobrestamento;
use App\Models\Sjd\Arquivo\ArquivosApagado;

use Illuminate\Support\Facades\DB;
use Cache;

class ProcOutrosController extends Controller
{
    public function index()
    {
        return redirect()->route('procoutros.lista');
    }

    public function lista(ProcOutroRepository $repository)
    {
        $registros = $repository->all();
        return view('procedimentos.procoutros.list.index',compact('registros'));
    }

    public function andamento(ProcOutroRepository $repository)
    {
        $registros = $repository->all();
        return view('procedimentos.procoutros.list.andamento',compact('registros'));
    }

    public function prazos(ProcOutroRepository $repository)
    {
        $registros = $repository->prazos();
        return view('procedimentos.procoutros.list.prazos',compact('registros'));
    }

    public function rel_situacao(ProcOutroRepository $repository)
    {
        $registros = $repository->rel_situacao();
        return view('procedimentos.procoutros.list.prazos',compact('registros'));
    }

    public function julgamento(ProcOutroRepository $repository)
    {
        $registros = $repository->julgamento();
        return view('procedimentos.procoutros.list.prazos',compact('registros'));
    }


    public function create(Request $request)
    {
        return view('procedimentos.procoutros.form.create');
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

        //última referência de proc_outros inserida
        $ref = ProcOutro::where('sjd_ref_ano','=',$ano)->max('sjd_ref');
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
        ProcOutro::create($dados);

        toast()->success('N° '.$ref.'/'.'proc_outros Inserido');
        return redirect()->route('procoutros.lista');
        
    }

    
    public function show($ref, $ano)
    {
        
        //----levantar procedimento
        $proc = ProcOutro::ref_ano($ref,$ano)->first();

        //teste para verificar se pode ver outras unidades, caso não possa aborta
        ver_unidade($proc);

        //----envolvido do procedimento
        $envolvido = Envolvido::acusado()->where('id_proc_outros','=',$proc->id_proc_outros)->get();

        return view('procedimentos.procoutros.form.show', compact('proc'));
    }

    public function edit($ref, $ano)
    {
        
        //----levantar procedimento
        $proc = ProcOutro::ref_ano($ref,$ano)->first();

        //teste para verificar se pode ver outras unidades, caso não possa aborta
        ver_unidade($proc);

        //----envolvido do procedimento
        $envolvido = Envolvido::acusado()->where('id_proc_outros','=',$proc->id_proc_outros)->get();

        return view('procedimentos.procoutros.form.edit', compact('proc'));
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
            if ($request->hasFile($a)) $dados[$a] = arquivo($request,$a,'proc_outros',$id);

        }

        //busca procedimento e atualiza
    	ProcOutro::find($id)->update($dados);
        //mensagem
        toast()->success('proc_outros atualizado!');

        return redirect()->route('procoutros.lista');
    }


    public function destroy($id)
    {
        //busca procedimento e apaga
        ProcOutro::find($id)->delete();

        //mensagem
    	toast()->success('Proc. Outros Apagado');
        return redirect()->route('procoutros.lista');
    }
}
