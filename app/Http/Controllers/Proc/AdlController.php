<?php

namespace App\Http\Controllers\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\Repositories\proc\AdllRepository;
use App\Services\ProcedService;


class AdlController extends Controller
{
    protected $repository;
    protected $service;
    public function __construct(AdllRepository $repository, ProcedService $service)
	{
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index()
    {
        return redirect()->route('adl.lista');
    }

    public function lista()
    {
        $registros = $this->repository->all();
        return view('procedimentos.adl.list.index',compact('registros'));
    }

    public function andamento()
    {
        $registros = $this->repository->andamento();
        return view('procedimentos.adl.list.andamento',compact('registros'));
    }

    public function prazos()
    {
        $registros = $this->repository->prazos();
        return view('procedimentos.adl.list.prazos',compact('registros'));
    }

    public function rel_situacao()
    {
        $registros = $this->repository->all();
        return view('procedimentos.adl.list.rel_situacao',compact('registros'));
    }

    public function julgamento()
    {
        $registros = $this->repository->julgamento();
        return view('procedimentos.adl.list.julgamento',compact('registros'));
    }

    public function apagados()
    {
        $registros = $this->repository->apagados();
        return view('procedimentos.adl.list.apagados',compact('registros'));
    }

    public function create()
    {
        return view('procedimentos.adl.form.create');
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
        $dados = $this->datesToCreate($request); 

        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->cleanCache();
            toast()->success('N° '.$dados['sjd_ref'].'/'.'adl Inserido');
            return redirect()->route('adl.lista');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
        
    }
    
    public function show($ref, $ano='')
    {
        //----levantar procedimento
        $proc = $this->repository->refAno($ref,$ano);
        if(!$proc) abort('404');

        $this->service->canSee($proc, 'adl');

        return view('procedimentos.adl.form.show', compact('proc'));
    }

    public function edit($ref, $ano='')
    {
        //----levantar procedimento
        $proc = $this->repository->refAno($ref,$ano);
        if(!$proc) abort('404');
        
        $this->service->canSee($proc, 'adl');

        return view('procedimentos.adl.form.edit', compact('proc'));

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

        // dd(\Request::all());
        $dados = $request->all();
        //busca procedimento e atualiza
        $update = $this->repository->findOrFail($id)->update($dados);
        
        if($update)
        {
            $this->repository->cleanCache();
            toast()->success('adl atualizado!');
            return redirect()->route('adl.lista');
        }

        toast()->warning('adl NÃO atualizado!');
        return redirect()->route('adl.lista');

    }

    public function destroy($id)
    {
        //busca procedimento e apaga
        $destroy = $this->repository->findOrFail($id)->delete();

        if($destroy) {
            $this->repository->cleanCache();
            toast()->success('Adl Apagado');
            return redirect()->route('adl.lista');
        }

        toast()->warning('erro ao apagar ADL');
        return redirect()->route('adl.lista');

    }

    public function restore($id)
    {
        // Recupera o post pelo ID
        $restore = $this->repository->findAndRestore($id);
    
        if($restore){
            $this->repository->cleanCache();
            toast()->success('Adl Recuperado!');
            return redirect()->route('adl.lista');  
        }

        toast()->warning('Houve um erro ao recuperar!');
        return redirect()->route('adl.lista'); 
    }

    public function forceDelete($id)
    {
        // Recupera o post pelo ID
        $forceDelete = $this->repository->findAndDestroy($id);
    
        if($forceDelete){
            $this->repository->cleanCache();
            toast()->success('Adl apagado DEFINITIVO!');
            return redirect()->route('adl.lista');  
        }

        toast()->warning('Houve um erro ao Apagar definitivo!');
        return redirect()->route('adl.lista');
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

    public function canSee($proc) {
        ver_unidade($proc);//teste para verificar se pode ver outras unidades, caso não possa aborta
        //----envolvido do procedimento
        $envolvido = Envolvido::acusado()->where('id_adl','=',$proc->id_adl)->get();
        //teste para verificar se pode ver superior, caso não possa aborta
        ver_superior($envolvido, Auth::user());
    }

}
