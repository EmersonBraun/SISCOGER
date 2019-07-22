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

$rg=$_REQUEST["rg"];

if ($rg) { 
	$restricao->rg=$rg;
	$pm=new policial("$rg");
	$restricao->cargo=$pm->cargo;
	$restricao->nome=$pm->nome;

	$restricao->cadastro_data=date("d/m/Y");
}

?>

<form id="restricao" class="controlar-modificacao" name="restricao" action="?module=restricao&noheader" method="POST" enctype="multipart/form-data">

<!-- campo obrigatorio, nao delete -->
<input type=hidden name=restricao[id_restricao]>

<?php
openTable("width='100%' bgcolor='#FFFFFF' class='bordasimples'");
openLine();
	echo "<h2>Formulario para cadastro de restricao</h2>";
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
			echo "<input type='checkbox' name='restricao[arma_bl]'> marque se o militar tem esta restri&ccedil;&atilde;o";
		form::closeLabel();
	form::closeTD();
	form::openTD();
		form::openLabel("Restri&ccedil;&atilde;o de <b>uso de fardamento</b>");
			echo "<input type='checkbox' name='restricao[fardamento_bl]'> marque se o militar tem esta restri&ccedil;&atilde;o";
		form::closeLabel();
	form::closeTD();
form::closeTR();

openTR();
	openTD("colspan='2'");
		form::openLabel("Origem da restri&ccedil;&atilde;o");
			echo "<select name='restricao[origem]'>";
				echo "<option value=''>Selecione</option>";
				echo "<option value='Laudo medico'>Laudo m&eacute;dico</option>";
				echo "<option value='Disciplinar/Criminal'>Sit. Disciplinar/Criminal</option>";
				echo "<option value='Disparo'>Disparo Imprudente/Negligente</option>";
				echo "<option value='Sob efeito alcool'>Porte sob efeito de alcool ou outra subst.</option>";
				echo "<option value='Condenacao Punicao Disciplinar'>Condenação ou Punição Disciplinar</option>";
				echo "<option value='Inapto Psicologico'>Inapto Avaliação Psicológica</option>";
			echo "</select>";
		form::closeLabel();
	closeTD();
closeTR();

form::openTR();
	form::openTD();
		form::input("Data de <b>inicio</b> da restricao", "restricao[inicio_data]");
	form::closeTD();
	form::openTD();
		form::input("Data de <b>t&eacute;rmino</b> da restricao", "restricao[fim_data]");
	form::closeTD();
form::closeTR();

openLine();
	form::input("Observacoes (Inserir numero do BI/BG, despacho e outros dados)","restricao[obs_txt]");
closeLine();

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

if ($opcao=="atualizar" and $user['nivel']==5) {
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
