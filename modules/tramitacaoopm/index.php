<?php

$tramitacaoopm=new tramitacaoopm();
$posto=$_REQUEST['posto'];

if ($_REQUEST['tramitacaoopm']['id'] and !$opcao) $opcao="atualizar";

$tramitacaoopm->setValues($_REQUEST['tramitacaoopm']);
if ($_SESSION['debug']) { echo "<pre>";print_r($tramitacao); echo "</pre>"; }

if (strtolower($acao)=="cadastrar") $opcao="cadastrar";
if (strtolower($acao)=="atualizar") $opcao="atualizar";

if (strtolower($opcao)=="cadastrar")  {
	if (strtolower($acao)=="cadastrar") {
		tramitacaoopm::insere($tramitacaoopm);
		echo "<h2>Tramitacao OPM cadastrada com sucesso!</h2>";
		echo "<a id='foco' onclick='retornarAtualizar(this)' href='#'>Clique aqui para voltar.</a>";
	}
	else {
		include ("formulario.inc.php");
	}
}
elseif (strtolower($opcao)=="atualizar") {
	if (strtolower($acao)=="atualizar") {
		if (tramitacaoopm::atualiza($tramitacaoopm)) {
			echo "<h2>Tramitacao atualizada com sucesso!</h2>";
			echo "<a id='foco' onclick='retornarAtualizar(this)' href='#'>Clique aqui para voltar.</a>";
		}
		else {
			echo "Houve um problema durante a execução da solicitação!";
		}
	}
	else {
		//include ("menu.inc.php");
		include ("formulario.inc.php");
	}
}
elseif ($opcao=="lista" or $opcao=="listar") {
       include ("lista.inc.php");
}
elseif ($opcao=="apagar") {
	if (tramitacaoopm::apaga($tramitacaoopm)) {
		echo "<h2>Tramitacao apagada com sucesso!</h2>";
		echo "<a id='foco' onclick='retornarAtualizar(this)' href='#'>Clique aqui para voltar.</a>";
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

