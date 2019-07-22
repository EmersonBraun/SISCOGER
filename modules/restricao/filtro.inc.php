<?php

echo "<form id='restricao' action='".$_SESSION['REQUEST_URI']."' method='POST'>";
echo "<table width='100%' class='bordasimples noprint' style='border-top:0px;'>";


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
(count($restricao)<1)?($style="display:none;"):($style="");

form::openTR("id='linhafiltro' style='$style'");
	form::openTD();
		form::openLabel("OPM");
			echo "<select name=restricao[pm.cdopm_st]>";
			include ("includes/option_opm.php");
			echo "</select>";
		form::closeLabel();
	form::closeTD();

//	form::openTD();
//		form::openLabel("Data do fato");
//			echo "De&nbsp; ";
//			formulario::data("restricao","fato_data_ini");
//			calendario::cria(1,"restricao","restricao[fato_data_ini]");
//			echo "At&eacute;&nbsp; ";
//			formulario::data("restricao","fato_data_fim");
//			calendario::cria(2,"restricao","restricao[fato_data_fim]");
//		form::closeLabel();
//	form::closeTD();

	openTD();
		form::openLabel("Acao");
		echo "<input type='submit' name='acao' value='Listar'>";
		form::closeLabel();
	closeTD();

form::closeTR();
echo "</table>";
echo "</form>";

formulario::values($restricao);
?>
<br>
