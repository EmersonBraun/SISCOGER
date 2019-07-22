<?php
if ($opm_login->codigoBase==="") $opm_login->codigoBase="0";
//var_dump($opm_login->codigoBase);exit;
h1("Procedimentos Priorit&aacute;rios");
echo "<br>";
//PENDENCIA Prioridades adl-------------------------------------------------------------
$sql="SELECT adl.*, a.andamento, ac.andamentocoger, opm.ABREVIATURA
FROM adl
LEFT JOIN andamento AS a ON
		adl.id_andamento = a.id_andamento
LEFT JOIN andamentocoger AS ac ON
	adl.id_andamentocoger = ac.id_andamentocoger
LEFT JOIN RHPARANA.opmPMPR AS opm ON
		opm.CODIGOBASE=adl.cdopm
WHERE prioridade='1'";
if ($_SESSION["debug"]) pre($sql);
$res=mysql_query($sql);

h1("Priorit&aacute;rios - ADL");
openTable("class='bordasimples' width='100%'");

if (mysql_num_rows($res)>0) {

	openTR();	
		lista::td("N&ordm; adl","NRSJD");
		lista::td("OPM Apura&ccedil;&atilde;o","NROPM");
		lista::td("Sintese do fato","sintese_txt");
		lista::td("Data do fato","fato_data");
		lista::td("Data de abertura","abertura_data");
		lista::td("Andamento","andamento");
		lista::td("Andamento COGER","andamentocoger");
	closeTR();
	//mostra as pendencias
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");

		openTR("bgcolor='$cor'"); 
			echo "<td><a href='?module=adl&adl[id]=$row[id_adl]'>$row[sjd_ref]/$row[sjd_ref_ano]</a></td>";
			echo "<td>$row[ABREVIATURA]</td>";
			echo "<td>$row[sintese_txt]</td>";
			echo "<td>".data::inverte($row["fato_data"])."</td>";
			echo "<td>".data::inverte($row["abertura_data"])."</td>";
			echo "<td>$row[andamento]</td>";
			echo "<td>$row[andamentocoger]</td>";
		closeTD(); 

		$i++;

		$totalPendencias++;
	}
	openLine(8); h2("Total Priorit&aacute;rios-adl: $i"); closeLine();
}
else echo "N&atilde;o h&aacute; Priorit&aacute;rios-ADL";
closeTable();



$i=0;
echo "<br>";

//PENDENCIA Prioridades apfd-------------------------------------------------------------
$sql="SELECT apfd.*, a.andamento, ac.andamentocoger, opm.ABREVIATURA
FROM apfd
LEFT JOIN andamento AS a ON
		apfd.id_andamento = a.id_andamento
LEFT JOIN andamentocoger AS ac ON
	apfd.id_andamentocoger = ac.id_andamentocoger
LEFT JOIN RHPARANA.opmPMPR AS opm ON
		opm.CODIGOBASE=apfd.cdopm
WHERE prioridade='1'";
if ($_SESSION["debug"]) pre($sql);
$res=mysql_query($sql);

h1("Priorit&aacute;rios - APFD");
openTable("class='bordasimples' width='100%'");

if (mysql_num_rows($res)>0) {

	openTR();	
		lista::td("N&ordm; APFD","NRSJD");
		lista::td("OPM Apura&ccedil;&atilde;o","NROPM");
		lista::td("Sintese do fato","sintese_txt");
		lista::td("Data do fato","fato_data");
		lista::td("Data de abertura","abertura_data");
		lista::td("Andamento","andamento");
		lista::td("Andamento COGER","andamentocoger");
	closeTR();
	//mostra as pendencias
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");

		openTR("bgcolor='$cor'"); 
			echo "<td><a href='?module=apfd&apfd[id]=$row[id_apfd]'>$row[sjd_ref]/$row[sjd_ref_ano]</a></td>";
			echo "<td>$row[ABREVIATURA]</td>";
			echo "<td>$row[sintese_txt]</td>";
			echo "<td>".data::inverte($row["fato_data"])."</td>";
			echo "<td>".data::inverte($row["abertura_data"])."</td>";
			echo "<td>$row[andamento]</td>";
			echo "<td>$row[andamentocoger]</td>";
		closeTD(); 

		$i++;

		$totalPendencias++;
	}
	openLine(8); h2("Total Priorit&aacute;rios-APFD: $i"); closeLine();
}
else echo "N&atilde;o h&aacute; Priorit&aacute;rios-APFD";
closeTable();



