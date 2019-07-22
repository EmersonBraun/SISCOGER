<?php

$inativo=$_REQUEST['inativo'];

include("filtro.inc.php");
 
$sql="SELECT DISTINCT TOP 500
	N_TIPO_RH, CBR_NUM_RG, NOME, DT_NASC, cargo, QUADRO,
	N_RUA, END_LOGRADOURO, END_NUMERO, END_COMPL, END_BAIRRO, END_CIDADE, END_CEP, DT_INI_RH

FROM INATIVOS ";

$sqlWhere[]="N_TIPO_RH='APOSENTADO'";
$order=$_REQUEST["order"]; if (!$order) $order="NOME";

include("includes/filtro.php");

//INATIVO
//	STD_ID_HR
//	DT_INI_RH - DATA DE INICIO, EX: INICIO DA APOSENTADORIA
//	N_TIPO_RH - GERADOR DE PENSAO, APOSENTADO, ETC
//
//	NOME:
//	DT_NASC:
//	cargo:
//	QUADRO: (PM)
//
//	N_RUA:
//	END_LOGRADOURO:
//	END_NUMERO:
//	END_COMPL:
//	END_BAIRRO:
//	END_CIDADE:
//	END_CEP:
if (!$acao) die;
if ($_SESSION["debug"]) pre($sql);

mssql_select_db("RHPARANA", $con[4]);

$res=mssql_query($sql, $con[4]);

h1("Reserva remunerada - PMPR");

openTable("class='bordasimples' width='100%'");

	openTR("class='h2'");
		echo "<td>POSTO</td>";
		echo "<td>NOME</td>";
		echo "<td>RG</td>";
		echo "<td>ENDERECO</td>";
		echo "<td>BAIRRO</td>";
		echo "<td>CIDADE</td>";
		echo "<td>CEP</td>";
		echo "<td>RESERVA</td>";
	closeTR();


while ($row=mssql_fetch_assoc($res)) {
	//pre($row);	
	($i%2)?($cor="#FFFFFF"):($cor="#E0E0E0");
	openTR("bgcolor='$cor'");
		echo "<td>$row[cargo] $row[QUADRO]</td>";
		echo "<td>$row[NOME]</td>";
		echo "<td>$row[CBR_NUM_RG]</td>";
		echo "<td>$row[N_RUA] $row[END_LOGRADOURO], $row[END_NUMERO] $row[END_COMPL]</td>";
		echo "<td>$row[END_BAIRRO]</td>";
		echo "<td>$row[END_CIDADE]</td>";
		echo "<td>$row[END_CEP]</td>";
		echo "<td>".data::inverte(substr($row["DT_INI_RH"],0,10))."</td>";
		
	closeTR();
	$i++;
	  
}
openLine(10);
	h2("Mostrando $i (máximo 500)");
closeLine();
closeTable();

?>

<form action="excel.php" method=POST>
<input type="submit" name="opcao" class="btn btn-success" value="Excel">

<?php  
  
echo "<input type=\"hidden\" name=\"sql\" value=\"$sql\">";
echo "</form>";	


