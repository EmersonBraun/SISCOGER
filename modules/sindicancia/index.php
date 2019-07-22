<?
//Core
if ($_REQUEST['sindicancia']['id']) $opcao="atualizar";
if (!$opcao) $opcao="cadastrar";

//Definição de variáveis, incluindo pais e filhos
$sindicancia=new sindicancia();
$sindicancia->setValues($_REQUEST['sindicancia']);

$vetorEnvolvidos=$_REQUEST['envolvido'];
if ($vetorEnvolvidos) {
	$i=0;
	foreach ($vetorEnvolvidos as $elemento) {
		$sindicancia->envolvido[$i]=new envolvido();
		$sindicancia->envolvido[$i]->setValues($elemento,"","simples");
	$i++;
	}
}

$vetorOfendidos=$_REQUEST['ofendido'];
if ($vetorOfendidos) {
	$i=0;
	foreach ($vetorOfendidos as $elemento) {
		$sindicancia->ofendido[$i]=new ofendido();
		$sindicancia->ofendido[$i]->setValues($elemento,"","simples");
	$i++;
	}
}

//Captura ligacoes
$vetorLigacao=$_REQUEST['ligacao'];
if ($vetorLigacao) {
	$i=0;
	foreach ($vetorLigacao as $elemento) {
		$sindicancia->ligacao[$i]=new ligacao();
		$sindicancia->ligacao[$i]->setValues($elemento,"","simples");
		$sindicancia->ligacao[$i]->destino_proc="sindicancia";
		$sindicancia->ligacao[$i]->destino_sjd_ref=$sindicancia->sjd_ref;
		$sindicancia->ligacao[$i]->destino_sjd_ref_ano=$sindicancia->sjd_ref_ano;
	$i++;
	}
}

//Fim definição de variáveis.

//Debug
if ($_SESSION['debug']) { pre($sindicancia); }

//include ("menu.inc");
if (strtolower($opcao)=="cadastrar")  {
	if (strtolower($acao)=="cadastrar") {
		if (!$sindicancia->sjd_ref) {
			$sql="SELECT MAX(sjd_ref) AS ultimo FROM sindicancia WHERE sjd_ref_ano='".$sindicancia->sjd_ref_ano."'";
			if ($_SESSION[debug]) echo "$sql<br>\r\n";
			$row=mysql_fetch_array(mysql_query($sql));
			$sindicancia->sjd_ref=($row[ultimo]+1);
			
		}
				
		$id=sindicancia::insere($sindicancia);
		log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", inseriu o <a href=\"?module=sindicancia&sindicancia[id]=$id\">sindicancia nº ".$sindicancia->sjd_ref."/".$_SESSION[sjd_ano]."</a>","sindicancia");
		echo "<h2>Sindicância cadastrada com sucesso!</h2>";
		echo "<a href='?module=sindicancia&opcao=lista'>Clique aqui para voltar.</a>";
	}
	else {
		include ("formulario.inc.php");
	}
}
elseif (strtolower($opcao)=="atualizar") {
	if (strtolower($acao)=="atualizar") {
		if ($id=sindicancia::atualiza($sindicancia)) {
                        log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", atualizou o <a href=\"?module=sindicancia&sindicancia[id]=$id\">sindicancia nº ".$sindicancia->sjd_ref."/".$_SESSION[sjd_ano]."</a>","sindicancia");

			echo "<h2>Sindicância atualizada com sucesso!</h2>";
			//echo "<a href='?module=sindicancia&opcao=lista'>Clique aqui para voltar.</a>";
                        echo "<a id='foco' href='?module=sindicancia&opcao=lista'><button>Clique aqui para voltar &agrave; lista.</button></a><br><br>";
                        echo "<a href='?module=sindicancia&sindicancia[id]=".$sindicancia->id_sindicancia."'><button>Clique aqui para voltar &agrave; Sindicancia.</button></a>";
			js::foco();
		}
		else {
			echo "Houve um problema durante a execução da solicitação!";
		}
	}
	else {
                log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", visualizou o <a href=\"?module=sindicancia&sindicancia[id]=$sindicancia->id_sindicancia\">sindicancia nº ".$sindicancia->sjd_ref."/".$_SESSION[sjd_ano]."</a>","sindicancia");
		include ("formulario.inc.php");
	}
}
elseif ($opcao=="lista" or $opcao=="listar") {
       include ("lista.inc");
}
elseif ($opcao=="apagar") {
	if ($acao=="apagar") {
		if (sindicancia::apaga($sindicancia)) {
			echo "<h2>Sindicância apagada com sucesso!</h2>";
			echo "<a href='?module=sindicancia&opcao=lista'>Clique aqui para voltar à lista</a>";
			log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", apagou o sindicancia nº ".$sindicancia->sjd_ref."/".$_SESSION[sjd_ano]."</a>","sindicancia");
		}
		else {
			echo "Houve um problema durante a execução da solicitação!";
		}
	}
	else {
		echo "<h1>Deseja realmente apagar a sindicância n&ordm; ".$sindicancia->sjd_ref."?</h1>";
		echo "<form name='sindicancia'><input type=hidden name=sindicancia[id_sindicancia] value='".$sindicancia->id_sindicancia."'><input 
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
