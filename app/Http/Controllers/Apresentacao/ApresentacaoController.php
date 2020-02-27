<?php

namespace App\Http\Controllers\Apresentacao;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\apresentacao\ApresentacaoRepository;
use App\Repositories\PM\PolicialRepository;
use App\Services\ICOService;
use Barryvdh\DomPDF\Facade as PDF;

class ApresentacaoController extends Controller
{
    protected $repository;
    protected $opm;
    protected $pm;
    public function __construct(
        ApresentacaoRepository $repository,
        PolicialRepository $pm
    )
	{
        $this->repository = $repository;
        $this->pm = $pm;
    }


    public function index($ano="",$mes="", $cdopm="")
    {
    
        if(!$ano) $ano = (int) date('Y');
        if(!$mes) $mes = num_dois_digitos((int) date('m'), true);
        if(!$cdopm) $cdopm =  session('cdopmbase');
        $registros = $this->repository->opmAnoMes($ano, $mes, $cdopm);

        return view('apresentacao.apresentacao.list.index', compact('registros','ano','mes','cdopm'));
    }

    public function apagados($ano="",$cdopm="")
    {
        if(!$ano) $ano = (int) date('Y');
        if(!$cdopm) $cdopm = session('cdopmbase');
        $registros = $this->repository->apagados();

        return view('apresentacao.apresentacao.list.apagados', compact('registros','ano','cdopm'));
    }

    public function search(Request $request)
    {
        $dados = $request->all();
        if(!$dados['ano']) $dados['ano'] = (int) date('Y');
        if(!$dados['mes']) $dados['mes'] = num_dois_digitos((int) date('m'), true);
        $dados['cdopm'] = !$dados['cdopm'] ? session('cdopmbase'): corta_zeros($dados['cdopm']);
        
        return redirect()->route('apresentacao.index',['ano' => $dados['ano'], 'mes' => $dados['mes'], 'cdopm' => $dados['cdopm']]);
    }

    public function memorando($id)
    {
        return view('apresentacao.memorando.create', compact('id'));
    }

    public function memorando_generate($id,$nome,$funcao)
    {
        $registro = $this->repository->get($id);
        if(!$registro['comparecimento_data'] || $registro['comparecimento_data'] == '01/01/1970') {
            toast()->warning('Preencha a data de comparecimento');
            return redirect()->route('apresentacao.edit',['sjd_ref'=>$registro['id_apresentacao'], 'ano' => $registro['sjd_ref_ano']]);
        }
        $registro['pm'] = $this->pm->get($registro['pessoa_rg']);
        $registro['autoridade_nome'] = preg_replace('~-~' , ' ' , $nome);
        $registro['autoridade_funcao'] = preg_replace('~-~' , ' ' , $funcao);
        $html = view('apresentacao.memorando.print', compact('registro'))->render();
        $pdf = PDF::loadHTML($html);
        $nome_pdf = $registro->sjd_ref.'-'.$registro->pessoa_nome.'.pdf';
        return $pdf->download($nome_pdf);
    }

    public function getApresentacao($id)
    {
        $registro = $this->repository->get($id);
        if($registro) return response()->json($registro, 200);
        return response()->json([], 200);
    }

    public function create()
    {
        return view('apresentacao.apresentacao.form.create');
    }

    public function store(Request $request)
    { 
        $dados = $this->repository->datesToCreate($request->all()); 
        // $dados['comprarecimento_dh'] = $dados['comparecimento_data']." ".$dados['comparecimento_hora'];
        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->clearCache();
            // toast()->success('N° '.$dados['sjd_ref'].'/'.'Apresentacao Inserida');
            return response()->json(['success'=> true], 200);
        }
        return response()->json(['success'=> false], 500);
    }

    public function dadosApresentacao($ref,$ano="")
    {
        $search = $this->repository->refAno($ref, $ano);
        $search->pessoa_opm_codigo = corta_zeros($search->pessoa_opm_codigo);
        return response()->json($search, 200);
    }

    public function listNota($id)
    {
        $this->repository->clearCache();
        $search = $this->repository->listNota($id);
        return response()->json($search, 200);
    }

    public function edit($ref,$ano=0)
    {       
        return view('apresentacao.apresentacao.form.edit', compact('ref','ano'));
    }

    public function update(Request $request, $id)
    {

        $dados = $request->all();
        $update = $this->repository->findAndUpdate( $id, $dados);
        
        if($update)
        {
            $this->repository->clearCache();
            // toast()->success('Apresentacao atualizada!');
            return response()->json(['success'=> true], 200);
        }

        return response()->json(['success'=> false], 500);
    }

    public function destroy($id)
    {
        $destroy = $this->repository->findAndDelete($id);
        if($destroy) {
            $this->repository->clearCache();
            toast()->success('Apresentacao Apagada');
            return redirect()->route('apresentacao.index');
        }
        
        toast()->warning('erro ao apagar Apresentacao');
        return redirect()->route('apresentacao.index');
    }

    public function destroyApi($id)
    {
        $destroy = $this->repository->findAndDelete($id);
        if($destroy) {
            $this->repository->clearCache();
            return response()->json(['success'=> true], 200);
        }
        
        return response()->json(['success'=> false], 200);
    }

    public function restore($id)
    {
        $restore = $this->repository->findAndRestore($id);
    
        if($restore){
            $this->repository->clearCache();
            toast()->success('Apresentação Recuperado!');
            return redirect()->route('apresentacao.index');  
        }

        toast()->warning('Houve um erro ao recuperar!');
        return redirect()->route('apresentacao.index'); 
    }

    public function forceDelete($id)
    {
        $forceDelete = $this->repository->findAndDestroy($id);
    
        if($forceDelete){
            $this->repository->clearCache();
            toast()->success('Apresentação apagado DEFINITIVO!');
            return redirect()->route('apresentacao.index');  
        }

        toast()->warning('Houve um erro ao Apagar definitivo!');
        return redirect()->route('apresentacao.index');
    }

}
