<?php
$preso_outros=new preso_outros();
if ($_REQUEST['preso_outros']['id']) $opcao="atualizar";
$preso_outros->setValues($_REQUEST['preso_outros']);
if ($_SESSION['debug']) { echo "<pre>";print_r($preso_outros); echo "</pre>"; }	

if (!$opcao) $opcao="cadastrar";
if (strtolower($acao)=="cadastrar") $opcao="cadastrar";
if (strtolower($acao)=="atualizar") $opcao="atualizar";

if (strtolower($opcao)=="cadastrar")  {
	if (strtolower($acao)=="cadastrar") {
		preso_outros::insere($preso_outros);
		echo "<h2>Preso cadastrado com sucesso!</h2>";
		echo "<a id='foco' href='?module=preso_outros&opcao=listar'>Clique aqui para voltar.</a>";
	}
	else {
		include ("menu.inc.php");
		include ("formulario.inc.php");
	}
}
elseif (strtolower($opcao)=="atualizar") {
	if (strtolower($acao)=="atualizar") {
		if (preso_outros::atualiza($preso_outros)) {
			echo "<h2>Preso atualizado com sucesso!</h2>";
			echo "<a id='foco' href='?module=preso_outros&opcao=listar'>Clique aqui para voltar.</a>";
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
	if (preso_outros::apaga($preso_outros)) {
		echo "<h2>Preso apagado com sucesso!</h2>";
		echo "<a id='foco' href='?module=preso_outros&opcao=listar'>Clique aqui para voltar à lista</a>";
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

