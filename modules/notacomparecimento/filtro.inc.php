<?

?>

<form id="ipm" name="ipm" action="?module=ipm" method="POST" enctype="multipart/form-data">

<table cellpadding="0" cellspacing="0" width="100%" border="0" bgcolor="#4682B4">
<tr><td bgcolor="White">
<!-- -->
<table width="100%" align="left" cellpadding="0" border="0" >
<tr><td colspan=5><h1>Pesquisa de Inquéritos Policiais Militares</h1></td></tr>
    <tr class="toggle_dados">
	<td width="25%">
	<table width="100%" align="left" cellpadding="3" bgcolor="#F2F2F2" class="borda">
		<tr>
			<td bgcolor="#FFFFFF" class="borda"> Motivo da abertura: </td>
		</tr>
		<tr>
			<td>
			<select name="ipm[crime]">
			<option value="">Todos os crimes</option>
			<?include ("includes/option_crime.html");?>
			</select>
			</td>
		</tr>
	</table>
    </td>
    <td width="25%">
	<table width="100%" align="left" cellpadding="3" bgcolor="#F2F2F2" class="borda">
		<tr>
			<td bgcolor="#FFFFFF" class="borda"> OPM: </td>
		</tr>
		<tr>
			<td>
			<select name="ipm[opm_codigo_st]">
			<?if ($nivel>=4) { ?> <option value="">Todas as Unidades</option> <? } ?>
			<?include ("includes/option_opm.php");?>
			</select>
			</td>
		</tr>
	</table>
    </td>
	<td width="50%">
	<table width="100%" align="left" cellpadding="3" bgcolor="#F2F2F2" class="borda">
		<tr>
			<td bgcolor="#FFFFFF" class="borda"> Data do fato: </td>
		</tr>
		<tr>
			<td>
			A partir de:
			<?
			formulario::data("ipm","fato_data_ini"); calendario::cria(1,"ipm","ipm[fato_data_ini]");
			?>
			até:
			<?
			formulario::data("ipm","fato_data_fim"); calendario::cria(2,"ipm","ipm[fato_data_fim]");
			?>
			</td>
		</tr>
	</table>
    </td>
    </tr>
    <tr>
    <td >
	<tr>
	<td width=25%>
	<table width="100%" align="left" cellpadding="3" bgcolor="#F2F2F2" class="borda">
		<tr>
			<td  bgcolor="#FFFFFF" class="borda"> Confronto Armado? </td>
		</tr>
		<tr>
			<td>
			<input type="checkbox" name="ipm[confronto_armado_bl]">Sim
			</td>
		</tr>
	</table>
    </td>
    <td width=25%>
	<table width="100%" align="left" cellpadding="3" bgcolor="#F2F2F2" class="borda">
		<tr>
			<td  bgcolor="#FFFFFF" class="borda"> Impressão </td>
		</tr>
		<tr>
			<td>
			<input type="checkbox" name="noheader">Versão para impressão
			</td>
		</tr>
	</table>
    </td>
    <td  width="50%">
	<table width="100%" align="left" cellpadding="3" bgcolor="#F2F2F2" class="borda">
		<tr>
			<td bgcolor="#FFFFFF" class="borda"> Data da abertura: </td>
		</tr>
		<tr>
			<td>
			A partir de:
			<?
			formulario::data("ipm","abertura_data_ini");
			calendario::cria(3,"ipm","ipm[abertura_data_ini]");
			?>
			até:
			<?
			formulario::data("ipm","abertura_data_fim"); 
			calendario::cria(4,"ipm","ipm[abertura_data_fim]");
			?>
			</td>
		</tr>
	</table>
    </td>
    </tr>
    
	
<tr><TD><input type="submit" name="acao" value="<?echo ucwords($opcao);?>">&nbsp;</td></tr>
		
</table>
<!-- -->
</td></tr></table>

</form>


<?
if ($ipm) {
	formulario::values($ipm);
}
?>
