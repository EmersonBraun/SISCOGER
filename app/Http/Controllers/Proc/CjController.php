<?php

namespace App\Http\Controllers\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\proc\Repositories\CjRepository;
use App\Models\Sjd\Proc\Cj;
use App\Models\Sjd\Busca\Envolvido;

class CjController extends Controller
{
    public function index()
    {
        return redirect()->route('cj.lista');
    }

    public function lista(CjRepository $repository)
    {
        $registros = $repository->all();
        return view('procedimentos.cj.list.index',compact('registros'));
    }

    public function andamento(CjRepository $repository )
    {
        $registros = $repository->andamento();
        return view('procedimentos.cj.list.andamento',compact('registros'));
    }

    public function prazos(CjRepository $repository)
    {
        $registros = $repository->prazos();
        return view('procedimentos.cj.list.prazos',compact('registros'));
    }

    public function rel_situacao(CjRepository $repository)
    {
        $registros = $repository->all();
        return view('procedimentos.cj.list.rel_situacao',compact('registros'));
    }

    public function julgamento(CjRepository $repository)
    {
        $registros = $repository->julgamento();
        return view('procedimentos.cj.list.julgamento',compact('registros'));
    }

    public function apagados(CjRepository $repository)
    {
        $registros = $repository->apagados();
        return view('procedimentos.cj.list.apagados',compact('registros'));
    }

    public function create()
    {
        return view('procedimentos.cj.form.create');
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

        $create = Cj::create($dados);

        if($create)
        {
            CjRepository::cleanCache();
            toast()->success('N° '.$dados['sjd_ref'].'/'.'CJ Inserido');
            return redirect()->route('cj.lista');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
        
    }
    
    public function show($ref, $ano)
    {
        //----levantar procedimento
        $proc = Cj::ref_ano($ref,$ano)->first();
        if(!$proc) abort('404');

        $this->canSee($proc);

        return view('procedimentos.cj.form.show', compact('proc'));
    }

    public function edit($ref, $ano)
    {
        //----levantar procedimento
        $proc = Cj::ref_ano($ref,$ano)->first();
        if(!$proc) abort('404');
        
        $this->canSee($proc);

        return view('procedimentos.cj.form.edit', compact('proc'));

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
        $update = Cj::findOrFail($id)->update($dados);
        
        if($update)
        {
            CjRepository::cleanCache();
            toast()->success('CJ atualizado!');
            return redirect()->route('cj.lista');
        }

        toast()->warning('CJ NÃO atualizado!');
        return redirect()->route('cj.lista');

    }

    public function destroy($id)
    {
        //busca procedimento e apaga
        $destroy = Cj::findOrFail($id)->delete();

        if($destroy) {
            CjRepository::cleanCache();
            toast()->success('CJ Apagado');
            return redirect()->route('cj.lista');
        }

        toast()->warning('erro ao apagar CJ');
        return redirect()->route('cj.lista');

    }

    public function restore($id)
    {
        // Recupera o post pelo ID
        $restore = Cj::findOrFail($id)->restore();
    
        if($restore){
            CjRepository::cleanCache();
            toast()->success('CJ Recuperado!');
            return redirect()->route('cj.lista');  
        }

        toast()->warning('Houve um erro ao recuperar!');
        return redirect()->route('cj.lista'); 
    }

    public function forceDelete($id)
    {
        // Recupera o post pelo ID
        $forceDelete = Cj::findOrFail($id)->forceDelete();
    
        if($forceDelete){
            CjRepository::cleanCache();
            toast()->success('CJ Recuperado!');
            return redirect()->route('cj.lista');  
        }

        toast()->warning('Houve um erro ao Apagar definitivo!');
        return redirect()->route('cj.lista');
    }

    public function datesToCreate($request) {
        //dados do formulário
        $dados = $request->all();
        $ano = (int) date('Y');

        $ref = Cj::where('sjd_ref_ano','=',$ano)->max('sjd_ref');
        //referência e ano
        $dados['sjd_ref'] = $ref+1;
        $dados['sjd_ref_ano'] = $ano;
        
        return $dados;
    }

    public function canSee($proc) {
        ver_unidade($proc);//teste para verificar se pode ver outras unidades, caso não possa aborta
        //----envolvido do procedimento
        $envolvido = Envolvido::acusado()->where('id_cj ','=',$proc->id_cj )->get();
        //teste para verificar se pode ver superior, caso não possa aborta
        ver_superior($envolvido, Auth::user());
    }

}