$i=0;
echo "<br>";

//PENDENCIA # Prioridades cd-----------------------------
$sql="SELECT cd.*, a.andamento, ac.andamentocoger, opm.ABREVIATURA
FROM cd
LEFT JOIN andamento AS a ON
		cd.id_andamento = a.id_andamento
LEFT JOIN andamentocoger AS ac ON
	cd.id_andamentocoger = ac.id_andamentocoger
LEFT JOIN RHPARANA.opmPMPR AS opm ON
		opm.CODIGOBASE=cd.cdopm
WHERE prioridade='1'";
if ($_SESSION["debug"]) pre($sql);
$res=mysql_query($sql);

h1("Priorit&aacute;rios - CD");
openTable("class='bordasimples' width='100%'");

if (mysql_num_rows($res)>0) {

	openTR();	
		lista::td("N&ordm; cd","NRSJD");
		lista::td("OPM Apura&ccedil;&atilde;o","NROPM");
		lista::td("Sintese do fato","sintese_txt");
		lista::td("Data do fato","fato_data");
		lista::td("Data de abertura","abertura_data");
		lista::td("Andamento","andamento");
		lista::td("Andamento COGER","andamentocoger");
	closeTR();
	//mostra as pendencias
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");

		openTR("bgcolor='$cor'"); 
			echo "<td><a href='?module=cd&cd[id]=$row[id_cd]'>$row[sjd_ref]/$row[sjd_ref_ano]</a></td>";
			echo "<td>$row[ABREVIATURA]</td>";
			echo "<td>$row[sintese_txt]</td>";		
			echo "<td>".data::inverte($row["fato_data"])."</td>";
			echo "<td>".data::inverte($row["abertura_data"])."</td>";
			echo "<td>$row[andamento]</td>";
			echo "<td>$row[andamentocoger]</td>";
		closeTD(); 

		$i++;

		$totalPendencias++;
	}
	openLine(8); h2("Total Priorit&aacute;rios-CD: $i"); closeLine();
}
else echo "N&atilde;o h&aacute; Priorit&aacute;rios-CD";
closeTable();



$i=0;
echo "<br>";

//PENDENCIA # Prioridades CJ-------------------------
$sql="SELECT cj.*, a.andamento, ac.andamentocoger, opm.ABREVIATURA
FROM cj
LEFT JOIN andamento AS a ON
		cj.id_andamento = a.id_andamento
LEFT JOIN andamentocoger AS ac ON
	cj.id_andamentocoger = ac.id_andamentocoger
LEFT JOIN RHPARANA.opmPMPR AS opm ON
		opm.CODIGOBASE=cj.cdopm
WHERE prioridade='1'";
if ($_SESSION["debug"]) pre($sql);
$res=mysql_query($sql);

h1("Priorit&aacute;rios - CJ");
openTable("class='bordasimples' width='100%'");

if (mysql_num_rows($res)>0) {

	openTR();	
		lista::td("N&ordm; CJ","NRSJD");
		lista::td("OPM Apura&ccedil;&atilde;o","NROPM");
		lista::td("Sintese do fato","sintese_txt");		
		lista::td("Data do fato","fato_data");
		lista::td("Data de abertura","abertura_data");
		lista::td("Andamento","andamento");
		lista::td("Andamento COGER","andamentocoger");
	closeTR();
	//mostra as pendencias
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");

		openTR("bgcolor='$cor'"); 
			echo "<td><a href='?module=cj&cj[id]=$row[id_cj]'>$row[sjd_ref]/$row[sjd_ref_ano]</a></td>";
			echo "<td>$row[ABREVIATURA]</td>";
			echo "<td>$row[sintese_txt]</td>";			
			echo "<td>".data::inverte($row["fato_data"])."</td>";
			echo "<td>".data::inverte($row["abertura_data"])."</td>";
			echo "<td>$row[andamento]</td>";
			echo "<td>$row[andamentocoger]</td>";
		closeTD(); 

		$i++;

		$totalPendencias++;
	}
	openLine(8); h2("Total Priorit&aacute;rios-CJ: $i"); closeLine();
}
else echo "N&atilde;o h&aacute; Priorit&aacute;rios-CJ";
closeTable();



$i=0;
echo "<br>";

