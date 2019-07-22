<?php

//QUERY dos excluidos
//Excluidos sao os envolvidos com resultado=Excluido
//Todos tem que ter cadastrada a data de exclusao, para fins estatisticos.

$sql="SELECT cargo, nome, envolvido.id_envolvido, exclusaoportaria_data, exclusaobg_data, exclusaobg_numero, exclusaobg_ano, exclusaoportaria_numero, exclusaoopm, 
	cd.id_cd, adl.id_adl, cj.id_cj,
	cd.sjd_ref as cd_ref, adl.sjd_ref as adl_ref, cj.sjd_ref as cj_ref,
	cd.sjd_ref_ano as cd_ano, adl.sjd_ref_ano as adl_ano, cj.sjd_ref_ano as cj_ano,
	cd.id_decorrenciaconselho as cd_decorr, adl.id_decorrenciaconselho as adl_decorr, cj.id_decorrenciaconselho as cj_decorr,
	cd.outromotivo as cd_om, adl.outromotivo as adl_om, cj.outromotivo as cj_om,
	opm.ABREVIATURA
	FROM envolvido 
	LEFT JOIN adl ON adl.id_adl=envolvido.id_adl
	LEFT JOIN cd ON cd.id_cd=envolvido.id_cd
	LEFT JOIN cj ON cj.id_cj=envolvido.id_cj
	LEFT JOIN RHPARANA.opmPMPR opm ON opm.CODIGOBASE = envolvido.exclusaoopm";
	
	//NOTA: _decorr = id_decorrenciaconselho, para nao ficar muito grande mais para frente
	
	$sqlWhere[]=" resultado='Excluido' ";
	//RESTRICAO ANO
	$ano=$_REQUEST['ano'];
	if ($ano) $sqlWhere[]=" (cd.sjd_ref_ano='$ano' OR cj.sjd_ref_ano='$ano' OR adl.sjd_ref_ano='$ano') ";

include ("includes/filtro.php");

if ($_SESSION['debug']) pre($sql);
if ($_SESSION['debug']) pre($envolvido);


$res=mysql_query($sql);
$total=mysql_num_rows($res);

h1("Controle de policiais militares excluidos");

//FILTRO
echo "<form id='envolvido' action='".$_SESSION['REQUEST_URI']."' method='POST'>";
echo "<table width='100%' class='bordasimples' style='border-top:0px;'>";

form::openTR();
	form::openTD("colspan='5'");
		?>
		<h2>Filtro
			<a href='#noplace' onclick='$("#linhafiltro").show()'>+</a>
			<a href='#noplace' onclick='$("#linhafiltro").hide()'>-</a>
		</h2>
		<?php
	form::closeTD();
form::closeTR();

form::openTR("id='linhafiltro' style='display:none;'");
	form::openTD();
		form::openLabel("OPM");
			echo "<select name=envolvido[exclusaoopm_st]>";
			include ("includes/option_opm.php");
			echo "</select>";
		form::closeLabel();
	form::closeTD();
	form::openTD();
		form::openLabel("Data do BG");
			echo "De&nbsp; ";
			formulario::data("envolvido","exclusaobg_data_ini");
			calendario::cria(1,"envolvido","envolvido[exclusaobg_data_ini]");
			echo "At&eacute;&nbsp; ";
			formulario::data("envolvido","exclusaobg_data_fim");
			calendario::cria(2,"envolvido","envolvido[exclusaobg_data_fim]");
		form::closeLabel();
	form::closeTD();
	openTD();
		form::openLabel("ANO do Proc.");
			echo "<select name='ano'>";
			echo "<option value=''>Todos</option>";
			for($i=2008;$i<=date("Y");$i++) {
				$selected=($i==$ano)?("selected"):("");
				echo "<option $selected>$i</option>";
			}
			echo "</select>";
		form::closeLabel();
	closeTD();
	
	openTD();
		form::openLabel("Acao");
		echo "<input type='submit' value='Listar' name='$opcao'>";
		form::closeLabel();
	closeTD();

form::closeTR();
echo "</table>";
echo "</form>";

formulario::values($envolvido);

//FIM DO FILTRO
echo "<br>";

