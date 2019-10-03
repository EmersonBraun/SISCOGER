<?php

namespace App\Http\Controllers\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repositories\proc\PadRepository;

class PadController extends Controller
{
    protected $repository;
    public function __construct(PadRepository $repository)
	{
        $this->repository = $repository;
    }

    public function index()
    {
        return redirect()->route('pad.lista');
    }

    public function lista()
    {
        $registros = $this->repository->all();
        return view('procedimentos.pad.list.index',compact('registros'));
    }

    public function apagados()
    {
        $registros = $this->repository->apagados();
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
       
        $dados = $this->repository->datesToCreate($request->all()); 
        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->cleanCache();
            toast()->success('N° '.$dados['sjd_ref'].'/'.'PAD Inserido');
            return redirect()->route('pad.lista');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
        
    }
    
    public function show($ref, $ano='')
    {
        $proc = $this->repository->refAno($ref,$ano,'pad');
        return view('procedimentos.pad.form.show', compact('proc'));
    }

    public function edit($ref, $ano='')
    {
        $proc = $this->repository->refAno($ref,$ano,'pad');
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

        $dados = $request->all();
        $update = $this->repository->findAndUpdate($id,$dados);
        
        if($update)
        {
            $this->repository->cleanCache();
            toast()->success('PAD atualizado!');
            return redirect()->route('pad.lista');
        }

        toast()->warning('PAD NÃO atualizado!');
        return redirect()->route('pad.lista');

    }

    public function destroy($id)
    {
        $destroy = $this->repository->findAndDelete($id);

        if($destroy) {
            $this->repository->cleanCache();
            toast()->success('PAD Apagado');
            return redirect()->route('pad.lista');
        }

        toast()->warning('erro ao apagar PAD');
        return redirect()->route('pad.lista');

    }

    public function restore($id)
    {
        $restore = $this->repository->findAndRestore($id);
    
        if($restore){
            $this->repository->cleanCache();
            toast()->success('PAD Recuperado!');
            return redirect()->route('pad.lista');  
        }

        toast()->warning('Houve um erro ao recuperar!');
        return redirect()->route('pad.lista'); 
    }

    public function forceDelete($id)
    {
        $forceDelete = $this->repository->findAndDestroy($id);
    
        if($forceDelete){
            $this->repository->cleanCache();
            toast()->success('PAD apagado DEFINITIVO!');
            return redirect()->route('pad.lista');  
        }

        toast()->warning('Houve um erro ao Apagar definitivo!');
        return redirect()->route('pad.lista');
    }

}
