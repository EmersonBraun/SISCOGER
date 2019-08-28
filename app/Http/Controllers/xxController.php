<?php

namespace App\Http\Controllers\Xx;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Xx\XxRepository;

class XxController extends Controller
{
    protected $repository; // para consultas no banco de dados
    protected $name = 'Xx'; // Para as mensagens
    protected $index = 'yyy.index'; // Rota base após cada ação
    protected $pastaView = 'yyy.'; // nome da pasta das views
    // gênero substituir WW -> a MM -> o
    public function __construct(ComportamentoRepository $repository)
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
            '' => 'required',
        ]);
        
        $dados = $request->all();
        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->cleanCache();
            toast()->success($this->name.' InseridMM');
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
            '' => 'required',
        ]);

        $dados = $request->all();
        $update = $this->repository->findOrFail($id)->update($dados);
        
        if($update)
        {
            $this->repository->cleanCache();
            toast()->success($this->name.' atualizadMM!');
            return redirect()->route($this->index);
        }

        toast()->warning($this->name.' NÃO atualizadMM!');
        return redirect()->route($this->index);
    }

    public function destroy($id)
    {
        $destroy = $this->repository->findOrFail($id)->delete();

        if($destroy) {
            $this->repository->cleanCache();
            toast()->success($this->name.' ApagadMM');
            return redirect()->route($this->index);
        }

        toast()->warning('Erro ao apagar');
        return redirect()->route($this->index);
    }

    public function restore($id)
    {
        $restore = $this->repository->findAndRestore($id);
        
        if($restore){
            $this->repository->cleanCache();
            toast()->success($this->name.' RecuperadMM!');
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
            toast()->success($this->name.' ApagadMM definitivo!');
            return redirect()->route($this->index);  
        }

        toast()->warning('Houve um erro ao Apagar definitivo!');
        return redirect()->route($this->index);
    }
}
