<?

//Filtra para somente ver a unidade do login, incluindo os comandos.
if ($user[nivel]<4) {
	if (!$fatd->cdopm_st) $fatd->cdopm_st=$opm_login->codigoBase;
}
$fatd->sjd_ref_ano=$_SESSION[sjd_ano];

//include ("menu.inc");
include ("filtro.inc");

$sql="SELECT * FROM fatd LEFT OUTER JOIN RHPARANA.opmPMPR AS rhopm ON
	rhopm.CODIGOBASE=fatd.cdopm ";
include ("includes/filtro.php");

$sql=lista::paginas();

?>

<center>
<!-- -->
<TABLE width="100%" cellpadding="0px"  class="bordasimples">
   <tr><TD colspan="5"><center><h1><?=$opm_login->descricao;?></center></h1></TD></tr>
   <tr><TD colspan=5><h2><center>FATDs - <?echo $_SESSION[sjd_ano];?></center></h2></TD></tr>
   <TR>
		<td width="50"><b>Nº COGER</b></td>
		<td><b>OPM</b></td>
		<td><b>Síntese do fato</b></td>
		</td>
	</tr>
   	<?
	mysql_select_db("sjd");
	$res=mysql_query($sql);
	$i=0;
	while ($row=mysql_fetch_array($res)) {
		$i%2?($cor=white):($cor='#EEEEEE');
		echo "<tr bgcolor=$cor>"
		."<td><a href='?module=fatd&fatd[id]=$row[id_fatd]'>".$row['sjd_ref']."/".$row['sjd_ref_ano']."</a></td>"
		."<td>".$row['ABREVIATURA']."</td>"
		."<td>".$row['sintese_txt']."</td>"
		."</tr>";
	$i++;
	}
	?>
        </select>
	<?php lista::rodape($sql); ?>
   </TR>
   </TR>

</td></tr></table>

<br>
