<?php

//Filtra para somente ver a unidade do login, incluindo os comandos.
if ($user[nivel]<4) {
	if (!$sindicancia->cdopm_st) $sindicancia->cdopm_st=$opm_login->codigoBase;
}
$sindicancia->sjd_ref_ano=$_SESSION[sjd_ano];

$sql="SELECT * FROM sindicancia left JOIN RHPARANA.opmPMPR AS rh ON
	sindicancia.cdopm=rh.codigobase ";
include ("includes/filtro.php");
include ("filtro.inc");

?>

<center>
<!-- -->
<TABLE width="100%" cellpadding="0px"  class="bordasimples">
   <tr><TD colspan="5"><center><h1><?=$opm_login->descricao;?></center></h1></TD></tr>
   <tr><TD colspan=5><h2><center>Sindicâncias - <?echo $_SESSION[sjd_ano];?></center></h2></TD></tr>
   <TR>
	<td width="50"><b>N&ordm; COGER</b></td>
	<td><b>OPM</b></td>
	<td><b>S&iacute;ntese do fato</b></td>
   </TR>

   	<?
	mysql_select_db("sjd");
	if ($_SESSION['debug']) pre ($sql);
	$res=mysql_query($sql);
	$i=0;
	while ($row=mysql_fetch_array($res)) {
		$i%2?($cor=white):($cor='#EEEEEE');
		echo "<tr bgcolor=$cor>"
		."<td><a href='?module=sindicancia&sindicancia[id]=$row[id_sindicancia]'>".$row['sjd_ref']."/".$row['sjd_ref_ano']."</a></td>"
		."<td>".$row['ABREVIATURA']."</td>"
		."<td>".$row['sintese_txt']."</td>"
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
