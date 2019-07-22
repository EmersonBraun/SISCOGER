<?
$module=$_REQUEST[module];
if ($module=="ipm") $situacao="Indiciado";
if ($module=="cj") $situacao="Justificante";
if ($module=="cd" or $module=="adl") $situacao="Acusado";
if ($module=="sindicancia") $situacao="Acusado";
if ($module=="fatd") $situacao="Acusado";
if ($module=="iso") $situacao="Paciente";
if ($module=="desercao") $situacao="Desertor";

if (!$situacao) $situacao="Indiciado";

?>

<table class="bordacinza" width=100% bgcolor="White" cellspacing=1>
<tbody>
	<?if ($indice==1 or !isset($indice)) { ?> 
	<!-- Cabeçalho do Grid -->
	<TR><TD>RG</TD><td>Nome</td><td>Posto/Gradua&ccedil;&atilde;o</td><td>Situa&ccedil;&atilde;o</td><td></td></TR>
	<!-- Fim cabeçalho do Grid -->
	<? } ?>
	
	<TR>
	<input type="hidden" name="envolvido[<?=$indice?>][id_envolvido]">
	<input type="hidden" name="envolvido[<?=$indice?>][id_<?=$module;?>]">
	<td><input size="15" type="text" name="envolvido[<?=$indice;?>][rg]" onblur="ajaxForm(this, 'policial', Array('nome','cargo'));"></td>
	<td><input readonly type="text" size="30" name="envolvido[<?=$indice;?>][nome]"></td>
	<td><input readonly type="text" size="10" name="envolvido[<?=$indice;?>][cargo]"></td>
	<td><input readonly type="text" size="15" name="envolvido[<?=$indice;?>][situacao]" value='<? echo $situacao;?>'></td> 	<td><?botao::excluir("envolvido",$indice);?></td>
	</TR>
</tbody>
</table>
