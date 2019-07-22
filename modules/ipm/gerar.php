<?php

$sql="SELECT envolvido.*,
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
		WHEN id_desercao THEN 'desercao'
	END AS proc
 FROM envolvido ";

if ($user['nivel']<4) {
	//die;
	//$sql_where[]=" cdopm LIKE '".$opm_login->codigoBase."%' ";
}


$policial=$_REQUEST[policial];
if ($policial[nome] !="") $sql_where[]=" nome LIKE '%$policial[nome]%' ";
if ($policial[cargo] !="") $sql_where[]=" cargo LIKE '%$policial[cargo]%' ";
$ii=0;

if ($sql_where[0]!='') {
	$sql.=" WHERE ";
	foreach ($sql_where as $where) {
		if ($ii!=0) $sql.=' AND ';
		$sql.=" ".$where." ";
	$ii++;
	}
}
$sql.=' ORDER BY id_envolvido DESC ';

if ($_SESSION[debug]) pre($sql);
$resultado=mysql_query($sql);
if ($resultado) $total=mysql_num_rows($resultado);

if ($_REQUEST['acao']=='gerarPDF') {
	include ("gerarpdf.php");
	die;
}

?>

<table cellpadding="0" cellspacing="1" border="0" width="100%">
	<tr>
		<td align="center">			
		<img src="img/pixel.gif" width="1" height="20" border="0"><br>
		<table cellpadding="0" cellspacing="0" width="100%" border="0"><tr><td bgcolor="#4682B4">
<table cellpadding="5" cellspacing="1" width="100%" border="0">
		
				<center><h1><?echo $login_unidade;?></h1></center>
		<table cellpadding="5" cellspacing="1" width="100%" border="0">
		<tr><td colspan="5" bgcolor="#DBEAF5"><font face="tahoma, verdana" size="2"><b><?echo "Buscando por $policial[nome];"?></b></font></td></tr>
		<td bgcolor='#ffffff' valign='top'><b>Proc.</b></td>
		<td bgcolor='#ffffff' valign='top'><b>N&ordm;</b></td>
		<td bgcolor='#ffffff' valign='top'><b>OPM</b></td>
		<td bgcolor='#ffffff' valign='top'><b>S&iacute;ntese do fato</b></td>
		<td bgcolor='#ffffff' valign='top'><b>Envolvimento</b></td>		
		<tr>
		
		<?
		if ($opm_sigla=='') $opm_sigla=$login_unidade;
		
		if ($resultado) {
			$total=0;
			while ($linha=mysql_fetch_array($resultado)) {
			//Define o procedimento
			
			//Se o procedimento esta na lista
			$procedimento=$linha['proc'];
			if ($procedimento) {

			$sql="SELECT $procedimento.*, opm.ABREVIATURA FROM $procedimento 
			LEFT JOIN RHPARANA.opmPMPR opm ON opm.CODIGOBASE= $procedimento.cdopm
			WHERE id_$procedimento = ".$linha["id_$procedimento"];"";
			//echo $sql;
			mysql_select_db("sjd",$con[8]);
			$res=mysql_query($sql);
			//if ($_SESSION[debug]) echo $sql;
			$row=mysql_fetch_array($res);
			
			//Filtro para permitir link somente para unidades subordinadas
			$mostra=1;
			$caracteres=strlen($opm_login->codigoBase);
			$codigoBase=$opm_login->codigoBase;
			if (substr($row[cdopm],0,$caracteres)!=$codigoBase) $mostra=0;
				//SJD pode ver tudo
				if ($opm_sigla=="sjd") $mostra=1;
			//Fim do filtro

			echo "<tr>";
			echo "<td bgcolor='#ffffff' valign='top'>".strtoupper($procedimento)."</b></td>";
			echo "<td bgcolor='#ffffff' valign='top'>";
			if ($mostra) echo "<a href='?module=$procedimento&".$procedimento."[id]=".$row["id_$procedimento"]."'>";
			echo $row['sjd_ref']."/".$row[sjd_ref_ano]."</td>";
		
			if ($row[opm_sigla])
				echo "<td valign='top' bgcolor='white'>&nbsp;$row[opm_sigla]</td>";
			else
				echo "<td valign='top' bgcolor='white'>$row[ABREVIATURA]</td>";

			if ($row[sintese_txt]) 
			echo "<td bgcolor='#ffffff' valign='top'>".$row['sintese_txt']."</td>";
			else
			echo "<td bgcolor='#ffffff' valign='top'>".$row['sintese_txt']."</td>";

			echo "<td bgcolor='#ffffff' valign='top'>".$linha['situacao']." - ".$linha[nome]."</td>";
			echo "</tr>";
			$total++;
			}
			}
			echo "<tr><TD colspan=5><B><font color='white'>Total: $total</font></B></TD></tr>";
		}
		else {
			echo "<tr bgcolor=White><td colspan=7><center><b>N&atilde;o h&aacute; envolvimentos para o Policial Militar $policial[nome] (Processos do ".$opm_login->abreviatura.")</b></center></td></tr>";
		}
		
		?>
		
		</table>

<br>
