<?php


echo "<form id='exclusaojudicial' action='".$_SESSION['REQUEST_URI']."' method='POST'>";
echo "<table width='100%' class='bordasimples' style='border-top:0px;'>";


form::openTR();
	form::openTD("colspan='5'");
		?>
		<h2>Filtro
			<a href='#none' onclick='$("#linhafiltro").show()'>+</a>
			<a href='#none' onclick='$("#linhafiltro").hide()'>-</a>
		</h2>
		<?php
	form::closeTD();
form::closeTR();

form::openTR("id='linhafiltro' style='display:none;'");
	form::openTD();
		form::openLabel("OPM");
			echo "<select name=exclusaojudicial[cdopm_quandoexcluido_st]>";
			include ("includes/option_opm.php");
			echo "</select>";
		form::closeLabel();
	form::closeTD();
	form::openTD();
		form::openLabel("Data da exclus&atilde;o");
			echo "De&nbsp; ";
			formulario::data("exclusaojudicial","exclusao_data_ini");
			calendario::cria(1,"exclusaojudicial","exclusaojudicial[exclusao_data_ini]");
			echo "At&eacute;&nbsp; ";
			formulario::data("exclusaojudicial","exclusao_data_fim");
			calendario::cria(2,"exclusaojudicial","exclusaojudicial[exclusao_data_fim]");
		form::closeLabel();
	form::closeTD();
	openTD();
		form::openLabel("Acao");
		echo "<input type='submit' value='Listar' name='$opcao'>";
		form::closeLabel();
	closeTD();

form::closeTR();
echo "</table>";
echo "</form>";

formulario::values($exclusaojudicial);
?>
<br>
