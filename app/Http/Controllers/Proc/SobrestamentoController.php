<?php

namespace App\Http\Controllers\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sjd\Proc\Sobrestamento;
use App\Repositories\proc\SobrestamentoRepository;
use App\Models\Sjd\Busca\Envolvido;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class SobrestamentoController extends Controller
{
    public function sobrestamentos($ref, $ano='')
    {
        $rota = Route::currentRouteName(); //proc.sobrestamentos
        $rota = explode ('.', $rota)[0]; //divide em [0] -> proc e [1]-> sobrestamentos
  
        //----levantar procedimento
        $proc = DB::table($rota)->where('sjd_ref','=',$ref)->where('sjd_ref_ano','=',$ano)->first();

        //teste para verificar se pode ver outras unidades, caso não possa aborta
        ver_unidade($proc);

        $sobrestamentos = Sobrestamento::where('id_'.$rota,'=',$proc['id_'.$rota])->get();
        $envolvidos = Envolvido::where('id_'.$rota,'=',$proc['id_'.$rota])->get();

        $view = str_replace('_','',$rota);
        return view('procedimentos.'.$view.'.form.sobrestamentos',compact('proc','sobrestamentos','envolvidos'));
    }
    
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
        
        $dados = $request->all();
        $dados['id_'.strtolower(tira_acentos($request->proc))] = $id;
        $create = Sobrestamento::create($dados);
        if($create) {
            toast()->success('inserido','Sobrestamento');
            return redirect()->back();
        }
        toast()->warning('Não inserido','Sobrestamento');
        return redirect()->back();

   }

}
