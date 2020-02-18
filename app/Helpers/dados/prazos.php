<?php
if (! function_exists('prazos')) 
{
	function prazos($registro, $tempo=30, $perc=0.7)
	{
        $andamento = sistema('andamento',$registro["id_andamento"]);
        if ($andamento == 'ANDAMENTO') {
            if ($registro['dutotal']){
                $percDoTotal = ceil($tempo * $perc);
                if ($registro["diasuteis"]>$tempo) return "<span class='label label-danger'>".$registro['diasuteis']."</span>";
                if ($registro["diasuteis"]>$percDoTotal) return "<span class='label label-warning'>".$registro['diasuteis']."</span>";
                return "<span class='label label-success'>".$registro['diasuteis']."</span>";
            } else {
                return "<span class='label label-warning'>S/Data abertura</span>";
            }
        } else {
            return "<span class='label label-success'>".ucfirst($andamento)."</span>";
        }
    }

}