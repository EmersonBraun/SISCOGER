<?php

//Padronizacao dos valores do formulario
if (!$_REQUEST["filtro"]["procedimento"]) $_REQUEST["filtro"]["procedimento"]="ipm";

$filtro=new filtro();
$filtro->setValues($_REQUEST["filtro"]);
if (!$filtro->sjd_ref_ano_ini) $filtro->sjd_ref_ano_ini=($_SESSION["sjd_ano"]-1);
if (!$filtro->sjd_ref_ano_fim) $filtro->sjd_ref_ano_fim=($_SESSION["sjd_ano"]);

//DEFVARS
$procedimento=$filtro->procedimento;
//Busca no banco de dados o nome do procedimento de acordo com a sigla
$sqlNome="SELECT * FROM procedimentos_tipos WHERE sigla='".strtoupper($procedimento)."'";
$rowNome=mysql_fetch_assoc(mysql_query($sqlNome));
$nomeProcedimento=$rowNome["nome"];

//O vetor camposPrazo deve ser
// [0] - Data de inicio da contagem
// [1] - Data de fim da contagem
//O vetor colunasMostra ira definir quais colunas serao mostradas no relatorio, alem das do camposPrazo

if ($procedimento=="ipm") {
	$camposPrazo=Array("abertura_data","relato_enc_data");
	$colunasMostra=Array("relato_cmt_opm","relato_cmtgeral");
}


//if ($procedimento=="apfd") $situacao="Acusado";
//if ($procedimento=="cd") $situacao="Acusado";
//if ($procedimento=="cj") $situacao="Justificante";
//if ($procedimento=="desercao") $situacao="Desertor";
//if ($procedimento=="fatd") $situacao="Acusado";
//if ($procedimento=="iso") $situacao="Paciente";
//if ($procedimento=="it") $situacao="Condutor";
//if ($procedimento=="sindicancia") $situacao="Sindicado";


//Formulario. Que serve tambem para mostrar os filtros

echo "<table class='bordasimples' width='100%'><tr><td>\r\n";
echo "<table width='100%'>";
echo "<form action='?module=relatorio&opcao=postos_graduacoes' method='POST'>";
form::openTR();
	form::openTD("colspan=3");
		echo "<h1>Relatorio de prazos - Processos</h1>";
	form::closeTD();
form::closeTR();
form::openTR();
	form::openTD();
		form::openLabel("Procedimento/processo");
			$sql="SELECT * FROM procedimentos_tipos";
			$res=mysql_query($sql);
			echo "<select name='filtro[procedimento]'>";
				while ($row=mysql_fetch_assoc($res)) {
					echo "<option value='".strtolower($row["sigla"])."'>$row[nome]</option>";
				}
			echo "</select>";
		form::closeLabel();
	form::closeTD();
form::closeTR();
if (!isset($noheader)) {
	form::openTR(); form::openTD("colspan=3");
		form::openLabel("Vers&atilde;o para impress&atilde;o");
			echo "<input type='checkbox' name='noheader'> Clique aqui";
		form::closeLabel();
	form::closeTD(); form::closeTR();
}

form::openTR(); form::openTD("colspan=3");
	echo "<input type='submit' name='acao' value='Prazos'>";
form::closeTD(); form::closeTR();

echo "</table>";
echo "</table>";//bordasimples


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
	//Query de contagem
	$sql="SELECT ".$camposPrazo[0].", ".$camposPrazo[1].",
		(TO_DAYS(".$camposPrazo[1].")-TO_DAYS(".$camposPrazo[0].")) AS diferenca
			FROM $procedimento
		WHERE $procedimento.sjd_ref_ano ='".$_SESSION['sjd_ano']."'
		ORDER BY id_$procedimento DESC";

	//if ($_SESSION["debug"])
		echo $sql."<br>\r\n";
	
	$res=mysql_query($sql);
	while ($row=mysql_fetch_assoc($res)) {
		$ano=$row["sjd_ref_ano"];
		$cargo=$row["cargo"];
		$vetor[$cargo]["$row[sjd_ref_ano]"]=$row["qtd"];
	}

	//$row=mysql_fetch_assoc(mysql_query($sql, $con[8]));
	
	if ($_SESSION["debug"]) pre($vetor);
//	die;
	
	$chaves=array_keys($vetor); //Guarda as graduacoes encontradas em um vetor
	$i=0;
	foreach ($vetor as $linha) {
		($i%2)?($cor="#EEEEEE"):($cor="white");
		$graduacao=$chaves[$i];
		echo "<tr bgcolor='$cor'>";
			echo "<td>$chaves[$i]</td>\r\n"; //Imprime a graduacao referente a linha
			for ($x=$filtro->sjd_ref_ano_ini; $x<= $filtro->sjd_ref_ano_fim; $x++) {
				if (!$linha[$x]) $linha[$x]=0;
				echo "<td>$linha[$x]</td>";
			}
		echo "</tr>";
		$i++;
	}
//}


echo "</table>";
echo "</table>";//bordasimples

formulario::values($filtro);

?>
