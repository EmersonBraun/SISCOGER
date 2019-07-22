<?php

$opcao=$_REQUEST['opcao'];

if ($opcao=="geral") { include("geral.php"); die; }
elseif ($opcao=="prioritarios") { include("prioritarios.php"); die; }


if ($opm_login->codigoBase==="") $opm_login->codigoBase="0";
//var_dump($opm_login->codigoBase);exit;
h2("PEND&Ecirc;NCIAS - ".$opm_login->abreviatura); echo "<br>\r\n";

//PENDENCIA #0: TRANSFERÊNCIAS
include ("../var/www/conecta.php");
mssql_select_db("passowrds", $con[3]);

//sql dos grupos
$sqlG="SELECT * FROM PPGrupos WHERE administrador!=''";
$resG=mssql_query($sqlG, $con[3]);
if ($_SESSION["debug"]) pre($sqlG);
//pre($sqlG);
$transferencias = 0;
h1("Transfer&ecirc;ncias");
openTable("class='bordasimples' width='100%'");

while ($rowG=mssql_fetch_array($resG)) {

	($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");

    $sqlE="SELECT * FROM movimentos WHERE data >= DATEADD ( DAY ,-7, getdate() ) AND rg IN (
            SELECT PPusuarios.UserRG FROM PPUsuarios INNER JOIN
            PPUsuarioGrupo ON
                PPUsuarioGrupo.UserID=PPUsuarios.UserID
                AND PPUsuarioGrupo.GrupoID=".$rowG['GrupoID'].") ";
	if ($_SESSION["debug"]) pre($sqlE);
	/*$sqlE="SELECT * FROM movimentos WHERE data >= DATEADD ( DAY ,-7, getdate() )";*/

    $res=mssql_query($sqlE, $con[3]);

    //Se pelo menos um usuario trocou de OPM

	if (mssql_num_rows($res) > 0) 
	{
		

    	while ($row=mssql_fetch_array($res)) 
    	{
		    		
	    $sqlA="SELECT * FROM opmPMPR WHERE codigo='$row[opmorigem]'";
        $rowA=mssql_fetch_array(mssql_query($sqlA));
        //pre($sqlA);
        if ($_SESSION["debug"]) pre($sqlA);
        $sqlB="SELECT * FROM opmPMPR WHERE codigo='$row[opmdestino]'";
        $rowB=mssql_fetch_array(mssql_query($sqlB));
        if ($_SESSION["debug"]) pre($sqlB);
        //pre($sqlB);
        $cod = substr($opm_login->codigoBase, 0, 3);//para deixar código opm com 3 dígitos
        $cod1 = substr($rowA[opmorigem], 0, 3);//para deixar código opm com 3 dígitos
        $cod2 = substr($rowB[opmdestino], 0, 3);//para deixar código opm com 3 dígitos

	       	if ($cod1 == $cod || $cod2 == $cod) 
	        {

	        openTR("bgcolor='$cor'");
	            echo "<td><a id='foco' href='?module=tramitacao&policial[rg]=".$row[rg]."'>$row[rg]</a> : $row[nome], de $rowA[ABREVIATURA] para $rowB[ABREVIATURA].</td>";
			closeTR();

			$i++;
			$transferencias++;
	       }
	      
        }
    }
     /*else {

    	openTR("bgcolor='$cor'"); openTD();
        	echo "Nenhum usuario trocou de opm para o sistema $rowG[Descricao]<br>\r\n";
        closeTD(); closeTR();

    }*/

    //pre($sqlE);

}

if (!$transferencias) {
	openTR("bgcolor='$cor'"); openTD();
    	echo "Nenhuma transfer&ecirc;ncia<br>\r\n";
    closeTD(); closeTR();
}

closeTable();
echo "<br>\r\n";
$i=0;

//PENDENCIA #1: COMPORTAMENTO

$sql="SELECT pm.rg, pm.nome, pm.cargo, opm.ABREVIATURA, opm.CODIGOBASE, posto.id_posto
	FROM RHPARANA.POLICIAL pm
		LEFT JOIN RHPARANA.opmPMPR opm ON opm.META4 = pm.opm_meta4
		LEFT JOIN RHPARANA.posto ON posto.posto=pm.cargo
		WHERE CODIGOBASE LIKE '".$opm_login->codigoBase."%' AND id_posto>6 AND pm.rg NOT IN (SELECT DISTINCT rg FROM comportamentopm) ORDER BY id_posto";


//pre($sql);
$res=mysql_query($sql);

h1("Comportamento");
openTable("class='bordasimples' width='100%'");

if (mysql_num_rows($res)>0) {
	//mostra as pendencias de comportamento
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");

		openTR("bgcolor='$cor'"); openTD();
			echo "<a href='?module=tramitacao&policial[rg]=$row[rg]'>O policial $row[cargo] $row[nome] n&atilde;o tem comportamento cadastrado</a>.";
		closeTD(); closeTR();

		$i++;

		$totalPendencias++;
	}
	openLine(); h2("Total Comportamento: $i"); closeLine();
	//guarda variavel para atualizar tabela geral
	$atualiza["comportamento"]=$i;


}
else echo "N&atilde;o h&aacute; pend&ecirc;ncias";




closeTable();
echo "<br>\r\n";
$i=0;


//PENDENCIA #2: CADASTRO DE PUNICAO NO FATD MARCADO COMO PUNIDO

	//tabela derivada
$sql="SELECT * FROM

