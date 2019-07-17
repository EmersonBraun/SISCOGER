<?php

namespace App\Http\Controllers\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\proc\Repositories\ExclusaoRepository;
use App\Models\Sjd\Proc\Exclusaojudicial;
use App\Models\Sjd\Busca\Envolvido;

class ExclusaoController extends Controller
{
    public function index()
    {
        return redirect()->route('exclusao.lista');
    }

    public function lista(ExclusaoRepository $repository)
    {
        $registros = $repository->all();
        return view('procedimentos.exclusao.list.index',compact('registros'));
    }

    public function apagados(ExclusaoRepository $repository)
    {
        $registros = $repository->apagados();
        return view('procedimentos.exclusao.list.apagados',compact('registros'));
    }

    public function create()
    {
        return view('procedimentos.exclusao.form.create');
    }

    public function store(Request $request)
    {
        //andamento (concluído) alguns campos ficam obrigatórios
        if(sistema('andamento',$request['id_andamento']) != 'CONCLUÍDO' ){
            $this->validate($request, [
                'id_andamento' => 'required',
                'sintese_txt' => 'required',
                ]);
        } else {
            $this->validate($request, [
                'id_andamento' => 'required',
                'sintese_txt' => 'required',
                ]);
        }
       
        //dados do formulário
        $dados = $this->datesToCreate($request); 

        $create = Exclusaojudicial::create($dados);

        if($create)
        {
            ExclusaoRepository::cleanCache();
            toast()->success('N° '.$dados['sjd_ref'].'/'.'Exclusão Inserido');
            return redirect()->route('exclusao.lista');
        }

        toast()->error('Houve um erro na inserção');
        return redirect()->back();
        
    }
    
    public function show($ref, $ano)
    {
        //----levantar procedimento
        $proc = Exclusaojudicial::ref_ano($ref,$ano)->first();
        if(!$proc) abort('404');

        $this->canSee($proc);

        return view('procedimentos.exclusao.form.show', compact('proc'));
    }

    public function edit($ref, $ano)
    {
        //----levantar procedimento
        $proc = Exclusaojudicial::ref_ano($ref,$ano)->first();
        if(!$proc) abort('404');
        
        $this->canSee($proc);

        return view('procedimentos.exclusao.form.edit', compact('proc'));

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
        $update = Exclusaojudicial::findOrFail($id)->update($dados);
        
        if($update)
        {
            ExclusaoRepository::cleanCache();
            toast()->success('Exclusão atualizado!');
            return redirect()->route('exclusao.lista');
        }

        toast()->error('Exclusão NÃO atualizado!');
        return redirect()->route('exclusao.lista');

    }

    public function destroy($id)
    {
        //busca procedimento e apaga
        $destroy = Exclusaojudicial::findOrFail($id)->delete();

        if($destroy) {
            ExclusaoRepository::cleanCache();
            toast()->success('Exclusão Apagado');
            return redirect()->route('exclusao.lista');
        }

        toast()->success('erro ao apagar Exclusão');
        return redirect()->route('exclusao.lista');

    }

    public function restore($id)
    {
        // Recupera o post pelo ID
        $restore = Exclusaojudicial::findOrFail($id)->restore();
    
        if($restore){
            ExclusaoRepository::cleanCache();
            toast()->success('Exclusão Recuperado!');
            return redirect()->route('exclusao.lista');  
        }

        toast()->error('Houve um erro ao recuperar!');
        return redirect()->route('exclusao.lista'); 
    }

    public function forceDelete($id)
    {
        // Recupera o post pelo ID
        $forceDelete = Exclusaojudicial::findOrFail($id)->forceDelete();
    
        if($forceDelete){
            ExclusaoRepository::cleanCache();
            toast()->success('Exclusão Recuperado!');
            return redirect()->route('exclusao.lista');  
        }

        toast()->error('Houve um erro ao Apagar definitivo!');
        return redirect()->route('exclusao.lista');
    }

    public function datesToCreate($request) {
        //dados do formulário
        $dados = $request->all();
        $ano = (int) date('Y');

        $ref = Exclusaojudicial::where('sjd_ref_ano','=',$ano)->max('sjd_ref');
        //referência e ano
        $dados['sjd_ref'] = $ref+1;
        $dados['sjd_ref_ano'] = $ano;
        
        return $dados;
    }

    public function canSee($proc) {
        ver_unidade($proc);//teste para verificar se pode ver outras unidades, caso não possa aborta
        //----envolvido do procedimento
        $envolvido = Envolvido::acusado()->where('id_exclusao','=',$proc->id_exclusao)->get();
        //teste para verificar se pode ver superior, caso não possa aborta
        ver_superior($envolvido, Auth::user());
    }
}
