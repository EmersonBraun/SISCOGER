<?php
//para pegado do 'id_proc' a parte 'proc'
if (! function_exists('nome_por_id')) 
{
	function nome_por_id($nome_id)
	{
        $proc = substr_replace($nome_id,'',0,3);

        return $proc;
        
    }

}