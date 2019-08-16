<?php

namespace App\Http\Controllers\Policiais;

use App\Http\Controllers\Controller;
use App\Repositories\PM\TransferidoRepository;

class TransferidoController extends Controller
{
    protected $repository;
    public function __construct(TransferidoRepository $repository)
	{
        $this->repository = $repository;
    }

    public function transferencias($copm)
    {
        return $this->repository->transferencias($copm);
    }

}
