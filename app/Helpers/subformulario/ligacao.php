<?php
use App\Models\Sjd\Busca\Ligacao;
//para inserir dados do subformulario
if (! function_exists('ligacao')) 
{
	function ligacao($dados, $proc)
	{
        if (isset($dados['ligacao'])) {
            $ligacao = $dados['ligacao'];
            foreach ($ligacao as $l) {
                $l['id_'.$proc] = $id;
                $l['origem_proc'] = $proc;
                $l['origem_sjd_ref'] = $l['sjd_ref'];
                $l['origem_sjd_ref_ano'] = $l['sjd_ref_ano'];
                $l['origem_opm'] = session('opm_descricao');
                Ligacao::create($l);
            }   
        }
        else
        {
            return false;
        }
	}
}