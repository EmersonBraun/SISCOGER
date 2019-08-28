<?php

namespace App\Http\Controllers\Policiais;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PM\SaiRepository;

class SaiController extends Controller
{
    protected $repository;
    public function __construct(SaiRepository $repository)
	{
        $this->repository = $repository;
    }

    public function index()
    {
        return redirect()->route('sai.lista',['ano' => date('Y')]);
    }

    public function lista($ano)
    {
        $registros = $this->repository->ano($ano);
        return view('policiais.sai.list.index', compact('registros','ano'));
    }

    public function andamento($ano)
    {
        $registros = $this->repository->ano($ano);
        return view('policiais.sai.list.andamento', compact('registros','ano'));
    }

    public function prazos($ano)
    {
        $registros = $this->repository->prazoAno($ano);
        return view('policiais.sai.list.prazos', compact('registros','ano'));
    }

    public function motivo($ano)
    {
        $registros = $this->repository->ano($ano);
        return view('policiais.sai.list.motivo', compact('registros','ano'));
    }

    public function resultado($ano)
    {
        $registros = $this->repository->resultado($ano);
        return view('policiais.sai.list.resultado', compact('registros','ano'));
    }

    public function apagados($ano)
    {
        $registros = $this->repository->apagados();
        return view('policiais.sai.list.apagados', compact('registros','ano'));
    }


    public function create()
    {
        return view('policiais.sai.form.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'cdopm_fato' => 'required',
            'sintese_txt' => 'required',
        ]);
        
        $dados = $this->datesToCreate($request);
        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->cleanCache();
            toast()->success('N° '.$create->sjd_ref.'/'.$create->sjd_ref_ano,'SAI Inserido');
            return redirect()->route('sai.lista',$create->sjd_ref_ano);
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
    }

    public function datesToCreate($request) {
        //dados do formulário
        $dados = $request->all();
        $ano = (int) date('Y');

        $ref = $this->repository->maxRef();
        //referência e ano
        $dados['sjd_ref'] = $ref+1;
        $dados['sjd_ref_ano'] = $ano;
        
        return $dados;
    }

    public function edit($id)
    {
        $proc = $this->repository->findOrFail($id);
        if(!$proc) abort('404');
        
        return view('policiais.sai.form.edit', compact('proc'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'cdopm_fato' => 'required',
            'sintese_txt' => 'required',
        ]);

        $dados = $request->all();
        $update = $this->repository->findOrFail($id)->update($dados);
        if($update)
        {
            $this->repository->cleanCache();
            toast()->success('SAI atualizado!');
            return redirect()->route('sai.index');
        }

        toast()->warning('SAI NÃO atualizado!');
        return redirect()->route('sai.index');
    }

    public function destroy($id)
    {
        $destroy = $this->repository->findOrFail($id)->delete();

        if($destroy) {
            $this->repository->cleanCache();
            toast()->success('SAI Apagado');
            return redirect()->route('sai.index');
        }

        toast()->warning('erro ao apagar SAI');
        return redirect()->route('sai.index');
    }

    public function restore($id)
    {
        $restore = $this->repository->findAndRestore($id);
        
        if($restore){
            $this->repository->cleanCache();
            toast()->success('Sai Recuperado!');
            return redirect()->route('sai.index');  
        }

        toast()->warning('Houve um erro ao recuperar!');
        return redirect()->route('sai.index'); 
    }

    public function forceDelete($id)
    {
        $forceDelete = $this->repository->findAndDestroy($id);
    
        if($forceDelete){
            $this->repository->cleanCache();
            toast()->success('Sai Apagado definitivo!');
            return redirect()->route('sai.index');  
        }

        toast()->warning('Houve um erro ao Apagar definitivo!');
        return redirect()->route('sai.index');
    }
}
