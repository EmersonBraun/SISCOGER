<?php

echo "<form id='APAGADO' action='".$_SESSION['REQUEST_URI']."' method='POST'>";
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
(count($APAGADO)<2)?($style="display:none;"):($style="");

form::openTR("id='linhafiltro' style='$style'");

	openTD();
		$opcoes="onkeypress='return DigitaNumeroTempoReal(this,event)' size='4'";
		form::input("RG que apagou","APAGADO[rg_eq]");
	closeTD();

	form::openTD();
		form::input("Nome de quem apagou","APAGADO[nome]");
	form::closeTD();

	form::openTD();
		form::input("Objeto apagado (ex: fatd, punicao)","APAGADO[objeto]");
	form::closeTD();

	form::openTD();
		form::input("Informa&ccedil;&otilde;es dentro do objeto apagado","APAGADO[objetoapagado]");
	form::closeTD();

	openTD();
		form::openLabel("Acao");
		echo "<input type='submit' name='acao' value='Listar'>";
		form::closeLabel();
	closeTD();

form::closeTR();
echo "</table>";
echo "</form>";

formulario::values($APAGADO);

?>
