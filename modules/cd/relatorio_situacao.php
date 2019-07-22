<?php

$sql="SELECT * FROM cd LEFT OUTER JOIN RHPARANA.opmPMPR AS rhopm ON
        rhopm.CODIGOBASE=cd.cdopm ";

//So os do ano escolhido
$sqlWhere[]="sjd_ref_ano='".$_SESSION[sjd_ano]."'";

//Para usuarios menores, so as da unidade
if ($user[nivel]<4) {
	if (!$cd->cdopm_st) $cd->cdopm_st=$opm_login->codigoBase;
}

//include ("filtro.inc");

include ("includes/filtro.php");

if ($_SESSION['debug']) pre($sql);

$res=mysql_query($sql);

//Abre a tabela com resultados
h1("cd ".$_SESSION['sjd_ano']." - Situa&ccedil;&atilde;o");
openTable("width='100%' class='bordasimples'");

	openTR();
		lista::td("N&ordm; COGER","sjd_ref");
		lista::td("Fato","abertura_data");
		lista::td("Portaria","portaria_data");
		lista::td("Prescri&ccedil;&atilde;o","prescricao_data");
		lista::td("Libelo","libelo_file");
		lista::td("Parecer","parecer_file");
		lista::td("Decis&atilde;o","decisao_file");
		lista::td("Rec. ato","rec_ato_file");
	closeTR();

$i=0; //cor
while ($row=mysql_fetch_assoc($res)) {
	($i%2)?($cor="white"):($cor="#E0E0E0");
	openTR("bgcolor='$cor'");
		echo "<td>".lista::link("atualizar")."$row[sjd_ref]/$row[sjd_ref_ano]</td>";
		echo "<td>".udf($row['fato_data'],"data")."</td>";
		echo "<td>".udf($row['portaria_data'],"data")."</td>";
		echo "<td>".udf($row['prescricao_data'],"data")."</td>";


		if ($row["libelo_file"]) echo "<td width='60px'><img src='img/correct.png'></td>"; else echo "<td>&nbsp;</td>";
		if ($row["parecer_file"]) echo "<td width='60px'><img src='img/correct.png'></td>"; else echo "<td>&nbsp;</td>";
		if ($row["decisao_file"]) echo "<td width='60px'><img src='img/correct.png'></td>"; else echo "<td>&nbsp;</td>";
		if ($row["rec_ato_file"]) echo "<td width='60px'><img src='img/correct.png'></td>"; else echo "<td width='60px'>&nbsp;</td>";

	closeTR();
	$i++;
}


closeTable();
?>
