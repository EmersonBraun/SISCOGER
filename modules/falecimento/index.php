<?php
$falecimento=new falecimento();
$posto=$_REQUEST['posto'];
if ($_REQUEST['falecimento']['id']) $opcao="atualizar";
$falecimento->setValues($_REQUEST['falecimento']);
if ($_SESSION['debug']) { echo "<pre>";print_r($falecimento); echo "</pre>"; }	

//Captura ligacoes
$vetorLigacao=$_REQUEST['ligacao'];
if ($vetorLigacao) {
	$i=0;
	foreach ($vetorLigacao as $elemento) {
		$falecimento->ligacao[$i]=new ligacao();
		$falecimento->ligacao[$i]->setValues($elemento,"","simples");
		$falecimento->ligacao[$i]->destino_proc="falecimento";
		//$falecimento->ligacao[$i]->destino_sjd_ref=$falecimento->sjd_ref;
		//$falecimento->ligacao[$i]->destino_sjd_ref_ano=$falecimento->sjd_ref_ano;
	$i++;
	}
}


if (!$opcao) $opcao="cadastrar";
if (strtolower($acao)=="cadastrar") $opcao="cadastrar";
if (strtolower($acao)=="atualizar") $opcao="atualizar";

if (strtolower($opcao)=="cadastrar")  {
	if (strtolower($acao)=="cadastrar") {
		falecimento::insere($falecimento);
		echo "<h2>Cadastrado com sucesso!</h2>";
		echo "<a id='foco' href='?module=falecimento&opcao=listar'>Clique aqui para voltar.</a>";
	}
	else {
		include ("menu.inc.php");
		include ("formulario.inc.php");
	}
}
elseif (strtolower($opcao)=="atualizar") {
	if (strtolower($acao)=="atualizar") {
		if (falecimento::atualiza($falecimento)) {
			echo "<h2>Atualizado com sucesso!</h2>";
			echo "<a id='foco' href='?module=falecimento&opcao=listar'>Clique aqui para voltar.</a>";
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
	if (falecimento::apaga($falecimento)) {
		echo "<h2>Apagado com sucesso!</h2>";
		echo "<a id='foco' href='?module=falecimento&opcao=listar'>Clique aqui para voltar à lista</a>";
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

