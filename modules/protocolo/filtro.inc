<?
include ("menu.inc.php");

//Campos padrao para serem mostrados na lista
if (!$_REQUEST['mostrar']) {
	$_REQUEST['mostrar']=Array("[0]" => "","id_protocolo","numero", "descricao_txt", "rg","rg_autor","rg_analista","obs");
	//atribiç&#771o vazia para o primeiro indice é para contornar um bug da paginaç&#771o (consome o primeiro item na troca de página)

}

echo "<form id='protocolo' action='".$_SESSION['REQUEST_URI']."' method='POST'>";
echo "<table width='100%' class='bordasimples'>";

form::openTR();
	form::openTD("colspan='5'");
		?>
		<h2>Filtro
			<a href='#noplace' onclick="$('#linhafiltro1').show(); $('#linhafiltro2').show(); $('#linhafiltro3').show();">+</a>
			<a href='#noplace' onclick="$('#linhafiltro1').hide(); $('#linhafiltro2').hide(); $('#linhafiltro3').hide();">-</a>
		
			&nbsp;&nbsp;&nbsp;Campos
			<a href='#noplace' onclick="$('#linhafiltro4').show();">+</a>
			<a href='#noplace' onclick='$("#linhafiltro4").hide();'>-</a>
		</h2>
		<?php 
	form::closeTD();
form::closeTR();
form::openTR("id='linhafiltro1' style='display:none;'");
	form::openTD("colspan='1' width='33%'");
		form::input("N&ordm; registro","protocolo[id_protocolo]");
	form::closeTD();
	form::openTD("colspan='1' width='33%'");
		form::input("N&ordm; e-proc","protocolo[numero]");
	form::closeTD();
	form::openTD("colspan='1' width='33%'");
		form::input("Descri&ccedil;&atilde;o","protocolo[descricao_txt]");
	form::closeTD();	
closeTR();
openTR("id='linhafiltro2' style='display:none;'");
	form::openTD("colspan='1' width='33%'");
		form::input("RG envolvido","protocolo[rg]");
	form::closeTD();
	form::openTD("colspan='1' width='33%'");
		form::input("RG Cadastro","protocolo[rg_autor]");
	form::closeTD();
	form::openTD("colspan='1' width='33%'");
		form::input("Descri&ccedil;&atilde;o","protocolo[rg_analista]");
	form::closeTD();
closeTR();
openTR("id='linhafiltro3' style='display:none;'");
	openTD();
		form::openLabel("Acao");
		echo "<input type='submit' name='acao' value='".ucwords($opcao)."'>";
		form::closeLabel();
	closeTD();
closeTR();
openTR("id='linhafiltro4' style='display:none;'");
		openTD("colspan='3'");
			form::openLabel("Campos a serem mostrados");
			
			//$vetor=Array();
			//$vetor[0]["nome"]="mostrar[]";
			
			//echo "<form action='' method='POST'>\r\n";

			$mostrar=$_REQUEST['mostrar'];

			echo checkbox("mostrar[]","id_protocolo","N&ordm; registro",$mostrar);
			echo checkbox("mostrar[]","numero","N&ordm; e-proc",$mostrar);
			echo checkbox("mostrar[]","descricao_txt","Descri&ccedil;&atilde;o",$mostrar);
			echo checkbox("mostrar[]","rg","RG envolvido",$mostrar);
			echo checkbox("mostrar[]","rg_autor","RG Cadastro",$mostrar);
			echo checkbox("mostrar[]","rg_analista","RG Analista",$mostrar);
			echo checkbox("mostrar[]","obs","Causa acidente",$mostrar);
			?>
			<br><input type='submit' name='noname' value='Atualizar'>	
			</form>
			<?php
			form::closeLabel();
		closeTD();
closeTR();
echo "</table>";
echo "</form>";

formulario::values($protocolo);

?>
