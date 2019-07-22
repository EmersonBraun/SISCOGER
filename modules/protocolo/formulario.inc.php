<br>
<script language='javascript'>
function confirmar() {
	if (window.confirm("Tem certeza?")) return true;
	else return false;
}
</script>

<?php
$rg = $_REQUEST['rg'];
if($opcao="cadastrar") {
	$rg_autor = $_SESSION['usuario'];
} 
?>

<form id="protocolo" name="protocolo" action="?module=protocolo" method="POST">

<!-- campo obrigatorio, nao delete -->
<input type=hidden name=protocolo[id_protocolo]>
<input type=hidden name=protocolo[rg] value='<?= $rg ?>'>

<div class='bordasimples'>

<?php
openTable("width='100%' bgcolor='#FFFFFF'");
openLine();
	echo "<h2>Formulario para cadastro de e-protocolo</h2>";
closeLine();

form::openTR();
	form::openTD();
		$opcoes="placeholder='apenas numeros'";
		form::input("Numero do protocolo","protocolo[numero]",'00.000.000-0');
	form::closeTD();
	if($opcao="cadastrar") {
		form::openTD();
			$opcoes="readonly='true' value='".$rg_autor->rg."'";
			form::input("RG cadastro","protocolo[rg_autor]");
		form::closeTD();
	} else {
		form::openTD();
			$opcoes="readonly='true' ";
			form::input("RG cadastro","protocolo[rg_autor]");
		form::closeTD();
	}
form::closeTR();
form::openTR();
	form::openTD();
		form::input("RG analista","protocolo[rg_analista]");
	form::closeTD();
	form::openTD();
		$opcoes="id='foco'";
		form::input("Obs","protocolo[obs]");
	form::closeTD();
form::closeTR();
form::openTR("colspan='3'");
	form::openTD("colspan='3'");
		$opcoes="id='foco' rows='5' cols='90' width='100%'";
		form::input("Descri&ccedil;&atilde;o","protocolo[descricao_txt]");
	form::closeTD();
form::closeTR();

$opcao = ($_REQUEST['opcao'] == 'cadastrar') ? 'Cadastrar': 'Atualizar';
echo "<tr><td><input type='submit' name='acao' value='".$opcao."' onsubmit='submit(); window.close()'>&nbsp;";

if ($opcao=="atualizar") {
	echo "<input type='submit' name='acao' value='Apagar' onclick='return confirmar();'></TD></tr>";
}
?>
		
</table>
<!-- -->
</form>

</div>


<?
if ($protocolo) {
	formulario::values($protocolo);
}
?>
