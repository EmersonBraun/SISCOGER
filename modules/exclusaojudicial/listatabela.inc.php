<?php
?>

<table class='bordasimples' border=0 width="100%">

<?php
if ($opcao=="listar") echo "<tr><td colspan='8'><h2>Exclus&otilde;es judiciais cadastradas</h2></td></tr>";
else echo "<tr><td colspan='8'><h2>Exclu&iacute;dos judicialmente</h2></td></tr>";

//Cabecalho
echo "<tr>";
	//Descomente as linhas abaixo, primeiro parametro=nome legivel, segundo=nome do campo na tabela.
	lista::td("RG","rg");
	lista::td("Nome","nome");
	lista::td("OPM exclus&atilde;o","cdopm_quandoexcluido");
	lista::td("Data senten&ccedil;a","data");
	lista::td("Data exclus&atilde;o","exclusao_data");
	lista::td("Artigos","complemento");
	lista::td("Portaria CG","portaria_numero");
	lista::td("Boletim Geral","bg_numero");
	//lista::td("Nome do campo","campo");
	//lista::td("Nome do campo","campo");

	//echo "<td><b>Ação</b></td>"; //Comente caso nao seja necessario

echo "</tr>\r\n";

//executa a query no servidor
mysql_select_db("sjd");
$res=mysql_query($sql);

$i=0; //contador

//Imprime linha a linha todos os resultados da query
while ($row=mysql_fetch_array($res)) {

	//muda a cor para cada linha
	$i%2?($cor=white):($cor='#EEEEEE');
	
	openTR("bgcolor='$cor'");

	if ($module!="envolvido")	
		echo "<td>".lista::link("atualizar").$row["rg"]."</a></td>";
	else
		echo "<td><a href='?module=exclusaojudicial&exclusaojudicial[id]=".$row["id_exclusaojudicial"]."'>$row[rg]</a></td>";

	
	//Substitua "campo" pelo nome do campo na tabela, tantos quanto precisar
	
	echo "<td>".$row["cargo"]." ".$row["nome"]."</td>";
	echo "<td>".$row["opmexclusao"]."</td>";
	echo "<td>".data::inverte($row["data"])."</td>";
	echo "<td>".data::inverte($row["exclusao_data"])."</td>";
	echo "<td>$row[complemento]</td>";
	echo "<td>n&ordm; ".$row["portaria_numero"]."</td>";
	echo "<td>n&ordm; ".$row["bg_numero"]."/".$row["bg_ano"]."</td>";
	//echo "<td>".$row["campo"]."</td>";
	//echo "<td>".$row["campo"]."</td>";

	closeTR();
$i++;
}
//Imprime a quantidade encontrada, no final da tabela
echo "<tr><td colspan=10><h1>Total: $i</h1></td></tr>";
?>
</table>
