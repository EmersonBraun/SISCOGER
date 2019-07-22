<?

include ("menu.inc.php");
include ("filtro.inc.php");


$sql="SELECT * FROM APAGADO";
include ("includes/filtro.php");
?>

<TABLE class='bordasimples' width="100%">

<?php
if ($opcao=="listar") echo "<tr><td colspan='6'><h2>APAGADO cadastrados</h2></td></tr>";
else echo "<tr><td colspan='6'><h2>Resultado</h2></td></tr>";

//Cabecalho
echo "<br>";
$sql=lista::paginas($sql);
echo "<tr>";
	//Descomente as linhas abaixo, primeiro parametro=nome legivel, segundo=nome do campo na tabela.
	lista::td("Objeto apagado","objeto");
	lista::td("RG que apagou","rg");
	lista::td("Nome de quem apagou","nome");
	lista::td("Data/hora","datahora");
	lista::td("IP","ip");
	//lista::td("RG apagado","rg_apagado");
	//lista::td("Nome do campo","campo");
	//lista::td("Nome do campo","campo");

	echo "<td><b>Ação</b></td>"; //Comente caso nao seja necessario

echo "</tr>\r\n";

//executa a query no servidor
$res=mysql_query($sql);

$i=0; //contador

//Imprime linha a linha todos os resultados da query
while ($row=mysql_fetch_array($res)) {

	//muda a cor para cada linha
	$i%2?($cor=white):($cor='#EEEEEE');
	
	openTR("bgcolor='$cor'");

	echo "<td>".lista::link("atualizar").$row["objeto"]."</a></td>";
	
	//Substitua "campo" pelo nome do campo na tabela, tantos quanto precisar
	
	echo "<td>".$row["rg"]."</td>";
	echo "<td>".$row["nome"]."</td>";
	echo "<td>".udf($row["datahora"],"datahora")."</td>";
	echo "<td>".$row["ip"]."</td>";
	echo "<td>";
		link::popup("?module=APAGADO&APAGADO[id]=".$row["id_APAGADO"]."&noheader",700,400);
	echo "<img width='16' src='img/lupa.gif'></a></td>";
	//echo "<td>".$row["campo"]."</td>";

	closeTR();
$i++;
}
//Imprime a quantidade encontrada, no final da tabela
lista::rodape();
?>
</table>
<br>
