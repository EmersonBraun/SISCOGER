<?php
if ($user['nivel']==6 || $user['nivel']==7) { $opcaoGeral="readonly"; $opcaoGeral2="disabled"; } // alteracao solicitada pelo Cap Todisco

//Controle da especializacao de envolvido
//Indiciado e envolvido que tem id_ipm
//Para preenchimento dos campos ipm_julgamento, ipm_tipodapena, etc

if ($_REQUEST['ipm']) { 
	$ipm=new ipm($_REQUEST['ipm']); 
	$proc="ipm";
	$situacao="Indiciado"; 
}
if ($_REQUEST['apfd']) { 
	$apfd=new apfd($_REQUEST['apfd']); 
	$proc="apfd"; 
	$situacao="Acusado";
}
if ($_REQUEST['desercao']) { 
	$desercao=new desercao($_REQUEST['desercao']); 
	$proc="desercao"; 
	$situacao="Desertor";
}
$id="id_$proc";
//L1 - Nao tem acao, imprime o formulario mostrando os envolvidos do IPM

if ($user['nivel']<2) $opcaoGeral="readonly";

if ($user['nivel']>=2 and $user['nivel']<4) {
	//pre($$proc->andamentocoger);
	if ($$proc->andamentocoger->andamentocoger!="JUSTICA COMUM") $opcaoGeral="readonly";

}


if (!$acao) { 

//pre($ipm);

//pre($apfd);
//pre($$proc);

?>
<form action='?module=envolvido&opcao=indiciado' method='POST'>

<?php
echo "<input type='hidden' name='".$proc."[$id]' value='".$$proc->$id."'>";

    if ($proc=="ipm") echo "<h1 align='center'>Inquérito Policial Militar</h1>";
elseif ($proc=="apfd") echo "<h1 align='center'>Auto de Prisão em Flagrante Delito</h1>";
elseif ($proc=="desercao") echo "<h1 align='center'>Deser&ccedil;&atilde;o</h1>";

openTable("width='100%' class='bordasimples'");

openTR();
	openTD("colspan='5' align='center' bgcolor='#E0E0E0'");
		echo "<a href='?module=$proc&".$proc."[id]=".$$proc->$id."'>Visualização e atualização</a> | ";
		echo "<a href='?module=movimento&movimento[id_$proc]=".$$proc->$id."'>Movimentos</a> |";
		echo " Réu(s)</a>";
	closeTD();
closeLine();

openTR(); 
	openTD();
		$opcoes="readonly";
		form::input("N&ordm; da COGER",$proc."[sjd_ref]");
	closeTD();
	openTD();
		$opcoes="readonly";
		form::input("Ano de referencia",$proc."[sjd_ref_ano]");
	closeTD();
		openTD();
		form::openLabel("OPM");
		$opmT=new opm(completaZeros($$proc->cdopm));
		echo "".$opmT->abreviatura;
		form::closeLabel();
	closeTD();
closeTR();

$sql="SELECT * FROM envolvido WHERE id_$proc='".$$proc->$id."' AND situacao='$situacao'";
if ($_SESSION['debug']) pre($sql);

//pre($sql); die;

$res=mysql_query($sql);

$i=0; //contador
while ($row=mysql_fetch_assoc($res)) {
	if ($row['nome']) {
	
	openLine(); h2("$situacao n&ordm; ".($i+1)); closeLine();
	echo "<input type='hidden' name='envolvido[$i][id_envolvido]' value='".$$proc->$id."'>";
	openTR();
		openTD("colspan='1'");
			form::openLabel("Indiciado");
				echo "$row[cargo] $row[nome]";
			form::closeLabel();
		closeTD();
		openTD();
			form::openLabel("Processo Crime");
			echo "<select name='envolvido[$i][ipm_processocrime]'>";
				echo "<option value=''>Selecione</option>";
				echo "<option value='Denunciado'>Denunciado</option>";
				echo "<option value='Arquivado'>Arquivado</option>";

			echo "</select>";
			form::closeLabel();
		closeTD();
		
		openTD();
			form::openLabel("Julgamento");
				echo "<select name='envolvido[$i][ipm_julgamento]'>";
					echo "<option rel='none' value=''>Selecione</option>";
					echo "<option rel='foicondenado$i' value='Condenado'>Condenado</option>";
					echo "<option rel='none' value='Absolvido'>Absolvido</option>";
				echo "</select>\r\n";
			form::closeLabel();
		closeTD();
		closeTR();
		
		openTR("rel='foicondenado$i'");
		openTD();
			form::openLabel("Pena");
				echo "<input size='2' type='text' name='envolvido[$i][ipm_pena_anos]'>anos ";
				echo "<input size='2' type='text' name='envolvido[$i][ipm_pena_meses]'> meses";
				echo "<input size='2' type='text' name='envolvido[$i][ipm_pena_dias]'> dias";
				echo "<input type='checkbox' name='envolvido[$i][ipm_transitojulgado_bl]'>Transitou em julgado";
			
			form::closeLabel();
		closeTD();
		openTD();
			form::openLabel("Tipo da pena");
				echo "<select name='envolvido[$i][ipm_tipodapena]'>";
					echo "<option value=''>Selecione</option>";
					echo "<option value='Detenção'>Detenção</option>";
					echo "<option value='Reclusão'>Reclusão</option>";
				echo "</select>\r\n";
			form::closeLabel();
		closeTD();
		openTD();
			form::openLabel("Restritiva de direito?");
				echo "<input type='checkbox' name='envolvido[$i][ipm_restritiva_bl]'>Convertida restritiva de direito";
			form::closeLabel();
		closeTD();
	closeTR();
	openTR();
		openTD("colspan='3'");
			form::input("Observacoes","envolvido[$i][obs_txt]");
		closeTD();
	closeTR();
	}
formulario::values($row,"envolvido[$i]");

$i++;
}
closeTable();

if (($user['nivel']>=2) && ($user['nivel']<>6 && $user['nivel']<>7))
echo "<input type='submit' name='acao' value='Atualizar'>";

formulario::values($$proc);

}//Fim L1

//L2 - Tem acao, grava os dados do formulario no banco de dados
else {
	
	//echo "aqui";
	
	
	//captura os envolvidos
	$vetorEnvolvidos=$_REQUEST['envolvido'];
	
	if ($vetorEnvolvidos) {
		$i=0;
		foreach ($vetorEnvolvidos as $elemento) {
			if (!$elemento['ipm_transitojulgado_bl']) $elemento['ipm_transitojulgado_bl']="0";
			if (!$elemento['ipm_restritiva_bl']) $elemento['ipm_restritiva_bl']="0";
			$$proc->envolvido[$i]=new envolvido();
			$$proc->envolvido[$i]->setValues($elemento,"","simples");
		$i++;
		}
		if ($_SESSION['debug']) pre($$proc);	
		
		//pre($$proc); die;
		
		if ($proc=="ipm") {
			if (ipm::atualiza($ipm)) echo "<h1>IPM atualizado com sucesso!</h1>";
		}
		if ($proc=="apfd") {
			if (apfd::atualiza($apfd)) echo "<h1>APFD atualizado com sucesso!</h1>";
		}
		if ($proc=="desercao") {
			if (desercao::atualiza($desercao)) echo "<h1>Deser&ccedil;&atilde;o atualizada com sucesso!</h1>";
		}
			
		echo "<a id='foco' href='?module=$proc&".$proc."[id]=".$$proc->$id."'>Clique aqui para voltar para o $proc</a>";
		echo "<script>document.foco.focus();</script>";
		
	}
}



if ($opcaoGeral=="readonly") js::desativaTudo();


?>
</form>
