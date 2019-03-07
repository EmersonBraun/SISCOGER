<?php

namespace App\Http\Controllers\_Api\SJD\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Repositories\IsoRepository;

class IsoApiController extends Controller
{
    public function find($id, IsoRepository $repository)
    {
        return $repository->find($id);
    }

    public function refAno($ref, $ano, IsoRepository $repository)
    {
        return $repository->refAno($ref, $ano);
    }

    public function all(IsoRepository $repository)
    {
        return $repository->all();
    }

    public function ano($ano, IsoRepository $repository)
    {
        return $repository->ano($ano);
    }

    public function andamento(IsoRepository $repository)
    {
        return $repository->andamento();
    }

    public function andamentoAno($ano, IsoRepository $repository)
    {
        return $repository->andamentoAno($ano);
    }

    public function prazos(IsoRepository $repository)
    {
        return $repository->prazos();
    }

    public function prazosAno($ano)
    {
        return $repository->prazosAno($ano);
    }

    public function relSituacao(IsoRepository $repository)
    {
        return $repository->relSituacao($ano);
    }

    public function relSituacaoAno($ano, IsoRepository $repository)
    {
        return $repository->relSituacaoAno($ano);
    }

    public function julgamento(IsoRepository $repository)
    {
        return $repository->julgamento();
    }

    public function julgamentoAno($ano, IsoRepository $repository)
    {
        return $repository->julgamentoAno($ano);
    }
}
