<?php

namespace App\Http\Controllers\Historia;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sjd\Historia\Historia;


class HistoriaController extends Controller
{

    public function index()
    {
        $historias = Historia::orderBy('data','asc')->get();
        $anoatual = Historia::min('ano');

        return view('historia.index', compact('historias','anoatual'));
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        $dados = $request->all();
        $dados['data'] = data_bd($dados['data']);
        $dados['ano'] = date( 'Y' , strtotime($dados['data']));
        $dados['rg'] = session()->get('rg');
        $dados['nome'] = session()->get('nome');

        $create = Historia::create($dados);
        if($create) {
            toast()->success('inserida com sucesso!','História');
            return redirect()->route('histroria.index');
        }

        toast()->warning('Erro ao inserir','História');
        return redirect()->route('histroria.index');    
    }

    public function show()
    {
        return true;
    }

    public function update($id,Request $request)
    {
        $dados = $request->all();
        $dados['data'] = data_bd($dados['data']);
        $dados['ano'] = date( 'Y' , strtotime($dados['data']));

        $update = Historia::find($id)->update($dados);
        if($update) {
            toast()->success('atualizada com sucesso!','História');
            return redirect()->route('histroria.index');
        }

        toast()->warning('Erro ao atualizar','História');
        return redirect()->route('histroria.index'); 
    }

    public function destroy($id)
    {
        $destroy = Historia::find($id)->delete();

        if($destroy) {
            toast()->success('apagada com sucesso!','História');
            return redirect()->route('histroria.index');
        }

        toast()->warning('Erro ao apagar','História');
        return redirect()->route('histroria.index'); 
    }
}
