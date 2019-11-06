<?php

namespace App\Http\Controllers\Subform;

use App\Http\Controllers\Controller;
use App\Repositories\PM\PolicialRepository;

class PolicialController extends Controller
{
    protected $repository;
    public function __construct(
        PolicialRepository $repository,
    )
	{
        $this->repository = $repository;
    }

    //tempo de cahe em minutos
    private static $expiration = 60;

    //EFETIVO
    public static function efetivoOPM($unidade)
    {
        $efetivo = PolicialRepository::efetivoOPM($unidade);

        return $efetivo;
    }

    //TOTAL EFETIVO
    public static function totalEfetivoOPM($unidade)
    {
        $total_efetivo =  PolicialRepository::totalEfetivoOPM($unidade);
        //cast para objeto
        $total_efetivo = (object) $total_efetivo;

        return $total_efetivo;
    }


}
