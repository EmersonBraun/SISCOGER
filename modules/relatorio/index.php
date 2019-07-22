<?

//Declaração das funções do Fusion Charts.
include("../lib/FusionCharts/FusionCharts.php");
include("../lib/FusionCharts/FC_Colors.php");

//Declaração de variáveis
$acao=strtolower($_REQUEST[acao]);

if ($opcao=="gerar") {
	echo "<h1>Relatório gráfico</h1>";
	//Faz a consulta para gerar o gráfico de crimes
	$sql="SELECT ipm.crime, COUNT(*) AS quantidade FROM ipm WHERE opm_ref_ano='".$_SESSION[sjd_ano]."' GROUP BY crime";
	$res=mysql_query($sql);
	$i=0;
	
	//Transforma os resultados em vetores
	$arrData=array();
	while ($row=mysql_fetch_array($res)) {
		$arrData[$i][1]=$row[crime];
		$arrData[$i][2]=$row[quantidade];
	$i++;
	}

	//Converte os vetores para XML
	$strXML = "<graph caption='IPM ".$_SESSION[sjd_ano]."' formatNumberScale='0' decimalPrecision='0' >";
   
	foreach ($arrData as $arSubData) {
		$strXML .= "<set name='" . $arSubData[1] . "' value='" . $arSubData[2] . "' color='" .getFCColor() . "' />";
	}
	$strXML .= "</graph>";
	
	
	
	echo addslashes($strXML);
	//echo "<textarea cols=100 rows=5>".$strXML." </textarea>\r\n";
	//Create o gráfico - Colunas 3D
	echo "<br>\r\n";
	echo renderChartHTML("FusionCharts/FCF_Column3D.swf", "", $strXML, "crimes", 1020, 420);
	
	echo "<br>";
	echo "<a href='?module=relatorio&opcao=impressao&noheader'>Versão para impressão</a><br>\r\n";
	echo "<a href='index.php'>Voltar</a>";
}
elseif ($opcao=="impressao") {
	
	//Faz a consulta para gerar o gráfico de crimes
	echo "<h1 align=center>POLÍCIA MILITAR</h1>";
	echo "<h1 align=center>".$_SESSION[usuario]->opm->descricao."</h1>";
	echo "<h1 align=center>SEÇÃO DE JUSTIÇA E DISCIPLINA</h1>";
	echo "<br>";
	echo "<h2 align=center>Relatório geral quantitativo de Inquéritos Policiais Militares</h2>";
	echo "<br>";
	echo "<center>";
	echo "<img src='includes/graphic.php'>";
	echo "</center>";
}
elseif ($opcao=="processos_quantitativo") {
	include ("processos_quantitativo.php");
}
elseif ($opcao=="postos_graduacoes") {
	include ("postos_graduacoes.php");
}
else {
	include ("$opcao.php");
}

?>
