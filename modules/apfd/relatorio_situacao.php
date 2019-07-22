<?php

include ("filtro.inc");

$sql="SELECT apfd.*, rh.abreviatura, andamentocoger, envolvido.cargo, envolvido.nome FROM apfd 
	LEFT OUTER JOIN RHPARANA.opmPMPR AS rh ON
        apfd.cdopm=rh.codigobase
    LEFT JOIN andamentocoger ON
		apfd.id_andamentocoger=andamentocoger.id_andamentocoger
	LEFT JOIN envolvido ON
		envolvido.id_apfd=apfd.id_apfd AND situacao='Acusado'";

//So os do ano escolhido
$sqlWhere[]="sjd_ref_ano='".$_SESSION[sjd_ano]."'";

//Para usuarios menores, so as da unidade
if ($user[nivel]<4) {
	if (!$apfd->cdopm_st) $apfd->cdopm_st=$opm_login->codigoBase;
}

include ("includes/filtro.php");

if ($_SESSION['debug']) pre($sql);

$res=mysql_query($sql);

//Abre a tabela com resultados
h1("APFD ".$_SESSION['sjd_ano']." - Situa&ccedil;&atilde;o");
openTable("width='100%' class='bordasimples'");
	openTR();
		echo "<td>N&ordm;</td>";
		echo "<td>OPM</td>";
		echo "<td>Policial</td>";
		echo "<td>Fato</td>";
		echo "<td>Crime</td>";
		echo "<td>Especificar</td>";
		echo "<td>Publica&ccedil;&atilde;o</td>";
		echo "<td>Andamento</td>";
	closeTR();

$i=0; //cor
while ($row=mysql_fetch_assoc($res)) {
	($i%2)?($cor="white"):($cor="#E0E0E0");
	openTR("bgcolor='$cor'");
		echo "<td>".lista::link("atualizar")."$row[sjd_ref]/$row[sjd_ref_ano]</a></td>";
		echo "<td>$row[abreviatura]</td>";
		echo "<td>$row[cargo] $row[nome]</td>";
		echo "<td>".data::inverte($row[fato_data])."</td>";
		echo "<td>$row[tipo]</td>";
		echo "<td>$row[tipo_penal_novo]</td>";
		echo "<td>$row[doc_tipo] $row[doc_numero]</td>";
		echo "<td>$row[andamentocoger]</td>";
		
		if ($row["tipo_penal_novo"]=="Outros") {
			echo "<tr bgcolor='$cor'><td></td><td></td><td colspan='8'><b>Detalhes</b>: $row[especificar]</td></tr>";
		
		}
	closeTR();
	$i++;
}


closeTable();
?>
