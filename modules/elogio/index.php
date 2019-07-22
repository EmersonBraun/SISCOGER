<?php

$elogio=new elogio();
$posto=$_REQUEST['posto'];

if ($_REQUEST['elogio']['id'] and !$opcao) $opcao="atualizar";

$elogio->setValues($_REQUEST['elogio']);
if ($_SESSION['debug']) { echo "<pre>";print_r($tramitacao); echo "</pre>"; }

if (strtolower($acao)=="cadastrar") $opcao="cadastrar";
if (strtolower($acao)=="atualizar") $opcao="atualizar";

if (strtolower($opcao)=="cadastrar")  {
	if (strtolower($acao)=="cadastrar") {
		$opmPUNI=new opm(completaZeros($elogio->cdopm));
		$elogio->opm_abreviatura=$opmPUNI->abreviatura;
		
		$idelogio=elogio::insere($elogio);
	
		echo "<h2>Elogio cadastrad com sucesso!</h2>";
		echo "<a id='foco' onclick='retornarAtualizar(this)' href='#'>Clique aqui para voltar.</a>";
	}
	else {
		include ("formulario.inc.php");
	}
}
elseif (strtolower($opcao)=="atualizar") {
	if (strtolower($acao)=="atualizar") {
		$opmPUNI=new opm(completaZeros($elogio->cdopm));
		$elogio->opm_abreviatura=$opmPUNI->abreviatura;
		
		if ($idelogio=elogio::atualiza($elogio)) {
			echo "<h2>Elogio atualizado com sucesso!</h2>";
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
	if (elogio::apaga($elogio)) {
		echo "<h2>Elogio apagado com sucesso!</h2>";
		echo "<a id='foco' href='?module=tramitacao&opcao=punicao&policial[rg]=".$elogio->rg."'>Clique aqui para voltar a ficha do policial.</a>";
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

