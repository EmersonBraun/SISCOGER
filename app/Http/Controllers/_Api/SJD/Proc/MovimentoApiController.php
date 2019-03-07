<?php

namespace App\Http\Controllers\_Api\SJD\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Repositories\MovimentoRepository;

class MovimentoApiController extends Controller
{
    public function find($id, MovimentoRepository $repository)
    {
        return $repository->find($id);
    }

    public function refAno($ref, $ano, MovimentoRepository $repository)
    {
        return $repository->refAno($ref, $ano);
    }

    public function all(MovimentoRepository $repository)
    {
        return $repository->all();
    }

    public function ano($ano, MovimentoRepository $repository)
    {
        return $repository->ano($ano);
    }

    public function andamento(MovimentoRepository $repository)
    {
        return $repository->andamento();
    }

    public function andamentoAno($ano, MovimentoRepository $repository)
    {
        return $repository->andamentoAno($ano);
    }

    public function prazos(MovimentoRepository $repository)
    {
        return $repository->prazos();
    }

    public function prazosAno($ano)
    {
        return $repository->prazosAno($ano);
    }

    public function relSituacao(MovimentoRepository $repository)
    {
        return $repository->relSituacao($ano);
    }

    public function relSituacaoAno($ano, MovimentoRepository $repository)
    {
        return $repository->relSituacaoAno($ano);
    }

    public function julgamento(MovimentoRepository $repository)
    {
        return $repository->julgamento();
    }

    public function julgamentoAno($ano, MovimentoRepository $repository)
    {
        return $repository->julgamentoAno($ano);
    }
}
