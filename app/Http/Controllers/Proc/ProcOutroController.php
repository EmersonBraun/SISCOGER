<?php

namespace App\Http\Controllers\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repositories\proc\ProcOutroRepository;

class ProcOutroController extends Controller
{
    protected $repository;
    public function __construct(ProcOutroRepository $repository)
	{
        $this->repository = $repository;
    }

    public function index()
    {
        return redirect()->route('procoutro.lista');
    }

    public function lista()
    {
        $registros = $this->repository->all();
        return view('procedimentos.procoutros.list.index',compact('registros'));
    }

    public function andamento()
    {
        $registros = $this->repository->all();
        return view('procedimentos.procoutros.list.andamento',compact('registros'));
    }

    public function prazos()
    {
        $registros = $this->repository->prazos();
        return view('procedimentos.procoutros.list.prazos',compact('registros'));
    }

    public function rel_situacao()
    {
        $registros = $this->repository->rel_situacao();
        return view('procedimentos.procoutros.list.prazos',compact('registros'));
    }

    public function julgamento()
    {
        $registros = $this->repository->julgamento();
        return view('procedimentos.procoutros.list.prazos',compact('registros'));
    }

    public function apagados()
    {
        $registros = $this->repository->apagados();
        return view('procedimentos.procoutros.list.apagados',compact('registros'));
    }

    public function create()
    {
        return view('procedimentos.procoutros.form.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'sintese_txt' => 'required',
            'id_municipio' => 'required',
            ]);
       
        $dados = $this->repository->datesToCreate($request->all()); 
        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->cleanCache();
            toast()->success('N° '.$dados['sjd_ref'].'/'.'Proc. Outros Inserido');
            return redirect()->route('procoutro.lista');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
        
    }
    
    public function show($ref, $ano='')
    {
        $proc = $this->repository->procRefAno($ref,$ano,'proc_outros');
        return view('procedimentos.procoutros.form.show', compact('proc'));
    }

    public function edit($ref, $ano='')
    {
        $proc = $this->repository->procRefAno($ref,$ano,'proc_outros');
        if(!$proc) abort('404');

        return view('procedimentos.procoutros.form.edit', compact('proc'));

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'sintese_txt' => 'required',
            'id_municipio' => 'required',
            ]);

        $dados = $request->all();
        $update = $this->repository->findAndUpdate($id,$dados);
        
        if($update)
        {
            $this->repository->cleanCache();
            toast()->success('Proc. Outros atualizado!');
            return redirect()->route('procoutro.lista');
        }

        toast()->warning('Proc. Outros NÃO atualizado!');
        return redirect()->route('procoutro.lista');

    }

    public function destroy($id)
    {
        $destroy = $this->repository->findAndDelete($id);

        if($destroy) {
            $this->repository->cleanCache();
            toast()->success('Proc. Outros Apagado');
            return redirect()->route('procoutro.lista');
        }

        toast()->warning('erro ao apagar Proc. Outros');
        return redirect()->route('procoutro.lista');

    }

    public function restore($id)
    {
        $restore = $this->repository->findAndRestore($id);
    
        if($restore){
            $this->repository->cleanCache();
            toast()->success('Proc. Outros Recuperado!');
            return redirect()->route('procoutro.lista');  
        }

        toast()->warning('Houve um erro ao recuperar!');
        return redirect()->route('procoutro.lista'); 
    }

    public function forceDelete($id)
    {
        $forceDelete = $this->repository->findAndDestroy($id);
    
        if($forceDelete){
            $this->repository->cleanCache();
            toast()->success('Proc. Outros apagado DEFINITIVO!');
            return redirect()->route('procoutro.lista');  
        }

        toast()->warning('Houve um erro ao Apagar definitivo!');
        return redirect()->route('procoutro.lista');
    }

}
