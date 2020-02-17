<?php
//para transformar data BR (dd/mm/aaaa) para formato bd (aaaa-mm-dd)
if (! function_exists('data_bd')) 
{
    function data_bd($date, $hora=false){
        if($date)
        {
            // só executa caso já não esteja no formato do banco de dados
            if (substr($date, 2, 1) == '/') {
                $ex = explode('/', $date);
                $data = "$ex[2]-$ex[1]-$ex[0]";
            }     
        }
        else
        {
            $data = '0000-00-00';
        }
        return $data; 
    }

}