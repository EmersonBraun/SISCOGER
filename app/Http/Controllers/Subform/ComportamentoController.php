<?php

namespace App\Http\Controllers\Subform;

use App\Http\Controllers\Controller;
use App\Repositories\PM\ComportamentoRepository as CP;

class ComportamentoController extends Controller
{
    private static $expiration = 60;

    public static function comportamentos($unidade)
    {
        $comportamentos = CP::comportamentos($unidade);
        return $comportamentos;
    }
}
