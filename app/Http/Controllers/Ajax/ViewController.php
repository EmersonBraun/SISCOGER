<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ViewController extends Controller
{
    public function add(Request $request)
    {
        $tabela = $request->tabela;
        $indice = $request->indice;
        $proc = $request->modulo;
        $unico = $request->unico;
        
        $opts = config('sistema.'.$tabela.ucfirst($proc)) ;
        $situacao = sistema('procSituacao',$proc);

        $sexo = config('sistema.ofendidoSexo');
        $resultado = config('sistema.ofendidoResultado');
        $escolaridade = config('sistema.escolaridade');
        $envolvimento = config('sistema.ofendidoSituacao');
        
        return view('subform.'.$tabela, compact(
            'tabela',
            'indice',
            'proc',
            'opts',
            'situacao',
            'unico',
            'sexo',
            'resultado',
            'escolaridade',
            'envolvimento'
        ));
    }

    
}
