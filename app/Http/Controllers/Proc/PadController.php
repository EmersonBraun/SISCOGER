<?php

namespace App\Http\Controllers\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Repositories\proc\PadRepository;
use App\Models\Sjd\Proc\Pad;
use App\Models\Sjd\Busca\Envolvido;

class PadController extends Controller
{
    public function index()
    {
        return redirect()->route('pad.lista');
    }

    public function lista(PadRepository $repository)
    {
        $registros = $repository->all();
        return view('procedimentos.pad.list.index',compact('registros'));
    }

    public function apagados(PadRepository $repository)
    {
        $registros = $repository->apagados();
        return view('procedimentos.pad.list.apagados',compact('registros'));
    }

    public function create()
    {
        return view('procedimentos.pad.form.create');
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

        $create = Pad::create($dados);

        if($create)
        {
            PadRepository::cleanCache();
            toast()->success('N° '.$dados['sjd_ref'].'/'.'PAD Inserido');
            return redirect()->route('pad.lista');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
        
    }
    
    public function show($ref, $ano)
    {
        //----levantar procedimento
        $proc = Pad::ref_ano($ref,$ano)->first();
        if(!$proc) abort('404');

        $this->canSee($proc);

        return view('procedimentos.pad.form.show', compact('proc'));
    }

    public function edit($ref, $ano)
    {
        //----levantar procedimento
        $proc = Pad::ref_ano($ref,$ano)->first();
        if(!$proc) abort('404');
        
        $this->canSee($proc);

        return view('procedimentos.pad.form.edit', compact('proc'));

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
        $update = Pad::findOrFail($id)->update($dados);
        
        if($update)
        {
            PadRepository::cleanCache();
            toast()->success('PAD atualizado!');
            return redirect()->route('pad.lista');
        }

        toast()->warning('PAD NÃO atualizado!');
        return redirect()->route('pad.lista');

    }

    public function destroy($id)
    {
        //busca procedimento e apaga
        $destroy = Pad::findOrFail($id)->delete();

        if($destroy) {
            PadRepository::cleanCache();
            toast()->success('PAD Apagado');
            return redirect()->route('pad.lista');
        }

        toast()->warning('erro ao apagar PAD');
        return redirect()->route('pad.lista');

    }

    public function restore($id)
    {
        // Recupera o post pelo ID
        $restore = Pad::findOrFail($id)->restore();
    
        if($restore){
            PadRepository::cleanCache();
            toast()->success('PAD Recuperado!');
            return redirect()->route('pad.lista');  
        }

        toast()->warning('Houve um erro ao recuperar!');
        return redirect()->route('pad.lista'); 
    }

    public function forceDelete($id)
    {
        // Recupera o post pelo ID
        $forceDelete = Pad::findOrFail($id)->forceDelete();
    
        if($forceDelete){
            PadRepository::cleanCache();
            toast()->success('PAD Recuperado!');
            return redirect()->route('pad.lista');  
        }

        toast()->warning('Houve um erro ao Apagar definitivo!');
        return redirect()->route('pad.lista');
    }

    public function datesToCreate($request) {
        //dados do formulário
        $dados = $request->all();
        $ano = (int) date('Y');

        $ref = Pad::where('sjd_ref_ano','=',$ano)->max('sjd_ref');
        //referência e ano
        $dados['sjd_ref'] = $ref+1;
        $dados['sjd_ref_ano'] = $ano;
        
        return $dados;
    }

    public function canSee($proc) {
        ver_unidade($proc);//teste para verificar se pode ver outras unidades, caso não possa aborta
        //----envolvido do procedimento
        $envolvido = Envolvido::acusado()->where('id_pad','=',$proc->id_pad)->get();
        //teste para verificar se pode ver superior, caso não possa aborta
        ver_superior($envolvido, Auth::user());
    }
}
