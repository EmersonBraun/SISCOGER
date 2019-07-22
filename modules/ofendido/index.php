<?php

if ($opcao=="relatorio") {
	include ("relatorio.php");
}
elseif ($opcao=="listar") {

	$ofendido=new ofendido();
	$ofendido->setValues($_REQUEST['ofendido']);

	include ("lista.php");
}
?>
