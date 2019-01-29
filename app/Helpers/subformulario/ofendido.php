<?php
use App\Models\Sjd\Busca\ofendido;
//para inserir dados do subformulario
if (! function_exists('ofendido')) 
{
	function ofendido($dados, $proc)
	{
        if (isset($dados['ofendido'])) {
            $ofendido = $dados['ofendido'];
            foreach ($ofendido as $o) {
                Ofendido::create($o);
            }   
        }
        else
        {
            return false;
        }
	}
}