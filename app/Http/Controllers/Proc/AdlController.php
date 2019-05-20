<?php

namespace App\Http\Controllers\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Repositories\AdlRepository;
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

    public function lista(AdlRepository $repository)
    {
        $registros = $repository->all();
        return view('procedimentos.adl.list.index',compact('registros'));
    }

    public function andamento(AdlRepository $repository)
    {
        $registros = $repository->andamento();
        return view('procedimentos.adl.list.andamento',compact('registros'));
    }

    public function prazos(AdlRepository $repository)
    {
       
        $registros = $repository->prazos();
        return view('procedimentos.adl.list.prazos',compact('registros'));
    }

    public function rel_situacao(AdlRepository $repository)
    {
        $registros = $repository->all();
        return view('procedimentos.adl.list.rel_situacao',compact('registros'));
    }

    public function julgamento(AdlRepository $repository)
    {
        $registros = $repository->julgamento();
        return view('procedimentos.adl.list.julgamento',compact('registros'));
    }

    public function apagados(AdlRepository $repository)
    {
        $registros = $repository->apagados();
        return view('procedimentos.adl.list.apagados',compact('registros'));
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

        $create = Adl::create($dados);

        if($create)
        {
            //limpa os caches
            $clean = AdlRepository::cleanCache();
            toast()->success('N° '.$ref.'/'.'adl Inserido');
            return redirect()->route('adl.lista');
        }

        toast()->error('Houve um erro na inserção');
        return redirect()->back();
        
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

        return view('procedimentos.adl.form.edit', compact('proc'));

        //return view('procedimentos.adl.form.edit', compact('proc','presidente','escrivao','defensor'));
    }


    public function update(Request $request, $id)
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
                'sintese_txt' => 'required'
            ]);
        }

        // dd(\Request::all());
        $dados = $request->all();
        //busca procedimento e atualiza
        $update = Adl::findOrFail($id)->update($dados);
        if(!$update)
        {
            toast()->error('adl NÃO atualizado!');
            return redirect()->route('adl.lista');
        }
        toast()->success('adl atualizado!');
        return redirect()->route('adl.lista');

        
    }


    public function destroy($id)
    {
        //busca procedimento e apaga
        $proc = Adl::findOrFail($id)->delete();

        //limpa o cache inteiro
        $clean = AdlRepository::cleanCache();

        //mensagem
    	toast()->success('Adl Apagado');
        return redirect()->route('adl.lista');
    }

    public function restore($id)
    {
        // Recupera o post pelo ID
        $restore = Adl::findOrFail($id)->restore();
    
        if($restore)
        {
            //mensagem
            toast()->success('Adl Recuperado!');
            return redirect()->route('adl.lista');  
        }

        //mensagem
        toast()->error('Houve um erro ao recuperar!');
        return redirect()->route('adl.lista'); 
    }

    public function forceDelete($id)
    {
        // Recupera o post pelo ID
        $forceDelete = Adl::findOrFail($id)->forceDelete();
    
        if($forceDelete)
        {
            //mensagem
            toast()->success('Adl Recuperado!');
            return redirect()->route('adl.lista');  
        }

        //mensagem
        toast()->error('Houve um erro ao Apagar definitivo!');
        return redirect()->route('adl.lista');
    }

}
