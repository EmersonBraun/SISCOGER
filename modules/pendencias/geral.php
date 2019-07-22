<?php

if (!$order) $order="cdopm";

$campos=Array("comportamento","fatd_punicao","fatd_prazo","fatd_abertura","ipm_prazo","ipm_abertura","sindicancia_prazo","sindicancia_abertura");

$sql="SELECT pendencias.*, opm.ABREVIATURA AS unidade, (".implode("+",$campos).") AS total

		FROM pendencias 
		LEFT JOIN RHPARANA.opmPMPR opm
			ON opm.CODIGOBASE=pendencias.cdopm
";
include("/var/www/matrix/includes/filtro.php");

$res=mysql_query($sql);
//pre($sql);

h1("Pendencias no SISCOGER (PMPR)");

openTable("width='100%' class='bordasimples'");
	//CABECALHO
	openTR("bgcolor='#E0E0E0' align='center'");
		lista::td("OPM","unidade","rowspan='2'");
		lista::td("Comport.","comportamento DESC","rowspan='2'");
		lista::td("FATD","","colspan='3' align='center'");
		lista::td("IPM","","colspan='2'");
		lista::td("Sindicancia","","colspan='2'");
		lista::td("Total","total DESC","rowspan='2'");
	closeTR();

	//Subcabecalho
	openTR("bgcolor='#E0E0E0' align='center'");
		lista::td("Puni&ccedil;&otilde;es","fatd_punicao DESC");
		lista::td("Prazo","fatd_prazo DESC");
		lista::td("Abert.","fatd_abertura DESC");
		lista::td("Prazo","ipm_prazo DESC");
		lista::td("Abert.","ipm_abertura DESC");
		lista::td("Prazo","sindicancia_prazo DESC");
		lista::td("Abert.","sindicancia_abertura DESC");
	closeTR();

	$i=0;
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="#F0F0F0"):($cor="#E0E0E0");
		$x=0;
		openTR("bgcolor='$cor'");
			echo "<td>$row[unidade]</td>"; 
			echo "<td>$row[comportamento]</td>"; $x+=$row["comportamento"];
			echo "<td>$row[fatd_punicao]</td>"; $x+=$row["fatd_punicao"];
			echo "<td>$row[fatd_prazo]</td>"; $x+=$row["fatd_prazo"];
			echo "<td>$row[fatd_abertura]</td>"; $x+=$row["fatd_abertura"];
			echo "<td>$row[ipm_prazo]</td>"; $x+=$row["ipm_prazo"];
			echo "<td>$row[ipm_abertura]</td>"; $x+=$row["ipm_abertura"];
			echo "<td>$row[sindicancia_prazo]</td>"; $x+=$row["sindicancia_prazo"];
			echo "<td>$row[sindicancia_abertura]</td>"; $x+=$row["sindicancia_abertura"];
			echo "<td><b>$row[total]</b></td>";
		closeTR();
		$i++;
	}


closeTable();

?>
