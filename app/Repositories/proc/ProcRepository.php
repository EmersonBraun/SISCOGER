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

    public function procedimentos($rg)
    {
        $envolvido = DB::table('envolvido')
        ->select('envolvido.rg',
                'envolvido.rg_substituto',
                'envolvido.nome',
                'envolvido.situacao',
                'envolvido.resultado',
                'envolvido.id_ipm',
                'envolvido.id_cj',
                'envolvido.id_cd',
                'envolvido.id_adl',
                'envolvido.id_sindicancia',
                'envolvido.id_fatd',
                'envolvido.id_desercao',
                'envolvido.id_apfd',
                'envolvido.id_iso',
                'envolvido.id_it',
                'envolvido.id_pad',
                'envolvido.id_proc_outros')
                ->where('rg','=', $rg);

        $procedimentos = DB::table('ofendido')
                ->unionAll($envolvido)
                ->select(DB::raw('rg, rg as rg2,
                ofendido.nome,
                ofendido.situacao,
                ofendido.resultado,
                ofendido.id_ipm,
                ofendido.id_cj,
                ofendido.id_cd,
                ofendido.id_adl,
                ofendido.id_sindicancia,
                ofendido.id_fatd,
                ofendido.id_desercao,
                ofendido.id_apfd,
                ofendido.id_iso,
                ofendido.id_it,
                ofendido.id_pad,
                ofendido.id_proc_outros'))
                ->where('rg','=', $rg)
                ->get();


        return $procedimentos;
    }

}

