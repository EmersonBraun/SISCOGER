<?php

namespace App\Http\Controllers\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Repositories\SindicanciaRepository;
use App\Models\Sjd\Proc\Sindicancia;
use App\Models\Sjd\Busca\Envolvido;
use App\Models\Sjd\Busca\Ofendido;
use App\Models\Sjd\Busca\Ligacao;
use App\Models\Sjd\Proc\Movimento;
use App\Models\Sjd\Proc\Sobrestamento;
use App\Models\Sjd\Arquivo\ArquivosApagado;

use Illuminate\Support\Facades\DB;
use Cache;

class SindicanciaController extends Controller
{
    public function index()
    {
        return redirect()->route('sindicancia.lista',['ano' => date('Y')]);
    }

    public function lista($ano, SindicanciaRepository $repository)
    {
        $registros = $repository->ano($ano);
        return view('procedimentos.sindicancia.list.index',compact('registros','ano'));
    }

    public function andamento($ano, SindicanciaRepository $repository)
    {
        $registros = $repository->ano($ano);
        return view('procedimentos.sindicancia.list.andamento',compact('registros','ano'));
    }

    public function prazos($ano, SindicanciaRepository $repository)
    {
        $registros = $repository->prazosAno($ano);
        return view('procedimentos.sindicancia.list.prazos',compact('registros','ano'));
    }

    public function rel_situacao($ano, SindicanciaRepository $repository)
    {
        $registros = $repository->ano($ano);
        return view('procedimentos.sindicancia.list.rel_situacao',compact('registros','ano'));
    }

    public function resultado($ano, SindicanciaRepository $repository)
    {
        $registros = $repository->julgamentoAno($ano);

        return view('procedimentos.sindicancia.list.resultado',compact('registros','ano'));
    }

    public function apagados($ano, SindicanciaRepository $repository)
    {
        $registros = $repository->apagados();
        return view('procedimentos.sindicancia.list.apagados',compact('registros','ano'));
    }

    public function create(Request $request)
    {
        return view('procedimentos.sindicancia.form.create');
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

        //última referência de sindicancia inserida
        $ref = Sindicancia::where('sjd_ref_ano','=',$ano)->max('sjd_ref');
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
        Sindicancia::create($dados);

        toast()->success('N° '.$ref.'/'.'sindicancia Inserido');
        return redirect()->route('sindicancia.lista');
        
    }

    
    public function show($ref, $ano)
    {
        
        //----levantar procedimento
        $proc = Sindicancia::ref_ano($ref,$ano)->first();

        //teste para verificar se pode ver outras unidades, caso não possa aborta
        ver_unidade($proc);

        //----envolvido do procedimento
        $envolvido = Envolvido::acusado()->where('id_sindicancia','=',$proc->id_sindicancia)->get();

        return view('procedimentos.sindicancia.form.show', compact('proc'));
    }

    public function edit($ref, $ano)
    {
        
        //----levantar procedimento
        $proc = Sindicancia::ref_ano($ref,$ano)->first();

        //teste para verificar se pode ver outras unidades, caso não possa aborta
        ver_unidade($proc);

        //----envolvido do procedimento
        $envolvido = Envolvido::acusado()->where('id_sindicancia','=',$proc->id_sindicancia)->get();

        return view('procedimentos.sindicancia.form.edit', compact('proc'));
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
            if ($request->hasFile($a)) $dados[$a] = arquivo($request,$a,'sindicancia',$id);

        }

        //busca procedimento e atualiza
    	Sindicancia::find($id)->update($dados);
        //mensagem
        toast()->success('sindicancia atualizado!');

        return redirect()->route('sindicancia.lista');
    }


    public function destroy($id)
    {
        //busca procedimento e apaga
        Sindicancia::find($id)->delete();

        //mensagem
    	toast()->success('Sindicância Apagado');
        return redirect()->route('sindicancia.lista');
    }
}
