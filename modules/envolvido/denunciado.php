<?php

if ($user['nivel']<4) {
	if (!$_REQUEST['envolvido']['CODIGOBASE_st'])
		$_REQUEST['envolvido']['CODIGOBASE_st']=$opm_login->codigoBase;
}

//QUERY dos excluidos
//Excluidos sao os envolvidos com ipm_julgamento=Denunciado
//Todos tem que ter cadastrada a data de exclusao, para fins estatisticos.

$sql="SELECT envolvido.*, opm.ABREVIATURA, opm.CODIGOBASE,
	ipm.sjd_ref AS ipm_ref, apfd.sjd_ref AS apfd_ref, desercao.sjd_ref AS desercao_ref,
	ipm.sjd_ref_ano AS ipm_ano, apfd.sjd_ref_ano AS apfd_ano, desercao.sjd_ref_ano AS desercao_ano,
	CASE
		WHEN envolvido.id_ipm THEN 'ipm'
		WHEN envolvido.id_apfd THEN 'apfd'
		WHEN envolvido.id_desercao THEN 'desercao'
	END proc,

        ipm.crime as ipm_motivo,
        apfd.tipo_penal_novo as apfd_motivo,
        'Deserção' as desercao_motivo,

        ipm.crime_especificar as ipm_outro, apfd.especificar as apfd_outro,
        '' as desercao_outro


	FROM envolvido
	LEFT JOIN ipm ON ipm.id_ipm=envolvido.id_ipm
	LEFT JOIN apfd ON apfd.id_apfd=envolvido.id_apfd
	LEFT JOIN desercao ON desercao.id_desercao=envolvido.id_desercao
	LEFT JOIN RHPARANA.POLICIAL pm ON pm.rg=envolvido.rg
	LEFT JOIN RHPARANA.opmPMPR opm ON opm.META4 = pm.opm_meta4";

	$sqlWhere[]="ipm_processocrime='Denunciado'";

        $filtro_motivo = mysql_real_escape_string($_POST['filtro_motivo']);

        if (!empty($_POST['filtro_motivo'])) {
            $sqlAUtilizar = " ( ipm.crime='$filtro_motivo' OR apfd.tipo_penal='$filtro_motivo' ";

            if ($filtro_motivo == "Deserção") {
               $sqlAUtilizar .= ' OR envolvido.id_desercao > 0 ';
            }

            $sqlAUtilizar .= " )";

            $sqlWhere[] = $sqlAUtilizar;
        }

	//WHERE ipm_processocrime='Denunciado'";

if ($_SESSION['debug']) pre($sqlX);
if ($_SESSION['debug']) pre($envolvido);

$envolvido->setValues($_REQUEST['envolvido']);
include("includes/filtro.php");

$sqlX=$sql;
$total=mysql_num_rows($res);

//FILTRO

echo "<form id='envolvido' action='".$_SESSION['REQUEST_URI']."' method='POST'>";
echo "<table width='100%' class='bordasimples'>";

form::openTR();
	form::openTD("colspan='6'");
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
			echo "<select name=envolvido[CODIGOBASE_st]>";
			include ("includes/option_opm.php");
			echo "</select>";
		form::closeLabel();
	form::closeTD();
	openTD();
		form::openLabel("POSTO/GRAD.");
			echo "<select name='envolvido[envolvido.cargo_eq]'>";
				echo "<option value=''>Todos</option>";
				include("includes/option_cargo.html");
			echo "</select>";
		form::closeLabel();
	closeTD();
        form::openTD();
		form::openLabel("Motivo");
			echo "<select name='filtro_motivo'>";
				echo "<option value=''>Selecione</option>";
				include ("includes/option_crime.html");
			echo "</select>";
		form::closeLabel();
	form::closeTD();
	openTD();
		form::openLabel("Julgamento");
			echo "<select name='envolvido[ipm_julgamento_eq]'>";
				echo "<option value=''>Todos</option>";
				echo "<option>Condenado</option>";
				echo "<option>Absolvido</option>";
			echo "</select>";
		form::closeLabel();
	closeTD();
	openTD();
		form::openLabel("T. Julgado");
			echo "<select name='envolvido[ipm_transitojulgado_bl_eq]'>";
				echo "<option value=''>-</option>";
				echo "<option value='On'>Sim</option>";
				//echo "<option value='N'>Nao</option>";
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

echo "<br>";

mysql_select_db("sjd",$con[8]);
$res=mysql_query($sqlX);
//TABELA

