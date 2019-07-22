<script language='javascript'>
function confirmar() {
	if (window.confirm("Tem certeza?")) return true;
	else return false;
}
</script>

<?
//Regras de negocio aqui
//Exemplo: data de hoje, controle de niveis, etc

if (!$tramitacaoopm->rg) $tramitacaoopm->rg=$_REQUEST['rg'];
if (!$tramitacaoopm->data) $tramitacaoopm->data=date("d/m/Y");
if (!$tramitacaoopm->rg_cadastro) $tramitacaoopm->rg_cadastro=$usuario->rg;
if (!$tramitacaoopm->cdopm) $tramitacaoopm->cdopm=$usuario->opm->codigoBase;
if (!$tramitacaoopm->opm_abreviatura) $tramitacaoopm->opm_abreviatura=$usuario->opm->abreviatura;
if (!$tramitacaoopm->digitador) $tramitacaoopm->digitador=$usuario->nome;

if (!$tramitacaoopm->rg) die("<h3>RG invalido</h3>");
$policial=new policial($tramitacaoopm->rg);
if (!$tramitacaoopm->cargo) $tramitacaoopm->cargo=$policial->cargo;
if (!$tramitacaoopm->nome) $tramitacaoopm->nome=$policial->nome;

?>

<form id="tramitacaoopm" class="controlar-modificacao" name="tramitacaoopm" action="?module=tramitacaoopm&noheader" method="POST" enctype="multipart/form-data">

<!-- campo obrigatorio, nao delete -->
<input type=hidden name=tramitacaoopm[id_tramitacaoopm]>

<!--
<input type=hidden name=tramitacaoopm[data]>
-->

<input type=hidden name=tramitacaoopm[rg_cadastro]>
<input type=hidden name=tramitacaoopm[cdopm]>
<input type=hidden name=tramitacaoopm[opm_abreviatura]>

<div class='bordasimples'>

<?php
//pre($tramitacaoopm);
openTable("width='100%' bgcolor='#FFFFFF'");
openLine();
	echo "<h2>Formulario para cadastro de tramitacaoopm</h2>";
closeLine();

form::openTR();
	form::openTD("colspan='2'");
		form::openLabel("Policial");
		echo "RG: <input type='text' size='12' maxlength='25' readonly name='tramitacaoopm[rg]'>";
		echo "RG: <input type='text' size='6' maxlength='10' readonly name='tramitacaoopm[cargo]'>";
		echo "RG: <input type='text' size='40' readonly name='tramitacaoopm[nome]'>";
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
		form::input("Data","tramitacaoopm[data]");
	closeTD();
	openTD();
		//$opcoes="readonly";
		$opcoes="size='40'";
		form::input("Digitador","tramitacaoopm[digitador]");
	closeTD();
closeTR();



form::openTR();
	form::openTD("colspan='2'");
		form::input("tramitacaoopm","tramitacaoopm[descricao_txt]");
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

</div>


<?
if ($tramitacaoopm) {
	formulario::values($tramitacaoopm);
}
?>
