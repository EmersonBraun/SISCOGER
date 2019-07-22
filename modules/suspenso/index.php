<?php
$suspenso=new suspenso();
$posto=$_REQUEST['posto'];
if ($_REQUEST['suspenso']['id']) $opcao="atualizar";
$suspenso->setValues($_REQUEST['suspenso']);
if ($_SESSION['debug']) { echo "<pre>";print_r($suspenso); echo "</pre>"; }	

if (!$opcao) $opcao="cadastrar";
if (strtolower($acao)=="cadastrar") $opcao="cadastrar";
if (strtolower($acao)=="atualizar") $opcao="atualizar";

if (strtolower($opcao)=="cadastrar")  {
	if (strtolower($acao)=="cadastrar") {
		suspenso::insere($suspenso);
		echo "<h2>suspenso cadastrado com sucesso!</h2>";
		echo "<a id='foco' href='?module=suspenso&opcao=listar'>Clique aqui para voltar.</a>";
	}
	else {
		include ("menu.inc.php");
		include ("formulario.inc.php");
	}
}
elseif (strtolower($opcao)=="atualizar") {
	if (strtolower($acao)=="atualizar") {
		if (suspenso::atualiza($suspenso)) {
			echo "<h2>suspenso atualizado com sucesso!</h2>";
			echo "<a id='foco' href='?module=suspenso&opcao=listar'>Clique aqui para voltar.</a>";
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
	if (suspenso::apaga($suspenso)) {
		echo "<h2>suspenso apagado com sucesso!</h2>";
		echo "<a id='foco' href='?module=suspenso&opcao=listar'>Clique aqui para voltar à lista</a>";
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

