<?php

namespace App\Http\Controllers\_Api\SJD\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Repositories\SobrestamentoRepository;

class SobrestamentoApiController extends Controller
{
    public function find($id, SobrestamentoRepository $repository)
    {
        return $repository->find($id);
    }

    public function refAno($ref, $ano, SobrestamentoRepository $repository)
    {
        return $repository->refAno($ref, $ano);
    }

    public function all(SobrestamentoRepository $repository)
    {
        return $repository->all();
    }

    public function ano($ano, SobrestamentoRepository $repository)
    {
        return $repository->ano($ano);
    }

    public function andamento(SobrestamentoRepository $repository)
    {
        return $repository->andamento();
    }

    public function andamentoAno($ano, SobrestamentoRepository $repository)
    {
        return $repository->andamentoAno($ano);
    }

    public function prazos(SobrestamentoRepository $repository)
    {
        return $repository->prazos();
    }

    public function prazosAno($ano)
    {
        return $repository->prazosAno($ano);
    }

    public function relSituacao(SobrestamentoRepository $repository)
    {
        return $repository->relSituacao($ano);
    }

    public function relSituacaoAno($ano, SobrestamentoRepository $repository)
    {
        return $repository->relSituacaoAno($ano);
    }

    public function julgamento(SobrestamentoRepository $repository)
    {
        return $repository->julgamento();
    }

    public function julgamentoAno($ano, SobrestamentoRepository $repository)
    {
        return $repository->julgamentoAno($ano);
    }
}