(SELECT fatd.*, rhopm.ABREVIATURA, envolvido.rg, envolvido.nome, envolvido.cargo, envolvido.resultado, envolvido.id_punicao
	FROM fatd

		LEFT OUTER JOIN RHPARANA.opmPMPR AS rhopm ON
			rhopm.CODIGOBASE=fatd.cdopm
		INNER JOIN envolvido ON
			envolvido.id_fatd!=0 AND envolvido.id_fatd=fatd.id_fatd
		LEFT JOIN punicao ON punicao.id_punicao=envolvido.id_punicao
	WHERE
		id_andamento=2 AND envolvido.situacao='Acusado' AND envolvido.resultado='Punido' AND fatd.cdopm LIKE '".$opm_login->codigoBase."%') dt WHERE dt.id_punicao=0";
	//id_andamento 2: CONCLUIDO

$res=mysql_query($sql);
h1("FATD - PUNI&Ccedil;&Atilde;O");
openTable("class='bordasimples' width='100%'");
if (mysql_num_rows($res)>0) {
	//mostra as pendencias de comportamento
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");

		openTR("bgcolor='$cor'"); openTD();
			link::popup("?module=punicao&opcao=cadastrar&rg=$row[rg]&punicao[sjd_ref]=$row[sjd_ref]&punicao[sjd_ref_ano]=$row[sjd_ref_ano]&punicao[procedimento]=fatd&noheader");
			echo "O policial $row[cargo] $row[nome] foi punido no fatd $row[sjd_ref]/$row[sjd_ref_ano] mas sua puni&ccedil;&atilde;o n&atilde;o foi cadastrada.</a>";
		closeTD(); closeTR();

		$i++;

		$totalPendencias++;
	}
	openLine(); h2("Total FATD-Puni&ccedil;&otilde;es: $i"); closeLine();
}
else echo "N&atilde;o h&aacute; pend&ecirc;ncias";
closeTable();

//guarda variavel para atualizar tabela geral
$atualiza["fatd_punicao"]=$i;
$i=0;
echo "<br>";

//PENDENCIA #2.1: PRAZO DO FATD
$sql="SELECT * FROM
(
SELECT fatd.id_fatd, andamento, envolvido.cargo, envolvido.nome, cdopm, opm.ABREVIATURA, sjd_ref, sjd_ref_ano, abertura_data, DIASUTEIS(abertura_data,DATE(NOW()))+1 AS dutotal,
	b.dusobrestado,
	(DIASUTEIS(abertura_data,DATE(NOW()))+1-IFNULL(b.dusobrestado,0)) AS diasuteis FROM fatd
	LEFT JOIN
	(SELECT id_fatd, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado fROM sobrestamento
		WHERE termino_data !='0000-00-00' AND id_fatd!=''
		GROUP BY id_fatd) b

		ON b.id_fatd = fatd.id_fatd
	LEFT JOIN RHPARANA.opmPMPR opm ON
		opm.CODIGOBASE=fatd.cdopm
	LEFT JOIN envolvido ON
		envolvido.id_fatd=fatd.id_fatd AND envolvido.situacao='Encarregado' AND rg_substituto=''
	LEFT JOIN andamento ON
		andamento.id_andamento=fatd.id_andamento
	WHERE fatd.id_andamento=1 AND fatd.cdopm LIKE '".$opm_login->codigoBase."%'
) dt WHERE dt.diasuteis>30";
	if ($_SESSION["debug"]) pre($sql);
$res=mysql_query($sql);
h1("FATD - PRAZOS");
openTable("class='bordasimples' width='100%'");

if (mysql_num_rows($res)>0) {
	//mostra as pendencias
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");

		openTR("bgcolor='$cor'"); openTD();
			echo "<a href='?module=fatd&fatd[id]=$row[id_fatd]'>";
			echo "O FATD $row[sjd_ref]/$row[sjd_ref_ano] est&aacute; fora do prazo regulamentar.</a>";
		closeTD(); closeTR();

		$i++;

		$totalPendencias++;
	}
	openLine(); h2("Total FATD-PRAZOS: $i"); closeLine();
}
else echo "N&atilde;o h&aacute; pend&ecirc;ncias";
closeTable();

//guarda variavel para atualizar tabela geral
$atualiza["fatd_prazo"]=$i;
$i=0;
echo "<br>";

