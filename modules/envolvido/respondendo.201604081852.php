<?php

echo "<form action='".$_SERVER['REQUEST_URI']."' method='POST'>\r\n";

echo "<h1>Relat&oacute;rio de policiais respondendo ou que responderam procedimentos</h1>";

openTable("width='100%' class='bordasimples'");

openTR(); openTD("colspan='4'");
	echo "<h2>Filtro</h2>";
closeTD(); closeTR();

form::openTR();
	form::openTD();
		form::openLabel("OPM do Policial (classifica&ccedil;&atilde;o do Meta4)");
			echo "<select name='envolvido[pm.cdopm_st]'>";
			include ("includes/option_opm.php");
			echo "</select>";
		form::closeLabel();
	form::closeTD();


	form::openTD();
		form::openLabel("Per&iacute;odo de refer&ecirc;ncia");
			if (!$envolvido->sjd_ref_ano_ini) $envolvido->sjd_ref_ano_ini=date("Y");

			echo "De";
			echo "<select name='envolvido[sjd_ref_ano_ini]'>";
			echo "<option value=''>Todos</option>";
			for ($i=2008; $i<=date("Y"); $i++) {
				echo "<option value='$i'>$i</option>";
			}
			echo "</select>";

			if (!$envolvido->sjd_ref_ano_fim) $envolvido->sjd_ref_ano_fim=date("Y");
			echo "At&eacute;";
			echo "<select name='envolvido[sjd_ref_ano_fim]'>";
			echo "<option value=''>Todos</option>";
			for ($i=2008; $i<=date("Y"); $i++) {
				echo "<option value='$i'>$i</option>";
			}
			echo "</select>";
		form::closeLabel();
	form::closeTD();
	openTD();
		form::openLabel("Andamento do processo");
		echo "<select name='envolvido[andamento]'>\r\n";
			echo "<option value=''>Todos</option>";
			$sql="SELECT DISTINCT andamento FROM andamento";
			$res=mysql_query($sql);
			while ($row=mysql_fetch_assoc($res)) {
				echo "<option value='$row[andamento]'>$row[andamento]</option>";
			}
		
		echo "</select>\r\n";
		form::closeLabel();
	closeTD();
form::closeTR();

form::openTR("id='linhafiltro'");
	form::openTD("colspan='6'");
		form::openLabel("Procedimentos");
		$mostrar=$_REQUEST['proc'];
		if (!$mostrar) $mostrar=Array("ipm","sindicancia","fatd","it","iso","apfd","cj","cd","adl");

		echo checkbox("proc[]","ipm","IPM",$mostrar)." |";
		echo checkbox("proc[]","sindicancia","SIND",$mostrar)." |";
		echo checkbox("proc[]","fatd","FATD",$mostrar)." |";
		echo checkbox("proc[]","it","IT",$mostrar)." |";
		echo checkbox("proc[]","iso","ISO",$mostrar)." |";
		echo checkbox("proc[]","apfd","APFD",$mostrar)." |";
		echo checkbox("proc[]","cj","CJ",$mostrar)." |";
		echo checkbox("proc[]","cd","CD",$mostrar)." |";
		echo checkbox("proc[]","adl","ADL",$mostrar);
		
		form::closeLabel();
	form::closeTD();
	closeTR();

form::openTR("id='linhafiltro'");
	form::openTD("colspan='6'");
		form::openLabel("Postos/Gradua&ccedil;&otilde;es");

		$mostrar=$_REQUEST['cargos'];

		$sql="SELECT TRIM(posto) AS posto, id_posto FROM RHPARANA.posto WHERE POSTO!='NULL' ORDER BY id_posto DESC";
		$res=mysql_query($sql);
		while ($row=mysql_fetch_assoc($res)) {
			echo checkbox("cargos[]","$row[posto]","$row[posto]",$mostrar)." |";
		}

		echo "<input type='checkbox' name='cargos[]' value=''> OUTRA COISA";
	
		form::closeLabel();
	form::closeTD();
	closeTR();

closeTable();
echo "<input class='noprint' type='submit' name='acao' value='Gerar'>";

echo "</form>\r\n<br>\r\n";

formulario::values($filtro,"filtro");
formulario::values($envolvido,"envolvido");

