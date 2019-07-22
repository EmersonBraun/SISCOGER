<?
//Core
if ($_REQUEST['adl']['id']) $opcao="atualizar";

if (!$opcao) $opcao="cadastrar";

//Definição de variáveis, incluindo pais e filhos
$adl=new adl();
$adl->setValues($_REQUEST['adl']);

if (!$adl->ac_desempenho_bl) $adl->ac_desempenho_bl="";
if (!$adl->ac_conduta_bl) $adl->ac_conduta_bl="";
if (!$adl->ac_honra_bl) $adl->ac_honra_bl="";

$vetorEnvolvidos=$_REQUEST['envolvido'];
if ($vetorEnvolvidos) {
	$i=0;
	foreach ($vetorEnvolvidos as $elemento) {
		$adl->envolvido[$i]=new envolvido();
		$adl->envolvido[$i]->setValues($elemento,"","simples");
	$i++;
	}
}

$vetorOfendidos=$_REQUEST['ofendido'];
if ($vetorOfendidos) {
	$i=0;
	foreach ($vetorOfendidos as $elemento) {
		$adl->ofendido[$i]=new ofendido();
		$adl->ofendido[$i]->setValues($elemento,"","simples");
	$i++;
	}
}

//Captura ligacoes
$vetorLigacao=$_REQUEST['ligacao'];
if ($vetorLigacao) {
	$i=0;
	foreach ($vetorLigacao as $elemento) {
		$adl->ligacao[$i]=new ligacao();
		$adl->ligacao[$i]->setValues($elemento,"","simples");
		$adl->ligacao[$i]->destino_proc="adl";
		$adl->ligacao[$i]->destino_sjd_ref=$adl->sjd_ref;
		$adl->ligacao[$i]->destino_sjd_ref_ano=$adl->sjd_ref_ano;
	$i++;
	}
}
//Fim definição de variáveis.

//Debug
if ($_SESSION['debug']) { pre($adl); }


if (strtolower($opcao)=="cadastrar")  {
	if (strtolower($acao)=="cadastrar") {
		if (!$adl->sjd_ref) {
			$sql="SELECT MAX(sjd_ref) AS ultimo FROM adl WHERE sjd_ref_ano='".$adl->sjd_ref_ano."'";
			if ($_SESSION[debug]) echo "$sql<br>\r\n";
			$row=mysql_fetch_array(mysql_query($sql));
			$adl->sjd_ref=($row[ultimo]+1);
			
		}
				
		$id=adl::insere($adl);
		log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", inseriu o <a href=\"?module=adl&adl[id]=$id\">adl nº ".$adl->sjd_ref."/".$adl->sjd_ref_ano."</a>","adl");
		echo "<h2>Apuração Disciplinar de Licenciamento cadastrado com Sucesso !</h2>";
		echo "<a href='?module=adl&opcao=lista'>Clique aqui para voltar.</a>";
	}
	else {
		include ("formulario.inc.php");
	}
}
elseif (strtolower($opcao)=="atualizar") {
	if (strtolower($acao)=="atualizar") {
		if ($id=adl::atualiza($adl)) {
                        log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", atualizou o <a href=\"?module=adl&adl[id]=$id\">adl nº ".$adl->sjd_ref."/".$adl->sjd_ref_ano."</a>","adl");

			echo "<h2>Apuração Disciplinar atualizado com sucesso!</h2>";
			//echo "<a href='?module=adl&opcao=lista'>Clique aqui para voltar.</a>";
                        echo "<a id='foco' href='?module=adl&opcao=lista'><button>Clique aqui para voltar &agrave; lista.</button></a><br><br>";
                        echo "<a href='?module=adl&adl[id]=".$adl->id_adl."'><button>Clique aqui para voltar &agrave; ADL.</button></a>";
                        js::foco();
		}
		else {
			echo "Houve um problema durante a execução da solicitação!";
		}
	}
	else {
                log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", visualizou o <a href=\"?module=adl&adl[id]=$adl->id_adl\">adl nº ".$adl->sjd_ref."/".$adl->sjd_ref_ano."</a>","adl");
		include ("formulario.inc.php");
	}
}
elseif ($opcao=="lista" or $opcao=="listar") {
	include ("menu.inc");
	include ("lista.inc");
}
elseif ($opcao=="apagar") {
	if ($acao=="apagar") {
		if (adl::apaga($adl)) {
			echo "<h2>Apuração Disciplinar apagado com sucesso!</h2>";
			echo "<a href='?module=adl&opcao=lista'>Clique aqui para voltar à lista</a>";
			log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", apagou o adl nº ".$adl->sjd_ref."/".$adl->sjd_ref_ano."</a>","adl");
		}
		else {
			echo "Houve um problema durante a execução da solicitação!";
		}
	}
	else {
		echo "<h1>Deseja realmente apagar o adl n&ordm; ".$adl->sjd_ref."?</h1>";
		echo "<form name='adl'><input type=hidden name=adl[id_adl] value='".$adl->id_adl."'><input 
type=submit name='acao' value='Apagar'></form>";
	}
}
elseif ($opcao=="buscar") {
	include ("filtro.inc");
	include ("lista.inc");
}
else {
	include ("menu.inc");
	include ("$opcao.php");
}

?>
