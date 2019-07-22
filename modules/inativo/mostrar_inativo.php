<?php

$inativo=$_REQUEST['inativo'];

$sql="SELECT
	N_TIPO_RH, CBR_NUM_RG, NOME, convert(varchar(10),DT_NASC,120) as DT_NASC, cargo, QUADRO, FONE,
	N_RUA, N_TIPO_LOCAL_END, N_TIPO_LOCAL_FONE, END_LOGRADOURO, END_NUMERO, END_COMPL, END_BAIRRO, END_CIDADE, END_CEP, convert(varchar(10),DT_INI_RH,120) as DT_INI_RH

FROM INATIVOS ";

$sqlWhere[]=" N_TIPO_RH='APOSENTADO'";

$sqlWhere[]=" CBR_NUM_RG='{$inativo['rg']}'";

$sql = $sql . ' where ' . implode(' and ', $sqlWhere);

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

if ($_SESSION["debug"]) pre($sql);

mssql_select_db("RHPARANA", $con[4]);

$res=mssql_query($sql, $con[4]);

$numero = mssql_num_rows($res);

if ($numero == 0) {
        echo '<tr><td colspan="5">Nenhum registro encontrado.</td></tr>';
        exit();
}

log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", visualizou dados do Militar Estadual: " . mssql_result($res, 0, 'cargo') . " " . mssql_result($res, 0, 'QUADRO') . " " . mssql_result($res, 0, 'NOME'),"consulta_inativo");

$mostrarPrimeiraLinha = true;

for ($i = 0; $i < $numero; $i++) {

    $fones[mssql_result($res, $i, 'N_TIPO_LOCAL_FONE')] = mssql_result($res, $i, 'FONE');

    $logradouros[mssql_result($res, $i, 'N_TIPO_LOCAL_END')]['end']  = mssql_result($res, $i, 'N_RUA');
    $logradouros[mssql_result($res, $i, 'N_TIPO_LOCAL_END')]['end'] .= ' ' . mssql_result($res, $i, 'END_LOGRADOURO');
    $logradouros[mssql_result($res, $i, 'N_TIPO_LOCAL_END')]['end'] .= ', ' . mssql_result($res, $i, 'END_NUMERO');
    $logradouros[mssql_result($res, $i, 'N_TIPO_LOCAL_END')]['end'] .= ' ' .mssql_result($res, $i, 'END_COMPL');

    $logradouros[mssql_result($res, $i, 'N_TIPO_LOCAL_END')]['bairro']  = mssql_result($res, $i, 'END_BAIRRO');
    $logradouros[mssql_result($res, $i, 'N_TIPO_LOCAL_END')]['cidade']  = mssql_result($res, $i, 'END_CIDADE');
    $logradouros[mssql_result($res, $i, 'N_TIPO_LOCAL_END')]['cep']  = mssql_result($res, $i, 'END_CEP');

    if ($mostrarPrimeiraLinha) {
        $mostrarPrimeiraLinha = false;

        h1("Dados - " . mssql_result($res, $i, 'cargo') . " " . mssql_result($res, $i, 'QUADRO') . " " . mssql_result($res, $i, 'NOME'));

        openTable("class='bordasimples' width='100%'");

            openTR("class='h2'");
                    echo "<td>CARGO</td>";
                    echo "<td>NOME</td>";
                    echo "<td>RG</td>";
                    echo "<td>NASCIMENTO</td>";
                    echo "<td>RESERVA</td>";
            closeTR();

            $cor="#E0E0E0";
            openTR("bgcolor='$cor'");
                    echo "<td>" . mssql_result($res, $i, 'cargo') . " " . mssql_result($res, $i, 'QUADRO') . "</td>";
                    echo "<td>" . mssql_result($res, $i, 'NOME') . "</td>";
                    echo "<td>" . mssql_result($res, $i, 'CBR_NUM_RG') . "</td>";
                    echo "<td>".data::inverte(substr(mssql_result($res, $i, 'DT_NASC'),0,10))."</td>";
                    echo "<td>".data::inverte(substr(mssql_result($res, $i, 'DT_INI_RH'),0,10))."</td>";
            closeTR();

        closeTable();

    }

}

h1("Endereços");

openTable("class='bordasimples' width='100%'");
openTR("class='h2'");
        echo "<td>TIPO</td>";
        echo "<td>ENDEREÇO</td>";
        echo "<td>BAIRRO</td>";
        echo "<td>MUNICÍPIO</td>";
        echo "<td>CEP</td>";
closeTR();

$j = 0;
foreach ($logradouros as $logradouroTipo => $logradouro) {
    $j++;
    //pre($row);
    ($j%2)?($cor="#E0E0E0"):($cor="#FFFFFF");

    openTR("bgcolor='$cor'");

    echo "<td>{$logradouroTipo}</td><td>{$logradouro['end']}</td><td>{$logradouro['bairro']}</td><td>{$logradouro['cidade']}</td><td>{$logradouro['cep']}</td>";

    closeTR();
}
closeTable();

h1("Telefones");

openTable("class='bordasimples' width='100%'");
openTR("class='h2'");
        echo "<td>TIPO</td>";
        echo "<td>FONE</td>";
closeTR();

$j = 0;
foreach ($fones as $foneTipo => $fone) {
    $j++;
    //pre($row);
    ($j%2)?($cor="#E0E0E0"):($cor="#FFFFFF");

    openTR("bgcolor='$cor'");

    echo "<td>{$foneTipo}</td><td>{$fone}</td>";

    closeTR();
}
closeTable();

/**

echo "<td>$row[N_RUA] $row[END_LOGRADOURO], $row[END_NUMERO] $row[END_COMPL]</td>";
		echo "<td>$row[END_BAIRRO]</td>";
		echo "<td>$row[END_CIDADE]</td>";
		echo "<td>$row[END_CEP]</td>";
                echo "<td>$row[FONE]</td>";
		echo "<td>".data::inverte(substr($row["DT_INI_RH"],0,10))."</td>";

echo "<td>$row[cargo] $row[QUADRO]</td>";
		echo "<td>$row[NOME]</td>";
		echo "<td>$row[CBR_NUM_RG]</td>";
                echo "<td>".data::inverte(substr($row["DT_INI_RH"],0,10))."</td>";
		echo "<td>$row[N_RUA] $row[END_LOGRADOURO], $row[END_NUMERO] $row[END_COMPL]</td>";
		echo "<td>$row[END_BAIRRO]</td>";
		echo "<td>$row[END_CIDADE]</td>";
		echo "<td>$row[END_CEP]</td>";
                echo "<td>$row[FONE]</td>";
		echo "<td>".data::inverte(substr($row["DT_INI_RH"],0,10))."</td>";
 * *
 */
