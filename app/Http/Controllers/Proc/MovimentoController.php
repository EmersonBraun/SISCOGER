<?php

namespace App\Http\Controllers\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Route;
use App\Repositories\proc\MovimentoRepository;
use App\Repositories\proc\ProcRepository;
use App\Repositories\PM\EnvolvidoRepository;

class MovimentoController extends Controller
{
    protected $repository;
    protected $proc;
    protected $envolvido;
    public function __construct(
        MovimentoRepository $repository,
        ProcRepository $proc,
        EnvolvidoRepository $envolvido
    )
	{
        $this->repository = $repository;
        $this->proc = $proc;
        $this->envolvido = $envolvido;
    }

    public function movimentos($ref, $ano='')
    {
        $rota = Route::currentRouteName(); //proc.movimentos
        $rota = explode ('.', $rota); //divide em [0] -> proc e [1]-> movimentos
        $rota = $rota[0];

        $proc = $this->proc->getByRefAno($rota, $ref, $ano);
        $id = $proc['id_'.$rota];
        $movimentos = $this->repository->getById($rota, $id);
        $envolvidos = $this->envolvido->getByNameId($rota, $id);

        $view = str_replace('_','',$rota);
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
        
        $create = $this->repository->create($dados);
        if($create) {
            toast()->success('inserido','Movimento');
            return redirect()->back();
        }

        toast()->warning('Não inserido','Movimento');
        return redirect()->back();
   }

}