openTable("class='bordasimples' width='100%'");

	openLine(7);
		h2("Para figurar nesta lista, o militar deve ser marcado como 'Excluido' em um dos seguintes procedimentos: CD, CJ ou ADL");
	closeLine();

	//cabecalho
	openTR("bgcolor='#E0E0E0'");
		lista::td("Nome","nome");
		echo "<td>Procedimento</td><td>Decorr&ecirc;ncia</td><td>Portaria de Exclusao</td><td>Boletim Geral</td>";
		lista::td("OPM","ABREVIATURA");

		echo "<td>Acao</td>";
	closeTR();

	$res=mysql_query($sql);
$total=mysql_num_rows($res);

	//MONTA A TABELA DAS DECORRENCIAS (MOTIVOS) POSSIVEIS E GUARDA EM UM VETOR, PROVAVELMENTE DA PRA FAZER COM OS JOINS E UNIONS MAS TERIA Q REESTRUTURAR.
	$sqlDC="SELECT * FROM decorrenciaconselho ";
	$resDC=mysql_query($sqlDC);
	while ($rowDC=mysql_fetch_assoc($resDC)){
		$decorr["$rowDC[id_decorrenciaconselho]"]=$rowDC["decorrenciaconselho"];
	}
	//pre($decorr);
	
	$i=0;
	while ($row=mysql_fetch_assoc($res)) {
		$cor=($i%2)?($cor="#F0F0F0"):($cor="white");
		
		openTR("bgcolor='$cor'");
			echo "<td>$row[cargo] $row[nome]</td>";
			
			if ($row["id_adl"]) $proc="adl";
			if ($row["id_cd"]) $proc="cd";
			if ($row["id_cj"]) $proc="cj";
			
			//NUMERO DO PROCEDIMENTO COM LINK, CAP TODISCO, 18/12/2013
			openTD();
				echo "<a target='_blank' href='?module=$proc&".$proc."[id]=".$row["id_$proc"]."'>";
				echo strtoupper($proc)." n&ordm; ".$row[$proc."_ref"]."/".$row[$proc."_ano"];
				echo "</a>";
			closeTD();
			echo "<td>".$decorr[$row[$proc."_decorr"]];
			
//			$campoX="$p"
			if ($row[$proc."_om"]!="") echo ": ".$row[$proc."_om"];

			echo "</td>";


			
			//if ($row['id_cd']) echo "<td>CD n&ordm; $row[cd_ref]/$row[cd_ano]</td><td>".$decorr[$row["cd_decorr"]]."</td>";
			//if ($row['id_cj']) echo "<td>CJ n&ordm; $row[cj_ref]/$row[cj_ano]</td><td>".$decorr[$row["cj_decorr"]]."</td>";
			
							
			echo "<td>N&ordm; $row[exclusaoportaria_numero] de ".data::inverte($row['exclusaoportaria_data'])."</td>";
						
			echo "<td>BG n&ordm; $row[exclusaobg_numero]/$row[exclusaobg_ano] de ".data::inverte($row['exclusaobg_data'])."</td>";
			echo "<td>$row[ABREVIATURA]</td>";
		
			echo "<td><font color='red'>";
			link::popup("?module=envolvido&opcao=cadastrar_exclusao&noheader&envolvido[id]=$row[id_envolvido]",880);
			echo "<img border='0' src='img/lapis.gif'></a></font></td>";
		
		closeTR();
	$i++;
	}
	
closeLine();

openLine(8);
	h1("Total: $i");
closeLine();

closeTable();

//ADICIONA OS EXCLUIDOS JUDICIALMENTE

$i=0;
echo "<br>";
$sql="SELECT exclusaojudicial.*, opm.ABREVIATURA AS opmexclusao FROM exclusaojudicial
LEFT JOIN RHPARANA.opmPMPR opm ON opm.CODIGOBASE=exclusaojudicial.cdopm_quandoexcluido";

unset($sqlWhere);
if ($envolvido->exclusaobg_data_ini) $sqlWhere[]=" exclusao_data >='".$envolvido->exclusaobg_data_ini."' ";
if ($envolvido->exclusaobg_data_fim) $sqlWhere[]=" exclusao_data <='".$envolvido->exclusaobg_data_fim."' ";

if ($ano) $sqlWhere[]=" YEAR(data)=$ano ";

unset($envolvido); unset($filtro);
$order="id_exclusaojudicial DESC";
include("includes/filtro.php");
//pre($sql);
	 
include("/var/www/sjd/modules/exclusaojudicial/listatabela.inc.php");

if (!$acao) $acao="listar";
//Sem acao, lista os excluidos




?>
