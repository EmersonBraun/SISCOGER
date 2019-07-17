<?php

namespace App\Http\Controllers\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\proc\Repositories\IsoRepository;
use App\Models\Sjd\Proc\Iso;
use App\Models\Sjd\Busca\Envolvido;

class IsoController extends Controller
{
    public function index()
    {
        return redirect()->route('iso.lista');
    }

    public function lista(IsoRepository $repository)
    {
        $registros = $repository->all();
        return view('procedimentos.iso.list.index',compact('registros'));
    }

    public function andamento(IsoRepository $repository)
    {
        $registros = $repository->andamento();
        return view('procedimentos.iso.list.andamento',compact('registros'));
    }

    public function prazos(IsoRepository $repository)
    {
        $registros = $repository->prazos();
        return view('procedimentos.iso.list.prazos',compact('registros'));
    }

    public function apagados(IsoRepository $repository)
    {
        $registros = $repository->apagados();
        return view('procedimentos.iso.list.apagados',compact('registros'));
    }

    public function create()
    {
        return view('procedimentos.iso.form.create');
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

        $create = Iso::create($dados);

        if($create)
        {
            IsoRepository::cleanCache();
            toast()->success('N° '.$dados['sjd_ref'].'/'.'ISO Inserido');
            return redirect()->route('iso.lista');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
        
    }
    
    public function show($ref, $ano)
    {
        //----levantar procedimento
        $proc = Iso::ref_ano($ref,$ano)->first();
        if(!$proc) abort('404');

        $this->canSee($proc);

        return view('procedimentos.iso.form.show', compact('proc'));
    }

    public function edit($ref, $ano)
    {
        //----levantar procedimento
        $proc = Iso::ref_ano($ref,$ano)->first();
        if(!$proc) abort('404');
        
        $this->canSee($proc);

        return view('procedimentos.iso.form.edit', compact('proc'));

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
        $update = Iso::findOrFail($id)->update($dados);
        
        if($update)
        {
            IsoRepository::cleanCache();
            toast()->success('ISO atualizado!');
            return redirect()->route('iso.lista');
        }

        toast()->warning('ISO NÃO atualizado!');
        return redirect()->route('iso.lista');

    }

    public function destroy($id)
    {
        //busca procedimento e apaga
        $destroy = Iso::findOrFail($id)->delete();

        if($destroy) {
            IsoRepository::cleanCache();
            toast()->success('ISO Apagado');
            return redirect()->route('iso.lista');
        }

        toast()->warning('erro ao apagar ISO');
        return redirect()->route('iso.lista');

    }

    public function restore($id)
    {
        // Recupera o post pelo ID
        $restore = Iso::findOrFail($id)->restore();
    
        if($restore){
            IsoRepository::cleanCache();
            toast()->success('ISO Recuperado!');
            return redirect()->route('iso.lista');  
        }

        toast()->warning('Houve um erro ao recuperar!');
        return redirect()->route('iso.lista'); 
    }

    public function forceDelete($id)
    {
        // Recupera o post pelo ID
        $forceDelete = Iso::findOrFail($id)->forceDelete();
    
        if($forceDelete){
            IsoRepository::cleanCache();
            toast()->success('ISO Recuperado!');
            return redirect()->route('iso.lista');  
        }

        toast()->warning('Houve um erro ao Apagar definitivo!');
        return redirect()->route('iso.lista');
    }

    public function datesToCreate($request) {
        //dados do formulário
        $dados = $request->all();
        $ano = (int) date('Y');

        $ref = Iso::where('sjd_ref_ano','=',$ano)->max('sjd_ref');
        //referência e ano
        $dados['sjd_ref'] = $ref+1;
        $dados['sjd_ref_ano'] = $ano;
        
        return $dados;
    }

    public function canSee($proc) {
        ver_unidade($proc);//teste para verificar se pode ver outras unidades, caso não possa aborta
        //----envolvido do procedimento
        $envolvido = Envolvido::acusado()->where('id_iso','=',$proc->id_iso)->get();
        //teste para verificar se pode ver superior, caso não possa aborta
        ver_superior($envolvido, Auth::user());
    }
}
