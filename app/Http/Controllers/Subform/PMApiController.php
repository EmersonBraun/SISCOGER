<?php

namespace App\Http\Controllers\Subform;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use GuzzleHttp\Client;
// use Ixudra\Curl\Facades\Curl;
use App\Repositories\PM\PolicialRepository;
class PMApiController extends Controller
{
    public function dados($rg)
    {
        $pm = DB::connection('rhparana')
        ->table('policial')
        ->where('rg','=', $rg)
        ->first();

        if(!$pm) 
        {
            return response()->json([
                'success' => false,
            ], 400);
        } 

        return response()->json([
            'pm' => $pm,
            'posto' => sistema('posto',$pm['CARGO']),
            'success' => true,
        ], 200);

    }

    public function sugest(PolicialRepository $pm,Request $request)
    {
        $dados = $request->all();
        $data = $pm->sugest($dados);
        if($data){
            return response()->json([
                'data' => $data,
                'success' => true,
            ], 200);
        }
        return response()->json([
            'success' => false
        ], 400);  
    }
      
}
