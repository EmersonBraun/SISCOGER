<?php
$novomodulo=new novomodulo();
$posto=$_REQUEST['posto'];
if ($_REQUEST['novomodulo']['id']) $opcao="atualizar";
$novomodulo->setValues($_REQUEST['novomodulo']);
if ($_SESSION['debug']) { echo "<pre>";print_r($novomodulo); echo "</pre>"; }	

if (!$opcao) $opcao="cadastrar";
if (strtolower($acao)=="cadastrar") $opcao="cadastrar";
if (strtolower($acao)=="atualizar") $opcao="atualizar";

if (strtolower($opcao)=="cadastrar")  {
	if (strtolower($acao)=="cadastrar") {
		novomodulo::insere($novomodulo);
		echo "<h2>nomelegivel cadastrado com sucesso!</h2>";
		echo "<a id='foco' href='?module=novomodulo&opcao=listar'>Clique aqui para voltar.</a>";
	}
	else {
		include ("menu.inc.php");
		include ("formulario.inc.php");
	}
}
elseif (strtolower($opcao)=="atualizar") {
	if (strtolower($acao)=="atualizar") {
		if (novomodulo::atualiza($novomodulo)) {
			echo "<h2>nomelegivel atualizado com sucesso!</h2>";
			echo "<a id='foco' href='?module=novomodulo&opcao=listar'>Clique aqui para voltar.</a>";
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
	if (novomodulo::apaga($novomodulo)) {
		echo "<h2>nomelegivel apagado com sucesso!</h2>";
		echo "<a id='foco' href='?module=novomodulo&opcao=listar'>Clique aqui para voltar à lista</a>";
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

