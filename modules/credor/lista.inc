<?

//Filtra para somente ver a unidade do login, incluindo os comandos.
if ($user[nivel]<4) {
	if (!$desercao->cdopm_st) $desercao->cdopm_st=$opm_login->codigoBase;
}
$desercao->sjd_ref_ano=$_SESSION[sjd_ano];

$sql="SELECT desercao.*, envolvido.nome, rhopm.ABREVIATURA FROM desercao 
	LEFT JOIN envolvido ON 
		desercao.id_desercao=envolvido.id_desercao 
	LEFT JOIN RHPARANA.opmPMPR AS rhopm ON
		rhopm.CODIGOBASE=desercao.cdopm";

include ("includes/filtro.php");
?>

<center>
<!-- -->
<TABLE width="100%" cellpadding="0px"  class="bordasimples">
   <tr><TD colspan="5"><center><h1><?=$opm_login->descricao;?></center></h1></TD></tr>
   <tr><TD colspan=5><h2><center>Deserções - <?echo $_SESSION[sjd_ano];?></center></h2></TD></tr>
   <TR><td>Nº</td><TD class="lista"><b>OPM</b></TD><td><b>Desertor</b></td><td><b>Documento</b></td></tr>
   	<?
	mysql_select_db("sjd");
	$res=mysql_query($sql);
	$i=0;
	while ($row=mysql_fetch_array($res)) {
		$i%2?($cor=white):($cor='#EEEEEE');
		echo "<tr bgcolor=$cor>"
		."<td><a href='?module=desercao&desercao[id]=$row[id_desercao]'>".$row['sjd_ref']."/".$row['sjd_ref_ano']."</a></td>"
		."<td class=\"lista\">".$row['ABREVIATURA']."</b></td>"
		."<td>$row[nome]</td>"
		."<td>".$row['doc_tipo']." Nº $row[doc_numero]</td>"
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
