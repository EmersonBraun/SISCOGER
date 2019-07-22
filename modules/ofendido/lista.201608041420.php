<?php

$proc=$_REQUEST["proc"];

//include ("menu.inc");
//include ("filtro.inc");

//pre($ofendido);

//echo "<br>";

$ofendido=new ofendido();
$ofendido->setValues($_REQUEST['ofendido']);

$ipm=new ipm();
$ipm->setValues($_REQUEST['ipm']);
//pre($ofendido);

if ($user['nivel']<4) $ofendido->cdopm_st=$opm_login->codigoBase;


if (!$_REQUEST['order']) $_REQUEST['order']="id_ofendido DESC";

//SQL DO MODULO

h1("Lista de ofendidos");
//h2("Filtro + -");

echo "<form action='?module=ofendido&opcao=listar' method='POST'>";
openTable("id='tabelafiltro' class='bordasimples' style='border-top:0px;' width='100%'");
	openTR();
		openTD();
			form::openLabel("Ano do procedimento");
				echo "De <select name='ofendido[sjd_ref_ano_ini]'>";
					for ($i=2008; $i<=date("Y"); $i++) {
						echo "<option>$i</option>";
					}
				echo "</select>";
				echo "At&eacute; <select name='ofendido[sjd_ref_ano_fim]'>";
					for ($i=2008; $i<=date("Y"); $i++) {
						echo "<option>$i</option>";
					}
				echo "</select>";
			form::closeLabel();
		closeTD();
		openTD();
			form::openLabel("Procedimento");
			$sql="SELECT * FROM procedimentos_tipos";
			$res=mysql_query($sql);
			echo "<select name='proc'>";
			while ($row=mysql_fetch_assoc($res)) {
				echo "<option value='".strtolower($row["sigla"])."'>$row[nome]</option>";
			}
			echo "</select>";
			form::closeLabel();
		closeTD();
		openTD();
			form::openLabel("OPM");
				echo "<select name='ofendido[cdopm]'>";
				include("/var/www/sjd/includes/option_opm.php");
				echo "</select>";
			form::closeLabel();
		closeTD();
		openTD();
			form::openLabel("Resultado");
				echo "<input type='hidden' name='ofendido[resultado_eq]' value='".$ofendido->resultado_eq."'>";
				echo $ofendido->resultado_eq;
			form::closeLabel();
		closeTD();
	closeTR();

//Linha do IPM
if ($proc=="ipm") {
	openTR();
		openTD();
			form::openLabel("Crime");
				echo "<select name='ofendido[crime]'>\r\n";
					echo "<option value=''>Todos</option>";
					include("includes/option_crime.html");
				echo "</select>\r\n";
			form::closeLabel();
		closeTD();
		openTD();
			form::openLabel("Confronto armado");
				echo "<select name='ofendido[confronto_armado_bl_eq]'>";
					echo "<option value=''>Independe";
					if ($ipm->confronto_armado_bl_eq) echo "<option selected value='On'>Apenas com confronto";
					else echo "<option value='On'>Apenas com confronto";
				echo "</select>";
			form::closeLabel();
		closeTD();

		openTD("colspan='2'");
			form::openLabel("Situa&ccedil;&atilde;o");
				formulario::option("ipm","situacao","","",0,0);
			form::closeLabel();
		closeTD();

	closeTR();

	openTR();
		openTD();
			form::openLabel("Vitima");
			?>
			<select name='ofendido[vitima_eq]'>
				<option value=''>Independe</option>
				<option value='Civil'>Civil</option>
				<option value='Policial Militar'>Policial Militar</option>
				<option value='Civil e Militar'>Civil e Militar</option>
			</select>
			<?php
			form::closeLabel();
		closeTD();
	closeTR();
}

closeTable();
				echo "<input type='submit' name='acao' value='Listar'>";
echo "</form>";

formulario::values($ofendido);
if ($proc=="ipm") formulario::values($ipm);

echo "<br>";
//FALTA CDOPM

$proc=$_REQUEST["proc"];

$sql="
SELECT DISTINCT ofendido.*, opm.ABREVIATURA, $proc.* ";

if ($proc=="ipm") $sql.= ", municipio.*, situacao.situacao ";

$sql.="
	FROM ofendido

	INNER JOIN $proc ON $proc.id_$proc = ofendido.id_$proc
	
	LEFT JOIN RHPARANA.opmPMPR opm on $proc.cdopm=opm.CODIGOBASE ";

if ($proc=="ipm") $sql.=" LEFT JOIN municipio on $proc.id_municipio=municipio.id_municipio ";
if ($proc=="ipm") $sql.=" LEFT JOIN  situacao on $proc.id_situacao=situacao.id_situacao ";
if ($proc=="ipm" and $ipm->id_situacao) $sqlWhere[]=" ipm.id_situacao='".$ipm->id_situacao."'";

	
//Filtra para somente ver a unidade do login, incluindo os comandos.
if ($user[nivel]<4) {
	if (!$ipm->cdopm_st) $ipm->cdopm_st=$opm_login->codigoBase;
}
//Filtro somente procedimentos do ano
//$ipm->sjd_ref_ano_eq=$_SESSION['sjd_ano'];


include ("includes/filtro.php");

if ($_SESSION['debug']) pre($sql);
$res=mysql_query($sql);

openTable("width='100%' class='bordasimples'");
	openLine(10); h2("Resultado da Busca"); closeLine();
	openTR();
		lista::td("Procedimento","sjd_ref");
		lista::td("OPM","cdopm");
		lista::td("Ofendido","nome");
		lista::td("Resultado","resultado");
		lista::td("Data do fato","fato_data");

		if ($proc=="ipm") {
			lista::td("Conf. Armado", "confronto_armado_bl");
			lista::td("Cidade", "municipio");

		}
	closeTR();
	
	$i=0; //contador
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="white"):($cor="#F0F0F0");
		openTR("bgcolor='$cor'");
			//$proc=$row['proc'];
			echo "<td><a href='?module=$proc&".$proc."[id]=".$row["id_$proc"]."'>$row[proc] $row[sjd_ref]/$row[sjd_ref_ano]</a></td>";
			echo "<td>$row[ABREVIATURA]</td>";
			echo "<td>$row[nome]</td>";
			echo "<td>$row[resultado]</td>";
			echo "<td>".data::inverte($row["fato_data"])."</td>";

			//CAMPOS ESPECIFICOS PARA IPM, PEDIDO CAP TODISCO 15/03/13
			if ($proc=="ipm") {
				echo "<td>$row[confronto_armado_bl]</td>";
				echo "<td>$row[municipio]</td>";

			}
			
		closeTR();
	$i++;
	}
	
closeTable();
h1("Total: $i");

echo "<form action='myexcel.php' method='POST'>";
	echo "<input type='hidden' name='sql' value=\"$sql\">";
	echo "<input type='submit' name='acao' value='Excel'>";
echo "</form>";


?>
