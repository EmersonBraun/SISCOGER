<?php

namespace App\Http\Controllers\Subform;

use Cache;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PM\ComportamentoRepository as CP;

class ComportamentoApiController extends Controller
{
    private static $expiration = 60;

    public static function comportamentos($unidade)
    {
        $comportamentos = CP::comportamentos($unidade);
        return $comportamentos;
    }
}
