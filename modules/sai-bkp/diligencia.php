<script language='javascript'>
function confirmar() {
	if (window.confirm("Tem certeza?")) return true;
	else return false;
}
</script>

<?
//Regras de negocio aqui
//Exemplo: data de hoje, controle de niveis, etc

$saidiligencias=new sai();
if (!$saidiligencias->data) $saidiligencias->data=date("d/m/Y");
if (!$saidiligencias->rg_cadastro) $saidiligencias->rg_cadastro=$usuario->rg;
if (!$saidiligencias->cdopm) $saidiligencias->cdopm=$usuario->opm->codigoBase;
if (!$saidiligencias->opm_abreviatura) $saidiligencias->opm_abreviatura=$usuario->opm->abreviatura;
if (!$saidiligencias->digitador) $saidiligencias->digitador=$usuario->nome;

if ($acao=="editardiligencia") {
	echo$sqlE="SELECT * FROM saidiligencias WHERE id_saidiligencias='".$_GET['saidiligencias']['id']."'";
	$resE=mysql_query($sqlE);
	if ($resE) $saiE=mysql_fetch_assoc($resE);

	if (!$saidiligencias->id_saidiligencias) $saidiligencias->id_saidiligencias=$saiE['id_saidiligencias'];
	if (!$saidiligencias->sai) $saidiligencias->sai=$saiE['sai'];
	if (!$saidiligencias->diligencias_txt) $saidiligencias->diligencias_txt=$saiE['diligencias_txt'];
} else {
	if (!$saidiligencias->sai) $saidiligencias->sai=$_REQUEST[sai][id];
}
?>

<form id="saidiligencias" name="saidiligencias" action="?module=sai&opcao=diligencia&noheader" method="POST" enctype="multipart/form-data">

<!-- campo obrigatorio, nao delete -->
<input type=hidden name=saidiligencias[id_saidiligencias]>
<input type=hidden name=saidiligencias[sai]>
<input type=hidden name=saidiligencias[rg_cadastro]>
<input type=hidden name=saidiligencias[cdopm]>
<input type=hidden name=saidiligencias[opm_abreviatura]>

<!--
<input type=hidden name=saidiligencias[data]>
-->

<div class='bordasimples'>

<?php
openTable("width='100%' bgcolor='#FFFFFF'");
openLine();
	echo "<h2>Formulario para cadastro de dilig&ecirc;ncias SAI</h2>";
closeLine();

openTR();
	openTD();
		//$opcoes="readonly";
		form::input("Data","saidiligencias[data]");
	closeTD();
	openTD();
		//$opcoes="readonly";
		$opcoes="size='30' readonly";
		form::input("Digitador","saidiligencias[digitador]");
	closeTD();
closeTR();

form::openTR();
	form::openTD("colspan='2'");
		form::input("Dilig&ecirc;ncia","saidiligencias[diligencias_txt]");
	form::closeTD();
form::closeTR();

echo "<tr><td><input type='submit' name='acao' value='".ucwords($acao)."'>&nbsp;";

if ($opcao=="atualizar") {
	echo "<input type='submit' name='acao' value='Apagar' onclick='return confirmar();'></TD></tr>";
}
?>
		
</table>
<!-- -->
</form>

</div>


<?
if ($saidiligencias) {
	formulario::values($saidiligencias, "saidiligencias");
}
?>
