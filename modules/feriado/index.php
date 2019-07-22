<?php
$feriado=new feriado();
$posto=$_REQUEST['posto'];
if ($_REQUEST['feriado']['id']) $opcao="atualizar";
$feriado->setValues($_REQUEST['feriado']);
if ($_SESSION['debug']) { echo "<pre>";print_r($feriado); echo "</pre>"; }	

if (!$opcao) $opcao="listar";
if (strtolower($acao)=="cadastrar") $opcao="cadastrar";
if (strtolower($acao)=="atualizar") $opcao="atualizar";

if (strtolower($opcao)=="cadastrar")  {
	if (strtolower($acao)=="cadastrar") {
		feriado::insere($feriado);
		echo "<h2>Feriado cadastrado com sucesso!</h2>";
		echo "<a id='foco' href='?module=feriado&opcao=listar'>Clique aqui para voltar.</a>";
	}
	else {
		include ("menu.inc.php");
		include ("formulario.inc.php");
	}
}
elseif (strtolower($opcao)=="atualizar") {
	if (strtolower($acao)=="atualizar") {
		if (feriado::atualiza($feriado)) {
			echo "<h2>Feriado atualizado com sucesso!</h2>";
			echo "<a id='foco' href='?module=feriado&opcao=listar'>Clique aqui para voltar.</a>";
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
	if (feriado::apaga($feriado)) {
		echo "<h2>Feriado apagado com sucesso!</h2>";
		echo "<a id='foco' href='?module=feriado&opcao=listar'>Clique aqui para voltar à lista</a>";
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

