<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Repositories\OPMRepository;
use App\Models\Sjd\Busca\Ligacao;

class ProcController extends Controller
{
    public function index($proc, $ref, $ano)
    {
        // validações
        if(!in_array($proc,config('sistema.pocedimentosOpcoes'))) 
        {
            return response()->json([
                'opm' => 'Procedimento inválido',
                'success' => false,
            ], 200);
        }

        if($ano < 2018 || $ano > date('Y'))
        {
            return response()->json([
                'opm' => 'Ano inválido',
                'success' => false,
            ], 200);
        }

        if ($proc=="apfdc") $proc="apfd";  
        if ($proc=="apfdm") $proc="apfd";
        
        $result = DB::table($proc)
            ->where('sjd_ref','=',$ref)
            ->where('sjd_ref_ano','=',$ano)
            ->first();

        if(!$result['cdopm'])
        {
            return response()->json([
                'opm' => 'Referência inválida',
                'success' => false,
            ], 200);
        }

        $opm = OPMRepository::uabreviatura(completa_zeros($result['cdopm']));

        if(!$opm) 
        {
            return response()->json([
                'opm' => 'OPM Não encontrada',
                'success' => false,
            ], 200);
        } 

        return response()->json([
            'opm' => $opm,
            'id' => $result['id_'.$proc],
            'success' => true,
        ], 200);
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

    public function list($proc, $ref, $ano)
    {
        $result = Ligacao::where('destino_proc','=',$proc)
            ->where('destino_sjd_ref','=',$ref)
            ->where('destino_sjd_ref_ano','=',$ano)
            ->get();

        return response()->json(
            $result, 200);
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
