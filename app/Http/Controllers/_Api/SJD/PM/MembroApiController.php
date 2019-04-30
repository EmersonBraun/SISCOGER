<?php

namespace App\Http\Controllers\_Api\SJD\PM;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Repositories\OPMRepository;
use App\Models\Sjd\Policiais\Envolvido;

class MembroApiController extends Controller
{
    
    public function store(Request $request)
    {
        $dados = $request->all();
        
        if($dados['rg'] == 0 || $dados['rg'] == null)
        {
            return response()->json([
                'opm' => 'Sem RG',
                'success' => false,
            ], 500);
        }
        //substituicao
        if($dados['idsubs']){
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
