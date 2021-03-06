<?php

namespace App\Http\Controllers\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repositories\proc\SindicanciaRepository;

class SindicanciaController extends Controller
{
    protected $repository;
    public function __construct(SindicanciaRepository $repository)
	{
        $this->repository = $repository;
    }
    // listagem
    public function index()
    {
        return redirect()->route('sindicancia.lista',['ano' => date('Y')]);
    }

    public function lista($ano)
    {
        $registros = $this->repository->ano($ano);
        return view('procedimentos.sindicancia.list.index',compact('registros','ano'));
    }

    public function andamento($ano)
    {
        $registros = $this->repository->ano($ano);
        return view('procedimentos.sindicancia.list.andamento',compact('registros','ano'));
    }

    public function prazos($ano)
    {
        $registros = $this->repository->prazosAno($ano);
        return view('procedimentos.sindicancia.list.prazos',compact('registros','ano'));
    }

    public function rel_situacao($ano)
    {
        $registros = $this->repository->ano($ano);
        return view('procedimentos.sindicancia.list.rel_situacao',compact('registros','ano'));
    }

    public function resultado($ano)
    {
        $registros = $this->repository->julgamentoAno($ano);

        return view('procedimentos.sindicancia.list.resultado',compact('registros','ano'));
    }

    public function apagados($ano)
    {
        $registros = $this->repository->apagados();
        return view('procedimentos.sindicancia.list.apagados',compact('registros','ano'));
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
        return view('procedimentos.sindicancia.form.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'id_andamento' => 'required',
            'portaria_numero' => 'required',
            'sintese_txt' => 'required',
        ]);
       
        $dados = $this->repository->datesToCreate($request->all()); 
        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->clearCache();
            toast()->success('N° '.$dados['sjd_ref'].'/'.'Sindicância Inserido');
            return redirect()->route('sindicancia.lista',date('Y'));
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
        
    }
    
    public function show($ref, $ano='')
    {
        $proc = $this->repository->procRefAno($ref,$ano,'sindicancia');
        return view('procedimentos.sindicancia.form.show', compact('proc'));
    }

    public function edit($ref, $ano='')
    {
        $proc = $this->repository->procRefAno($ref,$ano,'sindicancia');
        return view('procedimentos.sindicancia.form.edit', compact('proc'));

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'id_andamento' => 'required',
            'portaria_numero' => 'required',
            'sintese_txt' => 'required',
        ]);

        $dados = $request->all();
        $update = $this->repository->findAndUpdate($id,$dados);
        
        if($update)
        {
            $this->repository->clearCache();
            toast()->success('Sindicância atualizado!');
            return redirect()->route('sindicancia.lista',date('Y'));
        }

        toast()->warning('Sindicância NÃO atualizado!');
        return redirect()->route('sindicancia.lista',date('Y'));

    }

    public function destroy($id)
    {
        $destroy = $this->repository->findAndDelete($id);

        if($destroy) {
            $this->repository->clearCache();
            toast()->success('Sindicância Apagado');
            return redirect()->route('sindicancia.lista',date('Y'));
        }

        toast()->warning('erro ao apagar Sindicância');
        return redirect()->route('sindicancia.lista',date('Y'));

    }

    public function restore($id)
    {
        $restore = $this->repository->findAndRestore($id);
    
        if($restore){
            $this->repository->clearCache();
            toast()->success('Sindicância Recuperado!');
            return redirect()->route('sindicancia.lista',date('Y'));  
        }

        toast()->warning('Houve um erro ao recuperar!');
        return redirect()->route('sindicancia.lista',date('Y')); 
    }

    public function forceDelete($id)
    {
        $forceDelete = $this->repository->findAndDestroy($id);
    
        if($forceDelete){
            $this->repository->clearCache();
            toast()->success('Sindicância apagado DEFINITIVO!');
            return redirect()->route('sindicancia.lista',date('Y'));  
        }

        toast()->warning('Houve um erro ao Apagar definitivo!');
        return redirect()->route('sindicancia.lista',date('Y'));
    }

}
