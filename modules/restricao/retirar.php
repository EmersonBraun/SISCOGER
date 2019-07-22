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

$restricao->retirada_data=date("d/m/Y");

?>

<form id="restricao" name="restricao" action="?module=restricao&noheader" method="POST" enctype="multipart/form-data">

<!-- campo obrigatorio, nao delete -->
<input type=hidden name=restricao[id_restricao]>

<?php
openTable("width='100%' bgcolor='#FFFFFF' class='bordasimples'");
openLine();
	echo "<h2>Formulario para RETIRADA de restri&ccedil;&atilde;o</h2>";
	h3("Esta a&ccedil;&atilde;o ir&aacute; retirar estas restri&ccedil;&otilde;es. Elas continuar&atilde;o no sistema para consultas posteriores. ");
closeLine();

form::openTR();
	form::openTD();
		$opcoes="readonly=true";
		form::input("RG","restricao[rg]");
	form::closeTD();

	form::openTD();
		form::openLabel("POLICIAL");
			echo "<input readonly type='text' size='5' name='restricao[cargo]'>";
			echo "<input readonly type='text' size='60' name='restricao[nome]'>";
		form::closeLabel();
	form::closeTD();

form::closeTR();

form::openTR(); 
	form::openTD();
		form::openLabel("Restri&ccedil;&atilde;o de <b>Porte de arma de fogo</b>");
			if ($restricao->arma_bl) echo "<font color='red'>COM RESTRICAO.</font>"; else echo "Sem restricao.";
		form::closeLabel();
	form::closeTD();
	form::openTD();
		form::openLabel("Restri&ccedil;&atilde;o de <b>uso de fardamento</b>");
			if ($restricao->fardamento_bl) echo "<font color='red'>COM RESTRICAO.</font>"; else echo "Sem restricao.";
		form::closeLabel();
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD();
		form::input("Data de <b>inicio</b> da restricao", "restricao[inicio_data]");
	form::closeTD();
	form::openTD();
		form::input("Data de <b>t&eacute;rmino</b> da restricao", "restricao[fim_data]");
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD();
		form::openLabel("Data de cadastro");
			echo "<input readonly type='text' size='10' name='restricao[cadastro_data]'>";
		form::closeLabel();
	form::closeTD();
	form::openTD();
		form::openLabel("Data de retirada das restri&ccedil;&otilde;es");
			echo "<input readonly type='text' size='10' name='restricao[retirada_data]'>";
		form::closeLabel();
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
if ($restricao) {
	formulario::values($restricao);
}
?>
