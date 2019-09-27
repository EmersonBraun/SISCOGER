<?php

namespace App\Http\Controllers\Subform;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repositories\proc\MovimentoRepository;

class MovimentoApiController extends Controller
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

        $data = $this->repository->find($id);
        
        if($data){
            return response()->json([
                'data' => $data,
                'success' => true,
            ], 200);
        }
        return response()->json([
            'success' => false
        ], 500);
        
    }

    public function refAno($ref, $ano='')
    {
        $data = $this->repository->refAno($ref, $ano);
        if($data){
            return response()->json([
                'data' => $data,
                'success' => true,
            ], 200);
        }
        return response()->json([
            'success' => false
        ], 500);
    }

    public function all()
    {
        $data = $this->repository->all();
        if($data){
            return response()->json([
                'data' => $data,
                'success' => true,
            ], 200);
        }
        return response()->json([
            'success' => false
        ], 500);
    }

    public function store(Request $request)
    {
        $dados = $request->all();
        $dados['data'] = data_bd($dados['data']);
        $create = $this->repository->create($dados);
        if($create)
        {
            return response()->json([
                'success' => true,
            ], 200);
        }
        return response()->json([
            'success' => false,
        ], 500);
    }

    public function destroy($id)
    {
        $destroy = $this->repository->findOrFail($id)->delete();
        if($destroy)
        {
            return response()->json([
                'success' => true,
            ], 200);
        }
        return response()->json([
            'success' => false,
        ], 500);
    }
}


