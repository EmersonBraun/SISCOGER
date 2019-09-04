<?php

namespace App\Http\Controllers\Subform;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Repositories\PM\OPMRepository;
use App\Models\Sjd\Policiais\Envolvido;

class EnvolvidoApiController extends Controller
{
    public function list($proc, $id, $situacao="")
    {
        if($situacao) $situacao = strtolower($situacao);
        
        $query = Envolvido::where('id_'.$proc,'=',$id);
        if($situacao != '') $query->where('situacao','=',$situacao);
        $result = $query->get();

        if($result)
        {
            return response()->json(
                $result, 200);
        }

        return response()->json(null, 400);
    }

    public function membros($proc, $id)
    {
        // membros envolvidos
        $result = Envolvido::where('id_'.$proc,'=',$id)
                    ->whereIn('situacao', ['Acusador', 'Encarregado','Escrivão','Membro','Presidente'])
                    ->where('rg_substituto','')
                    ->get();

        $subs = Envolvido::where('id_'.$proc,'=',$id)
                    ->whereIn('situacao', ['Acusador', 'Encarregado','Escrivão','Membro','Presidente'])
                    ->where('rg_substituto','<>','')
                    ->get();
        
        if(!$result) return response()->json(null, 400);
        // situações usadas
        $usados = [];
        foreach ($result as $r) 
        {
            if(!$r['rg_substituto']) 
            {
                array_push($usados,$r['situacao']);
            }
        }

        return response()->json([
            'membros' => $result,
            'subs' => $subs,
            'usados' => $usados
            , 200
        ]);
    }
    
}

