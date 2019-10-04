<?php

namespace App\Http\Controllers\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repositories\proc\CdRepository;

class CdController extends Controller
{
    protected $repository;
    protected $service;
    public function __construct(CdRepository $repository)
	{
        $this->repository = $repository;
    }

    // listagem 
    public function index()
    {
        return redirect()->route('cd.lista');
    }

    public function lista()
    {
        $registros = $this->repository->all();
        return view('procedimentos.cd.list.index',compact('registros'));
    }

    public function andamento( )
    {
        $registros = $this->repository->andamento();
        return view('procedimentos.cd.list.andamento',compact('registros'));
    }

    public function prazos()
    {
        $registros = $this->repository->prazos();
        return view('procedimentos.cd.list.prazos',compact('registros'));
    }

    public function rel_situacao()
    {
        $registros = $this->repository->all();
        return view('procedimentos.cd.list.rel_situacao',compact('registros'));
    }

    public function julgamento()
    {
        $registros = $this->repository->julgamento();
        return view('procedimentos.cd.list.julgamento',compact('registros'));
    }

    public function apagados()
    {
        $registros = $this->repository->apagados();
        return view('procedimentos.cd.list.apagados',compact('registros'));
    }

    // api
    public function foradoprazo($cdopm)
    {
        return $this->repository->foraDoPrazo($cdopm);
    }

    public function abertura($cdopm)
    {
        return $this->repository->aberturas($cdopm);
    }

    public function qtdOMAnos($cdopm, $ano='')
    {
        if($ano == '') $ano = date('Y');
        return $this->repository->QtdOMAnos($cdopm, $ano);
    }

    public function create()
    {
        return view('procedimentos.cd.form.create');
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
            toast()->success('N° '.$dados['sjd_ref'].'/'.'CD Inserido');
            return redirect()->route('cd.lista');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
        
    }
    
    public function show($ref, $ano='')
    {
        $proc = $this->repository->procRefAno($ref,$ano,'cd');
        if(!$proc) abort('404');
        return view('procedimentos.cd.form.show', compact('proc'));
    }

    public function edit($ref, $ano='')
    {
        $proc = $this->repository->procRefAno($ref,$ano,'cd');
        if(!$proc) abort('404');
        
        $this->service->canSee($proc, 'cd');

        return view('procedimentos.cd.form.edit', compact('proc'));

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
            toast()->success('CD atualizado!');
            return redirect()->route('cd.lista');
        }

        toast()->warning('CD NÃO atualizado!');
        return redirect()->route('cd.lista');

    }

    public function destroy($id)
    {
        //busca procedimento e apaga
        $destroy = $this->repository->findAndDelete($id);

        if($destroy) {
            $this->repository->cleanCache();
            toast()->success('CD Apagado');
            return redirect()->route('cd.lista');
        }

        toast()->warning('erro ao apagar CD');
        return redirect()->route('cd.lista');

    }

    public function restore($id)
    {
        $restore = $this->repository->findAndRestore($id);
    
        if($restore){
            $this->repository->cleanCache();
            toast()->success('CD Recuperado!');
            return redirect()->route('cd.lista');  
        }

        toast()->warning('Houve um erro ao recuperar!');
        return redirect()->route('cd.lista'); 
    }

    public function forceDelete($id)
    {
        $forceDelete = $this->repository->findAndDestroy($id);
    
        if($forceDelete){
            $this->repository->cleanCache();
            toast()->success('CD apagado DEFINITIVO!');
            return redirect()->route('cd.lista');  
        }

        toast()->warning('Houve um erro ao Apagar definitivo!');
        return redirect()->route('cd.lista');
    }

}
