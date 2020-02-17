<?php

namespace App\Http\Controllers\Apresentacao;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\apresentacao\NotaCogerRepository;

class NotaCogerController extends Controller
{
    protected $repository;
    public function __construct(NotaCogerRepository $repository)
	{
        $this->repository = $repository;
    }

    public function index($ano="")
    {
        if(!$ano) $ano = (int) date('Y');
        $registros = $this->repository->ano($ano);
        return view('apresentacao.notacoger.list.index', compact('registros','ano'));
    }

    public function apagados($ano="")
    {
        if(!$ano) $ano = (int) date('Y');
        $registros = $this->repository->apagadosAno($ano);
        return view('apresentacao.notacoger.list.apagados', compact('registros','ano'));
    }

    public function create()
    {
        $ref = $this->repository->maxRef_other();
        return view('apresentacao.notacoger.form.create',compact('ref'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'status' => 'required',
        ]);

        $dados = $this->repository->datesToCreate_other($request->all()); 
        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->cleanCache();
            toast()->success('N° '.$dados['sjd_ref'].'/'.'Nota COGER Inserido');
            return redirect()->route('notacoger.edit', ['ref' => $create->sjd_ref, 'ano' => $create->sjd_ref_ano]);
            
            
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->route();
    }

    public function show($ref,$ano)
    {
        $proc = $this->repository->refAno($ref,$ano);
        if(!$proc) abort('404');

        return view('apresentacao.notacoger.form.show', compact('proc'));
    }

    public function edit($ref,$ano)
    {
        $proc = $this->repository->refAno($ref,$ano);
        if(!$proc) abort('404');
        
        return view('apresentacao.notacoger.form.edit', compact('proc'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required',
        ]);

        $dados = $request->all();
        $update = $this->repository->findAndUpdate( $id, $dados);
        
        if($update)
        {
            $this->repository->cleanCache();
            toast()->success('Nota COGER atualizada!');
            return redirect()->route('notacoger.index');
        }

        toast()->warning('Nota COGER NÃO atualizada!');
        return redirect()->route('notacoger.index');
    }

    public function destroy($id)
    {
        $destroy = $this->repository->findAndDelete($id);

        if($destroy) {
            $this->repository->cleanCache();
            toast()->success('Nota COGER Apagada');
            return redirect()->route('notacoger.index');
        }

        toast()->warning('erro ao apagar Nota COGER');
        return redirect()->route('notacoger.index');
    }

    public function restore($id)
    {
        $restore = $this->repository->findAndRestore($id);
    
        if($restore){
            $this->repository->cleanCache();
            toast()->success('Nota COGER Recuperado!');
            return redirect()->route('notacoger.index');  
        }

        toast()->warning('Houve um erro ao recuperar!');
        return redirect()->route('notacoger.index'); 
    }

    public function forceDelete($id)
    {
        $forceDelete = $this->repository->findAndDestroy($id);
    
        if($forceDelete){
            $this->repository->cleanCache();
            toast()->success('Nota COGER apagado DEFINITIVO!');
            return redirect()->route('notacoger.index');  
        }

        toast()->warning('Houve um erro ao Apagar definitivo!');
        return redirect()->route('notacoger.index');
    }

    public function download($id)
    {
        $search = FileUpload::find($id);
        $path = storage_path($search->nota_file);
        $path = str_replace('//','/',$path);
        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $headers = array('Content-Type: application/pdf',);

        return Response::download($path, $search->nota_file, $headers);
    }
}
