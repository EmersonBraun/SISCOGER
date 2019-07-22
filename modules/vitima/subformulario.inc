<?
if ($module=="it")
	$envolvimento="Condutor civil";
else 
	$envolvimento="V&iacute;tima";
?>

<table class="bordacinza" width=100% bgcolor="White">
<tbody>
	<!-- Cabeçalho do Grid -->
	<TR><TD>RG</TD><td>Nome</td><td>Situa&ccedil;&atilde;o</td><td></td></TR>
	<!-- Fim cabeçalho do Grid -->
	
	<TR>
	<input type="hidden" name="vitima[<?=$indice?>][id_vitima]">
	<input type="hidden" name="vitima[<?=$indice?>][id_cj]">
	<td><input type="text" name="vitima[<?=$indice;?>][rg]"></td>
	<td><input type="text" size="40" name="vitima[<?=$indice;?>][nome]"></td>
	<td><input readonly type="text" size="15" name="vitima[<?=$indice;?>][situacao]" value="V&iacute;tima"></td>
	<td><?botao::excluir("vitima",$indice);?></td>
	</TR>
</tbody>
</table>
