<?php

namespace App\Http\Controllers\_Api\SJD\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Repositories\OPMRepository;
use App\Models\Sjd\Busca\Ligacao;

class LigacaoApiController extends Controller
{
    public function list($proc, $ref, $ano)
    {
        $result = Ligacao::where('destino_proc','=',$proc)
            ->where('destino_sjd_ref','=',$ref)
            ->where('destino_sjd_ref_ano','=',$ano)
            ->get();
        
        return response()->json(
            $result, 200);
    }
    
    public function store(Request $request)
    {
        $dados = $request->all();
        
        $proc = $dados['origem_proc'];
        if($dados['id_'.$proc] == 0 || $dados['id_'.$proc] == null)
        {
            return response()->json([
                'opm' => 'Sem ID',
                'success' => false,
            ], 500);
        }

        $create = Ligacao::create($dados);

        if($create)
        {
            return response()->json([
                'opm' => 'Criado',
                'success' => true,
            ], 200);
        }
        return response()->json([
            'opm' => 'Não salvo',
            'success' => true,
        ], 500);
    }

    public function destroy($id)
    {
        $destroy = Ligacao::findOrFail($id)->delete();
        if($destroy)
        {
            return response()->json([
                'success' => true,
            ], 200);
        }
        return response()->json([
            'success' => true,
        ], 500);
    }
}