<?php

echo "<form action='".$_SERVER['REQUEST_URI']."' method='POST'>\r\n";
echo "<h1>Relat&oacute;rio de defensores</h1>";

/*
openTable("width='100%' class='bordasimples'");

openTR(); openTD("colspan='4'");
	echo "<h2>Filtro</h2>";
closeTD(); closeTR();


form::openTR();
	form::openTD();
		form::openLabel("OPM");
			echo "<select name='filtro[cdopm_st]'>";
			include ("includes/option_opm.php");
			echo "</select>";
		form::closeLabel();
	form::closeTD();

	form::openTD();
		form::openLabel("Procedimento");
			//include("includes/filtro_proc.php");
		form::closeLabel();
	form::closeTD();
	form::openTD();
		form::openLabel("Ano de refer&ecirc;ncia");
			echo "<select name='filtro[sjd_ref_ano]'>";
			echo "<option value=''>Todos</option>";
			for ($i=2008; $i<=date("Y"); $i++) {
				echo "<option value='$i'>$i</option>";
			}
			echo "</select>";
		form::closeLabel();
	form::closeTD();
form::closeTR();
closeTable();
echo "<input type='submit' name='acao' value='Defensores'>";
*/

echo "</form>\r\n<br>\r\n";

formulario::values($filtro,"filtro");

//MONTA O RELATORIO

$_REQUEST['order']="nome";
$acao="defensores";

if ($acao) {
	$filtro=new filtro();
	$filtro->setValues($_REQUEST['filtro']);
	$filtro->situacao="Defensor";

/*
	$proc=$filtro->procedimento;
	if ($proc=="ipm") $sqlWhere[]=" envolvido.id_ipm!='0' ";
	if ($proc=="sindicancia") $sqlWhere[]=" envolvido.id_sindicancia!='0' ";
	if ($proc=="cj") $sqlWhere[]=" envolvido.id_cj!='0' ";
	if ($proc=="cd") $sqlWhere[]=" envolvido.id_cd!='0' ";
	if ($proc=="it") $sqlWhere[]=" envolvido.id_it!='0' ";
	if ($proc=="adl") $sqlWhere[]=" envolvido.id_adl!='0' ";
	if ($proc=="apfd") $sqlWhere[]=" envolvido.id_apfd!='0' ";
	if ($proc=="fatd") $sqlWhere[]=" envolvido.id_fatd!='0' ";
	if ($proc=="iso") $sqlWhere[]=" envolvido.id_iso!='0' ";
	if ($proc=="desercao") $sqlWhere[]=" envolvido.id_desercao!='0' ";
	unset($filtro->procedimento); //Nao utiliza

	$groupby="nome";
*/
$sqlWhere[]="nome!=''";
	
	$sql="SELECT *,	
		CASE
			WHEN id_ipm 	THEN 'ipm'
			WHEN id_cd 		THEN 'cd'
			WHEN id_cj 		THEN 'cj'
			WHEN id_adl		THEN 'adl'
			WHEN id_fatd	THEN 'fatd'
		END proc
		FROM envolvido ";

	include ("includes/filtro.php");

	if ($_SESSION['debug']) pre($sql);
}

if ($acao=="defensores") {
	$res=mysql_query($sql);

	openTable("width='100%' class='bordasimples'");
		openTR(); openTD("colspan='3'");
			echo "<h2>Defensores</h2>";
		closeTD(); closeTR();
	
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="white"):($cor="#F0F0F0");
		openTR("bgcolor='$cor'");

		$p=$row["proc"];
		echo "<td>$row[rg]</td>";
		echo "<td>$row[cargo] $row[nome]</td>";
		echo "<td><a href='?module=$p&".$p."[id]=".$row["id_$p"]."'>$row[proc] (Abrir)</a></td>";

		closeTR();
		$i++;
	}
	closeTable();
}

?>
