<?php

$mostrar=$_REQUEST['proc'];
if (!$mostrar) $mostrar=Array("ipm","sindicancia","fatd","it","iso","apfd","cj","cd","adl");

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
		form::openLabel("POSTO");
			//O filtro e desse jeito porque na tabela POLICIAL e gravado o cargo, e nao o codigo
			formulario::option("filtro","posto","SELECT TRIM(posto) AS id_posto, posto FROM RHPARANA.posto","",0,0);
		form::closeLabel();
	form::closeTD();
	form::openTD();
		form::openLabel("Per&iacute;odo de refer&ecirc;ncia");
			if (!$envolvido->sjd_ref_ano_ini) $envolvido->sjd_ref_ano_ini=date("Y");

			echo "De";
			echo "<select name='envolvido[sjd_ref_ano_ini]'>";
			echo "<option value=''>Todos</option>";
			for ($i=2008; $i<=date("Y"); $i++) {
				echo "<option value='$i'>$i</option>";
			}
			echo "</select>";

			if (!$envolvido->sjd_ref_ano_fim) $envolvido->sjd_ref_ano_fim=date("Y");
			echo "At&eacute;";
			echo "<select name='envolvido[sjd_ref_ano_fim]'>";
			echo "<option value=''>Todos</option>";
			for ($i=2008; $i<=date("Y"); $i++) {
				echo "<option value='$i'>$i</option>";
			}
			echo "</select>";
		form::closeLabel();
	form::closeTD();
	openTD();
		form::openLabel("Mostrar PMs sem procedimentos");
		echo "<input type='checkbox' name='filtro[mostrarsem_bl]'> Marque para mostrar";
		form::closeLabel();
	closeTD();
form::closeTR();

form::openTR("id='linhafiltro'");
	form::openTD("colspan='6'");
		form::openLabel("Procedimentos");
		echo checkbox("proc[]","ipm","IPM",$mostrar)." |";
		echo checkbox("proc[]","sindicancia","SIND",$mostrar)." |";
		echo checkbox("proc[]","fatd","FATD",$mostrar)." |";
		echo checkbox("proc[]","it","IT",$mostrar)." |";
		echo checkbox("proc[]","iso","ISO",$mostrar)." |";
		echo checkbox("proc[]","apfd","APFD",$mostrar)." |";
		echo checkbox("proc[]","cj","CJ",$mostrar)." |";
		echo checkbox("proc[]","cd","CD",$mostrar)." |";
		echo checkbox("proc[]","adl","ADL",$mostrar)." |";
		echo checkbox("proc[]","sai","SAI",$mostrar)." |";
		
		form::closeLabel();
	form::closeTD();
	closeTR();
closeTable();
echo "<input class='noprint' type='submit' name='acao' value='Gerar'>";

echo "</form>\r\n<br>\r\n";

formulario::values($filtro,"filtro");
formulario::values($envolvido,"envolvido");

//MONTA O RELATORIO
//SQL dos policiais com o posto selecionado da OPM do filtro

