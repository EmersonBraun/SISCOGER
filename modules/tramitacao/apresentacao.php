<script>
function Confirma () {
	return window.confirm("Tem certeza?");
}
</script>

<?php

$rg=$_REQUEST['policial']['rg'];
$vx=strtolower("RG");
$rg=str_replace(".","",$rg);
$rg=str_replace("-","",$rg);


//L1 - NAO TEM RG, COLOCA O FORMULARIO
if (!$rg) {
?>
<table class='bordasimples' width='100%'>
<tr><td><h2>Ficha de tramitacao</h2></td></tr>

<tr><td>
<form action="index.php?module=tramitacao" method="POST">
	Rg:
	<input type="text" size="15" name="policial[rg]" onblur="ajaxForm(this, 'policial',Array('nome'));">&nbsp;ou Nome:&nbsp;
	<input type="text" size="50" autocomplete="off" name="policial[nome]" id="sugestoes" onkeyup="ajaxSugestoes(this, 'policial')"   onfocus="ajaxForm(this, 'policial', Array('rg'))"> <span id="aviso" class="aviso">Processando...</span><br>

	<input type="submit" name="acao" value="Ficha">
</form><script language="JavaScript">document.getElementsByName("policial[rg]")[0].focus();</script>
</td></tr>
</table>
<br>
<?php

}
//L2 - TEM RG, IMPRIME AS ULTIMAS ENTRADAS DA PESSOA
elseif ($rg) {
	$policial=new policial($rg);
	
	//verificar se é do CRPM ou CCB
	$crpm=($len == 1) ? 1 : 0; if ($_SESSION['debug']) pre("CRPM: ".$crpm);
	//verificar se é inativo
	$inativo=(is_null($opmPM) || $opmPM == '' || !$opmPM) ? 1 : 0; if ($_SESSION['debug']) pre("Inativo: ".$inativo);
	//ver se é da DP
	$dp_inativos = (substr($opm_login->codigoBase,0,3) == '110') ? 1 : 0; if ($_SESSION['debug']) pre("DP inativos: ".$dp_inativos);
	//ver se é do BPEC - por causa do pessoal da reserva que voltou para trabalhar nos colégios
	$bpec = (substr($opm_login->codigoBase,0,3) == '036') ? 1 : 0; if ($_SESSION['debug']) pre("BPEC: ".$bpec);
	//pode ver a ficha de inativo mesmo sendo nível 2 -> CRPM, DP ou BPEC
	$pode_ver = (($crpm || $dp_inativos || $bpec) && $inativo) ? 1 : 0; if ($_SESSION['debug']) pre("Pode ver: ".$pode_ver);

	//$policialAbrevOpm = is_null($policial->opm->abreviatura) && $policial->funcao == 'INATIVO' ? 'RESERVA' :  $policial->opm->abreviatura;//antigo
	$policialAbrevOpm = $inativo == 1 ? 'RESERVA' :  $policial->opm->abreviatura;
	if ($_SESSION['debug']) pre("policialAbrevOpm: ".$policialAbrevOpm);

	if (!$pode_ver && $dp_inativos == 0) {

		//VERIFICACAO DE SUBORDINACAO A UNIDADE PARA NIVEL 2
		if ($user['nivel']<=2) {
			$len=strlen($opm_login->codigoBase);
			$opmPM=substr($policial->opm->codigoBase,0,$len);

			if ($_SESSION['debug']) pre("comparando $opmPM e".$opm_login->codigoBase);

			if ($opmPM != $opm_login->codigoBase && !($usuarioComandoIntermediario === true && $policial->funcao == 'INATIVO')) {

				echo "<h3>Acesso negado! Voce s&oacute; pode ver policiais da sua OPM (".$opm_login->abreviatura.")</h3>";
				echo "<br>O policial que voce tentou acessar (<b>".$policial->cargo." ".$policial->nome."</b>) est&aacute; classificado no(a) <b>".$policialAbrevOpm."</b><br><br>";
				echo "<a href='?module=tramitacao'>CLique aqui para voltar</a>";
				die;
			}
		}

		//VERIFICACAO DE POSTO
		//SE O LOGIN FOR DE PRACA, NAO PODE VER AS FICHAS DOS OFICIAIS
		// 7 = ASPIRANTE. NUMEROS MAIORES: PRACAS, MENORES: OFICIAIS
		//NAO VALE PARA PRACAS DA COGER -> EMAIL TEN TODISCO

		if ($user['nivel']<4) {
			if (($usuario->id_posto > 7 and $policial->id_posto <= 7) && !($usuarioComandoIntermediario === true && $policial->funcao == 'INATIVO')){
				h3("Lamento, voc&ecirc; n&atilde;o tem autoriza&ccedil;&atilde;o para pode ver a ficha dos Oficiais.");
				die;
			}
		}
	}
        if ($opcao == 'tramitacaocoger') {
            log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", visualizou informações de Tramitação COGER referente ao ME: " .$policial->cargo . ' ' . $policial->nome,"tramitacao");
        } elseif ($opcao == 'tramitacaoopm') {
            log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", visualizou informações de Tramitação OPM/OBM referente ao ME: " .$policial->cargo . ' ' . $policial->nome,"tramitacao");
        } elseif ($opcao == 'sai') {
            log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", visualizou informações do SAI referente ao ME: " .$policial->cargo . ' ' . $policial->nome,"tramitacao");
        } elseif ($opcao == 'punicao') {
            log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", visualizou informações de Histórico Funcional referente ao ME: " .$policial->cargo . ' ' . $policial->nome,"tramitacao");
        } elseif ($opcao == 'comportamento') {
            log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", visualizou informações de Comportamento referente ao ME: " .$policial->cargo . ' ' . $policial->nome,"tramitacao");
        } elseif ($opcao == 'procedimentos') {
            log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", visualizou informações de Procedimentos referente ao ME: " .$policial->cargo . ' ' . $policial->nome,"tramitacao");
        } elseif ($opcao == 'apresentacao') {
            log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", visualizou informações de Apresentações referente ao ME: " .$policial->cargo . ' ' . $policial->nome,"tramitacao");
        } else {
            log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", visualizou a ficha individual do ME: " .$policial->cargo . ' ' . $policial->nome,"tramitacao");
        }

	//Tabela de identificacao
	openTable("width='100%' class='bordasimples' cellspacing='1'");
		//Abre linha colspan=2
		openLine(4);
			h1("Ficha Individual");
		closeLine();

	//verifica se esta preso. pedido cap heitor, 27/09/12
	$hoje=date("Y-m-d");
	$sql="SELECT * FROM preso WHERE inicio_data<='$hoje' AND !fim_data AND rg='$rg' ";
	$estapreso=mysql_num_rows(mysql_query($sql));

	if ($estapreso) {
		openLine(); h3("POLICIAL PRESO"); closeLine();
	}

	//Verifica se esta suspenso. Cap Todisco, 08/01/14
	$hoje=date("Y-m-d");
	$sql="SELECT * FROM suspenso WHERE inicio_data<='$hoje' AND !fim_data AND rg='$rg' ";
	$estasuspenso=mysql_num_rows(mysql_query($sql));

	if ($estasuspenso) {
		openLine(); h4("POLICIAL SUSPENSO"); closeLine();
	}

	//Verifica se esta excluido. pedido Cap Todisco, 28/01/2014
	$hoje=date("Y-m-d");
	$sql="SELECT * FROM envolvido WHERE resultado='Excluído' AND exclusaobg_numero>0 AND rg='$rg' ";
	//pre($sql);
	$foiexcluido=mysql_num_rows(mysql_query($sql));
	if ($foiexcluido) {
		openTR("style='color:#FFFFFF;' bgcolor='#000000'");
			openTD("colspan='7' style='color:#FFFFFF; font-weight:bold; font-size:12px;'"); echo "POLICIAL EXCLUIDO"; closeTD();
		closeTR();
	}


	openTR();
		openTD("rowspan='4' width='60'");
			form::openLabel("Foto");
			//Mostra a foto do policial, com 60 pixels
			//$policial->mostraFoto("80");
			//if (file_exists("http://10.47.1.8/sispics/fotos/$rg.JPG")) {
			echo "<a href='http://10.47.1.8/sispics/fotos/$rg.JPG'><img width='120' src='http://10.47.1.8/sispics/fotos/$rg.JPG'></a>";
			//}
			//else echo "S/ FOTO.";
			form::closeLabel();
		closeTD();
	closeTR();


	openTR();
		openTD("width='60%'");
		form::openLabel("Nome");
			echo $policial->cargo." ".$policial->quadro." ".$policial->nome;
		form::closeLabel();
		closeTD();
		openTD();
			form::openLabel("RG");
				echo $policial->rg;
			form::closeLabel();
		closeTD();
	closeTR();

	openTR();
		openTD();
			form::openLabel("Classificacao Meta4");
				echo $policial->opm->descricao;
			form::closeLabel();
		closeTD();
		openTD();
			form::openLabel("Data de nascimento");
				echo data::inverte($policial->nascimento);
			form::closeLabel();
		closeTD();
	closeTR();

	openTR();
		openTD();
			form::openLabel("Comportamento atual");
				//Procura o cargo. Oficial nao tem comportamento
				//Se o id_posto for menor ou igual a 6, nao tem comportamento.
				//1-CEL 2-TENCEL 3-MAJ 4-CAP 5-1TEN 6-2TEN
				$sql="SELECT * FROM RHPARANA.posto WHERE posto='".$policial->cargo."'";

				$row=mysql_fetch_assoc(mysql_query($sql));
				//	pre($row);
				if (($row['id_posto']<=6 AND $row["id_posto"]>=1) OR ($row['id_posto']==0 and substr($row['posto'],0,3)=="CEL")) {
					echo "OFICIAL";
				}
				elseif (trim($row['id_posto'])=="" AND substr($row['posto'],0,3)!="CEL") {
					echo "RESERVA";
				}
				else {
					//PARA AS PRACAS
					//Pega a ultima mudanca de comportamento
					$sql="SELECT * FROM comportamentopm
					INNER JOIN comportamento ON comportamentopm.id_comportamento=comportamento.id_comportamento
					WHERE rg='".$policial->rg."' ORDER BY data DESC LIMIT 0,1";

					if ($_SESSION['debug']) pre($sql);
					$res=mysql_query($sql);
					$resultados=mysql_num_rows($res);

					if (!$resultados) echo "<font color='red'>Nada encontrado</font>";
					else {
						$row=mysql_fetch_assoc($res);
						echo $row['comportamento'];
					}
				}
			form::closeLabel();
		closeTD();
		openTD();
			form::openLabel("Data de inclus&atilde;o");
				echo data::inverte($policial->data_admissao);
			form::closeLabel();
		closeTD();
	closeTR();

	//QUERY DE SUB JUDICE
	$sqlSUB="SELECT * FROM envolvido WHERE rg='".$rg."' AND ipm_processocrime='Denunciado'";
	$resSUB=mysql_query($sqlSUB);

	if (mysql_num_rows($resSUB)) {
		$subjudice="<font color='red'>Sim</font>";
		$encontrado++; $militar=true;
	}

	if (!$encontrado) $subjudice="<font color='darkgreen'>Nada consta</font>";

	openTR("id='denuncia'");
		openTD("colspan='3'");
			$texto="Cadastrar den&uacute;ncia criminal ou condena&ccedil;&atilde;o em decorr&ecirc;ncia de IPM, APFD, e deser&ccedil;&atilde;o, cadastrar o militar no campo &#34;R&eacute;us&#34;, dentro de cada planilha (IPM, APFD e DESER&Ccedil;&Atilde;O) existente no procedimento correspondente, cadastrando as principais informa&ccedil;&otilde;es dentro da planilha, al&eacute;m do tipo do crime, data da den&uacute;ncia, tipos penais condenat&oacute;rios e a data do tr&acirc;nsito em julgado. Dever&aacute; ainda constar o processo crime e a Comarca para acompanhamento no site do TJPR.";

			$textoMenos="O campo poder&aacute; ser suprimido nos casos de certid&atilde;o da Ficha Disciplinar Individual do militar estadual.";

			form::openLabel("Den&uacute;ncias criminais em IPM, APFD e Deser&ccedil;&atilde;o [<a href='#none' title='$texto'>?</a>] [<a href='#none' onclick='$(\"#denuncia\").hide(); $(\"#denunciaB\").hide();' title='$textoMenos'>-</a>]");
	//Se foram encontrados procedimentos militares em que o policial e denunciado
	if ($militar) {
		while ($row=mysql_fetch_assoc($resSUB)) {
			if ($row['id_ipm']) $proc="ipm"; if ($row['id_apfd']) $proc="apfd"; if ($row['id_desercao']) $proc="desercao";
			$sqlP="SELECT * FROM $proc WHERE id_$proc=".$row["id_$proc"]."";
			//pre($sqlP);
			$rowP=mysql_fetch_assoc(mysql_query($sqlP));
			openTR();
				openTD("colspan='3'");
					echo "<a href='?module=$proc&".$proc."[id]=".$row["id_$proc"]."'>";
					echo ucwords($proc)." n&ordm; $rowP[sjd_ref]/$rowP[sjd_ref_ano].</a> ";
					echo "Processo crime: <b>$row[ipm_processocrime]</b>. ";
					echo "Julgamento: <b>";
					if ($row['ipm_julgamento']) echo "$row[ipm_julgamento]</b>. "; else echo "N&atilde;o cadastrado</b>. ";

					//Transito em julgado e so para quem e condenado.
					if ($row['ipm_julgamento']=="Condenado") {
					echo "Transito em julgado: <b>";
					if ($row["ipm_transitojulgado_bl"]=="S") echo "Sim</b>. "; else echo "Nao</b>. ";
					}
				closeTD();
			closeTR();
		}
	}
	else echo "<font color='darkgreen'>Nada encontrado</font>";
	//Fim das denuncias
		form::closeLabel();
		closeTD();
	closeTR();
	openTR("id='denunciaB'");
		openTD("colspan='3'");
			$texto="Cadastrar den&uacute;ncia criminal ou condena&ccedil;&atilde;o em decorr&ecirc;ncia de sindic&acirc;ncia, termo circunstanciado ou de qualquer outro procedimento civil (Ex: Inqu&eacute;rito Civil ou Inqu&eacute;rito Federal), cadastrando as principais informa&ccedil;&otilde;es como tipo de crime, data da den&uacute;ncia, tipos penais condenat&oacute;rios e a data do tr&acirc;nsito em julgado. Dever&aacute; ainda constar o n&uacute;mero do processo crime e a Comarca para acompanhamento no site do TJPR.";
			form::openLabel("Outras den&uacute;ncias criminais (Inqueritos civis, termos circunstanciados, etc.) [<a href='#none' title='$texto'>?</a>]");

			//Consulta das denuncias civis
			$sql="SELECT * FROM denunciacivil WHERE rg='$rg'";
			//pre($sql);
			$res=mysql_query($sql);

			//Nada encontrado.
			if (!mysql_num_rows($res)) {
				echo "<font color='darkgreen'>Nada encontrado</font>";
			}
			//Foram encontradas denuncia
			else {
				while ($row=mysql_fetch_assoc($res)) {
					echo link::popup("?module=denunciacivil&denunciacivil[id]=".$row["id_denunciacivil"]."&noheader",600,480).$row["processo"].". &nbsp;</a>";
					echo "Processo crime: <b>$row[processocrime]</b>. ";
					echo "Julgamento: <b>";
					if ($row['julgamento']) echo "$row[julgamento]</b>. "; else echo "N&atilde;o cadastrado</b>. ";
					echo "Transito em julgado: <b>";
					if (!$row["transitojulgado_bl"]) echo "Nao</b>. "; else echo "Sim</b>. ";

					echo "<br>\r\n";
				}
			}

			link::popup("?module=denunciacivil&opcao=cadastrar&noheader&rg=".$rg,750,480);
			echo "<button class='noprint'>Adicionar Denuncia Civil</button>";
			echo "</a>";
			form::closeLabel();
		closeTD();
	closeTR();

	openTR("id='esconder'");
		openTD("colspan='3'");
			form::openLabel("Pris&otilde;es penais ou processuais penais<a onclick='$(\"#esconder\").hide();' href='#none'>(-)</a>");
				$sql="SELECT * FROM preso WHERE rg='$rg'";
				$res=mysql_query($sql);

				if (mysql_num_rows($res)) {
					while ($row=mysql_fetch_assoc($res)) {
						echo "<b>Inicio</b>: ".data::inverte($row["inicio_data"])."/<b>Fim</b>: ".data::inverte($row["fim_data"])." ($row[comarca]-$row[vara])";
					}
				}
				else {
					echo "N&atilde;o h&aacute; registros.";
				}
			form::closeLabel();
		closeTD();
	closeTR();

	openTR("id='esconder3'");
		openTD("colspan='3'");
			form::openLabel("Restri&ccedil;&otilde;es (Uso de fardamento e porte de arma de fogo) <a onclick='$(\"#esconder3\").hide();' href='#none'>(-)</a>");
				$sql="SELECT * FROM restricao WHERE rg='$rg'";
				$res=mysql_query($sql);

				if (mysql_num_rows($res)) {
					while ($row=mysql_fetch_assoc($res)) {
						if ($row["arma_bl"]) echo "Restricao de porte de arma de fogo. ";
						if ($row["fardamento_bl"]) echo "Restricao de uso de fardamento. ";
						echo "<b>Inicio</b>: ".data::inverte($row["inicio_data"])." / <b>Fim</b>: ";
						if ($row["retirada_data"]!="0000-00-00" and $row["fim_data"]!="") echo data::inverte($row["fim_data"]); else echo "<font color='red'>Vigente</font>";

						if (!($row["retirada_data"]!="0000-00-00" and $row["retirada_data"]!="")) {
							link::popup("?module=restricao&opcao=retirar&noheader&restricao[id]=".$row["id_restricao"],750,480);
							echo " <button class='noprint btn-success'>Retirar restricao</button></a>";
						}
						echo "<br>";
					}
				}
				else {
					echo "N&atilde;o h&aacute; registros.";
				}

				link::popup("?module=restricao&opcao=cadastrar&noheader&rg=".$rg,750,480);
				echo "<button class='noprint'>Adicionar Restricao</button>";
				echo "</a>";
			form::closeLabel();
		closeTD();
	closeTR();

