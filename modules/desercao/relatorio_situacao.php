<?php

include ("filtro.inc");

$sql="SELECT desercao.*, rh.abreviatura FROM desercao LEFT OUTER JOIN RHPARANA.opmPMPR AS rh ON
        desercao.cdopm=rh.codigobase ";

//So os do ano escolhido
$sqlWhere[]="sjd_ref_ano='".$_SESSION[sjd_ano]."'";

//Para usuarios menores, so as da unidade
if ($user[nivel]<4) {
	if (!$desercao->cdopm_st) $desercao->cdopm_st=$opm_login->codigoBase;
}

include ("includes/filtro.php");

if ($_SESSION['debug']) pre($sql);

$res=mysql_query($sql);

//Abre a tabela com resultados
h1("DESER&Ccedil;&Otilde;ES ".$_SESSION['sjd_ano']." - Situa&ccedil;&atilde;o");
openTable("width='100%' class='bordasimples'");
	openTR();
		echo "<td>N&ordm;</td>";
		echo "<td>OPM</td>";
		echo "<td>Fato</td>";
		echo "<td>Termo 1</td>";
		echo "<td>Termo captura</td>";
		echo "<td>Pericia</td>";
		echo "<td>Inclus&atilde;o/Revers&atilde;o</td>";
	closeTR();

$i=0; //cor
while ($row=mysql_fetch_assoc($res)) {
	($i%2)?($cor="white"):($cor="#E0E0E0");
	openTR("bgcolor='$cor'");
		echo "<td>".lista::link("atualizar")."$row[sjd_ref]/$row[sjd_ref_ano]</a></td>";
		echo "<td>$row[abreviatura]</td>";
		echo "<td>".data::inverte($row[fato_data])."</td>";
		echo "<td>$row[termo_exclusao]</td>";
		echo "<td>$row[termo_captura]</td>";
		echo "<td>$row[pericia]</td>";
		echo "<td>$row[termo_inclusao]</td>";
	closeTR();
	$i++;
}


closeTable();
?>
