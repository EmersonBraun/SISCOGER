<?php

namespace App\Http\Controllers\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\proc\Repositories\ApfdRepository;
use App\Models\Sjd\Proc\Apfd;

class ApfdController extends Controller
{
    public function index()
    {
        return redirect()->route('apfd.lista');
    }

    public function lista(ApfdRepository $repository)
    {
        $registros = $repository->all();
        return view('procedimentos.apfd.list.index',compact('registros'));
    }

    public function rel_situacao(ApfdRepository $repository)
    {
        $registros = $repository->all();
        return view('procedimentos.apfd.list.rel_situacao',compact('registros'));
    }

    public function apagados(ApfdRepository $repository)
    {
        $registros = $repository->apagados();
        return view('procedimentos.apfd.list.apagados',compact('registros'));
    }

    public function create()
    {
        return view('procedimentos.apfd.form.create');
    }

    public function store(Request $request)
    {
        //andamento (concluído) alguns campos ficam obrigatórios
        if(sistema('andamento',$request['id_andamento']) != 'CONCLUÍDO' ){
            $this->validate($request, [
                'tipo' => 'required',
                'id_andamento' => 'required',
                'sintese_txt' => 'required',
                ]);
        } else {
            $this->validate($request, [
                'tipo' => 'required',
                'id_andamento' => 'required',
                'sintese_txt' => 'required',
                ]);
        }
       
        //dados do formulário
        $dados = $this->datesToCreate($request); 

        $create = Apfd::create($dados);

        if($create)
        {
            ApfdRepository::cleanCache();
            toast()->success('N° '.$dados['sjd_ref'].'/'.'APFD Inserido');
            return redirect()->route('apfd.lista');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
        
    }
    
    public function show($ref, $ano)
    {
        //----levantar procedimento
        $proc = Apfd::ref_ano($ref,$ano)->first();
        if(!$proc) abort('404');

        $this->canSee($proc);

        return view('procedimentos.apfd.form.show', compact('proc'));
    }

    public function edit($ref, $ano)
    {
        //----levantar procedimento
        $proc = Apfd::ref_ano($ref,$ano)->first();
        if(!$proc) abort('404');
        
        $this->canSee($proc);

        return view('procedimentos.apfd.form.edit', compact('proc'));

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
        $update = Apfd::findOrFail($id)->update($dados);
        
        if($update)
        {
            ApfdRepository::cleanCache();
            toast()->success('APFD atualizado!');
            return redirect()->route('apfd.lista');
        }

        toast()->warning('APFD NÃO atualizado!');
        return redirect()->route('apfd.lista');

    }

    public function destroy($id)
    {
        //busca procedimento e apaga
        $destroy = Apfd::findOrFail($id)->delete();

        if($destroy) {
            ApfdRepository::cleanCache();
            toast()->success('APFD Apagado');
            return redirect()->route('apfd.lista');
        }

        toast()->warning('erro ao apagar APFD');
        return redirect()->route('apfd.lista');

    }

    public function restore($id)
    {
        // Recupera o post pelo ID
        $restore = Apfd::findOrFail($id)->restore();
    
        if($restore){
            ApfdRepository::cleanCache();
            toast()->success('APFD Recuperado!');
            return redirect()->route('apfd.lista');  
        }

        toast()->warning('Houve um erro ao recuperar!');
        return redirect()->route('apfd.lista'); 
    }

    public function forceDelete($id)
    {
        // Recupera o post pelo ID
        $forceDelete = Apfd::findOrFail($id)->forceDelete();
    
        if($forceDelete){
            ApfdRepository::cleanCache();
            toast()->success('APFD Recuperado!');
            return redirect()->route('apfd.lista');  
        }

        toast()->warning('Houve um erro ao Apagar definitivo!');
        return redirect()->route('apfd.lista');
    }

    public function datesToCreate($request) {
        //dados do formulário
        $dados = $request->all();
        $ano = (int) date('Y');

        $ref = Apfd::where('sjd_ref_ano','=',$ano)->max('sjd_ref');
        //referência e ano
        $dados['sjd_ref'] = $ref+1;
        $dados['sjd_ref_ano'] = $ano;
        
        return $dados;
    }

    public function canSee($proc) {
        ver_unidade($proc);//teste para verificar se pode ver outras unidades, caso não possa aborta
        //----envolvido do procedimento
        $envolvido = Envolvido::acusado()->where('id_apfd','=',$proc->id_apfd)->get();
        //teste para verificar se pode ver superior, caso não possa aborta
        ver_superior($envolvido, Auth::user());
    }

}