//PENDENCIA # Prioridades desercao-------------------------
$sql="SELECT desercao.*, a.andamento, ac.andamentocoger, opm.ABREVIATURA
FROM desercao
LEFT JOIN andamento AS a ON
		desercao.id_andamento = a.id_andamento
LEFT JOIN andamentocoger AS ac ON
	desercao.id_andamentocoger = ac.id_andamentocoger
LEFT JOIN RHPARANA.opmPMPR AS opm ON
		opm.CODIGOBASE=desercao.cdopm
WHERE prioridade='1'";
if ($_SESSION["debug"]) pre($sql);
$res=mysql_query($sql);

h1("Priorit&aacute;rios - Deser&ccedil;&atilde;o");
openTable("class='bordasimples' width='100%'");

if (mysql_num_rows($res)>0) {

	openTR();	
		lista::td("N&ordm; Deser&ccedil;&atilde;o","NRSJD");
		lista::td("OPM Apura&ccedil;&atilde;o","NROPM");
		lista::td("Sintese do fato","sintese_txt");		
		lista::td("Data do fato","fato_data");
		lista::td("Data de abertura","abertura_data");
		lista::td("Andamento","andamento");
		lista::td("Andamento COGER","andamentocoger");
	closeTR();
	//mostra as pendencias
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");

		openTR("bgcolor='$cor'"); 
			echo "<td><a href='?module=desercao&desercao[id]=$row[id_desercao]'>$row[sjd_ref]/$row[sjd_ref_ano]</a></td>";
			echo "<td>$row[ABREVIATURA]</td>";
			echo "<td>$row[sintese_txt]</td>";			
			echo "<td>".data::inverte($row["fato_data"])."</td>";
			echo "<td>".data::inverte($row["abertura_data"])."</td>";
			echo "<td>$row[andamento]</td>";
			echo "<td>$row[andamentocoger]</td>";
		closeTD(); 

		$i++;

		$totalPendencias++;
	}
	openLine(8); h2("Total Priorit&aacute;rios-Deser&ccedil;&atilde;o: $i"); closeLine();
}
else echo "N&atilde;o h&aacute; Priorit&aacute;rios-Deser&ccedil;&atilde;o";
closeTable();



$i=0;
echo "<br>";

//PENDENCIA # Prioridades  exclusaojudicial-------------------------
/*$sql="SELECT  exclusaojudicial.*, a.andamento, ac.andamentocoger, opm.ABREVIATURA
FROM  exclusaojudicial
LEFT JOIN andamento AS a ON
		 exclusaojudicial.id_andamento = a.id_andamento
LEFT JOIN andamentocoger AS ac ON
	 exclusaojudicial.id_andamentocoger = ac.id_andamentocoger
LEFT JOIN RHPARANA.opmPMPR AS opm ON
		opm.CODIGOBASE= exclusaojudicial.cdopm
WHERE prioridade='1'";
if ($_SESSION["debug"]) pre($sql);
$res=mysql_query($sql);

h1("Priorit&aacute;rios - Exc. Jud.");
openTable("class='bordasimples' width='100%'");

if (mysql_num_rows($res)>0) {

	openTR();	
		lista::td("N&ordm; Exc. Jud.","NRSJD");
		lista::td("OPM Apura&ccedil;&atilde;o","NROPM");
		lista::td("Sintese do fato","sintese_txt");		
		lista::td("Data do fato","fato_data");
		lista::td("Data de abertura","abertura_data");
		lista::td("Andamento","andamento");
		lista::td("Andamento COGER","andamentocoger");
	closeTR();
	//mostra as pendencias
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");

		openTR("bgcolor='$cor'"); 
			echo "<td><a href='?module= exclusaojudicial&exclusaojudicial[id]=$row[id_ exclusaojudicial]'>$row[sjd_ref]/$row[sjd_ref_ano]</a></td>";
			echo "<td>$row[ABREVIATURA]</td>";
			echo "<td>$row[sintese_txt]</td>";			
			echo "<td>".data::inverte($row["fato_data"])."</td>";
			echo "<td>".data::inverte($row["abertura_data"])."</td>";
			echo "<td>$row[andamento]</td>";
			echo "<td>$row[andamentocoger]</td>";
		closeTD(); 

		$i++;

		$totalPendencias++;
	}
	openLine(8); h2("Total Priorit&aacute;rios-Exc. Jud.: $i"); closeLine();
}
else echo "N&atilde;o h&aacute; Priorit&aacute;rios-Exc. Jud.";
closeTable();



$i=0;
echo "<br>";*/

