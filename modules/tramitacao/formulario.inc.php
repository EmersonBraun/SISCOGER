<script language='javascript'>
function confirmar() {
	if (window.confirm("Tem certeza?")) return true;
	else return false;
}
</script>

<?php
if ($user['nivel']==6) { $opcaoGeral="readonly"; $opcaoGeral2="disabled"; } // alteracao solicitada pelo Cap Todisco

$usuario=$_SESSION["usuario"];
//Regras de negocio aqui
//Exemplo: data de hoje, controle de niveis, etc

if (!$tramitacao->rg) $tramitacao->rg=$_REQUEST['rg'];
if (!$tramitacao->data) $tramitacao->data=date("d/m/Y");
if (!$tramitacao->rg_cadastro) $tramitacao->rg_cadastro=$usuario->rg;
if (!$tramitacao->cdopm) $tramitacao->cdopm=$usuario->opm->codigoBase;
if (!$tramitacao->opm_abreviatura) $tramitacao->opm_abreviatura=$usuario->opm->abreviatura;
if (!$tramitacao->digitador) $tramitacao->digitador=$usuario->nome;

if (!$tramitacao->rg) die("<h3>RG invalido</h3>");
$policial=new policial($tramitacao->rg);
if (!$tramitacao->cargo) $tramitacao->cargo=$policial->cargo;
if (!$tramitacao->nome) $tramitacao->nome=$policial->nome;

?>

<form id="tramitacao" class="controlar-modificacao" name="tramitacao" action="?module=tramitacao&noheader" method="POST" enctype="multipart/form-data">

<!-- campo obrigatorio, nao delete -->
<input type=hidden name=tramitacao[id_tramitacao]>

<!--
<input type=hidden name=tramitacao[data]>
-->

<input type=hidden name=tramitacao[rg_cadastro]>
<input type=hidden name=tramitacao[cdopm]>
<input type=hidden name=tramitacao[opm_abreviatura]>

<div class='bordasimples'>

<?php
openTable("width='100%' bgcolor='#FFFFFF'");
openLine();
	echo "<h2>Formulario para cadastro de Tramitacao</h2>";
closeLine();

form::openTR();
	form::openTD("colspan='2'");
		form::openLabel("Policial");
		echo "RG: <input type='text' size='12' maxlength='25' readonly name='tramitacao[rg]'>";
		echo "RG: <input type='text' size='6' maxlength='10' readonly name='tramitacao[cargo]'>";
		echo "RG: <input type='text' size='40' readonly name='tramitacao[nome]'>";
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
		form::input("Data","tramitacao[data]");
	closeTD();
	openTD();
		//$opcoes="readonly";
		$opcoes="size='40'";
		form::input("Digitador","tramitacao[digitador]");
	closeTD();
closeTR();



form::openTR();
	form::openTD("colspan='2'");
		form::input("Tramitacao","tramitacao[descricao_txt]");
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
if ($tramitacao) {
	formulario::values($tramitacao);
}
?>
