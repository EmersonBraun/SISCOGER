<?php

namespace App\Http\Controllers\Link;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\link\LinkRepository;

class LinkController extends Controller
{
    protected $repository; // para consultas no banco de dados
    protected $name = 'Link'; // Para as mensagens
    protected $index = 'link.index'; // Rota base após cada ação
    protected $pastaView = 'link.'; // nome da pasta das views

    public function __construct(LinkRepository $repository)
	{
        $this->repository = $repository;
    }

    public function index()
    {
        $registros = $this->repository->all();
        return view($this->pastaView.'index', compact('registros'));
    }

    public function create()
    {
        return view($this->pastaView.'create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'link' => 'required',
            'nome' => 'required',
        ]);
        
        $dados = $request->all();
        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->cleanCache();
            toast()->success($this->name.' Inserido');
            return redirect()->route($this->index);
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
    }

    public function edit($id)
    {
        $proc = $this->repository->findOrFail($id);
        if(!$proc) abort('404');
        
        return view($this->pastaView.'edit', compact('proc'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'link' => 'required',
            'nome' => 'required',
        ]);

        $dados = $request->all();
        $update = $this->repository->findOrFail($id)->update($dados);
        
        if($update)
        {
            $this->repository->cleanCache();
            toast()->success($this->name.' atualizado!');
            return redirect()->route($this->index);
        }

        toast()->warning($this->name.' NÃO atualizado!');
        return redirect()->route($this->index);
    }

    public function destroy($id)
    {
        $destroy = $this->repository->findOrFail($id)->delete();

        if($destroy) {
            $this->repository->cleanCache();
            toast()->success($this->name.' Apagado');
            return redirect()->route($this->index);
        }

        toast()->warning('erro ao apagar comportamento');
        return redirect()->route($this->index);
    }

    public function restore($id)
    {
        $restore = $this->repository->findAndRestore($id);
        
        if($restore){
            $this->repository->cleanCache();
            toast()->success($this->name.' Recuperado!');
            return redirect()->route($this->index);  
        }

        toast()->warning('Houve um erro ao recuperar!');
        return redirect()->route($this->index); 
    }

    public function forceDelete($id)
    {
        $forceDelete = $this->repository->findAndDestroy($id);
    
        if($forceDelete){
            $this->repository->cleanCache();
            toast()->success($this->name.' Apagado definitivo!');
            return redirect()->route($this->index);  
        }

        toast()->warning('Houve um erro ao Apagar definitivo!');
        return redirect()->route($this->index);
    }
}
