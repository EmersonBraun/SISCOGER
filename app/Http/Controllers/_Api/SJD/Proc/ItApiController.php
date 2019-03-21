<?php

namespace App\Http\Controllers\_Api\SJD\Proc;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Repositories\ItRepository;

class ItApiController extends Controller
{
    public function find($id, ItRepository $repository)
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

    public function refAno($ref, $ano, ItRepository $repository)
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

    public function all(ItRepository $repository)
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

    public function ano($ano, ItRepository $repository)
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

    public function andamento(ItRepository $repository)
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

    public function andamentoAno($ano, ItRepository $repository)
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

    public function prazos(ItRepository $repository)
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

    public function relSituacao(ItRepository $repository)
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

    public function relSituacaoAno($ano, ItRepository $repository)
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

    public function julgamento(ItRepository $repository)
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

    public function julgamentoAno($ano, ItRepository $repository)
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
