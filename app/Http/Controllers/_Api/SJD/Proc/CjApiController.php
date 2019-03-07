<?php

namespace App\Http\Controllers\_Api\SJD\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Repositories\CjRepository;

class CjApiController extends Controller
{
    public function find($id, CjRepository $repository)
    {
        return $repository->find($id);
    }

    public function refAno($ref, $ano, CjRepository $repository)
    {
        return $repository->refAno($ref, $ano);
    }

    public function all(CjRepository $repository)
    {
        return $repository->all();
    }

    public function ano($ano, CjRepository $repository)
    {
        return $repository->ano($ano);
    }

    public function andamento(CjRepository $repository)
    {
        return $repository->andamento();
    }

    public function andamentoAno($ano, CjRepository $repository)
    {
        return $repository->andamentoAno($ano);
    }

    public function prazos(CjRepository $repository)
    {
        return $repository->prazos();
    }

    public function prazosAno($ano)
    {
        return $repository->prazosAno($ano);
    }

    public function relSituacao(CjRepository $repository)
    {
        return $repository->relSituacao($ano);
    }

    public function relSituacaoAno($ano, CjRepository $repository)
    {
        return $repository->relSituacaoAno($ano);
    }

    public function julgamento(CjRepository $repository)
    {
        return $repository->julgamento();
    }

    public function julgamentoAno($ano, CjRepository $repository)
    {
        return $repository->julgamentoAno($ano);
    }
}