openTable("class='bordasimples' width='100%'");
	openLine(8);
		h1("Controle de policiais denunciados (Proc. Militares)");
	closeLine();
	openLine(8);
		h2("Para figurar nesta lista, o militar deve ser marcado como 'Denunciado' em IPM, APFD ou Deser&ccedil;&atilde;o");
	closeLine();

	//cabecalho
	openTR("bgcolor='#E0E0E0'");
		echo "<td>Nome</td><td>OM atual</td><td>Procedimento</td><td>Proc Crime</td><td>Motivo</td><td>Julgamento</td><td>T. julgado</td><td>Pena</td>";
	closeTR();

	$i=0;
	while ($row=mysql_fetch_assoc($res)) {
		//pre(array_keys($row)); die;
		($i%2)?($cor="#E0E0E0"):($cor="#FFFFFF");
		openTR("bgcolor='$cor'");
			echo "<td>$row[cargo] $row[nome]</td>";
			echo "<td>$row[ABREVIATURA]</td>";
			$proc=$row["proc"];
			echo "<td>$row[proc] n&ordm; ".$row[$proc."_ref"]."/".$row[$proc."_ano"]."</td>";
			echo "<td>$row[ipm_processocrime]</td>";

                        echo "<td width='20%'>" . $row[$proc . '_motivo'];

                        if (!empty($row[$proc . '_outro'])) {
                            echo ': '. $row[$proc . '_outro'];
                        }

                        echo "</td>";

			echo "<td>$row[ipm_julgamento]</td>";

			//Coluna de transito julgado se aplica apenas para Condenado
			if ($row['ipm_julgamento']=="Condenado") {
				if ($row['ipm_transitojulgado_bl'])
				echo "<td>Sim</td>";
				else echo "<td>Nao</td>";
			}
			else echo "<td>-</td>";

			//Pena
			if ($row['ipm_julgamento']=="Condenado") {
			echo "<td>$row[ipm_pena_anos]a $row[ipm_pena_meses]m $row[ipm_pena_dias]d $row[ipm_tipodapena]</td>";
			}
			else echo "<td>-</td>";

			/* if ($row['id_punicao']) {

				echo "<td><font color='red'>";
				link::popup("?module=punicao&opcao=cadastrar&rg=$row[rg]&noheader&lock&punicao[procedimento]=$proc&punicao[sjd_ref]=".$row["$proc"._ref]."&punicao[sjd_ref_ano]=".$row["$proc"._ano]."",800,600);
				echo "<img src='img/lapis.gif'></a></font></td>";
			}
			//Ja tem punicao cadastradao
			else {
				echo "<td><font color='red'>";
				link::popup("?module=punicao&opcao=atualizar&punicao[id]=".$row['id_punicao'],800,600);
				echo "<img src='img/lapis.gif'></a></font></td>";
			}
			*/
		$i++;
		closeTR();
	}

closeTable();
h1("Total: $i");

echo "<br>\r\n";

//LISTA PARA DENUNCIAS CIVIS
openTable("class='bordasimples' width='100%'");
	openLine(8);
		h1("Controle de policiais denunciados (Proc. civis)");
	closeLine();
	openLine(8);
		h2("Para figurar nesta lista, a denuncia deve ser cadastrada na ficha de tramitacao do PM");
	closeLine();

	//cabecalho
	openTR("bgcolor='#E0E0E0'");
		echo "<td>Nome</td><td>OM atual</td></tD><td>Origem</td><td>Infração</td><td>Proc Crime</td><td>Julgamento</td><td>T. julgado</td><td>Pena</td>";
	closeTR();

	$sql="SELECT denunciacivil.*, opm.CODIGOBASE, opm.ABREVIATURA, denunciacivil.infracao FROM denunciacivil
	LEFT JOIN RHPARANA.POLICIAL pm ON pm.rg=denunciacivil.rg
	LEFT JOIN RHPARANA.opmPMPR opm ON opm.META4 = pm.opm_meta4";

	//GAMBIARRA
	$var="envolvido.cargo_eq";
	$var2="denunciacivil.cargo_eq";
		if ($envolvido->$var) {
		$envolvido->$var2=$envolvido->$var;
		unset($envolvido->$var);
	}
	//GAMBIARRA JULGAMENTO
	$var="ipm_julgamento_eq";
	$var2="julgamento_eq";
		if ($envolvido->$var) {
		$envolvido->$var2=$envolvido->$var;
		unset($envolvido->$var);
	}
	//GAMBIARRA TRANSITO JULGADO
	$var="ipm_transitojulgado_bl_eq";
	$var2="transitojulgado_bl_eq";
		if ($envolvido->$var) {
		$envolvido->$var2=$envolvido->$var;
		unset($envolvido->$var);
	}

	//pre($envolvido); die;

	$_REQUEST['order']="id_denunciacivil";
	$sqlWhere="";
	include("includes/filtro.php");
	//FALTA O FILTRO

	$res=mysql_query($sql); $i=0;

	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="#F0F0F0"):($cor="#FFFFFF");
		openTR("bgcolor='$cor'");
			echo "<td>$row[cargo] $row[nome]</td>";
			echo "<td>$row[ABREVIATURA]</td>";
			echo "<td>$row[processo]</td>";
                        echo "<td width='20%'>$row[infracao]</td>";
			echo "<td>$row[processocrime]</td>";
			echo "<td>$row[julgamento]</td>";

			//Coluna de transito julgado se aplica apenas para Condenado
			if ($row['transitojulgado_bl']) {
				echo "<td>Sim</td>";
			}
			else echo "<td>N&atilde;o</td>";

			//Pena
			if ($row['julgamento']=="Condenado") {
			echo "<td>$row[pena_anos]a $row[pena_meses]m $row[pena_dias]d $row[tipodapena]</td>";
			}
			else echo "<td>-</td>";

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
