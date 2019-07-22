<?php

//include ("menu.inc");
//include ("filtro.inc");

//echo "<br>";

if (!$_REQUEST['order']) $_REQUEST['order']="adl.id_adl DESC";
//sql do modulo
$sql="SELECT adl.*, andamento, rhopm.ABREVIATURA, encarregado.nome, encarregado.cargo, andamentocoger.andamentocoger FROM adl
	LEFT JOIN andamento ON
		adl.id_andamento = andamento.id_andamento
	LEFT JOIN andamentocoger ON
		adl.id_andamentocoger = andamentocoger.id_andamentocoger
	LEFT OUTER JOIN RHPARANA.opmPMPR AS rhopm ON
		rhopm.CODIGOBASE=adl.cdopm
	INNER JOIN encarregado_adl AS encarregado ON
		encarregado.id_adl=adl.id_adl AND rg_substituto=''
	";

//Filtra para somente ver a unidade do login, incluindo os comandos.
if ($user[nivel]<4) {
	if (!$adl->cdopm_st) $adl->cdopm_st=$opm_login->codigoBase;
}
//Filtro somente procedimentos do ano
$adl->sjd_ref_ano_eq=$_SESSION['sjd_ano'];


include ("includes/filtro.php");

if ($_SESSION['debug']) pre($sql);
$res=mysql_query($sql);

openTable("width='100%' class='bordasimples'");
	openLine(6);
		h1("ANDAMENTO DOS adl (".$opm_login->abreviatura.")");
	closeLine();
	
	openTR();
		lista::td("N&ordm; COGER","sjd_ref");
		lista::td("Data do fato","fato_data");
		lista::td("Prescrição","prescricao_data");
		lista::td("Encarregado");
		lista::td("Andamento","andamento");
		lista::td("And. COGER","andamentocoger");
	closeTR();
	
	$i=0; //contador
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="white"):($cor="#F0F0F0");
		openTR("bgcolor='$cor'");
			echo "<td>".lista::link("atualizar")."$row[sjd_ref]/$row[sjd_ref_ano]</td>";
			echo "<td>".udf($row['fato_data'],"data")."</td>";
			echo "<td>".udf($row['prescricao_data'],"data")."</td>";
			echo "<td>$row[cargo] $row[nome]</td>";
			echo "<td>$row[andamento]</td>";
			echo "<td>$row[andamentocoger]</td>";
		closeTR();
	$i++;
	}
	
closeTable();



?>
