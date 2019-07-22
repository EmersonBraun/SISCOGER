<?php
$reintegrado=new reintegrado();
$posto=$_REQUEST['posto'];
if ($_REQUEST['reintegrado']['id']) $opcao="atualizar";
$reintegrado->setValues($_REQUEST['reintegrado']);
if ($_SESSION['debug']) { echo "<pre>";print_r($reintegrado); echo "</pre>"; }	

if (!$opcao) $opcao="cadastrar";
if (strtolower($acao)=="cadastrar") $opcao="cadastrar";
if (strtolower($acao)=="atualizar") $opcao="atualizar";

if (strtolower($opcao)=="cadastrar")  {
	if (strtolower($acao)=="cadastrar") {
		reintegrado::insere($reintegrado);
		echo "<h2>reintegrado cadastrado com sucesso!</h2>";
		echo "<a id='foco' href='?module=reintegrado&opcao=listar'>Clique aqui para voltar.</a>";
	}
	else {
		include ("menu.inc.php");
		include ("formulario.inc.php");
	}
}
elseif (strtolower($opcao)=="atualizar") {
	if (strtolower($acao)=="atualizar") {
		if (reintegrado::atualiza($reintegrado)) {
			echo "<h2>reintegrado atualizado com sucesso!</h2>";
			echo "<a id='foco' href='?module=reintegrado&opcao=listar'>Clique aqui para voltar.</a>";
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
	if (reintegrado::apaga($reintegrado)) {
		echo "<h2>reintegrado apagado com sucesso!</h2>";
		echo "<a id='foco' href='?module=reintegrado&opcao=listar'>Clique aqui para voltar à lista</a>";
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

