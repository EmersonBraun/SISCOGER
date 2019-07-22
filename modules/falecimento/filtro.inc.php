<?php

echo "<form id='falecimento' action='".$_SESSION['REQUEST_URI']."' method='POST'>";
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
(count($falecimento)<2)?($style="display:none;"):($style="");

form::openTR("id='linhafiltro'");

	openTD();
		form::openLabel("&Oacute;bito/Les&atilde;o");
		echo "<select name='falecimento[resultado]'>";
			echo "<option value=''>Todos</option>";
			if ($mostrar=="Obito") $selected="selected"; else $selected="";
			echo "<option $selected value='Obito'>Obito</option>";
			if ($mostrar=="Lesao Corporal") $selected="selected"; else $selected="";
			echo "<option $selected value='Lesao Corporal'>Lesao Corporal</option>";
		echo "</select>";
		form::closeLabel();
	closeTD();

	form::openTD();
		form::openLabel("Data");
			echo "Entre ";
			formulario::data("falecimento","data_ini");
			calendario::cria(1,"falecimento","falecimento[data_ini]");
			echo "At&eacute;&nbsp; ";
			formulario::data("falecimento","data_fim");
			calendario::cria(2,"falecimento","falecimento[data_fim]");
		form::closeLabel();
	form::closeTD();

	openTD();
		form::openLabel("OPM");
			echo "<select name=falecimento[cdopm_st]>";
			include ("includes/option_opm.php");
			echo "</select>";
		form::closeLabel();
	closeTD();

	openTD();
		form::openLabel("Situacao");
			formulario::option("falecimento","situacao", "", "", 0, 0);
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

formulario::values($falecimento);
?>
