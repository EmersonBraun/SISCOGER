<?php
$dp_inativo = ($usuario->opm->codigo == '11000004') ? 1 : 0;

if (!(($user['nivel']>=4) || ($usuarioComandoIntermediario === true)) && !$dp_inativo) {
    echo "<h3>O usuário não tem permissão para o módulo de busca de inativo</h3>";
    exit();
}

$inativo=$_REQUEST['inativo'];

if ($opcao == 'log') {
    include 'log.php';
    exit();
}

include("filtro.inc.php");

$sql="SELECT DISTINCT TOP 500
	N_TIPO_RH, CBR_NUM_RG, NOME, convert(varchar(10),DT_NASC,120) as DT_NASC, cargo, QUADRO,
        END_CIDADE, convert(varchar(10),DT_INI_RH,120) as DT_INI_RH

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

if (!empty($inativo['rg'])) {
    require __DIR__ . DIRECTORY_SEPARATOR . 'mostrar_inativo.php';
    exit();
}

if (!$acao) die;

if ($_SESSION["debug"]) pre($sql);

mssql_select_db("RHPARANA", $con[4]);

$res=mssql_query($sql, $con[4]);

h1("Reserva remunerada - PMPR");

openTable("class='bordasimples' width='100%'");

	openTR("class='h2'");
		echo "<td>CARGO</td>";
		echo "<td>NOME</td>";
		echo "<td>RG</td>";
                echo "<td>NASCIMENTO</td>";
		echo "<td>CIDADE</td>";
		echo "<td>RESERVA</td>";
	closeTR();

$i=0;
while ($row=mssql_fetch_assoc($res)) {
        $i++;
	//pre($row);
	($i%2)?($cor="#FFFFFF"):($cor="#E0E0E0");

        $linkInativo = '<a target="_blank" href="?module=inativo&inativo[rg]=' . $row[CBR_NUM_RG] .'">';

	openTR("bgcolor='$cor'");
		echo "<td>{$linkInativo}$row[cargo] $row[QUADRO]</a></td>";
		echo "<td>{$linkInativo}$row[NOME]</a></td>";
		echo "<td>{$linkInativo}$row[CBR_NUM_RG]</a></td>";
                echo "<td>{$linkInativo}".data::inverte(substr($row["DT_NASC"],0,10))."</a></td>";
		echo "<td>{$linkInativo}$row[END_CIDADE]</a></td>";
		echo "<td>{$linkInativo}".data::inverte(substr($row["DT_INI_RH"],0,10))."</a></td>";

	closeTR();


}
openLine(10);
	h2("Mostrando $i (máximo 500)");
closeLine();
closeTable();

/** ?>

<form action="excel.php" method=POST>
<input type="submit" name="opcao" class="btn btn-success" value="Excel">

<?php

echo "<input type=\"hidden\" name=\"sql\" value=\"$sql\">";
echo "</form>";


*/
