<?php

//echo "<br>";

if (!$_REQUEST['order']) $_REQUEST['order']="sai.id_sai DESC";
//sql do modulo
$sql="SELECT DISTINCT sai.*, andamento, rhopm.ABREVIATURA, andamento.andamento, andamentocoger.andamentocoger FROM sai
	LEFT JOIN andamento ON
		sai.id_andamento = andamento.id_andamento
	LEFT JOIN andamentocoger ON
		sai.id_andamentocoger = andamentocoger.id_andamentocoger
	LEFT OUTER JOIN RHPARANA.opmPMPR AS rhopm ON
		rhopm.CODIGOBASE=sai.cdopm";
//pre($sql);
//Filtra para somente ver a unidade do login, incluindo os comandos.
if ($user[nivel]<4) {
	if (!$sai->cdopm_st) $sai->cdopm_st=$opm_login->codigoBase;
}
//Filtro somente procedimentos do ano
$sai->sjd_ref_ano_eq=$_SESSION['sjd_ano'];


include ("includes/filtro.php");

if ($_SESSION['debug']) pre($sql);
$res=mysql_query($sql);

openTable("width='100%' class='bordasimples'");
	openLine(6);
		h1("ANDAMENTO DOS SAI (".$opm_login->abreviatura.")");
	closeLine();
	
	openTR();
		lista::td("N&ordm; COGER","sjd_ref");
		lista::td("OPM","cdopm");
		lista::td("Data","abertura_data");
		lista::td("Digitador");
		lista::td("Andamento");
		lista::td("And. COGER");
	closeTR();
	
	$i=0; //contador
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="white"):($cor="#F0F0F0");
		openTR("bgcolor='$cor'");
			echo "<td>".lista::link("atualizar")."$row[sjd_ref]/$row[sjd_ref_ano]</td>";
			echo "<td>$row[ABREVIATURA]</td>";
			echo "<td>".udf($row['abertura_data'],"data")."</td>";
			echo "<td>$row[cargo] $row[nome]</td>";
			echo "<td>$row[andamento]</td>";
			echo "<td>$row[andamentocoger]</td>";
		closeTR();
	$i++;
	}
	
closeTable();



?>
