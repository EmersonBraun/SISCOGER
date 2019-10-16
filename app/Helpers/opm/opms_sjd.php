<?php
use App\Repositories\OPM\OPMRepository;
//para acessar as variáveis do config/sistema enviando chave e retornando o valor 
if (! function_exists('opms_sjd')) 
{
	function opms_sjd()
	{
        $model = new \App\Models\rhparana\Opmpmpr;
        $opm = new OPMRepository($model);
        return $opm->get();	 
	}
}