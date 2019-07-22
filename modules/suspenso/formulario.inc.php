<br>
<script language='javascript'>
function confirmar() {
	if (window.confirm("Tem certeza?")) return true;
	else return false;
}
</script>

<?php
//Regras de negocio aqui
//Exemplo: data de hoje, controle de niveis, etc

?>

<form id="suspenso" class="controlar-modificacao" name="suspenso" action="?module=suspenso" method="POST" enctype="multipart/form-data">

<!-- campo obrigatorio, nao delete -->
<input type=hidden name=suspenso[id_suspenso]>

<?php
openTable("width='100%' class='bordasimples'");
openLine();
	echo "<h2>Formulario para cadastro de suspenso</h2>";
closeLine();

form::openTR();
	form::openTD();
		form::openLabel("RG");
		if ($suspenso->rg) $disabled="disabled";
		echo "<input $disabled id='foco' type=text size=12 onkeypress='return DigitaNumeroTempoReal(this, event);' name=suspenso[rg] onblur=\"ajaxForm(this,'policial',Array('nome','cargo'));\"></td>";
		form::closeLabel();
	form::closeTD();

	form::openTD();
		form::openLabel("Cargo/Nome");
		echo "<input readonly=\"readonly\" type=text size=10 name=\"suspenso[cargo]\">&nbsp;&nbsp;";
		echo "<input readonly=\"readonly\" type=text size=50 ajax=1 name='suspenso[nome]'>";
		form::closeLabel();
	form::closeTD();

form::closeTR();

form::openTR();
	form::openTD("colspan='2'");
		$opcoes="size='100' maxlenght='255'";
		form::input("Processo, N&ordm; do processo - Comarca (Ex: A&ccedil;&atilde;o Penal Militar n&ordm; 2010.000xxx0x - Curitiba)","suspenso[processo]");
	closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='2'");
		$opcoes="size='100' maxlenght='255'";
		form::input("Artigos da infra&ccedil;&atilde;o penal","suspenso[infracao]");
	closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='2'");
		$opcoes="size='25' maxlenght='32'";
		form::input("N&ordm; &uacute;nico","suspenso[numerounico]");
	closeTD();
form::closeTR();

openTR();
	openTD();
		form::input("Data de in&iacute;cio","suspenso[inicio_data]");
	closeTD();
	openTD();
		form::input("Data de fim da suspens&atilde;o","suspenso[fim_data]");
	closeTD();
closeTR();

openTR();
	openTD("colspan='2'");
		form::input("Observa&ccedil;&otilde;es","suspenso[obs_txt]");
	closeTD();
closeTR();

echo "<tr><td><input type='submit' name='acao' value='".ucwords($opcao)."'>&nbsp;";

if ($opcao=="atualizar") {
	echo "<input type='submit' name='acao' value='Apagar' onclick='return confirmar();'></TD></tr>";
}
?>
		
</table>
<!-- -->
</form>

<?
if ($suspenso) {
	formulario::values($suspenso);
}
?>
