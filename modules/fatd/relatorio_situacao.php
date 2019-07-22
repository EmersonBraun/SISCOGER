<?php

$sql="SELECT * FROM fatd LEFT OUTER JOIN RHPARANA.opmPMPR AS rhopm ON
        rhopm.CODIGOBASE=fatd.cdopm ";

//So os do ano escolhido
$sqlWhere[]="sjd_ref_ano='".$_SESSION[sjd_ano]."'";

//Para usuarios menores, so as da unidade
if ($user[nivel]<4) {
	if (!$fatd->cdopm_st) $fatd->cdopm_st=$opm_login->codigoBase;
}

include ("filtro.inc");

include ("includes/filtro.php");

if ($_SESSION['debug']) pre($sql);

$res=mysql_query($sql);

//Abre a tabela com resultados
h1("fatd ".$_SESSION['sjd_ano']." - Situa&ccedil;&atilde;o");
openTable("width='100%' class='bordasimples'");
	openTR();
		echo "<td>N&ordm; COGER</td>";
		echo "<td>OPM</td>";
		echo "<td>Fato</td>";
		echo "<td>Despacho</td>";
		echo "<td>Abertura</td>";
		echo "<td>Imputa&ccedil;&atilde;o</td>";
		echo "<td>Relatorio</td>";
		echo "<td>Solu&ccedil;&atilde;o</td>";
		echo "<td>N. puni&ccedil;&atilde;o</td>";
	closeTR();

$i=0; //cor
while ($row=mysql_fetch_assoc($res)) {
	($i%2)?($cor="white"):($cor="#E0E0E0");
	openTR("bgcolor='$cor'");
		echo "<td>".lista::link("atualizar")."$row[sjd_ref]/$row[sjd_ref_ano]</a></td>";
		echo "<td>$row[ABREVIATURA]</td>";
		echo "<td>".data::inverte($row[fato_data])."</td>";
		echo "<td>".data::inverte($row[portaria_data])."</td>";
		echo "<td>".data::inverte($row[abertura_data])."</td>";
		if ($row[fato_file]) echo "<td width='60px'><img src='img/correct.png'></td>"; else echo "<td>&nbsp;</td>";
		if ($row[relatorio_file]) echo "<td width='60px'><img src='img/correct.png'></td>"; else echo "<td>&nbsp;</td>";
		if ($row[sol_cmt_file]) echo "<td width='60px'><img src='img/correct.png'></td>"; else echo "<td>&nbsp;</td>";
		if ($row[notapunicao_file]) echo "<td width='60px'><img src='img/correct.png'></td>"; else echo "<td width='60px'>&nbsp;</td>";

	closeTR();
	$i++;
}


closeTable();
?>
