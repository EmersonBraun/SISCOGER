<?php
//para transformar data bd (aaaa-mm-dd) para formato BR (dd/mm/aaaa)
if (! function_exists('data_br')) 
{
    function data_br($date,$h=0){
        $data = date( 'd/m/Y' , strtotime($date));
        //para evitar caso a data for inexistente
        if($data == "30/11/-0001")
        {
            return '';
        }
        else
        {
            //se tiver hora junto
            if($h != 0)
            {
                return date( 'd/m/Y H:i:s' , strtotime($date));
            }
            //se for apenas data
            else
            {
                return date( 'd/m/Y' , strtotime($date));
            }
        }
    }
}
