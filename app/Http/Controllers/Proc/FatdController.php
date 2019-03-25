<?php

namespace App\Http\Controllers\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Repositories\FatdRepository;
use App\Models\Sjd\Proc\Fatd;
use App\Models\Sjd\Busca\Envolvido;
use App\Models\Sjd\Busca\Ofendido;
use App\Models\Sjd\Busca\Ligacao;
use App\Models\Sjd\Proc\Movimento;
use App\Models\Sjd\Proc\Sobrestamento;
use App\Models\Sjd\Arquivo\ArquivosApagado;

use Illuminate\Support\Facades\DB;
use Cache;

class FatdController extends Controller
{
    public function index()
    {
        return redirect()->route('fatd.lista',['ano' => date('Y')]);
    }

    public function lista($ano, FatdRepository $repository)
    {
        $registros = $repository->ano($ano);
        return view('procedimentos.fatd.list.index',compact('registros','ano'));
    }

    public function andamento($ano, FatdRepository $repository)
    {
        $registros = $repository->andamentoAno($ano);
        return view('procedimentos.fatd.list.andamento',compact('registros','ano'));
    }

    public function prazos($ano, FatdRepository $repository)
    {
        $registros = $repository->prazosAno($ano);
        return view('procedimentos.fatd.list.prazos',compact('registros','ano'));
    }

    public function rel_situacao($ano, FatdRepository $repository)
    {
        $registros = $repository->ano($ano);
        return view('procedimentos.fatd.list.rel_situacao',compact('registros','ano'));
    }

    public function julgamento($ano, FatdRepository $repository)
    {
        $registros = $repository->julgamentoAno($ano);
        return view('procedimentos.fatd.list.julgamento',compact('registros','ano'));
    }

    public function create(Request $request)
    {
        include 'app/includes/opms.php';
        return view('procedimentos.fatd.form.create', compact('opms','selected','firstGroup'));
    }


    public function store(Request $request)
    {
        //dd(\Request::all());

        //andamento 2 (concluído) alguns campos ficam obrigatórios
        if($request['id_andamento'] != 2 ){
            $this->validate($request, [
                'id_andamento' => 'required',
                'situacao_fatd' => 'required',
                'sintese_txt' => 'required',
                ]);
        }
        else
        {
            $this->validate($request, [
                'situacao_fatd' => 'required',
                'abertura_data' => 'required',
                'sintese_txt' => 'required',
                'fato_data' => 'required',
                'fato_file' => 'required',
                'relatorio_file' => 'required',
                'sol_cmt_file' => 'required',
                ]);
        }
        //ano atual
        $ano = (int) date('Y');

        //última referência de fatd inserida
        $ref = Fatd::where('sjd_ref_ano','=',$ano)->max('sjd_ref');
        $ref = $ref+1;

        //dados do formulário
        $dados = $request->all();

        //referência e ano
        $dados['sjd_ref'] = $ref;
        $dados['sjd_ref_ano'] = $ano;
        
        //datas
        $datas = ['fato_data','portaria_data','abertura_data'];

        foreach ($datas as $d) 
        {
            $dados[$d] = ($dados[$d] != '0000-00-00') ? data_bd($dados[$d]) : '0000-00-00'; 
        }

        //preenchimento de dados vazios
        $vazios = ['doc_tipo','doc_numero','despacho_numero','portaria_data'];

        foreach ($vazios as $v) 
        {
            $dados[$v] = ($dados[$v] == NULL || $dados[$v] == '') ? '' : $dados[$v];
        }

        //cria o novo procedimento
        //Fatd::create($dados);
        //dd(session());
        $id = Fatd::ultimo_id();

        //ligação (documentos de origem)
        if ($dados['ligacao']) {
            $ligacao = $dados['ligacao'];
            foreach ($ligacao as $l) {
                $l['id_fatd'] = $id;
                $l['origem_proc'] = 'fatd';
                $l['origem_sjd_ref'] = $ref;
                $l['origem_sjd_ref_ano'] = $ano;
                $l['origem_opm'] = session('opm_descricao');
                Ligacao::create($l);
            }   
        }

        //envolvido
        if ($dados['envolvido']) {
            $envolvido = $dados['envolvido'];
            foreach ($envolvido as $e) {
                dd($e);
                // $e['id_fatd'] = $id;
                // $e['origem_proc'] = 'fatd';
                // $e['origem_sjd_ref'] = $ref;
                // $e['origem_sjd_ref_ano'] = $ano;
                // $e['origem_opm'] = session('opm_descricao');
                // Envolvido::create($l);
            } 
        }
        

        toast()->success('N° '.$ref.'/'.$ano,'FATD Inserido');
        return redirect()->route('fatd.lista',['ano' => date('Y')]);
        
    }

    
    public function show($ref, $ano)
    {
        
        //----levantar procedimento
        $proc = Fatd::where('sjd_ref','=',$ref)->where('sjd_ref_ano','=',$ano)->first();

        //teste para verificar se pode ver outras unidades, caso não possa aborta
        ver_unidade($proc);
        
        //----envolvido do procedimento
        $envolvido = Envolvido::acusado()->where('id_fatd','=',$proc->id_fatd)->first();

        //teste para verificar se pode ver superior, caso não possa aborta
        ver_superior($envolvido, Auth::user());

        //----ofendido no procedimento
        $ofendidos = Ofendido::ofendido('id_fatd',$proc->id_fatd)->first();

        //----ligação do procedimento
        $ligacao = Ligacao::ref_ano($proc->sjd_ref, $proc->sjd_ref_ano)->where('destino_proc','=','fatd')->first();
        
        //membros
        $encarregado = Envolvido::encarregado()->where('id_fatd','=',$proc->id_fatd)->first();
        $acusador = Envolvido::acusador()->where('id_fatd','=',$proc->id_fatd)->first();
        $defensor = Envolvido::defensor()->where('id_fatd','=',$proc->id_fatd)->first();

        //movimentos e sobrestamentos
        $movimentos = Movimento::where('id_fatd','=',$proc->id_fatd)->get();
        $sobrestamentos = Sobrestamento::where('id_fatd','=',$proc->id_fatd)->get();

        return view('procedimentos.fatd.form.show', compact('proc','envolvido','ofendido','ligacao','encarregado','acusador','defensor','movimentos','sobrestamentos'));
    }

