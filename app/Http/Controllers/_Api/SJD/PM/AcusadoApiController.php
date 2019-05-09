<?php

namespace App\Http\Controllers\_Api\SJD\PM;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Repositories\OPMRepository;
use App\Models\Sjd\Policiais\Envolvido;

class AcusadoApiController extends Controller
{
    public function list($proc, $id, $situacao)
    {
        $result = Envolvido::where('id_'.$proc,'=',$id)
            ->where('situacao','=',$situacao)
            ->get();

        return response()->json(
            $result, 200);
    }
    
    public function store(Request $request)
    {
        $dados = $request->all();
        $create = Envolvido::create($dados);

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
        $edit = Envolvido::findOrFail($id)->update($dados);
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
        $destroy = Envolvido::findOrFail($id)->delete();
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
