<?php 
$sql1="SELECT * FROM sjd.arquivo 
WHERE numero='0' 
AND letra='-' 
AND local_atual='Cautela (Saida)'
AND DATEDIFF(NOW(),arquivo_data) >= 5
GROUP BY procedimento, sjd_ref,sjd_ref_ano";
if ($_SESSION["debug"]) echo $sql1;
$res1=mysql_query($sql1);

h1("Cautela (Sa&iacute;da)");
openTable("class='bordasimples' width='100%'");

if (mysql_num_rows($res1)>0) {

	$i=0;
	while ($row=mysql_fetch_assoc($res1)) {
		($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");

		openTR("bgcolor='$cor'"); 
			echo "<td>";
			$link = "?module=arquivo&opcao=atualizar&arquivo[id]=".$row['id_arquivo']."&procedimento=".$row['procedimento']."&ref=".$row['sjd_ref']."&ano=".$row['sjd_ref_ano'];
			//?module=arquivo&opcao=atualizar&arquivo[id]=".$row['id_arquivo']."&procedimento=".$row['procedimento']."
			echo "<a href='$link'>";
			echo "A Cautela do ".$row['procedimento']." ".$row['sjd_ref']."/".$row['sjd_ref_ano']." Est&aacute; fora do prazo";
			echo "</a></td>";
		closeTD(); 

		$i++;

	}
	openLine(8); h2("Total Cautela fora do prazo: $i"); closeLine();
}
else echo "N&atilde;o h&aacute; Cautela fora do prazo";
closeTable();

echo "<br>";

$sql="SELECT *, DATEDIFF(NOW(),arquivo_data) as tempo FROM sjd.arquivo 
where numero='0' AND letra='-' AND local_atual='Cautela (Saida)' 
GROUP BY procedimento, sjd_ref,sjd_ref_ano";
if ($_SESSION["debug"]) echo $sql;
$res=mysql_query($sql);

h1("Cautela (Sa&iacute;da)");
openTable("class='bordasimples' width='100%'");

if (mysql_num_rows($res)>0) {
	openTR();	
		lista::td("Data (Sa&iacute;da)","data");
		lista::td("Dias fora","tempo");
		lista::td("Procedimento","procededimento");
		lista::td("Ref","sjd_ref");
		lista::td("Ano","sjd_ref_ano");
		lista::td("N&uacute;mero","numero");
		lista::td("Letra","letra");
		lista::td("RG","rg");
		lista::td("Observa&ccedil;&otilde;es","obs");

	closeTR();
	$i=0;
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");

		openTR("bgcolor='$cor'"); 
			echo "<td>".data::inverte($row["arquivo_data"])."</td>";
			if($row[tempo] > 5){
				echo "<td style='color: red'><b>$row[tempo]</b></td>";
			}else{
				echo "<td>$row[tempo]</td>";
			}
			echo "<td>";
			echo "<a href='?module=arquivo&opcao=atualizar&arquivo[id]=".$row['id_arquivo']."&procedimento=".$row['procedimento']."'>";
			echo "$row[procedimento]</a></td>";
			echo "<td>$row[sjd_ref]</td>";
			echo "<td>$row[sjd_ref_ano]</td>";
			echo "<td>$row[numero]</td>";
			echo "<td>$row[letra]</td>";
			echo "<td>$row[rg]</td>";
			echo "<td>$row[obs]</td>";
		closeTD(); 

		$i++;

	}
	openLine(8); h2("Total Cautela: $i"); closeLine();
}
else echo "N&atilde;o h&aacute; Cautela Registrada";
closeTable();

echo "<br>";
?>
