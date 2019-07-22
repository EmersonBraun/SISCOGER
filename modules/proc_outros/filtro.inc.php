<?

//Campos padrao para serem mostrados na lista
if (!$_REQUEST['mostrar']) {
	$_REQUEST['mostrar']=Array("[0]" => "", "[1]" => "NRSJD" , "[2]" => "cdopm", "[3]" => "cdopm_apuracao", "[4]" => "sintese_txt", "[5]" => "cdopm_fato", "[6]" => "motivo_abertura", "[7]" => "doc_origem");
	//atribição vazia para o primeiro indice é para contornar um bug da paginação (consome o primeiro item na troca de página)
} else if ($opcao=="resultado") {
	$_REQUEST['mostrar']=Array("[0]" => "", "[1]" => "NRSJD" , "[2]" => "cdopm", "[3]" => "sintese_txt", "[4]" => "resultado");
}

$borda = ($opcao=="busca" or $opcao=="buscar")? '': 'border:none';
	echo "<form id='proc_outros' action='".$_SESSION['REQUEST_URI']."' method='POST'>";
	echo "<table width='100%' class='bordasimples' style='$borda'>";

form::openTR();
	form::openTD("colspan='5'");
		?>
		<?php if ($opcao=="busca" or $opcao=="buscar") { ?>
		<h2>Filtro
			<a href='#noplace' onclick="$('#linhafiltro1').show(); $('#linhafiltro2').show(); $('#linhafiltro3').show(); 
			$('#linhafiltro4').show();"><font size="2">+</font></a>
			<a href='#noplace' onclick="$('#linhafiltro1').hide(); $('#linhafiltro2').hide(); $('#linhafiltro3').hide(); 
			$('#linhafiltro4').hide();"><font size="2">-</font></a>
		
			&nbsp;&nbsp;&nbsp;Campos
			<a href='#noplace' onclick="$('#linhafiltro5').show();"><font size="2">+</font></a>
			<a href='#noplace' onclick='$("#linhafiltro5").hide();'><font size="2">-</font></a>

		</h2>
		<?php }
	form::closeTD();
form::closeTR();

form::openTR("id='linhafiltro1' style='display:none;'");
	form::openTD("width='20%'");
		form::openLabel("OPM (Abertura)");
		echo "<select id='foco' name='proc_outros[cdopm]' $opcaoGeral2>";
			include ("includes/option_opm.php");
		echo "</select>";
		form::closeLabel();
	form::closeTD();
	form::openTD("width='20%'");
		form::openLabel("OPM (Apura&ccedil;&atilde;o)");
		echo "<select id='foco' name='proc_outros[cdopm_apuracao]' $opcaoGeral2>";
			include ("includes/option_opm.php");
		echo "</select>";
		form::closeLabel();
	form::closeTD();
	form::openTD("width='60%'");
		form::openLabel("Data do fato");
			echo "De&nbsp; ";
			formulario::data("proc_outros","abertura_data_ini");
			calendario::cria(1,"proc_outros","proc_outros[abertura_data_ini]");
			echo "At&eacute;&nbsp; ";
			formulario::data("proc_outros","abertura_data_fim");
			calendario::cria(2,"proc_outros","proc_outros[abertura_data_fim]");
		form::closeLabel();
	form::closeTD();
form::closeTR();
	
openTR("id='linhafiltro2' style='display:none;'");
	form::openTD("width='33%'");
		//$opcoes="readonly";
		$textoForm="<select name=proc_outros[motivo_abertura] $opcaoGeral2>
		<option value=''></option>
		<option value='corrupcao'>Corrup&ccedil;&atilde;o</option>
		<option value='prevaricacao'>Prevarica&ccedil;&atilde;o</option>
		<option value='abuso de autoridade'>Abuso de autoridade</option>
		<option value='tortura'>Tortura</option>
		<option value='lesao corporal'>Les&atilde;o corporal</option>
		<option value='homicidio'>Homic&iacute;dio</option>
		<option value='trafico de drogas'>Tr&aacute;fico de drogas</option>
		<option value='uso de entorpecente'>Uso de entorpecente</option>
		<option value='improbidade administrativa'>Improbiedade administrativa</option>
		<option value='servico (bico)'>Servi&ccedil;o (Bico)</option>
		<option value='roubo / furto'>Roubo / Furto</option>
		<option value='caixa eletronico'>Caixa eletr&ocirc;nico</option>
		<option value='lei maria da penha'>Lei Maria da Penha</option>
		<option value='abordagem'>Abordagem</option>
		<option value='outros'>Outros</option>
		</select>";
		form::input("Motivo principal","",$textoForm);
	closeTD();
	openTD("width='33%'");
		form::openLabel("Cidade do fato");
			formulario::option("proc_outros","municipio","","","",0);
		form::closeLabel();
	closeTD();
