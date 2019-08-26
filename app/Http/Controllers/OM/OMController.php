<?php

namespace App\Http\Controllers\OM;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PM\ComportamentoRepository;
use App\Repositories\OPM\OPMRepository;

class OMController extends Controller
{
    protected $repository;

    public function __construct(OPMRepository $repository)
	{
        $this->repository = $repository;
    }

    public function index()
    {
        $registros = $this->repository->all();
        return view('OM.index', compact('registros'));
    }
}
