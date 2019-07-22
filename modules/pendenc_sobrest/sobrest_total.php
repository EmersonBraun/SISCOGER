<?php 
//h1("Controle Sobrestamentos");
//h2("Sobrestamentos sem data de t&eacute;rmino"); echo "<br>\r\n";
//ADL--------------------------------------------------------------------------
$sql="
SELECT DISTINCT s.*, adl.cdopm, opm.ABREVIATURA,
SUM(if(termino_data ='0000-00-00',1,0)) AS quant
FROM sobrestamento AS s
INNER JOIN adl ON
		s.id_adl=adl.id_adl 
LEFT JOIN RHPARANA.opmPMPR AS opm ON
		opm.CODIGOBASE=adl.cdopm
WHERE s.termino_data ='0000-00-00' AND adl.id_andamento='17'
GROUP BY opm.ABREVIATURA";
	if ($_SESSION["debug"]) pre($sql);
$res=mysql_query($sql);

h1("Sobrestamento - ADL");
openTable("class='bordasimples' width='100%'");

if (mysql_num_rows($res)>0) {

	openTR();	
		lista::td("OPM Apura&ccedil;&atilde;o","NROPM");
		lista::td("Quantidade","quant");
	closeTR();
	//mostra as pendencias
	$i=0;
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");

		openTR("bgcolor='$cor'"); 
			echo "<td>$row[ABREVIATURA]</td>";
			echo "<td>$row[quant]</td>";
		closeTD(); 

		$adl+=$row['quant'];
		$i++;

	}
	openLine(8); h2("Total Sobrestamento-adl: $adl"); closeLine();

	$totalPendencias+=$adl;
	$i++;
}
else echo "N&atilde;o h&aacute; Sobrestamento-ADL";
closeTable();

$i=0;
echo "<br>";

//CD--------------------------------------------------------------------------
$sql="
SELECT s.*, cd.cdopm, opm.ABREVIATURA,
COUNT( DISTINCT cd.id_cd ) AS quant
FROM sobrestamento AS s
INNER JOIN cd ON
		s.id_cd=cd.id_cd 
INNER JOIN andamento ON
		andamento.procedimento ='cd'
LEFT JOIN RHPARANA.opmPMPR AS opm ON
		opm.CODIGOBASE=cd.cdopm
WHERE s.termino_data ='0000-00-00' AND cd.id_andamento='11'
GROUP BY opm.ABREVIATURA";
	if ($_SESSION["debug"]) pre($sql);
$res=mysql_query($sql);

h1("Sobrestamento - CD");
openTable("class='bordasimples' width='100%'");

if (mysql_num_rows($res)>0) {

	openTR();	
		lista::td("OPM Apura&ccedil;&atilde;o","NROPM");
		lista::td("Quantidade","quant");
	closeTR();
	//mostra as pendencias
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");

		openTR("bgcolor='$cor'"); 
			echo "<td>$row[ABREVIATURA]</td>";
			echo "<td>$row[quant]</td>";
		closeTD(); 

		$cd+=$row['quant'];
		$i++;
	}
	openLine(8); h2("Total Sobrestamento-CD: $cd"); closeLine();
	$totalPendencias+=$cd;
}
else echo "N&atilde;o h&aacute; Sobrestamento-CD";
closeTable();

$i=0;
echo "<br>";

//CJ--------------------------------------------------------------------------
$sql="
SELECT DISTINCT s.*, cj.cdopm, opm.ABREVIATURA,
COUNT( DISTINCT cj.id_cj ) AS quant
FROM sobrestamento AS s
INNER JOIN cj ON
		s.id_cj=cj.id_cj 
INNER JOIN andamento ON
		andamento.procedimento ='cj'
LEFT JOIN RHPARANA.opmPMPR AS opm ON
		opm.CODIGOBASE=cj.cdopm
WHERE s.termino_data ='0000-00-00' AND cj.id_andamento='14'
GROUP BY opm.ABREVIATURA";
	if ($_SESSION["debug"]) pre($sql);
$res=mysql_query($sql);

h1("Sobrestamento - CJ");
openTable("class='bordasimples' width='100%'");

if (mysql_num_rows($res)>0) {

	openTR();	
		lista::td("OPM Apura&ccedil;&atilde;o","NROPM");
		lista::td("Quantidade","quant");
	closeTR();
	//mostra as pendencias
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");

		openTR("bgcolor='$cor'"); 
			echo "<td>$row[ABREVIATURA]</td>";
			echo "<td>$row[quant]</td>";
		closeTD(); 

		$cj+=$row['quant'];
		$i++;

	}
	openLine(8); h2("Total Sobrestamento-CJ: $cj"); closeLine();
	$totalPendencias+=$cj;
}
else echo "N&atilde;o h&aacute; Sobrestamento-CJ";
closeTable();

$i=0;
echo "<br>";

//FATD--------------------------------------------------------------------------
$sql="
SELECT DISTINCT s.*, fatd.cdopm, opm.ABREVIATURA,
COUNT( DISTINCT fatd.id_fatd ) AS quant
FROM sobrestamento AS s
INNER JOIN fatd ON
		s.id_fatd=fatd.id_fatd 
INNER JOIN andamento ON
		andamento.procedimento ='fatd'
LEFT JOIN RHPARANA.opmPMPR AS opm ON
		opm.CODIGOBASE=fatd.cdopm
WHERE s.termino_data ='0000-00-00' AND fatd.id_andamento='3'
GROUP BY opm.ABREVIATURA";
	if ($_SESSION["debug"]) pre($sql);
$res=mysql_query($sql);

