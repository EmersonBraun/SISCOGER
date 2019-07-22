<?php

// ini_set('display_errors',1);
// ini_set('display_startup_erros',1);
// error_reporting(E_ALL);

if (isset($_REQUEST['localdeapresentacao']['id'])) $opcao="atualizar";
if (!$opcao) $opcao="cadastrar";

$localdeapresentacao=new localdeapresentacao();
//pre($localdeapresentacao);exit();
if (isset($_REQUEST['localdeapresentacao'])) {
	$localdeapresentacao->setValues($_REQUEST['localdeapresentacao']);
}

if (isset($_SESSION['debug'])) { pre($localdeapresentacao); }

// inclui o menu
if (strtolower($opcao)=="cadastrar")  {
	if ($user["nivel"]<2) die;

	if (strtolower($acao)=="cadastrar") {
		$id=localdeapresentacao::insere($localdeapresentacao);
		log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", inseriu o <a href=\"?module=localdeapresentacao&localdeapresentacao[id]=$id\">Local nº ".$id."</a>","localdeapresentacao");
		echo "<h2>Local cadastrado com sucesso!</h2>";
		echo "<a href='?module=localdeapresentacao&opcao=lista'>Clique aqui para voltar &agrave; lista.</a> <br />";

                if ($_REQUEST['voltar'] == 'apresentacaoselecionarlocal') {
                    $q = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';
                    echo "<br /><a href='?module=apresentacao&opcao=apresentacaoselecionarlocal&query={$q}&nomenu=true&noheader=true'>Clique aqui para voltar a seleção de local.</a>";
                }
	}
	else {
		include ("formulario.inc.php");
	}
}
elseif (strtolower($opcao)=="atualizar") {
	if (strtolower($acao)=="atualizar") {
		if ($id=localdeapresentacao::atualiza($localdeapresentacao)) {
			log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", atualizou o <a href=\"?module=localdeapresentacao&localdeapresentacao[id]=$id\">Local nº ".$id."</a>","localdeapresentacao");

			echo "<h2>Local atualizado com sucesso!</h2><br>";
			echo "<a id='foco' href='?module=localdeapresentacao&opcao=lista'><button>Clique aqui para voltar &agrave; lista.</button></a><br><br>";
			echo "<a href='?module=localdeapresentacao&localdeapresentacao[id]=".$localdeapresentacao->id_localdeapresentacao."'><button>Clique aqui para voltar ao Local.</button></a>";

                        if ($_REQUEST['voltar'] == 'apresentacaoselecionarlocal') {
                            $q = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';
                            echo "<br /><a href='?module=apresentacao&opcao=apresentacaoselecionarlocal&query={$q}&nomenu=true&noheader=true'>Clique aqui para voltar a seleção de local.</a>";
                        }

			js::foco();
		}
		else {
			echo "Houve um problema durante a execução da solicitação!";
		}
	}
	else {
		//log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", visualizou o <a href=\"?module=localdeapresentacao&localdeapresentacao[id]=$id\">Local nº ".$localdeapresentacao->id_localdeapresentacao."</a>","localdeapresentacao");
		include ("formulario.inc.php");
	}
}
elseif ($opcao=="lista" or $opcao=="listar") {
       include ("lista.inc.php");
}
elseif ($opcao=="apagar") {
	if ($acao=="apagar") {
		$localdeapresentacao=new localdeapresentacao(" WHERE id_localdeapresentacao='".$localdeapresentacao->id_localdeapresentacao."'");
		//pre($localdeapresentacao);
		//die;
		if (localdeapresentacao::apaga($localdeapresentacao)) {
			echo "<h2>Local apagado com sucesso!</h2>";
			echo "<a href='?module=localdeapresentacao&opcao=lista'>Clique aqui para voltar à lista</a>";
			log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", apagou o Local nº ".$localdeapresentacao->id_localdeapresentacao,"localdeapresentacao");
		}
		else {
			echo "Houve um problema durante a execução da solicitação!";
		}
	}
	else {
		echo "<h1>Deseja realmente apagar o Local n&ordm; ".$localdeapresentacao->id_localdeapresentacao."?</h1>";
		echo "<form method='POST' name='localdeapresentacao'><input type=hidden name=localdeapresentacao[id_localdeapresentacao] value='".$localdeapresentacao->id_localdeapresentacao."'><input
type=submit name='acao' value='Apagar'></form>";
	}
}
elseif ($opcao=="buscar") {
	include ("lista.inc.php");
}
else {
	include ("$opcao.php");
}
