<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\proc;

use Cache;
use Illuminate\Support\Facades\DB;

class ProcRepository
{
    public function prioritario($proc)
    {
        return DB::table($proc)->where('prioridade',1)->get(); 
    }

}

