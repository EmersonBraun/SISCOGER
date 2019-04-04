<?php

namespace App\Http\Controllers\_Api\SJD\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Repositories\OPMRepository;
use App\Models\Sjd\Busca\Ligacao;

class ProcApiController extends Controller
{
    public function dados($proc, $ref, $ano)
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

        if(!$result)
        {
            return response()->json([
                'opm' => 'Referência inválida',
                'success' => false,
            ], 200);
        }

        return response()->json([
            'proc' => $result,
            'id' => $result['id_'.$proc],
            'situacao' => sistema('procSituacao',$proc),
            'opm' => OPMRepository::uabreviatura(completa_zeros($result['cdopm'])),
            'success' => true,
        ], 200);
    }


    
}
