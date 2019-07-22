<?
//header('Content-Type: text/html; charset=utf-8');

//include ("menu.inc");

//Campos padrao para serem mostrados na lista
if (!$_REQUEST['mostrar']) {
	$_REQUEST['mostrar']=Array("[0]" => "", "[1]" => "NRSJD","NROPM", "[2]" => "objetoprocedimento", "[3]" => "descricao");
	//atribiç&#771o vazia para o primeiro indice é para contornar um bug da paginaç&#771o (consome o primeiro item na troca de página)

}

$borda = ($opcao=="busca" or $opcao=="buscar")? '': 'border:none';
	echo "<form id='it' action='".$_SESSION['REQUEST_URI']."' method='POST'>";
	echo "<table width='100%' class='bordasimples' style='$borda'>";

form::openTR();
	form::openTD("colspan='5'");
		?>
		<?php if ($opcao=="busca" or $opcao=="buscar") { ?>
		<h2>Filtro
			<a href='#noplace' onclick="$('#linhafiltro1').show(); $('#linhafiltro2').show(); $('#linhafiltro3').show(); 
			$('#linhafiltro4').show();">+</a>
			<a href='#noplace' onclick="$('#linhafiltro1').hide(); $('#linhafiltro2').hide(); $('#linhafiltro3').hide(); 
			$('#linhafiltro4').hide();">-</a>
		
			&nbsp;&nbsp;&nbsp;Campos
			<a href='#noplace' onclick="$('#linhafiltro5').show();">+</a>
			<a href='#noplace' onclick='$("#linhafiltro5").hide();'>-</a>

			<form action="modules/it/export_excel.php" target="_blank" id="excel">
			<!--<input type="text" name="sql" value="<?php var_dump($sql) ?>">
			<input type="text" name="mostrar" value="<?php var_dump($mostrar) ?>">
			<input type="button" style="float: right" value="Exportar para Excel" onclick="exportaExcel()" id="exportBotton">-->
			</form>
		</h2>
		<?php }
	form::closeTD();
form::closeTR();

form::openTR("id='linhafiltro1' style='display:none;'");
	form::openTD("colspan='1' width='33%'");
		form::openLabel("OPM");
			echo "<select name=it[cdopm_st]>";
			include ("includes/option_opm.php");
			echo "</select>";
		form::closeLabel();
	form::closeTD();
	openTD("colspan='1' width='33%'");
		$textoForm="<select name=it[objetoprocedimento] $opcaoGeral2>
	<option value=''></option>
	<option value='viatura'>Viatura</option>
	<option value='arma'>Arma</option>
	<option value='municao'>Muni&ccedil;a&#771;o</option>
	<option value='semovente'>Semovente</option>
	<option value='outros'>Outros</option>
	</select>";
	form::input("Objeto Procedimento","",$textoForm);
	closeTD("colspan='1' width='33%'");
	form::openTD();
		form::openLabel("Data do fato");
			echo "De&nbsp; ";
			formulario::data("it","fato_data_ini");
			calendario::cria(1,"it","it[fato_data_ini]");
			echo "At&eacute;&nbsp; ";
			formulario::data("it","fato_data_fim");
			calendario::cria(2,"it","it[fato_data_fim]");
		form::closeLabel();
	form::closeTD();
	
closeTR();
openTR("id='linhafiltro2' style='display:none;'");
	openTD("colspan='1' width='33%'");
		$textoForm="<select name=it[acordoamigavel] $opcaoGeral2>
	<option value=''></option>
	<option value='S'>Sim</option>
	<option value='N'>Na&#771;o</option>
	</select>";
	form::input("Ressarcimento Extrajudicial","",$textoForm);
	closeTD();
	openTD("colspan='1' width='33%'");
		form::openLabel("Causa do acidente");
			formulario::option("it","causa_acidente","","",0,0);
		form::closeLabel();
	closeTD();
	openTD("colspan='1' width='33%'");
		$textoForm="<select name=it[situacaoviatura] $opcaoGeral2>
	<option value=''></option>
	<option value='nao informado'>Na&#771;o informado</option>
	<option value='consertada com onus'>Consertada com &ocirc;nus</option>
	<option value='consertada sem onus'>Consertada sem &ocirc;nus</option>
	<option value='inservivel'>Inserv&iacute;vel</option>
	<option value='aguarda conserto'>Aguarda conserto</option>
	</select>";
	form::input("Situa&ccedil;a&#771;o Viatura","",$textoForm);
	closeTD();
