<?

include ("menu.inc.php");
include ("filtro.inc.php");


$sql="SELECT * FROM falecimento
	LEFT JOIN municipio ON falecimento.id_municipio=municipio.id_municipio
	LEFT JOIN situacao ON situacao.id_situacao=falecimento.id_situacao
	LEFT JOIN RHPARANA.opmPMPR opm ON opm.CODIGOBASE=falecimento.cdopm";

include ("includes/filtro.php");
?>

<br>
<table class='bordasimples' border=0 width="100%">

<?php
if ($opcao=="listar") echo "<tr><td colspan='10'><h2>&Oacute;bitos e les&otilde;es (de policiais militares) cadastrados</h2></td></tr>";
else echo "<tr><td colspan='10'><h2>Resultado</h2></td></tr>";

//Cabecalho
echo "<tr>";
	//Descomente as linhas abaixo, primeiro parametro=nome legivel, segundo=nome do campo na tabela.
	lista::td("RG");
	lista::td("Cargo","cargo");
	lista::td("Nome","nome");
	lista::td("Data","data");
	lista::td("Unidade","cdopm");
	lista::td("Cidade","municipio");
	lista::td("Resultado","resultado");
	lista::td("Situa&ccedil;&atilde;o","situacao");
echo "</tr>\r\n";

//executa a query no servidor
$res=mysql_query($sql);

$i=0; //contador

//Imprime linha a linha todos os resultados da query
while ($row=mysql_fetch_array($res)) {

	//muda a cor para cada linha
	$i%2?($cor=white):($cor='#EEEEEE');
	
	openTR("bgcolor='$cor'");

	echo "<td>".lista::link("atualizar").$row["rg"]."</a></td>";
	
	//Substitua "campo" pelo nome do campo na tabela, tantos quanto precisar
	
	echo "<td>".$row["cargo"]."</td>";
	echo "<td>".$row["nome"]."</td>";
	echo "<td>".data::inverte($row["data"])."</td>";
	echo "<td>".$row["ABREVIATURA"]."</td>";
	echo "<td>".$row["municipio"]."</td>";
	echo "<td>".$row["resultado"]."</td>";
	echo "<td>".$row["situacao"]."</td>";

	closeTR();
$i++;
}
//Imprime a quantidade encontrada, no final da tabela
echo "<tr><td colspan=10><h1>Total: $i</h1></td></tr>";
?>
</table>
</div>
<br>
