<?php

//include ("menu.inc");
include ("filtro.inc");

//echo "<br>";

if (!$_REQUEST['order']) $_REQUEST['order']="ipm.id_ipm DESC";
//sql do modulo
$sql="SELECT ipm.*, andamento, rhopm.ABREVIATURA, encarregado.nome, encarregado.cargo, andamentocoger.andamentocoger FROM ipm
	LEFT JOIN andamento ON
		ipm.id_andamento = andamento.id_andamento
	LEFT JOIN andamentocoger ON
		ipm.id_andamentocoger = andamentocoger.id_andamentocoger
	LEFT OUTER JOIN RHPARANA.opmPMPR AS rhopm ON
		rhopm.CODIGOBASE=ipm.cdopm
	INNER JOIN encarregado_ipm AS encarregado ON
		encarregado.id_ipm=ipm.id_ipm
	";

//Filtra para somente ver a unidade do login, incluindo os comandos.
if ($user[nivel]<4) {
	if (!$ipm->cdopm_st) $ipm->cdopm_st=$opm_login->codigoBase;
}
//Filtro somente procedimentos do ano
$ipm->sjd_ref_ano_eq=$_SESSION['sjd_ano'];


include ("includes/filtro.php");
//mysql_select_db("sjd");
if ($_SESSION['debug']) pre($sql);
$res=mysql_query($sql);

openTable("width='100%' class='bordasimples'");
	openLine(6);
		h1("ANDAMENTO DOS ipm (".$opm_login->abreviatura.")");
	closeLine();
	
	openTR();
		lista::td("N&ordm; COGER","sjd_ref");
		lista::td("OPM","cdopm");
		lista::td("Abertura","abertura_data");
		lista::td("Encarregado","nome");
		lista::td("Andamento","andamento");
		lista::td("And. COGER","andamentocoger");
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
