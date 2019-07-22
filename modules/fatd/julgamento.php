<?php

//include ("menu.inc");
include ("filtro.inc");

//echo "<br>";

$sqlWhere[]=" envolvido.situacao='Acusado' ";

if (!$_REQUEST['order']) $_REQUEST['order']="fatd.id_fatd DESC";
//sql do modulo
$sql="SELECT fatd.*, andamento, rhopm.ABREVIATURA, envolvido.rg, envolvido.nome, envolvido.cargo, envolvido.resultado, envolvido.id_punicao, gradacao.gradacao FROM fatd
	LEFT JOIN andamento ON
		fatd.id_andamento = andamento.id_andamento
	LEFT OUTER JOIN RHPARANA.opmPMPR AS rhopm ON
		rhopm.CODIGOBASE=fatd.cdopm
	INNER JOIN envolvido ON
		envolvido.id_fatd!=0 AND envolvido.id_fatd=fatd.id_fatd
	LEFT JOIN punicao ON punicao.id_punicao=envolvido.id_punicao
	LEFT JOIN gradacao ON gradacao.id_gradacao=punicao.id_gradacao";

//Filtra para somente ver a unidade do login, incluindo os comandos.
if ($user[nivel]<4) {
	$nomevar="fatd.cdopm_st";
	if (!$fatd->$nomevar) $fatd->$nomevar=$opm_login->codigoBase;
}
//Filtro somente procedimentos do ano
$nomevar="fatd.sjd_ref_ano_eq";

$fatd->$nomevar=$_SESSION['sjd_ano'];


include ("includes/filtro.php");

if ($_SESSION['debug']) pre($sql);
$res=mysql_query($sql);

openTable("width='100%' class='bordasimples'");
	openLine(7);
		h1("ANDAMENTO DOS FATD (".$opm_login->abreviatura.")");
	closeLine();
	
	openTR();
		lista::td("N&ordm; COGER","sjd_ref");
		lista::td("OPM","cdopm");
		lista::td("Abertura","abertura_data");
		lista::td("Acusado","nome");
		lista::td("Andamento","andamento");
		lista::td("Julgamento","resultado");
		lista::td("Punicao","resultado,gradacao");
	closeTR();
	
	$i=0; //contador
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="white"):($cor="#F0F0F0");
		openTR("bgcolor='$cor'");
			echo "<td>".lista::link("atualizar")."$row[sjd_ref]/$row[sjd_ref_ano]</td>";
			echo "<td>$row[ABREVIATURA]</td>";
			echo "<td>".udf($row['abertura_data'],"data")."</td>";
			echo "<td>$row[cargo] $row[nome]</td>";
			echo "<td>$row[andamento]</td>";
			echo "<td>$row[resultado]</td>";
			
			if ($row['resultado']=="Punido") {
							
				if (!$row['id_punicao']) {
					echo "<td>";
						link::popup("?module=punicao&opcao=cadastrar&rg=$row[rg]&punicao[sjd_ref]=$row[sjd_ref]&punicao[sjd_ref_ano]=$row[sjd_ref_ano]&punicao[procedimento]=fatd&noheader&lock","800","600");
						echo "Cadastrar";
					echo "</td>";
				}
				else {
					echo "<td>$row[gradacao]</td>";
				}
			}
			else echo "<td>&nbsp;</td>";
			
		closeTR();
	$i++;
	}
	
closeTable();



?>
