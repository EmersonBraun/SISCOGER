<?php

namespace App\Http\Controllers\Apresentacao;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\apresentacao\CadastroOPMAutoridadeRepository;

class CadastroOPMAutoridadeController extends Controller
{
    protected $repository;
    public function __construct(CadastroOPMAutoridadeRepository $repository)
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
        $dados['ativado'] = 1;
        $dados['usuario_rg'] = session('rg');
        $create = $this->repository->create($dados);
        if($create)
        {
            $this->repository->cleanCache();
            return response()->json(['success' => true,200]);
        }
        return response()->json(['success' => false,], 200);
    }

    public function update(Request $request, $id)
    {
        $dados = $request->all();
        $dados['ativado'] = 1;
        $dados['usuario_rg'] = session('rg');
        $update = $this->repository->findAndUpdate( $id, $dados);
        
        if($update)
        {
            $this->repository->cleanCache();
            return response()->json(['success' => true,200]);
        }
        return response()->json(['success' => false,], 200);
    }

    public function destroy($id)
    {
        $destroy = $this->repository->findAndDelete($id);

        if($destroy) {
            $this->repository->cleanCache();
            return response()->json(['success' => true,200]);
        }
        return response()->json(['success' => false,], 200);
    }

    


}
