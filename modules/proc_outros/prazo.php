<?php

//echo "<br>";

//sql do modulo
/*$sql="SELECT DISTINCT proc_outros.id_proc_outros, proc_outros.andamento, proc_outros.andamentocoger,
proc_outros.cdopm, proc_outros.cdopm_apuracao, opm.ABREVIATURA, proc_outros.sjd_ref, proc_outros.sjd_ref_ano, 
proc_outros.data, proc_outros.abertura_data, proc_outros.opm_abreviatura,
DIASUTEIS(abertura_data,DATE(NOW())) AS dutotal, 
b.dusobrestado, (DIASUTEIS(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis FROM proc_outros
LEFT JOIN (SELECT id_proc_outros, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
WHERE termino_data !='0000-00-00' AND id_proc_outros!='' GROUP BY id_proc_outros) AS b ON b.id_proc_outros = proc_outros.id_proc_outros
LEFT JOIN RHPARANA.opmPMPR opm ON opm.CODIGOBASE=proc_outros.cdopm_apuracao";*/

$proc_outros->sjd_ref_ano=$_SESSION[sjd_ano];

if ($opm_login->codigoBase != '020') 
{
	$sql="SELECT DISTINCT proc_outros.id_proc_outros, proc_outros.andamento, proc_outros.andamentocoger,
	proc_outros.cdopm, proc_outros.cdopm_apuracao, opm.ABREVIATURA, proc_outros.sjd_ref, proc_outros.sjd_ref_ano, 
	proc_outros.data, proc_outros.abertura_data, proc_outros.limite_data, proc_outros.opm_abreviatura,
	DIASUTEIS(abertura_data,DATE(NOW())) AS ducorridos,
	DATEDIFF(DATE(NOW()),abertura_data) AS dtcorridos,
	DIASUTEIS(abertura_data,limite_data) AS dutotal,
	DATEDIFF(limite_data,abertura_data) AS dttotal ,
	DIASUTEIS(DATE(NOW()),limite_data) AS dufaltando,
	DATEDIFF(limite_data,DATE(NOW())) AS dtfaltando
	FROM proc_outros
	LEFT JOIN RHPARANA.opmPMPR opm ON opm.CODIGOBASE=proc_outros.cdopm_apuracao
	WHERE  cdopm  LIKE '$opm_login->codigoBase%' OR  cdopm_apuracao LIKE '$opm_login->codigoBase%'
	AND  sjd_ref_ano  LIKE '%$proc_outros->sjd_ref_ano%'  ORDER BY id_proc_outros DESC
	";
}
else
{
	$sql="SELECT DISTINCT proc_outros.id_proc_outros, proc_outros.andamento, proc_outros.andamentocoger,
	proc_outros.cdopm, proc_outros.cdopm_apuracao, opm.ABREVIATURA, proc_outros.sjd_ref, proc_outros.sjd_ref_ano, 
	proc_outros.data, proc_outros.abertura_data, proc_outros.limite_data, proc_outros.opm_abreviatura,
	DIASUTEIS(abertura_data,DATE(NOW())) AS ducorridos,
	DATEDIFF(DATE(NOW()),abertura_data) AS dtcorridos,
	DIASUTEIS(abertura_data,limite_data) AS dutotal,
	DATEDIFF(limite_data,abertura_data) AS dttotal ,
	DIASUTEIS(DATE(NOW()),limite_data) AS dufaltando,
	DATEDIFF(limite_data,DATE(NOW())) AS dtfaltando
	FROM proc_outros
	LEFT JOIN RHPARANA.opmPMPR opm ON opm.CODIGOBASE=proc_outros.cdopm_apuracao";
}


//$proc_outros->cdopm_st=$opm_login->codigoBase;

//Filtro somente procedimentos do ano
//$proc_outros->sjd_ref_ano_eq=$_SESSION['sjd_ano'];


//include ("includes/filtro.php");

if ($_SESSION['debug']) pre($sql);

mysql_select_db("sjd");
$res=mysql_query($sql);
$i=0;


h1("PRAZO DOS proc_outros");
openTable("width='100%' class='bordasimples'");
	openLine(14);
		h2("Tempo de andamento dos proc_outros.<br> Data de refer&ecirc;ncia: HOJE (".date("d/m/Y").")");
	closeLine();
	
	openTR();
		lista::td("N&ordm; COGER","id_proc_outros");
		lista::td("OPM Abertura","cdopm");
		lista::td("OPM Apuração","cdopm_apuracao");
		lista::td("Data Fato","data");
		lista::td("Recebimento","abertura_data");
		lista::td("Data Limite","limite_data");
		lista::td("Andamento","andamento");
		lista::td("COGER","andamentocoger");
		lista::td("Dias &Uacute;teis Totais","dutotal");
		lista::td("Dias Totais","dttotal");
		lista::td("Dias &Uacute;teis corridos","ducorridos");
		lista::td("Dias corridos","dtcorridos");
		lista::td("Dias &Uacute;teis faltando","dufaltando");
		lista::td("Dias faltando","dtfaltando");
	closeTR();
	
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="white"):($cor="#F0F0F0");
		openTR("bgcolor='$cor'");
			//num COGER
			echo "<td>".lista::link("atualizar")."$row[sjd_ref]/$row[sjd_ref_ano]</td>";
			//OPM abertura
			echo "<td>$row[opm_abreviatura]</td>";
			//OPM apuração
			echo "<td>$row[ABREVIATURA]</td>";
			//data do fato
			echo "<td>".udf($row['data'],"data")."</td>";
			//data do recebimento
			if($row['dutotal']) {
				echo "<td>".udf($row['abertura_data'],"abertura_data")."</td>";
			}else {
				echo "<td bgcolor='#FFD700'>S/Data recebimento</td>";
			}
			//data limite
			if($row['limite_data'] !== '0000-00-00') {
				echo "<td>".udf($row['limite_data'],"limite_data")."</td>";
			}else {
				echo "<td bgcolor='LightBlue'>S/Data limite</td>";
			}
			//andamento
			if ($row["andamento"]!="" && $row["andamento"]!="CONCLUÍDO" && $row["andamento"]!="SOBRESTADO") {
				 echo "<td>$row[andamento]</td>";
			}
			elseif ($row["andamento"]=="CONCLUÍDO") {
				echo "<td bgcolor='#8FBC8F'>Concluido</td>";
			}
			elseif ($row["andamento"]=="") {
				echo "<td bgcolor='#FFD700'>S/Andamento</td>";
			}
			//andamentocoger
			echo "<td>$row[andamentocoger]</td>";
			//dias uteis total	
			if ($row["dutotal"]) {
				echo "<td>$row[dutotal]</td>";
			}else {
				echo "<td bgcolor='salmon'>S/Data recebimento</td>";
			}
			//dias totais	
			echo "<td>$row[dttotal]</td>";
			//dias uteis corridos
			echo "<td>$row[ducorridos]</td>";
			//dias corridos
			echo "<td>$row[dtcorridos]</td>";
			//dias uteis faltando
			$prazo = ($row[dufaltando] < 0) ? 'red' : '';
			echo "<td bgcolor='$prazo'>$row[dufaltando]</td>";
			//dias faltando
			echo "<td bgcolor='$prazo'>$row[dtfaltando]</td>";
	$i++;
	}
	
closeTable();



?>
