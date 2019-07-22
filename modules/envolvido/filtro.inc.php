<?php

echo "<form id='envolvido' action='".$_SESSION['REQUEST_URI']."' method='POST'>";
echo "<table width='100%' class='bordasimples' style='border-top:0px;'>";

form::openTR();
	form::openTD("colspan='5'");
		?>
		<h2>Filtro
			<a href='#noplace' onclick='$("#linhafiltro").show()'>+</a>
			<a href='#noplace' onclick='$("#linhafiltro").hide()'>-</a>
		</h2>
		<?php
	form::closeTD();
form::closeTR();

form::openTR("id='linhafiltro' style='display:none;'");
	form::openTD();
		form::openLabel("OPM");
			echo "<select name=envolvido[cdopm_st]>";
			include ("includes/option_opm.php");
			echo "</select>";
		form::closeLabel();
	form::closeTD();
	form::openTD();
		form::openLabel("Data do BG");
			echo "De&nbsp; ";
			formulario::data("envolvido","fato_data_ini");
			calendario::cria(1,"envolvido","envolvido[fato_data_ini]");
			echo "At&eacute;&nbsp; ";
			formulario::data("envolvido","fato_data_fim");
			calendario::cria(2,"envolvido","envolvido[fato_data_fim]");
		form::closeLabel();
	form::closeTD();
	openTD();
		form::openLabel("POSTO/GRAD.");
			echo "<select>";
				include("includes/option_posto.html");
			echo "</select>";
		form::closeLabel():
	closeTD();
	openTD();
		form::openLabel("Acao");
		echo "<input type='submit' value='Listar' name='$opcao'>";
		form::closeLabel();
	closeTD();

form::closeTR();
echo "</table>";
echo "</form>";

formulario::values($envolvido);
?>
<br>
