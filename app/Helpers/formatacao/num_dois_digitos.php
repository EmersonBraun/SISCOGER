<?php
//para deixar o nome extenso do procedimento
if (! function_exists('num_dois_digitos')) 
{
	function num_dois_digitos($num, $mes=false)
	{
        $num = (int) $num;
        if($num < 0) return "01";
        if($num < 10) return "0$num";
        if($num > 12 && $mes) return "12";
        if($num > 99) return "99";
	}
}