<?php
//para cortar os zeros do código da OPM
if (! function_exists('corta_zeros')) 
{
	function corta_zeros($codigo)
	{
		$opmRetorno ="";
		
		if(trim($codigo)=="0000000000") 
		{
			return "0";
		}
		else
		{
			$Zopm[1]=substr($codigo,0,1);
			$Zopm[2]=substr($codigo,1,2);
			$Zopm[3]=substr($codigo,3,2);
			$Zopm[4]=substr($codigo,5,1);
			$Zopm[5]=substr($codigo,6,2);
			$Zopm[6]=substr($codigo,8,2);

			$x=0;

			for ($i=6; $i>=1; $i--) 
			{
				if ($Zopm[$i]!="0" and $Zopm[$i]!="00" and $Zopm[$i]!="  ") 
				{
					for ($yi=1; $yi<=$i; $yi++) $opmRetorno.=$Zopm[$yi];
					return $opmRetorno;
				}
			}

			if ($opmRetorno=="") return "0";
		}
	}
}