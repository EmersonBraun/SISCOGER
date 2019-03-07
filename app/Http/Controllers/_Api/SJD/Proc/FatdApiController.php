<?php

namespace App\Http\Controllers\_Api\SJD\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Repositories\FatdRepository;

class FatdApiController extends Controller
{
    public function find($id, FatdRepository $repository)
    {
        return $repository->find($id);
    }

    public function refAno($ref, $ano, FatdRepository $repository)
    {
        return $repository->refAno($ref, $ano);
    }

    public function all(FatdRepository $repository)
    {
        return $repository->all();
    }

    public function ano($ano, FatdRepository $repository)
    {
        return $repository->ano($ano);
    }

    public function andamento(FatdRepository $repository)
    {
        return $repository->andamento();
    }

    public function andamentoAno($ano, FatdRepository $repository)
    {
        return $repository->andamentoAno($ano);
    }

    public function prazos(FatdRepository $repository)
    {
        return $repository->prazos();
    }

    public function prazosAno($ano)
    {
        return $repository->prazosAno($ano);
    }

    public function relSituacao(FatdRepository $repository)
    {
        return $repository->relSituacao($ano);
    }

    public function relSituacaoAno($ano, FatdRepository $repository)
    {
        return $repository->relSituacaoAno($ano);
    }

    public function julgamento(FatdRepository $repository)
    {
        return $repository->julgamento();
    }

    public function julgamentoAno($ano, FatdRepository $repository)
    {
        return $repository->julgamentoAno($ano);
    }
}
