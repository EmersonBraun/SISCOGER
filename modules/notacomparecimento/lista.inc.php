<?

$notacomparecimento->sjd_ref_ano=$_SESSION['sjd_ano'];

$sql=" SELECT n.*, t.tiponotacomparecimento FROM notacomparecimento n LEFT JOIN tiponotacomparecimento t ON n.id_tiponotacomparecimento = t.id_tiponotacomparecimento ";

if (in_array((integer)$user["nivel"],array(4,5))) {
    //$notacomparecimento->status_st = '%';
    $notasAExibir = '(Todas)';
} else {
    $notacomparecimento->status_eq = notacomparecimento::PUBLICADA;
    $notasAExibir = '(Somente publicadas)';
}

include ("includes/filtro.php");

$sql = preg_replace('/ORDER BY.*$/', '', $sql);

$sql .= ' ORDER BY sjd_ref_ano DESC, sjd_ref DESC ';

?>

<center>
<!-- -->
<TABLE width="100%" cellpadding="0px"  class="bordasimples">
    <tr><TD colspan="5"><h1><center>CORREGEDORIA-GERAL DA PMPR</center></h1></TD></tr>
   <tr><TD colspan=5><h2><center>Notas de Comparecimento - <?echo $_SESSION[sjd_ano];?> <?=$notasAExibir;?></center></h2></TD></tr>
   <Tr>
       <TD width='80' class="lista"><b>Nº </b></TD>
       <td><b>Data</b></td>
       <td><b>Situação</b></td>
       <td><b>Descrição</b></td>
       <td><b>Arquivo</b></td>
   </tr>
   	<?php
	mysql_select_db("sjd");
	$res=mysql_query($sql);
	$i=0;
	while ($row=mysql_fetch_array($res)) {
                $expedicaoData = new DateTime($row['expedicao_data']);
		$i%2?($cor=white):($cor='#EEEEEE');
		echo "<tr bgcolor=$cor>"
                ."<td><a href='?module=notacomparecimento&notacomparecimento[id]={$row['id_notacomparecimento']}'>".$row['sjd_ref']."/".$row['sjd_ref_ano']."</a></td>"
		."<td>".$expedicaoData->format("d/m/Y")."</td>"
                ."<td>".$row['status']."</td>"
                ."<td>".$row['tiponotacomparecimento']."</td>";
                if (empty($row['nota_file'])) {
                    echo "<td>" . htmlentities("Não disponível") . "</td>";
                } else {
                    echo "<td><a href=\"arquivo/{$row['nota_file']}\">Baixar</a></td>";
                }

		echo "</tr>";
	$i++;
	}
	echo "<tr><td colspan=5><h1>Total: ".mysql_num_rows($res)."</h1></td></tr>";
	?>
        </select>
   </TR>
   </TR>

</td></tr></table>

<br>

