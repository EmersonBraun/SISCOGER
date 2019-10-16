<?php

namespace App\Http\Controllers\Apresentacao;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\apresentacao\EmailRepository;

class EmailController extends Controller
{
    protected $repository;
    public function __construct(EmailRepository $repository)
	{
        $this->repository = $repository;
    }

    public function index()
    {
        $registros = $this->repository->paginate(10);
        return view('apresentacao.email.index', compact('registros'));
    }

}
