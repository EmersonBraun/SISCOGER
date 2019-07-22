<?php
if ($_REQUEST['protocolo']['id']) $opcao="atualizar";
if (!$opcao) $opcao="cadastrar";

//Definição de variáveis, incluindo pais e filhos
$protocolo=new protocolo();
$protocolo->setValues($_REQUEST['protocolo']);

if ($_SESSION['debug']) { echo "<pre>";print_r($protocolo); echo "</pre>"; }	

if (strtolower($opcao)=="cadastrar")  {
	if (strtolower($acao)=="cadastrar") {
		protocolo::insere($protocolo);
		echo '<script language="javascript">';
        	echo 'alert("Protocolo cadastrado com sucesso! Atualize a página para ver atualizações!")';
        	echo '</script>';
        	echo "<script>window.close();</script>";
		//echo "<h2>protocolo cadastrado com sucesso! Atualize a p&aacute;gina para ver atualiza&ccedil;&otilde;es</h2>";
		//echo "<a id='foco' href='?module=protocolo&opcao=listar'>Clique aqui para voltar.</a>";
	}
	else {
		//include ("menu.inc.php");
		include ("formulario.inc.php");
	}
}
elseif (strtolower($opcao)=="atualizar") {
	if (strtolower($acao)=="atualizar") {
		if (protocolo::atualiza($protocolo)) {
			echo '<script language="javascript">';
			echo 'alert("Protocolo atualizado com sucesso! Atualize a página para ver atualizações!")';
			echo '</script>';
			echo "<script>window.close();</script>";
			//echo "<h2>protocolo atualizado com sucesso! Atualize a p&aacute;gina para ver atualiza&ccedil;&otilde;es</h2>";
			//echo "<a id='foco' href='?module=protocolo&opcao=listar'>Clique aqui para voltar.</a>";
		}
		else {
			echo "Houve um problema durante a execução da solicitação!";
		}
	}
	else {
		// include ("menu.inc.php");
		include ("formulario.inc.php");
	}
}
elseif ($opcao=="lista" or $opcao=="listar") {
       include ("lista.inc.php");
}
/*elseif ($opcao=="apagar") {
	if (strtolower($acao)=="apagar") {
		if (protocolo::apaga($protocolo)) {
			/*echo '<script language="javascript">';
			echo 'alert("Protocolo apagado com sucesso! Atualize a página para ver atualizações!")';
			echo '</script>';
			echo "<script>window.close();</script>";

			//echo "<a id='foco' href='?module=protocolo&opcao=listar'>Clique aqui para voltar à lista</a>";
			//echo "<a id='foco' onclick='retornarAtualizar(this)' href='#'>Clique aqui para voltar.</a>";
			return true;
		}
		else {
			return false;
			//echo "Houve um problema durante a execução da solicitação!";
		}
	}
}*/
elseif ($opcao) {
	include ("$opcao.php");
}
?>
<script language='javascript'>document.getElementById('foco').focus()</script>