//MONTA O RELATORIO
//SQL dos policiais com o posto selecionado da OPM do filtro

//Define o que vai ser visto, qual a nomenclatura do que se esta respondendo
$resp["ipm"]="Indiciado";
$resp["sindicancia"]="Sindicado";
$resp["fatd"]="Acusado";
$resp["it"]="Condutor";
$resp["iso"]="Paciente";
$resp["apfd"]="Acusado";
$resp["cj"]="Justificante";
$resp["cd"]="Acusado";
$resp["adl"]="Acusado";

//vetor com os procedimentos (siglas) que precisam ser mostrados
$procedimentos=$_REQUEST['proc'];
$cargos=$_REQUEST['cargos'];

if (!is_array($cargos)) die("<h3>Escolha pelo menos um posto ou gradua&ccedil;&atilde;o</h3>");

$cargosImplode="'".implode("','",$cargos)."'";
//pre($cargosImplode);

openTable("class='bordasimples' width='100%'");

$sqlWhere[]="envolvido.cargo IN ($cargosImplode)";

foreach ($procedimentos as $proc) {
	//contador do procedimento i
	//contador total ii
	$sql="SELECT DISTINCT envolvido.*, '$proc' as procedimento, $proc.sjd_ref, $proc.sjd_ref_ano, andamento.andamento, opm.ABREVIATURA abreviatura
			FROM envolvido 
				INNER JOIN $proc ON $proc.id_$proc = envolvido.id_$proc
				LEFT JOIN RHPARANA.POLICIAL pm ON pm.rg=envolvido.rg
				LEFT JOIN RHPARANA.opmPMPR opm ON opm.CODIGO=pm.cdopm
				LEFT JOIN andamento ON andamento.id_andamento=$proc.id_andamento";

	//coloca o filtro da situacao
	$envolvido->situacao_eq=$resp["$proc"];

	include ("includes/filtro.php");

	if ($_SESSION['debug']) pre($sql);

	openLine(10);
		h1("$proc (".$resp["$proc"].")");
	closeLine();

	$res=mysql_query($sql);

	$i=0;
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="#E0E0E0"):($cor="#FFFFFF");
		openTR("bgcolor='$cor'");
			echo "<td>$row[cargo]</td>";
			echo "<td><a href='?module=tramitacao&policial[rg]=$row[rg]'>$row[nome]</a></td>";
			echo "<td>$row[abreviatura]</td>";
			//echo "<td>$row[situacao]</td>";
			
			//NIVEL 2 NAO PODE ACESSAR O PROCEDIMENTO
			//PEDIDO CAP TODISCO, 03/02/2014
			if ($user['nivel']==4 or $user['nivel']==5) {
				echo "<td><a target='_blank' href='?module=$proc&$proc"."[id]=".$row["id_$proc"]."'>$proc n&ordm; $row[sjd_ref]/$row[sjd_ref_ano]</a></td>";
			}
			else echo "<td>$proc n&ordm; $row[sjd_ref]/$row[sjd_ref_ano]</td>";
			
			echo "<td>$row[andamento]</td>";
		closeTR();
	$i++; $ii++;
	}
	openLine(10);
		h2("Total $proc: $i");
	closeLine();
	openLine(10);
		echo "<form action='myexcel.php' method='POST'>\r\n";
			echo "<input type='hidden' name='nome' value=\"rel_$proc\">";
			echo "<input type='hidden' name='sql' value=\"$sql\">";

			echo "<input type='hidden' name='campos[]' value='nome'>";
			echo "<input type='hidden' name='campos[]' value='rg'>";
			echo "<input type='hidden' name='campos[]' value='situacao'>";
			echo "<input type='hidden' name='campos[]' value='cargo'>";
			echo "<input type='hidden' name='campos[]' value='procedimento'>";
			echo "<input type='hidden' name='campos[]' value='sjd_ref'>";
			echo "<input type='hidden' name='campos[]' value='sjd_ref_ano'>";
			echo "<input type='hidden' name='campos[]' value='andamento'>";
			echo "<input type='hidden' name='campos[]' value='abreviatura'>";

			echo "<input type='submit' name='opcao' value=\"Excel dos $proc\">\r\n";
		echo "</form>";
	closeLine();
}

openLine(10);
	h1("Total Geral: $ii");
closeLine();

closeTable();

?>
