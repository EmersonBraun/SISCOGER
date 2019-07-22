<?php

//error_reporting(E_ALL);

//include ("menu.inc");
include ("filtro.inc");

//echo "<br>";

//Filtro somente procedimentos do ano
$fatd->sjd_ref_ano_eq=$_SESSION['sjd_ano'];
//sql do modulo
$sql="SELECT DISTINCT fatd.id_fatd, andamento, andamentocoger,
	(
		SELECT  motivo
		FROM    sobrestamento
		WHERE   sobrestamento.id_fatd=fatd.id_fatd 
		ORDER BY sobrestamento.id_sobrestamento DESC
		LIMIT 1
	) AS motivo,  
	(
		SELECT  motivo_outros
		FROM    sobrestamento
		WHERE   sobrestamento.id_fatd=fatd.id_fatd 
		ORDER BY sobrestamento.id_sobrestamento DESC
		LIMIT 1
	) AS motivo_outros,
envolvido.cargo, envolvido.nome, cdopm, opm.ABREVIATURA, sjd_ref, sjd_ref_ano, abertura_data, DIASUTEIS(abertura_data,DATE(NOW()))+1 AS dutotal, 
	b.dusobrestado, 
	(DIASUTEIS(abertura_data,DATE(NOW()))+1-IFNULL(b.dusobrestado,0)) AS diasuteis FROM fatd
	LEFT JOIN
	(SELECT id_fatd, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado fROM sobrestamento
		WHERE termino_data !='0000-00-00' AND id_fatd!='' 
		GROUP BY id_fatd) b
		ON b.id_fatd = fatd.id_fatd
	LEFT JOIN RHPARANA.opmPMPR opm ON
		opm.CODIGOBASE=fatd.cdopm
	LEFT JOIN envolvido ON
		envolvido.id_fatd=fatd.id_fatd AND envolvido.situacao='Encarregado' AND rg_substituto=''
	LEFT JOIN andamento ON
		andamento.id_andamento=fatd.id_andamento
	LEFT JOIN andamentocoger ON
		andamentocoger.id_andamentocoger=fatd.id_andamentocoger
	";

//Filtra para somente ver a unidade do login, incluindo os comandos.
if ($user[nivel]<4) {
	if (!$fatd->cdopm_st) $fatd->cdopm_st=$opm_login->codigoBase;
}


//$_REQUEST['orderby']="fatd.id_fatd DESC";


include ("includes/filtro.php");

if ($_SESSION['debug']) pre($sql);

//pre($sql); die;

$res=mysql_query($sql);

h1("PRAZO DOS FATD (".$opm_login->abreviatura.")");
openTable("width='100%' class='bordasimples'");
	openLine(9);
		h2("Calculo do prazo dos FATD - contado em dias uteis, conta-se o primeiro dia.<br> Sao descontados os dias em que o procedimento ficou sobrestado.<br> Data de refer&ecirc;ncia: HOJE (".date("d/m/Y").")");
	closeLine();
	
	openTR();
		lista::td("N&ordm; COGER","sjd_ref");
		lista::td("OPM","cdopm");
		lista::td("Abertura","abertura_data");
		lista::td("Encarregado","dutotal");
		//lista::td("Dias &Uacute;teis-Total","dutotal");
		lista::td("Andamento","andamento");
		lista::td("And. COGER","andamentocoger");
		lista::td("Sobrest.","dusobrestado");
		lista::td("Motivo Sobrest.","motivo");
		lista::td("Prazo decorrido","diasuteis");
	closeTR();
	
	$i=0; //contador
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="white"):($cor="#F0F0F0");
		openTR("bgcolor='$cor'");
			echo "<td>".lista::link("atualizar")."$row[sjd_ref]/$row[sjd_ref_ano]</td>";
			echo "<td>$row[ABREVIATURA]</td>";
			echo "<td>".udf($row['abertura_data'],"data")."</td>";
			echo "<td>$row[cargo] $row[nome]</td>";
			//if ($row["dutotal"]) echo "<td>$row[dutotal]</td>";
			//else echo "<td bgcolor='salmon'>S/Data abertura</td>";
			
			echo "<td>$row[andamento]</td>";
			echo "<td>$row[andamentocoger]</td>";
			echo "<td>$row[dusobrestado]</td>";
			//motivo do sobrestamento
			if ($row["andamento"]=="SOBRESTADO") 
			{
				if ($row["motivo"]=="" || $row["motivo"]=="outros") 
				{
					echo "<td>$row[motivo_outros]</td>";
				}
				else
				{
					echo "<td>$row[motivo]</td>";
				}
			} else {
				echo "<td>N&atilde;o Sobrest.</td>";
			}
			//andamento
			if ($row["andamento"]=="ANDAMENTO") {
				if ($row['dutotal']) {
					if ($row["diasuteis"]>30) echo "<td bgcolor='salmon'>$row[diasuteis]</td>";
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
