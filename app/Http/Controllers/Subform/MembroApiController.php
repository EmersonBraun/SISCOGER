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
        
        if(isset($dados['idsubs'])) $this->repository->findOrFail($dados['idsubs'])->update(['rg_substituto'=> $dados['rg']]);

        $create = $this->repository->create($dados);
        if($create) return response()->json(['success' => true,], 200);

    }

    public function destroy($id)
    {
        $destroy = $this->repository->findOrFail($id)->delete();
        if($destroy) return response()->json(['success' => true, ], 200);

    }
}
