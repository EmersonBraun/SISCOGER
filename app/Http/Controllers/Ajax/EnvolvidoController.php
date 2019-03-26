<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Repositories\OPMRepository;
use App\Models\Sjd\Policiais\Envolvido;

class EnvolvidoController extends Controller
{
    public function list($proc, $id, $situacao="")
    {
        $query = Envolvido::where('id_'.$proc,'=',$id);
            if($situacao != '') $query->where('situacao','=',$situacao);
            $result = $query->get();

        return response()->json(
            $result, 200);
    }
    
}
