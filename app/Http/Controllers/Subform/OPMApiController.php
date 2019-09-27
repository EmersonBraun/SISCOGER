<?php

namespace App\Http\Controllers\Subform;

use App\Http\Controllers\Controller;

use Cache;
use App\Models\rhparana\Opmpmpr;
use App\Repositories\OPM\OPMRepository;

class OPMApiController extends Controller
{
    protected $repository;
    public function __construct(
        OPMRepository $repository
    )
	{
        $this->repository = $repository;
    }

    public static function get()
    {
        $opms = OPMRepository::get();
        return $opms;
    }

    public static function codigo($codigo)
    {
        $opms = $this->repository->all();
        return array_get($opms, $codigo);
    }

    public function omsjd($name)
    {
        $omsjd = $this->repository->getByName($name);
        return $omsjd;
    }
   

}
