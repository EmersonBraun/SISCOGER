<?php

namespace App\Http\Controllers\Administracao;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Auth;

use App\Models\Sjd\Administracao\Sjd;
use DB;

class SjdController extends Controller
{
     public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $sjd =  Sjd::all();
        
        return view('administracao.sjd.index',compact('sjd'));
    }

    public function create()
    {
        return view('administracao.sjd.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'rg'=>'required',
            'cpf'=>'required'
        ]);
        
        $dados = $request->all();
        $opm = DB::connection('rhparana')->table('policial')->where('RG',$dados['rg'])->first();
        $dados['cdopm'] = corta_zeros($opm['CDOPM']);
        $dados['cdsecao'] = $opm['CDOPM'];
        $dados['secao'] = $opm['OPM_DESCRICAO'];
        $dados['cidade'] = $opm['CIDADE'];

        $create = Sjd::create($dados);
        if($create) {
            toast()->success('adicionado com sucesso!', 'SJD');
            return redirect()->route('sjd.index');
        }

        toast()->success('Erro ao adicionar', 'SJD');
        return redirect()->route('sjd.index');
    }


    public function edit($id)
    {
        $sjd = Sjd::findOrFail($id);
        return view('administracao.sjd.edit', compact('sjd')); 
    }

    public function update(Request $request, $id)
    {
        $sjd = Sjd::findOrFail($id);  
        
        $this->validate($request, [
            'rg'=>'required',
            'cpf'=>'required'
        ]);

        $update = Sjd::update($sjd);
        if($update) {
            toast()->success('atualizado com sucesso!', 'SJD');
            return redirect()->route('sjd.index');
        }

        toast()->warning('Erro ao atualizar!', 'SJD');
        return redirect()->route('sjd.index');
    }

    public function destroy($id)
    {
        $destroy = Sjd::findOrFail($id)->delete();
        if($destroy) {
            toast()->success('apagado com sucesso!', 'SJD');
            return redirect()->route('sjd.index');
        }

        toast()->warning('apagado com sucesso!', 'SJD');
        return redirect()->route('sjd.index');
    }

}
