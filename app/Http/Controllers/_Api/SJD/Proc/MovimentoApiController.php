<?php

namespace App\Http\Controllers\_Api\SJD\Proc;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Repositories\MovimentoRepository;

class MovimentoApiController extends Controller
{
    public function find($id, MovimentoRepository $repository)
    {

        $data = $repository->find($id);
        
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

    public function refAno($ref, $ano, MovimentoRepository $repository)
    {
        $data = $repository->refAno($ref, $ano);
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

    public function all(MovimentoRepository $repository)
    {
        $data = $repository->all();
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

    public function ano($ano, MovimentoRepository $repository)
    {
        $data = $repository->ano($ano);
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

    public function andamento(MovimentoRepository $repository)
    {
        $data = $repository->andamento();
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

    public function andamentoAno($ano, MovimentoRepository $repository)
    {
        $data = $repository->andamentoAno($ano);
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

    public function prazos(MovimentoRepository $repository)
    {
        $data = $repository->prazos();
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

    public function prazosAno($ano)
    {
        $data = $repository->prazosAno($ano);
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

    public function relSituacao(MovimentoRepository $repository)
    {
        $data = $repository->all();
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

    public function relSituacaoAno($ano, MovimentoRepository $repository)
    {
        $data = $repository->ano($ano);
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

    public function julgamento(MovimentoRepository $repository)
    {
        $data = $repository->julgamento();
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

    public function julgamentoAno($ano, MovimentoRepository $repository)
    {
        $data = $repository->julgamentoAno($ano);
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
}
