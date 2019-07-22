<?php
session_start(); 
header('Content-Type: text/html; charset=utf-8');
// Nome do Arquivo do Excel que será gerado
$arquivo = 'dados_it.xls';
//Filtra para somente ver a unidade do login, incluindo os comandos.
if ($user[nivel]<3) {
	if (!$it->opm_codigo_st) $it->cdopm_st=$opm_login->codigoBase;
}
$it->sjd_ref_ano=$_SESSION[sjd_ano];
//Campos padrao para serem mostrados na lista
if (!$_REQUEST['mostrar']) {
	$_REQUEST['mostrar']=Array("NRSJD","NROPM", "objetoprocedimento", "descricao");
}
//$mostrar = array($_REQUEST['mostrar']);
var_dump($mostrar);//

$tabela = '<table border="1"><th>';
foreach ($mostrar as $campo) {
	if     ($campo=="NROPM") $tabela .="<td>Nº COGER</td>";
	elseif ($campo=="NRSJD") $tabela .="<td>OPM</td>";
	elseif ($campo=="sintese_txt") $tabela .="<td>Sintese do fato</td>";
	elseif ($campo=="objetoprocedimento") $tabela .="<td>Objeto do procedimento</td>";
	elseif ($campo=="descricao") $tabela .="<td>Descrição</td>";
	elseif ($campo=="acordoamigavel") $tabela .="<td>Ressarcimento judicial</td>";
	elseif ($campo=="causa_acidente") $tabela .="<td>Causa do acidente</td>";
	elseif ($campo=="situacaoviatura") $tabela .="<td>Situação viatura</td>";
	elseif ($campo=="resp_civil") $tabela .="<td>Responsabilidade civil</td>";
	elseif ($campo=="acaojudicial") $tabela .="<td>Ação judicial</td>";
	elseif ($campo=="danoreal_rs") $tabela .="<td>Dano R$</td>";
	elseif ($campo=="tipo_acidente") $tabela .="<td>Tipo de acidente</td>";
	elseif ($campo=="andamento") $tabela .="<td>Andamento IT</td>";
	elseif ($campo=="andamentocoger") $tabela .="<td>Andamento COGER</td>";
	elseif ($campo=="fato_data") $tabela .="<td>Data do fato</td>";
	
}
$tabela.="<th>";

mysql_select_db("sjd");
$sql = $_SESSION['sql'];
$res=mysql_query($sql);
$i=0;
var_dump($res);//
while ($row=mysql_fetch_array($res)) {			
	foreach ($mostrar as $campo) {
		//campos em maiusculo, mostra mais de uma informacao
		$tabela .= '<tr>';	
		if     ($campo=="NROPM") $tabela .= "<td>$row[ABREVIATURA]</td>";
		elseif ($campo=="NRSJD") $tabela .= "<td>$row[sjd_ref]/$row[sjd_ref_ano]</td>";
		elseif ($campo=="sintese_txt")$tabela .= "<td>$row[sintese_txt]</td>";
		elseif ($campo=="objetoprocedimento") $tabela .= "<td>$row[objetoprocedimento]</td>";
		elseif ($campo=="descricao") {
			switch ($row[objetoprocedimento]){
				case 'viatura':
					$tabela .= "<td>$row[vtr_prefixo], (placa $row[vtr_placa])</td>";
				break;
				case 'arma':
					$tabela .= "<td>$row[identificacao_arma]</td>";
				break;
				case 'municao':
					$tabela .= "<td>$row[identificacao_municao]</td>";
				break;
				case 'semovente':
					$tabela .= "<td>$row[identificacao_semovente]</td>";
				break;
				case 'outros':
					$tabela .= "<td>$row[outros]</td>";
				break;
			}
		}
		elseif ($campo=="acordoamigavel") $tabela .= "<td>$row[acordoamigavel]</td>";
		elseif ($campo=="causa_acidente") $tabela .= "<td>$row[causa_acidente]</td>";
		elseif ($campo=="situacaoviatura") $tabela .= "<td>$row[situacaoviatura]</td>";
		elseif ($campo=="resp_civil") $tabela .= "<td>$row[resp_civil]</td>";
		elseif ($campo=="acaojudicial") $tabela .= "<td>$row[acaojudicial]</td>";
		elseif ($campo=="danoreal_rs") $tabela .= "<td>$row[danoreal_rs]</td>";
		elseif ($campo=="tipo_acidente") $tabela .= "<td>$row[tipo_acidente]</td>";
		elseif ($campo=="andamento") $tabela .= "<td>$row[andamento]</td>";
		elseif ($campo=="andamentocoger") $tabela .= "<td>$row[andamentocoger]</td>";
		elseif ($campo=="fato_data") $tabela .= "<td>".data::inverte($row["fato_data"])."</td>";
	}

	$tabela .= "</tr>";
$i++;
}
var_dump($row);
$tabela .= "<tr><td colspan='14'><h1>Total: ".mysql_num_rows($res)."</h1></td></tr>";
$tabela .= '</table>';

// Força o Download do Arquivo Gerado
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel");
header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
header ("Content-Description: PHP Generated Data" );
echo $tabela;
exit;
//ob_clean();
//header("location: http://10.47.1.90/sjd/index.php?module=it&opcao=buscar");


?>