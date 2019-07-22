<script language='javascript'>
function confirmar() {
	if (window.confirm("Tem certeza?")) return true;
	else return false;
}
function validar(form) {
	//COMP
	campo=document.getElementsByName('comportamentopm[id_comportamento]')[0];
	if (campo.value=="") {
		window.alert("Preencha o novo comportamento!"); campo.focus(); return false;
	}
	return true;
}
</script>

<?
if ($user['nivel']==6 || $user['nivel']==7) { $opcaoGeral="readonly"; $opcaoGeral2="disabled"; } // alteracao solicitada pelo Cap Todisco
//Regras de negocio aqui
//Exemplo: data de hoje, controle de niveis, etc

if (!$comportamentopm->rg) $comportamentopm->rg=$_REQUEST['rg'];
if (!$comportamentopm->data) $comportamentopm->data=date("d/m/Y");
if (!$comportamentopm->rg_cadastro) $comportamentopm->rg_cadastro=$usuario->rg;
if (!$comportamentopm->cdopm) $comportamentopm->cdopm=$usuario->opm->codigoBase;
if (!$comportamentopm->opm_abreviatura) $comportamentopm->opm_abreviatura=$usuario->opm->abreviatura;

if (!$comportamentopm->rg) die("<h3>RG invalido!</h3>");
$policial=new policial($comportamentopm->rg);

if (!$policial->nome) die ("<h3>Policial inexistente!</h3>");

?>

<form id="comportamentopm" class="controlar-modificacao" onsubmit='return validar(this);' name="comportamentopm" action="?module=comportamentopm&noheader" method="POST" enctype="multipart/form-data">

<!-- campo obrigatorio, nao delete -->
<input type=hidden name=comportamentopm[id_comportamentopm]>

<!--
<input type=hidden name=comportamentopm[data]>
-->

<input type=hidden name=comportamentopm[rg_cadastro]>
<input type=hidden name=comportamentopm[cdopm]>
<input type=hidden name=comportamentopm[opm_abreviatura]>

<div class='bordasimples'>

<?php
//pre($comportamentopm);
openTable("width='100%' bgcolor='#FFFFFF'");
openLine();
	echo "<h2>Formulario para cadastro de mudan&ccedil;&atilde;o de comportamento</h2>";
closeLine();

form::openTR();
	form::openTD("colspan='2'");
		form::openLabel("Policial");
		echo "RG: <input type='text' size='12' maxlength='25' readonly name='comportamentopm[rg]'>";
		echo $policial->cargo." ".$policial->nome;
		form::closeLabel();
	form::closeTD();
form::closeTR();

openTR();
	openLine();
		form::openLabel("OPM");
		echo $policial->opm->descricao;
		form::closeLabel();
	closeLine();
closeTR();


openTR();
	openTD();
		//$opcoes="readonly";
		form::input("Data (Art. 63 RDE)","comportamentopm[data]");
	closeTD();
	openTD();
		//$opcoes="readonly";
		$opcoes="size='40' maxlength='120'";
		form::input("Publica&ccedil;&atilde;o <font color='blue'>(Ex: BI n&ordm; 010/2011)</font>","comportamentopm[publicacao]");
	closeTD();
closeTR();


openTR();
	openTD("colspan='2'");
		form::openLabel("Novo comportamento");
			formulario::option("comportamentopm","comportamento");
		form::closeLabel();
	closeTD();
closeTR();


form::openTR();
	form::openTD("colspan='2'");
		$opcoes="rows='2' cols='60'";
		form::input("Motivo","comportamentopm[motivo_txt]");
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
if ($comportamentopm) {
	formulario::values($comportamentopm);
}
?>
