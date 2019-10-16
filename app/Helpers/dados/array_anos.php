<?php
//para criar array para anos
if (! function_exists('array_anos')) 
{
	function array_anos($inicio,$ordemCrescente=false)
	{
        if($ordemCrescente) {
            for ($i=$inicio; $i <= (int) date('Y'); $i++) { 
                $anos[$i] = $i;
            }
        } else {
            for ($i=(int) date('Y'); $i >= $inicio; $i--) { 
                $anos[$i] = $i;
            }
        }

        return $anos;
        
    }

}