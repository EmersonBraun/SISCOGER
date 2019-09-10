<?php

namespace App\Http\Controllers\Policiais;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PM\ElogioRepository;
use App\Services\QueryService;

class ElogioController extends Controller
{
    protected $repository;
    protected $query;
    public function __construct(
        ElogioRepository $repository,
        QueryService $query
    )
	{
        $this->repository = $repository;
        $this->query = $query;
    }

    public function index()
    {
        return view('policiais.elogio.list.search');
    }

    public function search(Request $request)
    {
        $query = $this->query->mount($request->except(['_token']));

        $registros = $this->repository->search($query);

        return view('policiais.elogio.list.index', compact('registros','query'));
    }

    public function list($rg)
    {
        $data = $this->repository->elogiosPM($rg);
        return response()->json($data);
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
        $update = $this->repository->findOrFail($id)->update($dados);
        
        if($update)
        {
            $this->repository->cleanCache();
            return response()->json(['success' => true,200]);
        }

        return response()->json(['success' => false,200]);
    }

    public function destroy($id)
    {
        $destroy = $this->repository->findOrFail($id)->delete();

        if($destroy) {
            $this->repository->cleanCache();
            return response()->json(['success' => true,200]);
        }

        return response()->json(['success' => false,200]);
    }
}
