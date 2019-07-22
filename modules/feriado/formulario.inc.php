<br>
<script language='javascript'>
function confirmar() {
	if (window.confirm("Tem certeza?")) return true;
	else return false;
}
</script>

<?
//Regras de negocio aqui
//Exemplo: data de hoje, controle de niveis, etc

?>

<form id="feriado" name="feriado" action="?module=feriado" method="POST" enctype="multipart/form-data">

<!-- campo obrigatorio, nao delete -->
<input type=hidden name=feriado[id_feriado]>

<?php
openTable("width='100%' bgcolor='#FFFFFF' class='bordasimples'");
openLine();
	echo "<h2>Formulario para cadastro de feriado</h2>";
closeLine();

form::openTR();
	form::openTD();
		form::input("Data","feriado[data]");
	form::closeTD();
	form::openTD();
		$opcoes="size='60' maxlength='200'";
		form::input("Descricao","feriado[feriado]");
	form::closeTD();
form::closeTR();


echo "<tr><td><input type='submit' name='acao' value='".ucwords($opcao)."'>&nbsp;";

if ($opcao=="atualizar") {
	echo "<input type='submit' name='acao' value='Apagar' onclick='return confirmar();'></TD></tr>";
}
?>
		
</table>
<!-- -->
</form>

<?
if ($feriado) {
	formulario::values($feriado);
}
?>
