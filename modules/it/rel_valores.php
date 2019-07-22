<?

include ("filtro.inc");

//Filtra para somente ver a unidade do login, incluindo os comandos.
if ($user[nivel]<3) {
	if (!$it->opm_codigo_st) $it->cdopm_st=$opm_login->codigoBase;
}
$it->sjd_ref_ano=$_SESSION[sjd_ano];

$sql="SELECT it.*, rhopm.ABREVIATURA FROM it LEFT JOIN RHPARANA.opmPMPR AS rhopm ON rhopm.CODIGOBASE = it.cdopm ";
include ("includes/filtro.php");
?>

<center>
<TABLE width="100%" cellpadding="0px"  class="bordasimples">
   <tr><TD colspan="5"><center><h1><?=$opm_login->descricao;?></center></h1></TD></tr>
   <tr><TD colspan=5><h2><center>IT - Relatorio de valores - <?echo $_SESSION[sjd_ano];?></center></h2></TD></tr>
   <TR>
	<td>N&ordm; SJD</td>
	<td>OPM</td>
	<td>Viatura</td>
	<td>Dano estimado</td>
	<td>Dano real</td>
	<td></td>
   </TR>
<?
	mysql_select_db("sjd");
	$res=mysql_query($sql);
	$i=0;
	while ($row=mysql_fetch_array($res)) {
		$i%2?($cor=white):($cor='#EEEEEE');
		echo "<tr bgcolor=$cor>"
		."<td><a href='?module=it&it[id]=$row[id_it]'>".$row['sjd_ref']."/".$row['sjd_ref_ano']."</a></td>"
		."<td>".$row['ABREVIATURA']."</td>"
		."<td>$row[vtr_prefixo], (placa $row[vtr_placa])</td>"
		."<td>".udf($row['danoestimado_rs'],"var_rs")."</td>"
		."<td>".udf($row['danoreal_rs'],"var_rs")."</td>"
		."</tr>";
	$i++;
	}
	echo "<tr><td colspan=5><h1>Total: ".mysql_num_rows($res)."</h1></td></tr>";
	?>
        </select>
   </TR>
   </TR>

</td></tr></table>

<br>
