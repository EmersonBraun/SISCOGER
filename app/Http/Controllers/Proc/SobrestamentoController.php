<?php

namespace App\Http\Controllers\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sjd\Proc\Sobrestamento;

class SobrestamentoController extends Controller
{
    
   public function inserir($id, Request $request)
   {
    //dd(\Request::all());
    $this->validate($request, [
        'inicio_data' => 'required',
        'motivo' => 'required',
    ]);
    
    //colocar como vazio '' os que vierem nulos do formulário
    $request->publicacao_termino = (is_null($request->publicacao_termino) || $request->publicacao_termino == '') ? '' : $request->publicacao_termino;
    $request->doc_controle_termino = (is_null($request->doc_controle_termino) || $request->doc_controle_termino == '') ? '' : $request->doc_controle_termino;
    
    //cria array com dados do sobrestamento
    $dados = [
        'id_'.$request->proc => $id,
        'rg' => session()->get('rg'),
        'inicio_data' => data_bd($request->inicio_data),
        'publicacao_inicio' => $request->publicacao_inicio,
        'termino_data' => data_bd($request->termino_data),
        'publicacao_termino' => $request->publicacao_termino,
        'motivo' => $request->motivo,
        'doc_controle_inicio' => $request->doc_controle_inicio,
        'doc_controle_termino' => $request->doc_controle_termino     
    ];
    //dd($dados);
    
    //cria o novo sobrestamento
    Sobrestamento::create($dados);

    toast()->success('inserido','Sobrestamento');

    return redirect()->back();

   }

}
