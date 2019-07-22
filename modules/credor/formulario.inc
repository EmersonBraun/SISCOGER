<?php

echo "<table width='100%'>";
form::openTR();
	form::openTD();
		form::input("CGC","credor[cgc]");
	form::closeTD();
	form::openTD();
		form::input("Nome do credor","credor[credor]");
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD();
		form::openLabel("Municipio");
			formulario::option("credor","municipio");
		form::closeLabel();
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD();
		form::input("Observacoes","credor[obs_txt]");
	form::openTD();
form::closeTR();

echo "</table>";

?>
