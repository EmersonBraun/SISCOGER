<?php

namespace App\Http\Controllers\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\Repositories\AdlRepository;
use App\Models\Sjd\Proc\Adl;
use App\Models\Sjd\Busca\Envolvido;

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

    public function create()
    {
        return view('procedimentos.adl.form.create');
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

        $create = Adl::create($dados);

        if($create)
        {
            AdlRepository::cleanCache();
            toast()->success('N° '.$dados['sjd_ref'].'/'.'adl Inserido');
            return redirect()->route('adl.lista');
        }

        toast()->error('Houve um erro na inserção');
        return redirect()->back();
        
    }
    
    public function show($ref, $ano)
    {
        //----levantar procedimento
        $proc = Adl::ref_ano($ref,$ano)->first();
        if(!$proc) abort('404');

        $this->canSee($proc);

        return view('procedimentos.adl.form.show', compact('proc'));
    }

    public function edit($ref, $ano)
    {
        //----levantar procedimento
        $proc = Adl::ref_ano($ref,$ano)->first();
        if(!$proc) abort('404');
        
        $this->canSee($proc);

        return view('procedimentos.adl.form.edit', compact('proc'));

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
        
        if($update)
        {
            AdlRepository::cleanCache();
            toast()->success('adl atualizado!');
            return redirect()->route('adl.lista');
        }

        toast()->error('adl NÃO atualizado!');
        return redirect()->route('adl.lista');

    }

    public function destroy($id)
    {
        //busca procedimento e apaga
        $destroy = Adl::findOrFail($id)->delete();

        if($destroy) {
            AdlRepository::cleanCache();
            toast()->success('Adl Apagado');
            return redirect()->route('adl.lista');
        }

        toast()->success('erro ao apagar ADL');
        return redirect()->route('adl.lista');

    }

    public function restore($id)
    {
        // Recupera o post pelo ID
        $restore = Adl::findOrFail($id)->restore();
    
        if($restore){
            AdlRepository::cleanCache();
            toast()->success('Adl Recuperado!');
            return redirect()->route('adl.lista');  
        }

        toast()->error('Houve um erro ao recuperar!');
        return redirect()->route('adl.lista'); 
    }

    public function forceDelete($id)
    {
        // Recupera o post pelo ID
        $forceDelete = Adl::findOrFail($id)->forceDelete();
    
        if($forceDelete){
            AdlRepository::cleanCache();
            toast()->success('Adl Recuperado!');
            return redirect()->route('adl.lista');  
        }

        toast()->error('Houve um erro ao Apagar definitivo!');
        return redirect()->route('adl.lista');
    }

    public function datesToCreate($request) {
        //dados do formulário
        $dados = $request->all();
        $ano = (int) date('Y');

        $ref = Adl::where('sjd_ref_ano','=',$ano)->max('sjd_ref');
        //referência e ano
        $dados['sjd_ref'] = $ref+1;
        $dados['sjd_ref_ano'] = $ano;
        
        return $dados;
    }

    public function canSee($proc) {
        ver_unidade($proc);//teste para verificar se pode ver outras unidades, caso não possa aborta
        //----envolvido do procedimento
        $envolvido = Envolvido::acusado()->where('id_adl','=',$proc->id_adl)->get();
        //teste para verificar se pode ver superior, caso não possa aborta
        ver_superior($envolvido, Auth::user());
    }

}
