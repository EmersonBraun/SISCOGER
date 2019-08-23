<?php

namespace App\Http\Controllers\Policiais;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PM\PunidoRepository;
use App\Repositories\PM\PolicialRepository;
use App\Repositories\proc\ProcRepository;

class PunidoController extends Controller
{
    protected $repository;
    public function __construct(
        PunidoRepository $repository,
        PolicialRepository $policial,
        ProcRepository $proc
    )
	{
        $this->repository = $repository;
        $this->policial = $policial;
        $this->proc = $proc;
    }

    public function index()
    {
        $registros = $this->repository->all();
        return view('policiais.punido.list.index', compact('registros'));
    }

    public function conselho()
    {
        $registros = $this->repository->conselhos();
        return view('policiais.punido.list.conselhos', compact('registros'));
    }

    public function create(Request $request)
    {
        $rg = $request->query('rg');
        $pm = $this->policial->get($rg);
        
        $name = $request->query('proc');
        $id = $request->query('id');
        if($name && $id) $procedimento = $this->proc->getById($name, $id);
        else $procedimento = false;

        return view('policiais.punido.form.create',compact('pm','procedimento','name'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'rg' => 'required',
            'cdopm' => 'required',
            'id_classpunicao' => 'required',
            'sjd_ref' => 'required',
            'sjd_ref_ano' => 'required'
        ]);
        
        $dados = $request->all();
        $create = $this->repository->create($dados);
        
        if($create)
        {
            $this->repository->cleanCache();
            toast()->success($create->nome,'punido Inserido');
            return redirect()->route('punido.index');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
    }

    public function edit($id)
    {
        $proc = $this->repository->findOrFail($id);
        if(!$proc) abort('404');
        
        return view('policiais.punido.form.edit', compact('proc'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'rg' => 'required',
            'cdopm' => 'required',
            'id_classpunicao' => 'required',
            'sjd_ref' => 'required',
            'sjd_ref_ano' => 'required'
        ]);

        $dados = $request->all();
        $update = $this->repository->findOrFail($id)->update($dados);
        
        if($update)
        {
            $this->repository->cleanCache();
            toast()->success($update->nome,'punido atualizado!');
            return redirect()->route('punido.index');
        }

        toast()->warning('punido NÃO atualizado!');
        return redirect()->route('punido.index');
    }

    public function destroy($id)
    {
        $destroy = $this->repository->findOrFail($id)->delete();

        if($destroy) {
            $this->repository->cleanCache();
            toast()->success('punido Apagado');
            return redirect()->route('punido.index');
        }

        toast()->warning('erro ao apagar punido');
        return redirect()->route('punido.index');
    }

    public function restore($id)
    {
        $restore = $this->repository->findAndRestore($id);
        
        if($restore){
            $this->repository->cleanCache();
            toast()->success('Punido Recuperado!');
            return redirect()->route('punido.index');  
        }

        toast()->warning('Houve um erro ao recuperar!');
        return redirect()->route('punido.index'); 
    }

    public function forceDelete($id)
    {
        $forceDelete = $this->repository->findAndDestroy($id);
    
        if($forceDelete){
            $this->repository->cleanCache();
            toast()->success('Punido Apagado definitivo!');
            return redirect()->route('punido.index');  
        }

        toast()->warning('Houve um erro ao Apagar definitivo!');
        return redirect()->route('punido.index');
    }
}
