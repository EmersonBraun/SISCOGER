<?php
namespace App\Http\Controllers\Busca;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BuscaController extends Controller
{
    public function pm()
    {
        return view('busca.pm');
    }
    public function fdi(Request $request)
    {
        $rg = $request->rg;
        return redirect()->route('fdi.show',$rg);
    }

    public function ofendido()
    {
        return view('busca.ofendido');
    }

    public function envolvido()
    {
        return view('busca.envolvido');
    }
}