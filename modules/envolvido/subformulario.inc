<?
$module=$_REQUEST[module];
if ($module=="ipm") $situacao="Indiciado";
if ($module=="cj") $situacao="Justificante";
if ($module=="cd" or $module=="adl") $situacao="Acusado";
if ($module=="sindicancia") $situacao="Sindicado";
if ($module=="fatd") $situacao="Acusado";
if ($module=="iso") $situacao="Paciente";
if ($module=="desercao") $situacao="Desertor";
if ($module=="apfd") $situacao="Acusado";
if ($module=="it") $situacao="Condutor";
//if ($module=="sai") $situacao="Denunciado";
if ($module=="proc_outros") $situacao="Envolvido";

if (!$situacao) $situacao="Indiciado";

?>

<table class="bordacinza" width=100% bgcolor="White" cellspacing=1>
<tbody>
	<?if ($indice==1 or !isset($indice)) { ?>
	<!-- Cabeçalho do Grid -->
	<TR><TD>RG</TD><td>Nome</td><td>Posto/Gradua&ccedil;&atilde;o</td><td>Situa&ccedil;&atilde;o</td><td>A&ccedil;&atilde;o</td></TR>
	<!-- Fim cabeçalho do Grid -->
	<? } ?>

	<TR>
	<input type="hidden" name="envolvido[<?=$indice?>][id_envolvido]">
	<input type="hidden" name="envolvido[<?=$indice?>][id_<?=$module;?>]">
	<td><input <?php echo $readonly; ?> <?php echo $opcaoGeral2;?> size="12" type="text" name="envolvido[<?=$indice;?>][rg]" onkeypress='return DigitaNumeroTempoReal(this,event)' onblur="ajaxForm(this, 'policial', Array('nome','cargo'));"></td>
	<td><input readonly type="text" size="30" name="envolvido[<?=$indice;?>][nome]"></td>
	<td><input readonly type="text" size="10" name="envolvido[<?=$indice;?>][cargo]"></td>

	<td width='160px'>
	<?php
	if ($module=="fatd" or $module=="sindicancia" or $module=="cj" or $module=="cd" or $module=="adl" or $module=="ipm") {
		echo "<input type='hidden' name='envolvido[$indice][situacao]' value='$situacao'>\r\n";
		echo "<select name='envolvido[$indice][resultado]' $opcaoGeral2>";
		$sql="SELECT * FROM resultado WHERE procedimento='$module'";
		$res=mysql_query($sql);
		echo "<option value=''>Selecione</option>";
		while ($row=mysql_fetch_assoc($res)) {
			echo "<option value='$row[resultado]'>$row[resultado]</option>";
		}
		if($module=="cj" or $module=="cd" or $module=="adl") echo "<option value='Reintegrado/Reinserido'>Reintegrado/Reinserido</option>";
		echo "</select>";

		if ($module=="fatd") echo "<a href='#none'><img width='16' valign='middle' title='Trocar resultado' border='0' src='img/trocar.gif'></a>";

		echo "</td>";
	}
	else if ($module=="sai") 
	{
		//Denunciado, Elogiado, Envolvido, Testemunha e Vítima
		echo
		"<select name='envolvido[".$indice."][situacao]'>
			<option value='Denunciado'>Denunciado</option>
			<option value='Elogiado'>Elogiado</option>
			<option value='Envolvido'>Envolvido</option>
			<option value='Testemunha'>Testemunha</option>
			<option value='Vítima'>V&iacute;tima</option>
		</select>";
	}
	else {
		echo'<input readonly type="text" size="15" name="envolvido['.$indice.'][situacao]" value='.$situacao.'></td>';
	}
	//echo '<td>';
	if($user[nivel]<4){
		echo "<td>
			<a href='javascript:removerForm(\"envolvido\",\"$indice\");'>
			<img title='Excluir' src='img/delete.png' border='0'>
			</a><img src='img/atualizar_gray.png'></td>";
	}
	else{
		echo "<img src='img/atualizar_gray.png'></td>";
	}
	/*sai
	if ($module=="sai") {
		echo "<input type='hidden' name='envolvido[$indice][situacao]' value='$situacao'>\r\n";
		echo "<select name='envolvido[$indice][resultado]' $opcaoGeral2>";
		$sql="SELECT * FROM resultado WHERE procedimento='sindicancia'";
		$res=mysql_query($sql);
		echo "<option value=''>Selecione</option>";
		while ($row=mysql_fetch_assoc($res)) {
			echo "<option value='$row[resultado]'>$row[resultado]</option>";
		}
		echo "</select>";
	}
	*/
	// if (!$opcaoGeral2) {
	// 		botao::excluir("envolvido",$indice);
	// }
	

	?>
	</td>
	</tr>

</tbody>
</table>
