<?
//Core
if ($_REQUEST['fatd']['id']) $opcao="atualizar";
if (!$opcao) $opcao="cadastrar";

//Definição de variáveis, incluindo pais e filhos
$fatd=new fatd();
//pre($_REQUEST[fatd]);die;
$fatd->setValues($_REQUEST['fatd']);

$vetorEnvolvidos=$_REQUEST['envolvido'];
if ($vetorEnvolvidos) {
	$i=0;
	foreach ($vetorEnvolvidos as $elemento) {
		$fatd->envolvido[$i]=new envolvido();
		$fatd->envolvido[$i]->setValues($elemento,"","simples");
	$i++;
	}
}

$vetorOfendidos=$_REQUEST['ofendido'];
if ($vetorOfendidos) {
	$i=0;
	foreach ($vetorOfendidos as $elemento) {
		$fatd->ofendido[$i]=new ofendido();
		$fatd->ofendido[$i]->setValues($elemento,"","simples");
	$i++;
	}
}

//Captura ligacoes
$vetorLigacao=$_REQUEST['ligacao'];
if ($vetorLigacao) {
	$i=0;
	foreach ($vetorLigacao as $elemento) {
		$fatd->ligacao[$i]=new ligacao();
		$fatd->ligacao[$i]->setValues($elemento,"","simples");
		$fatd->ligacao[$i]->destino_proc="fatd";
		$fatd->ligacao[$i]->destino_sjd_ref=$fatd->sjd_ref;
		$fatd->ligacao[$i]->destino_sjd_ref_ano=$fatd->sjd_ref_ano;
	$i++;
	}
}
//Fim definição de variáveis.

//Debug
if ($_SESSION['debug']) { pre($fatd); }

//include ("menu.inc");
if (strtolower($opcao)=="cadastrar")  {
	if (strtolower($acao)=="cadastrar") {
		if (!$fatd->sjd_ref) {
			$sql="SELECT MAX(sjd_ref) AS ultimo FROM fatd WHERE sjd_ref_ano='".$fatd->sjd_ref_ano."'";
			$row=mysql_fetch_array(mysql_query($sql));
			$fatd->sjd_ref=($row[ultimo]+1);
			
		}
		$id=fatd::insere($fatd);
		log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", inseriu o <a href=\"?module=fatd&fatd[id]=$id\">fatd nº ".$fatd->sjd_ref."/".$_SESSION[sjd_ano]."</a>","fatd");
		echo "<h2>FATD cadastrado com sucesso!</h2>";
		echo "<a href='?module=fatd&opcao=lista'>Clique aqui para voltar.</a>";
	}
	else {
		include ("formulario.inc.php");
	}
}
elseif (strtolower($opcao)=="atualizar") {
	if (strtolower($acao)=="atualizar") {
		if ($id=fatd::atualiza($fatd)) {
                        log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", atualizou o <a href=\"?module=fatd&fatd[id]=$id\">fatd nº ".$fatd->sjd_ref."/".$_SESSION[sjd_ano]."</a>","fatd");

			echo "<h2>FATD atualizado com sucesso!</h2>";
		//echo "<a href='?module=fatd&opcao=lista'>Clique aqui para voltar.</a>";
                        echo "<a id='foco' href='?module=fatd&opcao=lista'><button>Clique aqui para voltar &agrave; lista.</button></a><br><br>";
                        echo "<a href='?module=fatd&fatd[id]=".$fatd->id_fatd."'><button>Clique aqui para voltar ao FATD.</button></a>";
                        js::foco();


		}
		else {
			echo "Houve um problema durante a execução da solicitação!";
		}
	}
	else {
                log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", visualizou o <a href=\"?module=fatd&fatd[id]=$fatd->id_fatd\">fatd nº ".$fatd->sjd_ref."/".$_SESSION[sjd_ano]."</a>","fatd");
		include ("formulario.inc.php");
	}
}
elseif ($opcao=="lista" or $opcao=="listar") {
       include ("lista.inc");
}
elseif ($opcao=="apagar") {
	if ($acao=="apagar") {
		if (fatd::apaga($fatd)) {
			echo "<h2>FATD apagado com sucesso!</h2>";
			echo "<a href='?module=fatd&opcao=lista'>Clique aqui para voltar à lista</a>";
			log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", apagou o fatd nº ".$fatd->sjd_ref."/".$_SESSION[sjd_ano]."</a>","fatd");
		}
		else {
			echo "Houve um problema durante a execução da solicitação!";
		}
	}
	else {
		echo "<h1>Deseja realmente apagar o FATD n&ordm; ".$fatd->sjd_ref."?</h1>";
		echo "<form name='fatd'><input type=hidden name=fatd[id_fatd] value='".$fatd->id_fatd."'><input 
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
