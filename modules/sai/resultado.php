<?php
//Filtra para somente ver a unidade do login, incluindo os comandos.
if ($user[nivel]<3) {
	if (!$sai->opm_codigo_st) $sai->cdopm_st=$opm_login->codigoBase;
}
//$sai->sjd_ref_ano=$_SESSION[sjd_ano];

$sql="SELECT DISTINCT sai.*, rhopm.ABREVIATURA, m.municipio,  
lg.origem_proc, lg.origem_sjd_ref, lg.origem_sjd_ref_ano  
FROM sai
LEFT JOIN municipio AS m ON m.id_municipio=sai.id_municipio
LEFT JOIN ligacao AS lg ON lg.id_sai=sai.id_sai 
LEFT JOIN RHPARANA.opmPMPR AS rhopm ON rhopm.CODIGOBASE = sai.cdopm_fato";
include ("includes/filtro.php");
if ($_SESSION[debug]) pre($sql);

$sql=lista::paginas();
?>

<center>
<!-- -->
<table width="100%" cellpadding="0px"  class="bordasimples" id="example1">
   <tr><TD colspan="12"><center><h1><?=$opm_login->descricao;?></center></h1></TD></tr>
   <tr><TD colspan="12"><h2><center>Policiais - Investiga&ccedil;&atilde;o - <?echo $_SESSION[sjd_ano];?></center></h2></TD></tr>
<?php
//pre($sql);
openTR();	
	
	lista::td("N&ordm; SAI","NRSJD");
	lista::td("OPM","NROPM");
	lista::td("Sintese do fato","sintese_txt");
	lista::td("Motivo Principal","motivo_principal");
	lista::td("Cidade","municipio");
	lista::td("Data do fato","fato_data");
	lista::td("Resultado","resultado");
	//else echo "<td><b>".ucwords(strtolower($campo))."</b></td>";

closeTR();

mysql_select_db("sjd");
$res=mysql_query($sql);
$i=0;

if ($res == 0 || $res == NULL){$lpp = 0; $sql=0;} else {$lpp = 60;}//caso não tenha dados na pesquisa

while ($row=mysql_fetch_array($res)) {
	$i%2?($cor=white):($cor='#EEEEEE');
	echo "<tr bgcolor=$cor>";
	if ($row["sjd_ref_ano"]!=="0") 
	{
		echo "<td>".lista::link("atualizar")."$row[sjd_ref]/$row[sjd_ref_ano]</td>";
	}
	else
	{
		echo "<td>".lista::link("atualizar")."$row[id_sai]</a></td>";
	}
	echo "<td>$row[ABREVIATURA]</td>";
	echo "<td>$row[sintese_txt]</td>";
	echo "<td>$row[motivo_principal]</td>";
	echo "<td>$row[municipio]</td>";
	echo "<td>".data::inverte($row["data"])."</td>";
	echo "<td>$row[origem_proc]-$row[origem_sjd_ref]/$row[origem_sjd_ref_ano]</td>";
	echo "</tr>";
	
$i++;

}

lista::rodape($sql,$lpp);

?>

</table>

