<?php

namespace App\Http\Controllers\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\Repositories\proc\SindicanciaRepository;
use App\Models\Sjd\Busca\Envolvido;

class SindicanciaController extends Controller
{
    protected $repository;
    public function __construct(SindicanciaRepository $repository)
	{
        $this->repository = $repository;
    }

    public function index()
    {
        return redirect()->route('sindicancia.lista',['ano' => date('Y')]);
    }

    public function lista($ano)
    {
        $registros = $this->repository->ano($ano);
        return view('procedimentos.sindicancia.list.index',compact('registros','ano'));
    }

    public function andamento($ano)
    {
        $registros = $this->repository->ano($ano);
        return view('procedimentos.sindicancia.list.andamento',compact('registros','ano'));
    }

    public function prazos($ano)
    {
        $registros = $this->repository->prazosAno($ano);
        return view('procedimentos.sindicancia.list.prazos',compact('registros','ano'));
    }

    public function rel_situacao($ano)
    {
        $registros = $this->repository->ano($ano);
        return view('procedimentos.sindicancia.list.rel_situacao',compact('registros','ano'));
    }

    public function resultado($ano)
    {
        $registros = $this->repository->julgamentoAno($ano);

        return view('procedimentos.sindicancia.list.resultado',compact('registros','ano'));
    }

    public function apagados($ano)
    {
        $registros = $this->repository->apagados();
        return view('procedimentos.sindicancia.list.apagados',compact('registros','ano'));
    }

    public function create()
    {
        return view('procedimentos.sindicancia.form.create');
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
            toast()->success('N° '.$dados['sjd_ref'].'/'.'Sindicância Inserido');
            return redirect()->route('sindicancia.lista');
        }

        toast()->warning('Houve um erro na inserção');
        return redirect()->back();
        
    }
    
    public function show($ref, $ano)
    {
        //----levantar procedimento
        $proc = $this->repository->refAno($ref,$ano)->first();
        if(!$proc) abort('404');

        $this->canSee($proc);

        return view('procedimentos.sindicancia.form.show', compact('proc'));
    }

    public function edit($ref, $ano)
    {
        //----levantar procedimento
        $proc = $this->repository->refAno($ref,$ano)->first();
        if(!$proc) abort('404');
        
        $this->canSee($proc);

        return view('procedimentos.sindicancia.form.edit', compact('proc'));

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
            toast()->success('Sindicância atualizado!');
            return redirect()->route('sindicancia.lista');
        }

        toast()->warning('Sindicância NÃO atualizado!');
        return redirect()->route('sindicancia.lista');

    }

    public function destroy($id)
    {
        //busca procedimento e apaga
        $destroy = $this->repository->findOrFail($id)->delete();

        if($destroy) {
            $this->repository->cleanCache();
            toast()->success('Sindicância Apagado');
            return redirect()->route('sindicancia.lista');
        }

        toast()->warning('erro ao apagar Sindicância');
        return redirect()->route('sindicancia.lista');

    }

    public function restore($id)
    {
        // Recupera o post pelo ID
        $restore = $this->repository->findAndRestore($id);
    
        if($restore){
            $this->repository->cleanCache();
            toast()->success('Sindicância Recuperado!');
            return redirect()->route('sindicancia.lista');  
        }

        toast()->warning('Houve um erro ao recuperar!');
        return redirect()->route('sindicancia.lista'); 
    }

    public function forceDelete($id)
    {
        // Recupera o post pelo ID
        $forceDelete = $this->repository->findAndDestroy($id);
    
        if($forceDelete){
            $this->repository->cleanCache();
            toast()->success('Sindicância apagado DEFINITIVO!');
            return redirect()->route('sindicancia.lista');  
        }

        toast()->warning('Houve um erro ao Apagar definitivo!');
        return redirect()->route('sindicancia.lista');
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
        $envolvido = Envolvido::acusado()->where('id_sindicancia','=',$proc->id_sindicancia)->get();
        //teste para verificar se pode ver superior, caso não possa aborta
        ver_superior($envolvido, Auth::user());
    }
}
