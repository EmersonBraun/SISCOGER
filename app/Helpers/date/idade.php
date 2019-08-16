<?php
//para verificar a idade em anos
if (! function_exists('idade')) 
{
	function idade($data)
	{   
                if($data) 
                {
                        $inicio = \Carbon\Carbon::parse($data);;
                        // $inicio =  \Carbon\Carbon::createFromTimeString($data);
                        $dataFinal = \Carbon\Carbon::now();
                        return $inicio->diffInYears($dataFinal);
                }
                else
                {
                        return 'N/D';
                }
	}
}