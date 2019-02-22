<?php
//para transformar data BR (dd/mm/aaaa) para formato bd (aaaa-mm-dd)
if (! function_exists('data_bd')) 
{
    function data_bd($date){
        if($date != '' || $date != NULL )
        {
            // só executa caso já não esteja no formato do banco de dados
            if(substr($date, 2, 1) == '/')
            {
                $ano= substr($date, 6);
                $mes= substr($date, 3,-5);
                $dia= substr($date, 0,-8);

                $data = $ano."-".$mes."-".$dia;
            }
            else
            {
                $data = $date;
            }
            
        }
        else
        {
            $data = '0000-00-00';
        }
        
        return $data; 
    }

}