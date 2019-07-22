<?
$module=$_REQUEST[module];
if ($module=="sai") $situacao="Envolvida";

if (!$situacao) $situacao="Indiciado";

?>

<table class="bordacinza" width=100% bgcolor="White" cellspacing=1>
<tbody>
	<?if ($indice==1 or !isset($indice) or $module=="sai") { ?> 
	<!-- Cabeçalho do Grid -->
	<TR><TD>Placa</TD><td>Prefixo</td><td></td></TR>
	<!-- Fim cabeçalho do Grid -->
	<? } ?>
	
	<TR>
	<input type="hidden" name="viaturaenvolvida[<?=$indice?>][id_viaturaenvolvida]">
	<input type="hidden" name="viaturaenvolvida[<?=$indice?>][id_<?=$module;?>]">
	<td><input size="15" type="text" name="viaturaenvolvida[<?=$indice;?>][placa]"></td>
	<td><input type="text" size="30" name="viaturaenvolvida[<?=$indice;?>][prefixo]"></td>
	<td><input readonly type="text" size="15" name="viaturaenvolvida[<?=$indice;?>][situacao]" value='<? echo $situacao;?>'></td> 	<td><?botao::excluir("envolvido",$indice);?></td>
	</TR>
</tbody>
</table>