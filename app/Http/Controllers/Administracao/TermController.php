<?php

namespace App\Http\Controllers\Administracao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

use App\Models\Sjd\Administracao\Termocompromisso as Termocompromisso;
class TermController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $terms = Termocompromisso::all();
        return view('administracao.termo_compromisso.index',compact('terms'));
    }

    public function create($id)
    {
        $user = User::findOrFail($id);
        return view('administracao.termo_compromisso.create', compact('user','id'));
    }

    public function store($id, Request $request)
    {
        //Validação
        $this->validate($request, [
            'termos' =>'required'
        ]);

        $store = User::findOrFail($id)->update(['termos' => $request->termos]);
        if($store) {
            toast()->success('Criado com sucesso','Termo');
            return redirect()->route('home'); 
        }
        toast()->warning('Erro ao criar','Termo');
        return redirect()->route('home');
    }
}
