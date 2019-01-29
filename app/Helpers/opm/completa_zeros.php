<?php
//para completar os zeros do código da OPM
if (! function_exists('completa_zeros')) 
{
	function completa_zeros($codigo)
	{
		$zeros=10-strlen($codigo);
			if ($zeros) {
				for ($i=1; $i<=$zeros; $i++) {
					$codigo.="0";
				}	
			}
		return $codigo;
	}
}