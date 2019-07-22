<?php
//Filtra para somente ver a unidade do login, incluindo os comandos.
if ($user[nivel]<3) {
	if (!$sai->opm_codigo_st) $sai->cdopm_st=$opm_login->codigoBase;
}
//$sai->sjd_ref_ano=$_SESSION[sjd_ano];

$sql="SELECT DISTINCT sai.*, rhopm.ABREVIATURA, m.municipio, andamento.andamento, andamentocoger.andamentocoger
FROM sai
LEFT JOIN andamento ON
		sai.id_andamento = andamento.id_andamento
	LEFT JOIN andamentocoger ON
		sai.id_andamentocoger = andamentocoger.id_andamentocoger
LEFT JOIN municipio AS m ON m.id_municipio=sai.id_municipio
LEFT JOIN RHPARANA.opmPMPR AS rhopm ON rhopm.CODIGOBASE = sai.cdopm_fato";
include ("includes/filtro.php");
//if ($_SESSION[debug]) pre($sql);
//Filtro somente procedimentos do ano

$sql=lista::paginas();
?>

<center>
<!-- -->
<table width="100%" cellpadding="0px"  class="bordasimples" id="example1">
   <tr><TD colspan="12"><center><h1><?=$opm_login->descricao;?></center></h1></TD></tr>
   <tr><TD colspan="12"><h2><center>Policiais - Investiga&ccedil;&atilde;o - <?echo $_SESSION[sjd_ano];?></center></h2></TD></tr>
<?php
//pre($sql);
openTR();	
foreach ($mostrar as $campo) {
	
	if     ($campo=="NRSJD") lista::td("N&ordm; SAI","NRSJD");
	elseif ($campo=="NROPM") lista::td("OPM","NROPM");
	elseif ($campo=="sintese_txt") lista::td("Sintese do fato","sintese_txt");
	elseif ($campo=="motivo_principal") lista::td("Motivo Principal","motivo_principal");
	elseif ($campo=="municipio") lista::td("Cidade","municipio");
	elseif ($campo=="placa") lista::td("Placa","placa");
	elseif ($campo=="prefixo") lista::td("Prefixo","prefixo");
	elseif ($campo=="docorigem") lista::td("Doc. Origem","docorigem");
	elseif ($campo=="andamento") lista::td("Andamento","andamento");
	elseif ($campo=="andamentocoger") lista::td("And. COGER","andamentocoger");
	elseif ($campo=="fato_data") lista::td("Data do fato","fato_data");
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

		if     ($campo=="NRSJD") 
		{
			if ($row["sjd_ref_ano"]!=="0") 
			{
				echo "<td><a href='?module=sai&sai[id]=$row[id_sai]'>$row[sjd_ref]/$row[sjd_ref_ano]</a></td>";
			}
			else
			{
				echo "<td><a href='?module=sai&sai[id]=$row[id_sai]'>$row[id_sai]</a></td>";
			}
		}
		elseif ($campo=="NROPM") echo "<td>$row[ABREVIATURA]</td>";
		elseif ($campo=="sintese_txt") echo "<td>$row[sintese_txt]</td>";
		elseif ($campo=="motivo_principal") echo "<td>$row[motivo_principal]</td>";
		elseif ($campo=="municipio") echo "<td>$row[municipio]</td>";
		elseif ($campo=="placa") echo "<td>1-$row[vtr1_placa]</br>2-$row[vtr2_placa]</td>";
		elseif ($campo=="prefixo") echo "<td>1-$row[vtr1_prefixo]</br>2-$row[vtr2_prefixo]</td>";
		elseif ($campo=="docorigem") echo "<td>$row[docorigem]</td>";
		elseif ($campo=="andamento") echo "<td>$row[andamento]</td>";
		elseif ($campo=="andamentocoger") echo "<td>$row[andamentocoger]</td>";
		//elseif ($campo=="resultado") echo "<td>$row[origem_proc]-$row[origem_sjd_ref]/$row[origem_sjd_ref_ano]</td>";
		elseif ($campo=="fato_data") echo "<td>".data::inverte($row["data"])."</td>";
	}

	echo "</tr>";
	
$i++;

}

lista::rodape($sql,$lpp);

?>

</table>

