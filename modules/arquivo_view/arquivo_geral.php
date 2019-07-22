<?php 
$sql="SELECT * FROM arquivo WHERE local_atual='Arquivo Geral(PMPR)' ORDER BY arquivo_data DESC, id_arquivo DESC";
if ($_SESSION["debug"]) echo $sql;
$res=mysql_query($sql);

h1("Arquivo Geral(PMPR)");
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
	openLine(8); h2("Total Arquivo Geral(PMPR): $i"); closeLine();
}
else echo "N&atilde;o h&aacute; Arquivo Geral(PMPR) Registrado";
closeTable();

echo "<br>";
?>