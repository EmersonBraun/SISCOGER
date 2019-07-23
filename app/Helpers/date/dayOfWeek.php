
<?php
use Illuminate\Support\Carbon;
//para mostrar qual dia da semana
if (! function_exists('dayOfWeek')) 
{
    function dayOfWeek($date){
        $weekMap = [
            0 => 'Domingo',
            1 => 'Segunda-feira',
            2 => 'Terça-feira',
            3 => 'Quarta-feira',
            4 => 'Quinta-feira',
            5 => 'Sexta-feira',
            6 => 'Sábado',
        ];
        $d = Carbon::parse(data_bd($date));
        $dayOfTheWeek = $d->dayOfWeek;
        return $weekMap[$dayOfTheWeek]; 
    }

}


