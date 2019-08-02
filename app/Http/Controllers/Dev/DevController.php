<?php

namespace App\Http\Controllers\Dev;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DevController extends Controller
{
    public function turnon()
    {
        \Debugbar::enable();
        toast()->success('Debug iniciado');
        toast()->success('Não esqueça de DESLIGAR');
        return redirect()->route('home');
    }

    public function turnoff()
    {
        \Debugbar::disable();
        toast()->success('Debug Desligado');
        return redirect()->route('home');
    }
}