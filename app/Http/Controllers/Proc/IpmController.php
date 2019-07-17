<?php

namespace App\Http\Controllers\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\proc\Repositories\IpmRepository;
use App\Models\Sjd\Proc\Ipm;
use App\Models\Sjd\Busca\Envolvido;

class IpmController extends Controller
{
    public function index()
    {
        return redirect()->route('ipm.lista',['ano' => date('Y')]);
    }

    public function lista($ano, IpmRepository $repository)
    {
        $registros = $repository->ano($ano);
        return view('procedimentos.ipm.list.index',compact('registros','ano'));
    }

    public function andamento($ano, IpmRepository $repository)
    {
        $registros = $repository->andamentoAno($ano);
        return view('procedimentos.ipm.list.andamento',compact('registros','ano'));
    }

    public function prazos($ano, IpmRepository $repository)
    {
        $registros = $repository->prazosAno($ano);
        return view('procedimentos.ipm.list.prazos',compact('registros','ano'));
    }

    public function rel_situacao($ano, IpmRepository $repository)
    {
        $registros = $repository->ano($ano);
        return view('procedimentos.ipm.list.rel_situacao',compact('registros','ano'));
    }

    public function resultado($ano, IpmRepository $repository)
    {
        $registros = $repository->julgamentoAno($ano);
        return view('procedimentos.ipm.list.resultado',compact('registros','ano'));
    }

    public function apagados($ano, IpmRepository $repository)
    {
        $registros = $repository->apagados();
        return view('procedimentos.ipm.list.apagados',compact('registros','ano'));
    }

    public function create()
    {
        return view('procedimentos.ipm.form.create');
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

        $create = Ipm::create($dados);

        if($create)
        {
            IpmRepository::cleanCache();
            toast()->success('N° '.$dados['sjd_ref'].'/'.'IPM Inserido');
            return redirect()->route('ipm.lista');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
        
    }
    
    public function show($ref, $ano)
    {
        //----levantar procedimento
        $proc = Ipm::ref_ano($ref,$ano)->first();
        if(!$proc) abort('404');

        $this->canSee($proc);

        return view('procedimentos.ipm.form.show', compact('proc'));
    }

    public function edit($ref, $ano)
    {
        //----levantar procedimento
        $proc = Ipm::ref_ano($ref,$ano)->first();
        if(!$proc) abort('404');
        
        $this->canSee($proc);

        return view('procedimentos.ipm.form.edit', compact('proc'));

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
        $update = Ipm::findOrFail($id)->update($dados);
        
        if($update)
        {
            IpmRepository::cleanCache();
            toast()->success('IPM atualizado!');
            return redirect()->route('ipm.lista');
        }

        toast()->warning('IPM NÃO atualizado!');
        return redirect()->route('ipm.lista');

    }

    public function destroy($id)
    {
        //busca procedimento e apaga
        $destroy = Ipm::findOrFail($id)->delete();

        if($destroy) {
            IpmRepository::cleanCache();
            toast()->success('IPM Apagado');
            return redirect()->route('ipm.lista');
        }

        toast()->warning('erro ao apagar IPM');
        return redirect()->route('ipm.lista');

    }

    public function restore($id)
    {
        // Recupera o post pelo ID
        $restore = Ipm::findOrFail($id)->restore();
    
        if($restore){
            IpmRepository::cleanCache();
            toast()->success('IPM Recuperado!');
            return redirect()->route('ipm.lista');  
        }

        toast()->warning('Houve um erro ao recuperar!');
        return redirect()->route('ipm.lista'); 
    }

    public function forceDelete($id)
    {
        // Recupera o post pelo ID
        $forceDelete = Ipm::findOrFail($id)->forceDelete();
    
        if($forceDelete){
            IpmRepository::cleanCache();
            toast()->success('IPM Recuperado!');
            return redirect()->route('ipm.lista');  
        }

        toast()->warning('Houve um erro ao Apagar definitivo!');
        return redirect()->route('ipm.lista');
    }

    public function datesToCreate($request) {
        //dados do formulário
        $dados = $request->all();
        $ano = (int) date('Y');

        $ref = Ipm::where('sjd_ref_ano','=',$ano)->max('sjd_ref');
        //referência e ano
        $dados['sjd_ref'] = $ref+1;
        $dados['sjd_ref_ano'] = $ano;
        
        return $dados;
    }

    public function canSee($proc) {
        ver_unidade($proc);//teste para verificar se pode ver outras unidades, caso não possa aborta
        //----envolvido do procedimento
        $envolvido = Envolvido::acusado()->where('id_ipm','=',$proc->id_ipm)->get();
        //teste para verificar se pode ver superior, caso não possa aborta
        ver_superior($envolvido, Auth::user());
    }
}
