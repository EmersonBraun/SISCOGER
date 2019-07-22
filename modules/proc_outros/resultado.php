<?php
//Filtra para somente ver a unidade do login, incluindo os comandos.
if ($user[nivel]<3) {
	if (!$proc_outros->opm_codigo_st) $proc_outros->cdopm_st=$opm_login->codigoBase;
}
//$proc_outros->sjd_ref_ano=$_SESSION[sjd_ano];

/*$sql="SELECT DISTINCT proc_outros.*, rhopm.ABREVIATURA, m.municipio,  
lg.origem_proc, lg.origem_sjd_ref, lg.origem_sjd_ref_ano  
FROM proc_outros
LEFT JOIN municipio AS m ON m.id_municipio=proc_outros.id_municipio
LEFT JOIN ligacao AS lg ON lg.id_proc_outros=proc_outros.id_proc_outros 
LEFT JOIN RHPARANA.opmPMPR AS rhopm ON rhopm.CODIGOBASE = proc_outros.cdopm";*/
$sql="SELECT DISTINCT proc_outros.*, rhopm.ABREVIATURA, m.municipio, 
lg.id_adl, lg.id_apfd, lg.id_cd, lg.id_cj, lg.id_desercao, lg.id_fatd,
lg.id_ipm, lg.id_iso, lg.id_it, lg.id_sindicancia, lg.id_preso, lg.id_falecimento,
lg.id_sai, lg.origem_proc, lg.origem_sjd_ref, lg.origem_sjd_ref_ano
FROM proc_outros
LEFT JOIN municipio AS m ON m.id_municipio=proc_outros.id_municipio
LEFT JOIN ligacao AS lg ON lg.id_proc_outros=proc_outros.id_proc_outros 
LEFT JOIN RHPARANA.opmPMPR AS rhopm ON rhopm.CODIGOBASE = proc_outros.cdopm_apuracao";
include ("includes/filtro.php");
//if ($_SESSION[debug]) pre($sql);

$sql=lista::paginas();
?>

<center>
<!-- -->
<table width="100%" cellpadding="0px"  class="bordasimples" id="example1">
   <tr><TD colspan="12"><center><h1><?=$opm_login->descricao;?></center></h1></TD></tr>
   <tr><TD colspan="12"><h2><center>Audi&ecirc;ncia de Cust&oacute;dia | Pedido de Provid&ecirc;ncia | Noticia de Fato - <?echo $_SESSION[sjd_ano];?></center></h2></TD></tr>
<?php
//pre($sql);
openTR();	
	
	lista::td("N&ordm; proc_outros","NRSJD");
	lista::td("OPM Apura&ccedil;&atilde;o","NROPM");
	lista::td("Sintese do fato","sintese_txt");
	lista::td("Motivo Principal","motivo_abertura");
	lista::td("Cidade","municipio");
	lista::td("Data de abertura","abertura_data");
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
	echo "<td><a href='?module=proc_outros&proc_outros[id]=$row[id_proc_outros]'>$row[sjd_ref]/$row[sjd_ref_ano]</a></td>";
	//echo "<td><a href='?module=proc_outros&proc_outros[id]=$row[id_proc_outros]'>$row[id_proc_outros]</a></td>";
	echo "<td>$row[ABREVIATURA]</td>";
	echo "<td>$row[sintese_txt]</td>";
	echo "<td>$row[motivo_abertura]</td>";
	echo "<td>$row[municipio]</td>";
	echo "<td>".data::inverte($row["abertura_data"])."</td>";
	echo "<td>$row[origem_proc]-$row[origem_sjd_ref]/$row[origem_sjd_ref_ano]</td>";
	
	$proc = ($row[origem_proc]) ? (string)$row[origem_proc] : "" ;
	//echo "<td>$proc</td>";
	/*switch ($proc) 
	{
		case 'sai':
			echo "<td><a href='?module=sai&sai[id]=$row[id_sai]'>sai-$row[origem_sjd_ref]/$row[origem_sjd_ref_ano]<a/></td>";
			break;

		case 'ipm':
			echo "<td><a href='?module=ipm&ipm[id]=$row[id_ipm]'>ipm-$row[origem_sjd_ref]/$row[origem_sjd_ref_ano]<a/></td>";
			break;

		case 'cd':
			echo "<td><a href='?module=cd&cd[id]=$row[id_cd]'>cd-$row[origem_sjd_ref]/$row[origem_sjd_ref_ano]<a/></td>";
			break;

		case 'cj':
			echo "<td><a href='?module=cj&cj[id]=$row[id_cj]'>cj-$row[origem_sjd_ref]/$row[origem_sjd_ref_ano]<a/></td>";
			break;

		case 'adl':
			echo "<td><a href='?module=adl&adl[id]=$row[id_adl]'>adl-$row[origem_sjd_ref]/$row[origem_sjd_ref_ano]<a/></td>";
			break;

		case 'fatd':
			echo "<td><a href='?module=fatd&fatd[id]=$row[id_fatd]'>fatd-$row[origem_sjd_ref]/$row[origem_sjd_ref_ano]<a/></td>";
			break;

		case 'apfd':
			echo "<td><a href='?module=apfd&apfd[id]=$row[id_apfd]'>apfd-$row[origem_sjd_ref]/$row[origem_sjd_ref_ano]<a/></td>";
			break;

		case 'desercao':
			echo "<td><a href='?module=desercao&desercao[id]=$row[id_desercao]'>desercao-$row[origem_sjd_ref]/$row[origem_sjd_ref_ano]<a/></td>";
			break;

		case 'iso':
			echo "<td><a href='?module=iso&iso[id]=$row[id_iso]'>iso-$row[origem_sjd_ref]/$row[origem_sjd_ref_ano]<a/></td>";
			break;

		case 'it':
			echo "<td><a href='?module=it&it[id]=$row[id_it]'>it-$row[origem_sjd_ref]/$row[origem_sjd_ref_ano]<a/></td>";
			break;

		case 'sindicancia':
			echo "<td><a href='?module=sindicancia&sindicancia[id]=$row[id_sindicancia]'>sindicancia-$row[origem_sjd_ref]/$row[origem_sjd_ref_ano]<a/></td>";
			break;

		case 'preso':
			echo "<td><a href='?module=preso&preso[id]=$row[id_preso]'>preso-$row[origem_sjd_ref]/$row[origem_sjd_ref_ano]<a/></td>";
			break;

		default:
			echo "<td>Sem result.</td>";
			break;
	}*/

	echo "</tr>";
	
$i++;

}

lista::rodape($sql,$lpp);

?>

</table>

