<?php
$rg=$_REQUEST["rg"];

echo "<form action='?module=admin&opcao=logacessos' method='POST'>";

h1("Filtro");
openTable("width='100%' class='bordasimples'");
	openTR();
		openTD();
			form::openLabel("RG");
				echo "<input name='rg' type='text' size='10' maxlenght='15' onkeypress='return dntr(this,event)' value='$rg'>\r\n";
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

$limite=$_REQUEST['limite'];
if (!$limite) $limite=60;

$sql="SELECT TOP $limite log.*, usr.UserNome FROM LOG_ACESSOS log with (nolock)
left JOIN ppusuarios usr on log.rg = usr.userrg WHERE GrupoID='".ID_SISTEMA."' ";

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
