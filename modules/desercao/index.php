<?
//Core
if ($_REQUEST['desercao']['id']) $opcao="atualizar";
if (!$opcao) $opcao="cadastrar";
$desercao=new desercao();
$desercao->setValues($_REQUEST['desercao']);

//Defini��o de vari�veis, incluindo pais e filhos

$vetorEnvolvidos=$_REQUEST['envolvido'];
if ($vetorEnvolvidos) {
	$i=0;
	foreach ($vetorEnvolvidos as $elemento) {
		$desercao->envolvido[$i]=new envolvido();
		$desercao->envolvido[$i]->setValues($elemento,"","simples");
	$i++;
	}
}

//Fim defini��o de vari�veis.

//Debug
if ($_SESSION['debug']) { pre($desercao); }

//include ("menu.inc");
if (strtolower($opcao)=="cadastrar")  {
	if (strtolower($acao)=="cadastrar") {
		if (!$desercao->sjd_ref) {
			$sql="SELECT MAX(sjd_ref) AS ultimo FROM desercao WHERE sjd_ref_ano='".$desercao->sjd_ref_ano."'";
			$row=mysql_fetch_array(mysql_query($sql));
			$desercao->sjd_ref=($row[ultimo]+1);
		}
		$id=desercao::insere($desercao);
		log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", inseriu a <a href=\"?module=desercao&desercao[id]=$id\">deser��o n� ".$desercao->sjd_ref."/".$_SESSION[sjd_ano]."</a>","desercao");
		echo "<h2>Deser��o cadastrada com sucesso!</h2>";
		echo "<a href='?module=desercao&opcao=lista'>Clique aqui para voltar.</a>";
	}
	else {
		include ("formulario.inc.php");
	}
}
elseif (strtolower($opcao)=="atualizar") {
	if (strtolower($acao)=="atualizar") {
		if (desercao::atualiza($desercao)) {
			echo "<h2>Deser��o atualizada com sucesso!</h2>";
			//echo "<a href='?module=desercao&opcao=lista'>Clique aqui para voltar.</a>";
                        echo "<a id='foco' href='?module=desercao&opcao=lista'><button>Clique aqui para voltar &agrave; lista.</button></a><br><br>";
                        echo "<a href='?module=desercao&desercao[id]=".$desercao->id_desercao."'><button>Clique aqui para voltar &agrave; Deser&ccedil;&atilde;o.</button></a>";
                        js::foco();
		}
		else {
			echo "Houve um problema durante a execu��o da solicita��o!";
		}
	}
	else {
		include ("formulario.inc.php");
	}
}
elseif ($opcao=="lista" or $opcao=="listar") {
       include ("lista.inc");
}
elseif ($opcao=="apagar") {
	if ($acao=="apagar") {
		if (desercao::apaga($desercao)) {
			echo "<h2>Deser��o apagada com sucesso!</h2>";
			echo "<a href='?module=desercao&opcao=lista'>Clique aqui para voltar � lista</a>";
			log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", apagou a deser��o n� ".$desercao->sjd_ref."/".$_SESSION[sjd_ano]."</a>","desercao");
		}
		else {
			echo "Houve um problema durante a execu��o da solicita��o!";
		}
	}
	else {
		echo "<h1>Deseja realmente apagar a deser��o n&ordm; ".$desercao->sjd_ref."?</h1>";
		echo "<form name='desercao'><input type=hidden name=desercao[id_desercao] value='".$desercao->id_desercao."'><input 
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
