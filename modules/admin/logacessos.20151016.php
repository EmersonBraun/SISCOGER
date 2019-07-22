<?php
if (isset($_REQUEST['filtro'])) {

	$rg=trim($_REQUEST["filtro"]["rg"]);
	$limite=(integer)trim($_REQUEST["filtro"]["limite"]);
	$data_ini=trim($_REQUEST["filtro"]["data_ini"]);
	$data_fim=trim($_REQUEST["filtro"]["data_fim"]);
	$nome=trim($_REQUEST["filtro"]["nome"]);

	$limite = $limite > 0 ? $limite : 60;

	if (!empty($_REQUEST["filtro"]["data_ini"])) {
		$data_ini_objeto = date_create_from_format('d/m/Y',$data_ini);
		if ($data_ini_objeto) {
			$data_ini = $data_ini_objeto->format('Y-m-d 00:00:00');
		} else {
		$data_ini = null;
		}
	} else {
		$data_ini = null;
	}

	if (!empty($_REQUEST["filtro"]["data_fim"])) {
		$data_fim_objeto = date_create_from_format('d/m/Y',$data_fim);
		if ($data_fim_objeto) {
			$data_fim = $data_fim_objeto->format('Y-m-d 23:59:59');
		} else {
			$data_fim = null;
		}
	} else {
		$data_fim = null;
	}

}

echo "<form id='filtro' action='?module=admin&opcao=logacessos' method='POST'>";

h1("Filtro");
openTable("width='100%' class='bordasimples'");
	openTR();
		openTD();
			form::openLabel("RG");
				echo "<input name='filtro[rg]' type='text' size='10' maxlenght='15' onkeypress='return dntr(this,event)' value='$rg'>\r\n";
			form::closeLabel();
		closeTD();
		openTD();
			form::openLabel("Nome");
				echo "<input name='filtro[nome]' type='text' size='20' maxlenght='60' onkeypress='return dntr(this,event)' value='$nome'>\r\n";
			form::closeLabel();
		closeTD();
		form::openTD();
		form::openLabel("Per&iacute;odo");
		echo "De&nbsp; ";
		formulario::data("filtro","data_ini");
		calendario::cria(1,"filtro","filtro[data_ini]");
		echo "At&eacute;&nbsp; ";
		formulario::data("filtro","data_fim");
		calendario::cria(2,"filtro","filtro[data_fim]");
		form::closeLabel();
		form::closeTD();
		openTD();
			form::openLabel("Limite");
				echo "<input name='filtro[limite]' type='text' size='6' maxlenght='6' onkeypress='return dntr(this,event)' value='$limite'>\r\n";
			form::closeLabel();
		closeTD();
		openTD();
			echo "<input type='submit' name='acao' value='Filtrar'>\r\n";
		closeTD();
	closeTR();
closeTable();
echo "<br>";
echo "</form>";



mssql_select_db("passowrds",$con[3]);

if (!$limite) $limite=60;

$sql="SELECT TOP $limite log.*, usr.UserNome FROM LOG_ACESSOS log with (nolock)
left JOIN ppusuarios usr on log.rg = usr.userrg WHERE GrupoID='".ID_SISTEMA."'  ";

if ((!is_null($data_ini)) && (!is_null($data_fim))) {
	$sql.=" AND (log.datahora BETWEEN '$data_ini' AND '$data_fim') ";
}

if ($nome) $sql.=" AND usr.UserNome like '%$nome%' ";

if ($rg) $sql.=" AND log.rg='$rg' ";
$sql.=" ORDER BY log.datahora DESC ";


$res=mssql_query($sql,$con[3]);

echo "<h1>Log de acessos ao sistema - Limitando em $limite</h1>";

openTable("class='bordasimples' width='100%'");
	while ($row=mssql_fetch_assoc($res)) {
		($i%2)?($cor="white"):($cor="#E0E0E0");

		openTR("bgcolor='$cor'");
		echo "<td>$row[rg]</td>";
		echo "<td>{$row['UserNome']}</td>";
		echo "<td>$row[ip]</td>";
		echo "<td>".udf($row["datahora"],"datahora")."</td>";
		closeTR();
		$i++;
	}
closeTable();

?>
