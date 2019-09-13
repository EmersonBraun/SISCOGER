<?php

namespace App\Http\Controllers\Relatorios;

use App\Http\Controllers\Controller;
use App\Repositories\proc\SobrestamentoRepository;

class SobrestamentoController extends Controller
{
    protected $repository;

    public function __construct(SobrestamentoRepository $repository)
	{
        $this->repository = $repository;
    }

    public function index($proc) 
    {
        $registros = $this->repository->sobrestados($proc);
        return view('relatorios.sobrestamento.index',compact('registros','proc'));
    }

}
