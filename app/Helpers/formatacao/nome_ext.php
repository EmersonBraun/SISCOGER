<?php
//para deixar o nome extenso do procedimento
if (! function_exists('nome_ext')) 
{
	function nome_ext($chave)
	{
		if($chave)
		{
            $chave = tira_acentos($chave);
			return array_get(config('sistema.procedimentosTipos','Não Há'), strtoupper($chave));
		}
		else
		{
			return 'Não há';
		}
	}
}