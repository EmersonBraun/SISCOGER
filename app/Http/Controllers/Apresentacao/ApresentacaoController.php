<?php

namespace App\Http\Controllers\Apresentacao;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\apresentacao\ApresentacaoRepository;

class ApresentacaoController extends Controller
{
    protected $repository;
    public function __construct(ApresentacaoRepository $repository)
	{
        $this->repository = $repository;
    }

    public function index($ano="",$cdopm="")
    {
        if(!$ano) $ano = (int) date('Y');
        if(!$cdopm) $cdopm = session('cdopm');
        $registros = $this->repository->opmAno(session('cdopm'), $ano);

        return view('apresentacao.apresentacao.list.index', compact('registros','ano','cdopm'));
    }

    public function apagados($ano="",$cdopm="")
    {
        if(!$ano) $ano = (int) date('Y');
        if(!$cdopm) $cdopm = session('cdopm');
        $registros = $this->repository->apagados();

        return view('apresentacao.apresentacao.list.apagados', compact('registros','ano','cdopm'));
    }

    public function search(Request $request)
    {
        $dados = $request->all();
        if(!$dados['ano']) $dados['ano'] = (int) date('Y');
        if(!$dados['cdopm']) $dados['cdopm'] = session('cdopm');
        
        return redirect()->route('apresentacao.index',['ano' => $dados['ano'], 'cdopm' => $dados['cdopm']]);
    }

    public function create()
    {
        return view('apresentacao.apresentacao.form.create');
    }

    public function store(Request $request)
    {

        $dados = $this->repository->datesToCreate($request->all()); 
        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->cleanCache();
            toast()->success('N° '.$dados['sjd_ref'].'/'.'Apresentacao Inserida');
            return redirect()->route('apresentacao.lista');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
    }

    public function dadosApresentacao($ref,$ano="")
    {
        $search = $this->repository->refAno($ref, $ano);
        $search->pessoa_opm_codigo = corta_zeros($search->pessoa_opm_codigo);
        return response()->json($search, 200);
    }

    public function edit($ref,$ano="")
    {       
        return view('apresentacao.apresentacao.form.edit', compact('ref','ano'));
    }

    public function update(Request $request, $id)
    {

        $dados = $request->all();
        $update = $this->repository->findAndUpdate( $id, $dados);
        
        if($update)
        {
            $this->repository->cleanCache();
            toast()->success('Apresentacao atualizada!');
            return redirect()->route('apresentacao.lista');
        }

        toast()->warning('Apresentacao NÃO atualizada!');
        return redirect()->route('apresentacao.lista');
    }

    public function destroy($id)
    {
        $destroy = $this->repository->findAndDelete($id);

        if($destroy) {
            $this->repository->cleanCache();
            toast()->success('Apresentacao Apagada');
            return redirect()->route('apresentacao.lista');
        }

        toast()->warning('erro ao apagar Apresentacao');
        return redirect()->route('apresentacao.lista');
    }

}
