<?php
mysql_select_db("sjd");

$recurso=new recurso();
$posto=$_REQUEST['posto'];
if ($_REQUEST['recurso']['id']) $opcao="atualizar";
$recurso->setValues($_REQUEST['recurso']);
if ($_SESSION['debug']) { echo "<pre>";print_r($recurso); echo "</pre>"; }	

if (!$opcao) $opcao="cadastrar";
if (strtolower($acao)=="cadastrar") $opcao="cadastrar";
if (strtolower($acao)=="atualizar") $opcao="atualizar";

if (strtolower($opcao)=="cadastrar")  {
	if (strtolower($acao)=="cadastrar") {
		recurso::insere($recurso);
		echo "<h2>recurso cadastrado com sucesso!</h2>";
		echo "<a id='foco' href='?module=recurso&opcao=listar'>Clique aqui para voltar.</a>";
	}
	else {
		include ("menu.inc.php");
		include ("formulario.inc.php");
	}
}
elseif (strtolower($opcao)=="atualizar") {
	if (strtolower($acao)=="atualizar") {
		if (recurso::atualiza($recurso)) {
			echo "<h2>recurso atualizado com sucesso!</h2>";
			echo "<a id='foco' href='?module=recurso&opcao=listar'>Clique aqui para voltar.</a>";
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
	if (recurso::apaga($recurso)) {
		echo "<h2>recurso apagado com sucesso!</h2>";
		echo "<a id='foco' href='?module=recurso&opcao=listar'>Clique aqui para voltar à lista</a>";
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

