<?php

namespace App\Http\Controllers\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repositories\proc\CjRepository;

class CjController extends Controller
{
    protected $repository;
    public function __construct(
        CjRepository $repository
    )
	{
        $this->repository = $repository;
    }

    public function index()
    {
        return redirect()->route('cj.lista');
    }

    public function lista()
    {
        $registros = $this->repository->all();
        return view('procedimentos.cj.list.index',compact('registros'));
    }

    public function andamento( )
    {
        $registros = $this->repository->andamento();
        return view('procedimentos.cj.list.andamento',compact('registros'));
    }

    public function prazos()
    {
        $registros = $this->repository->prazos();
        return view('procedimentos.cj.list.prazos',compact('registros'));
    }

    public function rel_situacao()
    {
        $registros = $this->repository->all();
        return view('procedimentos.cj.list.rel_situacao',compact('registros'));
    }

    public function julgamento()
    {
        $registros = $this->repository->julgamento();
        return view('procedimentos.cj.list.julgamento',compact('registros'));
    }

    public function apagados()
    {
        $registros = $this->repository->apagados();
        return view('procedimentos.cj.list.apagados',compact('registros'));
    }

    public function create()
    {
        return view('procedimentos.cj.form.create');
    }

    public function store(Request $request)
    {
        //andamento (concluído) alguns campos ficam obrigatórios
        if(sistema('andamento',$request['id_andamento']) != 'CONCLUÍDO' ){
            $this->validate($request, [
                'id_andamento' => 'required',
                'sintese_txt' => 'required',
                ]);
        } else {
            $this->validate($request, [
                'id_andamento' => 'required',
                'sintese_txt' => 'required',
                ]);
        }
       
        //dados do formulário
        $dados = $this->repository->datesToCreate($request->all()); 
        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->cleanCache();
            toast()->success('N° '.$dados['sjd_ref'].'/'.'CJ Inserido');
            return redirect()->route('cj.lista');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
        
    }
    
    public function show($ref, $ano='')
    {
        $proc = $this->repository->procRefAno($ref,$ano,'cj');
        return view('procedimentos.cj.form.show', compact('proc'));
    }

    public function edit($ref, $ano='')
    {
        $proc = $this->repository->procRefAno($ref,$ano,'cj');
        return view('procedimentos.cj.form.edit', compact('proc'));

    }

    public function update(Request $request, $id)
    {
        //andamento (concluído) alguns campos ficam obrigatórios
        if(sistema('andamento',$request['id_andamento']) != 'CONCLUÍDO' )
        {
            $this->validate($request, [
                'id_andamento' => 'required',
                'sintese_txt' => 'required',
                ]);
        }
        else
        {
            $this->validate($request, [
                'sintese_txt' => 'required'
            ]);
        }

        $dados = $request->all();
        //busca procedimento e atualiza
        $update = $this->repository->findAndUpdate( $id, $dados);
        
        if($update)
        {
            $this->repository->cleanCache();
            toast()->success('CJ atualizado!');
            return redirect()->route('cj.lista');
        }

        toast()->warning('CJ NÃO atualizado!');
        return redirect()->route('cj.lista');

    }

    public function destroy($id)
    {
        $destroy = $this->repository->findAndDelete($id);

        if($destroy) {
            $this->repository->cleanCache();
            toast()->success('CJ Apagado');
            return redirect()->route('cj.lista');
        }

        toast()->warning('erro ao apagar CJ');
        return redirect()->route('cj.lista');

    }

    public function restore($id)
    {
        $restore = $this->repository->findAndRestore($id);
    
        if($restore){
            $this->repository->cleanCache();
            toast()->success('CJ Recuperado!');
            return redirect()->route('cj.lista');  
        }

        toast()->warning('Houve um erro ao recuperar!');
        return redirect()->route('cj.lista'); 
    }

    public function forceDelete($id)
    {
        $forceDelete = $this->repository->findAndDestroy($id);
    
        if($forceDelete){
            $this->repository->cleanCache();
            toast()->success('CJ apagado DEFINITIVO!');
            return redirect()->route('cj.lista');  
        }

        toast()->warning('Houve um erro ao Apagar definitivo!');
        return redirect()->route('cj.lista');
    }

    public function datesToCreate($request) {
        //dados do formulário
        $dados = $request->all();
        $ano = (int) date('Y');

        $ref = $this->repository->maxRef();
        //referência e ano
        $dados['sjd_ref'] = $ref+1;
        $dados['sjd_ref_ano'] = $ano;
        
        return $dados;
    }
}
