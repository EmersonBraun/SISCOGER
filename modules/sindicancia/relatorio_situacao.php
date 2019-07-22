<?php

include ("filtro.inc");

$sql="SELECT sindicancia.*, rh.abreviatura FROM sindicancia LEFT OUTER JOIN RHPARANA.opmPMPR AS rh ON
        sindicancia.cdopm=rh.codigobase ";

//So os do ano escolhido
$sqlWhere[]="sjd_ref_ano='".$_SESSION[sjd_ano]."'";

//Para usuarios menores, so as da unidade
if ($user[nivel]<4) {
	if (!$sindicancia->cdopm_st) $sindicancia->cdopm_st=$opm_login->codigoBase;
}

include ("includes/filtro.php");

if ($_SESSION['debug']) pre($sql);

$res=mysql_query($sql);

//Abre a tabela com resultados
h1("sindicancia ".$_SESSION['sjd_ano']." - Situa&ccedil;&atilde;o");
openTable("width='100%' class='bordasimples'");
	openTR();
		echo "<td>N&ordm;</td>";
		echo "<td>OPM</td>";
		echo "<td>Fato</td>";
		echo "<td>Abertura</td>";
		echo "<td>Portaria</td>";
		echo "<td>Sol. OPM</td>";
		echo "<td>Sol. CG</td>";
	closeTR();

$i=0; //cor
while ($row=mysql_fetch_assoc($res)) {
	($i%2)?($cor="white"):($cor="#E0E0E0");
	openTR("bgcolor='$cor'");
		echo "<td>".lista::link("atualizar")."$row[sjd_ref]/$row[sjd_ref_ano]</a></td>";
		echo "<td>$row[abreviatura]</td>";
		echo "<td>".data::inverte($row[fato_data])."</td>";
		echo "<td>".data::inverte($row[abertura_data])."</td>";
		echo "<td>".data::inverte($row[portaria_data])."</td>";
		echo "<td>";
			if ($row["sol_cmt_file"]) echo "<img src='img/correct.png'>".data::inverte($row["sol_cmt_data"])."";
		echo "</td>";
		echo "<td>";
			if ($row["sol_cmtgeral_file"]) echo "<img src='img/correct.png'>".data::inverte($row["sol_cmtgeral_data"])."";
		echo "</td>";

	closeTR();
	$i++;
}


closeTable();
?>
