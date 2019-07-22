<?php

//include ("menu.inc");
//include ("filtro.inc");

//echo "<br>";

$sqlWhere[]=" envolvido.situacao='Acusado' ";

if (!$_REQUEST['order']) $_REQUEST['order']="cd.id_cd DESC";
//sql do modulo
$sql="SELECT cd.*, andamento, envolvido.nome, envolvido.cargo, envolvido.resultado FROM cd
	LEFT JOIN andamento ON
		cd.id_andamento = andamento.id_andamento
	INNER JOIN envolvido ON
		envolvido.id_cd!=0 AND envolvido.id_cd=cd.id_cd";

//Filtra para somente ver a unidade do login, incluindo os comandos.
if ($user[nivel]<4) {
	if (!$cd->cdopm_st) $cd->cdopm_st=$opm_login->codigoBase;
}
//Filtro somente procedimentos do ano
$cd->sjd_ref_ano_eq=$_SESSION['sjd_ano'];


include ("includes/filtro.php");

if ($_SESSION['debug']) pre($sql);
$res=mysql_query($sql);

openTable("width='100%' class='bordasimples'");
	openLine(8);
		h1("JULGAMENTO DOS CONSELHOS DE DISCIPLINA (".$opm_login->abreviatura.")");
	closeLine();
	
	openTR();
		lista::td("N&ordm; COGER","sjd_ref");
		lista::td("Data do fato","fato_data");
		lista::td("Acusado","nome");
		lista::td("Andamento","andamento");
		lista::td("Comissao","parecer_comissao");
		lista::td("Cmt Geral","parecer_cmtgeral");
		lista::td("Julgamento","resultado");
	closeTR();
	
	$i=0; //contador
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="white"):($cor="#F0F0F0");
		openTR("bgcolor='$cor'");
			echo "<td>".lista::link("atualizar")."$row[sjd_ref]/$row[sjd_ref_ano]</td>";
			echo "<td>".udf($row['fato_data'],"data")."</td>";
			echo "<td>$row[cargo] $row[nome]</td>";
			echo "<td>$row[andamento]</td>";
			echo "<td>$row[parecer_comissao]</td>";
			echo "<td>$row[parecer_cmtgeral]</td>";
			echo "<td>$row[resultado]</td>";
		closeTR();
	$i++;
	}
	
closeTable();



?>
