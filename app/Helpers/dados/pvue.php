<?php
//para acessar as variáveis do config/sistema enviando chave e retornando o valor 
if (! function_exists('pvue')) 
{
	function pvue($array_nome)
	{
		if($array_nome)
		{
            $dados = config('sistema.'.$array_nome.'');

            $return = '[';
            foreach ($dados as $key => $value) {
                $return .= "{val: $key, label: '$value'},";
            }
            $return .= ']';

			return   $return;
		}
		else
		{
			return 'Não há';
		}
	}
}