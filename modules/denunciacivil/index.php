<?php

$denunciacivil=new denunciacivil();
$posto=$_REQUEST['posto'];

if ($_REQUEST['denunciacivil']['id'] and !$opcao) $opcao="atualizar";

$denunciacivil->setValues($_REQUEST['denunciacivil']);
if ($_SESSION['debug']) { echo "<pre>";print_r($tramitacao); echo "</pre>"; }

if (strtolower($acao)=="cadastrar") $opcao="cadastrar";
if (strtolower($acao)=="atualizar") $opcao="atualizar";


if (strtolower($opcao)=="cadastrar")  {
	if (strtolower($acao)=="cadastrar") {
		denunciacivil::insere($denunciacivil);
		echo "<h2> cadastrado com sucesso!</h2>";
		echo "<a id='foco' onclick='retornarAtualizar(this)' href='#'>Clique aqui para voltar.</a>";
	}
	else {
		include ("formulario.inc.php");
	}
}
elseif (strtolower($opcao)=="atualizar") {
	if (strtolower($acao)=="atualizar") {
		if ($iddenunciacivil=denunciacivil::atualiza($denunciacivil)) {
			echo "<h2> atualizado com sucesso!</h2>";
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
	$proc=$denunciacivil->procedimento;
	if (denunciacivil::apaga($denunciacivil)) {
		echo "<h2>Denuncia apagada com sucesso!</h2>";
		echo "<a id='foco' href='?module=tramitacao&policial[rg]=".$denunciacivil->rg."'>Clique aqui para voltar a ficha do policial.</a>";
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

