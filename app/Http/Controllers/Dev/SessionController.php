<?php

namespace App\Http\Controllers\Dev;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class SessionController extends Controller
{
    public function dados()
    {
        $session = [
            'rg' => session('rg'),
            'nome' => session('nome'),
            'email' => session('email'),
            'cargo' => session('cargo'),
            'quadro' => session('quadro'),
            'subquadro' => session('subquadro'),
            'opm_descricao' => session('opm_descricao'),
            'cdopm' => session('cdopm'),
            'cdopmbase' => session('cdopmbase'),
            'ver_todas_unidades' => session('ver_todas_unidades'),
            'is_admin' => session('is_admin'),
            'nivel' => session('nivel'),
            'roles' => Auth::user()->getRoleNames(),
            'permissions' => Auth::user()->getAllPermissions()->pluck('name')
        ];

        return $session;
    }
}