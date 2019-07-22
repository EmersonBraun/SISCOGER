<?php
$exclusaojudicial=new exclusaojudicial();
$posto=$_REQUEST['posto'];
if ($_REQUEST['exclusaojudicial']['id']) $opcao="atualizar";
$exclusaojudicial->setValues($_REQUEST['exclusaojudicial']);
if ($_SESSION['debug']) { echo "<pre>";print_r($exclusaojudicial); echo "</pre>"; }	

if (!$opcao) $opcao="cadastrar";
if (strtolower($acao)=="cadastrar") $opcao="cadastrar";
if (strtolower($acao)=="atualizar") $opcao="atualizar";

if (strtolower($opcao)=="cadastrar")  {
	if (strtolower($acao)=="cadastrar") {
		exclusaojudicial::insere($exclusaojudicial);
		echo "<h2>exclusaojudicial cadastrado com sucesso!</h2>";
		echo "<a id='foco' href='?module=exclusaojudicial&opcao=listar'>Clique aqui para voltar.</a>";
	}
	else {
		include ("menu.inc.php");
		include ("formulario.inc.php");
	}
}
elseif (strtolower($opcao)=="atualizar") {
	if (strtolower($acao)=="atualizar") {
		if (exclusaojudicial::atualiza($exclusaojudicial)) {
			echo "<h2>exclusaojudicial atualizado com sucesso!</h2>";
			echo "<a id='foco' href='?module=exclusaojudicial&opcao=listar'>Clique aqui para voltar.</a>";
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
	if (exclusaojudicial::apaga($exclusaojudicial)) {
		echo "<h2>exclusaojudicial apagado com sucesso!</h2>";
		echo "<a id='foco' href='?module=exclusaojudicial&opcao=listar'>Clique aqui para voltar à lista</a>";
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

