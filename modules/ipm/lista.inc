<?php

//Filtra para somente ver a unidade do login, incluindo os comandos.
if ($user[nivel]<4) {
	if (!$ipm->cdopm_st) $ipm->cdopm_st=$opm_login->codigoBase;
}
$ipm->opm_ref_ano=$_SESSION[sjd_ano];

include ("filtro.inc");

$sql="SELECT * FROM ipm 
	LEFT JOIN municipio ON municipio.id_municipio=ipm.id_municipio
	LEFT JOIN andamento ON andamento.id_andamento=ipm.id_andamento
	LEFT JOIN andamentocoger ON andamentocoger.id_andamentocoger=ipm.id_andamentocoger
	LEFT JOIN RHPARANA.opmPMPR opm ON opm.CODIGOBASE = ipm.cdopm";
include ("includes/filtro.php");
if ($_SESSION[debug]) pre($sql);
?>

<center>
<!-- -->
<TABLE width="100%" cellpadding="0px"  class="bordasimples">
   <tr><TD colspan="10"><center><h1><?=$opm_login->descricao;?></center></h1></TD></tr>
   <tr><TD colspan="10"><h2><center>Inqúeritos Policiais Militares - <?echo $_SESSION[sjd_ano];?></center></h2></TD></tr>
	<?php

	openTR();	
	foreach ($mostrar as $campo) {
		if     ($campo=="NROPM") echo "<td><b>OPM</b></td>";
		elseif ($campo=="NRSJD") echo "<td><b>N&ordm; COGER</b></td>";
		elseif ($campo=="eproc") lista::td("N&ordm; EPROC","eproc");
		elseif ($campo=="crime") lista::td("Crime","crime");
		elseif ($campo=="confronto_armado_bl") lista::td("Confronto armado","confronto_armado_bl");
		elseif ($campo=="municipio") lista::td("Munic&iacute;pio","municipio");
		elseif ($campo=="andamento") lista::td("Andamento","andamento");
		elseif ($campo=="fato_data") lista::td("Data do fato","fato_data");
		elseif ($campo=="andamentocoger") lista::td("And. COGER","andamentocoger");
		else echo "<td><b>".ucwords(strtolower($campo))."</b></td>";
	}
	closeTR();
	
	mysql_select_db("sjd");
	$res=mysql_query($sql);
	$i=0;
	

	while ($row=mysql_fetch_array($res)) {
		$i%2?($cor=white):($cor='#EEEEEE');
		echo "<tr bgcolor=$cor>";

		//Imprime cada um dos campos selecionados para ser mostrado			
		foreach ($mostrar as $campo) {
			//campos em maiusculo, mostra mais de uma informacao
			if     ($campo=="NROPM") echo "<td>$row[ABREVIATURA]</td>";
			elseif ($campo=="NRSJD") echo "<td><a href='?module=ipm&ipm[id]=$row[id_ipm]'>$row[sjd_ref]/$row[sjd_ref_ano]</a></td>";
			elseif ($campo=="eproc") echo "<td>$row[n_eproc]/$row[ano_eproc]</td>";
			elseif ($campo=="DEFENSOR") echo "<td>$row[defensor_oab] $row[defensor_nome]</td>";
			elseif ($campo=="fato_data") echo "<td>".data::inverte($row["fato_data"])."</td>";
			else echo "<td>$row[$campo]</td>";
		}

		echo "</tr>";
	$i++;
	}
	echo "<tr><td colspan='10'><h1>Total: ".mysql_num_rows($res)."</h1></td></tr>";
	?>
        </select>
   </TR>
   </TR>

</td></tr></table>

<br>
