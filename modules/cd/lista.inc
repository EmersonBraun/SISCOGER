<?php

$sql="SELECT * FROM cd
	LEFT JOIN motivoconselho ON motivoconselho.id_motivoconselho = cd.id_motivoconselho
	LEFT JOIN decorrenciaconselho ON cd.id_decorrenciaconselho=decorrenciaconselho.id_decorrenciaconselho";

//Filtra para somente ver a unidade do login, incluindo os comandos.


if ($user[nivel]<4) {
	if (!$cd->opm_codigo_st) $cd->opm_codigo_st=$opm_login->codigoBase;
}
$cd->sjd_ref_ano=$_SESSION[sjd_ano];

include ("includes/filtro.php");
?>

<center>
<!-- -->
<TABLE width="100%" cellpadding="0px"  class="bordasimples">
   <tr><TD colspan="5"><center><h1><?=$opm_login->descricao;?></center></h1></TD></tr>
   <tr><TD colspan=5><h2><center>Conselhos de Disciplina - <?echo $_SESSION[sjd_ano];?></center></h2></TD></tr>
   <TR><td width="80px"><b>N� COGER</b></td><td><b>Motivo</b></td><td><b>S�ntese do fato</b></td></tr>
   	<?
	mysql_select_db("sjd");
	$res=mysql_query($sql);
	$i=0;
	while ($row=@mysql_fetch_array($res)) {
		$i%2?($cor=white):($cor='#EEEEEE');
		echo "<tr bgcolor=$cor>"
		."<td><a href='?module=cd&cd[id]=$row[id_cd]'>".$row['sjd_ref']."/".$row['sjd_ref_ano']."</a></td>";
		
		//CAP TODISCO=decorrencia conselho; HEITOR=motivoconselho

		//13=OUTROS
		if ($row["id_decorrenciaconselho"]==13) echo "<td>Outros ($row[outromotivo])</a></td>";
		else echo "<td>$row[decorrenciaconselho]</a></td>";
		
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