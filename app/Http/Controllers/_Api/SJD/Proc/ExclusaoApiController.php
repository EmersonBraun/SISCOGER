<?php

namespace App\Http\Controllers\_Api\SJD\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Repositories\EsclusaoRepository;

class EsclusaoApiController extends Controller
{
    public function find($id, EsclusaoRepository $repository)
    {
        return $repository->find($id);
    }

    public function refAno($ref, $ano, EsclusaoRepository $repository)
    {
        return $repository->refAno($ref, $ano);
    }

    public function all(EsclusaoRepository $repository)
    {
        return $repository->all();
    }

    public function ano($ano, EsclusaoRepository $repository)
    {
        return $repository->ano($ano);
    }

    public function andamento(EsclusaoRepository $repository)
    {
        return $repository->andamento();
    }

    public function andamentoAno($ano, EsclusaoRepository $repository)
    {
        return $repository->andamentoAno($ano);
    }

    public function prazos(EsclusaoRepository $repository)
    {
        return $repository->prazos();
    }

    public function prazosAno($ano)
    {
        return $repository->prazosAno($ano);
    }

    public function relSituacao(EsclusaoRepository $repository)
    {
        return $repository->relSituacao($ano);
    }

    public function relSituacaoAno($ano, EsclusaoRepository $repository)
    {
        return $repository->relSituacaoAno($ano);
    }

    public function julgamento(EsclusaoRepository $repository)
    {
        return $repository->julgamento();
    }

    public function julgamentoAno($ano, EsclusaoRepository $repository)
    {
        return $repository->julgamentoAno($ano);
    }
}
