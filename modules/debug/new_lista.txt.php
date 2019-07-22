<?

include ("menu.inc.php");
include ("filtro.inc.php");


$sql="SELECT * FROM novomodulo";
include ("includes/filtro.php");
?>

<div class='bordasimples'>
<TABLE border=0 width="100%">

<?php
if ($opcao=="listar") echo "<tr><td colspan='6'><h2>nomeplural cadastrados</h2></td></tr>";
else echo "<tr><td colspan='6'><h2>Resultado</h2></td></tr>";

//Cabecalho
echo "<tr>";
	//Descomente as linhas abaixo, primeiro parametro=nome legivel, segundo=nome do campo na tabela.
	//lista::td("Nome do campo","campo");
	//lista::td("Nome do campo","campo");
	//lista::td("Nome do campo","campo");
	//lista::td("Nome do campo","campo");
	//lista::td("Nome do campo","campo");
	//lista::td("Nome do campo","campo");

	echo "<td><b>Ação</b></td>"; //Comente caso nao seja necessario

echo "</tr>\r\n";

//executa a query no servidor
$res=mysql_query($sql,$con[8]);

$i=0; //contador

//Imprime linha a linha todos os resultados da query
while ($row=mysql_fetch_array($res)) {

	//muda a cor para cada linha
	$i%2?($cor=white):($cor='#EEEEEE');
	
	openTR("bgcolor='$cor'");

	echo "<td>".lista::link("atualizar").$row["novomodulo"]."</a></td>";
	
	//Substitua "campo" pelo nome do campo na tabela, tantos quanto precisar
	
	echo "<td>".$row["campo"]."</td>";
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
</div>
<br>
