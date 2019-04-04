<?php

namespace App\Http\Controllers\_Api\SJD\PM;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sjd\Policiais\Ofendido;

class VitimaApiController extends Controller
{
    public function list($proc, $id)
    {
        $result = Ofendido::where('id_'.$proc,'=',$id)->get();
        if($result)
        {
            return response()->json(
                $result, 200);
        }

        return response()->json([
            'success' => false,
        ], 500);
    }
    
    public function store(Request $request)
    {
        $dados = $request->all();
        $create = Ofendido::create($dados);
        if($create->exists)
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
        $destroy = Ofendido::findOrFail($id)->delete();
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
