<?php

namespace App\Http\Controllers\Log;
use App\Http\Controllers\Controller;

use App\Repositories\log\logRepository;
class LogController extends Controller
{
    protected $repository;

    public function __construct(logRepository $repository)
	{
        $this->repository = $repository;
    }

    public function created($name)
    {
        $logs = $this->repository->created($name);
        if($name == 'acessos' || $name == 'bloqueios' || $name == 'fdi') return view('logs.'.$name,compact('logs'));
        $page = 'created';
        return view('logs.created',compact('logs','name','page'));
    }

    public function updated($name)
    {
        $logs = $this->repository->updated($name);
        $page = 'updated';
        return view('logs.updated',compact('logs','name','page'));
    }

    public function deleted($name)
    {
        $logs = $this->repository->deleted($name);
        $page = 'deleted';
        return view('logs.deleted',compact('logs','name','page'));
    }

    public function restored($name)
    {
        $logs = $this->repository->restored($name);
        $page = 'restored';
        return view('logs.restored',compact('logs','name','page'));
    }

}
