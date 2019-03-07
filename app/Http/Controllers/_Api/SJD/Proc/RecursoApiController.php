<?php

namespace App\Http\Controllers\_Api\SJD\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Repositories\RecursoRepository;

class RecursoApiController extends Controller
{
    public function find($id, RecursoRepository $repository)
    {
        return $repository->find($id);
    }

    public function refAno($ref, $ano, RecursoRepository $repository)
    {
        return $repository->refAno($ref, $ano);
    }

    public function all(RecursoRepository $repository)
    {
        return $repository->all();
    }

    public function ano($ano, RecursoRepository $repository)
    {
        return $repository->ano($ano);
    }

    public function andamento(RecursoRepository $repository)
    {
        return $repository->andamento();
    }

    public function andamentoAno($ano, RecursoRepository $repository)
    {
        return $repository->andamentoAno($ano);
    }

    public function prazos(RecursoRepository $repository)
    {
        return $repository->prazos();
    }

    public function prazosAno($ano)
    {
        return $repository->prazosAno($ano);
    }

    public function relSituacao(RecursoRepository $repository)
    {
        return $repository->relSituacao($ano);
    }

    public function relSituacaoAno($ano, RecursoRepository $repository)
    {
        return $repository->relSituacaoAno($ano);
    }

    public function julgamento(RecursoRepository $repository)
    {
        return $repository->julgamento();
    }

    public function julgamentoAno($ano, RecursoRepository $repository)
    {
        return $repository->julgamentoAno($ano);
    }
}
