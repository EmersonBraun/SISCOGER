<?php

namespace App\Http\Controllers\Apresentacao;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use App\Repositories\apresentacao\ApresentacaoRepository;

class MemorandoController extends Controller
{
    public function index()
    {
        return view('apresentacao.memorando.index');
    }

    public function create($id)
    {
        return view('apresentacao.memorando.index',compact('id'));
    }


}