h1("Sobrestamento - FATD");
openTable("class='bordasimples' width='100%'");

if (mysql_num_rows($res)>0) {

	openTR();	
		lista::td("OPM Apura&ccedil;&atilde;o","NROPM");
		lista::td("Quantidade","quant");
	closeTR();
	//mostra as pendencias
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");

		openTR("bgcolor='$cor'"); 
			echo "<td>$row[ABREVIATURA]</td>";
			echo "<td>$row[quant]</td>";
		closeTD(); 

		$fatd+=$row['quant'];
		$i++;
	}
	openLine(8); h2("Total Sobrestamento-FATD: $fatd"); closeLine();
	$totalPendencias+=$fatd;
}
else echo "N&atilde;o h&aacute; Sobrestamento-FATD";
closeTable();

$i=0;
echo "<br>";

//ISO--------------------------------------------------------------------------
$sql="
SELECT DISTINCT s.*, iso.cdopm, opm.ABREVIATURA,
COUNT( DISTINCT iso.id_iso ) AS quant
FROM sobrestamento AS s
INNER JOIN iso ON
		s.id_iso=iso.id_iso 
INNER JOIN andamento ON
		andamento.procedimento ='iso'
LEFT JOIN RHPARANA.opmPMPR AS opm ON
		opm.CODIGOBASE=iso.cdopm
WHERE s.termino_data ='0000-00-00' AND iso.id_andamento='20'
GROUP BY opm.ABREVIATURA";
	if ($_SESSION["debug"]) pre($sql);
$res=mysql_query($sql);

h1("Sobrestamento - ISO");
openTable("class='bordasimples' width='100%'");

if (mysql_num_rows($res)>0) {

	openTR();	
		lista::td("OPM Apura&ccedil;&atilde;o","NROPM");
		lista::td("Quantidade","quant");
	closeTR();
	//mostra as pendencias
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");

		openTR("bgcolor='$cor'"); 
			echo "<td>$row[ABREVIATURA]</td>";
			echo "<td>$row[quant]</td>";
		closeTD(); 

		$iso+=$row['quant'];
		$i++;
	}
	openLine(8); h2("Total Sobrestamento-ISO: $iso"); closeLine();
	$totalPendencias+=$iso;
}
else echo "N&atilde;o h&aacute; Sobrestamento-ISO";
closeTable();

$i=0;
echo "<br>";

//IT--------------------------------------------------------------------------
$sql="
SELECT DISTINCT s.*, it.cdopm, opm.ABREVIATURA,
COUNT( DISTINCT it.id_it ) AS quant
FROM sobrestamento AS s
INNER JOIN it ON
		s.id_it=it.id_it 
INNER JOIN andamento ON
		andamento.procedimento ='it'
LEFT JOIN RHPARANA.opmPMPR AS opm ON
		opm.CODIGOBASE=it.cdopm
WHERE s.termino_data ='0000-00-00' AND it.id_andamento='23'
GROUP BY opm.ABREVIATURA";
	if ($_SESSION["debug"]) pre($sql);
$res=mysql_query($sql);

h1("Sobrestamento - IT");
openTable("class='bordasimples' width='100%'");

if (mysql_num_rows($res)>0) {

	openTR();	
		lista::td("OPM Apura&ccedil;&atilde;o","NROPM");
		lista::td("Quantidade","quant");
	closeTR();
	//mostra as pendencias
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");

		openTR("bgcolor='$cor'"); 
			echo "<td>$row[ABREVIATURA]</td>";
			echo "<td>$row[quant]</td>";
		closeTD(); 

		$it+=$row['quant'];
		$i++;
	}
	openLine(8); h2("Total Sobrestamento-IT: $it"); closeLine();
	$totalPendencias+=$it;
}
else echo "N&atilde;o h&aacute; Sobrestamento-IT";
closeTable();

$i=0;
echo "<br>";

//SINDICÂNCIA--------------------------------------------------------------------------
$sql="
SELECT DISTINCT s.*, sindicancia.cdopm, opm.ABREVIATURA,
COUNT( DISTINCT sindicancia.id_sindicancia ) AS quant
FROM sobrestamento AS s
INNER JOIN sindicancia ON
		s.id_sindicancia=sindicancia.id_sindicancia 
INNER JOIN andamento ON
		andamento.procedimento ='sindicancia'
LEFT JOIN RHPARANA.opmPMPR AS opm ON
		opm.CODIGOBASE=sindicancia.cdopm
WHERE s.termino_data ='0000-00-00' AND sindicancia.id_andamento='8'
GROUP BY opm.ABREVIATURA";
	if ($_SESSION["debug"]) pre($sql);
$res=mysql_query($sql);

h1("Sobrestamento - Sindic&acirc;ncia");
openTable("class='bordasimples' width='100%'");

if (mysql_num_rows($res)>0) {

	openTR();	
		lista::td("OPM Apura&ccedil;&atilde;o","NROPM");
		lista::td("Quantidade","quant");
	closeTR();
	//mostra as pendencias
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");

		openTR("bgcolor='$cor'"); 
			echo "<td>$row[ABREVIATURA]</td>";
			echo "<td>$row[quant]</td>";
		closeTD(); 

		$sind+=$row['quant'];
		$i++;
	}
	openLine(8); h2("Total Sobrestamento-Sindic&acirc;ncia: $sind"); closeLine();
	$totalPendencias+=$sind;
}
else echo "N&atilde;o h&aacute; Sobrestamento-Sindic&acirc;ncia";

closeTable();

$i=0;
echo "<br>";

h3("Pendencias. Total Geral: $totalPendencias");

?>
