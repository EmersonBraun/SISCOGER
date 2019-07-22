<?php

if ($acao=="modificar") {
	$opmTrabalho=$_REQUEST["opmTrabalho"];
	$opmTrabalho=completaZeros($opmTrabalho);

	if ($_SESSION["debug"]) echo "Criando nova OPM de protocolo com codigo $opmTrabalho<br>\r\n";
	$_SESSION["opm_proto"]=new opm($opmTrabalho);
	echo "<h2>OPM de trabalho modificada com sucesso para: ".$_SESSION["opm_proto"]->abreviatura."</h2>";
	if ($_SESSION["debug"]) pre($_SESSION["opm_proto"]);

        $sql="UPDATE PPUsuarios SET opm_trabalho='".$_SESSION["opm_proto"]->codigo."' WHERE UserRG='".$_SESSION["usuario"]->rg."'";
//	echo $sql;
	mssql_select_db("passowrds", $con[3]);
        mssql_query($sql, $con[3]);
}
else {
	echo "<h1>Selecionar OPM de trabalho</h1>";
	echo "<form action='?module=opmlogin' method='POST'>";
	echo "<table>";	
	
	form::openTR();
		form::openTD();
		form::openLabel("OPM de trabalho");
			echo "<select id='opmTrabalho' name='opmTrabalho'>";
			include ("includes/option_opm2.php");
			echo "</select>";
			abaixoacima("opmTrabalho");
		form::closeLabel();
		form::closeTD();
	form::closeTR();
	echo "</table>";
	echo "<input type='submit' name='acao' value='Modificar'>";
	echo "</form>";
}

?>
