<?php

namespace App\Http\Controllers\Administracao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\PM\TermoCompromissoRepository;
use App\Repositories\administracao\UserRepository;

class TermController extends Controller
{
    protected $termo;
    protected $user;

    public function __construct(
        TermoCompromissoRepository $termo,
        UserRepository $user
    ) {
        $this->middleware('auth');
        $this->termo = $termo;
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $terms = $this->termo->all();
        return view('administracao.termo_compromisso.index',compact('terms'));
    }

    public function create($id)
    {
        $user = $this->user->findOrFail($id);
        return view('administracao.termo_compromisso.create', compact('user','id'));
    }

    public function store($id, Request $request)
    {
        //Validação
        $this->validate($request, [
            'termos' =>'required'
        ]);

        $store = $this->user->findOrFail($id)->update(['termos' => $request->termos]);
        if($store) {
            $this->user->clearCache();
            toast()->success('Criado com sucesso','Termo');
            return redirect()->route('home'); 
        }
        toast()->warning('Erro ao criar','Termo');
        return redirect()->route('home');
    }
}
