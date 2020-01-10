<?php

namespace App\Http\Controllers\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\proc\Repositories\ApfdRepository;
use App\Services\AutorizationService;

class ApfdController extends Controller
{
    protected $repository;
    protected $service;
    public function __construct(ApfdRepository $repository, AutorizationService $service)
	{
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index()
    {
        return redirect()->route('apfdm.lista');
    }

    public function lista()
    {
        $registros = $this->repository->militar();
        $tipo = 'militar';
        return view('procedimentos.apfd.list.index',compact('registros'));
    }

    public function rel_situacao()
    {
        $registros = $this->repository->militar();
        $tipo = 'militar';
        return view('procedimentos.apfd.list.rel_situacao',compact('registros'));
    }

    public function apagados()
    {
        $registros = $this->repository->apagados();
        $tipo = 'militar';
        return view('procedimentos.apfd.list.apagados',compact('registros'));
    }

    public function create()
    {
        return view('procedimentos.apfd.form.create');
    }

    public function store(Request $request)
    {
        
        $this->validate($request, [
            'tipo' => 'required',
            'id_andamentocoger' => 'required',
            'sintese_txt' => 'required',
            ]);
       
        //dados do formulário
        $dados = $this->repository->datesToCreate($request->all(),'militar'); 
        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->cleanCache();
            toast()->success('N° '.$dados['sjd_ref'].'/'.'APFD MIlitar Inserido');
            return redirect()->route('apfd.lista');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
        
    }
    
    public function show($ref, $ano='')
    {
        $proc = $this->repository->procRefAno($ref,$ano,'apfdm');
        return view('procedimentos.apfd.form.show', compact('proc'));
    }

    public function edit($ref, $ano='')
    {
        $proc = $this->repository->procRefAno($ref,$ano,'apfdm');
         return view('procedimentos.apfd.form.edit', compact('proc'));

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'id_andamentocoger' => 'required',
            'sintese_txt' => 'required',
            ]);

        $dados = $request->all();
        $update = $this->repository->findAndUpdate( $id, $dados);
        
        if($update)
        {
            $this->repository->cleanCache();
            toast()->success('APFD Militar atualizado!');
            return redirect()->route('apfd.lista');
        }

        toast()->warning('APFD NÃO atualizado!');
        return redirect()->route('apfd.lista');

    }

    public function destroy($id)
    {
        $destroy = $this->repository->findAndDelete($id);

        if($destroy) {
            $this->repository->cleanCache();
            toast()->success('APFD Militar Apagado');
            return redirect()->route('apfd.lista');
        }

        toast()->warning('erro ao apagar APFD');
        return redirect()->route('apfd.lista');

    }

    public function restore($id)
    {
        $restore = $this->repository->findAndRestore($id);
    
        if($restore){
            $this->repository->cleanCache();
            toast()->success('APFD Militar Recuperado!');
            return redirect()->route('apfd.lista');  
        }

        toast()->warning('Houve um erro ao recuperar!');
        return redirect()->route('apfd.lista'); 
    }

    public function forceDelete($id)
    {
        $forceDelete = $this->repository->findAndDestroy($id);
    
        if($forceDelete){
            $this->repository->cleanCache();
            toast()->success('APFD Militar apagado DEFINITIVO!');
            return redirect()->route('apfd.lista');  
        }

        toast()->warning('Houve um erro ao Apagar definitivo!');
        return redirect()->route('apfd.lista');
    }

}
