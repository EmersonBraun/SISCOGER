<?php

echo "<form action='".$_SERVER['REQUEST_URI']."' method='POST'>\r\n";

echo "<h1>Relat&oacute;rio de encarregados</h1>";

openTable("width='100%' class='bordasimples'");

openTR(); openTD("colspan='4'");
	echo "<h2>Filtro</h2>";
closeTD(); closeTR();

form::openTR();
	form::openTD();
		form::openLabel("OPM");
			echo "<select name='filtro[cdopm_st]'>";
			include ("includes/option_opm.php");
			echo "</select>";
		form::closeLabel();
	form::closeTD();
	form::openTD();
		form::openLabel("Procedimento");
			include("includes/filtro_proc.php");
		form::closeLabel();
	form::closeTD();
	form::openTD();
		form::openLabel("Ano de refer&ecirc;ncia");
			echo "<select name='filtro[sjd_ref_ano]'>";
			echo "<option value=''>Todos</option>";
			for ($i=2008; $i<=date("Y"); $i++) {
				echo "<option value='$i'>$i</option>";
			}
			echo "</select>";
		form::closeLabel();
	form::closeTD();
form::closeTR();

closeTable();
echo "<input type='submit' name='acao' value='Encarregados'>";
echo "<input type='submit' name='acao' value='Fusion'>";

echo "</form>\r\n<br>\r\n";

formulario::values($filtro,"filtro");

//MONTA O RELATORIO

$_REQUEST['order']="nome";

if ($acao) {
	$filtro=new filtro();
	$filtro->setValues($_REQUEST['filtro']);
	$filtro->situacao="Encarregado";

	$proc=$filtro->procedimento;
	if ($proc=="ipm") $sqlWhere[]=" envolvido.id_ipm!='0' ";
	if ($proc=="sindicancia") $sqlWhere[]=" envolvido.id_sindicancia!='0' ";
	if ($proc=="cj") $sqlWhere[]=" envolvido.id_cj!='0' ";
	if ($proc=="cd") $sqlWhere[]=" envolvido.id_cd!='0' ";
	if ($proc=="it") $sqlWhere[]=" envolvido.id_it!='0' ";
	if ($proc=="adl") $sqlWhere[]=" envolvido.id_adl!='0' ";
	if ($proc=="apfd") $sqlWhere[]=" envolvido.id_apfd!='0' ";
	if ($proc=="fatd") $sqlWhere[]=" envolvido.id_fatd!='0' ";
	if ($proc=="iso") $sqlWhere[]=" envolvido.id_iso!='0' ";
	if ($proc=="desercao") $sqlWhere[]=" envolvido.id_desercao!='0' ";
	unset($filtro->procedimento); //Nao utiliza

	$groupby="nome";
	$sql="SELECT COUNT(*) AS quantidade, CONCAT(envolvido.cargo, ' ',envolvido.nome) AS grupo, $proc.cdopm  FROM envolvido LEFT 
JOIN 
$proc ON $proc.id_$proc = envolvido.id_$proc " ;

	$_REQUEST['order']="quantidade DESC";
	include ("includes/filtro.php");

	//pre($sql);

}

if ($acao=="fusion") {
	$res=mysql_query($sql);
	$alturaGrafico=35*mysql_num_rows($res)+50;
	
	if (mysql_num_rows>50) die("Muitos resultados para o relatorio grafico! Utilize o relatorio normal.");

	$grafico=new fusion($sql, 3,"Relatorio",800,$alturaGrafico);
}
if ($acao=="encarregados") {
	$res=mysql_query($sql);

	openTable("width='100%' class='bordasimples'");
		openTR(); openTD("colspan='2'");
			echo "<h2>Quantidade de procedimentos por Encarregado</h2>";
		closeTD(); closeTR();
	
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="white"):($cor="#F0F0F0");
		openTR("bgcolor='$cor'");
		echo "<td>$row[grupo]</td>";
		echo "<td>$row[quantidade]</td>";
		closeTR();
		$i++;
	}
	closeTable();
}

?>
