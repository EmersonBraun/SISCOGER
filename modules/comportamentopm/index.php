<?php

$comportamentopm=new comportamentopm();
$posto=$_REQUEST['posto'];

if ($_REQUEST['comportamentopm']['id'] and !$opcao) $opcao="atualizar";

$comportamentopm->setValues($_REQUEST['comportamentopm']);
if ($_SESSION['debug']) pre($comportamentopm);

if (strtolower($acao)=="cadastrar") $opcao="cadastrar";
if (strtolower($acao)=="atualizar") $opcao="atualizar";

if (strtolower($opcao)=="cadastrar")  {
	if (strtolower($acao)=="cadastrar") {
		comportamentopm::insere($comportamentopm);
		echo "<h2>Comportamento cadastrado com sucesso!</h2>";
		echo "<a id='foco' onclick='retornarAtualizar(this)' href='#'>Clique aqui para voltar.</a>";
	}
	else {
		include ("formulario.inc.php");
	}
}
elseif (strtolower($opcao)=="atualizar") {
	if (strtolower($acao)=="atualizar") {
		if (comportamentopm::atualiza($comportamentopm)) {
			echo "<h2>Comportamento atualizado com sucesso!</h2>";
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
	if (comportamentopm::apaga($comportamentopm)) {
		echo "<h2>Comportamento apagado com sucesso!</h2>";
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

