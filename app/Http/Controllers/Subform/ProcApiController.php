<?php

namespace App\Http\Controllers\Subform;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProcApiController extends Controller
{
    protected $repository;
    public function __construct(
        MovimentoRepository $repository
    )
	{
        $this->repository = $repository;
    }

    public function dados($proc, $ref, $ano)
    {
        $dados = $this->repository->dados($proc, $ref, $ano);
        return response()->json($dados, 200); 
    }

    public function update(Request $request, $proc, $id, $campo)
    {
        $response = $this->repository->updateCampo($proc, $id, $campo, $request->input);

        return response()->json($response, 200);
    }

    public function dadocampo($proc, $id, $campo)
    {
        $response = $this->repository->dadocampo($proc, $id, $campo); 
        return response()->json($response, 200);
    }


    
}
