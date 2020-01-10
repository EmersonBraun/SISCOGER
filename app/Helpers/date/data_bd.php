<?php
//para transformar data BR (dd/mm/aaaa) para formato bd (aaaa-mm-dd)
if (! function_exists('data_bd')) 
{
    function data_bd($date, $hora=false){
        if($date)
        {
            // só executa caso já não esteja no formato do banco de dados
            $data = (substr($date, 2, 1) == '/') ? date( 'Y-m-d' , strtotime($date)) : $date;     
        }
        else
        {
            $data = '0000-00-00';
        }
        return $data; 
    }

}