    public function edit($ref, $ano)
    {
        
        //----levantar procedimento
        $proc = Fatd::ref_ano($ref, $ano)->first();

        //teste para verificar se pode ver outras unidades, caso não possa aborta
        ver_unidade($proc);

        //----envolvido do procedimento
        $envolvido = Envolvido::acusado()->where('id_fatd','=',$proc->id_fatd)->first();

        //teste para verificar se pode ver superior, caso não possa aborta
        ver_superior($envolvido, Auth::user());

        //----ofendido no procedimento
        $ofendido = Ofendido::ofendido('id_fatd',$proc->id_fatd)->first();

        //----ligação do procedimento
        $ligacao = Ligacao::ref_ano($proc->sjd_ref,$proc->sjd_ref_ano)->where('destino_proc','=','fatd')->first();
         
        $encarregado = Envolvido::encarregado()->where('id_fatd','=',$proc->id_fatd)->first();
        $acusador = Envolvido::acusador()->where('id_fatd','=',$proc->id_fatd)->first();
        $defensor = Envolvido::defensor()->where('id_fatd','=',$proc->id_fatd)->first();
        
        //-- arquivos apagados
        $arquivos_apagados = ArquivosApagado::proc_id('fatd',$proc->id_fatd)->get();

        return view('procedimentos.fatd.form.edit', compact('proc','envolvido','ofendido','ligacao','encarregado','acusador','defensor','movimentos','sobrestamentos','arquivos_apagados'));
    }


    public function update(Request $request, $id)
    {
        //dd(\Request::all());
        $dados = $request->all();

        //datas
        $datas = ['fato_data','portaria_data','abertura_data'];

        foreach ($datas as $d) 
        {
            $dados[$d] = ($dados[$d] != '0000-00-00') ? data_bd($dados[$d]) : '0000-00-00'; 
        }

        //arquivos
        $arquivos = ['fato_file','relatorio_file','sol_cmt_file','sol_cg_file','rec_ato_file','rec_ato_file','rec_cmt_file','rec_crpm_file','rec_cg_file','notapunicao_file'];

        foreach ($arquivos as $a) 
        {
            if ($request->hasFile($a)) $dados[$a] = arquivo($request,$a,'fatd',$id);

        }

        //busca procedimento e atualiza
    	Fatd::find($id)->update($dados);
        //mensagem
        toast()->success('FATD atualizado!');

        return redirect()->route('fatd.lista',['ano' => date('Y')]);
    }


    public function destroy($id)
    {
        //busca procedimento e apaga
        Fatd::find($id)->delete();

        //mensagem
    	toast()->success('N° '.$ref.'/'.$ano,'FATD Apagado');
        return redirect()->route('fatd.lista',['ano' => date('Y')]);
    }

    public function movimentos($ref, $ano)
    {
        //----levantar procedimento
        $proc = Fatd::ref_ano($ref, $ano)->first();
        //verifica se o usuário tem permissão para ver todas unidades s/n
        $verTodasUnidades = (User::permission('todas-unidades')->count() != NULL) ? 1 : 0;

        //verificar se a opm de login é diferente da unidade do procedimento
        $opm = ($proc->cdopm != session()->get('cdopmbase')) ? 1 : 0;

        /*não pode ver todas unidades e a unidade do procedimento diferente da opm do login
        *redireciona o erro de acesso não permitido */
        if ($verTodasUnidades == 0 && $opm == 1) return abort(403);

        $movimentos = Movimento::where('id_fatd','=',$proc->id_fatd)->get();
        $sobrestamentos = Sobrestamento::where('id_fatd','=',$proc->id_fatd)->get();

        return view('procedimentos.fatd.form.movimentos',compact('proc','movimentos','sobrestamentos'));
    }

    public function sobrestamentos($ref, $ano)
    {
        //----levantar procedimento
        $proc = Fatd::ref_ano($ref, $ano)->first();

        //verifica se o usuário tem permissão para ver todas unidades s/n
        $verTodasUnidades = (User::permission('todas-unidades')->count() != NULL) ? 1 : 0;

        //verificar se a opm de login é diferente da unidade do procedimento
        $opm = ($proc->cdopm != session()->get('cdopmbase')) ? 1 : 0;

        /*não pode ver todas unidades e a unidade do procedimento diferente da opm do login
        *redireciona o erro de acesso não permitido */
        if ($verTodasUnidades == 0 && $opm == 1) return abort(403);

        $movimentos = Movimento::where('id_fatd','=',$proc->id_fatd)->get();
        $sobrestamentos = Sobrestamento::where('id_fatd','=',$proc->id_fatd)->get();
        
        return view('procedimentos.fatd.form.sobrestamentos',compact('proc','movimentos','sobrestamentos'));
    }

}
