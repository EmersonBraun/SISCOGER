<?php

$tramitacao=new tramitacao();
$posto=$_REQUEST['posto'];

if ($_REQUEST['tramitacao']['id'] and !$opcao) $opcao="atualizar";

$tramitacao->setValues($_REQUEST['tramitacao']);
if ($_SESSION['debug']) { echo "<pre>";print_r($tramitacao); echo "</pre>"; }	

//if (!$opcao or $opcao=="ficha") {
//	if ($user['nivel']>=4) $opcao="tramitacaocoger";
//	else $opcao="tramitacaoopm";
//}

if (strtolower($acao)=="cadastrar") $opcao="cadastrar";
if (strtolower($acao)=="atualizar") $opcao="atualizar";


if (strtolower($opcao)=="cadastrar")  {
	if (strtolower($acao)=="cadastrar") {
		tramitacao::insere($tramitacao);
		echo "<h2>Tramitacao cadastrada com sucesso!</h2>";
		echo "<a id='foco' onclick='retornarAtualizar(this)'>Clique aqui para voltar.</a>";
	}
	else {
		include ("formulario.inc.php");
	}
}
elseif (strtolower($opcao)=="atualizar") {
	if (strtolower($acao)=="atualizar") {
		if (tramitacao::atualiza($tramitacao)) {
			echo "<h2>Tramitacao atualizado com sucesso!</h2>";
			echo "<a id='foco' onclick='retornarAtualizar(this)'>Clique aqui para voltar.</a>";
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
	if (tramitacao::apaga($tramitacao)) {
		echo "<h2>Tramitacao apagada com sucesso!</h2>";
		echo "<a id='foco' href='?module=tramitacao&policial[rg]=".$tramitacao->rg."'>Clique aqui para voltar a ficha do policial.</a>";
	}
	else {
		echo "Houve um problema durante a execução da solicitação!";
	}
}
elseif ($opcao) {
	include ("$opcao.php");
}
elseif (!$opcao) {
	include ("ficha.php");
}
?>
<script language='javascript'>document.getElementById('foco').focus()</script>

