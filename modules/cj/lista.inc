<?php

$sql="SELECT * FROM cj LEFT JOIN decorrenciaconselho ON cj.id_decorrenciaconselho=decorrenciaconselho.id_decorrenciaconselho";

//Filtra para somente ver a unidade do login, incluindo os comandos.
if ($user[nivel]<4) {
	if (!$cj->opm_codigo_st) $cj->opm_codigo_st=$opm_login->codigoBase;
}
$cj->sjd_ref_ano=$_SESSION[sjd_ano];

include ("includes/filtro.php");
?>

<center>
<!-- -->
<TABLE width="100%" cellpadding="0px"  class="bordasimples">
   <tr><TD colspan="5"><center><h1><?=$opm_login->descricao;?></center></h1></TD></tr>
   <tr><TD colspan=5><h2><center>Conselhos de Justificação - <?echo $_SESSION[sjd_ano];?></center></h2></TD></tr>
   <TR><td width="80px"><b>Nº COGER</b></td><td><b>Motivo</b></td><td><b>Síntese do fato</b></td></tr>
   	<?
	mysql_select_db("sjd");
	$res=mysql_query($sql);
	$i=0;
	while ($row=mysql_fetch_array($res)) {
		$i%2?($cor=white):($cor='#EEEEEE');
		echo "<tr bgcolor=$cor>"
		."<td><a href='?module=cj&cj[id]=$row[id_cj]'>".$row['sjd_ref']."/".$row['sjd_ref_ano']."</a></td>";

		echo "<td>$row[decorrenciaconselho]";
		if ($row["outromotivo"]) echo ": ".$row["outromotivo"];
		echo "</td>";

		echo "<td>".$row['sintese_txt']."</td>"
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
