<?php

namespace App\Http\Controllers\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Repositories\CdRepository;
use App\Models\Sjd\Proc\Cd;
use App\Models\Sjd\Busca\Envolvido;

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

    public function apagados(CdRepository $repository)
    {
        $registros = $repository->apagados();
        return view('procedimentos.cd.list.apagados',compact('registros'));
    }

    public function create()
    {
        return view('procedimentos.cd.form.create');
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

        $create = Cd::create($dados);

        if($create)
        {
            CdRepository::cleanCache();
            toast()->success('N° '.$dados['sjd_ref'].'/'.'CD Inserido');
            return redirect()->route('cd.lista');
        }

        toast()->error('Houve um erro na inserção');
        return redirect()->back();
        
    }
    
    public function show($ref, $ano)
    {
        //----levantar procedimento
        $proc = Cd::ref_ano($ref,$ano)->first();
        if(!$proc) abort('404');

        $this->canSee($proc);

        return view('procedimentos.cd.form.show', compact('proc'));
    }

    public function edit($ref, $ano)
    {
        //----levantar procedimento
        $proc = Cd::ref_ano($ref,$ano)->first();
        if(!$proc) abort('404');
        
        $this->canSee($proc);

        return view('procedimentos.cd.form.edit', compact('proc'));

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
        $update = Cd::findOrFail($id)->update($dados);
        
        if($update)
        {
            CdRepository::cleanCache();
            toast()->success('CD atualizado!');
            return redirect()->route('cd.lista');
        }

        toast()->error('CD NÃO atualizado!');
        return redirect()->route('cd.lista');

    }

    public function destroy($id)
    {
        //busca procedimento e apaga
        $destroy = Cd::findOrFail($id)->delete();

        if($destroy) {
            CdRepository::cleanCache();
            toast()->success('CD Apagado');
            return redirect()->route('cd.lista');
        }

        toast()->success('erro ao apagar CD');
        return redirect()->route('cd.lista');

    }

    public function restore($id)
    {
        // Recupera o post pelo ID
        $restore = Cd::findOrFail($id)->restore();
    
        if($restore){
            CdRepository::cleanCache();
            toast()->success('CD Recuperado!');
            return redirect()->route('cd.lista');  
        }

        toast()->error('Houve um erro ao recuperar!');
        return redirect()->route('cd.lista'); 
    }

    public function forceDelete($id)
    {
        // Recupera o post pelo ID
        $forceDelete = Cd::findOrFail($id)->forceDelete();
    
        if($forceDelete){
            CdRepository::cleanCache();
            toast()->success('CD Recuperado!');
            return redirect()->route('cd.lista');  
        }

        toast()->error('Houve um erro ao Apagar definitivo!');
        return redirect()->route('cd.lista');
    }

    public function datesToCreate($request) {
        //dados do formulário
        $dados = $request->all();
        $ano = (int) date('Y');

        $ref = Cd::where('sjd_ref_ano','=',$ano)->max('sjd_ref');
        //referência e ano
        $dados['sjd_ref'] = $ref+1;
        $dados['sjd_ref_ano'] = $ano;
        
        return $dados;
    }

    public function canSee($proc) {
        ver_unidade($proc);//teste para verificar se pode ver outras unidades, caso não possa aborta
        //----envolvido do procedimento
        $envolvido = Envolvido::acusado()->where('id_cd ','=',$proc->id_cd )->get();
        //teste para verificar se pode ver superior, caso não possa aborta
        ver_superior($envolvido, Auth::user());
    }

}
