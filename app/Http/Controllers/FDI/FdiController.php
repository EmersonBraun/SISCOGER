<?php

namespace App\Http\Controllers\FDI;

use App\Http\Controllers\Controller;
use App\Repositories\PM\PolicialRepository;
use App\Services\FDIService;

class FdiController extends Controller
{
    protected $repository;
    protected $service;
    protected $pm;
    public function __construct(
        PolicialRepository $repository,
        FDIService $service
    )
	{
        $this->repository = $repository;
        $this->service = $service;
    }

    public function show($rg)
    {
        $pm = $this->repository->get($rg);

        $verOutraOPM = $this->service->verOutraOPM($pm);
        if(!$verOutraOPM) {
            toast()->error('Você não tem acesso a PPMM de outras OM');
            return redirect()->route('home');
        }

        $verSuperior = $this->service->verSuperior($pm);
        if(!$verSuperior) {
            toast()->error('Você não tem acesso a ficha de superiores');
            return redirect()->route('home');
        }

        $verInativo = $this->service->verInativo($pm);
        if(!$verInativo) {
            toast()->error('Você não tem acesso a ficha de Inativos/Reserva');
            return redirect()->route('home');
        }

        $this->service->registerAcesso($pm);

        return view('FDI.ficha', compact('pm'));
    }
  
}
