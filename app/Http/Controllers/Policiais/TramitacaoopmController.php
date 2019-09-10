<?php

namespace App\Http\Controllers\Policiais;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PM\TramitacaoopmRepository;

class TramitacaoopmController extends Controller
{
    protected $repository;
    public function __construct(
        TramitacaoopmRepository $repository
    )
	{
        $this->repository = $repository;
    }

    public function list($rg)
    {
        $data = $this->repository->tramitacaoopmPM($rg);
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $dados = $request->all();
        $dados['data'] = data_bd($dados['data']);
        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->cleanCache();
            return response()->json(['success' => true,200]);
        }
        return response()->json(['success' => false,200]);
    }

    public function update(Request $request, $id)
    {
        $dados = $request->all();
        $dados['data'] = data_bd($dados['data']);
        $update = $this->repository->findOrFail($id)->update($dados);
        
        if($update)
        {
            $this->repository->cleanCache();
            return response()->json(['success' => true,200]);
        }

        return response()->json(['success' => false,200]);
    }

    public function destroy($id)
    {
        $destroy = $this->repository->findOrFail($id)->delete();

        if($destroy) {
            $this->repository->cleanCache();
            return response()->json(['success' => true,200]);
        }

        return response()->json(['success' => false,200]);
    }
}
