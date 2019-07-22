<?

$module=$_REQUEST['module'];
//echo $indice;
?>

<table class="bordacinza" width=100% bgcolor="White">
<tbody>
	<!-- Cabeçalho do Grid -->
	<tr>
		<?php
		if ($indice==1 || $module == "sai" || $module == "proc_outros")  {
		echo "<td>RG</td>";
		echo "<td>Nome</td>";
		if ($module=="ipm") echo "<td>Resultado</td>";
		echo "<td>Sexo</td>";
		echo "<td>Acao</td>";
		}
		?>
	</tr>
	<!-- Fim cabeçalho do Grid -->
	
	<TR>
	<input type="hidden" name="ofendido[<?=$indice?>][id_ofendido]">

	<?
	if ($module=="ipm")
		echo "<input type=\"hidden\" name=\"ofendido[$indice][id_ipm]\">";
	if ($module=="cj")
		echo "<input type=\"hidden\" name=\"ofendido[$indice][id_cj]\">";
	if ($module=="cd")
		echo "<input type=\"hidden\" name=\"ofendido[$indice][id_cd]\">";
	if ($module=="it") 
		echo "<input type=\"hidden\" name=\"ofendido[$indice][id_it]\">";
	if ($module=="sai") 
		echo "<input type=\"hidden\" name=\"ofendido[$indice][id_sai]\">";
	if ($module=="proc_outros") 
		echo "<input type=\"hidden\" name=\"ofendido[$indice][id_proc_outros]\">";

	
	
	if ($module=="it")
		$envolvimento="Condutor Civil";
	elseif ($module=="pad")
		$envolvimento="Envolvido";
	elseif ($module=="sai" || $module=="proc_outros")
		$envolvimento="";
	else
		$envolvimento="Ofendido";

	//echo $module;

	echo "<td><input type=\"text\" size='12' name=\"ofendido[".$indice."][rg]\" $opcaoGeral2></td>";
	echo "<td><input type=\"text\" size=\"30\" name=\"ofendido[".$indice."][nome]\" $opcaoGeral2></td>";
	if($module!=="sai" && $module!=="proc_outros"){
		echo "<td><input type=\"hidden\" name=\"ofendido[".$indice."][situacao]\" value='$envolvimento'></td>";
	}


	/*
	echo "<td><select onchange='document.getElementsByName(\"ofendido[".$indice."][nome]\")[0].value=this.value' $opcaoGeral2><option>Pre-definidas</option><option value='ADMINISTRACAO PUBLICA'>ADM PUBLICA</option></select></td>";*/

	if ($module=="ipm") {
		echo "<td>";
		echo "<select name='ofendido[$indice][resultado]' $opcaoGeral2>";
			echo "<option value='NA'>Selecione</option>";
			echo "<option value='Sem lesao'>Sem lesao</option>";
			echo "<option value='Obito'>Obito</option>";
			echo "<option value='Lesao corporal'>Lesao corporal</option>";
		echo "</select>";
		echo "</td>";
	}

	echo "<td><select name='ofendido[".$indice."][sexo]' $opcaoGeral2>";
		echo "<option value=''>Escolha</option>";
		echo "<option value='M'>Masculino</option>";
		echo "<option value='F'>Feminino</option>";
	echo "</select></td>";

	echo "<td>";
		if (!$opcaoGeral2) botao::excluir("ofendido",$indice);
	echo "</td>";
echo "</TR>";
echo "<tr>";

if ($module=="sai") 
{
	echo "<td>Fone:
			<input size='10' maxlength='20' name='ofendido[".$indice."][fone]' type='text' $opcaoGeral2>
		</td>";
	echo "<td>E-mail:
			<input size='20' maxlength='40' name='ofendido[".$indice."][email]' type='text' $opcaoGeral2>
		</td>";
}
else
{
	echo "
	<td>Idade:
		<input size='3' maxlength='3' name='ofendido[".$indice."][idade]' type='text' $opcaoGeral2>
	</td>
	<td>Escolaridade:
		<select name='ofendido[".$indice."][escolaridade]' $opcaoGeral2>
			<option value=''>Selecione</option>
			<option>Analfabeto</option>
			<option>Fundamental Incompleto</option>
			<option>Fundamental Completo</option>
			<option>M&eacute;dio Incompleto</option>
			<option>M&eacute;dio completo</option>
			<option>Superior incompleto</option>
			<option>Superior completo</option>
			<option>Pos-graduado</option>
			<option>Mestrado</option>
			<option>Doutorado</option>
		</select>
	</td>";
}
if ($module=="sai" || $module=="proc_outros") 
{
	echo "<td>Envolvimento:
	</select>
	<select name='ofendido[".$indice."][situacao]' $opcaoGeral2>
		<option value=''>Selecione</option>
		<option value='Vitima'>V&Iacute;tima</option>
		<option value='Testemunha'>Testemunha</option>
		<option value='Denunciante'>Denunciante</option>
	</select>";
}

echo "</td></tr>\r\n";
echo "</td></tr>\r\n";

echo" </tbody> </table>\r\n";
