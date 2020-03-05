<?php

namespace App\Http\Controllers\Subform;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\proc\LigacaoRepository;

class LigacaoController extends Controller
{
    protected $repository;
    public function __construct(
        LigacaoRepository $repository
    )
	{
        $this->repository = $repository;
    }

    public function list($proc, $ref, $ano='')
    {
        $result = $this->repository->procRefAno($proc, $ref, $ano);
       
        
        return response()->json( $result, 200);
       
    }
    
    public function store(Request $request)
    {
        $dados = $request->all();
        
        $proc = $dados['origem_proc'];
        if($dados['id_'.$proc] == 0 || $dados['id_'.$proc] == null)
        {
            return response()->json([
                'opm' => 'Sem ID',
                'success' => false,
            ], 500);
        }

        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->cleanCache();
            return response()->json([
                'opm' => 'Criado',
                'success' => true,
            ], 200);
        }
        return response()->json([
            'opm' => 'Não salvo',
            'success' => true,
        ], 500);
    }

    public function destroy($id)
    {
        $destroy = $this->repository->findAndDelete($id);
        if($destroy)
        {
            $this->repository->cleanCache();
            return response()->json([
                'success' => true,
            ], 200);
        }
        return response()->json([
            'success' => true,
        ], 500);
    }
}