if ($acao) {

$sql="SELECT count(id_envolvido) AS qtd,
	pm.rg, pm.cargo, pm.cdopm, pm.nome, encarregado.procedimento, andamento.andamento, opmPMPR.ABREVIATURA, opmPMPR.CODIGO AS cdopm2
		FROM encarregado
	INNER JOIN RHPARANA.POLICIAL pm ON pm.rg = encarregado.rg
	LEFT JOIN andamento ON andamento.id_andamento = encarregado.id_andamento
	LEFT JOIN RHPARANA.opmPMPR ON opmPMPR.META4 = pm.opm_meta4
	";
	
	
//Filtra so os RGS selecionados, e o ano selecionado na visao encarregado
if ($filtro['id_posto']) $sqlWhere[]="pm.cargo = '".$filtro['id_posto']."'";
if ($filtro['cdopm_st']) $sqlWhere[]="opmPMPR.CODIGO LIKE '".$filtro['cdopm_st']."%'";	
if ($filtro['sjd_ref_ano']) $sqlWhere[]="sjd_ref_ano = '".$filtro['sjd_ref_ano']."'";	
$sqlWhere[]=" rg_substituto=''";

//COLOCAR ASPAS NO PROC - GAMBIARRA
foreach ($mostrar as $var) {
	$mostrarAspas[]="'".$var."'";
}

$sqlWhere[]=" encarregado.procedimento IN (".implode(",",$mostrarAspas).")";

$groupby="cargo, nome, procedimento, andamento";
$order="nome";
include ("includes/filtro.php");

if ($_SESSION['debug']) pre($sql);
$res=mysql_query($sql);

function contaFigura() {
	global $row, $x, $i;
	global $concluidos, $andamentos, $sobrestados, $nulls;
	global $opmAnt, $opmAtual;
	global $mostrar;
	
	//Joga a linha atual para um dos vetores
	if ($row['andamento']=="CONCLUÍDO") {
		$proc=$row['procedimento'];
		$concluidos[$proc]=$row['qtd'];
	}
	if ($row['andamento']=="ANDAMENTO") {
		$proc=$row['procedimento'];
		$andamentos[$proc]=$row['qtd'];
	}
	if ($row['andamento']=="SOBRESTADO") {
		$proc=$row['procedimento'];
		$sobrestados[$proc]=$row['qtd'];
	}
	if ($row['andamento']=="") {
		$proc=$row['procedimento'];
		$nulls[$proc]=$row['qtd'];
	}
}

function mostraProcedimentos() {
	global $row, $x, $i;
	global $nomeAnt, $nomeAtual, $rgAnt, $rgAtual;
	global $cargoAnt, $cargoAtual;
	global $concluidos, $andamentos, $sobrestados, $nulls;
	global $opmAnt, $opmAtual;
	global $mostrar;
	//Se x=1 so tem um nome na lista, portanto nao tem nome anterior
	
	//if ($x==1) { $nomeAnt=$nomeAtual; $cargoAnt=$cargoAtual; }
	//pre($cargoAnt);
	($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");
	openTR("bgcolor='$cor'");
		echo "<td><a href='?module=tramitacao&policial[rg]=$rgAnt'>$cargoAnt $nomeAnt</a></td>";
		echo "<td>$opmAnt</td>";
		//COLUNA DOS CONCLUIDOS
		openTD(); unset($chaves);
		if (is_array($concluidos)) { 
			$chaves=array_keys($concluidos);
			foreach ($chaves as $chave) {
				//echo $chave;
				echo "<img title='$chave' width='16px' src='img/".$chave."32.png'>x".$concluidos[$chave]."  ";
			}
		}
		closeTD();
		
		//COLUNA DOS PROC EM ANDAMENTO
		openTD(); unset($chaves);
		if (is_array($andamentos)) {
			$chaves=array_keys($andamentos);
			foreach ($chaves as $chave) {
				echo "<img title='$chave' width='16px' src='img/".$chave."32.png'>x".$andamentos[$chave]."  ";
			}
		}
		closeTD();
		
		//COLUNA DOS SOBRESTADOS
		openTD();
		if (is_array($sobrestados)) {
			$chaves=array_keys($sobrestados);
			foreach ($chaves as $chave) {
				echo "<img title='$chave' width='16px' src='img/".$chave."32.png'>x".$sobrestados[$chave]."  ";
			}
		} closeTD();
		
		//COLUNA DOS NULL
		openTD();
		if (is_array($nulls)) {
			$chaves=array_keys($nulls);
			foreach ($chaves as $chave) {
				echo "<img title='$chave' width='16px' src='img/".$chave."32.png'>x".$nulls[$chave]."  ";
			}
		}
		closeTD();
		
		//ZERA TUDO, para o proximo Encarregado
		unset($concluidos);
		unset($andamentos);
		unset($sobrestados);
		unset($nulls);
		
	closeTR();
	$i++;
}

openTable("class='bordasimples' width='100%'");
	openLine(6); h1("Controle de procedimentos por policial"); closeLine();

	openTR();
		echo "<td>Militar</td><td>OPM</td><td>CONCLU&Iacute;DOS</td><td>ANDAMENTO</td><td>SOBRESTADO</td><td><i>NULL</i></td>";
	closeTR();

	//Aqui comeca a brincadeira das figurinhas
	$total=mysql_num_rows($res);
	$rgs=Array();
	$i=0; $x=1;
	
	while ($row=mysql_fetch_assoc($res)) {
		$nomeAtual=$row['nome'];
		$cargoAtual=$row['cargo'];
		$opmAtual=$row['ABREVIATURA'];
		$rgAtual=$row['rg'];
		
		//Grava o RG para ver quem ficou de fora
		if (!in_array($row['rg'],$rgs)) $rgs[]=$row['rg'];
		
		//nomeAnt = nome anterior
		//Ignora a primeira passada, que nao tem nome anterior
		//Quando o nome mudar, ele imprime toda a linha e zera as informacoes
		
		//Nem tente entender a logica abaixo.		
		if ($x!=$total) {
			if ($nomeAnt and $nomeAtual!=$nomeAnt) {
				mostraProcedimentos();
				unset($concluidos); unset($andamentos);	unset($sobrestados); unset($nulls);
			}
		}
		
		elseif ($x==$total) { 
			if ($nomeAnt and $nomeAtual!=$nomeAnt) {
				mostraProcedimentos();
				unset($concluidos); unset($andamentos);	unset($sobrestados); unset($nulls);
			}
			contaFigura();
			if (!$cargoAnt) $cargoAnt=$row['cargo']; //essa variavel some nao sei pq
			$nomeAnt=$nomeAtual; $cargoAnt=$cargoAtual; $rgAnt=$rgAtual;
			mostraProcedimentos();
		}//e a ultima linha, tem que fazer isso
		
		contaFigura();
		
		$opmAnt=$opmAtual;
		$nomeAnt=$nomeAtual;
		$rgAnt=$rgAtual;
		$cargoAnt=$cargoAtual;
		
		$x++;
	} //fim do while

openLine(); h1("Total: $i"); closeLine();

closeTable();

echo "<br>";

//MONTA OS RGS pra ver quem ficou de fora
$listaRG=implode(",",$rgs);

//pre($listaRG);

if ($_REQUEST['filtro']['mostrarsem_bl']) {

	$sql="SELECT cargo, nome, ABREVIATURA FROM RHPARANA.POLICIAL pm
	LEFT JOIN RHPARANA.opmPMPR ON opmPMPR.META4 = pm.opm_meta4";

	unset($sqlWhere);

	$filtro=$_REQUEST['filtro'];

	if ($filtro['id_posto']) $sqlWhere[]="pm.cargo = '".$filtro['id_posto']."'";
	if ($filtro['cdopm_st']) $sqlWhere[]="opmPMPR.CODIGO LIKE '".$filtro['cdopm_st']."%'";	

	//NAO PRECISA PARA A SEGUNDA CONSULTA
	unset($envolvido->sjd_ref_ano_ini);
	unset($envolvido->sjd_ref_ano_fim);


	if ($listaRG) $sqlWhere[]="rg NOT IN ($listaRG)";
	$groupby="";
	include("includes/filtro.php");

	//pre($sql);

	mysql_select_db("RHPARANA");
	$res=mysql_query($sql);
	$i=0;

	openTable("class='bordasimples' width='100%'");
		openLine(); h3("Policiais que n&atilde;o est&atilde;o na lista"); closeLine();
		while ($row=mysql_fetch_assoc($res)) {
			($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");
			openTR("bgcolor='$cor'");
				echo "<td>$row[cargo]</td>";
				echo "<td>$row[nome]</td>";
				echo "<td>$row[ABREVIATURA]</td>";
			closeTR();
			$i++;
		}
		
	openLine(); h3("Total: $i"); closeLine();
	closeTable();
	echo "<br>";
	mysql_select_db("sjd");
	
}//mostrar sem
h1("Legenda");
	openTable("class='bordasimples' width='100%'");
		openTR();
			?>
			<td width='10%'><img src='img/ipm32.png'> IPM</td>
			<td width='10%'><img src='img/sindicancia32.png'> SIND</td>
			<td width='10%'><img src='img/fatd32.png'> FATD</td>
			<td width='10%'><img src='img/it32.png'> IT</td>
			<td width='10%'><img src='img/iso32.png'> ISO</td>
			<td width='10%'><img src='img/apfd32.png'> APFD</td>
			<td width='10%'><img src='img/cj32.png'> CJ</td>
			<td width='10%'><img src='img/cd32.png'> CD</td>
			<td width='10%'><img src='img/adl32.png'> ADL</td>
			<td width='10%'>&nbsp;</td>
			<?php
		closeTR();
	closeTable();

}

?>