closeTR();

openTR("id='linhafiltro3' style='display:none;'");
	form::openTD("colspan='1' width='33%'");
		$textoForm="<select name=it[acaojudicial] 
		$opcaoGeral2><option value=''></option>
		<option value='S'>Sim</option>
		<option value='N'>Na&#771;o</option>
		</select>";
		form::input("Responsabilidade civil","",$textoForm);
	form::closeTD();
	form::openTD("colspan='1' width='33%'");
		$textoForm="<select name=it[acaojudicial] 
		$opcaoGeral2><option value=''></option>
		<option value='S'>Sim</option>
		<option value='N'>Na&#771;o</option>
		</select>";
		form::input("A&ccedil;a&#771;o judicial","",$textoForm);
	form::closeTD();
	form::openTD("colspan='1' width='33%'");
		form::input("Valor do dano estimado","it[danoestimado_rs]");
	form::closeTD();
form::closeTR();

form::openTR("id='linhafiltro4' style='display:none;'");
	form::openTD("colspan='1' width='33%'");
		$textoForm="<select name=it[tipo_acidente] $opcaoGeral2>
		<option value=''></option>
		<option value='nao identificado'>N&atilde;o identificado</option>
		<option value='abalroamento lateral'>Abalroamento lateral</option>
		<option value='abalroamento transversal'>Abalroamento transversal</option>
		<option value='atropelamento'>Atropelamento</option>
		<option value='atropelamento de animal'>Atropelamento de animal</option>
		<option value='capotamento'>Capotamento</option>
		<option value='colisao frontal'>Colis&atilde;o frontal</option>
		<option value='colisao traseira'>Colis&atilde;o traseira</option>
		<option value='choque'>Choque</option>
		<option value='engavetamento'>Engavetamento</option>
		<option value='incendio'>Inc&ecirc;ndio</option>
		<option value='queda de passageiro'>Queda de passageiro</option>
		<option value='queda de objeto'>Queda de objeto</option>
		<option value='queda de moto'>Queda de moto</option>
		<option value='queda de veiculo'>Queda de ve&iacute;culo</option>
		<option value='tombamento'>Tombamento</option>
		<option value='acidente complexo'>Acidente complexo</option>
		<option value='nao identificado'>N&atilde;o identificado</option>
		</select>";
		form::input("Tipo de acidente","",$textoForm);
	closeTD();
	openTD("colspan='1'");
		form::openLabel("Andamento COGER");
			formulario::option("it","andamentocoger","WHERE procedimento='it'","",0,0);
		form::closeLabel();
	form::closeTD();
	openTD("colspan='1'");
		form::openLabel("Acao");
		echo "<input type='submit' value='listar' name='$opcao'>";
		form::closeLabel();
	closeTD();
form::closeTR();

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
			echo checkbox("mostrar[]","objetoprocedimento","Objeto Procedimento",$mostrar);
			echo checkbox("mostrar[]","acordoamigavel","Ressarc. Extrajud.",$mostrar);
			echo checkbox("mostrar[]","causa_acidente","Causa acidente",$mostrar);
			echo checkbox("mostrar[]","situacaoviatura","Situa&ccedil;a&#771;o viatura",$mostrar);
			echo checkbox("mostrar[]","resp_civil","Respons. civil",$mostrar);
			echo checkbox("mostrar[]","acaojudicial","A&ccedil;a&#771;o judicial",$mostrar);
			echo "</br>";
			echo checkbox("mostrar[]","danoreal_rs","Valor do dano",$mostrar);
			echo checkbox("mostrar[]","tipo_acidente","Tipo de acidente",$mostrar);
			echo checkbox("mostrar[]","andamento","Andamento",$mostrar);
			echo checkbox("mostrar[]","fato_data","Data Fato",$mostrar);
			echo checkbox("mostrar[]","andamentocoger","And. COGER",$mostrar);
			?>
			<br><input type='submit' name='noname' value='Atualizar'>	
			</form>
			<?php
			form::closeLabel();
		closeTD();
closeTR();
echo "</table>";
echo "</form>";
$espaco = ($opcao=="busca" or $opcao=="buscar")? '</br>': '';
echo "$espaco";

formulario::values($it);


?>