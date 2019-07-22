<?php

echo "<form id='sindicancia' action='".$_SESSION['REQUEST_URI']."' method='POST'>";
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
		form::openLabel("Ano da reintegra&ccedil;&atilde;o");
			echo "De&nbsp; ";
			echo "<input name='reintegrado[bg_ano_ini]' type='text' maxlength='4' size='4' onkeypress='return dntr(this, event)'>";
			echo "At&eacute;&nbsp; ";
			echo "<input name='reintegrado[bg_ano_fim]' type='text' maxlength='4' size='4' onkeypress='return dntr(this, event)'>";
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

formulario::values($reintegrado);
?>
<br>
