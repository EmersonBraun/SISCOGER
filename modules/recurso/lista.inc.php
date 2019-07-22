<?php

include ("menu.inc.php");
include ("filtro.inc.php");


$sql="SELECT * FROM recurso";

/* CAP Todisco pediu para as Unidades verem todos os recursos.
if ($user['nivel']<4) {
	if (!$recurso->cdopm_st) $recurso->cdopm_st=$opm_login->codigoBase;
}
*/

include ("includes/filtro.php");
?>

<table class='bordasimples' border=0 width="100%">

<?php


if ($opcao=="listar") echo "<tr><td colspan='6'><h2>recurso cadastrados</h2></td></tr>";
else echo "<tr><td colspan='6'><h2>Resultado</h2></td></tr>";

//Cabecalho
echo "<tr>";
	//Descomente as linhas abaixo, primeiro parametro=nome legivel, segundo=nome do campo na tabela.
	lista::td("OPM","cdopm");
	lista::td("procedimento","procedimento");
	lista::td("N&uacute;mero/ano","sjd_ref");
	lista::td("Data-hora do recebimento","datahora");
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

	echo "<td>".lista::link("atualizar").$row["opm"]."</a></td>";
	
	//Substitua "campo" pelo nome do campo na tabela, tantos quanto precisar
	echo "<td>".$row["procedimento"]."</td>";
	echo "<td>".$row["sjd_ref"]."/$row[sjd_ref_ano]</td>";
	echo "<td>".udf($row["datahora"], "datahora")."</td>";
	echo "<td>".lista::link("atualizar")."<img src='img/lapis.gif'></a></td>";
	//echo "<td>".$row["campo"]."</td>";

	closeTR();
$i++;
}
//Imprime a quantidade encontrada, no final da tabela
echo "<tr><td colspan=10><h1>Total: $i</h1></td></tr>";
?>
</table>
<br>
