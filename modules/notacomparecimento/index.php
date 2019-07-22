<?

//Core
if (
        ($_REQUEST['notacomparecimento']['id'])
        && (!in_array($_REQUEST['opcao'], array('visualizar','listarapresentacoes','apresentacaomassificado', 'download')))
   ) {
    $opcao="atualizar";
}

if (!$opcao) $opcao="listar";

//Definição de variáveis, incluindo pais e filhos
$notacomparecimento=new notacomparecimento();
$notacomparecimento->setValues($_REQUEST['notacomparecimento']);

if ($opcao == 'download') {
    include 'download.php';
    exit();
}

if (($opcao=='apresentacaomassificado') && ($_REQUEST['notacomparecimento']['id'])) {
    include ("menu.inc.php");
    include 'formulario.visualizar.inc.php';
    include dirname(__DIR__) . DIRECTORY_SEPARATOR . 'apresentacaomassificado' . DIRECTORY_SEPARATOR . 'cadastro.php';
    exit();
} else if (($opcao=='apresentacaomassificado') && (!(isset($_REQUEST['notacomparecimento']['id'])))) {
    $opcao = 'listar';
}

if ($_SESSION['debug']) { var_dump($_REQUEST); }

/*
$vetorEnvolvidos=$_REQUEST['envolvido'];
if ($vetorEnvolvidos) {
	$i=0;
	foreach ($vetorEnvolvidos as $elemento) {
		$iso->envolvido[$i]=new envolvido();
		$iso->envolvido[$i]->setValues($elemento,"","simples");
	$i++;
	}
}
*/

//Debug
if ($_SESSION['debug']) { pre($notacomparecimento); }

if (strtolower($opcao)=="cadastrar")  {
        if (empty($notacomparecimento->sjd_ref)) {
            $sql="SELECT MAX(sjd_ref) AS ultimo FROM notacomparecimento WHERE sjd_ref_ano=".date("Y");
            $row=mysql_fetch_array(mysql_query($sql));
            $notacomparecimento->sjd_ref=($row['ultimo']+1);
            $notacomparecimento->expedicao_data=date("d/m/Y");
            $notacomparecimento->autoridade_funcao = "Corregedor-Geral";
        }
	if (strtolower($acao)=="cadastrar") {
		$id=notacomparecimento::insere($notacomparecimento,'', false);
		log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", inseriu a <a href=\"?module=notacomparecimento&notacomparecimento[id]=$id\">Nota Comparecimento nº ".$notacomparecimento->sjd_ref."/".$notacomparecimento->sjd_ref_ano."</a>","notacomparecimento");
		echo "<h2>";
                echo htmlentities("Nota de comparecimento cadastrada com sucesso!");
                echo "</h2>";
		echo "<a href='?module=notacomparecimento&opcao=listar'>Clique aqui para voltar.</a><br><br>";
                echo "<a href='?module=notacomparecimento&opcao=atualizar&notacomparecimento[id]=".$id."'><button>Clique aqui para voltar a nota.</button></a>";
	}
	else {
                include ("menu.inc.php");
		include ("formulario.inc.php");
	}
}
elseif (strtolower($opcao)=="atualizar") {
	if (strtolower($acao)=="atualizar") {
		if (notacomparecimento::atualiza($notacomparecimento)) {
                        log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", atualizou a <a href=\"?module=notacomparecimento&notacomparecimento[id]=$id\">Nota Comparecimento nº ".$notacomparecimento->sjd_ref."/".$notacomparecimento->sjd_ref_ano."</a>","notacomparecimento");
                        echo "<h2>";
                        echo htmlentities("Nota de comparecimento atualizada com sucesso!");
                        echo "</h2>";
                        echo "<a id='foco' href='?module=notacomparecimento&opcao=listar'><button>Clique aqui para voltar &agrave; lista.</button></a><br><br>";
                        echo "<a href='?module=notacomparecimento&notacomparecimento[id]=".$notacomparecimento->id_notacomparecimento."'><button>Clique aqui para voltar a nota.</button></a>";
                        js::foco();
		}
		else {
			echo "Houve um problema durante a execução da solicitação!";
		}
	}
	else {
                include ("menu.inc.php");
		include ("formulario.inc.php");
	}
}
elseif ($opcao=="lista" or $opcao=="listar") {
	include ("menu.inc.php");
        include ("lista.inc.php");
}
elseif ($opcao=="apagar") {
	if ($acao=="apagar") {
		if (notacomparecimento::apaga($notacomparecimento)) {
			echo "<h2>Nota de Comparecimento apagada com sucesso!</h2>";
			echo "<a href='?module=iso&opcao=lista'>Clique aqui para voltar à lista</a>";
			log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", apagou a Nota de Comparecimento nº ".$notacomparecimento->sjd_ref."/".$notacomparecimento->sjd_ref_ano."</a>","notacomparecimento");
		}
		else {
			echo "Houve um problema durante a execução da solicitação!";
		}
	}
	else {
		echo "<h1>Deseja realmente apagar o Nota de Comparecimento n&ordm; ".$notacomparecimento->sjd_ref."/".$notacomparecimento->sjd_ref_ano."?</h1>";
		echo "<form name='notacomparecimento'><input type=hidden name=notacomparecimento[id_notacomparecimento] value='".$notacomparecimento->id_notacomparecimento."'><input
type=submit name='acao' value='Apagar'></form>";
	}
}
elseif ($opcao=="buscar") {
	include ("filtro.inc.php");
	include ("lista.inc.php");
}
else {
	include ("menu.inc.php");
        include ("{$opcao}.php");
}
