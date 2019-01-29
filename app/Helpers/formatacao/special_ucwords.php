<?php
//para deixar as palavras com as primeiras maíusculas sem os "De Oliveira"
if (! function_exists('special_ucwords')) 
{
	function special_ucwords($string)
	{
		$words = explode(' ', strtolower(trim(preg_replace("/\s+/", ' ', $string))));
		$return[] = ucfirst($words[0]);
		 
		unset($words[0]);
		 
		foreach ($words as $word)
		{
			if (!preg_match("/^([dn]?[aeiou][s]?|em)$/i", $word))
			{
				$word = ucfirst($word);
			}
			$return[] = $word;
		}
	 
	return implode(' ', $return);
	}
}