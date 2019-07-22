<?php

if ($_REQUEST['sai']['id'] and !$opcao) $opcao="atualizar";
if (!$opcao) $opcao="cadastrar";
$ano = ($_SESSION[sjd_ano] >= '2018') ? $fatd->sjd_ref_ano=$_SESSION[sjd_ano] : '2018' ;
if (!$fatd->sjd_ref_ano) $fatd->sjd_ref_ano=$ano;
//Definição de variáveis, incluindo pais e filhos
$sai=new sai();

$sai->setValues($_REQUEST['sai']);
$posto=$_REQUEST['posto'];

$vetorEnvolvidos=$_REQUEST['envolvido'];
if ($vetorEnvolvidos) {
	$i=0;
	foreach ($vetorEnvolvidos as $elemento) {
		$sai->envolvido[$i]=new envolvido();
		$sai->envolvido[$i]->setValues($elemento,"","simples");
	$i++;
	}
}

$vetorOfendidos=$_REQUEST['ofendido'];
if ($vetorOfendidos) {
	$i=0;
	foreach ($vetorOfendidos as $elemento) {
		$sai->ofendido[$i]=new ofendido();
		$sai->ofendido[$i]->setValues($elemento,"","simples");
	$i++;
	}
}

//Captura ligacoes
$vetorLigacao=$_REQUEST['ligacao'];
if ($vetorLigacao) {
	$i=0;
	foreach ($vetorLigacao as $elemento) {
		$sai->ligacao[$i]=new ligacao();
		$sai->ligacao[$i]->setValues($elemento,"","simples");
		$sai->ligacao[$i]->destino_proc="sai";
		$sai->ligacao[$i]->id_sai=$sai->id_sai;
	$i++;
	}
}
//Fim definição de variáveis.

//Debug
if ($_SESSION['debug']) { pre($sai); }
//if ($_SESSION['debug']) { echo "<pre>";print_r($tramitacao); echo "</pre>"; }

if (strtolower($acao)=="cadastrar") $opcao="cadastrar";
if (strtolower($acao)=="atualizar") $opcao="atualizar";

if (strtolower($opcao)=="cadastrar")  {

	if (strtolower($acao)=="cadastrar") {

		if (!$sai->sjd_ref) {
			$sql="SELECT MAX(sjd_ref) AS ultimo FROM sai WHERE sjd_ref_ano='".$ano."'";
			$row=mysql_fetch_array(mysql_query($sql));
			$sai->sjd_ref=($row[ultimo]+1);
			
		}

		$id=sai::insere($sai);
		log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", inseriu o <a href=\"?module=sai&sai[id]=$id\">".$sai->sjd_ref."/".$_SESSION[sjd_ano]."</a>","sai");
		//echo $sql;
		echo "<h2>Tramitacao SAI cadastrada com sucesso!</h2>";
		echo "<a href='?module=sai&opcao=cadastrar'>Clique aqui para Cadastrar outro.</a><br><br>";
		echo "<a href='?module=sai&opcao=lista'>Clique aqui para ir para a lista.</a><br>";

	}else {

		include ("formulario.inc.php");

	}
}

elseif (strtolower($opcao)=="atualizar") {
	if (strtolower($acao)=="atualizar") {
		if (sai::atualiza($sai)) {
			echo "<h2>Tramitacao SAI atualizada com sucesso!</h2>";
			echo "<a id='foco' onclick='retornarAtualizar(this)' href='?module=sai&opcao=lista'>Clique aqui para voltar.</a>";
		}
		else {
			echo "Houve um problema durante a execução da solicitação!";
		}
	}
	else {
		//include ("menu.inc.php");
		include ("formulario.inc.php");
	}
}

/*elseif ($opcao=="lista" or $opcao=="listar") {
    include ("menu.inc");
    include ("filtro.inc.php");
    include ("lista.inc.php");
}*/
elseif ($opcao=="buscar" || $opcao=="busca" || $opcao=="listar" || $opcao=="lista") {
	include ("menu.inc");
	include ("filtro.inc.php");
	include ("lista.inc.php");
}

elseif ($opcao=="resultado") {
	include ("menu.inc");
	include ("filtro.inc.php");
	include ("resultado.php");
}

elseif ($opcao=="apagar") {
	if (sai::apaga($sai)) {

		$sql5="DELETE FROM sai WHERE sai='".$_GET['sai']['id']."'";
		mysql_query($sql5);

		echo "<h2>Tramitacao apagada com sucesso!</h2>";
		echo "<a id='foco' href='?module=sai&opcao=buscar'>Clique aqui para voltar à lista</a>";
		log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", apagou o SAI nº ".$sai->id_sai."</a>","sai");
		//echo "<a id='foco' onclick='javascript:history.go(-1)' href='#'>Clique aqui para voltar.</a>";
	}
	else {
		echo "Houve um problema durante a execução da solicitação!";
	}
}
if (strtolower($opcao)=="diligencia")  {
	if (strtolower($acao)=="adicionardiligencia" && !empty($_POST['saidiligencias'])) {
		$obj2 = (object) $_POST['saidiligencias'];

		sai::insere($obj2, "saidiligencias");
		echo "<h2>Diligencia SAI cadastrada com sucesso!</h2>";
		echo "<a id='foco' onclick='retornarAtualizar(this)' href='?module=sai&opcao=lista'>Clique aqui para voltar.</a>";
	}
	elseif (strtolower($acao)=="editardiligencia" && !empty($_POST['saidiligencias'])) {
		$obj2 = (object) $_POST['saidiligencias'];

		sai::atualiza($obj2, "saidiligencias");
		echo "<h2>Diligencia SAI editada com sucesso!</h2>";
		echo "<a id='foco' onclick='retornarAtualizar(this)' href='?module=sai&opcao=lista'>Clique aqui para voltar.</a>";
	}
	elseif (strtolower($acao)=="apagardiligencia") {
		$sql="DELETE FROM saidiligencias WHERE id_saidiligencias='".$_GET['saidiligencias']['id']."'";
		if ($_SESSION['debug']) echo "Executando: ".$sql."<br>";

		if (mysql_query($sql)) {
			echo "<h2>Diligencia SAI apagada com sucesso!</h2>";
			echo "<a id='foco' onclick='retornarAtualizar(this)' href='?module=sai&opcao=lista'>Clique aqui para voltar.</a>";
		}
		else {
			echo "Houve um problema durante a execução da solicitação!";
		}
	}
	else {
		include ("menu.inc");
		include ("diligencia.php");
	}
}

elseif ($opcao=="andamento") {
	include ("menu.inc");
	include ("andamento.php");
}

elseif ($opcao=="prazo") {
	include ("menu.inc");
	include ("prazo.php");
}
?>
<script language='javascript'>document.getElementById('foco').focus()</script>

