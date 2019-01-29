<?php
use App\Models\Sjd\Administracao\Feriado as Feriado;
//para verificar a difernça de dias
if (! function_exists('dif_dias')) 
{
	function dif_dias($inicio, $fim, $tipo)
	{    
        $fim = (isset($fim)) ? \Carbon\Carbon::now() : $fim;

        if($tipo != 'uteis' || $tipo == '')
        {
            return $intervalo_total = $inicio->diffInDays($fim);
        }
        else
        {
            $feriados = Feriado::whereBetween('data', [$inicio, $fim])->count();
            $intervalo_total = $inicio->diffInDays($fim);
            $dias_uteis = ($intervalo_total - $feriados);
            return  $dias_uteis;
        }

	}
}