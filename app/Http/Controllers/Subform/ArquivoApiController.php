<?php

namespace App\Http\Controllers\Subform;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use Session;
use DB;
use App\Models\Sjd\Proc\Arquivo;

class ArquivoApiController extends Controller
{
    public function list($proc, $id)
    {
        $result = Arquivo::where('id_'.$proc,'=',$id)->get();
        return response()->json(
            $result, 200);
    }

    public function store(Request $request)
    {
        $dados = $request->all();
        $create = Arquivo::create($dados);
        if($create)
        {

            return response()->json([
                'success' => true,
            ], 200);
        }
        return response()->json([
            'success' => false,
        ], 500);
    }

    public function edit(Request $request, $id)
    {
        $dados = $request->all();
        $edit = Arquivo::findOrFail($id)->update($dados);
        if($edit)
        {

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
        $destroy = Arquivo::findOrFail($id)->delete();
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


