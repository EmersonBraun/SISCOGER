<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{

    public function ligacao(Request $request)
    {
        $proc = $request->proc;
        $ref = $request->ref;
        $ano = $request->ano;

        if (!$proc) return "Não Encontrado (falta proc)";

        else {
            if ($proc=="apfdc") $proc="apfd";  
            if ($proc=="apfdm") $proc="apfd";
            
            $result = DB::table($proc)
                ->where('sjd_ref','=',$ref)
                ->where('sjd_ref_ano','=',$ano)
                ->first();

            return opm(completa_zeros($result['cdopm']));
        }
    }
}