//PENDENCIA #2.2: FATD SEM DATA DE ABERTURA
	$sql="SELECT * FROM fatd WHERE abertura_data='0000-00-00' AND cdopm LIKE '".$opm_login->codigoBase."%'";

	if ($_SESSION["debug"]) pre($sql);
	$res=mysql_query($sql);

	h1("FATD - DATA DE ABERTURA");
	openTable("class='bordasimples' width='100%'");

	if (mysql_num_rows($res)>0) {
		//mostra as pendencias
		while ($row=mysql_fetch_assoc($res)) {
			($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");

			openTR("bgcolor='$cor'"); openTD();
				echo "<a href='?module=fatd&fatd[id]=$row[id_fatd]' class='pisca' style='color:red'>";
				echo "O FATD $row[sjd_ref]/$row[sjd_ref_ano] n&atilde;o tem data de abertura cadastrada.</a>";
			closeTD(); closeTR();

			$i++;

			$totalPendencias++;
		}
		openLine(); h2("Total FATD-DATA DE ABERTURA: $i"); closeLine();
	}
	else echo "N&atilde;o h&aacute; pend&ecirc;ncias";
	closeTable();

	//guarda variavel para atualizar tabela geral
	$atualiza["fatd_abertura"]=$i;
	$i=0;
	echo "<br>";

//PENDENCIA #3: PERDA DE PRAZO EM IPM

$sql="SELECT * FROM
(SELECT ipm.id_ipm, andamento, cdopm, opm.ABREVIATURA, sjd_ref, sjd_ref_ano, autuacao_data,
	(DATEDIFF(DATE(NOW()),autuacao_data)+1) AS diasuteis FROM ipm
	LEFT JOIN RHPARANA.opmPMPR opm ON
		opm.CODIGOBASE=ipm.cdopm
	LEFT JOIN andamento ON
		andamento.id_andamento=ipm.id_andamento
	 WHERE ipm.id_andamento=4 AND ipm.cdopm LIKE '".$opm_login->codigoBase."%' ORDER BY ipm.id_ipm DESC) dt WHERE dt.diasuteis>60";


//pre($sql);
$res=mysql_query($sql);

h1("IPM - PRAZOS");
openTable("class='bordasimples' width='100%'");

if (mysql_num_rows($res)>0) {
	//mostra as pendencias de comportamento
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");

		openTR("bgcolor='$cor'"); openTD();
			echo "<a href='?module=ipm&ipm[id]=$row[id_ipm]'>O IPM $row[sjd_ref]/$row[sjd_ref_ano] est&aacute; fora do prazo regulamentar</a>";
		closeTD(); closeTR();

		$i++;

		$totalPendencias++;
	}
	openLine(); h2("Total IPM-PRAZOS: $i"); closeLine();
}
else echo "N&atilde;o h&aacute; pend&ecirc;ncias";
closeTable();
//guarda variavel para atualizar tabela geral
$atualiza["ipm_prazo"]=$i;
echo "<br>";

