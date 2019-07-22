<?
//Core
if ($_REQUEST['apfd']['id']) $opcao="atualizar";
if (!$opcao) $opcao="cadastrar";

//Definição de variáveis, incluindo pais e filhos
$apfd=new apfd();
$apfd->setValues($_REQUEST['apfd']);

$vetorEnvolvidos=$_REQUEST['envolvido'];
if ($vetorEnvolvidos) {
	$i=0;
	foreach ($vetorEnvolvidos as $elemento) {
		$apfd->envolvido[$i]=new envolvido();
		$apfd->envolvido[$i]->setValues($elemento,"","simples");
	$i++;
	}
}

$vetorOfendidos=$_REQUEST['ofendido'];
if ($vetorOfendidos) {
	$i=0;
	foreach ($vetorOfendidos as $elemento) {
		$apfd->ofendido[$i]=new ofendido();
		$apfd->ofendido[$i]->setValues($elemento,"","simples");
	$i++;
	}
}
//Fim definição de variáveis.

//Debug
if ($_SESSION['debug']) { pre($apfd); }

//include ("menu.inc");
if (strtolower($opcao)=="cadastrar")  {
	if (strtolower($acao)=="cadastrar") {
		if (!$apfd->sjd_ref) {
			$sql="SELECT MAX(sjd_ref) AS ultimo FROM apfd WHERE sjd_ref_ano='".$apfd->sjd_ref_ano."' AND tipo='".$apfd->tipo."'";
			$row=mysql_fetch_array(mysql_query($sql));
			$apfd->sjd_ref=($row[ultimo]+1);
			
		}
		$id=apfd::insere($apfd);
		log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", inseriu o <a href=\"?module=apfd&apfd[id]=$id\">apfd nº ".$apfd->sjd_ref."/".$_SESSION[sjd_ano]."</a>","apfd");
		echo "<h2>Auto de prisão em flagrante delito cadastrado com sucesso!</h2>";
		echo "<a href='?module=apfd&opcao=lista'>Clique aqui para voltar.</a>";
	}
	else {
		include ("formulario.inc.php");
	}
}
elseif (strtolower($opcao)=="atualizar") {
	if (strtolower($acao)=="atualizar") {
		if ($id=apfd::atualiza($apfd)) {
                        log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", atualizou o <a href=\"?module=apfd&apfd[id]=$id\">apfd nº ".$apfd->sjd_ref."/".$_SESSION[sjd_ano]."</a>","apfd");

			echo "<h2>Auto de prisão em flagrante delito atualizado com sucesso!</h2>";
			echo "<a href='?module=apfd&opcao=lista'>Clique aqui para voltar.</a>";
		}
		else {
			echo "Houve um problema durante a execução da solicitação!";
		}
	}
	else {
                log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", visualizou o <a href=\"?module=apfd&apfd[id]=$apfd->id_apfd\">apfd nº ".$apfd->sjd_ref."/".$_SESSION[sjd_ano]."</a>","apfd");
		include ("formulario.inc.php");
	}
}
elseif ($opcao=="lista" or $opcao=="listar") {
       include ("lista.inc");
}
elseif ($opcao=="apagar") {
	if ($acao=="apagar") {
		if (apfd::apaga($apfd)) {
			echo "<h2>Auto de prisão em flagrante delito apagado com sucesso!</h2>";
			echo "<a href='?module=apfd&opcao=lista'>Clique aqui para voltar à lista</a>";
			log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", apagou o apfd nº ".$apfd->sjd_ref."/".$_SESSION[sjd_ano]."</a>","apfd");
		}
		else {
			echo "Houve um problema durante a execução da solicitação!";
		}
	}
	else {
		echo "<h1>Deseja realmente apagar o APFD n&ordm; ".$apfd->sjd_ref."?</h1>";
		echo "<form name='apfd'><input type=hidden name=apfd[id_apfd] value='".$apfd->id_apfd."'><input 
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
