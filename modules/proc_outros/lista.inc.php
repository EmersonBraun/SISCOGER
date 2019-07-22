<?php
//Filtra para somente ver a unidade do login, incluindo os comandos.
if ($user[nivel]<3) {
	if (!$proc_outros->opm_codigo_st) $proc_outros->cdopm_st=$opm_login->codigoBase;
}
//pre($proc_outros->opm_codigo_st);
$proc_outros->sjd_ref_ano=$_SESSION[sjd_ano];

if ($opm_login->codigoBase != '020') 
{
	$sql="SELECT DISTINCT proc_outros.*, rhopm.ABREVIATURA, m.municipio
	FROM proc_outros
	LEFT JOIN municipio AS m ON m.id_municipio=proc_outros.id_municipio
	LEFT JOIN RHPARANA.opmPMPR AS rhopm ON rhopm.CODIGOBASE = proc_outros.cdopm_apuracao 
	WHERE  cdopm  LIKE '$opm_login->codigoBase%' OR  cdopm_apuracao LIKE '$opm_login->codigoBase%'
	AND  sjd_ref_ano  LIKE '%$proc_outros->sjd_ref_ano%'  ORDER BY id_proc_outros DESC";
}
else
{
	$sql="SELECT DISTINCT proc_outros.*, rhopm.ABREVIATURA, m.municipio
	FROM proc_outros
	LEFT JOIN municipio AS m ON m.id_municipio=proc_outros.id_municipio
	LEFT JOIN RHPARANA.opmPMPR AS rhopm ON rhopm.CODIGOBASE = proc_outros.cdopm_apuracao 
	AND  sjd_ref_ano  LIKE '%$proc_outros->sjd_ref_ano%'  ORDER BY id_proc_outros DESC";
}


/*$sql="SELECT DISTINCT proc_outros.*, rhopm.ABREVIATURA, m.municipio
FROM proc_outros
LEFT JOIN municipio AS m ON m.id_municipio=proc_outros.id_municipio
LEFT JOIN RHPARANA.opmPMPR AS rhopm ON rhopm.CODIGOBASE = proc_outros.cdopm_apuracao";
include ("includes/filtro.php");*/
if ($_SESSION[debug]) pre($sql);

$sql=lista::paginas();
?>

<center>
<!-- -->
<table width="100%" cellpadding="0px"  class="bordasimples" id="example1">
   <tr><TD colspan="12"><center><h1><?=$opm_login->descricao;?></center></h1></TD></tr>
   <tr><TD colspan="12"><h2><center>Audi&ecirc;ncia de Cust&oacute;dia | Pedido de Provid&ecirc;ncia | Noticia de Fato - <?echo $_SESSION[sjd_ano];?></center></h2></TD></tr>
<?php
//pre($sql);
openTR();	
foreach ($mostrar as $campo) {
	
	if     ($campo=="NRSJD") lista::td("N&ordm; proc_outros","NRSJD");
	elseif ($campo=="cdopm") lista::td("OPM (abertura)","cdopm");
	elseif ($campo=="cdopm_apuracao") lista::td("OPM (apura&ccedil;&atilde;o)","cdopm_apuracao");
	elseif ($campo=="sintese_txt") lista::td("Sintese do fato","sintese_txt");
	elseif ($campo=="motivo_abertura") lista::td("Motivo Principal","motivo_abertura");
	elseif ($campo=="doc_origem") lista::td("Documento Origem","doc_origem");
	elseif ($campo=="municipio") lista::td("Cidade","municipio");
	elseif ($campo=="placa") lista::td("Placa","placa");
	elseif ($campo=="prefixo") lista::td("Prefixo","prefixo");
	elseif ($campo=="andamento") lista::td("Andamento","andamento");
	elseif ($campo=="andamentocoger") lista::td("And. COGER","andamentocoger");
	elseif ($campo=="data") lista::td("Data do fato","data");
	elseif ($campo=="abertura_data") lista::td("Data de recebimento","abertura_data");
	//elseif ($campo=="resultado") lista::td("Resultado","resultado");
	//else echo "<td><b>".ucwords(strtolower($campo))."</b></td>";

}
closeTR();

mysql_select_db("sjd");
$res=mysql_query($sql);
$i=0;

if ($res == 0 || $res == NULL){$lpp = 0; $sql=0;} else {$lpp = 60;}//caso não tenha dados na pesquisa

while ($row=mysql_fetch_array($res)) {
	$i%2?($cor=white):($cor='#EEEEEE');
	echo "<tr bgcolor=$cor>";
	//Imprime cada um dos campos selecionados para ser mostrado			
	foreach ($mostrar as $campo) {
		//campos em maiusculo, mostra mais de uma informacao

		if     ($campo=="NRSJD") echo "<td><a href='?module=proc_outros&proc_outros[id]=$row[id_proc_outros]'>$row[sjd_ref]/$row[sjd_ref_ano]</a></td>";
		elseif ($campo=="cdopm") echo "<td>$row[opm_abreviatura]</td>";
		elseif ($campo=="cdopm_apuracao") echo "<td>$row[ABREVIATURA]</td>";
		elseif ($campo=="sintese_txt") echo "<td>$row[sintese_txt]</td>";
		elseif ($campo=="motivo_abertura") echo "<td>$row[motivo_abertura]</td>";
		elseif ($campo=="doc_origem") echo "<td>$row[doc_origem]</td>";
		elseif ($campo=="municipio") echo "<td>$row[municipio]</td>";
		elseif ($campo=="placa") echo "<td>1-$row[vtr1_placa]</br>2-$row[vtr2_placa]</td>";
		elseif ($campo=="prefixo") echo "<td>1-$row[vtr1_prefixo]</br>2-$row[vtr2_prefixo]</td>";
		elseif ($campo=="andamento") echo "<td>$row[andamento]</td>";
		elseif ($campo=="andamentocoger") echo "<td>$row[andamentocoger]</td>";
		//elseif ($campo=="resultado") echo "<td>$row[origem_proc]-$row[origem_sjd_ref]/$row[origem_sjd_ref_ano]</td>";
		elseif ($campo=="data") echo "<td>".data::inverte($row["data"])."</td>";
		elseif ($campo=="abertura_data") echo "<td>".data::inverte($row["abertura_data"])."</td>";
	}

	echo "</tr>";
	
$i++;

}

lista::rodape($sql,$lpp);

?>

</table>

