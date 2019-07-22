<?php

//SEGURANCA: CADA UNIDADE VE SEUS POLICIAIS
if ($user["nivel"]<4) {
	if (!$restricao->cdopm_st) $restricao->cdopm_st=$opm_login->codigoBase;
}

include ("menu.inc.php");
include ("filtro.inc.php");


$sql="SELECT restricao.*, pm.cdopm, opm.ABREVIATURA FROM restricao 
		LEFT JOIN RHPARANA.POLICIAL pm ON pm.rg=restricao.rg
		LEFT JOIN RHPARANA.opmPMPR opm ON opm.CODIGO=pm.cdopm";

include ("includes/filtro.php");
//pre($sql);
?>

<table class='bordasimples' width="100%">

<?php
if ($opcao=="listar") echo "<tr><td colspan='10'><h2>Restri&ccedil;&otilde;es cadastradas</h2></td></tr>";
else echo "<tr><td colspan='10'><h2>Resultado</h2></td></tr>";

//Cabecalho
echo "<tr>";
	//Descomente as linhas abaixo, primeiro parametro=nome legivel, segundo=nome do campo na tabela.
	lista::td("RG","rg");
	lista::td("Policial","nome");
	lista::td("OM","cdopm");
	lista::td("Motivo","origem");
	lista::td("Inicio da restricao","inicio_data");
	lista::td("Fim da restricao","fim_data");
	lista::td("Rest. arma fogo","arma_bl");
	lista::td("Rest. fardamento","fardamento_bl");

	if ($user["nivel"]>=4) {
		lista::td("Cadastro SJD","cadastro_data");
		lista::td("Descadastro SJD","retirada_data");
	}
	//lista::td("Nome do campo","campo");

	//echo "<td><b>Ação</b></td>"; //Comente caso nao seja necessario

echo "</tr>\r\n";

//executa a query no servidor
$res=mysql_query($sql);

$i=0; //contador

//Imprime linha a linha todos os resultados da query
while ($row=mysql_fetch_array($res)) {

	//muda a cor para cada linha
	$i%2?($cor=white):($cor='#EEEEEE');
	
	openTR("bgcolor='$cor'");

	echo "<td>".lista::link("atualizar")."$row[rg]</a></td>";
	echo "<td>".$row["cargo"]." $row[nome]</td>";
	echo "<td>$row[ABREVIATURA]</td>";
	echo "<td>$row[origem]</td>";
	echo "<td>".data::inverte($row["inicio_data"])."</td>";
	echo "<td>".data::inverte($row["fim_data"])."</td>";
	openTD();
		if ($row["arma_bl"]) echo "<font color='red'>SIM</font>"; else echo "Nao";
	closeTD();
	openTD();
		if ($row["fardamento_bl"]) echo "<font color='red'>SIM</font>"; else echo "Nao";
	closeTD();

	if ($user['nivel']>=4) {
		echo "<td>".data::inverte($row["cadastro_data"])."</td>";
		echo "<td>".data::inverte($row["retirada_data"])."</td>";
	}

	closeTR();
$i++;
}
//Imprime a quantidade encontrada, no final da tabela
echo "<tr><td colspan=10><h1>Total: $i</h1></td></tr>";
?>
</table>
<br>
