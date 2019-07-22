<form action='?module=anobase' method='POST'>
<h1>Escolha o ANO BASE para o cadastro de procedimentos:</h1>
<select name='anobase'>
	<?
	for ($ano=2008; $ano<=date("Y"); $ano++) {
		echo "<option value='$ano'>$ano</option>";
	}
	?>
</select>
<br />
<input type=submit name='acao' value='modificar'>
</form>
