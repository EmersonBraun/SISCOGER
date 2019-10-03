<?php

namespace App\Http\Controllers\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repositories\proc\DesercaoRepository;

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
        $dados = $this->repository->datesToCreate($request->all()); 
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
        $proc = $this->repository->refAno($ref,$ano,'desercao');
        return view('procedimentos.desercao.form.show', compact('proc'));
    }

    public function edit($ref, $ano='')
    {
        $proc = $this->repository->refAno($ref,$ano,'desercao');
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

        $dados = $request->all();
        $update = $this->repository->findAndUpdate( $id, $dados);
        
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
        $destroy = $this->repository->findAndDelete($id);

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

}
