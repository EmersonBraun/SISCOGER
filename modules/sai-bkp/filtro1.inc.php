<?

//Campos padrao para serem mostrados na lista
if (!$_REQUEST['mostrar']) {
	$_REQUEST['mostrar']=Array("[0]" => "", "[1]" => "NRSJD" , "[2]" => "NROPM", "[3]" => "sintese_txt", "[4]" => "cdopm_fato", "[5]" => "motivo_principal");
	//atribição vazia para o primeiro indice é para contornar um bug da paginação (consome o primeiro item na troca de página)
} else if ($opcao=="resultado") {
	$_REQUEST['mostrar']=Array("[0]" => "", "[1]" => "NRSJD" , "[2]" => "NROPM", "[3]" => "sintese_txt", "[4]" => "resultado");
}

$borda = ($opcao=="busca" or $opcao=="buscar")? '': 'border:none';
	echo "<form id='sai' action='".$_SESSION['REQUEST_URI']."' method='POST'>";
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
	form::openTD("width='33%'");
		form::openLabel("OPM (Local do fato)");
		echo "<select id='foco' name='sai[cdopm_fato]' $opcaoGeral2>";
			include ("includes/option_opm.php");
		echo "</select>";
		form::closeLabel();
	form::closeTD();
	form::openTD("width='33%'");
		form::openLabel("OPM (Apura&ccedil;&atilde;o)");
		echo "<select id='foco' name='sai[cdopm_controle]' $opcaoGeral2>";
			include ("includes/option_opm.php");
		echo "</select>";
		form::closeLabel();
	form::closeTD();
	form::openTD("width='33%'");
		form::openLabel("Data do fato");
			echo "De&nbsp; ";
			formulario::data("sai","fato_data_ini");
			calendario::cria(1,"sai","sai[fato_data_ini]");
			echo "At&eacute;&nbsp; ";
			formulario::data("sai","fato_data_fim");
			calendario::cria(2,"sai","sai[fato_data_fim]");
		form::closeLabel();
	form::closeTD();
form::closeTR();
	
closeTR();
openTR("id='linhafiltro2' style='display:none;'");
	form::openTD("width='33%'");
		//$opcoes="readonly";
		$textoForm="<select name=sai[motivo_principal] $opcaoGeral2>
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
			formulario::option("sai","municipio","","","",0);
		form::closeLabel();
	closeTD();
	openTD("width='33%'");
		form::openLabel("Andamento COGER");
			formulario::option("sai","andamentocoger","WHERE procedimento='sai'","",0,0);
		form::closeLabel();		
	closeTD();
closeTR();


openTR("id='linhafiltro4' style='display:none;'");
	form::openTD("width='33%'");
		form::input("Placa da viatura (sem tra&ccedil;o)","sai[vtr1_placa]");
	form::closeTD();
	form::openTD("width='33%'");
		form::input("Prefixo da viatura","sai[vtr1_prefixo]");
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
			echo checkbox("mostrar[]","NROPM","N&ordm; OPM",$mostrar);
			echo checkbox("mostrar[]","sintese_txt","Sintese do fato",$mostrar);
			echo checkbox("mostrar[]","motivo_principal","Motivo",$mostrar);
			echo checkbox("mostrar[]","municipio","Cidade.",$mostrar);
			echo checkbox("mostrar[]","placa","Placa",$mostrar);
			echo checkbox("mostrar[]","prefixo","Prefixo",$mostrar);
			echo checkbox("mostrar[]","andamento","Andamento",$mostrar);
			echo checkbox("mostrar[]","fato_data","Data Fato",$mostrar);
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

formulario::values($sai);


?>