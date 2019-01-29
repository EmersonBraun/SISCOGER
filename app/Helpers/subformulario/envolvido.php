<?php
use App\Models\Sjd\Busca\envolvido;
//para inserir dados do subformulario
if (! function_exists('envolvido')) 
{
	function envolvido($dados, $proc)
	{
        if (isset($dados['envolvido'])) {
            $envolvido = $dados['envolvido'];
            foreach ($envolvido as $e) {
                envolvido::create($e);
            }   
        }
        else
        {
            return false;
        }
	}
}