<?php
$restricao=new restricao();
$posto=$_REQUEST['posto'];
if ($_REQUEST['restricao']['id'] and !$opcao) $opcao="atualizar";
$restricao->setValues($_REQUEST['restricao']);
if ($_SESSION['debug']) { echo "<pre>";print_r($restricao); echo "</pre>"; }	

if (!$opcao) $opcao="cadastrar";
if (strtolower($acao)=="cadastrar") $opcao="cadastrar";
if (strtolower($acao)=="atualizar") $opcao="atualizar";

if (strtolower($opcao)=="cadastrar")  {
	if (strtolower($acao)=="cadastrar") {
		if ($restricao->fim_data) $restricao->retirada_data=$restricao->cadastro_data;

		restricao::insere($restricao);
		echo "<h2>Restricao cadastrada com sucesso!</h2>";
			echo "<a id='foco' onclick='retornarAtualizar(this)' href='#'>Clique aqui para voltar.</a>";
	}
	else {
		include ("menu.inc.php");
		include ("formulario.inc.php");
	}
}
elseif (strtolower($opcao)=="atualizar") {
	if (strtolower($acao)=="atualizar") {
		if (restricao::atualiza($restricao)) {
			echo "<h2>restricao atualizado com sucesso!</h2>";
			echo "<a id='foco' href='?module=restricao&opcao=listar'>Clique aqui para voltar.</a>";
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
	if (restricao::apaga($restricao)) {
		echo "<h2>restricao apagado com sucesso!</h2>";
		echo "<a id='foco' href='?module=restricao&opcao=listar'>Clique aqui para voltar à lista</a>";
	}
	else {
		echo "Houve um problema durante a execução da solicitação!";
	}
}
elseif ($opcao=="retirar") {
	if (!$acao)
	include ("$opcao.php");
	else {
		if (restricao::atualiza($restricao)) {
			echo "<h2>Restricao retirada com sucesso!</h2>";
			echo "<a id='foco' onclick='retornarAtualizar(this)' href='#'>Clique aqui para voltar.</a>";
		}
	}
}


?>
<script language='javascript'>document.getElementById('foco').focus()</script>

