<?php

namespace App\Http\Controllers\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Repositories\IpmRepository;
use App\Models\Sjd\Proc\Ipm;
use App\Models\Sjd\Busca\Envolvido;
use App\Models\Sjd\Busca\Ofendido;
use App\Models\Sjd\Busca\Ligacao;
use App\Models\Sjd\Proc\Movimento;
use App\Models\Sjd\Proc\Sobrestamento;
use App\Models\Sjd\Arquivo\ArquivosApagado;

use Illuminate\Support\Facades\DB;
use Cache;

class IpmController extends Controller
{
    public function index()
    {
        return redirect()->route('ipm.lista',['ano' => date('Y')]);
    }

    public function lista($ano, IpmRepository $repository)
    {
        $registros = $repository->ano($ano);
        return view('procedimentos.ipm.list.index',compact('registros','ano'));
    }

    public function andamento($ano, IpmRepository $repository)
    {
        $registros = $repository->andamentoAno($ano);
        return view('procedimentos.ipm.list.andamento',compact('registros','ano'));
    }

    public function prazos($ano, IpmRepository $repository)
    {
        $registros = $repository->prazosAno($ano);
        return view('procedimentos.ipm.list.prazos',compact('registros','ano'));
    }

    public function rel_situacao($ano, IpmRepository $repository)
    {
        $registros = $repository->ano($ano);
        return view('procedimentos.ipm.list.rel_situacao',compact('registros','ano'));
    }

    public function resultado($ano, IpmRepository $repository)
    {
        $registros = $repository->julgamentoAno($ano);
        return view('procedimentos.ipm.list.resultado',compact('registros','ano'));
    }

    public function apagados(IpmRepository $repository)
    {
        $registros = $repository->apagados();
        return view('procedimentos.ipm.list.apagados',compact('registros'));
    }

    public function create(Request $request)
    {
        return view('procedimentos.ipm.form.create');
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

        //última referência de ipm inserida
        $ref = Ipm::where('sjd_ref_ano','=',$ano)->max('sjd_ref');
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
        Ipm::create($dados);

        toast()->success('N° '.$ref.'/'.'ipm Inserido');
        return redirect()->route('ipm.lista');
        
    }

    
    public function show($ref, $ano)
    {
        
        //----levantar procedimento
        $proc = Ipm::ref_ano($ref,$ano)->first();

        //teste para verificar se pode ver outras unidades, caso não possa aborta
        ver_unidade($proc);

        //----envolvido do procedimento
        $envolvido = Envolvido::acusado()->where('id_ipm','=',$proc->id_ipm)->get();

        return view('procedimentos.ipm.form.show', compact('proc'));
    }

    public function edit($ref, $ano)
    {
        
        //----levantar procedimento
        $proc = Ipm::ref_ano($ref,$ano)->first();

        //teste para verificar se pode ver outras unidades, caso não possa aborta
        ver_unidade($proc);

        //----envolvido do procedimento
        $envolvido = Envolvido::acusado()->where('id_ipm','=',$proc->id_ipm)->get();

        return view('procedimentos.ipm.form.edit', compact('proc'));
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
            if ($request->hasFile($a)) $dados[$a] = arquivo($request,$a,'ipm',$id);

        }

        //busca procedimento e atualiza
    	Ipm::find($id)->update($dados);
        //mensagem
        toast()->success('ipm atualizado!');

        return redirect()->route('ipm.lista');
    }


    public function destroy($id)
    {
        //busca procedimento e apaga
        Ipm::find($id)->delete();

        //mensagem
    	toast()->success('IPM Apagado');
        return redirect()->route('ipm.lista');
    }
}
