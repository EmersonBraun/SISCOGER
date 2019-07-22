<?php

//include ("menu.inc");
//include ("filtro.inc");

//echo "<br>";

if (!$_REQUEST['order']) $_REQUEST['order']="cd.id_cd DESC";
//sql do modulo
$sql="SELECT cd.*, andamento, rhopm.ABREVIATURA, encarregado.nome, encarregado.cargo, andamentocoger FROM cd
	LEFT JOIN andamento ON
		cd.id_andamento = andamento.id_andamento
	LEFT JOIN andamentocoger ON
		cd.id_andamentocoger = andamentocoger.id_andamentocoger
	LEFT OUTER JOIN RHPARANA.opmPMPR AS rhopm ON
		rhopm.CODIGOBASE=cd.cdopm
	INNER JOIN encarregado_cd AS encarregado ON
		encarregado.id_cd=cd.id_cd AND encarregado.rg_substituto=''
	";

//Filtra para somente ver a unidade do login, incluindo os comandos.
if ($user[nivel]<4) {
	if (!$cd->cdopm_st) $cd->cdopm_st=$opm_login->codigoBase;
}
//Filtro somente procedimentos do ano
$cd->sjd_ref_ano_eq=$_SESSION['sjd_ano'];


include ("includes/filtro.php");

if ($_SESSION['debug']) pre($sql);
$res=mysql_query($sql);

openTable("width='100%' class='bordasimples'");
	openLine(10);
		h1("ANDAMENTO DOS cd (".$opm_login->abreviatura.")");
	closeLine();
	
	openTR();
		lista::td("N&ordm; COGER","sjd_ref");
		lista::td("Fato","abertura_data");
		lista::td("Portaria","portaria_data");
		lista::td("Prescri&ccedil;&atilde;o","prescricao_data");
		lista::td("Presidente","nome");
		lista::td("Andamento","andamento");
		lista::td("And. COGER","andamentocoger");
	closeTR();
	
	$i=0; //contador
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="white"):($cor="#F0F0F0");
		openTR("bgcolor='$cor'");
			echo "<td>".lista::link("atualizar")."$row[sjd_ref]/$row[sjd_ref_ano]</td>";
			echo "<td>".udf($row['fato_data'],"data")."</td>";
			echo "<td>".udf($row['portaria_data'],"data")."</td>";
			echo "<td>".udf($row['prescricao_data'],"data")."</td>";
			echo "<td>$row[cargo] $row[nome]</td>";
			echo "<td>$row[andamento]</td>";
			echo "<td>$row[andamentocoger]</td>";
		closeTR();
	$i++;
	}
	
closeTable();



?>
