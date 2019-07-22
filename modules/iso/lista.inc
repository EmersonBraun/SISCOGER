<?

//Filtra para somente ver a unidade do login, incluindo os comandos.
if ($user[nivel]<4) {
	if (!$iso->cdopm_st) $iso->cdopm_st=$opm_login->codigoBase;
}
$iso->sjd_ref_ano=$_SESSION[sjd_ano];

$sql="SELECT * FROM iso";

include ("includes/filtro.php");


//echo $sql;
?>

<center>
<!-- -->
<TABLE width="100%" cellpadding="0px"  class="bordasimples">
   <tr><TD colspan="5"><center><h1><?=$opm_login->descricao;?></center></h1></TD></tr>
   <tr><TD colspan=5><h2><center>Inqúeritos Sanitários de Origem - <?echo $_SESSION[sjd_ano];?></center></h2></TD></tr>
   <TR><TD width='80' class="lista"><b>Nº COGER</b></TD><td><b>Síntese do fato</b></td></tr>
   	<?
	mysql_select_db("sjd");
	$res=mysql_query($sql);
	$i=0;
	while ($row=mysql_fetch_array($res)) {
		$i%2?($cor=white):($cor='#EEEEEE');
		echo "<tr bgcolor=$cor>"
		."<td><a href='?module=iso&iso[id]=$row[id_iso]'>".$row['sjd_ref']."/".$row['sjd_ref_ano']."</a></td>"		
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
