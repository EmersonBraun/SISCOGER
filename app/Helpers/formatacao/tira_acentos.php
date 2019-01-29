<?php
//para deixar as palavras sem acentos
if (! function_exists('tira_acentos')) 
{
	function tira_acentos($string)
	{

	$string_limpa = preg_replace(
		array(
			"/(á|à|ã|â|ä)/",
			"/(Á|À|Ã|Â|Ä)/",
			"/(é|è|ê|ë)/",
			"/(É|È|Ê|Ë)/",
			"/(í|ì|î|ï)/",
			"/(Í|Ì|Î|Ï)/",
			"/(ó|ò|õ|ô|ö)/",
			"/(Ó|Ò|Õ|Ô|Ö)/",
			"/(ú|ù|û|ü)/",
			"/(Ú|Ù|Û|Ü)/",
			"/(ñ)/",
			"/(Ñ)/",
			"/(ç)/",
			"/(Ç)/"
			),
		explode(" ","a A e E i I o O u U n N c C"),$string);
    
    return $string_limpa;

	}
}