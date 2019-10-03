<?php

namespace App\Http\Controllers\Arquivamento;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\arquivamento\ArquivamentoRepository;
use App\Repositories\arquivamento\PrateleirasRepository;

class ArquivamentoController extends Controller
{
    protected $repository;
    protected $prateleira;
    public function __construct(
        ArquivamentoRepository $repository,
        PrateleirasRepository $prateleira
    )
	{
        $this->repository = $repository;   
        $this->prateleira = $prateleira;  
    }

    public function list($proc, $id)
    {
        $result = $this->repository->proc($proc, $id);
        return response()->json($result, 200);
    }

    public function local($local)
    {
        $registros = $this->repository->local($local);
        return view('arquivamento.list.'.$local, compact('registros'));
    }

    public function prateleira($numero)
    {
        $maxnumero = (int) $this->prateleira->numero();
        $registros = $this->prateleira->prateleiras($numero);
        return view('arquivamento.list.prateleira', compact('numero','maxnumero','registros'));
    }

    public function create(Request $request)
    {
        $letra = $request->input('letra');
        
        $numero = $request->input('numero');
        $procedimento = $request->input('procedimento');
        $sjd_ref = $request->input('sjd_ref');
        $sjd_ref_ano = $request->input('sjd_ref_ano');
        
        return view('arquivamento.form.create',compact('letra', 'numero', 'procedimento', 'sjd_ref','sjd_ref_ano') );
    }

    public function save(Request $request)
    {
        return 'Não implementado';
    }

    public function store(Request $request)
    {
        $dados = $request->all();
        $create = $this->repository->create($dados);
        if($create) {
            $this->repository->cleanCache();
            return response()->json(['success' => true,], 200);
        }
        return response()->json(['success' => false,], 200);

    }

    public function edit(Request $request, $id)
    {
        $dados = $request->all();
        $edit = $this->repository->findAndUpdate( $id, $dados);
        if($edit) {
            $this->repository->cleanCache();
            return response()->json(['success' => true,], 200);
        }
        return response()->json(['success' => true,], 200);
    }

    public function destroy($id)
    {
        $destroy = $this->repository->findAndDelete($id);
        if($destroy) {
            $this->repository->cleanCache();
            return response()->json(['success' => true,], 200);
        }
        return response()->json(['success' => true,], 200);
    }
}


