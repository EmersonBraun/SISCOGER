<?php

namespace App\Http\Controllers\Historia;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sjd\Historia\Historia;
use Illuminate\Support\Facades\DB;

class HistoriaController extends Controller
{

    public function index()
    {
        $historias = Historia::orderBy('data','asc')->get();
        $anoatual = Historia::min('ano');
        //dd($historias);
        return view('historia.index', compact('historias','anoatual'));
    }

    public function create()
    {
        dd(\Request::all());
    }

    public function store(Request $request)
    {
        $dados = $request->all();
        $dados['data'] = data_bd($dados['data']);
        $dados['ano'] = date( 'Y' , strtotime($dados['data']));
        $dados['rg'] = session()->get('rg');
        $dados['nome'] = session()->get('nome');
        //dd($dados);
        Historia::create($dados);

        toast()->success('História inserida!');
        return back();
    }

    public function show()
    {
                
        return view('FDI.ficha', compact('pm'));
    }

    public function update($id,Request $request)
    {
        $dados = $request->all();
        //dd($dados);
        $dados['data'] = data_bd($dados['data']);
        $dados['ano'] = date( 'Y' , strtotime($dados['data']));

        Historia::find($id)->update($dados);

        toast()->success('História atualizada!');
        return back();
    }

    public function destroy($id)
    {
        //dd($id);
        Historia::find($id)->delete();

        //toast()->success('História apagada!');
        return true;
    }
}
