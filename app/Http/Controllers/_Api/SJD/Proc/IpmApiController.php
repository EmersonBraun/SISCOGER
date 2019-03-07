<?php

namespace App\Http\Controllers\_Api\SJD\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Repositories\IpmRepository;

class IpmApiController extends Controller
{
    public function find($id, IpmRepository $repository)
    {
        return $repository->find($id);
    }

    public function refAno($ref, $ano, IpmRepository $repository)
    {
        return $repository->refAno($ref, $ano);
    }

    public function all(IpmRepository $repository)
    {
        return $repository->all();
    }

    public function ano($ano, IpmRepository $repository)
    {
        return $repository->ano($ano);
    }

    public function andamento(IpmRepository $repository)
    {
        return $repository->andamento();
    }

    public function andamentoAno($ano, IpmRepository $repository)
    {
        return $repository->andamentoAno($ano);
    }

    public function prazos(IpmRepository $repository)
    {
        return $repository->prazos();
    }

    public function prazosAno($ano)
    {
        return $repository->prazosAno($ano);
    }

    public function relSituacao(IpmRepository $repository)
    {
        return $repository->relSituacao($ano);
    }

    public function relSituacaoAno($ano, IpmRepository $repository)
    {
        return $repository->relSituacaoAno($ano);
    }

    public function julgamento(IpmRepository $repository)
    {
        return $repository->julgamento();
    }

    public function julgamentoAno($ano, IpmRepository $repository)
    {
        return $repository->julgamentoAno($ano);
    }
}
