<?php

namespace App\Http\Controllers\Administracao;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Repositories\administracao\SjdRepository;
use App\Repositories\PM\PolicialRepository;

class SjdController extends Controller
{
    protected $sjd;
    protected $pm;

    public function __construct(
    SjdRepository $sjd,
    PolicialRepository $pm
    ) {
        $this->middleware('auth');
        $this->sjd = $sjd;
        $this->pm = $pm;
    }

    public function index()
    {
        $sjd =  $this->sjd->all();
        
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
        
        $dados = $this->datesToCreate($request);
        $create = $this->sjd->create($dados);
        if($create) {
            $this->sjd->clearCache();
            toast()->success('adicionado com sucesso!', 'SJD');
            return redirect()->route('sjd.index');
        }

        toast()->success('Erro ao adicionar', 'SJD');
        return redirect()->route('sjd.index');
    }


    public function edit($id)
    {
        $sjd = $this->sjd->findOrFail($id);
        return view('administracao.sjd.edit', compact('sjd')); 
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'rg'=>'required',
            'cpf'=>'required'
        ]);
        $dados = $request->all();
        $update = $this->sjd->findAndUpdate($id,$dados);
        if($update) {
            $this->sjd->clearCache();
            toast()->success('atualizado com sucesso!', 'SJD');
            return redirect()->route('sjd.index');
        }

        toast()->warning('Erro ao atualizar!', 'SJD');
        return redirect()->route('sjd.index');
    }

    public function destroy($id)
    {
        $destroy = $this->sjd->findAndDelete($id);
        if($destroy) {
            $this->sjd->clearCache();
            toast()->success('apagado com sucesso!', 'SJD');
            return redirect()->route('sjd.index');
        }

        toast()->warning('apagado com sucesso!', 'SJD');
        return redirect()->route('sjd.index');
    }

    public function datesToCreate($request)
    {
        $dados = $request->all();

        $opm = $this->pm->get($dados['rg']);

        $dados['cdopm'] = corta_zeros($opm['CDOPM']);
        $dados['cdsecao'] = $opm['CDOPM'];
        $dados['secao'] = $opm['OPM_DESCRICAO'];
        $dados['cidade'] = $opm['CIDADE'];

        return dados;
    }

}
