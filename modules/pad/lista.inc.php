<?

include ("menu.inc.php");
include ("filtro.inc.php");


$sql="SELECT pad.*, andamento.andamento, andamentocoger.andamentocoger, opm.ABREVIATURA AS opm FROM pad
	LEFT JOIN andamento ON andamento.id_andamento=pad.id_andamento
	LEFT JOIN andamentocoger ON andamentocoger.id_andamentocoger=pad.id_andamentocoger
	LEFT JOIN RHPARANA.opmPMPR opm ON opm.CODIGOBASE=pad.cdopm";
include ("includes/filtro.php");
?>

<TABLE class='bordasimples' width="100%">

<?php
if ($opcao=="listar") echo "<tr><td colspan='6'><h2>pad cadastrados</h2></td></tr>";
else echo "<tr><td colspan='6'><h2>Resultado</h2></td></tr>";

//Cabecalho
echo "<tr>";
	//Descomente as linhas abaixo, primeiro parametro=nome legivel, segundo=nome do campo na tabela.
	lista::td("N&ordm; COGER","sjd_ref");
	lista::td("OPM","cdopm");
	lista::td("Andamento","andamento");
	lista::td("And. COGER","andamentocoger");
	lista::td("Abertura","abertura_data");
	lista::td("Sintese do fato");
	//lista::td("Nome do campo","campo");

//	echo "<td><b>Ação</b></td>"; //Comente caso nao seja necessario

echo "</tr>\r\n";

//executa a query no servidor
$res=mysql_query($sql,$con[8]);

$i=0; //contador

//Imprime linha a linha todos os resultados da query
while ($row=mysql_fetch_array($res)) {

	//muda a cor para cada linha
	$i%2?($cor=white):($cor='#EEEEEE');
	
	openTR("bgcolor='$cor'");

	echo "<td>".lista::link("atualizar").$row["sjd_ref"]."/$row[sjd_ref_ano]</a></td>";
	echo "<td>".$row["opm"]."</td>";
	echo "<td>".$row["andamento"]."</td>";
	echo "<td>".$row["andamentocoger"]."</td>";
	echo "<td>".data::inverte($row["abertura_data"])."</td>";
	echo "<td>".$row["sintese_txt"]."</td>";
	//echo "<td>".$row["campo"]."</td>";

	closeTR();
$i++;
}
//Imprime a quantidade encontrada, no final da tabela
echo "<tr><td colspan=10><h1>Total: $i</h1></td></tr>";
?>
</table>

<br>
