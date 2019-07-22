<?php

//Filtra para somente ver a unidade do login, incluindo os comandos.
if ($user[nivel]<3) {
	if (!$proc_outros->opm_codigo_st) $proc_outros->cdopm_st=$opm_login->codigoBase;
}
//pre($proc_outros->opm_codigo_st);
$proc_outros->sjd_ref_ano=$_SESSION[sjd_ano];

if ($opm_login->codigoBase != '020') 
{
	$sql="SELECT p.*, rhopm.ABREVIATURA,
    (SELECT GROUP_CONCAT(e.nome SEPARATOR ', ') FROM envolvido e WHERE e.id_proc_outros = p.id_proc_outros) AS envolvido,
    (SELECT GROUP_CONCAT(o.nome SEPARATOR ', ') FROM ofendido o WHERE o.id_proc_outros = p.id_proc_outros) AS ofendido
	FROM proc_outros p
	LEFT JOIN RHPARANA.opmPMPR AS rhopm ON rhopm.CODIGOBASE = p.cdopm
	WHERE  cdopm  LIKE '$opm_login->codigoBase%' OR  cdopm_apuracao LIKE '$opm_login->codigoBase%'
	AND  sjd_ref_ano  LIKE '%$proc_outros->sjd_ref_ano%'  ORDER BY id_proc_outros DESC";
}
else
{
	$sql="SELECT p.*, rhopm.ABREVIATURA,
    (SELECT GROUP_CONCAT(e.nome SEPARATOR ', ') FROM envolvido e WHERE e.id_proc_outros = p.id_proc_outros) AS envolvido,
    (SELECT GROUP_CONCAT(o.nome SEPARATOR ', ') FROM ofendido o WHERE o.id_proc_outros = p.id_proc_outros) AS ofendido
	FROM proc_outros p
	LEFT JOIN RHPARANA.opmPMPR AS rhopm ON rhopm.CODIGOBASE = p.cdopm
	AND  sjd_ref_ano  LIKE '%$proc_outros->sjd_ref_ano%'  ORDER BY id_proc_outros DESC";
}

if ($_SESSION[debug]) pre($sql);
$sql=lista::paginas();
$res=mysql_query($sql);

openTable("width='100%' class='bordasimples'");
	openLine(6);
		h1("ANDAMENTO DOS proc_outros (".$opm_login->abreviatura.")");
	closeLine();
	
	openTR();
		lista::td("N&ordm; COGER","sjd_ref");
		lista::td("OPM","cdopm");
		lista::td("Data Fato","data");
		lista::td("Data recebimento","abertura_data");
		lista::td("Digitador");
		lista::td("Envolvidos");
		lista::td("Ofendidos");
	closeTR();
	
	$i=0; //contador
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="white"):($cor="#F0F0F0");
		openTR("bgcolor='$cor'");
			echo "<td>".lista::link("atualizar")."$row[sjd_ref]/$row[sjd_ref_ano]</td>";
			echo "<td>$row[ABREVIATURA]</td>";
			echo "<td>".udf($row['data'],"data")."</td>";
			echo "<td>".udf($row['abertura_data'],"abertura_data")."</td>";
			echo "<td>$row[digitador]</td>";
			echo "<td>$row[envolvido]</td>";
			echo "<td>$row[ofendido]</td>";
		closeTR();
	$i++;
	}
lista::rodape($sql,$lpp);
closeTable();



?>
