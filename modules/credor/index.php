<?php

//Core
if ($_REQUEST['credor']['id']) $opcao="atualizar";
if (!$opcao) $opcao="cadastrar";
$credor=new credor();
$credor->setValues($_REQUEST['credor']);

//Debug
if ($_SESSION['debug']) { pre($credor); }

//include ("menu.inc");
if (strtolower($opcao)=="cadastrar")  {
	if (strtolower($acao)=="cadastrar") {
		$id=credor::insere($credor);
		log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", inseriu a <a href=\"?module=credor&credor[id]=$id\">deserção nº ".$credor->sjd_ref."/".$_SESSION[sjd_ano]."</a>","credor");
		echo "<h2>Deserção cadastrada com sucesso!</h2>";
		echo "<a href='?module=credor&opcao=lista'>Clique aqui para voltar.</a>";
	}
	else {
		include ("formulario.inc");
	}
}
elseif (strtolower($opcao)=="atualizar") {
	if (strtolower($acao)=="atualizar") {
		if (credor::atualiza($credor)) {
			echo "<h2>Deserção atualizada com sucesso!</h2>";
			echo "<a href='?module=credor&opcao=lista'>Clique aqui para voltar.</a>";
		}
		else {
			echo "Houve um problema durante a execução da solicitação!";
		}
	}
	else {
		include ("formulario.inc");
	}
}
elseif ($opcao=="lista" or $opcao=="listar") {
       include ("lista.inc");
}
elseif ($opcao=="apagar") {
	if ($acao=="apagar") {
		if (credor::apaga($credor)) {
			echo "<h2>Deserção apagada com sucesso!</h2>";
			echo "<a href='?module=credor&opcao=lista'>Clique aqui para voltar à lista</a>";
			log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", apagou a deserção nº ".$credor->sjd_ref."/".$_SESSION[sjd_ano]."</a>","credor");
		}
		else {
			echo "Houve um problema durante a execução da solicitação!";
		}
	}
	else {
		echo "<h1>Deseja realmente apagar a deserção n&ordm; ".$credor->sjd_ref."?</h1>";
		echo "<form name='credor'><input type=hidden name=credor[id_credor] value='".$credor->id_credor."'><input 
type=submit name='acao' value='Apagar'></form>";
	}
}
elseif ($opcao=="buscar") {
	include ("filtro.inc");
	include ("lista.inc");
}
else {
	include ("$opcao.php");
}

?>
