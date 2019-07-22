<?php 
$module='cj';
if ($user[nivel]<3) {
	if (!$cj->opm_codigo_st) $cj->cdopm_st=$opm_login->codigoBase;
}
//PENDENCIA # sobrestamnto CJ-------------------------
$sql="SELECT s.*, cj.cdopm, cj.abertura_data, cj.fato_data, cj.sintese_txt,
cj.sjd_ref, cj.sjd_ref_ano, opm.ABREVIATURA,
DIASUTEIS(cj.abertura_data,DATE(NOW()))+1 
AS dutotal,
b.dusobrestado, (DIASUTEIS(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) 
AS diasuteis FROM sobrestamento AS s
LEFT JOIN (SELECT id_cj, DIASUTEIS(inicio_data, DATE(NOW())) 
AS dusobrestado FROM sobrestamento
WHERE termino_data ='0000-00-00' AND id_cj!='') 
AS b ON b.id_cj = s.id_cj
INNER JOIN cj ON
		s.id_cj=cj.id_cj 
LEFT JOIN RHPARANA.opmPMPR AS opm ON
		opm.CODIGOBASE=cj.cdopm
WHERE s.termino_data ='0000-00-00' AND cj.id_andamento='14'";
include ("includes/filtro.php");
if ($_SESSION["debug"]) pre($sql);
$res=mysql_query($sql);

h1("Sobrestamento - CJ");
openTable("class='bordasimples' width='100%'");

if (mysql_num_rows($res)>0) {

	openTR();	
		lista::td("N&ordm; CJ","NRSJD");
		lista::td("OPM Apura&ccedil;&atilde;o","NROPM");
		lista::td("Sintese do fato","sintese_txt");
		lista::td("Motivo Sobrest.","motivo");
		lista::td("Data do fato","fato_data");
		lista::td("Data de abertura","abertura_data");
		lista::td("Data in&iacute;cio Sobr.","inicio_data");
		lista::td("Dias Sobrestado.","dusobrestado");
	closeTR();
	//mostra as pendencias
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");

		openTR("bgcolor='$cor'"); 
			echo "<td><a href='?module=cj&cj[id]=$row[id_cj]' target='_blank'>$row[sjd_ref]/$row[sjd_ref_ano]</a></td>";
			echo "<td>$row[ABREVIATURA]</td>";
			echo "<td>$row[sintese_txt]</td>";
			if ($row[motivo]=='') 
			{
				echo "<td>$row[motivo_outros]</td>";
			}
			else
			{
				if($row[motivo]=='outros')
				{
					echo "<td>$row[motivo] : $row[motivo_outros]</td>";
				}
				else
				{
					echo "<td>$row[motivo]</td>";
				}
			}
			echo "<td>".data::inverte($row["fato_data"])."</td>";
			echo "<td>".data::inverte($row["abertura_data"])."</td>";
			echo "<td>".data::inverte($row["inicio_data"])."</td>";
			echo "<td>$row[dusobrestado]</td>";
		closeTD(); 

		$i++;

		$totalPendencias++;
	}
	openLine(8); h2("Total Sobrestamento-CJ: $i"); closeLine();
}
else echo "N&atilde;o h&aacute; Sobrestamento-CJ";
closeTable();

//guarda variavel para atualizar tabela geral
$atualiza["sobrestamento_prazo"]=$i;
$i=0;
echo "<br>";

?>