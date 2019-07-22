<?php

//echo "<br>";
if (!$_REQUEST['order']) $_REQUEST['order']="proc_outros.id_proc_outros DESC";
//sql do modulo
$sql="SELECT proc_outros.*, r.ABREVIATURA FROM proc_outros
	LEFT JOIN RHPARANA.opmPMPR AS r ON r.CODIGOBASE=proc_outros.cdopm_apuracao";
/*$sql="SELECT * FROM proc_outros";*/
//pre($sql);
//Filtra para somente ver a unidade do login, incluindo os comandos.
if ($user[nivel]<4) {
	if (!$proc_outros->cdopm_st) $proc_outros->cdopm_st=$opm_login->codigoBase;
}
//Filtro somente procedimentos do ano
$proc_outros->sjd_ref_ano_eq=$_SESSION['sjd_ano'];


include ("includes/filtro.php");

if ($_SESSION['debug']) pre($sql);
$res=mysql_query($sql);

openTable("width='100%' class='bordasimples'");
	openLine(6);
		h1("ANDAMENTO DOS proc_outros (".$opm_login->abreviatura.")");
	closeLine();
	
	openTR();
		lista::td("N&ordm; COGER","sjd_ref");
		lista::td("OPM","cdopm");
		lista::td("Data Fato","data");
		lista::td("Data recebimento","abertura_data");
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
			echo "<td>".udf($row['data'],"data")."</td>";
			echo "<td>".udf($row['abertura_data'],"abertura_data")."</td>";
			echo "<td>$row[digitador]</td>";
			echo "<td>$row[andamento]</td>";
			echo "<td>$row[andamentocoger]</td>";
		closeTR();
	$i++;
	}
	
closeTable();



?>
