<?php

namespace App\Http\Controllers\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repositories\proc\ItRepository;

class ItController extends Controller
{
    protected $repository;
    public function __construct(ItRepository $repository)
	{
        $this->repository = $repository;
    }

    public function index()
    {
        return redirect()->route('it.lista',['ano' => date('Y')]);
    }

    public function lista($ano)
    {
        $registros = $this->repository->ano($ano);
        return view('procedimentos.it.list.index',compact('registros','ano'));
    }

    public function andamento($ano)
    {
        $registros = $this->repository->andamentoAno($ano);
        return view('procedimentos.it.list.andamento',compact('registros','ano'));
    }

    public function prazos($ano)
    {
        $registros = $this->repository->prazosAno($ano);
        return view('procedimentos.it.list.prazos',compact('registros','ano'));
    }

    public function rel_valores($ano)
    {
        $registros = $this->repository->relValoresAno($ano);
        return view('procedimentos.it.list.rel_valores',compact('registros','ano'));
    }

    public function julgamento($ano)
    {
        $registros = $this->repository->julgamentoAno($ano);
        return view('procedimentos.it.list.julgamento',compact('registros','ano'));
    }

    public function apagados($ano)
    {
        $registros = $this->repository->apagados();
        return view('procedimentos.it.list.apagados',compact('registros','ano'));
    }

    public function create()
    {
        return view('procedimentos.it.form.create');
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
       
        $dados = $this->repository->datesToCreate($request->all()); 
        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->cleanCache();
            toast()->success('N° '.$dados['sjd_ref'].'/'.'IT Inserido');
            return redirect()->route('it.lista');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
        
    }
    
    public function show($ref, $ano='')
    {
        $proc = $this->repository->refAno($ref,$ano,'it');
        return view('procedimentos.it.form.show', compact('proc'));
    }

    public function edit($ref, $ano='')
    {
        $proc = $this->repository->refAno($ref,$ano,'it');
        return view('procedimentos.it.form.edit', compact('proc'));

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
        $update = $this->repository->findAndUpdate($id,$dados);
        
        if($update)
        {
            $this->repository->cleanCache();
            toast()->success('IT atualizado!');
            return redirect()->route('it.lista');
        }

        toast()->warning('IT NÃO atualizado!');
        return redirect()->route('it.lista');

    }

    public function destroy($id)
    {
        $destroy = $this->repository->findAndDelete($id);

        if($destroy) {
            $this->repository->cleanCache();
            toast()->success('IT Apagado');
            return redirect()->route('it.lista');
        }

        toast()->warning('erro ao apagar IT');
        return redirect()->route('it.lista');

    }

    public function restore($id)
    {
        $restore = $this->repository->findAndRestore($id);
    
        if($restore){
            $this->repository->cleanCache();
            toast()->success('IT Recuperado!');
            return redirect()->route('it.lista');  
        }

        toast()->warning('Houve um erro ao recuperar!');
        return redirect()->route('it.lista'); 
    }

    public function forceDelete($id)
    {
        $forceDelete = $this->repository->findAndDestroy($id);
    
        if($forceDelete){
            $this->repository->cleanCache();
            toast()->success('IT apagado DEFINITIVO!');
            return redirect()->route('it.lista');  
        }

        toast()->warning('Houve um erro ao Apagar definitivo!');
        return redirect()->route('it.lista');
    }

}