//PENDENCIA # Prioridades fatd-----------------------------
$sql="SELECT fatd.*, a.andamento, ac.andamentocoger, opm.ABREVIATURA
FROM fatd
LEFT JOIN andamento AS a ON
		fatd.id_andamento = a.id_andamento
LEFT JOIN andamentocoger AS ac ON
	fatd.id_andamentocoger = ac.id_andamentocoger
LEFT JOIN RHPARANA.opmPMPR AS opm ON
		opm.CODIGOBASE=fatd.cdopm
WHERE prioridade='1'";
if ($_SESSION["debug"]) pre($sql);
$res=mysql_query($sql);

h1("Priorit&aacute;rios - FATD");
openTable("class='bordasimples' width='100%'");

if (mysql_num_rows($res)>0) {

	openTR();	
		lista::td("N&ordm; fatd","NRSJD");
		lista::td("OPM Apura&ccedil;&atilde;o","NROPM");
		lista::td("Sintese do fato","sintese_txt");		
		lista::td("Data do fato","fato_data");
		lista::td("Data de abertura","abertura_data");
		lista::td("Andamento","andamento");
		lista::td("Andamento COGER","andamentocoger");
	closeTR();
	//mostra as pendencias
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");

		openTR("bgcolor='$cor'"); 
			echo "<td><a href='?module=fatd&fatd[id]=$row[id_fatd]'>$row[sjd_ref]/$row[sjd_ref_ano]</a></td>";
			echo "<td>$row[ABREVIATURA]</td>";
			echo "<td>$row[sintese_txt]</td>";			
			echo "<td>".data::inverte($row["fato_data"])."</td>";
			echo "<td>".data::inverte($row["abertura_data"])."</td>";
			echo "<td>$row[andamento]</td>";
			echo "<td>$row[andamentocoger]</td>";
		closeTD(); 

		$i++;

		$totalPendencias++;
	}
	openLine(8); h2("Total Priorit&aacute;rios-FATD: $i"); closeLine();
}
else echo "N&atilde;o h&aacute; Priorit&aacute;rios-FATD";
closeTable();



$i=0;
echo "<br>";

//PENDENCIA # Prioridades ipm-----------------------------
$sql="SELECT ipm.*, a.andamento, ac.andamentocoger, opm.ABREVIATURA
FROM ipm
LEFT JOIN andamento AS a ON
		ipm.id_andamento = a.id_andamento
LEFT JOIN andamentocoger AS ac ON
	ipm.id_andamentocoger = ac.id_andamentocoger
LEFT JOIN RHPARANA.opmPMPR AS opm ON
		opm.CODIGOBASE=ipm.cdopm
WHERE prioridade='1'";
if ($_SESSION["debug"]) pre($sql);
$res=mysql_query($sql);

h1("Priorit&aacute;rios - IPM");
openTable("class='bordasimples' width='100%'");

if (mysql_num_rows($res)>0) {

	openTR();	
		lista::td("N&ordm; ipm","NRSJD");
		lista::td("OPM Apura&ccedil;&atilde;o","NROPM");
		lista::td("Sintese do fato","sintese_txt");		
		lista::td("Data do fato","fato_data");
		lista::td("Data de abertura","abertura_data");
		lista::td("Andamento","andamento");
		lista::td("Andamento COGER","andamentocoger");
	closeTR();
	//mostra as pendencias
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");

		openTR("bgcolor='$cor'"); 
			echo "<td><a href='?module=ipm&ipm[id]=$row[id_ipm]'>$row[sjd_ref]/$row[sjd_ref_ano]</a></td>";
			echo "<td>$row[ABREVIATURA]</td>";
			echo "<td>$row[sintese_txt]</td>";			
			echo "<td>".data::inverte($row["fato_data"])."</td>";
			echo "<td>".data::inverte($row["abertura_data"])."</td>";
			echo "<td>$row[andamento]</td>";
			echo "<td>$row[andamentocoger]</td>";
		closeTD(); 

		$i++;

		$totalPendencias++;
	}
	openLine(8); h2("Total Priorit&aacute;rios-IPM: $i"); closeLine();
}
else echo "N&atilde;o h&aacute; Priorit&aacute;rios-IPM";
closeTable();



