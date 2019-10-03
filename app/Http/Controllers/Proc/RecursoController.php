<?php

namespace App\Http\Controllers\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repositories\proc\RecursoRepository;

class RecursoController extends Controller
{
    protected $repository;
    public function __construct(RecursoRepository $repository)
	{
        $this->repository = $repository;
    }

    public function index()
    {
        return redirect()->route('recurso.lista');
    }

    public function lista()
    {
        $registros = $this->repository->all();
        $procs = $this->repository->distinctProcs();
        return view('procedimentos.recurso.list.index',compact('registros','procs'));
    }

    public function proc($proc)
    {
        $registros = $this->repository->proc($proc);
        $procs = $this->repository->distinctProcs();
        return view('procedimentos.recurso.list.proc',compact('registros','procs','proc'));
    }

    public function apagados()
    {
        $registros = $this->repository->apagados();
        $procs = $this->repository->distinctProcs();
        return view('procedimentos.recurso.list.apagados',compact('registros','procs'));
    }

    public function create()
    {
        return view('procedimentos.recurso.form.create');
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
            toast()->success('N° '.$dados['sjd_ref'].'/'.'Recurso Inserido');
            return redirect()->route('recurso.lista');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
        
    }
    
    public function show($ref, $ano='')
    {
        $proc = $this->repository->refAno($ref,$ano,'recurso');
        if(!$proc) abort('404');

        $this->canSee($proc);

        return view('procedimentos.recurso.form.show', compact('proc'));
    }

    public function edit($ref, $ano='')
    {
        $proc = $this->repository->refAno($ref,$ano,'recurso');
        if(!$proc) abort('404');
        
        $this->canSee($proc);

        return view('procedimentos.recurso.form.edit', compact('proc'));

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
            toast()->success('Recurso atualizado!');
            return redirect()->route('recurso.lista');
        }

        toast()->warning('Recurso NÃO atualizado!');
        return redirect()->route('recurso.lista');

    }

    public function destroy($id)
    {
        $destroy = $this->repository->findAndDelete($id);

        if($destroy) {
            $this->repository->cleanCache();
            toast()->success('Recurso Apagado');
            return redirect()->route('recurso.lista');
        }

        toast()->warning('erro ao apagar Recurso');
        return redirect()->route('recurso.lista');

    }

    public function restore($id)
    {
        $restore = $this->repository->findAndRestore($id);
    
        if($restore){
            $this->repository->cleanCache();
            toast()->success('Recurso Recuperado!');
            return redirect()->route('recurso.lista');  
        }

        toast()->warning('Houve um erro ao recuperar!');
        return redirect()->route('recurso.lista'); 
    }

    public function forceDelete($id)
    {
        $forceDelete = $this->repository->findAndDestroy($id);
    
        if($forceDelete){
            $this->repository->cleanCache();
            toast()->success('Recurso apagado DEFINITIVO!');
            return redirect()->route('recurso.lista');  
        }

        toast()->warning('Houve um erro ao Apagar definitivo!');
        return redirect()->route('recurso.lista');
    }

}
