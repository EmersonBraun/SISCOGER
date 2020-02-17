<?php

namespace App\Http\Controllers\Subform;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repositories\proc\MovimentoRepository;

class MovimentoController extends Controller
{
    protected $repository;
    public function __construct(
        MovimentoRepository $repository
    )
	{
        $this->repository = $repository;
    }

    public function list($proc, $id)
    {
        $result = $this->repository->allProc($id, $proc);

        return response()->json($result, 200);
    }

    public function find($id)
    {

        $data = $this->repository->findOrFail($id);
        
        if($data) return response()->json(['data' => $data,'success' => true,], 200);
        return response()->json(['success' => false], 500);
        
    }

    public function refAno($ref, $ano='')
    {
        $data = $this->repository->refAno($ref, $ano);
        if($data) return response()->json(['data' => $data,'success' => true,], 200);
        return response()->json(['success' => false], 500);
    }

    public function all()
    {
        $data = $this->repository->all();
        if($data) return response()->json(['data' => $data,'success' => true,], 200);
        return response()->json(['success' => false], 500);
    }

    public function store(Request $request)
    {
        $dados = $request->all();
        $create = $this->repository->create($dados);
        if($create)
        {
            $this->repository->cleanCache();
            return response()->json(['success' => true,], 200);
        }
        return response()->json(['success' => false,], 200);
    }

    public function update(Request $request, $id)
    {
        $dados = $request->all();
        $update = $this->repository->findAndUpdate($id,$dados);
        
        if($update)
        {
            $this->repository->cleanCache();
            return response()->json(['success' => true,], 200);
        }
        return response()->json(['success' => false,], 200);
    }

    public function destroy($id)
    {
        $destroy = $this->repository->findAndDelete($id);
        if($destroy)
        {
            $this->repository->cleanCache();
            return response()->json(['success' => true,], 200);
        }
        return response()->json(['success' => false,], 500);
    }
}


