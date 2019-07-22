<?
mysql_select_db("sjd",$con[8]);
if (!$_REQUEST['order']) $_REQUEST['order']="data DESC";

include ("menu.inc.php"); echo "<br>";
//include ("filtro.inc.php");


$sql="SELECT * FROM feriado";
include ("includes/filtro.php");
?>

<table border=0 width="100%" class='bordasimples'>

<?php
if ($opcao=="listar") echo "<tr><td colspan='6'><h2>Feriados cadastrados</h2></td></tr>";
else echo "<tr><td colspan='6'><h2>Resultado</h2></td></tr>";

//Cabecalho
echo "<tr>";
	//Descomente as linhas abaixo, primeiro parametro=nome legivel, segundo=nome do campo na tabela.
	lista::td("Data","data");
	echo "<td>Dia da semana</td>";
	echo "<td>Feriado</td>";
	//lista::td("Nome do campo","campo");
	//lista::td("Nome do campo","campo");
	//lista::td("Nome do campo","campo");
	//lista::td("Nome do campo","campo");

	//echo "<td><b>Ação</b></td>"; //Comente caso nao seja necessario

echo "</tr>\r\n";

//executa a query no servidor
$res=mysql_query($sql,$con[8]);

$i=0; //contador

//Imprime linha a linha todos os resultados da query
while ($row=mysql_fetch_array($res)) {

	//muda a cor para cada linha
	$i%2?($cor=white):($cor='#EEEEEE');
	
	openTR("bgcolor='$cor'");

	if ($user['nivel']>=4) {
		echo "<td>".lista::link("atualizar").data::inverte($row["data"])."</td>";
		echo "<td>".diaDaSemana($row['data'])."</td>";
		echo "<td>".lista::link("atualizar").$row["feriado"]."</a></td>";
	}
	else {
		echo "<td>".data::inverte($row['data'])."</td>";
		echo "<td>".diaDaSemana($row['data'])."</td>";
		echo "<td>$row[feriado]</td>";
	}
	
	//Substitua "campo" pelo nome do campo na tabela, tantos quanto precisar
	
	
	//echo "<td>".$row["feriado"]."</td>";
	//echo "<td>".$row["campo"]."</td>";
	//echo "<td>".$row["campo"]."</td>";
	//echo "<td>".$row["campo"]."</td>";
	//echo "<td>".$row["campo"]."</td>";
	//echo "<td>".$row["campo"]."</td>";

	closeTR();
$i++;
}
//Imprime a quantidade encontrada, no final da tabela
echo "<tr><td colspan=10><h1>Total: $i</h1></td></tr>";
?>
</table>
<br>
