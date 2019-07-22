<?php

$sql="SELECT * FROM adl LEFT JOIN decorrenciaconselho ON adl.id_decorrenciaconselho=decorrenciaconselho.id_decorrenciaconselho";


//Filtra para somente ver a unidade do login, incluindo os comandos.
$adl->sjd_ref_ano=$_SESSION[sjd_ano];

include ("includes/filtro.php");

//echo $sql;
?>

<center>
<!-- -->
<TABLE width="100%" cellpadding="0px"  class="bordasimples">
   <tr><TD colspan="5"><center><h1><?=$opm_login->descricao;?></center></h1></TD></tr>
   <tr><TD colspan=5><h2><center>Apuração Disciplinar de Licenciamento - <?echo $_SESSION[sjd_ano];?></center></h2></TD></tr>
   <TR><td width="80"><b>Nº COGER</b></td><td><b>Motivo</b></td><td><b>Síntese do fato</b></td></tr>
   	<?
	mysql_select_db("sjd");
	$res=mysql_query($sql);
	$i=0;
	while ($row=@mysql_fetch_array($res)) {
		$i%2?($cor=white):($cor='#EEEEEE');
		echo "<tr bgcolor=$cor>"
		."<td><a href='?module=adl&adl[id]=$row[id_adl]'>".$row['sjd_ref']."/".$row['sjd_ref_ano']."</a></td>";
		
		echo "<td>$row[decorrenciaconselho]";
		if ($row["outromotivo"]) echo ": ".$row["outromotivo"];
		echo "</td>";


		echo "<td>".$row['sintese_txt']."</td>"
		."</tr>";
	$i++;
	}
	echo "<tr><td colspan=5><h1>Total: ".@mysql_num_rows($res)."</h1></td></tr>";
	?>
        </select>
   </TR>
   </TR>

</td></tr></table>

<br>
