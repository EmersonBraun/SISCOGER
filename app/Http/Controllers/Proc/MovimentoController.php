<?php

namespace App\Http\Controllers\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sjd\Proc\Movimento;

class MovimentoController extends Controller
{
    
   public function inserir($id, Request $request)
   {
    //dd(\Request::all());
    $this->validate($request, [
        'descricao' => 'required',
    ]);
    
    //cria array com dados do movimento
    $dados = [
        'data' => date("Y-m-d"),
        'descricao' => $request->descricao,
        'id_'.$request->proc => $id,
        'rg' => session()->get('rg'),
        'opm' => session()->get('opm_descricao')
    ];
    // dd($dados);
    
    //cria o novo movimento
    Movimento::create($dados);

    toast()->success('inserido','Movimento');

    return redirect()->back();

   }

}