$i=0;
echo "<br>";

//PENDENCIA # Prioridades iso-----------------------------
$sql="SELECT iso.*, a.andamento, ac.andamentocoger, opm.ABREVIATURA
FROM iso
LEFT JOIN andamento AS a ON
		iso.id_andamento = a.id_andamento
LEFT JOIN andamentocoger AS ac ON
	iso.id_andamentocoger = ac.id_andamentocoger
LEFT JOIN RHPARANA.opmPMPR AS opm ON
		opm.CODIGOBASE=iso.cdopm
WHERE prioridade='1'";
if ($_SESSION["debug"]) pre($sql);
$res=mysql_query($sql);

h1("Priorit&aacute;rios - ISO");
openTable("class='bordasimples' width='100%'");

if (mysql_num_rows($res)>0) {

	openTR();	
		lista::td("N&ordm; iso","NRSJD");
		lista::td("OPM Apura&ccedil;&atilde;o","NROPM");
		lista::td("Sintese do fato","sintese_txt");		
		lista::td("Data do fato","fato_data");
		lista::td("Data de abertura","abertura_data");
		lista::td("Andamento","andamento");
		lista::td("Andamento COGER","andamentocoger");
	closeTR();
	//mostra as pendencias
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");

		openTR("bgcolor='$cor'"); 
			echo "<td><a href='?module=iso&iso[id]=$row[id_iso]'>$row[sjd_ref]/$row[sjd_ref_ano]</a></td>";
			echo "<td>$row[ABREVIATURA]</td>";
			echo "<td>$row[sintese_txt]</td>";			
			echo "<td>".data::inverte($row["fato_data"])."</td>";
			echo "<td>".data::inverte($row["abertura_data"])."</td>";
			echo "<td>$row[andamento]</td>";
			echo "<td>$row[andamentocoger]</td>";
		closeTD(); 

		$i++;

		$totalPendencias++;
	}
	openLine(8); h2("Total Priorit&aacute;rios-ISO: $i"); closeLine();
}
else echo "N&atilde;o h&aacute; Priorit&aacute;rios-ISO";
closeTable();



$i=0;
echo "<br>";

//PENDENCIA # Prioridades it-----------------------------
$sql="SELECT it.*, a.andamento, ac.andamentocoger, opm.ABREVIATURA
FROM it
LEFT JOIN andamento AS a ON
		it.id_andamento = a.id_andamento
LEFT JOIN andamentocoger AS ac ON
	it.id_andamentocoger = ac.id_andamentocoger
LEFT JOIN RHPARANA.opmPMPR AS opm ON
		opm.CODIGOBASE=it.cdopm
WHERE prioridade='1'";
if ($_SESSION["debug"]) pre($sql);
$res=mysql_query($sql);

h1("Priorit&aacute;rios - IT");
openTable("class='bordasimples' width='100%'");

if (mysql_num_rows($res)>0) {

	openTR();	
		lista::td("N&ordm; it","NRSJD");
		lista::td("OPM Apura&ccedil;&atilde;o","NROPM");
		lista::td("Sintese do fato","sintese_txt");		
		lista::td("Data do fato","fato_data");
		lista::td("Data de abertura","abertura_data");
		lista::td("Andamento","andamento");
		lista::td("Andamento COGER","andamentocoger");
	closeTR();
	//mostra as pendencias
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");

		openTR("bgcolor='$cor'"); 
			echo "<td><a href='?module=it&it[id]=$row[id_it]'>$row[sjd_ref]/$row[sjd_ref_ano]</a></td>";
			echo "<td>$row[ABREVIATURA]</td>";
			echo "<td>$row[sintese_txt]</td>";			
			echo "<td>".data::inverte($row["fato_data"])."</td>";
			echo "<td>".data::inverte($row["abertura_data"])."</td>";
			echo "<td>$row[andamento]</td>";
			echo "<td>$row[andamentocoger]</td>";
		closeTD(); 

		$i++;

		$totalPendencias++;
	}
	openLine(8); h2("Total Priorit&aacute;rios-IT: $i"); closeLine();
}
else echo "N&atilde;o h&aacute; Priorit&aacute;rios-IT";
closeTable();



$i=0;
echo "<br>";

