<?

//Versão 1.0 (05/08/2008)
//	1.1 SJD modified (08/05/2009) function user corrigida

if (!$opcao) {
	include ("formulario.inc");
}

if ($opcao=="debug") {
	if (!$_SESSION['debug']) {
		($_SESSION['debug']=true);
		echo "&nbsp;O sistema agora está no modo de testes. Clique novamente quando quiser sair.";
	}
	else {
		echo "&nbsp;O sistema agora saiu do modo de testes. Clique novamente quando quiser iniciar.";
		$_SESSION['debug']=false;
	}
} //Debug
elseif ($opcao=="classes") {
	echo "<h2>Classes utilizadas</h2>";
	echo "<ul>";
	$arquivos=scandir("classes");
	foreach($arquivos as $arquivo) {
		if ($arquivo!="." and $arquivo!=".." and (!strpos($arquivo,"~"))) {
			$partes=explode(".",$arquivo);
			$classe=$partes[1];
			if ($classe!="ezpdf") $objeto = new $classe();
			if ($objeto->versao) {
				echo "<li>".$classe." ".$objeto->versao."</li>";
			}
		}
	}
	echo "</ul>";
} //Classes
elseif ($opcao=="user") {
	$chaves=array_keys($_REQUEST[user]);
	foreach ($chaves as $chave) {
		echo "Modificando <b>$chave</b> para novo valor: ".$_REQUEST[user][$chave];
		$_SESSION[user][$chave]=$_REQUEST[user][$chave];
		if ($chave=="nivel") {
			$user[niveis][ID_SISTEMA]=$_REQUEST[user][nivel];
		}
	}
	
	//$_SESSION['user']['nivel']=$_REQUEST['user'];
}
elseif ($opcao=="opm_login") {
	unset($_SESSION[opm_login]);
	$_SESSION[opm_login]=new opm ($_REQUEST[opm_login]);
	echo "OPM modificada para: ".$opm_login->descricao."!";
}
elseif ($opcao=="getform") {
	include ("getform.php");
}
elseif ($opcao=="criarmodulo") {
	include ("criarmodulo.php");
}
 
?>
