<?php
//para acessar as variáveis do config/sistema enviando chave e retornando o valor 
if (! function_exists('sistema')) 
{
	function sistema($array_nome, $chave)
	{
		if($chave)
		{
			return array_get(config('sistema.'.$array_nome.'','Não Há'), $chave);
		}
		else
		{
			return 'Não há';
		}
	}
}