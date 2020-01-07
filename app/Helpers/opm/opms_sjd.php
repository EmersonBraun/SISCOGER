<?php
use App\Repositories\OPM\OPMRepository;
//para acessar as variáveis do config/sistema enviando chave e retornando o valor 
if (! function_exists('opms_sjd')) 
{
	function opms_sjd()
	{
        $model = new \App\Models\rhparana\Opmpmpr;
        $model2 = new \App\Models\rhparana\Opmpmpr2;
        $opm = new OPMRepository($model, $model2);
        return $opm->get();	 
	}
}