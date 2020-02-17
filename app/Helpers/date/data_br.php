<?php
//para transformar data bd (aaaa-mm-dd) para formato BR (dd/mm/aaaa)
if (! function_exists('data_br')) 
{
    function data_br($date,$h=0){
        $errados = ['1970-01-01 00:00:00','1970-01-01','0000-00-00'];
        if(in_array($date, $errados) || !$date) return '';
        if($h !== 0) {
            return date( 'd/m/Y H:i:s' , strtotime($date));
        }
        $data = date( 'd/m/Y' , strtotime($date));
        if(
            $date == "30/11/-0001" ||
            $date == '-0001-11-30 00:00:00'
        ) return '';
        else return $data;
    }
}
