<?php

namespace App\Http\Controllers\FDI;

use App\Http\Controllers\Controller;
use App\Repositories\PM\PolicialRepository;
use App\Services\AutorizationService;
use App\Services\LogService;

class FdiController extends Controller
{
    protected $repository;
    protected $service;
    protected $autorization;
    protected $pm;
    public function __construct(
        PolicialRepository $repository,
        LogService $service,
        AutorizationService $autorization
    )
	{
        $this->repository = $repository;
        $this->service = $service;
        $this->autorization = $autorization;
    }

    public function show($rg)
    {
        $pm = $this->repository->get($rg);
        $this->autorization->canSee($pm, 'fdi');
        $this->service->fdi($pm);

        return view('FDI.ficha', compact('pm'));
    }
  
}
