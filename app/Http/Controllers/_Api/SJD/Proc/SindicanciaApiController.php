<?php

namespace App\Http\Controllers\_Api\SJD\Proc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Repositories\SindicanciaRepository;

class SindicanciaApiController extends Controller
{
    public function find($id, SindicanciaRepository $repository)
    {
        return $repository->find($id);
    }

    public function refAno($ref, $ano, SindicanciaRepository $repository)
    {
        return $repository->refAno($ref, $ano);
    }

    public function all(SindicanciaRepository $repository)
    {
        return $repository->all();
    }

    public function ano($ano, SindicanciaRepository $repository)
    {
        return $repository->ano($ano);
    }

    public function andamento(SindicanciaRepository $repository)
    {
        return $repository->andamento();
    }

    public function andamentoAno($ano, SindicanciaRepository $repository)
    {
        return $repository->andamentoAno($ano);
    }

    public function prazos(SindicanciaRepository $repository)
    {
        return $repository->prazos();
    }

    public function prazosAno($ano)
    {
        return $repository->prazosAno($ano);
    }

    public function relSituacao(SindicanciaRepository $repository)
    {
        return $repository->relSituacao($ano);
    }

    public function relSituacaoAno($ano, SindicanciaRepository $repository)
    {
        return $repository->relSituacaoAno($ano);
    }

    public function julgamento(SindicanciaRepository $repository)
    {
        return $repository->julgamento();
    }

    public function julgamentoAno($ano, SindicanciaRepository $repository)
    {
        return $repository->julgamentoAno($ano);
    }
}
