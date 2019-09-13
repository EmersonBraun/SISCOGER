<?php

namespace App\Http\Controllers\Relatorios;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PM\EnvolvidoRepository;

class RelatorioController extends Controller
{
    protected $repository;
    public function __construct(EnvolvidoRepository $repository)
	{
        $this->repository = $repository;
    }
    
    public function defensor()
    {
        $registros = $this->repository->situacao('defensor');
        return view('relatorios.defensor.index',compact('registros'));   
    }

    public function ofendido()
    {
        $registros = $this->repository->situacao('ofendido');
        return view('relatorios.ofendido.index',compact('registros'));   
    }

    public function encarregado()
    {
        $registros = $this->repository->situacao('encarregado');
        return view('relatorios.encarregado.index',compact('registros'));   
    }
}
