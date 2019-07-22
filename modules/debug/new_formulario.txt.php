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

<form id="novomodulo" name="novomodulo" action="?module=novomodulo" method="POST" enctype="multipart/form-data">

<!-- campo obrigatorio, nao delete -->
<input type=hidden name=nomelegivel[id_nomelegivel]>

<div class='bordasimples'>

<?php
openTable("width='100%' bgcolor='#FFFFFF'");
openLine();
	echo "<h2>Formulario para cadastro de nomelegivel</h2>";
closeLine();

form::openTR();
	form::openTD();
		$opcoes="id='foco'";
		form::input("Campo texto","novomodulo[campo]");
	form::closeTD();

	form::openTD();
		form::openLabel("Campo checkbox");
			echo "<input type='checkbox' name='novomodulo[campo_bl]'>";
			echo "Texto";
		form::closeLabel();
	form::closeTD();

form::closeTR();

form::openTR();
	form::openTD();
		form::input("Campo data","novomodulo[campo_data]");
	form::closeTD();
	form::openTD();
		form::input("Campo texto com mascara","novomodulo[campocommascara]","##-##/##.##");
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
if ($novomodulo) {
	formulario::values($novomodulo);
}
?>
