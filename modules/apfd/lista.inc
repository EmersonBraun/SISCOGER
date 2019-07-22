<?

//Filtra para somente ver a unidade do login, incluindo os comandos.
if ($user[nivel]<4) {
	if (!$apfd->cdopm_st) $apfd->cdopm_st=$opm_login->codigoBase;
}

include ("filtro.inc");


$sql="SELECT * FROM apfd LEFT OUTER JOIN RHPARANA.opmPMPR AS rhopm ON
	rhopm.CODIGOBASE=apfd.cdopm ";

$apfd->sjd_ref_ano=$_SESSION[sjd_ano];
include ("includes/filtro.php");
?>

<center>
<!-- -->
<TABLE width="100%" cellpadding="0px"  class="bordasimples">
   <tr><TD colspan="5"><center><h1><?=$opm_login->descricao;?></center></h1></TD></tr>
   <tr><TD colspan=5><h2><center>Autos de prisão em flagrante delito - <?echo $_SESSION[sjd_ano];?></center></h2></TD></tr>
   <TR>
	<td width="80px"><b>N&ordm; COGER</b></td><td><b>Tipifica&ccedil;&atilde;o</b></td><td><b>OPM</b></td><td><b>Síntese do fato</b></td></tr>
   	<?
	mysql_select_db("sjd");
	$res=mysql_query($sql);
	$i=0;
	while ($row=@mysql_fetch_array($res)) {
		$i%2?($cor=white):($cor='#EEEEEE');
		echo "<tr bgcolor=$cor>"
		."<td><a href='?module=apfd&apfd[id]=$row[id_apfd]'>$row[tipo] $row[sjd_ref]/$row[sjd_ref_ano]</a></td>"
		."<td>$row[tipo_penal]/$row[tipo_penal_novo]</a></td>"
		."<td>$row[ABREVIATURA]</td>"
		."<td>".$row['sintese_txt']."</td>"
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
