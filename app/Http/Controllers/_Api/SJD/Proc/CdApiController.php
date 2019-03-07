<?php

namespace App\Http\Controllers\_Api\SJD\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Repositories\CdRepository;

class CdApiController extends Controller
{
    public function find($id, CdRepository $repository)
    {
        return $repository->find($id);
    }

    public function refAno($ref, $ano, CdRepository $repository)
    {
        return $repository->refAno($ref, $ano);
    }

    public function all(CdRepository $repository)
    {
        return $repository->all();
    }

    public function ano($ano, CdRepository $repository)
    {
        return $repository->ano($ano);
    }

    public function andamento(CdRepository $repository)
    {
        return $repository->andamento();
    }

    public function andamentoAno($ano, CdRepository $repository)
    {
        return $repository->andamentoAno($ano);
    }

    public function prazos(CdRepository $repository)
    {
        return $repository->prazos();
    }

    public function prazosAno($ano)
    {
        return $repository->prazosAno($ano);
    }

    public function relSituacao(CdRepository $repository)
    {
        return $repository->relSituacao($ano);
    }

    public function relSituacaoAno($ano, CdRepository $repository)
    {
        return $repository->relSituacaoAno($ano);
    }

    public function julgamento(CdRepository $repository)
    {
        return $repository->julgamento();
    }

    public function julgamentoAno($ano, CdRepository $repository)
    {
        return $repository->julgamentoAno($ano);
    }
}
