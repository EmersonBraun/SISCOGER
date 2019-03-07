<?php

namespace App\Http\Controllers\_Api\SJD\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Repositories\PadRepository;

class PadApiController extends Controller
{
    public function find($id, PadRepository $repository)
    {
        return $repository->find($id);
    }

    public function refAno($ref, $ano, PadRepository $repository)
    {
        return $repository->refAno($ref, $ano);
    }

    public function all(PadRepository $repository)
    {
        return $repository->all();
    }

    public function ano($ano, PadRepository $repository)
    {
        return $repository->ano($ano);
    }

    public function andamento(PadRepository $repository)
    {
        return $repository->andamento();
    }

    public function andamentoAno($ano, PadRepository $repository)
    {
        return $repository->andamentoAno($ano);
    }

    public function prazos(PadRepository $repository)
    {
        return $repository->prazos();
    }

    public function prazosAno($ano)
    {
        return $repository->prazosAno($ano);
    }

    public function relSituacao(PadRepository $repository)
    {
        return $repository->relSituacao($ano);
    }

    public function relSituacaoAno($ano, PadRepository $repository)
    {
        return $repository->relSituacaoAno($ano);
    }

    public function julgamento(PadRepository $repository)
    {
        return $repository->julgamento();
    }

    public function julgamentoAno($ano, PadRepository $repository)
    {
        return $repository->julgamentoAno($ano);
    }
}
