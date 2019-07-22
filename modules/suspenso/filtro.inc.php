<?php

//include ("menu.inc");

echo "<form id='suspenso' action='".$_SESSION['REQUEST_URI']."' method='POST'>";
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

//Se tiver mais que uma entrada de filtro (ja tem por padrao o sjd_ref_ano), significa que a pessoa
//esta usando o filtro, portanto o display e true ao contrario de none.
(count($suspenso)<2)?($style="display:none;"):($style="");

form::openTR("id='linhafiltro'");
		openTD();
		form::openLabel("Mostrar");
		echo "<select name='mostrar'>";
			echo "<option value=''>Todos</option>";
			if ($_POST['mostrar']=="suspensos") $selected="selected"; else $selected="";
			echo "<option $selected value='suspensos'>Somente suspensos</option>";
			if ($_POST['mostrar']=="findados") $selected="selected"; else $selected="";
			echo "<option $selected value='findados'>Somente que j&aacute; terminaram a suspensao</option>";
		echo "</select>";
		form::closeLabel();
	closeTD();

	form::openTD();
		form::openLabel("Data do in&iacute;cio da suspens&atilde;o");
			echo "Entre ";
			formulario::data("suspenso","inicio_data_ini");
			calendario::cria(1,"suspenso","suspenso[inicio_data_ini]");
			echo "At&eacute;&nbsp; ";
			formulario::data("suspenso","inicio_data_fim");
			calendario::cria(2,"suspenso","suspenso[inicio_data_fim]");
		form::closeLabel();
	form::closeTD();

	openTD();
		form::openLabel("OPM atual");
			echo "<select name=suspenso[opm.CODIGOBASE_st]>";
			include ("includes/option_opm.php");
			echo "</select>";
		form::closeLabel();
	closeTD();

	openTD();
		form::openLabel("Acao");
		echo "<input type='submit' name='acao' value='Listar'>";
		form::closeLabel();
	closeTD();

form::closeTR();
echo "</table>";
echo "</form>";

formulario::values($suspenso);
?>
<br>
