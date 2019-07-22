<?

//Core
if ($_REQUEST['iso']['id']) $opcao="atualizar";
if (!$opcao) $opcao="cadastrar";

//Definição de variáveis, incluindo pais e filhos
$iso=new iso();
$iso->setValues($_REQUEST['iso']);

$vetorEnvolvidos=$_REQUEST['envolvido'];
if ($vetorEnvolvidos) {
	$i=0;
	foreach ($vetorEnvolvidos as $elemento) {
		$iso->envolvido[$i]=new envolvido();
		$iso->envolvido[$i]->setValues($elemento,"","simples");
	$i++;
	}
}

//Captura ligacoes
$vetorLigacao=$_REQUEST['ligacao'];
if ($vetorLigacao) {
	$i=0;
	foreach ($vetorLigacao as $elemento) {
		$iso->ligacao[$i]=new ligacao();
		$iso->ligacao[$i]->setValues($elemento,"","simples");
		$iso->ligacao[$i]->destino_proc="iso";
		$iso->ligacao[$i]->destino_sjd_ref=$iso->sjd_ref;
		$iso->ligacao[$i]->destino_sjd_ref_ano=$iso->sjd_ref_ano;
	$i++;
	}
}

//Fim definição de variáveis.

//Debug
if ($_SESSION['debug']) { pre($iso); }

if (strtolower($opcao)=="cadastrar")  {
	if (strtolower($acao)=="cadastrar") {

		if (!$iso->sjd_ref) {
			$sql="SELECT MAX(sjd_ref) AS ultimo FROM iso WHERE sjd_ref_ano='".$iso->sjd_ref_ano."'";
			$row=mysql_fetch_array(mysql_query($sql));
			$iso->sjd_ref=($row[ultimo]+1);
			
		}
				
		$id=iso::insere($iso);
		log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", inseriu o <a href=\"?module=iso&iso[id]=$id\">iso nº ".$iso->sjd_ref."/".$_SESSION[sjd_ano]."</a>","iso");
		echo "<h2>Inqu&eacute;rito Sanit&aacute;rio de Origemcadastrado com sucesso!</h2>";
		echo "<a href='?module=iso&opcao=listar'>Clique aqui para voltar.</a>";
	}
	else {

		include ("formulario.inc.php");

	}
}
elseif (strtolower($opcao)=="atualizar") {
	if (strtolower($acao)=="atualizar") {
		if (iso::atualiza($iso)) {
			echo "<h2>Inqu&eacute;rito Sanit&aacute;rio de Origematualizado com sucesso!</h2>";
			//echo "<a href='?module=iso&opcao=lista'>Clique aqui para voltar.</a>";
                        echo "<a id='foco' href='?module=iso&opcao=listar'><button>Clique aqui para voltar &agrave; lista.</button></a><br><br>";
                        echo "<a href='?module=iso&iso[id]=".$iso->id_iso."'><button>Clique aqui para voltar ao ISO.</button></a>";
                        js::foco();
		}
		else {
			echo "Houve um problema durante a execução da solicitação!";
		}
	}
	else {
		include ("formulario.inc.php");
	}
}
elseif ($opcao=="lista" or $opcao=="listar") {
		include ("menu.inc");
       include ("lista.inc");
}
elseif ($opcao=="apagar") {
	if ($acao=="apagar") {
		if (iso::apaga($iso)) {
			echo "<h2>Inqu&eacute;rito Sanit&aacute;rio de Origemapagado com sucesso!</h2>";
			echo "<a href='?module=iso&opcao=lista'>Clique aqui para voltar à lista</a>";
			log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", apagou o iso nº ".$iso->sjd_ref."/".$_SESSION[sjd_ano]."</a>","iso");
		}
		else {
			echo "Houve um problema durante a execução da solicitação!";
		}
	}
	else {
		echo "<h1>Deseja realmente apagar o ISO n&ordm; ".$iso->sjd_ref."?</h1>";
		echo "<form name='iso'><input type=hidden name=iso[id_iso] value='".$iso->id_iso."'><input 
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
