<?php

namespace App\Http\Controllers\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\proc\Repositories\ProcOutroRepository;
use App\Models\Sjd\Proc\ProcOutro;
use App\Models\Sjd\Busca\Envolvido;

class ProcOutrosController extends Controller
{
    public function index()
    {
        return redirect()->route('procoutros.lista');
    }

    public function lista(ProcOutroRepository $repository)
    {
        $registros = $repository->all();
        return view('procedimentos.procoutros.list.index',compact('registros'));
    }

    public function andamento(ProcOutroRepository $repository)
    {
        $registros = $repository->all();
        return view('procedimentos.procoutros.list.andamento',compact('registros'));
    }

    public function prazos(ProcOutroRepository $repository)
    {
        $registros = $repository->prazos();
        return view('procedimentos.procoutros.list.prazos',compact('registros'));
    }

    public function rel_situacao(ProcOutroRepository $repository)
    {
        $registros = $repository->rel_situacao();
        return view('procedimentos.procoutros.list.prazos',compact('registros'));
    }

    public function julgamento(ProcOutroRepository $repository)
    {
        $registros = $repository->julgamento();
        return view('procedimentos.procoutros.list.prazos',compact('registros'));
    }

    public function apagados(ProcOutroRepository $repository)
    {
        $registros = $repository->apagados();
        return view('procedimentos.procoutros.list.apagados',compact('registros'));
    }

    public function create()
    {
        return view('procedimentos.procoutros.form.create');
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

        $create = ProcOutro::create($dados);

        if($create)
        {
            ProcOutroRepository::cleanCache();
            toast()->success('N° '.$dados['sjd_ref'].'/'.'Proc. Outros Inserido');
            return redirect()->route('procoutros.lista');
        }

        toast()->error('Houve um erro na inserção');
        return redirect()->back();
        
    }
    
    public function show($ref, $ano)
    {
        //----levantar procedimento
        $proc = ProcOutro::ref_ano($ref,$ano)->first();
        if(!$proc) abort('404');

        $this->canSee($proc);

        return view('procedimentos.procoutros.form.show', compact('proc'));
    }

    public function edit($ref, $ano)
    {
        //----levantar procedimento
        $proc = ProcOutro::ref_ano($ref,$ano)->first();
        if(!$proc) abort('404');
        
        $this->canSee($proc);

        return view('procedimentos.procoutros.form.edit', compact('proc'));

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
        $update = ProcOutro::findOrFail($id)->update($dados);
        
        if($update)
        {
            ProcOutroRepository::cleanCache();
            toast()->success('Proc. Outros atualizado!');
            return redirect()->route('procoutros.lista');
        }

        toast()->error('Proc. Outros NÃO atualizado!');
        return redirect()->route('procoutros.lista');

    }

    public function destroy($id)
    {
        //busca procedimento e apaga
        $destroy = ProcOutro::findOrFail($id)->delete();

        if($destroy) {
            ProcOutroRepository::cleanCache();
            toast()->success('Proc. Outros Apagado');
            return redirect()->route('procoutros.lista');
        }

        toast()->success('erro ao apagar Proc. Outros');
        return redirect()->route('procoutros.lista');

    }

    public function restore($id)
    {
        // Recupera o post pelo ID
        $restore = ProcOutro::findOrFail($id)->restore();
    
        if($restore){
            ProcOutroRepository::cleanCache();
            toast()->success('Proc. Outros Recuperado!');
            return redirect()->route('procoutros.lista');  
        }

        toast()->error('Houve um erro ao recuperar!');
        return redirect()->route('procoutros.lista'); 
    }

    public function forceDelete($id)
    {
        // Recupera o post pelo ID
        $forceDelete = ProcOutro::findOrFail($id)->forceDelete();
    
        if($forceDelete){
            ProcOutroRepository::cleanCache();
            toast()->success('Proc. Outros Recuperado!');
            return redirect()->route('procoutros.lista');  
        }

        toast()->error('Houve um erro ao Apagar definitivo!');
        return redirect()->route('procoutros.lista');
    }

    public function datesToCreate($request) {
        //dados do formulário
        $dados = $request->all();
        $ano = (int) date('Y');

        $ref = ProcOutro::where('sjd_ref_ano','=',$ano)->max('sjd_ref');
        //referência e ano
        $dados['sjd_ref'] = $ref+1;
        $dados['sjd_ref_ano'] = $ano;
        
        return $dados;
    }

    public function canSee($proc) {
        ver_unidade($proc);//teste para verificar se pode ver outras unidades, caso não possa aborta
        //----envolvido do procedimento
        $envolvido = Envolvido::acusado()->where('id_proc_outros','=',$proc->id_proc_outros)->get();
        //teste para verificar se pode ver superior, caso não possa aborta
        ver_superior($envolvido, Auth::user());
    }
}
