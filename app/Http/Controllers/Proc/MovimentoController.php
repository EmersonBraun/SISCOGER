<?php

namespace App\Http\Controllers\Proc;

use Illuminate\Http\Request;
use App\proc\Repositories\MovimentoRepository;
use App\Http\Controllers\Controller;
use App\Models\Sjd\Proc\Movimento;
use App\Models\Sjd\Busca\Envolvido;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class MovimentoController extends Controller
{
    public function movimentos($ref, $ano)
    {
        $rota = Route::currentRouteName(); //proc.movimentos
        $rota = explode ('.', $rota); //divide em [0] -> proc e [1]-> movimentos
        $rota = $rota[0];

        //----levantar procedimento
        $proc = DB::table($rota)->where('sjd_ref','=',$ref)->where('sjd_ref_ano','=',$ano)->first();
        //
        //teste para verificar se pode ver outras unidades, caso não possa aborta
        ver_unidade($proc);

        $movimentos = Movimento::where('id_'.$rota,'=',$proc['id_'.$rota])->get();
        $envolvidos = Envolvido::where('id_'.$rota,'=',$proc['id_'.$rota])->get();
        //dd($envolvidos);

        $view = str_replace('_','',$rota);
        //dd($proc);
        return view('procedimentos.'.$view.'.form.movimentos',compact('proc','movimentos','sobrestamentos','envolvidos'));
    }
    
   public function inserir($id, Request $request)
   {
    //dd(\Request::all());
    $this->validate($request, [
        'descricao' => 'required',
    ]);
    
    $dados = $request->all();
    //cria array com dados do movimento
    $dados = [
        'data' => date("Y-m-d"),
        'descricao' => $request->descricao,
        'id_'.strtolower(tira_acentos($request->proc)) => $id,
        'rg' => session()->get('rg'),
        'opm' => session()->get('opm_descricao')
    ];
    dd($dados);
    
    //cria o novo movimento
    Movimento::create($dados);

    toast()->success('inserido','Movimento');

    return redirect()->back();

   }

}