closeTable();


	?>
	<br>
	<table cellpadding='0px' cellspacing='0px' width='100%' style='border-bottom:0px;' class='menu' bgcolor='#F0F0F0'>
	<tr style='padding:0px;'><td>
		<ul style='padding-left:0px;'>
		<?php
			if ($user['nivel']==5 || $user['nivel']==7)
				menuli("SAI","sai&policial[rg]=$rg");
			if ($user['nivel']>=4 && $user['nivel']<>6)
				menuli("Tr&acirc;mite COGER","tramitacaocoger&policial[rg]=$rg");

			menuli("Tramite OPM/OBM","tramitacaoopm&policial[rg]=$rg","","id='foco'");
			menuli("Procedimentos","procedimentos&policial[rg]=$rg","","id='foco'");
			menuli("FDI","comportamento&policial[rg]=$rg","","id='foco'");
			menuli("Hist&oacute;rico Funcional","punicao&policial[rg]=$rg","","id='foco'");
                        menuli("Apresenta&ccedil;&otilde;es","apresentacao&policial[rg]=$rg","","id='foco'");
			//menuli("Subjudice","subjudice&policial[rg]=$rg");
			//menuli("Nome da opcao","opcao");
		?>
		</ul>
	</td></tr>
	</table>

<?

if ($opcao) include ("$opcao.inc.php");


}//acao

?>
