<?php

namespace App\Http\Controllers\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\proc\Repositories\ItRepository;
use App\Models\Sjd\Proc\It;
use App\Models\Sjd\Busca\Envolvido;

class ItController extends Controller
{
    public function index()
    {
        return redirect()->route('it.lista',['ano' => date('Y')]);
    }

    public function lista($ano, ItRepository $repository)
    {
        $registros = $repository->ano($ano);
        return view('procedimentos.it.list.index',compact('registros','ano'));
    }

    public function andamento($ano, ItRepository $repository)
    {
        $registros = $repository->andamentoAno($ano);
        return view('procedimentos.it.list.andamento',compact('registros','ano'));
    }

    public function prazos($ano, ItRepository $repository)
    {
        $registros = $repository->prazosAno($ano);
        return view('procedimentos.it.list.prazos',compact('registros','ano'));
    }

    public function rel_valores($ano, ItRepository $repository)
    {
        $registros = $repository->relValoresAno($ano);
        return view('procedimentos.it.list.rel_valores',compact('registros','ano'));
    }

    public function julgamento($ano, ItRepository $repository)
    {
        $registros = $repository->julgamentoAno($ano);
        return view('procedimentos.it.list.julgamento',compact('registros','ano'));
    }

    public function apagados($ano, ItRepository $repository)
    {
        $registros = $repository->apagados();
        return view('procedimentos.it.list.apagados',compact('registros','ano'));
    }

    public function create()
    {
        return view('procedimentos.it.form.create');
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

        $create = It::create($dados);

        if($create)
        {
            ItRepository::cleanCache();
            toast()->success('N° '.$dados['sjd_ref'].'/'.'IT Inserido');
            return redirect()->route('it.lista');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
        
    }
    
    public function show($ref, $ano)
    {
        //----levantar procedimento
        $proc = It::ref_ano($ref,$ano)->first();
        if(!$proc) abort('404');

        $this->canSee($proc);

        return view('procedimentos.it.form.show', compact('proc'));
    }

    public function edit($ref, $ano)
    {
        //----levantar procedimento
        $proc = It::ref_ano($ref,$ano)->first();
        if(!$proc) abort('404');
        
        $this->canSee($proc);

        return view('procedimentos.it.form.edit', compact('proc'));

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
        $update = It::findOrFail($id)->update($dados);
        
        if($update)
        {
            ItRepository::cleanCache();
            toast()->success('IT atualizado!');
            return redirect()->route('it.lista');
        }

        toast()->warning('IT NÃO atualizado!');
        return redirect()->route('it.lista');

    }

    public function destroy($id)
    {
        //busca procedimento e apaga
        $destroy = It::findOrFail($id)->delete();

        if($destroy) {
            ItRepository::cleanCache();
            toast()->success('IT Apagado');
            return redirect()->route('it.lista');
        }

        toast()->warning('erro ao apagar IT');
        return redirect()->route('it.lista');

    }

    public function restore($id)
    {
        // Recupera o post pelo ID
        $restore = It::findOrFail($id)->restore();
    
        if($restore){
            ItRepository::cleanCache();
            toast()->success('IT Recuperado!');
            return redirect()->route('it.lista');  
        }

        toast()->warning('Houve um erro ao recuperar!');
        return redirect()->route('it.lista'); 
    }

    public function forceDelete($id)
    {
        // Recupera o post pelo ID
        $forceDelete = It::findOrFail($id)->forceDelete();
    
        if($forceDelete){
            ItRepository::cleanCache();
            toast()->success('IT Recuperado!');
            return redirect()->route('it.lista');  
        }

        toast()->warning('Houve um erro ao Apagar definitivo!');
        return redirect()->route('it.lista');
    }

    public function datesToCreate($request) {
        //dados do formulário
        $dados = $request->all();
        $ano = (int) date('Y');

        $ref = It::where('sjd_ref_ano','=',$ano)->max('sjd_ref');
        //referência e ano
        $dados['sjd_ref'] = $ref+1;
        $dados['sjd_ref_ano'] = $ano;
        
        return $dados;
    }

    public function canSee($proc) {
        ver_unidade($proc);//teste para verificar se pode ver outras unidades, caso não possa aborta
        //----envolvido do procedimento
        $envolvido = Envolvido::acusado()->where('id_it','=',$proc->id_it)->get();
        //teste para verificar se pode ver superior, caso não possa aborta
        ver_superior($envolvido, Auth::user());
    }

    public function documentacao()
    {
        return true;
    }
}
