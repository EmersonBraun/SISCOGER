<?php

namespace App\Http\Controllers\Subform;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repositories\PM\PolicialRepository;
class PMController extends Controller
{
    protected $repository;
    public function __construct(
        PolicialRepository $repository
    )
	{
        $this->repository = $repository;
    }

    public function dados($rg)
    {
        $pm = $this->repository->ativo($rg); 

        if(!$pm) 
        {
            return response()->json([
                'success' => false,
            ], 400);
        } 

        return response()->json([
            'pm' => $pm,
            'posto' => sistema('posto',$pm['CARGO']),
            'success' => true,
        ], 200);

    }

    public function sugest(Request $request)
    {
        $dados = $request->all();
        $data = $this->repository->sugest($dados);
        
        if($data){
            return response()->json([
                'data' => $data,
                'success' => true,], 200);
        }
        return response()->json(['success' => false], 400);  
    }

    public function showSugest($type, $data)
    {
        $result = $this->repository->sugestions($type, $data);
        
        if($result) return response()->json($result, 200);
        return response()->json([], 200);  
    }
      
}
