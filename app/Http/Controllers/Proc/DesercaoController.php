<?php

namespace App\Http\Controllers\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\Repositories\proc\DesercaoRepository;
use App\Models\Sjd\Busca\Envolvido;

class DesercaoController extends Controller
{
    protected $repository;
    public function __construct(DesercaoRepository $repository)
	{
        $this->repository = $repository;
    }

    public function index()
    {
        return redirect()->route('desercao.lista');
    }

    public function lista()
    {
        $registros = $this->repository->all();
        return view('procedimentos.desercao.list.index',compact('registros'));
    }

    public function rel_situacao()
    {
        $registros = $this->repository->all();
        return view('procedimentos.desercao.list.rel_situacao',compact('registros'));
    }

    public function apagados()
    {
        $registros = $this->repository->apagados();
        return view('procedimentos.desercao.list.apagados',compact('registros'));
    }

    public function create()
    {
        return view('procedimentos.desercao.form.create');
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

        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->cleanCache();
            toast()->success('N° '.$dados['sjd_ref'].'/'.'Deserção Inserido');
            return redirect()->route('desercao.lista');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
        
    }
    
    public function show($ref, $ano='')
    {
        //----levantar procedimento
        $proc = $this->repository->refAno($ref,$ano);
        if(!$proc) abort('404');

        $this->canSee($proc);

        return view('procedimentos.desercao.form.show', compact('proc'));
    }

    public function edit($ref, $ano='')
    {
        //----levantar procedimento
        $proc = $this->repository->refAno($ref,$ano);
        if(!$proc) abort('404');
        
        $this->canSee($proc);

        return view('procedimentos.desercao.form.edit', compact('proc'));

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
        $update = $this->repository->findOrFail($id)->update($dados);
        
        if($update)
        {
            $this->repository->cleanCache();
            toast()->success('Deserção atualizado!');
            return redirect()->route('desercao.lista');
        }

        toast()->warning('Deserção NÃO atualizado!');
        return redirect()->route('desercao.lista');

    }

    public function destroy($id)
    {
        //busca procedimento e apaga
        $destroy = $this->repository->findOrFail($id)->delete();

        if($destroy) {
            $this->repository->cleanCache();
            toast()->success('Deserção Apagado');
            return redirect()->route('desercao.lista');
        }

        toast()->warning('erro ao apagar Deserção');
        return redirect()->route('desercao.lista');

    }

    public function restore($id)
    {
        // Recupera o post pelo ID
        $restore = $this->repository->findAndRestore($id);
    
        if($restore){
            $this->repository->cleanCache();
            toast()->success('Deserção Recuperado!');
            return redirect()->route('desercao.lista');  
        }

        toast()->warning('Houve um erro ao recuperar!');
        return redirect()->route('desercao.lista'); 
    }

    public function forceDelete($id)
    {
        // Recupera o post pelo ID
        $forceDelete = $this->repository->findAndDestroy($id);
    
        if($forceDelete){
            $this->repository->cleanCache();
            toast()->success('Deserção apagado DEFINITIVO!');
            return redirect()->route('desercao.lista');  
        }

        toast()->warning('Houve um erro ao Apagar definitivo!');
        return redirect()->route('desercao.lista');
    }

    public function datesToCreate($request) {
        //dados do formulário
        $dados = $request->all();
        $ano = (int) date('Y');

        $ref = $this->repository->maxRef();
        //referência e ano
        $dados['sjd_ref'] = $ref+1;
        $dados['sjd_ref_ano'] = $ano;
        
        return $dados;
    }

    public function canSee($proc) {
        ver_unidade($proc);//teste para verificar se pode ver outras unidades, caso não possa aborta
        //----envolvido do procedimento
        $envolvido = Envolvido::acusado()->where('id_desercao ','=',$proc->id_desercao )->get();
        //teste para verificar se pode ver superior, caso não possa aborta
        ver_superior($envolvido, Auth::user());
    }

}
