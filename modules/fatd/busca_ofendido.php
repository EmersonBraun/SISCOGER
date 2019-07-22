<?
 global $login,$login_unidade, $nivel;
 
 $UNIDADES_CPC=array('12bpm','13bpm','17bpm','20bpm','rpmon','bpgd','ciaindpgd','bptran','ciapchq');
 $UNIDADES_CPI=array('1bpm','2bpm','3bpm','4bpm','5bpm','6bpm','7bpm','8bpm','9bpm','10bpm','11bpm','14bpm','15bpm','16bpm','18bpm','19bpm','bpambfv','bprv','1ciaind','2ciaind','3ciaind','4ciaind');
 $UNIDADES_CCB=array('1gb','2gb','3gb','4gb','5gb','6gb','1sgbi','2sgbi');
  
 /* Gera o Relatório*/
if ($_REQUEST['acao']=='gerar' OR $_REQUEST['acao']=='gerarPDF') {
$sql='SELECT * FROM ofendido ';
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
if ($_SESSION[debug]) pre($sql);
$resultado=mysql_query($sql);
if ($resultado) $total=mysql_num_rows($resultado);

if ($_REQUEST['acao']=='gerarPDF') {
	include ("gerarpdf.php");
	die;
}
}  
 ?>

	<table cellpadding="0" cellspacing="1" border="0" width="100%">
	<tr>
		<td align="center">			
		<img src="img/pixel.gif" width="1" height="20" border="0"><br>
		<table cellpadding="0" cellspacing="0" width="95%" border="0"><tr><td bgcolor="#4682B4">
		<center><h1>Inquéritos Policiais Militares</h1></center>
		<table cellpadding="5" cellspacing="1" width="100%" border="0">
		<tr><th colspan="2" bgcolor="#DBEAF5"><font face="tahoma, verdana" size="2">Busca Nominal</font></td></tr>
		
		<tr>
		<td bgcolor="#ffffff" valign="top">
			
		<form name="relatorio" action='index.php?module=ipm&opcao=busca_ofendido&acao=gerar' method=post>
		<table border=0 cellpadding=0 celindexlspacing=0>
			<tbody>
			<tr>	
				<td><b>Ofendido envolvido em IPM:</b></td>
			</tr><tr>
				<td>
					<input type=text size=30 ajax=1 name=policial[nome] value="<?echo $policial[nome];?>">
				</td>
			</tr>
	
	<tr bgcolor=white><td colspan=4 bgcolor=white align=left><input type=submit border=0 value=Filtrar>&nbsp;<input type=submit border=0 value='Gerar PDF'></td></tr>

<?
if ($_REQUEST['acao']=='gerar') {
?>
</table></table></table>
	<table cellpadding="0" cellspacing="1" border="0" width="100%">
	<tr>
		<td align="center">			
		<img src="img/pixel.gif" width="1" height="20" border="0"><br>
		<table cellpadding="0" cellspacing="0" width="95%" border="0"><tr><td bgcolor="#4682B4">
<table cellpadding="5" cellspacing="1" width="100%" border="0">
		
				<center><h1><?echo $login_unidade;?></h1></center>
		<table cellpadding="5" cellspacing="1" width="100%" border="0">
		<tr><th colspan="5" bgcolor="#DBEAF5"><font face="tahoma, verdana" size="2">Inqueritos Policiais Militares - <b><?echo "Buscando por $policial[nome];"?></b></font></td></tr>
		<td bgcolor='#ffffff' valign='top'><b>Motivo/OPM</b></td>
		<td bgcolor='#ffffff' valign='top'><b>N&ordm; IPM</b></td>
		<td bgcolor='#ffffff' valign='top'><b>S&iacute;ntese do fato</b></td>
		<td bgcolor='#ffffff' valign='top'><b>Envolvimento</b></td>		
		<tr>
		
		<?
		if ($opm_sigla=='') $opm_sigla=$login_unidade;
		
		if ($resultado) {
			$total=0;
			while ($linha=mysql_fetch_array($resultado)) {
			$sql="SELECT * FROM ipm WHERE id_ipm=$linha[id_ipm]";
			$res=mysql_query($sql);
			if ($_SESSION[debug]) echo $sql;
			$row=mysql_fetch_array($res);
			$mostra=1;
			if ($opm_sigla=='cpc' && !in_array($row['opm_sigla'],$UNIDADES_CPC)) $mostra=0;
			if ($opm_sigla=='cpi' && !in_array($row['opm_sigla'],$UNIDADES_CPI)) $mostra=0;
			if ($opm_sigla=='ccb' && !in_array($row['opm_sigla'],$UNIDADES_CCB)) $mostra=0;
			if ($opm_sigla!="cpc" && $opm_sigla!="cpi" && $opm_sigla!="ccb") {
				if ($opm_sigla!=$row[opm_sigla]) $mostra=0;
			}
			if ($opm_sigla=="sjd") $mostra=1;

			$ano=$row['opm_ref_ano'];
			echo "<tr>";
			echo "<td bgcolor='#ffffff' valign='top'>".$row['crime']."/".$row[opm_sigla]."</b></td>";
			echo "<td bgcolor='#ffffff' valign='top'>";
			if ($mostra) echo "<a href='?module=ipm&ipm[id]=".$row['id_ipm']."'>";
			echo $row['sjd_ref']."/$ano</td>";
			echo "<td bgcolor='#ffffff' valign='top'>".$row['sintese']."</td>";
			echo "<td bgcolor='#ffffff' valign='top'>".$linha['situacao']." - ".$linha[nome]."</td>";
			echo "</tr>";
			$total++;

			}
			echo "<tr><TD><font color='white'>Total: $total</font></TD></tr>";
		}
		else {
			echo "<tr bgcolor=White><td colspan=7><center><b>Não há envolvimentos o nome $policial[nome]</b></center></td></tr>";
		}
		
		?>
		
		</table>

<br>
<?}?>
