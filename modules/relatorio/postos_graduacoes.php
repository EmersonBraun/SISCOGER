<?php

//Padronizacao dos valores do formulario
if (!$_REQUEST["filtro"]["procedimento"]) $_REQUEST["filtro"]["procedimento"]="ipm";

$filtro=new filtro();
$filtro->setValues($_REQUEST["filtro"]);
$filtroobj=$filtro;
if (!$filtro->sjd_ref_ano_ini) $filtro->sjd_ref_ano_ini=($_SESSION["sjd_ano"]-1);
if (!$filtro->sjd_ref_ano_fim) $filtro->sjd_ref_ano_fim=($_SESSION["sjd_ano"]);

//DEFVARS
$procedimento=$filtro->procedimento;
//Busca no banco de dados o nome do procedimento de acordo com a sigla
$sqlNome="SELECT * FROM procedimentos_tipos WHERE sigla='".strtoupper($procedimento)."'";
$rowNome=mysql_fetch_assoc(mysql_query($sqlNome));
$nomeProcedimento=$rowNome["nome"];

if ($procedimento=="apfd") $situacao="Acusado";
if ($procedimento=="cd") $situacao="Acusado";
if ($procedimento=="adl") $situacao="Acusado";
if ($procedimento=="cj") $situacao="Justificante";
if ($procedimento=="desercao") $situacao="Desertor";
if ($procedimento=="fatd") $situacao="Acusado";
if ($procedimento=="ipm") $situacao="Indiciado";
if ($procedimento=="iso") $situacao="Paciente";
if ($procedimento=="it") $situacao="Condutor";
if ($procedimento=="sindicancia") $situacao="Sindicado";


//Formulario. Que serve tambem para mostrar os filtros

echo "<table class='bordasimples' width='100%'><tr><td>\r\n";
echo "<table width='100%'>";
echo "<form action='?module=relatorio&opcao=postos_graduacoes' method='POST'>";
form::openTR();
	form::openTD("colspan=4");
		echo "<h1>Relat&oacute;rio quantitativo por posto/gradua&ccedil;&atilde;o</h1>";
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
		form::openLabel("Procedimento/processo");
			$sql="SELECT * FROM procedimentos_tipos";
			$res=mysql_query($sql);
			echo "<select name='filtro[procedimento]'>";
				while ($row=mysql_fetch_assoc($res)) {
					echo "<option ";
					if (strtolower($row['sigla'])==strtolower($filtro->procedimento)) echo " selected ";
					echo "value='".strtolower($row["sigla"])."'>$row[nome]</option>";
				}
			echo "</select>";
		form::closeLabel();
	form::closeTD();
	form::openTD();
		form::openLabel("OPM");
			echo "<select name='filtro[cdopm]'>\r\n";
			include("includes/option_opm.php");
			echo "</select>\r\n";
		form::closeLabel();
form::closeTR();

form::openTR(); form::openTD("colspan=4");
	echo "<input type='submit' name='acao' value='Gerar relat&oacute;rio'>";
form::closeTD(); form::closeTR();

echo "</table>";
echo "</table>";//bordasimples

echo "<br>";


if ($acao) {
//Tabela de resultados
echo "<table class='bordasimples' width='100%'><tr><td>";
echo "<table width='100%'>";
echo "<tr><td colspan='10'><h1>Contagem de postos e gradua&ccedil;&otilde;es ($situacao)</h1></td></tr>";

//Cabecalho
echo "<tr bgcolor='#CECECE'>";
	echo "<td><b>TIPOS</b></td>";
	for ($x=$filtro->sjd_ref_ano_ini; $x<=$filtro->sjd_ref_ano_fim; $x++) {
		echo "<td><b>$x</b></td>";
	}
echo "<tr>\r\n";

$i=0;
//foreach ($sjd_procedimentos as $procedimento) {

	unset ($vetor);
	unset($filtro->procedimento);
	//Query de contagem
	$sql="SELECT COUNT(*) AS qtd, cargo, posto.id_posto, ".$procedimento.".sjd_ref_ano FROM envolvido
		INNER JOIN $procedimento ON
			$procedimento.id_$procedimento=envolvido.id_$procedimento
		LEFT JOIN RHPARANA.posto AS posto ON
			posto.posto=envolvido.cargo ";
	$sqlWhere[]=" envolvido.id_".$procedimento." != '0' ";
	$sqlWhere[]=" situacao='$situacao' ";
	$groupby=" cargo, sjd_ref_ano ";
	$_REQUEST['order']=" id_posto ASC";
	include("includes/filtro.php");

	if ($_SESSION["debug"]) pre($sql);
	
	$res=mysql_query($sql);
	while ($row=mysql_fetch_assoc($res)) {
		$ano=$row["sjd_ref_ano"];
		$cargo=$row["cargo"];
		if (!$cargo) $cargo="A APURAR";
		$vetor[$cargo]["$row[sjd_ref_ano]"]=$row["qtd"];
	}

	//$row=mysql_fetch_assoc(mysql_query($sql, $con[8]));
	
	if ($_SESSION["debug"]) pre($vetor);
//	die;
	
	if (is_array($vetor)) {
	$chaves=array_keys($vetor); //Guarda as graduacoes encontradas em um vetor
	$i=0;
	foreach ($vetor as $linha) {
		($i%2)?($cor="#EEEEEE"):($cor="white");
		$graduacao=$chaves[$i];
		echo "<tr bgcolor='$cor'>";
			echo "<td>$chaves[$i]</td>\r\n"; //Imprime a graduacao referente a linha
			for ($x=$filtro["sjd_ref_ano_ini"]; $x<= $filtro["sjd_ref_ano_fim"]; $x++) {
				if (!$linha[$x]) $linha[$x]=0;
				echo "<td>$linha[$x]</td>";
			}
		echo "</tr>";
		$i++;
	} //foreach
	} //if isarray
//}


echo "</table>";
echo "</table>";//bordasimples
}

formulario::values($filtroobj);

?>
