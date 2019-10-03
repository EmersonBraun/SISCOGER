<?php

namespace App\Http\Controllers\Policiais;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PM\PresoRepository;

class PresoController extends Controller
{
    protected $repository;
    public function __construct(PresoRepository $repository)
	{
        $this->repository = $repository;
    }

    public function index()
    {
        $registros = $this->repository->all();
        return view('policiais.preso.list.index', compact('registros'));
    }

    public function apagados()
    {
        $registros = $this->repository->apagados();
        return view('policiais.preso.list.apagados', compact('registros'));
    }


    public function create()
    {
        return view('policiais.preso.form.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'rg' => 'required',
            'local' => 'required',
            'cdopm_quandopreso' => 'required',
            'inicio_data' => 'required',
        ]);
        
        $dados = $request->all();
        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->cleanCache();
            toast()->success('N° '.$create->id_preso,'Inserido');
            return redirect()->route('preso.index');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
    }

    public function edit($id)
    {
        $proc = $this->repository->findOrFail($id);
        if(!$proc) abort('404');
        
        return view('policiais.preso.form.edit', compact('proc'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'rg' => 'required',
            'local' => 'required',
            'cdopm_quandopreso' => 'required',
            'inicio_data' => 'required',
        ]);

        $dados = $request->all();
        $update = $this->repository->findAndUpdate( $id, $dados);
        
        if($update)
        {
            $this->repository->cleanCache();
            toast()->success('preso atualizado!');
            return redirect()->route('preso.index');
        }

        toast()->warning('preso NÃO atualizado!');
        return redirect()->route('preso.index');
    }

    public function destroy($id)
    {
        $destroy = $this->repository->findAndDelete($id);

        if($destroy) {
            $this->repository->cleanCache();
            toast()->success('preso Apagado');
            return redirect()->route('preso.index');
        }

        toast()->warning('erro ao apagar preso');
        return redirect()->route('preso.index');
    }

    public function restore($id)
    {
        $restore = $this->repository->findAndRestore($id);
        
        if($restore){
            $this->repository->cleanCache();
            toast()->success('Preso Recuperado!');
            return redirect()->route('preso.index');  
        }

        toast()->warning('Houve um erro ao recuperar!');
        return redirect()->route('preso.index'); 
    }

    public function forceDelete($id)
    {
        $forceDelete = $this->repository->findAndDestroy($id);
    
        if($forceDelete){
            $this->repository->cleanCache();
            toast()->success('Preso Apagado definitivo!');
            return redirect()->route('preso.index');  
        }

        toast()->warning('Houve um erro ao Apagar definitivo!');
        return redirect()->route('preso.index');
    }

    // API
    public function estaPreso($rg) //verificar se está preso
    {
        $response = $this->repository->estaPreso($rg);
        return response()->json(['preso' => (int) $response,200]);
    }

    public function list($rg) //prisões
    {
        $data = $this->repository->prisoes($rg);
        return response()->json($data);
    }

    public function storeAPI(Request $request)
    {
        $dados = $request->all();
        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->cleanCache();
            return response()->json(['success' => true,200]);
        }
        return response()->json(['success' => false,200]);
    }

    public function updateAPI(Request $request, $id)
    {
        $dados = $request->all();
        $update = $this->repository->findAndUpdate( $id, $dados);
        
        if($update)
        {
            $this->repository->cleanCache();
            return response()->json(['success' => true,200]);
        }

        return response()->json(['success' => false,200]);
    }

    public function destroyAPI($id)
    {
        $destroy = $this->repository->findAndDelete($id);

        if($destroy) {
            $this->repository->cleanCache();
            return response()->json(['success' => true,200]);
        }

        return response()->json(['success' => false,200]);
    }
}
