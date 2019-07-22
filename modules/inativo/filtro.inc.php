<?php

include ("menu.inc");

echo "<form id='inativo' action='".$_SESSION['REQUEST_URI']."' method='POST'>";
echo "<table width='100%' class='bordasimples noprint' style='border-top:0px;'>";


form::openTR();
	form::openTD("colspan='5'");
		?>
		<h2>Filtro</h2>
		<?php
	form::closeTD();
form::closeTR();

//Se tiver mais que uma entrada de filtro (ja tem por padrao o sjd_ref_ano), significa que a pessoa
//esta usando o filtro, portanto o display e true ao contrario de none.
$style="";

form::openTR("id='linhafiltro' style='$style'");
	form::openTD();
		form::input("Nome","inativo[nome]");
	form::closeTD();
	openTD();
		form::input("Posto/Grad.","inativo[cargo]");
	closeTD();

	form::openTD();
		form::openLabel("Data do reserva");
			echo "De&nbsp; ";
			formulario::data("inativo","DT_INI_RH_ini");
			calendario::cria(1,"inativo","inativo[DT_INI_RH_ini]");
			echo "At&eacute;&nbsp; ";
			formulario::data("inativo","DT_INI_RH_fim");
			calendario::cria(2,"inativo","inativo[DT_INI_RH_fim]");
		form::closeLabel();
	form::closeTD();
	openTD();
		form::openLabel("Acao");
		echo "<input type='submit' name='acao' value='Listar'>";
		form::closeLabel();
	closeTD();

form::closeTR();
echo "</table>";
echo "</form>";

formulario::values($inativo);
?>
<br>
