<?php

//error_reporting(E_ALL);

$id=$_REQUEST['id'];
$sql="SELECT * FROM PPUsuarios WHERE UserID='$id'";
$res=mssql_query($sql, $con[3]);
$row=mssql_fetch_assoc($res);


if (!$acao) {


if ($_SESSION['debug']) pre($row);

?>
<form action='?module=admin&opcao=editar' method='POST'>

<?php

echo "<input type='hidden' name='id' value='$id'>";

h1("Informacoes do usuario ".$row["UserRG"]);
openTable("class='bordasimples'");
	openTR();
		openTD();
			form::openLabel("OPM Trabalho");
				$sql="SELECT * FROM opmPMPR WHERE CODIGO=$row[opm_trabalho]";
				//echo $sql;
				$res=mssql_query($sql, $con[4]);
				$om=mssql_fetch_assoc($res);
				//pre($om);
				if (!$row["opm_trabalho"]) echo "<b>N&atilde;o cadastrada.</b>";
				else echo $om["ABREVIATURA"]." ($row[opm_trabalho])";
			form::closeLabel();
		closeTD();
		
		openTD();
			form::openLabel("Modificar para");
				echo "<select id ='opm_trabalho' name='opm_trabalho'>";
					include ("includes/option_opm.php");
				echo "</select>";
				abaixoAcima('opm_trabalho');
			form::closeLabel();
		closeTD();
		
		openTD();
			echo "<input type='submit' name='acao' value='Modificar'>";
		closeTD();
		
		
	closeTR();
closeTable();

echo "</form>";

}

elseif ($acao=="modificar") {
	$opm_trabalho=$_REQUEST['opm_trabalho'];
	
	if ($opm_trabalho==="") die("<h3>OPM Trabalho n&atilde;o escolhida.</h3>");

	$sql="UPDATE PPUsuarios SET opm_trabalho='".completaZeros($opm_trabalho)."' WHERE UserID='$id'";
	
	if ($_SESSION['debug']) $sql;
	
	if (mssql_query($sql,$con[3])) echo "<h2>Usu&aacute;rio atualizado com sucesso!</h2>";
	else "<h3>O usu&aacute;rio n&atilde;o pode ser atualizado.</h3>";
	
}


echo "<a href='?module=admin&opcao=lista'>Clique aqui para voltar à lista de usuários.</a>";
?>
