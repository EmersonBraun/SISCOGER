<?php

namespace App\Http\Controllers\Ajuda;

use App\Http\Controllers\Controller;
use App\Services\ICOService;

class ICOController extends Controller
{
    protected $ico;
    public function __construct(ICOService $ico)
	{
        $this->ico = $ico;
    }

    public function formatacao($funcao, $dado)
    {
        try {
            $data = $this->ico->$funcao($dado);
        } catch (\Throwable $th) {
            $data = 'Função Não existe';
            //throw $th;
        }

        return response()->json($data, 200);
    }
}
