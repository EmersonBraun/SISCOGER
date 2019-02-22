<?php

namespace App\Http\Controllers\_Api\SJD\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Repositories\Proc;
use App\Models\Sjd\Proc\Iso;
use App\Models\Sjd\Busca\Envolvido;
use App\Models\Sjd\Busca\Ofendido;
use App\Models\Sjd\Busca\Ligacao;
use App\Models\Sjd\Proc\Movimento;
use App\Models\Sjd\Proc\Sobrestamento;
use App\Models\Sjd\Arquivo\ArquivosApagado;

use Illuminate\Support\Facades\DB;
use Cache;

class IsoApiController extends Controller
{
    public function index()
    {
        return redirect()->route('iso.lista');
    }

    public function lista()
    {
        $registros = Proc::lista('iso');
        return view('procedimentos.iso.list.index',compact('registros'));
    }

    public function andamento()
    {
        $registros = Proc::andamento('iso');
        return view('procedimentos.iso.list.andamento',compact('registros'));
    }

    public function prazos()
    {
        $registros = Proc::prazos('iso');
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
        include 'app/includes/testeVerUnidades.php';
        
        //----envolvido do procedimento
        $envolvido = Envolvido::acusado()->where('id_iso','=',$proc->id_iso)->first();

        //teste para verificar se pode ver superior, caso não possa aborta
        include 'app/includes/testeVerSuperior.php';

        //----ofendido no procedimento
        $ofendidos = Ofendido::ofendido('id_iso',$proc->id_iso)->first();

        //----ligação do procedimento
        $ligacao = Ligacao::ref_ano($proc->sjd_ref, $proc->sjd_ref_ano)->where('destino_proc','=','iso')->first();
        
        //membros
        $presidente = Envolvido::presidente()->where('id_iso','=',$proc->id_iso)->first();
        $escrivao = Envolvido::escrivao()->where('id_iso','=',$proc->id_iso)->first();
        $defensor = Envolvido::defensor()->where('id_iso','=',$proc->id_iso)->first();

        //movimentos e sobrestamentos
        $movimentos = Movimento::where('id_iso','=',$proc->id_iso)->get();
        $sobrestamentos = Sobrestamento::where('id_iso','=',$proc->id_iso)->get();

        return view('procedimentos.iso.form.show', compact('proc','envolvido','ofendido','ligacao','presidente','escrivao','defensor','movimentos','sobrestamentos'));
    }

    public function edit($ref, $ano)
    {
        
        //----levantar procedimento
        $proc = Iso::ref_ano($ref,$ano)->first();

        //teste para verificar se pode ver outras unidades, caso não possa aborta
        include 'app/includes/testeVerUnidades.php';

        //----envolvido do procedimento
        $envolvido = Envolvido::acusado()->where('id_iso','=',$proc->id_iso)->first();

        //teste para verificar se pode ver superior, caso não possa aborta
        include 'app/includes/testeVerSuperior.php';

        //----ofendido no procedimento
        $ofendido = Ofendido::ofendido('id_iso',$proc->id_iso)->first();

        //----ligação do procedimento
        $ligacao = Ligacao::ref_ano($proc->sjd_ref,$proc->sjd_ref_ano)->where('destino_proc','=','iso')->first();
         
        $presidente = Envolvido::presidente()->where('id_iso','=',$proc->id_iso)->first();
        $escrivao = Envolvido::escrivao()->where('id_iso','=',$proc->id_iso)->first();
        $defensor = Envolvido::defensor()->where('id_iso','=',$proc->id_iso)->first();
        
        //-- arquivos apagados
        $arquivos_apagados = ArquivosApagado::proc_id('iso',$proc->id_iso)->get();

        return view('procedimentos.iso.form.edit', compact('proc','envolvido','ofendido','ligacao','presidente','escrivao','defensor','movimentos','sobrestamentos','arquivos_apagados'));
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

    public function movimentos($ref, $ano)
    {
        //----levantar procedimento
        $proc = Iso::ref_ano($ref, $ano)->first();
        //teste para verificar se pode ver outras unidades, caso não possa aborta
        include 'app/includes/testeVerUnidades.php';

        $movimentos = Movimento::where('id_iso','=',$proc->id_iso)->get();
        $sobrestamentos = Sobrestamento::where('id_iso','=',$proc->id_iso)->get();

        return view('procedimentos.iso.form.movimentos',compact('proc','movimentos','sobrestamentos'));
    }

    public function sobrestamentos($ref, $ano)
    {
        //----levantar procedimento
        $proc = Iso::ref_ano($ref, $ano)->first();

        //teste para verificar se pode ver outras unidades, caso não possa aborta
        include 'app/includes/testeVerUnidades.php';

        $movimentos = Movimento::where('id_iso','=',$proc->id_iso)->get();
        $sobrestamentos = Sobrestamento::where('id_iso','=',$proc->id_iso)->get();
        
        return view('procedimentos.iso.form.sobrestamentos',compact('proc','movimentos','sobrestamentos'));
    }

}
