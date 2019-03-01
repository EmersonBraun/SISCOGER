<?php

namespace App\Http\Controllers\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Repositories\Proc;
use App\Models\Sjd\Proc\Adl;
use App\Models\Sjd\Busca\Envolvido;
use App\Models\Sjd\Busca\Ofendido;
use App\Models\Sjd\Busca\Ligacao;
use App\Models\Sjd\Proc\Movimento;
use App\Models\Sjd\Proc\Sobrestamento;
use App\Models\Sjd\Arquivo\ArquivosApagado;

use Illuminate\Support\Facades\DB;
use Cache;

class AdlController extends Controller
{
    public function index()
    {
        return redirect()->route('adl.lista');
    }

    public function lista()
    {
        $registros = Proc::lista('adl');

        return view('procedimentos.adl.list.index',compact('registros'));
    }

    public function andamento()
    {
        $registros = Proc::andamento('adl');
        return view('procedimentos.adl.list.andamento',compact('registros'));
    }

    public function prazos()
    {
        $registros = Proc::prazos('adl');
        return view('procedimentos.adl.list.prazos',compact('registros'));
    }

    public function rel_situacao()
    {
        $registros = Proc::lista('adl');
        return view('procedimentos.adl.list.rel_situacao',compact('registros'));
    }

    public function julgamento()
    {
        $registros = Proc::julgamento('adl');
        return view('procedimentos.adl.list.julgamento',compact('registros'));
    }

    public function create(Request $request)
    {
        return view('procedimentos.adl.form.create');
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

        //última referência de adl inserida
        $ref = Adl::where('sjd_ref_ano','=',$ano)->max('sjd_ref');
        $ref = $ref+1;

        //dados do formulário
        $dados = $request->all();

        //referência e ano
        $dados['sjd_ref'] = $ref;
        $dados['sjd_ref_ano'] = $ano;

        //preenchimento de dados vazios
        foreach (config('sistema2.vazios.adl') as $v) 
        {
            $dados[$v] = ($dados[$v] == NULL) ? '' : $dados[$v]; 
        }

        //datas
        foreach (config('sistema2.dates.adl') as $d) 
        {
            $dados[$d] = ($dados[$d] != '0000-00-00') ? data_bd($dados[$d]) : '0000-00-00'; 
        }
        //cria o novo procedimento
        Adl::create($dados);

        //id para subforms
        $dados['id_adl'] = Adl::ultimo_id();
        
        //ligação (documentos de origem) /helpers/subformulario
        ligacao($dados, 'adl');

        //envolvido
        envolvido($dados, 'adl');

        //ofendido
        ofendido($dados, 'adl');

        //limpa o cache inteiro
        Cache::flush();

        toast()->success('N° '.$ref.'/'.'adl Inserido');
        return redirect()->route('adl.lista');
        
    }

    
    public function show($ref, $ano)
    {
        
        //----levantar procedimento
        $proc = Adl::ref_ano($ref,$ano)->first();

        //teste para verificar se pode ver outras unidades, caso não possa aborta
        ver_unidade($proc);
        
        //----envolvido do procedimento
        $envolvido = Envolvido::acusado()->where('id_adl','=',$proc->id_adl)->first();
        
        //teste para verificar se pode ver superior, caso não possa aborta
        ver_superior($envolvido, Auth::user());

        //----ofendido no procedimento
        $ofendidos = Ofendido::ofendido('id_adl',$proc->id_adl)->first();

        //----ligação do procedimento
        $ligacao = Ligacao::ref_ano($proc->sjd_ref, $proc->sjd_ref_ano)->where('destino_proc','=','adl')->first();
        
        //membros
        $presidente = Envolvido::presidente()->where('id_adl','=',$proc->id_adl)->first();
        $escrivao = Envolvido::escrivao()->where('id_adl','=',$proc->id_adl)->first();
        $defensor = Envolvido::defensor()->where('id_adl','=',$proc->id_adl)->first();

        //movimentos e sobrestamentos
        $movimentos = Movimento::where('id_adl','=',$proc->id_adl)->get();
        $sobrestamentos = Sobrestamento::where('id_adl','=',$proc->id_adl)->get();

        return view('procedimentos.adl.form.show', compact('proc','envolvido','ofendido','ligacao','presidente','escrivao','defensor','movimentos','sobrestamentos'));
    }

    public function edit($ref, $ano)
    {
        //----levantar procedimento
        $proc = Adl::ref_ano($ref,$ano)->first();

        //teste para verificar se pode ver outras unidades, caso não possa aborta
        ver_unidade($proc);

        //----envolvido do procedimento
        $envolvido = Envolvido::acusado()->where('id_adl','=',$proc->id_adl)->get();

        //teste para verificar se pode ver superior, caso não possa aborta
        ver_superior($envolvido, Auth::user());

        //----ofendido no procedimento
        $ofendido = Ofendido::ofendido('id_adl',$proc->id_adl)->get();
        //----ligação do procedimento
        $ligacao = Ligacao::ref_ano($proc->sjd_ref,$proc->sjd_ref_ano)->where('destino_proc','=','adl')->get();
         
        $presidente = Envolvido::presidente()->where('id_adl','=',$proc->id_adl)->first();
        $escrivao = Envolvido::escrivao()->where('id_adl','=',$proc->id_adl)->first();
        $defensor = Envolvido::defensor()->where('id_adl','=',$proc->id_adl)->first();
        
        //-- arquivos apagados
        $arquivos_apagados = ArquivosApagado::proc_id('adl',$proc->id_adl)->get();
        //dd($proc);
        return view('procedimentos.adl.form.edit', compact('proc','envolvido','ofendido','ligacao','presidente','escrivao','defensor','movimentos','sobrestamentos','arquivos_apagados'));
    }


    public function update(Request $request, $id)
    {
        // dd(\Request::all());
        $dados = $request->all();

        //arquivos
        foreach (Adl::$files as $a) 
        {
            if ($request->hasFile($a)) $dados[$a] = arquivo($request,$a,'adl',$id);

        }

        //busca procedimento e atualiza
    	Adl::find($id)->update($dados);
        //mensagem
        toast()->success('adl atualizado!');

        return redirect()->route('adl.lista');
    }


    public function destroy($id)
    {
        //busca procedimento e apaga
        $proc = Adl::findOrFail($id);
        $proc->delete();

        //limpa o cache inteiro
        Cache::flush();

        //mensagem
    	toast()->success('Adl Apagado');
        return redirect()->route('adl.lista');
    }

    public function movimentos($ref, $ano)
    {
        //----levantar procedimento
        $proc = Adl::ref_ano($ref, $ano)->first();
        //teste para verificar se pode ver outras unidades, caso não possa aborta
        ver_unidade($proc);

        $movimentos = Movimento::where('id_adl','=',$proc->id_adl)->get();
        $sobrestamentos = Sobrestamento::where('id_adl','=',$proc->id_adl)->get();

        return view('procedimentos.adl.form.movimentos',compact('proc','movimentos','sobrestamentos'));
    }

    public function sobrestamentos($ref, $ano)
    {
        //----levantar procedimento
        $proc = Adl::ref_ano($ref, $ano)->first();

        //teste para verificar se pode ver outras unidades, caso não possa aborta
        ver_unidade($proc);

        $movimentos = Movimento::where('id_adl','=',$proc->id_adl)->get();
        $sobrestamentos = Sobrestamento::where('id_adl','=',$proc->id_adl)->get();
        
        return view('procedimentos.adl.form.sobrestamentos',compact('proc','movimentos','sobrestamentos'));
    }

}
