<?php

//include ("menu.inc");

echo "<form id='preso' action='".$_SESSION['REQUEST_URI']."' method='POST'>";
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
(count($preso)<2)?($style="display:none;"):($style="");

form::openTR("id='linhafiltro'");
	form::openTD();
		form::openLabel("Local da pris&atilde;o (onde o civil ou militar de outro estado est&aacute; preso)");
			echo "<select name=preso_outros[preso_outros.cdopm_prisao_st]>";
			include ("includes/option_opm.php");
			echo "</select>";
		form::closeLabel();
	form::closeTD();

	openTD();
		form::openLabel("Mostrar");
		echo "<select name='mostrar'>";
			echo "<option value=''>Todos</option>";
			if ($mostrar=="presos") $selected="selected"; else $selected="";
			echo "<option $selected value='presos'>Somente presos</option>";
			if ($mostrar=="soltos") $selected="selected"; else $selected="";
			echo "<option $selected value='soltos'>Somente que j&aacute; cumpriram</option>";
		echo "</select>";
		form::closeLabel();
	closeTD();

	form::openTD();
		form::openLabel("Data do in&iacute;cio da pris&atilde;o");
			echo "Entre ";
			formulario::data("preso","inicio_data_ini");
			calendario::cria(1,"preso","preso_outros[inicio_data_ini]");
			echo "At&eacute;&nbsp; ";
			formulario::data("preso","inicio_data_fim");
			calendario::cria(2,"preso","preso_outros[inicio_data_fim]");
		form::closeLabel();
	form::closeTD();

form::closeTR();
openTR();
	openTD();
		form::openLabel("OPM atual");
			echo "<select name=preso_outros[opm2.CODIGOBASE_st]>";
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

formulario::values($preso);
?>
<br>
