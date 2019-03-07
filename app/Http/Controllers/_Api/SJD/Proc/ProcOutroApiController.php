<?php

namespace App\Http\Controllers\_Api\SJD\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Repositories\ProcOutroRepository;

class ProcOutroApiController extends Controller
{
    public function find($id, ProcOutroRepository $repository)
    {
        return $repository->find($id);
    }

    public function refAno($ref, $ano, ProcOutroRepository $repository)
    {
        return $repository->refAno($ref, $ano);
    }

    public function all(ProcOutroRepository $repository)
    {
        return $repository->all();
    }

    public function ano($ano, ProcOutroRepository $repository)
    {
        return $repository->ano($ano);
    }

    public function andamento(ProcOutroRepository $repository)
    {
        return $repository->andamento();
    }

    public function andamentoAno($ano, ProcOutroRepository $repository)
    {
        return $repository->andamentoAno($ano);
    }

    public function prazos(ProcOutroRepository $repository)
    {
        return $repository->prazos();
    }

    public function prazosAno($ano)
    {
        return $repository->prazosAno($ano);
    }

    public function relSituacao(ProcOutroRepository $repository)
    {
        return $repository->relSituacao($ano);
    }

    public function relSituacaoAno($ano, ProcOutroRepository $repository)
    {
        return $repository->relSituacaoAno($ano);
    }

    public function julgamento(ProcOutroRepository $repository)
    {
        return $repository->julgamento();
    }

    public function julgamentoAno($ano, ProcOutroRepository $repository)
    {
        return $repository->julgamentoAno($ano);
    }
}
