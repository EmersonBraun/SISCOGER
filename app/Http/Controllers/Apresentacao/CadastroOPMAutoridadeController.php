<?php

namespace App\Http\Controllers\Apresentacao;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\apresentacao\CadastroOPMAutoridadeRepository;

class CadastroOPMAutoridadeController extends Controller
{
    protected $repository;
    public function __construct(
        CadastroOPMAutoridadeRepository $repository
    )
	{
        $this->repository = $repository;
    }   

    public function get($id)
    {

        $registro = $this->repository->get($id);
        return response()->json([$registro,200]);
    }

    public function store(Request $request)
    {
        $dados = $request->all(); 
        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->cleanCache();
            return response()->json(['success' => true,200]);
        }
    }

    public function update(Request $request, $id)
    {
        $dados = $request->all();
        $update = $this->repository->findOrFail($id)->update($dados);
        
        if($update)
        {
            $this->repository->cleanCache();
            return response()->json(['success' => true,200]);
        }
    }

    public function destroy($id)
    {
        $destroy = $this->repository->findOrFail($id)->delete();

        if($destroy) {
            $this->repository->cleanCache();
            return response()->json(['success' => true,200]);
        }
    }

    


}
