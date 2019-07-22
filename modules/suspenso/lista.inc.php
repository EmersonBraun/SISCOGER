<?php

include ("menu.inc.php");
include ("filtro.inc.php");


$sql="SELECT suspenso.*, opm.* FROM suspenso
	LEFT JOIN RHPARANA.POLICIAL pm ON pm.rg = suspenso.rg
	LEFT JOIN RHPARANA.opmPMPR opm ON opm.CODIGO = pm.cdopm";

if (array_key_exists('mostrar',$_POST)) {

    if ($_POST['mostrar'] == 'suspensos') {
    	$sqlWhere[] = " inicio_data <= now() AND inicio_data <> '0000-00-00' AND fim_data = '0000-00-00'";
    } else if ($_POST['mostrar'] == 'findados') {
    	$sqlWhere[] = " inicio_data <= now() AND inicio_data <> '0000-00-00' AND fim_data < now() AND fim_data <> '0000-00-00'";
    }
}


include ("includes/filtro.php");
?>

<table width="100%" class='bordasimples'>

<?php
if ($opcao=="listar") echo "<tr><td colspan='10'><h2>Suspens&otilde;es cadastradas</h2></td></tr>";
else echo "<tr><td colspan='6'><h2>Resultado</h2></td></tr>";

//Cabecalho
echo "<tr>";
	//Descomente as linhas abaixo, primeiro parametro=nome legivel, segundo=nome do campo na tabela.
	lista::td("RG","rg");
	lista::td("Cargo","cargo");
	lista::td("Nome","nome");
	lista::td("OPM atual","cdopm");
	lista::td("Processo","processo");
	lista::td("Art. da Infra&ccedil;&atilde;o Penal","infracao");
	lista::td("In&iacute;cio","inicio_data");
	lista::td("Fim","fim_data");

echo "</tr>\r\n";

//executa a query no servidor
$res=mysql_query($sql,$con[8]);

$i=0; //contador

//Imprime linha a linha todos os resultados da query
while ($row=mysql_fetch_array($res)) {

	//muda a cor para cada linha
	$i%2?($cor=white):($cor='#EEEEEE');
	
	openTR("bgcolor='$cor'");

	echo "<td>".lista::link("atualizar").$row["suspenso"];
	
	//Substitua "campo" pelo nome do campo na tabela, tantos quanto precisar
	echo $row["rg"]."</a></td>";
	echo "<td>" . $row["cargo"] . "</td>";
	echo "<td>" . $row["nome"] . "</td>";
        echo "<td>" . $row["DESCRICAO"]."</td>";
        echo "<td>" . $row["processo"]."</td>";
	echo "<td>" . $row["infracao"]."</td>";
	echo "<td>" . $row["inicio_data"]."</td>";
	echo "<td>" . $row["fim_data"]."</td>";
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
