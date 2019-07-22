<br>
<script language='javascript'>
function confirmar() {
	if (window.confirm("Tem certeza?")) return true;
	else return false;
}
function validar(form) {
	//Sintese
	campo=document.getElementsByName('preso_outros[complemento]')[0];
	if (campo.value=="") {
		window.alert("Preencha o artigo da infracao!"); campo.focus(); return false;
	}
	//Tipo da prisao
	campo=document.getElementsByName('preso_outros[id_presotipo]')[0];
	if (campo.value=="") {
		window.alert("Preencha o tipo da prisao!"); campo.focus(); return false;
	}
}
</script>

<?php
include("/var/www/sjd/define.php");

//Regras de negocio aqui
//Exemplo: data de hoje, controle de niveis, etc

?>

<form id="preso_outros" class="controlar-modificacao" name="preso_outros" action="?module=preso_outros" method="POST" enctype="multipart/form-data" onSubmit="return validar(this);">

<!-- campo obrigatorio, nao delete -->
<input type=hidden name=preso_outros[id_preso_outros]>

<div class='bordasimples'>

<?php
openTable("width='100%' bgcolor='#FFFFFF' class='bordasimples'");
openLine();
	echo "<h2>Formulario para cadastro de Preso</h2>";
closeLine();

form::openTR();
	form::openTD();
		form::openLabel("RG - Estado");
		echo "<input id='foco' type=text size=12 onkeypress='return DigitaNumeroTempoReal(this, event);' name=preso_outros[rg]>&nbsp;&nbsp;";
		
		echo "<select name=\"preso_outros[uf]\">
		    <option value=\"AC\">AC</option>
		    <option value=\"AL\">AL</option>
		    <option value=\"AM\">AM</option>
		    <option value=\"AP\">AP</option>
		    <option value=\"BA\">BA</option>
		    <option value=\"CE\">CE</option>
		    <option value=\"DF\">DF</option>
		    <option value=\"ES\">ES</option>
		    <option value=\"GO\">GO</option>
		    <option value=\"MA\">MA</option>
		    <option value=\"MT\">MT</option>
		    <option value=\"MS\">MS</option>
		    <option value=\"MG\">MG</option>
            	    <option value=\"PA\">PA</option>		    
            	    <option value=\"PB\">PB</option>
		    <option value=\"PR\" selected>PR</option>
		    <option value=\"PE\">PE</option>
		    <option value=\"PI\">PI</option>
		    <option value=\"RJ\">RJ</option>
		    <option value=\"RN\">RN</option>
		    <option value=\"RO\">RO</option>
		    <option value=\"RS\">RS</option>
		    <option value=\"RR\">RR</option>
		    <option value=\"SC\">SC</option>
		    <option value=\"SE\">SE</option>
		    <option value=\"SP\">SP</option>
		    <option value=\"TO\">TO</option>
        	</select>";
		form::closeLabel();
	form::closeTD();
	
	form::openTD();
		form::openLabel("CPF");
		echo "<input type=text name=\"preso_outros[cpf]\">&nbsp;&nbsp;";
		form::closeLabel();
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD();
		form::openLabel("Nome");
		echo "<input type=text name=\"preso_outros[nome]\">&nbsp;&nbsp;";
		form::closeLabel();
	form::closeTD();
	form::openTD();
		form::openLabel("Ocupa&ccedil;&atilde;o");
		echo "<input type=text name=\"preso_outros[ocupacao]\">&nbsp;&nbsp;";
		form::closeLabel();
	form::closeTD();

form::closeTR();


form::openTR();

	openTR();
		openTD();
		form::openLabel("Quartel onde est&aacute; preso");
			echo "<select id='opmprisao' name='preso_outros[cdopm_prisao]'>";
				include("includes/option_opm_todas.php");
			echo "</select>";
			abaixoAcima("opmprisao");
		form::closeLabel();
		closeTD();

		openTD();
		form::input("Local onde est&aacute; preso (Ex: COCT II)","preso_outros[localreclusao]");
		closeTD();
	closeTR();
form::closeTR();


form::openTR();
	form::openTD();
		$opcoes="size='40'";
		form::input("Processo, N&ordm; do processo - Comarca. (<b>Ex: A&ccedil;&atilde;o Penal Militar n&ordm; 2010.0000XXX-X - Curitiba</b>)","preso_outros[processo]");
	form::closeTD();
	form::openTD();
		$opcoes="size='60'";
		form::input("Artigos da Infra&ccedil;&atilde;o penal (Ex: Art. 121 &sect; 2&ordm; CP)","preso_outros[complemento]");
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD();
		form::input("N&ordm; do mandado de pris&atilde;o, se houver (Ex: 000183216-55)", "preso_outros[numeromandado]");
	form::closeTD();
	form::openTD();
		form::openLabel("Tipo da pris&atilde;o");
			formulario::option("preso_outros","presotipo","","","",0);
		form::closeLabel();
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD();
		form::input("Vara (Ex: 3&ordf; Vara Criminal)", "preso_outros[vara]");
	form::closeTD();
	form::openTD();
		form::input("Comarca (Ex: Curitiba)", "preso_outros[comarca]");
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD();
		form::input("Data de entrada na pris&atilde;o","preso_outros[inicio_data]");
	form::closeTD();
	form::openTD();
		form::input("Data de sa&iacute;da da pris&atilde;o","preso_outros[fim_data]");
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='2'");
		form::input("Observa&ccedil;&otilde;es","preso_outros[obs_txt]");
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

</div>


<?
if ($preso_outros) {
	formulario::values($preso_outros);
}
?>
