<?php

//include ("menu.inc");
include ("filtro.inc");

//echo "<br>";

$sqlWhere[]=" envolvido.situacao='Sindicado' ";

if (!$_REQUEST['order']) $_REQUEST['order']="sindicancia.id_sindicancia DESC";
//sql do modulo
$sql="SELECT sindicancia.*, andamento, rhopm.ABREVIATURA, envolvido.rg, envolvido.nome, envolvido.cargo, envolvido.resultado FROM sindicancia
	LEFT JOIN andamento ON
		sindicancia.id_andamento = andamento.id_andamento
	LEFT OUTER JOIN RHPARANA.opmPMPR AS rhopm ON
		rhopm.CODIGOBASE=sindicancia.cdopm
	INNER JOIN envolvido ON
		envolvido.id_sindicancia!=0 AND envolvido.id_sindicancia=sindicancia.id_sindicancia";

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
		h1("RESULTADO DAS SINDIC&Acirc;NCIAS (".$opm_login->abreviatura.")");
	closeLine();
	
	openTR();
		lista::td("N&ordm; COGER","sjd_ref");
		lista::td("OPM","cdopm");
		lista::td("Abertura","abertura_data");
		lista::td("Sindicado","nome");
		lista::td("Andamento","andamento");
		lista::td("Resultado","resultado");
	closeTR();
	
	$i=0; //contador
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="white"):($cor="#F0F0F0");
		openTR("bgcolor='$cor'");
			echo "<td>".lista::link("atualizar")."$row[sjd_ref]/$row[sjd_ref_ano]</td>";
			echo "<td>$row[ABREVIATURA]</td>";
			echo "<td>".udf($row['abertura_data'],"data")."</td>";

			if ($row['rg']) echo "<td>$row[cargo] $row[nome]</td>";
			else echo "<td>A APURAR</td>";

			echo "<td>$row[andamento]</td>";
			echo "<td>$row[resultado]</td>";
		closeTR();
	$i++;
	}
	
closeTable();



?>
