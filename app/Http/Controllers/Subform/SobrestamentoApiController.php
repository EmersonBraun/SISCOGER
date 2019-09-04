<?php

namespace App\Http\Controllers\Subform;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use Session;
use DB;
use App\Models\Sjd\Proc\Sobrestamento;

class SobrestamentoApiController extends Controller
{
    public function list($proc, $id)
    {
        $result = Sobrestamento::where('id_'.$proc,'=',$id)->get();
        return response()->json(
            $result, 200);
    }

    public function store(Request $request)
    {
        $dados = $request->all();
        $create = Sobrestamento::create($dados);
        if($create)
        {
            $proc = $dados['procc'];
            $id = $dados['id_'.$proc];
            $search = array_search('SOBRESTADO',config('sistema.andamento'.strtoupper($proc)),true);
            $andamento = DB::table($proc)->where('id_'.$proc,$id)->update(['id_andamento' => $search]);

            if($andamento)
            {
                return response()->json([
                    'success' => true,
                ], 200);
            }

            return response()->json([
                'success' => false,
            ], 500);
        }
        return response()->json([
            'success' => false,
        ], 500);
    }

    public function edit(Request $request, $id)
    {
        $dados = $request->all();
        //verificar se há data fim do sobrestamento
        $fim_sobrestamento = ($dados['termino_data']) ? true : false;
        
        $edit = Sobrestamento::findOrFail($id)->update($dados);
        if($edit)
        {
            if($fim_sobrestamento)
            {
                $proc = $dados['procc'];
                $idp = $dados['id_'.$proc];
                $search = array_search('ANDAMENTO',config('sistema.andamento'.strtoupper($proc)),true);
                $andamento = DB::table($proc)->where('id_'.$proc,$idp)->update(['id_andamento' => $search]);

                if($andamento)
                {
                    return response()->json([
                        'success' => true,
                    ], 200);
                }

                return response()->json([
                    'success' => false,
                ], 500);
            }

            return response()->json([
                'success' => true,
            ], 200);
        }
        return response()->json([
            'success' => false,
        ], 500);
    }

    public function destroy($id)
    {
        $destroy = Sobrestamento::findOrFail($id)->delete();
        if($destroy)
        {
            return response()->json([
                'success' => true,
            ], 200);
        }
        return response()->json([
            'success' => false,
        ], 500);
    }
}


