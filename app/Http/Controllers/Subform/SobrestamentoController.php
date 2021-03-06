<?php

namespace App\Http\Controllers\Subform;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Sjd\Proc\Sobrestamento;
use App\Repositories\proc\SobrestamentoRepository;

class SobrestamentoController extends Controller
{
    protected $repository;
    public function __construct(
        SobrestamentoRepository $repository
    )
	{
        $this->repository = $repository;
    }

    public function list($proc, $id)
    {
        $result = $this->repository->listProc($proc, $id); 
        return response()->json($result, 200);
    }

    public function store(Request $request)
    {
        $dados = $request->all();
        $create =  $this->repository->createSobrestamento($dados);
        if($create) return response()->json([ 'success' => true,], 200);
        return response()->json([ 'success' => false,], 200);
    }

    public function edit(Request $request, $id)
    {
        $dados = $request->all();
        $edit = $this->repository->findAndUpdateSobrestamento($id, $dados);
        if($edit) return response()->json([ 'success' => true,], 200);
        return response()->json([ 'success' => false,], 200);
    }

    public function destroy($id)
    {
        $destroy = $this->repository->findAndDelete($id);
        if($destroy) return response()->json(['success' => true,], 200);
        return response()->json([ 'success' => false,], 200);
    }
}


