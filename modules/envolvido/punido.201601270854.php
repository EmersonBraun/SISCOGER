<?php

//QUERY dos excluidos
//Excluidos sao os envolvidos com resultado=Excluido
//Todos tem que ter cadastrada a data de exclusao, para fins estatisticos.

$sql="SELECT envolvido.cargo, envolvido.nome, envolvido.rg, envolvido.id_envolvido, exclusaoportaria_data, exclusaobg_data, exclusaobg_numero, exclusaobg_ano, gradacao, classpunicao,
	cd.id_cd, adl.id_adl, cj.id_cj,
	cd.sjd_ref as cd_ref, adl.sjd_ref as adl_ref, cj.sjd_ref as cj_ref,
	cd.sjd_ref_ano as cd_ano, adl.sjd_ref_ano as adl_ano, cj.sjd_ref as cj_ano,
	punicao.id_punicao, punicao.punicao_data, punicao.cdopm,
        cd.id_decorrenciaconselho as cd_decorr, adl.id_decorrenciaconselho as adl_decorr, cj.id_decorrenciaconselho as cj_decorr,
	cd.outromotivo as cd_om, adl.outromotivo as adl_om, cj.outromotivo as cj_om,
        opm.ABREVIATURA
	FROM envolvido
	LEFT JOIN adl ON adl.id_adl=envolvido.id_adl
	LEFT JOIN cd ON cd.id_cd=envolvido.id_cd
	LEFT JOIN cj ON cj.id_cj=envolvido.id_cj
	LEFT JOIN punicao ON punicao.id_punicao=envolvido.id_punicao
	LEFT JOIN gradacao ON gradacao.id_gradacao=punicao.id_gradacao
	LEFT JOIN classpunicao ON classpunicao.id_classpunicao=punicao.id_classpunicao
	LEFT JOIN RHPARANA.opmPMPR opm ON punicao.cdopm = opm.CODIGOBASE ";
	$sqlWhere[]=" resultado='Punido' AND (envolvido.id_adl!='' OR envolvido.id_cd!='' OR envolvido.id_cj!='') ";

	//RESTRICAO ANO
	$ano=$_REQUEST['ano'];
	if ($ano) $sqlWhere[]=" (cd.sjd_ref_ano='$ano' OR cj.sjd_ref_ano='$ano' OR adl.sjd_ref_ano='$ano') ";


if ($_REQUEST['order']) $_REQUEST['order']=" id_envolvido";

include ("includes/filtro.php");
if ($_SESSION['debug']) pre($sql);
if ($_SESSION['debug']) pre($envolvido);

echo "<form id='envolvido' action='".$_SESSION['REQUEST_URI']."' method='POST'>";
openTable("class='bordasimples' width='100%'");
form::openTR();
	form::openTD("colspan='7'");
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
		form::openLabel("OPM da Puni&ccedil;&atilde;o");
			echo "<select name=envolvido[cdopm_st]>";
			include ("includes/option_opm.php");
			echo "</select>";
		form::closeLabel();
	form::closeTD();
	form::openTD();
		form::openLabel("Data");
			echo "De&nbsp; ";
			formulario::data("envolvido","punicao_data_ini");
			calendario::cria(1,"envolvido","envolvido[punicao_data_ini]");
			echo "At&eacute;&nbsp; ";
			formulario::data("envolvido","punicao_data_fim");
			calendario::cria(2,"envolvido","envolvido[punicao_data_fim]");
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
echo "<br>";

$res=mysql_query($sql);
//pre($sql);
$total=mysql_num_rows($res);

openTable("class='bordasimples' width='100%'");
	openLine(8);
		h1("Controle de policiais militares punidos em Conselhos");
	closeLine();
	openLine(8);
		h2("Para figurar nesta lista, o militar deve ser marcado como 'Punido' em um dos seguintes procedimentos: CD, CJ ou ADL");
	closeLine();

	//cabecalho
	openTR("bgcolor='#E0E0E0'");
		echo "<td>Nome</td><td>OPM</td><td>Procedimento</td><td>Decorr&ecirc;ncia</td><td>Punicao</td><td>Classificacao</td><td>Data</td><td>&nbsp;</td>";
	closeTR();

        //MONTA A TABELA DAS DECORRENCIAS (MOTIVOS) POSSIVEIS E GUARDA EM UM VETOR, PROVAVELMENTE DA PRA FAZER COM OS JOINS E UNIONS MAS TERIA Q REESTRUTURAR.
	$sqlDC="SELECT * FROM decorrenciaconselho ";
	$resDC=mysql_query($sqlDC);
	while ($rowDC=mysql_fetch_assoc($resDC)){
		$decorr["$rowDC[id_decorrenciaconselho]"]=$rowDC["decorrenciaconselho"];
	}

	$i=0;
	while ($row=mysql_fetch_assoc($res)) {

		openTR();
                        echo "<td>{$row['cargo']} {$row['nome']}</td>";
			echo "<td>{$row['ABREVIATURA']}</td>";

                        if (!empty($row["id_adl"])) $proc="adl";
			if (!empty($row["id_cd"])) $proc="cd";
			if (!empty($row["id_cj"])) $proc="cj";

			openTD();
				echo "<a target='_blank' href='?module=$proc&".$proc."[id]=".$row["id_$proc"]."'>";
				echo strtoupper($proc)." n&ordm; ".$row[$proc."_ref"]."/".$row[$proc."_ano"];
				echo "</a>";
			closeTD();

			echo "<td min-width='100px' width='25%'>".$decorr[$row[$proc."_decorr"]];

                        //			$campoX="$p"
			if ($row[$proc."_om"]!="") echo ": ".$row[$proc."_om"];

			echo "</td>";

			echo "<td>$row[gradacao]</td>";

			echo "<td>$row[classpunicao]</td>";
			echo "<td>".data::inverte($row["punicao_data"])."</td>";

			if (!$row['id_punicao']) {

				echo "<td><font color='red'>";
					$varAno=$proc."_ano";
					$varRef=$proc."_ref";
					link::popup("index.php?module=punicao&opcao=cadastrar&rg=$row[rg]&punicao[sjd_ref]=".$row[$varRef]."&punicao[sjd_ref_ano]=".$row[$varAno]."&punicao[procedimento]=$proc&noheader&lock",800,600);
				echo "<img border='0' src='img/lapis.gif'></a></font></td>";
			}
			//Ja tem punicao cadastradao
			else {
				echo "<td><font color='red'>";
				if ($row['id_punicao']) {
					link::popup("?module=punicao&opcao=atualizar&punicao[id]=".$row['id_punicao']."&noheader",800,600);
				}
				echo "<img border='0' src='img/lapis.gif'></a></font></td>";
			}

		closeTR();
	$i++;
	}

openLine(8);
	h1("Total: $i");
closeLine();
closeTable();



if (!$acao) $acao="listar";
//Sem acao, lista os excluidos







?>
