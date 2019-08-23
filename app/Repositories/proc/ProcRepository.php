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

    public function getById($proc, $id)
    {
        return DB::table($proc)->where('id_'.$proc,$id)->first(); 
    }

    public function getByRefAno($proc, $ref, $ano)
    {
        return DB::table($proc)->where([['sjd_ref',$ref],['sjd_ref_ano',$ano]])->first(); 
    }

}

