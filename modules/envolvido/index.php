<?php
//Core
if ($_REQUEST['envolvido']['id'] and !$opcao) $opcao="atualizar";
if (!$opcao) $opcao="cadastrar";

//Defini��o de vari�veis, incluindo pais e filhos

$envolvido=new envolvido();
$envolvido->setValues($_REQUEST['envolvido'],"","simples");

//Fim defini��o de vari�veis.

//Debug
if ($_SESSION['debug']) pre($envolvido);
if ($_SESSION['debug']) pre(strtolower($opcao));
//include ("menu.inc");
if (strtolower($opcao)=="cadastrar")  {
	if (strtolower($acao)=="cadastrar") {
		//A op��o de cadastro de envolvidos � feita diretamente nos procedimentos.
	}
	else {
		//include ("formulario.inc");
	}
}
if (strtolower($opcao)=="atualizar") {
	if (strtolower($acao)=="atualizar") {
		if (envolvido::atualiza($envolvido)) {
			echo "<h2>Envolvido atualizado com sucesso!</h2>";
			//echo "<a href='?module=envolvido&opcao=lista'>Clique aqui para voltar.</a>";
		}
		else {
			echo "Houve um problema durante a execu��o da solicita��o!";
		}
	}
	else {
		include ("formulario.inc");
	}
}
if ($opcao=="lista" or $opcao=="listar") {
       include ("lista.inc");
}
if (strtolower($opcao)=="apagar") {
	if (strtolower($acao)=="apagar") {
		if (envolvido::apaga($envolvido)) {
			echo "<h2>Envolvido apagado com sucesso!</h2>";
			echo "<a href='?module=envolvido&opcao=lista'>Clique aqui para voltar � lista</a>";
			//log::insere("");
		}
		else {
			echo "Houve um problema durante a execu��o da solicita��o!";
		}
	}
	else {
		echo "<h1>Deseja realmente apagar o envolvido ".$envolvido->nome."?</h1>";
		echo "<a title='apagar' type=submit href='?module=envolvido&opcao=apagar&acao=apagar&envolvido[id]=$envolvido->id_envolvido'>Apagar</a>";
			/*echo "<form name='envolvido'>
				<input type=hidden name=envolvido[id_envolvido] value='".$envolvido->id_envolvido."'>
				<input type=submit name='acao' value='apagar'>
			</form>";*/
	}
}
if ($opcao=="buscar") {
	include ("filtro.inc");
	include ("lista.inc");
}
else {
	include ("$opcao.php");
}

?>
