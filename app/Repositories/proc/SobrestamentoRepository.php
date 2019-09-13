<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\proc;

use Illuminate\Support\Facades\DB;

use Cache;

use App\Repositories\BaseRepository;

class SobrestamentoRepository extends BaseRepository
{
    public function sobrestados($proc)
	{
        $unidade = session('cdopmbase');
        $verTodasUnidades = session('ver_todas_unidades');

        if($proc == 'adl') $andamento = '17';
        if($proc == 'cd') $andamento = '11';
        if($proc == 'cj') $andamento = '14';
        if($proc == 'fatd') $andamento = '3';
        if($proc == 'it') $andamento = '23';
        if($proc == 'sindicancia') $andamento = '8';

        if($verTodasUnidades)
        {
            $registros = Cache::tags('sobrestamento')->remember('sobrestament:'.$proc, 60, function() use ($proc, $andamento){
                return DB::connection('sjd')->select("SELECT DISTINCT s.*, ".$proc.".* , opm.ABREVIATURA,
                DIASUTEIS(".$proc.".abertura_data,DATE(NOW()))+1 
                AS dutotal,
                b.dusobrestado, (DIASUTEIS(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) 
                AS diasuteis FROM sobrestamento AS s
                LEFT JOIN (SELECT id_".$proc.", DIASUTEIS(inicio_data, DATE(NOW())) 
                AS dusobrestado FROM sobrestamento
                WHERE termino_data ='0000-00-00' AND inicio_data !='0000-00-00' AND id_".$proc."!='') 
                AS b ON b.id_".$proc." = s.id_".$proc."
                INNER JOIN ".$proc." ON
                        s.id_".$proc."=".$proc.".id_".$proc." 
                LEFT JOIN RHPARANA.opmPMPR AS opm ON
                        opm.CODIGOBASE=".$proc.".cdopm
                WHERE s.termino_data ='0000-00-00' AND 
                ".$proc.".id_andamento=".$andamento." ORDER BY ".$proc.".id_".$proc." DESC");
            });
        }
        else 
        {
            $registros = Cache::tags('sobrestamento')->remember('sobrestament:'.$proc.':'.$unidade, 60, function() use ($proc, $andamento, $unidade){
                return DB::connection('sjd')->select("SELECT DISTINCT s.*, ".$proc.".* , opm.ABREVIATURA,
                DIASUTEIS(".$proc.".abertura_data,DATE(NOW()))+1 
                AS dutotal,
                b.dusobrestado, (DIASUTEIS(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) 
                AS diasuteis FROM sobrestamento AS s
                LEFT JOIN (SELECT id_".$proc.", DIASUTEIS(inicio_data, DATE(NOW())) 
                AS dusobrestado FROM sobrestamento
                WHERE termino_data ='0000-00-00' AND inicio_data !='0000-00-00' AND id_".$proc."!='') 
                AS b ON b.id_".$proc." = s.id_".$proc."
                INNER JOIN ".$proc." ON
                        s.id_".$proc."=".$proc.".id_".$proc." 
                LEFT JOIN RHPARANA.opmPMPR AS opm ON opm.CODIGOBASE=".$proc.".cdopm
                WHERE s.termino_data ='0000-00-00' 
                AND ".$proc.".cdopm LIKE ".$unidade."%
                AND ".$proc.".id_andamento=".$andamento." ORDER BY ".$proc.".id_".$proc." DESC");
            });
        }

        return $registros;
    } 

}

