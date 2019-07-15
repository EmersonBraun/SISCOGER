<?php

namespace App\Http\Controllers\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Repositories\FatdRepository;
use App\Models\Sjd\Proc\Fatd;
use App\Models\Sjd\Busca\Envolvido;

class FatdController extends Controller
{
    public function index()
    {
        return redirect()->route('fatd.lista',['ano' => date('Y')]);
    }

    public function lista($ano, FatdRepository $repository)
    {
        $registros = $repository->ano($ano);
        return view('procedimentos.fatd.list.index',compact('registros','ano'));
    }

    public function andamento($ano, FatdRepository $repository)
    {
        $registros = $repository->andamentoAno($ano);
        return view('procedimentos.fatd.list.andamento',compact('registros','ano'));
    }

    public function prazos($ano, FatdRepository $repository)
    {
        $registros = $repository->prazosAno($ano);
        return view('procedimentos.fatd.list.prazos',compact('registros','ano'));
    }

    public function rel_situacao($ano, FatdRepository $repository)
    {
        $registros = $repository->ano($ano);
        return view('procedimentos.fatd.list.rel_situacao',compact('registros','ano'));
    }

    public function julgamento($ano, FatdRepository $repository)
    {
        $registros = $repository->julgamentoAno($ano);
        return view('procedimentos.fatd.list.julgamento',compact('registros','ano'));
    }

    public function apagados($ano, FatdRepository $repository)
    {
        $registros = $repository->apagados();
        return view('procedimentos.fatd.list.apagados',compact('registros','ano'));
    }

    public function create()
    {
        return view('procedimentos.fatd.form.create');
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

        $create = Fatd::create($dados);

        if($create)
        {
            FatdRepository::cleanCache();
            toast()->success('N° '.$dados['sjd_ref'].'/'.'FATD Inserido');
            return redirect()->route('fatd.lista');
        }

        toast()->error('Houve um erro na inserção');
        return redirect()->back();
        
    }
    
    public function show($ref, $ano)
    {
        //----levantar procedimento
        $proc = Fatd::ref_ano($ref,$ano)->first();
        if(!$proc) abort('404');

        $this->canSee($proc);

        return view('procedimentos.fatd.form.show', compact('proc'));
    }

    public function edit($ref, $ano)
    {
        //----levantar procedimento
        $proc = Fatd::ref_ano($ref,$ano)->first();
        if(!$proc) abort('404');
        
        $this->canSee($proc);

        return view('procedimentos.fatd.form.edit', compact('proc'));

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
        $update = Fatd::findOrFail($id)->update($dados);
        
        if($update)
        {
            FatdRepository::cleanCache();
            toast()->success('FATD atualizado!');
            return redirect()->route('fatd.lista');
        }

        toast()->error('FATD NÃO atualizado!');
        return redirect()->route('fatd.lista');

    }

    public function destroy($id)
    {
        //busca procedimento e apaga
        $destroy = Fatd::findOrFail($id)->delete();

        if($destroy) {
            FatdRepository::cleanCache();
            toast()->success('FATD Apagado');
            return redirect()->route('fatd.lista');
        }

        toast()->success('erro ao apagar FATD');
        return redirect()->route('fatd.lista');

    }

    public function restore($id)
    {
        // Recupera o post pelo ID
        $restore = Fatd::findOrFail($id)->restore();
    
        if($restore){
            FatdRepository::cleanCache();
            toast()->success('FATD Recuperado!');
            return redirect()->route('fatd.lista');  
        }

        toast()->error('Houve um erro ao recuperar!');
        return redirect()->route('fatd.lista'); 
    }

    public function forceDelete($id)
    {
        // Recupera o post pelo ID
        $forceDelete = Fatd::findOrFail($id)->forceDelete();
    
        if($forceDelete){
            FatdRepository::cleanCache();
            toast()->success('FATD Recuperado!');
            return redirect()->route('fatd.lista');  
        }

        toast()->error('Houve um erro ao Apagar definitivo!');
        return redirect()->route('fatd.lista');
    }

    public function datesToCreate($request) {
        //dados do formulário
        $dados = $request->all();
        $ano = (int) date('Y');

        $ref = Fatd::where('sjd_ref_ano','=',$ano)->max('sjd_ref');
        //referência e ano
        $dados['sjd_ref'] = $ref+1;
        $dados['sjd_ref_ano'] = $ano;
        
        return $dados;
    }

    public function canSee($proc) {
        ver_unidade($proc);//teste para verificar se pode ver outras unidades, caso não possa aborta
        //----envolvido do procedimento
        $envolvido = Envolvido::acusado()->where('id_fatd','=',$proc->id_fatd)->get();
        //teste para verificar se pode ver superior, caso não possa aborta
        ver_superior($envolvido, Auth::user());
    }
}
