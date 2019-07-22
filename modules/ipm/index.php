<?
//Core
if ($_REQUEST['ipm']['id']) $opcao="atualizar";
if (!$opcao) $opcao="cadastrar";

//Definição de variáveis, incluindo pais e filhos
$ipm=new ipm();
//pre($_REQUEST[ipm]);die;
$ipm->setValues($_REQUEST['ipm']);
if (!$ipm->confronto_armado_bl) $ipm->confronto_armado_bl="";

$vetorEnvolvidos=$_REQUEST['envolvido'];
if ($vetorEnvolvidos) {
	$i=0;
	foreach ($vetorEnvolvidos as $elemento) {
		$ipm->envolvido[$i]=new envolvido();
		$ipm->envolvido[$i]->setValues($elemento,"","simples");
	$i++;
	}
}

$vetorOfendidos=$_REQUEST['ofendido'];
if ($vetorOfendidos) {
	$i=0;
	foreach ($vetorOfendidos as $elemento) {
		$ipm->ofendido[$i]=new ofendido();
		$ipm->ofendido[$i]->setValues($elemento,"","simples");
	$i++;
	}
}

//Captura ligacoes
$vetorLigacao=$_REQUEST['ligacao'];
if ($vetorLigacao) {
	$i=0;
	foreach ($vetorLigacao as $elemento) {
		$ipm->ligacao[$i]=new ligacao();
		$ipm->ligacao[$i]->setValues($elemento,"","simples");
		$ipm->ligacao[$i]->destino_proc="ipm";
		$ipm->ligacao[$i]->destino_sjd_ref=$ipm->sjd_ref;
		$ipm->ligacao[$i]->destino_sjd_ref_ano=$ipm->sjd_ref_ano;
	$i++;
	}
}

//arquivo
$vetorArquivo=$_REQUEST['arquivo'];
if ($vetorArquivo) {
	$i=0;
	foreach ($vetorArquivo as $elemento) {
		$ipm->arquivo[$i] = new arquivo();
		$ipm->arquivo[$i]->setValues($elemento,"","simples");
	$i++;
	}
}

//Fim definição de variáveis.

//Debug
if ($_SESSION['debug']) { pre($ipm); }

//include ("menu.inc");
if (strtolower($opcao)=="cadastrar")  {
		if ($user["nivel"]<2) die;

	if (strtolower($acao)=="cadastrar") {
		if (!$ipm->sjd_ref) {
			$sql="SELECT MAX(sjd_ref) AS ultimo FROM ipm WHERE sjd_ref_ano='".$ipm->sjd_ref_ano."'";
			$row=mysql_fetch_array(mysql_query($sql));
			$ipm->sjd_ref=($row[ultimo]+1);
			if ($user[nivel]>=4) { $ipm->opm_ref=$ipm->sjd_ref; $ipm->cdopm="10000000";}
			
		}
		if (!$ipm->opm_ref) {
			$sql="SELECT MAX(opm_ref) AS ultimo FROM ipm WHERE opm_ref_ano='".$ipm->sjd_ref_ano."' AND opm_sigla='$login_unidade'";
			$row=mysql_fetch_array(mysql_query($sql));
			$ipm->opm_ref=($row[ultimo]+1);
		}
		if (!$ipm->cdopm) $ipm->cdopm=$opm_login->codigo;
		if (!$ipm->opm_sigla) $ipm->opm_sigla=$login_unidade;
				
		$id=ipm::insere($ipm);
		log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", inseriu o <a href=\"?module=ipm&ipm[id]=$id\">IPM nº ".$ipm->sjd_ref."/".$_SESSION[sjd_ano]."</a>","ipm");
		echo "<h2>IPM cadastrado com sucesso!</h2>";
		echo "<a href='?module=ipm&opcao=lista'>Clique aqui para voltar &agrave; lista.</a>";
	}
	else {
		include ("formulario.inc.php");
	}
}
elseif (strtolower($opcao)=="atualizar") {
	if (strtolower($acao)=="atualizar") {
		if ($id=ipm::atualiza($ipm)) {
			log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", atualizou o <a href=\"?module=ipm&ipm[id]=$id\">IPM nº ".$ipm->sjd_ref."/".$_SESSION[sjd_ano]."</a>","ipm");

			echo "<h2>IPM atualizado com sucesso!</h2><br>";
			echo "<a id='foco' href='?module=ipm&opcao=lista'><button>Clique aqui para voltar &agrave; lista.</button></a><br><br>";
			echo "<a href='?module=ipm&ipm[id]=".$ipm->id_ipm."'><button>Clique aqui para voltar ao IPM.</button></a>";
			js::foco();
		}
		else {
			echo "Houve um problema durante a execução da solicitação!";
		}
	}
	else {
                log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", visualizou o <a href=\"?module=ipm&ipm[id]={$ipm->id_ipm}\">IPM nº ".$ipm->sjd_ref."/".$_SESSION[sjd_ano]."</a>","ipm");
		include ("formulario.inc.php");
	}
}
elseif ($opcao=="lista" or $opcao=="listar") {
       include ("lista.inc");
}
elseif ($opcao=="apagar") {
	if ($acao=="apagar") {
		$ipm=new ipm(" WHERE id_ipm='".$ipm->id_ipm."'");
		//pre($ipm);
		//die;
		if (ipm::apaga($ipm)) {
			echo "<h2>IPM apagado com sucesso!</h2>";
			echo "<a href='?module=ipm&opcao=lista'>Clique aqui para voltar à lista</a>";
			log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", apagou o IPM nº ".$ipm->sjd_ref."/".$_SESSION[sjd_ano]."</a>","ipm");
		}
		else {
			echo "Houve um problema durante a execução da solicitação!";
		}
	}
	else {
		echo "<h1>Deseja realmente apagar o IPM n&ordm; ".$ipm->sjd_ref."?</h1>";
		echo "<form method='POST' name='ipm'><input type=hidden name=ipm[id_ipm] value='".$ipm->id_ipm."'><input 
type=submit name='acao' value='Apagar'></form>";
	}
}
elseif ($opcao=="buscar") {
	//include ("filtro.inc");
	include ("lista.inc");
}
else {
	include ("$opcao.php");
}

?>
