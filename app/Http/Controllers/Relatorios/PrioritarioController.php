<?php

namespace App\Http\Controllers\Relatorios;

use App\Http\Controllers\Controller;
use App\Repositories\proc\ProcRepository;

class PrioritarioController extends Controller
{
    protected $repository;
    public function __construct(ProcRepository $repository)
	{
		$this->repository = $repository;
    }

    public function index($proc) 
    {
        $registros = $this->repository->prioritario($proc);
        return view('relatorios.prioritario.index',compact('registros','proc'));
    }
}
