<?
//Core
if ($_REQUEST['cj']['id']) $opcao="atualizar";
if (!$opcao) $opcao="cadastrar";

//Definição de variáveis, incluindo pais e filhos
$cj=new cj();
$cj->setValues($_REQUEST['cj']);

if (!$cj->ac_desempenho_bl) $cj->ac_desempenho_bl="";
if (!$cj->ac_conduta_bl) $cj->ac_conduta_bl="";
if (!$cj->ac_honra_bl) $cj->ac_honra_bl="";

$vetorEnvolvidos=$_REQUEST['envolvido'];
if ($vetorEnvolvidos) {
	$i=0;
	foreach ($vetorEnvolvidos as $elemento) {
		$cj->envolvido[$i]=new envolvido();
		$cj->envolvido[$i]->setValues($elemento,"","simples");
	$i++;
	}
}

$vetorOfendidos=$_REQUEST['ofendido'];
if ($vetorOfendidos) {
	$i=0;
	foreach ($vetorOfendidos as $elemento) {
		$cj->ofendido[$i]=new ofendido();
		$cj->ofendido[$i]->setValues($elemento,"","simples");
	$i++;
	}
}
//Captura ligacoes
$vetorLigacao=$_REQUEST['ligacao'];
if ($vetorLigacao) {
	$i=0;
	foreach ($vetorLigacao as $elemento) {
		$cj->ligacao[$i]=new ligacao();
		$cj->ligacao[$i]->setValues($elemento,"","simples");
		$cj->ligacao[$i]->destino_proc="cj";
		$cj->ligacao[$i]->destino_sjd_ref=$cj->sjd_ref;
		$cj->ligacao[$i]->destino_sjd_ref_ano=$cj->sjd_ref_ano;
	$i++;
	}
}

//Fim definição de variáveis.

//Debug
if ($_SESSION['debug']) { pre($cj); }

//include ("menu.inc");
if (strtolower($opcao)=="cadastrar")  {
	if (strtolower($acao)=="cadastrar") {
		if (!$cj->sjd_ref) {
			$sql="SELECT MAX(sjd_ref) AS ultimo FROM cj WHERE sjd_ref_ano='".$cj->sjd_ref_ano."'";
			$row=mysql_fetch_array(mysql_query($sql));
			$cj->sjd_ref=($row[ultimo]+1);
			
		}
		$id=cj::insere($cj);
		log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", inseriu o <a href=\"?module=cj&cj[id]=$id\">cj nº ".$cj->sjd_ref."/".$_SESSION[sjd_ano]."</a>","cj");
		echo "<h2>Conselho de Justifica&ccedil;&atilde;o cadastrado com sucesso!</h2>";
		echo "<a href='?module=cj&opcao=lista'>Clique aqui para voltar.</a>";
	}
	else {
		include ("formulario.inc.php");
	}
}
elseif (strtolower($opcao)=="atualizar") {
	if (strtolower($acao)=="atualizar") {
		if ($id=cj::atualiza($cj)) {
                        log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", atualizou o <a href=\"?module=cj&cj[id]=$id\">cj nº ".$cj->sjd_ref."/".$_SESSION[sjd_ano]."</a>","cj");

			echo "<h2>Conselho de Justifica&ccedil;&atilde;o atualizado com sucesso!</h2>";
			//echo "<a href='?module=cj&opcao=lista'>Clique aqui para voltar.</a>";
                        echo "<a id='foco' href='?module=cj&opcao=lista'><button>Clique aqui para voltar &agrave; lista.</button></a><br><br>";
                        echo "<a href='?module=cj&cj[id]=".$cj->id_cj."'><button>Clique aqui para voltar ao Conselho.</button></a>";
                        js::foco();

		}
		else {
			echo "Houve um problema durante a execução da solicitação!";
		}
	}
	else {
                log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", visualizou o <a href=\"?module=cj&cj[id]=$cj->id_cj\">cj nº ".$cj->sjd_ref."/".$_SESSION[sjd_ano]."</a>","cj");
		include ("formulario.inc.php");
	}
}
elseif ($opcao=="lista" or $opcao=="listar") {
       include ("menu.inc"); echo "<br>";
       include ("lista.inc");
}
elseif ($opcao=="apagar") {
	if ($acao=="apagar") {
		if (cj::apaga($cj)) {
			echo "<h2>Conselho de Justifica&ccedil;&atilde;o apagado com sucesso!</h2>";
			echo "<a href='?module=cj&opcao=lista'>Clique aqui para voltar à lista</a>";
			log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", apagou o cj nº ".$cj->sjd_ref."/".$_SESSION[sjd_ano]."</a>","cj");
		}
		else {
			echo "Houve um problema durante a execução da solicitação!";
		}
	}
	else {
		echo "<h1>Deseja realmente apagar o cj n&ordm; ".$cj->sjd_ref."?</h1>";
		echo "<form name='cj'><input type=hidden name=cj[id_cj] value='".$cj->id_cj."'><input 
type=submit name='acao' value='Apagar'></form>";
	}
}
elseif ($opcao=="buscar") {
	include ("filtro.inc");
	include ("lista.inc");
}
else {
	include ("menu.inc"); echo "<br>";
	include ("$opcao.php");
}

?>
