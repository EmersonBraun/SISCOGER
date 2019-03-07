<?php

namespace App\Http\Controllers\_Api\SJD\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Repositories\ApfdRepository;

class ApfdApiController extends Controller
{
    public function find($id, ApfdRepository $repository)
    {
        return $repository->find($id);
    }

    public function refAno($ref, $ano, ApfdRepository $repository)
    {
        return $repository->refAno($ref, $ano);
    }

    public function all(ApfdRepository $repository)
    {
        return $repository->all();
    }

    public function ano($ano, ApfdRepository $repository)
    {
        return $repository->ano($ano);
    }

    public function andamento(ApfdRepository $repository)
    {
        return $repository->andamento();
    }

    public function andamentoAno($ano, ApfdRepository $repository)
    {
        return $repository->andamentoAno($ano);
    }

    public function prazos(ApfdRepository $repository)
    {
        return $repository->prazos();
    }

    public function prazosAno($ano)
    {
        return $repository->prazosAno($ano);
    }

    public function relSituacao(ApfdRepository $repository)
    {
        return $repository->relSituacao($ano);
    }

    public function relSituacaoAno($ano, ApfdRepository $repository)
    {
        return $repository->relSituacaoAno($ano);
    }

    public function julgamento(ApfdRepository $repository)
    {
        return $repository->julgamento();
    }

    public function julgamentoAno($ano, ApfdRepository $repository)
    {
        return $repository->julgamentoAno($ano);
    }
}
