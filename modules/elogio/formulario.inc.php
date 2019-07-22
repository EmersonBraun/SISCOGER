<?
if ($user['nivel']==6 || $user['nivel']==7) { $opcaoGeral="readonly"; $opcaoGeral2="disabled"; } // alteracao solicitada pelo Cap Todisco

//Regras de negocio aqui
//Exemplo: data de hoje, controle de niveis, etc

if (!$elogio->rg) $elogio->rg=$_REQUEST['rg'];
if (!$elogio->data) $elogio->data=date("d/m/Y");
if (!$elogio->rg_cadastro) $elogio->rg_cadastro=$usuario->rg;
if (!$elogio->digitador) $elogio->digitador=$usuario->nome;

if (!$elogio->rg) die("<h3>RG invalido</h3>");
$policial=new policial($elogio->rg);
if (!$elogio->cargo) $elogio->cargo=$policial->cargo;
if (!$elogio->nome) $elogio->nome=$policial->nome;
if (!$elogio->id_posto) $elogio->id_posto=$policial->id_posto;

?>

<script language='javascript'>
function confirmar() {
	if (window.confirm("Tem certeza?")) return true;
	else return false;
}

function validar(form) {
	campo=document.getElementsByName('elogio[cdopm]')[0];
	if (campo.value=="") {
		window.alert("Preencha a OPM da elogio!"); campo.focus(); return false;
	}

	//Comportamento
	campo=document.getElementsByName('elogio[id_comportamento]')[0];
	if (campo.value=="") {
		window.alert("Preencha o Comportamento!"); campo.focus(); return false;
	}

return true;
}

</script>

<form id="elogio" class="controlar-modificacao" name="elogio" onsubmit='return validar(this)' action="?module=elogio&noheader" method="POST" enctype="multipart/form-data">

<!-- campo obrigatorio, nao delete -->
<input type=hidden name=elogio[id_elogio]>

<!--
<input type=hidden name=elogio[data]>
-->

<input type=hidden name=elogio[rg_cadastro]>
<input type=hidden name=elogio[opm_abreviatura]>
<input type=hidden name=elogio[digitador]>

<div class='bordasimples'>

<?php

//lock = variavel que trava os campos de referencia, pois a pessoa esta cadastrando diretamente do fatd
if (isset($_REQUEST['lock'])) $lock=" readonly "; else $lock="";

if ($elogio->id_elogio) $lock=" readonly";

//pre($elogio);
openTable("width='100%' bgcolor='#FFFFFF'");
openLine();
	echo "<h2>Formulario para cadastro de elogio</h2>";
closeLine();

form::openTR();
	form::openTD("colspan='2'");
		form::openLabel("Policial");
		echo "RG: <input type='text' size='12' maxlength='25' readonly name='elogio[rg]'>";
		echo "RG: <input type='text' size='6' maxlength='10' readonly name='elogio[cargo]'>";
		echo "RG: <input type='text' size='40' readonly name='elogio[nome]'>";
		form::closeLabel();
	form::closeTD();
form::closeTR();

openTR();
	openTD();
		form::openLabel("OPM");
		echo $policial->opm->descricao;
		form::closeLabel();
	closeTD();
	openTD();
		form::openLabel("OPM da elogio");
			echo "<select name='elogio[cdopm]' $opcaoGeral2>";
				include("includes/option_opm.php");
			echo "</select>";
		form::closeLabel();
	closeTD();
closeTR();


openTR();
	openTD();
		//$opcoes="readonly";
		form::input("Data da publica&ccedil;&atilde;o do elogio","elogio[elogio_data]");
	closeTD();
	openTD();
		$opcoes="maxlength='180'";
		form::input("Publica&ccedil;&atilde;o (Ex: BI n&ordm; 100/2014)","elogio[publicacao]");
	closeTD();
closeTR();


form::openTR();
	form::openTD("colspan='2'");
		$opcoes="rows='5' cols='60' ";
		form::input("elogio","elogio[descricao_txt]");
	form::closeTD();
form::closeTR();

if (!$opcaoGeral2) {
	echo "<tr><td><input type='submit' name='acao' value='".ucwords($opcao)."'>&nbsp;";

	if ($opcao=="atualizar") {
		echo "<input type='submit' name='acao' value='Apagar' onclick='return confirmar();'></TD></tr>";
	}
}
?>
		
</table>
<!-- -->
</form>

</div>


<?
if ($elogio) {
	formulario::values($elogio);
}
?>