closeTR();


openTR("id='linhafiltro3' style='display:none;'");
	form::openTD("width='33%'");
	//$opcoes="readonly";
		$textoForm="<select name=proc_outros[andamento]>
		<option value=''></option>
		<option value='abertura'>Abertura</option>
		<option value='em andamento'>Em andamento</option>
		<option value='concluido'>Conclu&iacute;do</option>
		</select>";
		form::input("Andamento","",$textoForm);
	closeTD();
	form::openTD("width='33%' colspan='2'");
		//$opcoes="readonly";
		$textoForm="<select name=proc_outros[andamentocoger]>
		<option value=''></option>
		<option value='unidade'>Unidade</option>
		<option value='arquivo'>Arquivo</option>
		<option value='COGER'>COGER</option>
		<option value='poder judiciario'>Poder Judici&aacute;rio</option>
		<option value='ministerio publico'>Minist&eacute;rio P&uacute;blico</option>
		<option value='outros orgaos'>Outros Org&atilde;os</option>
		</select>";
		form::input("Andamento COGER","",$textoForm);
	closeTD();
	form::openTD("width='33%'");
		//$opcoes="readonly";
		$textoForm="<select name=proc_outros[doc_origem] $opcaoGeral2>
		<option value=''>-</option>
		<option value='audiencia de custodia'>Audi&ecirc;ncia de cust&oacute;dia</option>
		<option value='noticia de fato'>Not&iacute;cia de fato</option>
		<option value='pedido de providencia'>Pedido de provid&ecirc;ncia</option>
		<option value='outros'>Outros</option>
		</select>";
		form::input("Doc. Origem","",$textoForm);
	closeTD();
closeTR();


openTR("id='linhafiltro4' style='display:none;'");
	form::openTD("width='33%'");
		form::input("Placa da viatura (sem tra&ccedil;o)","proc_outros[vtr1_placa]");
	form::closeTD();
	form::openTD("width='33%'");
		form::input("Prefixo da viatura","proc_outros[vtr1_prefixo]");
	form::closeTD();
	openTD("width='33%'");
		form::openLabel("Acao");
		echo "<input type='submit' value='listar' name='$opcao'>";
		form::closeLabel();
	closeTD();
closeTR();



openTR("id='linhafiltro5' style='display:none;'");
		openTD("colspan='3'");
			form::openLabel("Campos a serem mostrados");
			
			//$vetor=Array();
			//$vetor[0]["nome"]="mostrar[]";
			
			//echo "<form action='' method='POST'>\r\n";
			
			$mostrar=$_REQUEST['mostrar'];

			echo checkbox("mostrar[]","NRSJD","N&ordm; sjd",$mostrar);
			echo checkbox("mostrar[]","cdopm","OPM (abertura)",$mostrar);
			echo checkbox("mostrar[]","cdopm_apuracao","OPM (apura&ccedil;&atilde;o)",$mostrar);
			echo checkbox("mostrar[]","sintese_txt","Sintese do fato",$mostrar);
			echo checkbox("mostrar[]","motivo_abertura","Motivo",$mostrar);
			echo checkbox("mostrar[]","municipio","Cidade.",$mostrar);
			echo checkbox("mostrar[]","placa","Placa",$mostrar);
			echo checkbox("mostrar[]","prefixo","Prefixo",$mostrar);
			echo checkbox("mostrar[]","andamento","Andamento",$mostrar);
			echo checkbox("mostrar[]","andamentocoger","Andamento COGER",$mostrar);
			echo checkbox("mostrar[]","data","Data Fato",$mostrar);
			echo checkbox("mostrar[]","abertura_data","Data Abertura",$mostrar);
			echo checkbox("mostrar[]","andamentocoger","And. COGER",$mostrar);
			//echo checkbox("mostrar[]","resultado","Resultado",$mostrar);
			

			echo "<br>
			<input type='submit' name='noname' value='Atualizar'>
			</form>";
			form::closeLabel();
		closeTD();
closeTR();
echo "</table>";
echo "</form>";
$espaco = ($opcao=="busca" or $opcao=="buscar")? '</br>': '';
echo "$espaco";

formulario::values($proc_outros);


?>