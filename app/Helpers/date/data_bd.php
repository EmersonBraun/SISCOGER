<?php
//para transformar data BR (dd/mm/aaaa) para formato bd (aaaa-mm-dd)
if (! function_exists('data_bd')) 
{
    function data_bd($date){
        if($date != '' || $date != NULL )
        {
            $ano= substr($date, 6);
            $mes= substr($date, 3,-5);
            $dia= substr($date, 0,-8);

            $data = $ano."-".$mes."-".$dia;
            
        }
        else
        {
            $data = '0000-00-00';
        }
        

        return $data; 
    }

}