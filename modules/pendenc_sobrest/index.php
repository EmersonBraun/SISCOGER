<?php 
if ($opm_login->codigoBase==="") $opm_login->codigoBase="0";
//var_dump($opm_login->codigoBase);exit;
h1("Controle Sobrestamentos");
h2("Sobrestamentos sem data de t&eacute;rmino"); echo "<br>\r\n";

$opcao=$_REQUEST['opcao'];

include("menu.php");
include("sobrest_$opcao.php");
?>