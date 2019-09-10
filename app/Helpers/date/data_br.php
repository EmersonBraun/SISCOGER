<?php
//para transformar data bd (aaaa-mm-dd) para formato BR (dd/mm/aaaa)
if (! function_exists('data_br')) 
{
    function data_br($date,$h=0){
        if($date == "0000-00-00")return '';
        if($date == "null" || $date == null || !$date)return '';
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
