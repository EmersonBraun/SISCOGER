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

<form id="reintegrado" class="controlar-modificacao" name="reintegrado" action="?module=reintegrado" method="POST" enctype="multipart/form-data">

<!-- campo obrigatorio, nao delete -->
<input type=hidden name=reintegrado[id_reintegrado]>

<?php
openTable("width='100%' class='bordasimples' bgcolor='#FFFFFF'");
openLine();
	echo "<h2>Formulario para cadastro de militar reintegrado</h2>";
closeLine();

form::openTR();
	form::openTD();
		form::openLabel("RG");
		if ($preso->rg) $disabled="disabled";
		echo "<input $disabled id='foco' type=text size=12 onkeypress='return DigitaNumeroTempoReal(this, event);' name=reintegrado[rg] onblur=\"ajaxForm(this,'policial',Array('nome','cargo'));\"></td>";
		form::closeLabel();
	form::closeTD();

	form::openTD();
		form::openLabel("Cargo/Nome");
		echo "<input id='frmcargo' readOnly=\"readonly\" type=text size=10 name=\"reintegrado[cargo]\">&nbsp;&nbsp;";
		echo "<input id='frmnome' readOnly=\"readonly\" type=text size=50 ajax=1 name='reintegrado[nome]'>";
		echo "&nbsp;&nbsp;<a title='Somente libere caso o PM n&atilde;o esteja no Meta4' href='#none' onclick=\"document.getElementById('frmnome').readOnly=false; document.getElementById('frmcargo').readOnly=false;\">Liberar campo</a>";
		form::closeLabel();
	form::closeTD();

closeTR();

	form::openTD();
		form::openLabel("Motivo da reintegra&ccedil;&atilde;o");
			echo "<select name='reintegrado[motivo]'>\r\n";
				echo "<option value='Recurso ADM'>Recurso administrativo</option>";
				echo "<option value='Acao Judicial'>A&ccedil;&atilde;o judicial</option>";
			echo "</select>\r\n";
		form::closeLabel();
	form::closeTD();

	form::openTD();
		form::openLabel("Procedimento");
			echo "<select name='reintegrado[procedimento]'>";
				echo "<option value='cd'>cd</option>";
				echo "<option value='cj'>cj</option>";
				echo "<option value='adl'>adl</option>";
			echo "</select>";

			echo "n&ordm; ";
			echo "<input type='text' name='reintegrado[sjd_ref]' size='4' maxlength='4' onkeypress='return dntr(this, event)'>/";
			echo "<input type='text' name='reintegrado[sjd_ref_ano]' size='4' maxlength='4' onkeypress='return dntr(this, event)'>";
			echo "<font color='darkgreen'>*Ano com 4 d&iacute;gitos</font>";

		form::closeLabel();
	form::closeTD();

form::closeTR();

form::openTR();
	form::openTD();
		form::input("Data da reintegra&ccedil;&atilde;o do policial","reintegrado[retorno_data]");
	form::closeTD();
	form::openTD();
		form::openLabel("Boletim Geral que publicou");
			echo "BG n&ordm; ";
			echo "<input type='text' name='reintegrado[bg_numero]' size='3' maxlength='3' onkeypress='return dntr(this, event)'>/";
			echo "<input type='text' name='reintegrado[bg_ano]' size='4' maxlength='4' onkeypress='return dntr(this, event)'>";
			echo "<font color='darkgreen'>*Ano com 4 d&iacute;gitos</font>";
		form::closeLabel();
	form::closeTD();
form::closeTR();


echo "<tr><td><input type='submit' name='acao' value='".ucwords($opcao)."'>&nbsp;";

if ($opcao=="atualizar" and $user['nivel']==5) {
	echo "<input type='submit' name='acao' value='Apagar' onclick='return confirmar();'></TD></tr>";
}
?>
		
</table>
<!-- -->
</form>

<?
if ($reintegrado) {
	formulario::values($reintegrado);
}
?>
