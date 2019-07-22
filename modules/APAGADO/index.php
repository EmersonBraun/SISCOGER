<?php
$APAGADO=new APAGADO();
$posto=$_REQUEST['posto'];
if ($_REQUEST['APAGADO']['id']) $opcao="atualizar";
$APAGADO->setValues($_REQUEST['APAGADO']);
if ($_SESSION['debug']) { echo "<pre>";print_r($APAGADO); echo "</pre>"; }	

if (!$opcao) $opcao="cadastrar";
if (strtolower($acao)=="cadastrar") $opcao="cadastrar";
if (strtolower($acao)=="atualizar") $opcao="atualizar";

if (strtolower($opcao)=="cadastrar")  {
	if (strtolower($acao)=="cadastrar") {
		APAGADO::insere($APAGADO);
		echo "<h2>APAGADO cadastrado com sucesso!</h2>";
		echo "<a id='foco' href='?module=APAGADO&opcao=listar'>Clique aqui para voltar.</a>";
	}
	else {
		include ("menu.inc.php");
		include ("formulario.inc.php");
	}
}
elseif (strtolower($opcao)=="atualizar") {
	if (strtolower($acao)=="atualizar") {
		if (APAGADO::atualiza($APAGADO)) {
			echo "<h2>APAGADO atualizado com sucesso!</h2>";
			echo "<a id='foco' href='?module=APAGADO&opcao=listar'>Clique aqui para voltar.</a>";
		}
		else {
			echo "Houve um problema durante a execução da solicitação!";
		}
	}
	else {
		include ("menu.inc.php");
		include ("formulario.inc.php");
	}
}
elseif ($opcao=="lista" or $opcao=="listar") {
       include ("lista.inc.php");
}
elseif ($opcao=="apagar") {
	if (APAGADO::apaga($APAGADO)) {
		echo "<h2>APAGADO apagado com sucesso!</h2>";
		echo "<a id='foco' href='?module=APAGADO&opcao=listar'>Clique aqui para voltar à lista</a>";
	}
	else {
		echo "Houve um problema durante a execução da solicitação!";
	}
}
elseif ($opcao) {
	include ("$opcao.php");
}
?>
<script language='javascript'>document.getElementById('foco').focus()</script>

