<?php

namespace App\Http\Controllers\Subform;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PM\EnvolvidoRepository;

class MembroApiController extends Controller
{
    protected $repository;
    public function __construct(
        EnvolvidoRepository $repository
    )
	{
        $this->repository = $repository;
    }
    
    public function list()
    {
        $result = $this->repository->membro();

        return response()->json($result, 200);
    }

    public function store(Request $request)
    {
        $dados = $request->all();
        
        if(isset($dados['idsubs'])) $this->repository->findAndUpdate($dados['idsubs'],['rg_substituto'=> $dados['rg']]);

        $create = $this->repository->create($dados);
        if($create) {
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
        if($destroy) return response()->json(['success' => true, ], 200);

    }
}
