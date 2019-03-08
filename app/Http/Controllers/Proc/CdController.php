<?php

namespace App\Http\Controllers\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Repositories\CdRepository;
use App\Models\Sjd\Proc\Cd;
use App\Models\Sjd\Busca\Envolvido;
use App\Models\Sjd\Busca\Ofendido;
use App\Models\Sjd\Busca\Ligacao;
use App\Models\Sjd\Proc\Movimento;
use App\Models\Sjd\Proc\Sobrestamento;
use App\Models\Sjd\Arquivo\ArquivosApagado;

use Illuminate\Support\Facades\DB;
use Cache;

class CdController extends Controller
{
    public function index()
    {
        return redirect()->route('cd.lista');
    }

    public function lista(CdRepository $repository)
    {
        $registros = $repository->all();
        return view('procedimentos.cd.list.index',compact('registros'));
    }

    public function andamento(CdRepository $repository )
    {
        $registros = $repository->andamento();
        return view('procedimentos.cd.list.andamento',compact('registros'));
    }

    public function prazos(CdRepository $repository)
    {
        $registros = $repository->prazos();
        return view('procedimentos.cd.list.prazos',compact('registros'));
    }

    public function rel_situacao(CdRepository $repository)
    {
        $registros = $repository->all();
        return view('procedimentos.cd.list.rel_situacao',compact('registros'));
    }

    public function julgamento(CdRepository $repository)
    {
        $registros = $repository->julgamento();
        return view('procedimentos.cd.list.julgamento',compact('registros'));
    }

    public function create(Request $request)
    {
        return view('procedimentos.cd.form.create');
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

        //última referência de cd inserida
        $ref = Cd::where('sjd_ref_ano','=',$ano)->max('sjd_ref');
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
        Cd::create($dados);

        toast()->success('N° '.$ref.'/'.'cd Inserido');
        return redirect()->route('cd.lista');
        
    }

    
    public function show($ref, $ano)
    {
        
        //----levantar procedimento
        $proc = Cd::ref_ano($ref,$ano)->first();

        //teste para verificar se pode ver outras unidades, caso não possa aborta
        include 'app/includes/testeVerUnidades.php';
        
        //----envolvido do procedimento
        $envolvido = Envolvido::acusado()->where('id_cd','=',$proc->id_cd)->first();

        //teste para verificar se pode ver superior, caso não possa aborta
        include 'app/includes/testeVerSuperior.php';

        //----ofendido no procedimento
        $ofendidos = Ofendido::ofendido('id_cd',$proc->id_cd)->first();

        //----ligação do procedimento
        $ligacao = Ligacao::ref_ano($proc->sjd_ref, $proc->sjd_ref_ano)->where('destino_proc','=','cd')->first();
        
        //membros
        $presidente = Envolvido::presidente()->where('id_cd','=',$proc->id_cd)->first();
        $escrivao = Envolvido::escrivao()->where('id_cd','=',$proc->id_cd)->first();
        $defensor = Envolvido::defensor()->where('id_cd','=',$proc->id_cd)->first();

        //movimentos e sobrestamentos
        $movimentos = Movimento::where('id_cd','=',$proc->id_cd)->get();
        $sobrestamentos = Sobrestamento::where('id_cd','=',$proc->id_cd)->get();

        return view('procedimentos.cd.form.show', compact('proc','envolvido','ofendido','ligacao','presidente','escrivao','defensor','movimentos','sobrestamentos'));
    }

    public function edit($ref, $ano)
    {
        
        //----levantar procedimento
        $proc = Cd::ref_ano($ref,$ano)->first();

        //teste para verificar se pode ver outras unidades, caso não possa aborta
        include 'app/includes/testeVerUnidades.php';

        //----envolvido do procedimento
        $envolvido = Envolvido::acusado()->where('id_cd','=',$proc->id_cd)->first();

        //teste para verificar se pode ver superior, caso não possa aborta
        include 'app/includes/testeVerSuperior.php';

        //----ofendido no procedimento
        $ofendido = Ofendido::ofendido('id_cd',$proc->id_cd)->first();

        //----ligação do procedimento
        $ligacao = Ligacao::ref_ano($proc->sjd_ref,$proc->sjd_ref_ano)->where('destino_proc','=','cd')->first();
         
        $presidente = Envolvido::presidente()->where('id_cd','=',$proc->id_cd)->first();
        $escrivao = Envolvido::escrivao()->where('id_cd','=',$proc->id_cd)->first();
        $defensor = Envolvido::defensor()->where('id_cd','=',$proc->id_cd)->first();
        
        //-- arquivos apagados
        $arquivos_apagados = ArquivosApagado::proc_id('cd',$proc->id_cd)->get();

        return view('procedimentos.cd.form.edit', compact('proc','envolvido','ofendido','ligacao','presidente','escrivao','defensor','movimentos','sobrestamentos','arquivos_apagados'));
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
            if ($request->hasFile($a)) $dados[$a] = arquivo($request,$a,'cd',$id);

        }

        //busca procedimento e atualiza
    	Cd::find($id)->update($dados);
        //mensagem
        toast()->success('cd atualizado!');

        return redirect()->route('cd.lista');
    }


    public function destroy($id)
    {
        //busca procedimento e apaga
        Cd::find($id)->delete();

        //mensagem
    	toast()->success('CD Apagado');
        return redirect()->route('cd.lista');
    }

    public function movimentos($ref, $ano)
    {
        //----levantar procedimento
        $proc = Cd::ref_ano($ref, $ano)->first();
        //teste para verificar se pode ver outras unidades, caso não possa aborta
        include 'app/includes/testeVerUnidades.php';

        $movimentos = Movimento::where('id_cd','=',$proc->id_cd)->get();
        $sobrestamentos = Sobrestamento::where('id_cd','=',$proc->id_cd)->get();

        return view('procedimentos.cd.form.movimentos',compact('proc','movimentos','sobrestamentos'));
    }

    public function sobrestamentos($ref, $ano)
    {
        //----levantar procedimento
        $proc = Cd::ref_ano($ref, $ano)->first();

        //teste para verificar se pode ver outras unidades, caso não possa aborta
        include 'app/includes/testeVerUnidades.php';

        $movimentos = Movimento::where('id_cd','=',$proc->id_cd)->get();
        $sobrestamentos = Sobrestamento::where('id_cd','=',$proc->id_cd)->get();
        
        return view('procedimentos.cd.form.sobrestamentos',compact('proc','movimentos','sobrestamentos'));
    }

}