//PENDENCIA # Prioridades sindicancia-----------------------------
$sql="SELECT sindicancia.*, a.andamento, ac.andamentocoger, opm.ABREVIATURA
FROM sindicancia
LEFT JOIN andamento AS a ON
		sindicancia.id_andamento = a.id_andamento
LEFT JOIN andamentocoger AS ac ON
	sindicancia.id_andamentocoger = ac.id_andamentocoger
LEFT JOIN RHPARANA.opmPMPR AS opm ON
		opm.CODIGOBASE=sindicancia.cdopm
WHERE prioridade='1'";
if ($_SESSION["debug"]) pre($sql);
$res=mysql_query($sql);

h1("Priorit&aacute;rios - Sindic&acirc;ncia");
openTable("class='bordasimples' width='100%'");

if (mysql_num_rows($res)>0) {

	openTR();	
		lista::td("N&ordm; sindicancia","NRSJD");
		lista::td("OPM Apura&ccedil;&atilde;o","NROPM");
		lista::td("Sintese do fato","sintese_txt");		
		lista::td("Data do fato","fato_data");
		lista::td("Data de abertura","abertura_data");
		lista::td("Andamento","andamento");
		lista::td("Andamento COGER","andamentocoger");
	closeTR();
	//mostra as pendencias
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");

		openTR("bgcolor='$cor'"); 
			echo "<td><a href='?module=sindicancia&sindicancia[id]=$row[id_sindicancia]'>$row[sjd_ref]/$row[sjd_ref_ano]</a></td>";
			echo "<td>$row[ABREVIATURA]</td>";
			echo "<td>$row[sintese_txt]</td>";		
			echo "<td>".data::inverte($row["fato_data"])."</td>";
			echo "<td>".data::inverte($row["abertura_data"])."</td>";
			echo "<td>$row[andamento]</td>";
			echo "<td>$row[andamentocoger]</td>";
		closeTD(); 

		$i++;

		$totalPendencias++;
	}
	openLine(8); h2("Total Priorit&aacute;rios-Sindic&acirc;ncia: $i"); closeLine();
}
else echo "N&atilde;o h&aacute; Priorit&aacute;rios-Sindic&acirc;ncia";
closeTable();



$i=0;
echo "<br>";

//PENDENCIA # Prioridades pad-----------------------------
$sql="SELECT pad.*, a.andamento, ac.andamentocoger, opm.ABREVIATURA
FROM pad
LEFT JOIN andamento AS a ON
		pad.id_andamento = a.id_andamento
LEFT JOIN andamentocoger AS ac ON
	pad.id_andamentocoger = ac.id_andamentocoger
LEFT JOIN RHPARANA.opmPMPR AS opm ON
		opm.CODIGOBASE=pad.cdopm
WHERE prioridade='1'";
if ($_SESSION["debug"]) pre($sql);
$res=mysql_query($sql);

h1("Priorit&aacute;rios - PAD");
openTable("class='bordasimples' width='100%'");

if (mysql_num_rows($res)>0) {

	openTR();	
		lista::td("N&ordm; pad","NRSJD");
		lista::td("OPM Apura&ccedil;&atilde;o","NROPM");
		lista::td("Sintese do fato","sintese_txt");	
		lista::td("Data do fato","fato_data");
		lista::td("Data de abertura","abertura_data");
		lista::td("Andamento","andamento");
		lista::td("Andamento COGER","andamentocoger");
	closeTR();
	//mostra as pendencias
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");

		openTR("bgcolor='$cor'"); 
			echo "<td><a href='?module=pad&pad[id]=$row[id_pad]'>$row[sjd_ref]/$row[sjd_ref_ano]</a></td>";
			echo "<td>$row[ABREVIATURA]</td>";
			echo "<td>$row[sintese_txt]</td>";	
			echo "<td>".data::inverte($row["fato_data"])."</td>";
			echo "<td>".data::inverte($row["abertura_data"])."</td>";
			echo "<td>$row[andamento]</td>";
			echo "<td>$row[andamentocoger]</td>";
		closeTD(); 

		$i++;

		$totalPendencias++;
	}
	openLine(8); h2("Total Priorit&aacute;rios-PAD: $i"); closeLine();
}
else echo "N&atilde;o h&aacute; Priorit&aacute;rios-PAD";
closeTable();

$i=0;
echo "<br>";



h3("Pendencias. Total Geral: $totalPendencias");
?>
