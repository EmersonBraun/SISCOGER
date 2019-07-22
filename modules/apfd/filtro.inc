<?php

include ("menu.inc");

echo "<form id='apfd' action='".$_SESSION['REQUEST_URI']."' method='POST'>";
echo "<table width='100%' class='bordasimples' style='border-top:0px;'>";


form::openTR();
	form::openTD("colspan='5'");
		?>
		<h2>Filtro
			<a href='#' onclick='$("#linhafiltro").show()'>+</a>
			<a href='#' onclick='$("#linhafiltro").hide()'>-</a>
		</h2>
		<?php
	form::closeTD();
form::closeTR();

form::openTR("id='linhafiltro' style='display:none;'");
	form::openTD();
		form::openLabel("OPM");
			echo "<select name=apfd[cdopm_st]>";
			include ("includes/option_opm.php");
			echo "</select>";
		form::closeLabel();
	form::closeTD();
	form::openTD();
		form::openLabel("Data do fato");
			echo "De&nbsp; ";
			formulario::data("apfd","fato_data_ini");
			calendario::cria(1,"apfd","apfd[fato_data_ini]");
			echo "At&eacute;&nbsp; ";
			formulario::data("apfd","fato_data_fim");
			calendario::cria(2,"apfd","apfd[fato_data_fim]");
		form::closeLabel();
	form::closeTD();
	openTD();
		form::openLabel("Tipo");
		echo "<select name='apfd[apfd.tipo]'>";
			echo "<option value=''>Todos</option>";
			echo "<option>Crime militar</option>";
			echo "<option>Crime comum</option>";
		echo "</select>";
		form::closeLabel();
	closeTD();

	openTD();
		form::openLabel("Acao");
		echo "<input type='submit' value='Listar' name='$opcao'>";
		form::closeLabel();
	closeTD();

form::closeTR();
echo "</table>";
echo "</form>";

formulario::values($apfd);
?>
<br>
