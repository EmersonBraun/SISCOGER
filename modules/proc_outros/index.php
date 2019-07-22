<?php

if ($_REQUEST['proc_outros']['id'] and !$opcao) $opcao="atualizar";
if (!$opcao) $opcao="cadastrar";

//Definição de variáveis, incluindo pais e filhos
$proc_outros=new proc_outros();

$proc_outros->setValues($_REQUEST['proc_outros']);
$posto=$_REQUEST['posto'];

$vetorEnvolvidos=$_REQUEST['envolvido'];
if ($vetorEnvolvidos) {
	$i=0;
	foreach ($vetorEnvolvidos as $elemento) {
		$proc_outros->envolvido[$i]=new envolvido();
		$proc_outros->envolvido[$i]->setValues($elemento,"","simples");
	$i++;
	}
}

$vetorOfendidos=$_REQUEST['ofendido'];
if ($vetorOfendidos) {
	$i=0;
	foreach ($vetorOfendidos as $elemento) {
		$proc_outros->ofendido[$i]=new ofendido();
		$proc_outros->ofendido[$i]->setValues($elemento,"","simples");
	$i++;
	}
}

//Captura ligacoes
$vetorLigacao=$_REQUEST['ligacao'];
if ($vetorLigacao) {
	$i=0;
	foreach ($vetorLigacao as $elemento) {
		$proc_outros->ligacao[$i]=new ligacao();
		$proc_outros->ligacao[$i]->setValues($elemento,"","simples");
		$proc_outros->ligacao[$i]->destino_proc="proc_outros";
		$proc_outros->ligacao[$i]->id_proc_outros=$proc_outros->id_proc_outros;
	$i++;
	}
}
//Fim definição de variáveis.

//Debug
if ($_SESSION['debug']) { pre($proc_outros); }
//if ($_SESSION['debug']) { echo "<pre>";print_r($tramitacao); echo "</pre>"; }

if (strtolower($acao)=="cadastrar") $opcao="cadastrar";
if (strtolower($acao)=="atualizar") $opcao="atualizar";

if (strtolower($opcao)=="cadastrar")  {

	if (strtolower($acao)=="cadastrar") {

		if (!$proc_outros->sjd_ref) {

			$sql="SELECT MAX(sjd_ref) AS ultimo FROM proc_outros WHERE sjd_ref_ano='".$proc_outros->sjd_ref_ano."'";
			$row=mysql_fetch_array(mysql_query($sql));
			$proc_outros->sjd_ref = ($row[ultimo] == 0) ? 1 : $row[ultimo]+1 ;
			//$proc_outros->sjd_ref=($row[ultimo]+1);
			
		}

		$id=proc_outros::insere($proc_outros);
		log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", inseriu o <a href=\"?module=proc_outros&proc_outros[id]=$id\">".$proc_outros->sjd_ref."/".$_SESSION[sjd_ano]."</a>","proc_outros");
		//echo $sql;
		echo "<h2>Tramitacao proc_outros cadastrada com sucesso!</h2>";
		echo "<a href='?module=proc_outros&opcao=lista'>Clique aqui para voltar.</a>";

	}else {

		include ("formulario.inc.php");

	}
}

elseif (strtolower($opcao)=="atualizar") {
	if (strtolower($acao)=="atualizar") {
		if (proc_outros::atualiza($proc_outros)) {
			echo "<h2>Tramitacao proc_outros atualizada com sucesso!</h2>";
			echo "<a id='foco' onclick='retornarAtualizar(this)' href='?module=proc_outros&opcao=buscar'>Clique aqui para voltar.</a>";
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

elseif ($opcao=="andamento") {
	include ("menu.inc");
	include ("andamento.php");
}

elseif ($opcao=="prazo") {
	include ("menu.inc");
	include ("prazo.php");
}

elseif ($opcao=="buscar" || $opcao=="busca") {
	include ("menu.inc");
	include ("filtro.inc.php");
	include ("lista.inc.php");
}
elseif ($opcao=="listar" || $opcao=="lista") {
	include ("menu.inc");
	include ("filtro.inc.php");
	include ("lista.inc.php");
}

elseif ($opcao=="resultado") {
	include ("menu.inc");
	include ("filtro.inc.php");
	include ("resultado.php");
}

elseif ($opcao=="envolvido") {
	include ("menu.inc");
	include ("envolvido.php");
}

elseif ($opcao=="apagar") {
	if (proc_outros::apaga($proc_outros)) {

		$sql5="DELETE FROM proc_outros WHERE proc_outros='".$_GET['proc_outros']['id']."'";
		mysql_query($sql5);

		echo "<h2>Tramitacao apagada com sucesso!</h2>";
		echo "<a id='foco' href='?module=proc_outros&opcao=buscar'>Clique aqui para voltar à lista</a>";
		log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", apagou o proc_outros nº ".$proc_outros->id_proc_outros."</a>","proc_outros");
		//echo "<a id='foco' onclick='javascript:history.go(-1)' href='#'>Clique aqui para voltar.</a>";
	}
	else {
		echo "Houve um problema durante a execução da solicitação!";
	}
}else {
	include ("$opcao.php");
}

?>
<script language='javascript'>document.getElementById('foco').focus()</script>

