<?php

namespace App\Http\Controllers\_Api\SJD\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Repositories\ItRepository;

class ItApiController extends Controller
{
    public function find($id, ItRepository $repository)
    {
        return $repository->find($id);
    }

    public function refAno($ref, $ano, ItRepository $repository)
    {
        return $repository->refAno($ref, $ano);
    }

    public function all(ItRepository $repository)
    {
        return $repository->all();
    }

    public function ano($ano, ItRepository $repository)
    {
        return $repository->ano($ano);
    }

    public function andamento(ItRepository $repository)
    {
        return $repository->andamento();
    }

    public function andamentoAno($ano, ItRepository $repository)
    {
        return $repository->andamentoAno($ano);
    }

    public function prazos()
    {
        return $repository->prazos();
    }

    public function prazosAno($ano)
    {
        return $repository->prazosAno($ano);
    }

    public function relSituacao()
    {
        return $repository->relSituacao();
    }

    public function relSituacaoAno()
    {
        return $repository->relSituacaoAno($ano);
    }

    public function julgamento()
    {
        return $repository->julgamento();
    }

    public function julgamentoAno($ano)
    {
        return $repository->julgamentoAno($ano);
    }


}
