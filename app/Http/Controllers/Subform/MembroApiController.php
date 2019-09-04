<?php

namespace App\Http\Controllers\Subform;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Repositories\PM\OPMRepository;
use App\Models\Sjd\Policiais\Envolvido;

class MembroApiController extends Controller
{
    public function list()
    {
        $result = Envolvido::where('situacao','=','')
            ->get();

        return response()->json(
            $result, 200);
    }

    public function store(Request $request)
    {
        $dados = $request->all();
        
        if(isset($dados['idsubs'])){
            $substituto = Envolvido::findOrFail($dados['idsubs'])->update(['rg_substituto'=> $dados['rg']]);
        }

        $create = Envolvido::create($dados);
        if($create)
        {
            return response()->json([
                'success' => true,
            ], 200);
        }
        return response()->json([
            'success' => false,
        ], 400);
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
        ], 400);
    }
}
