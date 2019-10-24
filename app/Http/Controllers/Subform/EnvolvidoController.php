<?php

namespace App\Http\Controllers\Subform;

use App\Http\Controllers\Controller;
use App\Repositories\PM\EnvolvidoRepository;

class EnvolvidoController extends Controller
{
    protected $repository;
    public function __construct(
        EnvolvidoRepository $repository
    )
	{
        $this->repository = $repository;
    }

    public function list($proc, $id, $situacao="")
    {
        if($situacao) $situacao = strtolower($situacao);
        

        $result = $this->repository->list($proc, $id, $situacao);

        if($result) return response()->json($result, 200);
    }

    public function membros($proc, $id)
    {
        // membros envolvidos
        $result = $this->repository->membroAtual($proc, $id);

        $subs = $this->repository->membroSubstituido($proc, $id);
        
        if(!$result) return response()->json(null, 400);
        // situações usadas
        $usados = $this->repository->situacoesUsadas($result);

        return response()->json([
            'membros' => $result,
            'subs' => $subs,
            'usados' => $usados
            , 200
        ]);
    }
    
}

