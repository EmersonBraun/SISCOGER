<?php

//include ("menu.inc");
include ("filtro.inc");

//echo "<br>";

if (!$_REQUEST['order']) $_REQUEST['order']="sindicancia.id_sindicancia DESC";
//sql do modulo
$sql="SELECT sindicancia.*, andamento, rhopm.ABREVIATURA, encarregado.nome, encarregado.cargo, andamentocoger.andamentocoger FROM sindicancia
	LEFT JOIN andamento ON
		sindicancia.id_andamento = andamento.id_andamento
	LEFT JOIN andamentocoger ON
		sindicancia.id_andamentocoger = andamentocoger.id_andamentocoger
	LEFT OUTER JOIN RHPARANA.opmPMPR AS rhopm ON
		rhopm.CODIGOBASE=sindicancia.cdopm
	INNER JOIN encarregado_sindicancia AS encarregado ON
		encarregado.id_sindicancia=sindicancia.id_sindicancia
	";

//Filtra para somente ver a unidade do login, incluindo os comandos.
if ($user[nivel]<4) {
	if (!$sindicancia->cdopm_st) $sindicancia->cdopm_st=$opm_login->codigoBase;
}
//Filtro somente procedimentos do ano
$sindicancia->sjd_ref_ano_eq=$_SESSION['sjd_ano'];


include ("includes/filtro.php");

if ($_SESSION['debug']) pre($sql);
$res=mysql_query($sql);

openTable("width='100%' class='bordasimples'");
	openLine(6);
		h1("ANDAMENTO DOS sindicancia (".$opm_login->abreviatura.")");
	closeLine();
	
	openTR();
		lista::td("N&ordm; COGER","sjd_ref");
		lista::td("OPM","cdopm");
		lista::td("Abertura","abertura_data");
		lista::td("Encarregado");
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
