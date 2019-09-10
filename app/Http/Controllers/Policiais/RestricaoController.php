<?php

namespace App\Http\Controllers\Policiais;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PM\RestricaoRepository;

class RestricaoController extends Controller
{
    protected $repository;
    public function __construct(RestricaoRepository $repository)
	{
        $this->repository = $repository;
    }

    public function index($ano='')
    {
        if(!$ano) $ano = date('Y');
        $registros = $this->repository->ano($ano);
        return view('policiais.restricao.list.index', compact('registros','ano'));
    }


    public function create()
    {
        return view('policiais.restricao.form.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'inicio_data' => 'required',
            'obs_txt' => 'required'
        ]);
        
        $dados = $request->all();
        $dados['cadastro_data'] = date('Y-m-d');
        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->cleanCache();
            toast()->success('N° ','restricao Inserido');
            return redirect()->route('restricao.index');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
    }

    public function edit($id)
    {
        $proc = $this->repository->findOrFail($id);
        if(!$proc) abort('404');
        
        return view('policiais.restricao.form.edit', compact('proc'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'inicio_data' => 'required',
            'obs_txt' => 'required'
        ]);

        $dados = $request->all();
        if($dados['fim_data']) $dados['retirada_data'] = date('Y-m-d');
        $update = $this->repository->findOrFail($id)->update($dados);
        
        if($update)
        {
            $this->repository->cleanCache();
            toast()->success('restricao atualizado!');
            return redirect()->route('restricao.index');
        }

        toast()->warning('restricao NÃO atualizado!');
        return redirect()->route('restricao.index');
    }

    public function destroy($id)
    {
        $destroy = $this->repository->findOrFail($id)->delete();

        if($destroy) {
            $this->repository->cleanCache();
            toast()->success('restricao Apagado');
            return redirect()->route('restricao.index');
        }

        toast()->warning('erro ao apagar restricao');
        return redirect()->route('restricao.index');
    }

    public function restore($id)
    {
        $restore = $this->repository->findAndRestore($id);
        
        if($restore){
            $this->repository->cleanCache();
            toast()->success('Restrição Recuperado!');
            return redirect()->route('restricao.index');  
        }

        toast()->warning('Houve um erro ao recuperar!');
        return redirect()->route('restricao.index'); 
    }

    public function forceDelete($id)
    {
        $forceDelete = $this->repository->findAndDestroy($id);
    
        if($forceDelete){
            $this->repository->cleanCache();
            toast()->success('Restrição Apagado definitivo!');
            return redirect()->route('restricao.index');  
        }

        toast()->warning('Houve um erro ao Apagar definitivo!');
        return redirect()->route('restricao.index');
    }

    // API
    public function restricoes($rg) //verificar se tem restrições
    {
        $this->repository->cleanCache();
        $response = $this->repository->restricoes($rg);
        return response()->json([$response,200]);
    }

    public function list($rg) //restrições
    {
        $this->repository->cleanCache();
        $data = $this->repository->list($rg);
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
        $update = $this->repository->findOrFail($id)->update($dados);
        
        if($update)
        {
            $this->repository->cleanCache();
            return response()->json(['success' => true,200]);
        }

        return response()->json(['success' => false,200]);
    }

    public function destroyAPI($id)
    {
        $destroy = $this->repository->findOrFail($id)->delete();

        if($destroy) {
            $this->repository->cleanCache();
            return response()->json(['success' => true,200]);
        }

        return response()->json(['success' => false,200]);
    }
}
