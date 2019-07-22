<?php

echo "<form id='recurso' action='".$_SESSION['REQUEST_URI']."' method='POST'>";
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
(count($recurso)<2)?($style="display:none;"):($style="");

form::openTR("id='linhafiltro' style='$style'");
	form::openTD();
		form::openLabel("OPM");
			echo "<select name=recurso[recurso.cdopm_st]>";
			include ("includes/option_opm.php");
			echo "</select>";
		form::closeLabel();
	form::closeTD();

	form::openTD();
		form::openLabel("Data de recebimento");
			echo "De&nbsp; ";
			formulario::data("recurso","datahora_ini");
			calendario::cria(1,"recurso","recurso[datahora_ini]");
			echo "At&eacute;&nbsp; ";
			formulario::data("recurso","datahora_fim");
			calendario::cria(2,"recurso","recurso[datahora_fim]");
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

formulario::values($recurso);

mysql_select_db("sjd", $con[8]);

?>
<br>
