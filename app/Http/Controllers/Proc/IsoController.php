<?php

namespace App\Http\Controllers\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Repositories\IsoRepository;
use App\Models\Sjd\Proc\Iso;
use App\Models\Sjd\Busca\Envolvido;
use App\Models\Sjd\Busca\Ofendido;
use App\Models\Sjd\Busca\Ligacao;
use App\Models\Sjd\Proc\Movimento;
use App\Models\Sjd\Proc\Sobrestamento;
use App\Models\Sjd\Arquivo\ArquivosApagado;

use Illuminate\Support\Facades\DB;
use Cache;

class IsoController extends Controller
{
    public function index()
    {
        return redirect()->route('iso.lista');
    }

    public function lista(IsoRepository $repository)
    {
        $registros = $repository->all();
        return view('procedimentos.iso.list.index',compact('registros'));
    }

    public function andamento(IsoRepository $repository)
    {
        $registros = $repository->andamento();
        return view('procedimentos.iso.list.andamento',compact('registros'));
    }

    public function prazos(IsoRepository $repository)
    {
        $registros = $repository->prazos();
        return view('procedimentos.iso.list.prazos',compact('registros'));
    }


    public function create(Request $request)
    {
        return view('procedimentos.iso.form.create');
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

        //última referência de iso inserida
        $ref = Iso::where('sjd_ref_ano','=',$ano)->max('sjd_ref');
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
        Iso::create($dados);

        toast()->success('N° '.$ref.'/'.'iso Inserido');
        return redirect()->route('iso.lista');
        
    }

    
    public function show($ref, $ano)
    {
        
        //----levantar procedimento
        $proc = Iso::ref_ano($ref,$ano)->first();

        //teste para verificar se pode ver outras unidades, caso não possa aborta
        ver_unidade($proc);

        //----envolvido do procedimento
        $envolvido = Envolvido::acusado()->where('id_iso','=',$proc->id_iso)->get();

        return view('procedimentos.iso.form.show', compact('proc'));
    }

    public function edit($ref, $ano)
    {
        
        //----levantar procedimento
        $proc = Iso::ref_ano($ref,$ano)->first();

        //teste para verificar se pode ver outras unidades, caso não possa aborta
        ver_unidade($proc);

        //----envolvido do procedimento
        $envolvido = Envolvido::acusado()->where('id_iso','=',$proc->id_iso)->get();

        return view('procedimentos.iso.form.edit', compact('proc'));
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
            if ($request->hasFile($a)) $dados[$a] = arquivo($request,$a,'iso',$id);

        }

        //busca procedimento e atualiza
    	Iso::find($id)->update($dados);
        //mensagem
        toast()->success('iso atualizado!');

        return redirect()->route('iso.lista');
    }


    public function destroy($id)
    {
        //busca procedimento e apaga
        Iso::find($id)->delete();

        //mensagem
    	toast()->success('ISO Apagado');
        return redirect()->route('iso.lista');
    }
}
