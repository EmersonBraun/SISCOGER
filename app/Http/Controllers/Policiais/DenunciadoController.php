<?php

namespace App\Http\Controllers\Policiais;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PM\DenunciacivilRepository;
use App\Repositories\PM\EnvolvidoRepository;

class DenunciadoController extends Controller
{
    protected $repository;
    protected $envolvido;
    public function __construct(
        DenunciacivilRepository $repository,
        EnvolvidoRepository $envolvido
    )
	{
        $this->repository = $repository;
        $this->envolvido = $envolvido;
    }

    public function index()
    {
        $registros = $this->repository->all();
        return view('policiais.denunciacivil.index', compact('registros'));
    }

    public function listaDenunciados()
    {
        $registros = $this->envolvido->subJudice();
        return view('policiais.denunciado.index', compact('registros'));
    }

    public function estaDenunciado($rg)
    {
        $response = $this->repository->estaDenunciado($rg);
        return response()->json(['denunciado' => $response,200]);
    }

    public function list($rg)
    {
        return $this->repository->listDenuncias($rg);
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

    public function restore($id)
    {
        $restore = $this->repository->findAndRestore($id);
        
        if($restore){
            $this->repository->cleanCache();
            return response()->json(['success' => true,200]);  
        }
        return response()->json(['success' => false,200]); 
    }

    public function forceDelete($id)
    {
        $forceDelete = $this->repository->findAndDestroy($id);
    
        if($forceDelete){
            $this->repository->cleanCache();
            return response()->json(['success' => true,200]);  
        }
        return response()->json(['success' => false,200]);
    }

}
