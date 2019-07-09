<?php

namespace App\Http\Controllers\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Repositories\ApfdRepository;
use App\Models\Sjd\Proc\Apfd;
use App\Models\Sjd\Busca\Envolvido;
use App\Models\Sjd\Busca\Ofendido;
use App\Models\Sjd\Busca\Ligacao;
use App\Models\Sjd\Proc\Movimento;
use App\Models\Sjd\Proc\Sobrestamento;
use App\Models\Sjd\Arquivo\ArquivosApagado;

use Illuminate\Support\Facades\DB;
use Cache;
use App\Repositories\OPM;

class ApfdController extends Controller
{
    public function index()
    {
        return redirect()->route('apfd.lista');
    }

    public function lista(ApfdRepository $repository)
    {
        $registros = $repository->all();
        return view('procedimentos.apfd.list.index',compact('registros'));
    }

    public function rel_situacao(ApfdRepository $repository)
    {
        $registros = $repository->all();
        return view('procedimentos.apfd.list.rel_situacao',compact('registros'));
    }

    public function apagados(ApfdRepository $repository)
    {
        $registros = $repository->apagados();
        return view('procedimentos.apfd.list.apagados',compact('registros'));
    }

    public function create(Request $request)
    {
        $opms = OPM::get();
        return view('procedimentos.apfd.form.create', compact('opms'));
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

        //última referência de apfd inserida
        $ref = Apfd::where('sjd_ref_ano','=',$ano)->max('sjd_ref');
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
        Apfd::create($dados);

        toast()->success('N° '.$ref.'/'.'apfd Inserido');
        return redirect()->route('apfd.lista');
        
    }

    
    public function show($ref, $ano)
    {
        
        //----levantar procedimento
        $proc = Apfd::ref_ano($ref,$ano)->first();

        //teste para verificar se pode ver outras unidades, caso não possa aborta
        ver_unidade($proc);

        //----envolvido do procedimento
        $envolvido = Envolvido::acusado()->where('id_apfd','=',$proc->id_apfd)->get();

        //teste para verificar se pode ver superior, caso não possa aborta
        ver_superior($envolvido, Auth::user());

        return view('procedimentos.apfd.form.show', compact('proc'));
    }

    public function edit($ref, $ano)
    {
         //----levantar procedimento
         $proc = Apfd::ref_ano($ref,$ano)->first();

         //teste para verificar se pode ver outras unidades, caso não possa aborta
         ver_unidade($proc);
 
         //----envolvido do procedimento
         $envolvido = Envolvido::acusado()->where('id_apfd','=',$proc->id_apfd)->get();
 
         //teste para verificar se pode ver superior, caso não possa aborta
         ver_superior($envolvido, Auth::user());

        return view('procedimentos.apfd.form.edit', compact('proc'));
    }


    public function update(Request $request, $id)
    {
        //dd(\Request::all());
        $dados = $request->all();
        //busca procedimento e atualiza
    	Apfd::find($id)->update($dados);
        //mensagem
        toast()->success('apfd atualizado!');

        return redirect()->route('apfd.lista');
    }


    public function destroy($id)
    {
        //busca procedimento e apaga
        $proc = Apfd::findOrFail($id);
        $proc->delete();

        //mensagem
    	toast()->success('Apfd Apagado');
        return redirect()->route('apfd.lista');
    }

}
