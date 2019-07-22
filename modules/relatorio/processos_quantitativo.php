<?php

//Padronizacao dos valores do formulario
$filtro=new filtro();
$filtro->setValues($_REQUEST["filtro"]);
if (!$filtro->sjd_ref_ano_ini) $filtro->sjd_ref_ano_ini=($_SESSION["sjd_ano"]-1);
if (!$filtro->sjd_ref_ano_fim) $filtro->sjd_ref_ano_fim=($_SESSION["sjd_ano"]);
$filtroobj=$filtro;

//Formulario. Que serve tambem para mostrar os filtros

echo "<table class='bordasimples' width='100%'><tr><td>\r\n";
echo "<table width='100%'>";
echo "<form action='?module=relatorio&opcao=processos_quantitativo' method='POST'>";
form::openTR();
	form::openTD("colspan=3");
		echo "<h1>Quadro demonstrativo - Processos</h1>";
	form::closeTD();
form::closeTR();
form::openTR();
	form::openTD();
		$opcoes=" size='4' maxlength='4'";
		form::input("Ano inicial","filtro[sjd_ref_ano_ini]");
	form::closeTD();
	form::openTD();
		$opcoes=" size='4' maxlength='4'";
		form::input("Ano final","filtro[sjd_ref_ano_fim]");
	form::closeTD();
	form::openTD();
		form::openLabel("OPM");
			echo "<select name='filtro[cdopm_st]'>";
				include ("includes/option_opm.php");
			echo "</select>";
		form::closeLabel();
	form::closeTD();
form::closeTR();
form::openTR(); form::openTD("colspan=2");
	echo "<input type='submit' name='acao' value='Gerar relat&oacute;rio'>";
form::closeTD(); form::closeTR();

echo "</table>";
echo "</table>";//bordasimples

echo "<br>";


if ($acao) {
//Tabela de resultados
echo "<table class='bordasimples' width='100%'><tr><td>";
echo "<table width='100%'>";
echo "<tr><td colspan='10'><h1>Relat&oacute;rio quantitativo de procedimentos instaurados</h1></td></tr>";

//Cabecalho
echo "<tr bgcolor='#CECECE'>";
	echo "<td><b>TIPOS</b></td>";
	for ($x=$filtro->sjd_ref_ano_ini; $x<=$filtro->sjd_ref_ano_fim; $x++) {
		echo "<td><b>$x</b></td>";
	}
echo "<tr>\r\n";

$i=0;

foreach ($sjd_procedimentos as $procedimento) {
	$z++;
	
	//Busca no banco de dados o nome do procedimento de acordo com a sigla
	$sqlNome="SELECT * FROM procedimentos_tipos WHERE sigla='".strtoupper($procedimento)."'";
	$rowNome=mysql_fetch_assoc(mysql_query($sqlNome));
	$nomeProcedimento=$rowNome["nome"];

	unset ($vetor);
	//Query de contagem
	unset($sqlWhere);
	$sql="SELECT COUNT(*) AS qtd, sjd_ref_ano FROM $procedimento ";
		$groupby=" sjd_ref_ano ";
		$_REQUEST['order']=" sjd_ref_ano ";
	
	//pre($filtro);
	include("includes/filtro.php");
	//pre($sql);

	if ($_SESSION["debug"]) pre($sql);
	
	$res=mysql_query($sql);
	while ($row=mysql_fetch_assoc($res)) {
		$ano=$row["sjd_ref_ano"];
		$vetor[$ano]=$row[qtd];
	}

	($z%2)?($cor="#EEEEEE"):($cor="white");
	echo "<tr bgcolor='$cor'>";
		echo "<td>$nomeProcedimento</td>\r\n";
		for ($x=$filtro["sjd_ref_ano_ini"]; $x<= $filtro["sjd_ref_ano_fim"]; $x++) {
			if (!$vetor[$x]) $vetor[$x]=0;
		
			$link="<a href='?module=$procedimento&opcao=listar&".$procedimento."[cdopm_st]=".$filtro["cdopm_st"]."'>";
			
			echo "<td>$link $vetor[$x]</a></td>";
		}
	echo "</tr>";
	
}


echo "</table>";
echo "</table>";//bordasimples
}

formulario::values($filtroobj);

?>
