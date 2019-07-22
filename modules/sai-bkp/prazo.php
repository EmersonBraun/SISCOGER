<?php

//echo "<br>";

//sql do modulo
$sql="SELECT DISTINCT sai.id_sai, andamento, sai.cdopm, opm.ABREVIATURA, sai.sjd_ref, sai.sjd_ref_ano, 
sai.abertura_data, DIASUTEIS(abertura_data,DATE(NOW())) AS dutotal, 
b.dusobrestado, (DIASUTEIS(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis FROM sai
LEFT JOIN (SELECT id_sai, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
WHERE termino_data !='0000-00-00' AND id_sai!='' GROUP BY id_sai) AS b ON b.id_sai = sai.id_sai
LEFT JOIN RHPARANA.opmPMPR opm ON opm.CODIGOBASE=sai.cdopm
LEFT JOIN andamento AS a ON a.id_andamento=sai.id_andamento";

//$sai->cdopm_st=$opm_login->codigoBase;

//Filtro somente procedimentos do ano
//$sai->sjd_ref_ano_eq=$_SESSION['sjd_ano'];


include ("includes/filtro.php");

if ($_SESSION['debug']) pre($sql);

mysql_select_db("sjd");
$res=mysql_query($sql);
$i=0;


h1("PRAZO DOS SAI");
openTable("width='100%' class='bordasimples'");
	openLine(7);
		h2("Tempo de andamento dos SAI.<br> Data de refer&ecirc;ncia: HOJE (".date("d/m/Y").")");
	closeLine();
	
	openTR();
		lista::td("N&ordm; COGER","id_sai");
		lista::td("OPM","cdopm");
		lista::td("Abertura","abertura_data");
		//lista::td("Encarregado","nome");
		//lista::td("Dias &Uacute;teis-Total","dutotal");
		lista::td("Andamento","andamento");
		lista::td("Sobrest.","dusobrestado");
		lista::td("Dias Totais","dutotal");
	closeTR();
	
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="white"):($cor="#F0F0F0");
		openTR("bgcolor='$cor'");

			echo "<td>".lista::link("atualizar")."$row[id_sai]</td>";

			echo "<td>$row[ABREVIATURA]</td>";

			if($row['dutotal']) {
				echo "<td>".udf($row['abertura_data'],"data")."</td>";
			}else {
				echo "<td bgcolor='#FFD700'>S/Data abertura</td>";
			}
			//echo "<td>$row[cargo] $row[nome]</td>";
			

			if ($row["andamento"]!="" && $row["andamento"]!="CONCLUÍDO" && $row["andamento"]!="SOBRESTADO") {
				 echo "<td>$row[andamento]</td>";
			}
			elseif ($row["andamento"]=="CONCLUÍDO") {
				echo "<td bgcolor='#8FBC8F'>Concluido</td>";
			}
			elseif ($row["andamento"]=="") {
				echo "<td bgcolor='#FFD700'>S/Andamento</td>";
			}
			elseif ($row["andamento"]=="SOBRESTADO") {
				echo "<td bgcolor='#FFEFD5'>Sobrestado</td>";
			}
			
			echo "<td>$row[dusobrestado]</td>";
			
			if ($row["dutotal"]) {
				echo "<td>$row[dutotal]</td>";
			}else {
				echo "<td bgcolor='salmon'>S/Data abertura</td>";
			}

		closeTR();
	$i++;
	}
	
closeTable();



?>