//PENDENCIA #3.1: ipm SEM DATA DE ABERTURA
	$sql="SELECT * FROM ipm WHERE autuacao_data='0000-00-00' AND cdopm LIKE '".$opm_login->codigoBase."%'";

	if ($_SESSION["debug"]) pre($sql);
	$res=mysql_query($sql);

	h1("IPM - DATA DE INSTAURA&Ccedil;&Atilde;O");
	openTable("class='bordasimples' width='100%'");

	if (mysql_num_rows($res)>0) {
		//mostra as pendencias
		while ($row=mysql_fetch_assoc($res)) {
			($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");

			openTR("bgcolor='$cor'"); openTD();
				echo "<a href='?module=ipm&ipm[id]=$row[id_ipm]'>";
				echo "O IPM $row[sjd_ref]/$row[sjd_ref_ano] n&atilde;o tem data de instaura&ccedil;&atilde;o cadastrada.</a>";
			closeTD(); closeTR();

			$i++;

			$totalPendencias++;
		}
		openLine(); h2("Total IPM - INSTAURA&Ccedil;&Atilde;O: $i"); closeLine();
	}
	else echo "N&atilde;o h&aacute; pend&ecirc;ncias";
	closeTable();

	//guarda variavel para atualizar tabela geral
	$atualiza["ipm_abertura"]=$i;
	$i=0;
	echo "<br>";



//PENDENCIA #4: PRAZO DAS SINDICANCIAS
$sql="SELECT * FROM (
	SELECT sindicancia.id_sindicancia, andamento, envolvido.cargo, envolvido.nome, cdopm, opm.ABREVIATURA, sjd_ref, sjd_ref_ano, abertura_data, DIASUTEIS(abertura_data,DATE(NOW())) AS dutotal,
	b.dusobrestado,
	(DIASUTEIS(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis FROM sindicancia
	LEFT JOIN
	(SELECT id_sindicancia, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
		WHERE termino_data !='0000-00-00' AND id_sindicancia!=''
		GROUP BY id_sindicancia) b
		ON b.id_sindicancia = sindicancia.id_sindicancia
	LEFT JOIN RHPARANA.opmPMPR opm ON
		opm.CODIGOBASE=sindicancia.cdopm
	LEFT JOIN envolvido ON
		envolvido.id_sindicancia=sindicancia.id_sindicancia AND envolvido.situacao='Encarregado' AND rg_substituto=''
	LEFT JOIN andamento ON
		andamento.id_andamento=sindicancia.id_andamento
	WHERE sindicancia.id_andamento=6
) dt
	WHERE cdopm LIKE '".$opm_login->codigoBase."%' AND dt.diasuteis>30

";

//PENDENCIA #4.1: SINDICANCIA SEM DATA DE ABERTURA
	$sql="SELECT * FROM sindicancia WHERE abertura_data='0000-00-00' AND cdopm LIKE '".$opm_login->codigoBase."%'";

	if ($_SESSION["debug"]) pre($sql);
	$res=mysql_query($sql);

	h1("SINDICANCIA - DATA DE ABERTURA");
	openTable("class='bordasimples' width='100%'");

	if (mysql_num_rows($res)>0) {
		//mostra as pendencias
		while ($row=mysql_fetch_assoc($res)) {
			($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");

			openTR("bgcolor='$cor'"); openTD();
				echo "<a href='?module=sindicancia&sindicancia[id]=$row[id_sindicancia]'>";
				echo "A SINDICANCIA $row[sjd_ref]/$row[sjd_ref_ano] n&atilde;o tem data de abertura cadastrada.</a>";
			closeTD(); closeTR();

			$i++;

			$totalPendencias++;
		}
		openLine(); h2("Total SINDICANCIA - ABERTURA: $i"); closeLine();
	}
	else echo "N&atilde;o h&aacute; pend&ecirc;ncias";
	closeTable();

	//guarda variavel para atualizar tabela geral
	$atualiza["sindicancia_abertura"]=$i;
	$i=0;
	echo "<br>";


//pre($sql);

$res=mysql_query($sql);

$i=0;
h1("SINDICANCIA - PRAZOS");
openTable("class='bordasimples' width='100%'");
$sql="SELECT * FROM (

SELECT sindicancia.id_sindicancia, andamento, envolvido.cargo, envolvido.nome, cdopm, opm.ABREVIATURA, sjd_ref, sjd_ref_ano, abertura_data, DIASUTEIS(abertura_data,DATE(NOW())) AS dutotal,
	b.dusobrestado,
	(DIASUTEIS(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis FROM sindicancia
	LEFT JOIN
	(SELECT id_sindicancia, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado fROM sobrestamento
		WHERE termino_data !='0000-00-00' AND id_sindicancia!=''
		GROUP BY id_sindicancia) b

		ON b.id_sindicancia = sindicancia.id_sindicancia
	LEFT JOIN RHPARANA.opmPMPR opm ON
		opm.CODIGOBASE=sindicancia.cdopm
	LEFT JOIN envolvido ON
		envolvido.id_sindicancia=sindicancia.id_sindicancia AND envolvido.situacao='Encarregado' AND rg_substituto=''
	LEFT JOIN andamento ON
		andamento.id_andamento=sindicancia.id_andamento
	WHERE sindicancia.id_andamento=6
) dt
	WHERE cdopm LIKE '".$opm_login->codigoBase."%' AND dt.diasuteis>30

";
if ($_SESSION["debug"]) pre($sql);
	$res=mysql_query($sql);
	
if (mysql_num_rows($res)>0) {
	//mostra as pendencias de comportamento
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");

		openTR("bgcolor='$cor'"); openTD();
			echo "<a href='?module=sindicancia&sindicancia[id]=$row[id_sindicancia]'>A SINDICANCIA $row[sjd_ref]/$row[sjd_ref_ano] est&aacute; fora do prazo regulamentar</a>";
		closeTD();
	closeTR();
	$i++;

	$totalPendencias++;
	}
	openLine(); h2("Total SINDICANCIA-PRAZOS: $i"); closeLine();
}
else echo "N&atilde;o h&aacute; pend&ecirc;ncias";

closeTable();
//guarda para atualizar
$atualiza["sindicancia_prazo"]=$i;
echo "<br>";


//PENDENCIA #5: CONSELHOS DE DISCIPLINA SEM DATA DE ABERTURA
	$sql="SELECT * FROM cd WHERE abertura_data='0000-00-00' AND cdopm LIKE '".$opm_login->codigoBase."%'";

	if ($_SESSION["debug"]) pre($sql);
	$res=mysql_query($sql);

	h1("CONSELHOS DE DISCIPLINA - DATA DE ABERTURA");
	openTable("class='bordasimples' width='100%'");

	if (mysql_num_rows($res)>0) {
		while ($row=mysql_fetch_assoc($res)) {
			($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");

			openTR("bgcolor='$cor'"); openTD();
				echo "<a href='?module=cd&cd[id]=$row[id_cd]'>";
				echo "O CONSELHO DE DISCIPLINA $row[sjd_ref]/$row[sjd_ref_ano] n&atilde;o tem data de abertura cadastrada.</a>";
			closeTD(); closeTR();
			$i++;
			$totalPendencias++;
		}
		openLine(); h2("Total CONSELHO DE DISCIPLINA - ABERTURA: $i"); closeLine();
	}
	else echo "N&atilde;o h&aacute; pend&ecirc;ncias";
	closeTable();

	//guarda variavel para atualizar tabela geral
	//$atualiza["sindicancia_abertura"]=$i;
	$i=0;
	echo "<br>";
//#5 -FIM

//PENDENCIA #5.1: CONSELHOS DE DISCIPLINA - PRAZO
$sql="SELECT * FROM (

SELECT cd.id_cd, andamento, andamentocoger, envolvido.cargo, envolvido.nome, cdopm, opm.ABREVIATURA, sjd_ref, sjd_ref_ano, abertura_data, DIASUTEIS(abertura_data,DATE(NOW())) AS dutotal,
	b.dusobrestado,
	(DIASUTEIS(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis FROM cd
	LEFT JOIN
	(SELECT id_cd, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado fROM sobrestamento
		WHERE termino_data !='0000-00-00' AND id_cd!=''
		GROUP BY id_cd) b
		ON b.id_cd = cd.id_cd
		LEFT JOIN RHPARANA.opmPMPR opm ON
			opm.CODIGOBASE=cd.cdopm
		LEFT JOIN envolvido ON
			envolvido.id_cd=cd.id_cd AND envolvido.situacao='Presidente' AND rg_substituto=''
		LEFT JOIN andamento ON
			andamento.id_andamento=cd.id_andamento
		LEFT JOIN andamentocoger ON
			andamentocoger.id_andamentocoger=cd.id_andamentocoger WHERE cd.id_andamento=9) dt
		WHERE dt.cdopm LIKE '".$opm_login->codigoBase."%' AND dt.diasuteis>60
";
//if ($_SESSION["debug"])
// pre($sql);
	$res=mysql_query($sql);
	h1("CONSELHOS DE DISCIPLINA - PRAZO");
	openTable("class='bordasimples' width='100%'");
	if (mysql_num_rows($res)>0) {
		while ($row=mysql_fetch_assoc($res)) {
			($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");
			openTR("bgcolor='$cor'"); openTD();
				echo "<a href='?module=cd&cd[id]=$row[id_cd]'>";
				echo "O CONSELHO DE DISCIPLINA $row[sjd_ref]/$row[sjd_ref_ano] extrapolou o prazo ($row[diasuteis] dias).</a>";
			closeTD(); closeTR();
			$i++;
			$totalPendencias++;
		}
		openLine(); h2("Total CONSELHO DE DISCIPLINA - PRAZO: $i"); closeLine();
	}
	else echo "N&atilde;o h&aacute; pend&ecirc;ncias";
	closeTable();

	//guarda variavel para atualizar tabela geral
	//$atualiza["sindicancia_abertura"]=$i;
	$i=0;
	echo "<br>";
//#5.1 - FIM




h3("Pendencias. Total Geral: $totalPendencias");


//Atualiza na tabela de conferencia da COGER
//pre($atualiza);

	//monta a SQL

	//monta a string dos campos a atualizar
	foreach ($atualiza as $chave=>$var) {
		$updStr[]=" $chave='$var' ";
	}
	$variaveis=implode(",",$updStr);

	$sql="UPDATE pendencias SET $variaveis WHERE cdopm='".$opm_login->codigoBase."'";

	//pre($sql);
	mysql_select_db("sjd");
	$res=mysql_query($sql);

	$num=mysql_affected_rows($con[8]); //conta pra ver se atualizou algo, se nao atualizou, eh pq a chave cdopm da unidade ainda nao existe, tem q inserir

	if ($num==0) {
		//MONTA A SQL DE INSERT

		foreach ($atualiza as $chave=>$var) { $insStr[]="$chave"; $insVal[]="'$var'"; }
		$insStr[]="cdopm";
		$insVal[]="'".$opm_login->codigoBase."'";

		$campos=implode(",",$insStr);
		$valores=implode(",",$insVal);

		$sql="INSERT INTO pendencias ($campos) VALUES ($valores)";
		//pre($sql);
	}
mysql_query($sql);
/*
-------------------------------------------------------------------
-------------------------------------------------------------------
-------------------------------------------------------------------
-------------------------------------------------------------------
inserção para quem for COGER conseguir ver pendências do CG
-------------------------------------------------------------------
-------------------------------------------------------------------
-------------------------------------------------------------------
-------------------------------------------------------------------
-------------------------------------------------------------------
*/
echo "<br><hr><br>";
if ($opm_login->codigoBase == "020") {

$cg = "0";

h2("PEND&Ecirc;NCIAS - CG"); echo "<br>\r\n";

//PENDENCIA #1: COMPORTAMENTO

$sql="SELECT pm.rg, pm.nome, pm.cargo, opm.ABREVIATURA, opm.CODIGOBASE, posto.id_posto
	FROM RHPARANA.POLICIAL pm
		LEFT JOIN RHPARANA.opmPMPR opm ON opm.META4 = pm.opm_meta4
		LEFT JOIN RHPARANA.posto ON posto.posto=pm.cargo
		WHERE CODIGOBASE LIKE '".$cg."%' AND id_posto>6 AND pm.rg NOT IN (SELECT DISTINCT rg FROM comportamentopm) ORDER BY id_posto";


//pre($sql);
$res=mysql_query($sql);

h1("Comportamento");
openTable("class='bordasimples' width='100%'");

if (mysql_num_rows($res)>0) {
	//mostra as pendencias de comportamento
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");

		openTR("bgcolor='$cor'"); openTD();
			echo "<a href='?module=tramitacao&policial[rg]=$row[rg]'>O policial $row[cargo] $row[nome] n&atilde;o tem comportamento cadastrado</a>.";
		closeTD(); closeTR();

		$i++;

		$totalPendencias++;
	}
	openLine(); h2("Total Comportamento: $i"); closeLine();
	//guarda variavel para atualizar tabela geral
	$atualiza["comportamento"]=$i;


}
else echo "N&atilde;o h&aacute; pend&ecirc;ncias";




closeTable();
echo "<br>\r\n";
$i=0;

//PENDENCIA #2: CADASTRO DE PUNICAO NO FATD MARCADO COMO PUNIDO

	//tabela derivada
$sql="SELECT * FROM

(SELECT fatd.*, rhopm.ABREVIATURA, envolvido.rg, envolvido.nome, envolvido.cargo, envolvido.resultado, envolvido.id_punicao
	FROM fatd

		LEFT OUTER JOIN RHPARANA.opmPMPR AS rhopm ON
			rhopm.CODIGOBASE=fatd.cdopm
		INNER JOIN envolvido ON
			envolvido.id_fatd!=0 AND envolvido.id_fatd=fatd.id_fatd
		LEFT JOIN punicao ON punicao.id_punicao=envolvido.id_punicao
	WHERE
		id_andamento=2 AND envolvido.situacao='Acusado' AND envolvido.resultado='Punido' AND fatd.cdopm LIKE '".$cg."%') dt WHERE dt.id_punicao=0";
	//id_andamento 2: CONCLUIDO

$res=mysql_query($sql);
h1("FATD - PUNI&Ccedil;&Atilde;O");
openTable("class='bordasimples' width='100%'");
if (mysql_num_rows($res)>0) {
	//mostra as pendencias de comportamento
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");

		openTR("bgcolor='$cor'"); openTD();
			link::popup("?module=punicao&opcao=cadastrar&rg=$row[rg]&punicao[sjd_ref]=$row[sjd_ref]&punicao[sjd_ref_ano]=$row[sjd_ref_ano]&punicao[procedimento]=fatd&noheader");
			echo "O policial $row[cargo] $row[nome] foi punido no fatd $row[sjd_ref]/$row[sjd_ref_ano] mas sua puni&ccedil;&atilde;o n&atilde;o foi cadastrada.</a>";
		closeTD(); closeTR();

		$i++;

		$totalPendencias++;
	}
	openLine(); h2("Total FATD-Puni&ccedil;&otilde;es: $i"); closeLine();
}
else echo "N&atilde;o h&aacute; pend&ecirc;ncias";
closeTable();

//guarda variavel para atualizar tabela geral
$atualiza["fatd_punicao"]=$i;
$i=0;
echo "<br>";

//PENDENCIA #2.1: PRAZO DO FATD
$sql="
SELECT * FROM
(
SELECT fatd.id_fatd, andamento, envolvido.cargo, envolvido.nome, cdopm, opm.ABREVIATURA, sjd_ref, sjd_ref_ano, abertura_data, DIASUTEIS(abertura_data,DATE(NOW()))+1 AS dutotal,
	b.dusobrestado,
	(DIASUTEIS(abertura_data,DATE(NOW()))+1-IFNULL(b.dusobrestado,0)) AS diasuteis FROM fatd
	LEFT JOIN
	(SELECT id_fatd, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado fROM sobrestamento
		WHERE termino_data !='0000-00-00' AND id_fatd!=''
		GROUP BY id_fatd) b

		ON b.id_fatd = fatd.id_fatd
	LEFT JOIN RHPARANA.opmPMPR opm ON
		opm.CODIGOBASE=fatd.cdopm
	LEFT JOIN envolvido ON
		envolvido.id_fatd=fatd.id_fatd AND envolvido.situacao='Encarregado' AND rg_substituto=''
	LEFT JOIN andamento ON
		andamento.id_andamento=fatd.id_andamento
	WHERE fatd.id_andamento=1 AND fatd.cdopm LIKE '".$cg."%'
) dt WHERE dt.diasuteis>30";
	if ($_SESSION["debug"]) pre($sql);
$res=mysql_query($sql);
h1("FATD - PRAZOS");
openTable("class='bordasimples' width='100%'");

if (mysql_num_rows($res)>0) {
	//mostra as pendencias
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");

		openTR("bgcolor='$cor'"); openTD();
			echo "<a href='?module=fatd&fatd[id]=$row[id_fatd]'>";
			echo "O FATD $row[sjd_ref]/$row[sjd_ref_ano] est&aacute; fora do prazo regulamentar.</a>";
		closeTD(); closeTR();

		$i++;

		$totalPendencias++;
	}
	openLine(); h2("Total FATD-PRAZOS: $i"); closeLine();
}
else echo "N&atilde;o h&aacute; pend&ecirc;ncias";
closeTable();

//guarda variavel para atualizar tabela geral
$atualiza["fatd_prazo"]=$i;
$i=0;
echo "<br>";

//PENDENCIA #2.2: FATD SEM DATA DE ABERTURA
	$sql="SELECT * FROM fatd WHERE abertura_data='0000-00-00' AND cdopm LIKE '".$cg."%'";

	if ($_SESSION["debug"]) pre($sql);
	$res=mysql_query($sql);

	h1("FATD - DATA DE ABERTURA");
	openTable("class='bordasimples' width='100%'");

	if (mysql_num_rows($res)>0) {
		//mostra as pendencias
		while ($row=mysql_fetch_assoc($res)) {
			($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");

			openTR("bgcolor='$cor'"); openTD();
				echo "<a href='?module=fatd&fatd[id]=$row[id_fatd]' class='pisca' style='color:red'>";
				echo "O FATD $row[sjd_ref]/$row[sjd_ref_ano] n&atilde;o tem data de abertura cadastrada.</a>";
			closeTD(); closeTR();

			$i++;

			$totalPendencias++;
		}
		openLine(); h2("Total FATD-DATA DE ABERTURA: $i"); closeLine();
	}
	else echo "N&atilde;o h&aacute; pend&ecirc;ncias";
	closeTable();

	//guarda variavel para atualizar tabela geral
	$atualiza["fatd_abertura"]=$i;
	$i=0;
	echo "<br>";

//PENDENCIA #3: PERDA DE PRAZO EM IPM

$sql="
SELECT * FROM
(SELECT ipm.id_ipm, andamento, cdopm, opm.ABREVIATURA, sjd_ref, sjd_ref_ano, autuacao_data,
	(DATEDIFF(DATE(NOW()),autuacao_data)+1) AS diasuteis FROM ipm
	LEFT JOIN RHPARANA.opmPMPR opm ON
		opm.CODIGOBASE=ipm.cdopm
	LEFT JOIN andamento ON
		andamento.id_andamento=ipm.id_andamento
	 WHERE ipm.id_andamento=4 AND ipm.cdopm LIKE '".$cg."%' ORDER BY ipm.id_ipm DESC) dt WHERE dt.diasuteis>60";


//pre($sql);
$res=mysql_query($sql);

h1("IPM - PRAZOS");
openTable("class='bordasimples' width='100%'");

if (mysql_num_rows($res)>0) {
	//mostra as pendencias de comportamento
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");

		openTR("bgcolor='$cor'"); openTD();
			echo "<a href='?module=ipm&ipm[id]=$row[id_ipm]'>O IPM $row[sjd_ref]/$row[sjd_ref_ano] est&aacute; fora do prazo regulamentar</a>";
		closeTD(); closeTR();

		$i++;

		$totalPendencias++;
	}
	openLine(); h2("Total IPM-PRAZOS: $i"); closeLine();
}
else echo "N&atilde;o h&aacute; pend&ecirc;ncias";
closeTable();
//guarda variavel para atualizar tabela geral
$atualiza["ipm_prazo"]=$i;
echo "<br>";

//PENDENCIA #3.1: ipm SEM DATA DE ABERTURA
	$sql="SELECT * FROM ipm WHERE autuacao_data='0000-00-00' AND cdopm LIKE '".$cg."%'";

	if ($_SESSION["debug"]) pre($sql);
	$res=mysql_query($sql);

	h1("IPM - DATA DE INSTAURA&Ccedil;&Atilde;O");
	openTable("class='bordasimples' width='100%'");

	if (mysql_num_rows($res)>0) {
		//mostra as pendencias
		while ($row=mysql_fetch_assoc($res)) {
			($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");

			openTR("bgcolor='$cor'"); openTD();
				echo "<a href='?module=ipm&ipm[id]=$row[id_ipm]'>";
				echo "O IPM $row[sjd_ref]/$row[sjd_ref_ano] n&atilde;o tem data de instaura&ccedil;&atilde;o cadastrada.</a>";
			closeTD(); closeTR();

			$i++;

			$totalPendencias++;
		}
		openLine(); h2("Total IPM - INSTAURA&Ccedil;&Atilde;O: $i"); closeLine();
	}
	else echo "N&atilde;o h&aacute; pend&ecirc;ncias";
	closeTable();

	//guarda variavel para atualizar tabela geral
	$atualiza["ipm_abertura"]=$i;
	$i=0;
	echo "<br>";



//PENDENCIA #4: PRAZO DAS SINDICANCIAS

//PENDENCIA #4.1: SINDICANCIA SEM DATA DE ABERTURA
	$sql="SELECT * FROM sindicancia WHERE abertura_data='0000-00-00' AND cdopm LIKE '".$cg."%'";

	if ($_SESSION["debug"]) pre($sql);
	$res=mysql_query($sql);

	h1("SINDICANCIA - DATA DE ABERTURA");
	openTable("class='bordasimples' width='100%'");

	if (mysql_num_rows($res)>0) {
		//mostra as pendencias
		while ($row=mysql_fetch_assoc($res)) {
			($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");

			openTR("bgcolor='$cor'"); openTD();
				echo "<a href='?module=sindicancia&sindicancia[id]=$row[id_sindicancia]'>";
				echo "A SINDICANCIA $row[sjd_ref]/$row[sjd_ref_ano] n&atilde;o tem data de abertura cadastrada.</a>";
			closeTD(); closeTR();

			$i++;

			$totalPendencias++;
		}
		openLine(); h2("Total SINDICANCIA - ABERTURA: $i"); closeLine();
	}
	else echo "N&atilde;o h&aacute; pend&ecirc;ncias";
	closeTable();

	//guarda variavel para atualizar tabela geral
	$atualiza["sindicancia_abertura"]=$i;
	$i=0;
	echo "<br>";


//pre($sql);

$res=mysql_query($sql);

$i=0;
h1("SINDICANCIA - PRAZOS");
openTable("class='bordasimples' width='100%'");

$sql="SELECT * FROM (

SELECT sindicancia.id_sindicancia, andamento, envolvido.cargo, envolvido.nome, cdopm, opm.ABREVIATURA, sjd_ref, sjd_ref_ano, abertura_data, DIASUTEIS(abertura_data,DATE(NOW())) AS dutotal,
	b.dusobrestado,
	(DIASUTEIS(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis FROM sindicancia
	LEFT JOIN
	(SELECT id_sindicancia, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado fROM sobrestamento
		WHERE termino_data !='0000-00-00' AND id_sindicancia!=''
		GROUP BY id_sindicancia) b

		ON b.id_sindicancia = sindicancia.id_sindicancia
	LEFT JOIN RHPARANA.opmPMPR opm ON
		opm.CODIGOBASE=sindicancia.cdopm
	LEFT JOIN envolvido ON
		envolvido.id_sindicancia=sindicancia.id_sindicancia AND envolvido.situacao='Encarregado' AND rg_substituto=''
	LEFT JOIN andamento ON
		andamento.id_andamento=sindicancia.id_andamento
	WHERE sindicancia.id_andamento=6
) dt
	WHERE cdopm LIKE '".$cg."%' AND dt.diasuteis>30

";
if ($_SESSION["debug"]) pre($sql);
	$res=mysql_query($sql);

if (mysql_num_rows($res)>0) {
	//mostra as pendencias de comportamento
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");

		openTR("bgcolor='$cor'"); openTD();
			echo "<a href='?module=sindicancia&sindicancia[id]=$row[id_sindicancia]'>A SINDICANCIA $row[sjd_ref]/$row[sjd_ref_ano] est&aacute; fora do prazo regulamentar</a>";
		closeTD();
	closeTR();
	$i++;

	$totalPendencias++;
	}
	openLine(); h2("Total SINDICANCIA-PRAZOS: $i"); closeLine();
}
else echo "N&atilde;o h&aacute; pend&ecirc;ncias";

closeTable();
//guarda para atualizar
$atualiza["sindicancia_prazo"]=$i;
echo "<br>";


//PENDENCIA #5: CONSELHOS DE DISCIPLINA SEM DATA DE ABERTURA
	$sql="SELECT * FROM cd WHERE abertura_data='0000-00-00' AND cdopm LIKE '".$cg."%'";

	if ($_SESSION["debug"]) pre($sql);
	$res=mysql_query($sql);

	h1("CONSELHOS DE DISCIPLINA - DATA DE ABERTURA");
	openTable("class='bordasimples' width='100%'");

	if (mysql_num_rows($res)>0) {
		while ($row=mysql_fetch_assoc($res)) {
			($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");

			openTR("bgcolor='$cor'"); openTD();
				echo "<a href='?module=cd&cd[id]=$row[id_cd]'>";
				echo "O CONSELHO DE DISCIPLINA $row[sjd_ref]/$row[sjd_ref_ano] n&atilde;o tem data de abertura cadastrada.</a>";
			closeTD(); closeTR();
			$i++;
			$totalPendencias++;
		}
		openLine(); h2("Total CONSELHO DE DISCIPLINA - ABERTURA: $i"); closeLine();
	}
	else echo "N&atilde;o h&aacute; pend&ecirc;ncias";
	closeTable();

	//guarda variavel para atualizar tabela geral
	//$atualiza["sindicancia_abertura"]=$i;
	$i=0;
	echo "<br>";
//#5 -FIM

//PENDENCIA #5.1: CONSELHOS DE DISCIPLINA - PRAZO
$sql="
SELECT * FROM (

SELECT cd.id_cd, andamento, andamentocoger, envolvido.cargo, envolvido.nome, cdopm, opm.ABREVIATURA, sjd_ref, sjd_ref_ano, abertura_data, DIASUTEIS(abertura_data,DATE(NOW())) AS dutotal,
	b.dusobrestado,
	(DIASUTEIS(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis FROM cd
	LEFT JOIN
	(SELECT id_cd, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado fROM sobrestamento
		WHERE termino_data !='0000-00-00' AND id_cd!=''
		GROUP BY id_cd) b
		ON b.id_cd = cd.id_cd
		LEFT JOIN RHPARANA.opmPMPR opm ON
			opm.CODIGOBASE=cd.cdopm
		LEFT JOIN envolvido ON
			envolvido.id_cd=cd.id_cd AND envolvido.situacao='Presidente' AND rg_substituto=''
		LEFT JOIN andamento ON
			andamento.id_andamento=cd.id_andamento
		LEFT JOIN andamentocoger ON
			andamentocoger.id_andamentocoger=cd.id_andamentocoger WHERE cd.id_andamento=9) dt
		WHERE dt.cdopm LIKE '".$cg."%' AND dt.diasuteis>60
";
//if ($_SESSION["debug"])
// pre($sql);
	$res=mysql_query($sql);
	h1("CONSELHOS DE DISCIPLINA - PRAZO");
	openTable("class='bordasimples' width='100%'");
	if (mysql_num_rows($res)>0) {
		while ($row=mysql_fetch_assoc($res)) {
			($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");
			openTR("bgcolor='$cor'"); openTD();
				echo "<a href='?module=cd&cd[id]=$row[id_cd]'>";
				echo "O CONSELHO DE DISCIPLINA $row[sjd_ref]/$row[sjd_ref_ano] extrapolou o prazo ($row[diasuteis] dias).</a>";
			closeTD(); closeTR();
			$i++;
			$totalPendencias++;
		}
		openLine(); h2("Total CONSELHO DE DISCIPLINA - PRAZO: $i"); closeLine();
	}
	else echo "N&atilde;o h&aacute; pend&ecirc;ncias";
	closeTable();

	//guarda variavel para atualizar tabela geral
	//$atualiza["sindicancia_abertura"]=$i;
	$i=0;
	echo "<br>";
//#5.1 - FIM




h3("Pendencias. Total Geral: $totalPendencias");


//Atualiza na tabela de conferencia da COGER
//pre($atualiza);

	//monta a SQL

	//monta a string dos campos a atualizar
	foreach ($atualiza as $chave=>$var) {
		$updStr[]=" $chave='$var' ";
	}
	$variaveis=implode(",",$updStr);

	$sql="UPDATE pendencias SET $variaveis WHERE cdopm='".$cg."'";

	//pre($sql);
	mysql_select_db("sjd");
	$res=mysql_query($sql);

	$num=mysql_affected_rows($con[8]); //conta pra ver se atualizou algo, se nao atualizou, eh pq a chave cdopm da unidade ainda nao existe, tem q inserir

	if ($num==0) {
		//MONTA A SQL DE INSERT

		foreach ($atualiza as $chave=>$var) { $insStr[]="$chave"; $insVal[]="'$var'"; }
		$insStr[]="cdopm";
		$insVal[]="'".$cg."'";

		$campos=implode(",",$insStr);
		$valores=implode(",",$insVal);

		$sql="INSERT INTO pendencias ($campos) VALUES ($valores)";
		//pre($sql);
	}
mysql_query($sql);
}
?>
