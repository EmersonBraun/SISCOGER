<?php 
$sql1="SELECT * FROM arquivo where local_atual ='Arquivo COGER' and DATEDIFF(NOW(),arquivo_data) >= 732 AND retorno_data = '0000-00-00' ";
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
			echo "<a href='?module=arquivo&opcao=atualizar&arquivo[id]=".$row['id_arquivo']."&procedimento=".$row['procedimento']."'>";
			echo "O ".$row['procedimento']." ".$row['sjd_ref']."/".$row['sjd_ref_ano']." na prateleira ".$row['numero']."-".$row['letra']." pode ser enviado para o arquivo geral";
			echo "</a></td>";
		closeTD(); 

		$i++;

	}
	openLine(8); h2("Total procedimentos para irem para o arquivo geral: $i"); closeLine();
}
else echo "N&atilde;o h&aacute; procedimentos para irem para o arquivo geral";
closeTable();

echo "<br>";

$sql="SELECT * FROM arquivo WHERE local_atual='Arquivo COGER' AND letra !='-' AND numero !='-' ORDER BY arquivo_data DESC, id_arquivo DESC";
if ($_SESSION["debug"]) echo $sql;
$res=mysql_query($sql);

h1("Arquivo COGER");
openTable("class='bordasimples' width='100%'");

if (mysql_num_rows($res)>0) {
	openTR();	
		lista::td("Data","data");
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
			echo "<td>$row[procedimento]</td>";
			echo "<td>$row[sjd_ref]</td>";
			echo "<td>$row[sjd_ref_ano]</td>";
			echo "<td>$row[numero]</td>";
			echo "<td>$row[letra]</td>";
			echo "<td>$row[rg]</td>";
			echo "<td>$row[obs]</td>";
		closeTD(); 

		$i++;

	}
	openLine(8); h2("Total Arquivo COGER: $i"); closeLine();
}
else echo "N&atilde;o h&aacute; Arquivo COGER Registrado";
closeTable();

echo "<br>";
?>
