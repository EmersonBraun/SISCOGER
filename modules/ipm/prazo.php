<?php

//include ("menu.inc");
include ("filtro.inc");

//echo "<br>";

if (!$_REQUEST['order']) $_REQUEST['order']="ipm.id_ipm DESC";
//sql do modulo
$sql="SELECT ipm.id_ipm, andamento, envolvido.cargo, envolvido.nome, cdopm, opm.ABREVIATURA, sjd_ref, sjd_ref_ano, autuacao_data, 
	(DATEDIFF(DATE(NOW()),autuacao_data)+1) AS diasuteis FROM ipm
	LEFT JOIN RHPARANA.opmPMPR opm ON
		opm.CODIGOBASE=ipm.cdopm
	LEFT JOIN envolvido ON
		envolvido.id_ipm=ipm.id_ipm AND envolvido.situacao='Encarregado' AND rg_substituto=''
	LEFT JOIN andamento ON
		andamento.id_andamento=ipm.id_andamento
	";

//Filtra para somente ver a unidade do login, incluindo os comandos.
if ($user[nivel]<4) {
	if (!$ipm->cdopm_st) $ipm->cdopm_st=$opm_login->codigoBase;
}
//Filtro somente procedimentos do ano
$ipm->sjd_ref_ano_eq=$_SESSION['sjd_ano'];

$_REQUEST['orderby']="ipm.id_ipm DESC";


include ("includes/filtro.php");

if ($_SESSION['debug']) pre($sql);

//pre($sql); die;

$res=mysql_query($sql);

h1("PRAZO DOS ipm (".$opm_login->abreviatura.")");
openTable("width='100%' class='bordasimples'");
	openLine(7);
		h2("Calculo do prazo dos ipm - contado em dias corridos, conta-se o primeiro dia.<br> Data de refer&ecirc;ncia: HOJE (".date("d/m/Y").")");
	closeLine();
	
	openTR();
		lista::td("N&ordm; COGER","sjd_ref");
		lista::td("OPM","cdopm");
		lista::td("Instaura&ccedil;&atilde;o","autuacao_data");
		lista::td("Encarregado","dutotal");
		//lista::td("Dias &Uacute;teis-Total","dutotal");
		lista::td("Andamento","andamento");
		//lista::td("Sobrest.","dusobrestado");
		lista::td("Prazo decorrido","diasuteis");
	closeTR();
	
	$i=0; //contador
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="white"):($cor="#F0F0F0");
		openTR("bgcolor='$cor'");
			echo "<td>".lista::link("atualizar")."$row[sjd_ref]/$row[sjd_ref_ano]</td>";
			echo "<td>$row[ABREVIATURA]</td>";
			echo "<td>".udf($row['autuacao_data'],"data")."</td>";
			echo "<td>$row[cargo] $row[nome]</td>";
			//if ($row["dutotal"]) echo "<td>$row[dutotal]</td>";
			//else echo "<td bgcolor='salmon'>S/Data abertura</td>";
			
			echo "<td>$row[andamento]</td>";
		
			if ($row["andamento"]=="ANDAMENTO") {
				if ($row['diasuteis']) {
					if ($row["diasuteis"]>60) echo "<td bgcolor='salmon'>$row[diasuteis]</td>";
					else echo "<td>$row[diasuteis]</td>";
				}
				else echo "<td bgcolor='salmon'>S/Data abertura</td>";
			}
			elseif ($row["andamento"]=="CONCLUÍDO") {
				echo "<td bgcolor='#8FBC8F'>Concluido</td>";
			}
			elseif ($row["andamento"]=="") {
				echo "<td bgcolor='salmon'>S/Andamento</td>";
			}
			elseif ($row["andamento"]=="SOBRESTADO") {
				echo "<td bgcolor='#FFEFD5'>Sobrestado</td>";
			}
			
		closeTR();
	$i++;
	}
	
closeTable();



?>
