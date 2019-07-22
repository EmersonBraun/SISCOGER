<?
 global $login,$login_unidade, $nivel;
 
 $UNIDADES_CPC=array('12bpm','13bpm','17bpm','20bpm','rpmon','bpgd','ciaindpgd','bptran','ciapchq');
 $UNIDADES_CPI=array('1bpm','2bpm','3bpm','4bpm','5bpm','6bpm','7bpm','8bpm','9bpm','10bpm','11bpm','14bpm','15bpm','16bpm','18bpm','19bpm','bpambfv','bprv','1ciaind','2ciaind','3ciaind','4ciaind');
 $UNIDADES_CCB=array('1gb','2gb','3gb','4gb','5gb','6gb','1sgbi','2sgbi');
  
 /* Gera o Relatório*/
if ($_REQUEST['acao']=='gerar' OR $_REQUEST['acao']=='gerarPDF') {
$sql="SELECT ofendido.*,
	CASE
		WHEN id_ipm THEN 'ipm'
		WHEN id_sindicancia THEN 'sindicancia'
		WHEN id_cj THEN 'cj'
		WHEN id_cd THEN 'cd'
		WHEN id_it THEN 'it'
		WHEN id_adl THEN 'adl'
		WHEN id_apfd THEN 'apfd'
		WHEN id_fatd THEN 'fatd'
		WHEN id_iso THEN 'iso'
		WHEN id_proc_outros THEN 'proc_outros'
		WHEN id_sai THEN 'sai'
	END AS proc
	FROM ofendido ";
$policial=$_REQUEST[policial];
  
if ($policial[nome]!="") $sql_where[]=" nome LIKE '%$policial[nome]%' ";
 
$ii=0;
if ($sql_where[0]!='') {
	$sql.=" WHERE ";
	foreach ($sql_where as $where) {
		if ($ii!=0) $sql.=' AND ';
		$sql.=$where;
	$ii++;
	}
 }

$sql.=' ORDER BY id_ipm DESC ';

//pre($sql);

if ($_SESSION[debug]) pre($sql);
$resultado=mysql_query($sql);
if ($resultado) $total=mysql_num_rows($resultado);

if ($_REQUEST['acao']=='gerarPDF') {
	include ("gerarpdf.php");
	die;
}
}  
 ?>

<table cellpadding="0" cellspacing="0" width="100%" border="0"><tr><td bgcolor="#4682B4">
	<center><h1>Busca de ofendido</h1></center>
	<table cellpadding="5" cellspacing="1" width="100%" border="0">
	<tr><th colspan="2" bgcolor="#DBEAF5"><font face="tahoma, verdana" size="2">Busca Nominal</font></td></tr>
	
	<tr>
	<td bgcolor="#ffffff" valign="top">
		
	<form name="relatorio" action='index.php?module=ipm&opcao=busca_ofendido&acao=gerar' method=post>
	<table border=0 cellpadding=0 celindexlspacing=0>
		<tbody>
		<tr>	
			<td><b>Ofendido envolvido:</b></td>
		</tr><tr>
			<td>
				<input type=text size=30 ajax=1 name=policial[nome] value="<?echo $policial[nome];?>">
			</td>
		</tr>

<tr bgcolor=white><td colspan=4 bgcolor=white align=left><input type=submit border=0 value=Filtrar></td></tr>

<?
if ($_REQUEST['acao']=='gerar') {
?>
</table></table></table>
<table cellpadding="0" cellspacing="1" border="0" width="100%">
<tr>
	<td align="center">			
	<img src="img/pixel.gif" width="1" height="20" border="0"><br>
	<table cellpadding="0" cellspacing="0" width="100%" border="0"><tr><td bgcolor="#4682B4">
<table cellpadding="5" cellspacing="1" width="100%" border="0">
	
			<center><h1><?echo $login_unidade;?></h1></center>
	<table cellpadding="5" cellspacing="1" width="100%" border="0">
	<tr><th colspan="5" bgcolor="#DBEAF5"><font face="tahoma, verdana" size="2">Inqueritos Policiais Militares - <b><?echo "Buscando por $policial[nome];"?></b></font></td></tr>
	<td bgcolor='#ffffff' valign='top'><b>Procedimento</b></td>
	<td bgcolor='#ffffff' valign='top'><b>S&iacute;ntese do fato</b></td>
	<td bgcolor='#ffffff' valign='top'><b>Envolvimento</b></td>		
	<tr>
	
	<?
	if ($opm_sigla=='') $opm_sigla=$login_unidade;
	
	if ($resultado) {
		$total=0;
		while ($linha=mysql_fetch_array($resultado)) {
		$proc=$linha['proc'];
		$sql="SELECT * FROM $proc WHERE id_$proc=".$linha["id_$proc"]."";
		$res=mysql_query($sql);
		if ($_SESSION[debug]) echo $sql;
		$row=mysql_fetch_array($res);
		if ($opm_sigla=="sjd") $mostra=1; 
		else {
			if (substr($row['cdopm'],0,strlen($opm_proto->codigoBase))==$opm_proto->codigoBase ) $mostra=1;
			else $mostra=0;
		}
		
		
		$ano=$row['opm_ref_ano'];
		echo "<tr>";
		//echo "<td bgcolor='#ffffff' valign='top'>".$row['crime']."/".$row[opm_sigla]."</b></td>";
		echo "<td bgcolor='#ffffff' valign='top'>";
		if ($mostra) echo "<a href='?module=$proc&".$proc."[id]=".$linha["id_$proc"]."'>";
		echo "$proc $row[sjd_ref]/$row[sjd_ref_ano]</td>";
		//echo "<td>$row[cdopm]</td>";
		echo "<td bgcolor='#ffffff' valign='top'>".$row['sintese_txt']."</td>";
		echo "<td bgcolor='#ffffff' valign='top'>".$linha['situacao']." - ".$linha[nome]."</td>";
		echo "</tr>";
		$total++;

		}
		echo "<tr><TD><h1>Total: $total</h1></TD></tr>";
	}
	else {
		echo "<tr bgcolor=White><td colspan=7><center><b>Não há envolvimentos o nome $policial[nome]</b></center></td></tr>";
	}
	
	?>
	
	</table>

<br>
<?}?>
