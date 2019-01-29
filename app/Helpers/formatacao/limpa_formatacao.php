<?php
//para deixar as palavras sem acentos
if (! function_exists('limpa_formatacao')) 
{
	function limpa_formatacao($string)
	{

	$string = preg_replace(
		array(
			'/[,(),;:|!"#$%&/=?~^><ªº-]/',
			'/[^a-z0-9]/i',
			'/_+/'
			),
		" ",$string); 

    return $string_limpa;

	}
}


