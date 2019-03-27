<?php

namespace App\Http\Controllers\_Api\SJD\PM;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PMController extends Controller
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
            ], 200);
        } 

        return response()->json([
            'pm' => $pm,
            'posto' => sistema('posto',$pm['CARGO']),
            'success' => true,
        ], 200);

    }
        

}
