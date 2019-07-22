<?php

$ofendido=new ofendido();
$ofendido->setValues($_REQUEST['ofendido']);

if (!$ofendido->sjd_ref_ano_ini) $ofendido->sjd_ref_ano_ini=date("Y");
if (!$ofendido->sjd_ref_ano_fim) $ofendido->sjd_ref_ano_fim=date("Y");

//O relatorio ira mostrar os ofendidos, primeiro por resultado, depois por sexo.
$grupos=Array("resultado","sexo","escolaridade");

$groupby=$_REQUEST['groupby'];

//if ($acao and !$groupby) { 
//	echo "<h3>Preencha a op&ccedil;&atilde;o de contagem</h3>";
//}

//ofendido
echo "<h1>Relat&oacute;rio de Ofendidos</h1>";

openTable("width='100%' class='bordasimples'");
	
	echo "<form id='ofendidos' action='".$_SERVER['REQUEST_URI']."' method='POST'>";
	echo "<input type='hidden' name='order' value='grupo ASC'>";

	form::openTR();
		form::openTD();
			form::openLabel("Procedimento");
				include ("includes/filtro_proc.php");
			form::closeLabel();
		form::closeTD();
		openTD();
			form::openLabel("Ano de refer&ecirc;ncia");
				echo "De <select name='ofendido[sjd_ref_ano_ini]'>";
					for ($i=2008; $i<=date("Y");$i++) {
						echo "<option>$i</option>";
					}
				echo "</select>";
				echo "At&eacute; <select name='ofendido[sjd_ref_ano_fim]'>";
					for ($i=2008; $i<=date("Y");$i++) {
						echo "<option>$i</option>";
					}
				echo "</select>";
			form::closeLabel();
		closeTD();
		
		openTD();
			form::openLabel("OPM");
				echo "<select name='ofendido[cdopm_st]'>";
					include ("includes/option_opm.php");
				echo "</select>";
			form::closeLabel();
		closeTD();
	form::closeTR();

closeTable();

formulario::values($ofendido,"ofendido");

echo "<input type='submit' name='acao' value='Gerar'>";
echo "</form><br><br>";

if ($acao=="gerar") {

	if ($_SESSION['debug']) pre($ofendido);
	//pre($_REQUEST); die;
	
	$proc=$_REQUEST['filtro']['procedimento'];
	
	//Essa condicao vale para todos os grupos
	$sqlWhere[]=" ofendido.id_$proc!='0' ";
	unset($ofendido->procedimento); //Apaga pois Nao utiliza como ofendido normal

	foreach ($grupos as $groupby) {
		$sql="SELECT COUNT(situacao) AS quantidade, $groupby as grupo FROM ofendido
			INNER JOIN $proc ON $proc.id_$proc=ofendido.id_$proc\r\n";
		include ("includes/filtro.php");
		$queries[]=$sql;
		if ($_SESSION['debug']) pre($sql);
	}

	//pre($queries);

	$t=0;
	foreach ($queries as $sql) {
		$i=0;
		//Uma tabela para cada query, cada query, um grupo.
		$res=mysql_query($sql);
		openTable("width='100%' class='bordasimples'");
				openTR(); openTD("colspan='2'");
						echo "<h2>Relatorio de ofendidos agrupado por ".$grupos[$t]."</h2>";
				closeTD(); closeTR();
			while ($row=mysql_fetch_assoc($res)) {
				($i%2)?($cor="white"):($cor="#F0F0F0");
				openTR("bgcolor='$cor'");
				if (!$row['grupo']) echo "<td>N&atilde;o cadastrado</td>";
				else echo "<td>$row[grupo]</td>";
				echo "<td><a href='?module=ofendido&opcao=listar&ofendido[".$grupos[$t]."_eq]=$row[grupo]&ofendido[sjd_ref_ano_ini]=".$ofendido->sjd_ref_ano_ini."&ofendido[sjd_ref_ano_fim]=".$ofendido->sjd_ref_ano_fim."&proc=$proc&ofendido[cdopm_st]=".$ofendido->cdopm_st."'>$row[quantidade]</a></td>";
				closeTR();
				$i=$i+$row['quantidade'];
		
		}
		closeTable();
		h1("Total: $i");
		echo "<br>";
	$t++;
	}


	/*
	$i=0;
	openTable("class='bordasimples' width='100%'");
		openLine();
		h2("Relatorio de ofendidos agrupado por Escolaridade");
		closeLine();
	closeTable();
	h1("Total: $i");
	echo "<br>";
	*/
}



?>
