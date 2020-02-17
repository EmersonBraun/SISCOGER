<?php

namespace App\Http\Controllers\Policiais;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PM\ComportamentoRepository;

class ComportamentoController extends Controller
{
    protected $repository;
    protected $proc = 'comportamento';
    protected $nome = 'Comportamento';
    protected $index = 'comportamento.index';

    public function __construct(ComportamentoRepository $repository)
	{
        $this->repository = $repository;
    }

    public function index($posto, $parte=1)
    {
        $registros = $this->repository->posto($posto, $parte);
        return view('policiais.comportamento.index', compact('registros','posto','parte'));
    }

    public function comportamentos($copm)
    {
        return $this->repository->comportamentos($copm);
    }

    public function atual($rg)
    {
        return $this->repository->comportamentoAtual($rg);
    }

    public function list($rg)
    {
        return $this->repository->comportamentoPM($rg);
    }

    public function store(Request $request)
    {
        $dados = $request->all();
        $create = $this->repository->create($dados);

        if($create)
        {
            $this->repository->cleanCache();
            return response()->json(['success' => true,200]);
        }
        return response()->json(['success' => false,200]);
    }

    public function update(Request $request, $id)
    {
        $dados = $request->all();
        $update = $this->repository->findAndUpdate( $id, $dados);
        
        if($update)
        {
            $this->repository->cleanCache();
            return response()->json(['success' => true,200]);
        }

        return response()->json(['success' => false,200]);
    }

    public function destroy($id)
    {
        $destroy = $this->repository->findAndDelete($id);

        if($destroy) {
            $this->repository->cleanCache();
            return response()->json(['success' => true,200]);
           
        }

        return response()->json(['success' => false,200]);
    }
}
