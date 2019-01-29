<?php
//para verificar o tempo de svc em anos e meses
if (! function_exists('tempo_svc')) 
{
	function tempo_svc($data)
	{   
                if($data) 
                {
                        $dataInicio =  \Carbon\Carbon::createFromTimeString($data);
                        $dataFim = \Carbon\Carbon::now();

                        $tempo_anos = $dataInicio->diffInYears($dataFim);
                        $tempo_meses = ($dataInicio->diffInMonths($dataFim)%12);
                        
                        $ano_plural = ($tempo_anos == 1) ? 'Ano' : 'Anos';
                        $anos = ($tempo_anos > 0 ) ? $tempo_anos.' '.$ano_plural : '' ;
                        
                        $mes_plural = ($tempo_meses == 1) ? 'Mês' : 'Meses';
                        $meses = ($tempo_meses > 0 ) ? $tempo_meses.' '.$mes_plural : '' ;
                        
                        $juncao = ($tempo_anos > 0 && $tempo_meses > 0) ? ' e ' : '';

                        return $anos.$juncao.$meses;
                }
                else
                {
                        return 'N/D';
                }
	}
}