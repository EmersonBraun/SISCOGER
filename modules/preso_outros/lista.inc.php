<?php

$mostrar=$_REQUEST['mostrar'];

include ("menu.inc.php");
//include ("filtro.inc.php");

if ($_SESSION['debug']) pre("Mostrar: $mostrar");

if ($mostrar=="presos") $sqlWhere[]=" fim_data = '0000-00-00'";
if ($mostrar=="soltos") $sqlWhere[]=" fim_data != '0000-00-00' ";

if ($user['nivel']<4) {
	$var="opm2.CODIGOBASE"; unset($preso->$var);
	$var="preso.cdopm_prisao_st"; unset($preso->$var);
	$sqlWhere[]=" (opm2.CODIGOBASE LIKE '".$opm_proto->codigoBase."%' OR cdopm_prisao LIKE '".$opm_proto->codigoBase."%') ";
}

$sql="SELECT DISTINCT preso_outros.*, presotipo.presotipo, RHPARANA.opmPMPR.ABREVIATURA FROM preso_outros 
LEFT JOIN presotipo ON presotipo.id_presotipo = preso_outros.id_presotipo 
LEFT JOIN RHPARANA.opmPMPR ON preso_outros.cdopm_prisao=RHPARANA.opmPMPR.CODIGOBASE 
LEFT JOIN RHPARANA.POLICIAL pm ON pm.rg=preso_outros.rg LEFT JOIN RHPARANA.opmPMPR opm2
ON pm.opm_meta4 = opm2.META4";
include ("includes/filtro.php");

//echo $sql;
?>

<br>
<div class='bordasimples'>
<table border=0 width="100%" class='bordasimples'>

<?php
if ($opcao=="listar") echo "<caption><h2>Presos cadastrados</h2></caption>";
else echo "<caption><h2>Resultado</h2></caption>";

//Cabecalho
echo "<tr>";
	//Descomente as linhas abaixo, primeiro parametro=nome legivel, segundo=nome do campo na tabela.
	lista::td("Nome","nome");
	lista::td("RG","rg");
	lista::td("UF","uf");
	lista::td("Ocupa&ccedil;&atilde;o","ocupacao");
	lista::td("Local","local");
	lista::td("Local pris&atilde;o","local, cdopm_prisao, localreclusao");
	lista::td("Tipo","presotipo");
	lista::td("In&iacute;cio","inicio_data");
	lista::td("T&eacute;rmino","fim_data");
	lista::td("Vara/Comarca","vara");
	lista::td("Artigo","complemento");

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
	
	if (!$row["nome"]) $row["nome"]="S/ NOME";
	echo "<td><a href='?module=preso_outros&preso_outros[id]=$row[id_preso_outros]&opcao=atualizar'>$row[nome]</a></td>";
	
	//Substitua "campo" pelo nome do campo na tabela, tantos quanto precisar
	
	
	echo "<td>$row[rg]</td>";
	echo "<td>$row[uf]</td>";
	echo "<td>$row[ocupacao]</td>";
	echo "<td>$row[localreclusao]</td>";
	echo "<td>$row[ABREVIATURA]</td>";

	echo "<td>".$row["presotipo"]."</td>";
	echo "<td>".data::inverte($row["inicio_data"])."</td>";

	if ($row['fim_data']!="0000-00-00") echo "<td>".data::inverte($row["fim_data"])."</td>";
	else echo "<td><h3>&nbsp;PRESO</h3></td>";

	echo "<td>".$row["vara"]." - ".$row[comarca]."</td>";
	echo "<td>$row[complemento]</td>";
	
	closeTR();
$i++;
}
//Imprime a quantidade encontrada, no final da tabela
echo "<tr><td colspan='10'><h1>Total: $i</h1></td></tr>";
?>
</table>
</div>
<br>
