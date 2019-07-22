<?php
$pad=new pad();
$posto=$_REQUEST['posto'];
if ($_REQUEST['pad']['id'] and !$opcao) $opcao="atualizar";

//Pais e filhos
$pad->setValues($_REQUEST['pad']);

$vetorEnvolvidos=$_REQUEST['envolvido'];
if ($vetorEnvolvidos) {
	$i=0;
	foreach ($vetorEnvolvidos as $elemento) {
		$pad->envolvido[$i]=new envolvido();
		$pad->envolvido[$i]->setValues($elemento,"","simples");
	$i++;
	}
}

$vetorOfendidos=$_REQUEST['ofendido'];
if ($vetorOfendidos) {
	$i=0;
	foreach ($vetorOfendidos as $elemento) {
		$pad->ofendido[$i]=new ofendido();
		$pad->ofendido[$i]->setValues($elemento,"","simples");
	$i++;
	}
}

$vetorPJ=$_REQUEST['pj'];
if ($vetorPJ) {
	$i=0;
	foreach ($vetorPJ as $elemento) {
		$pad->pj[$i]=new pj();
		$pad->pj[$i]->setValues($elemento,"","simples");
	$i++;
	}
}

if ($_SESSION['debug']) { echo "<pre>";print_r($pad); echo "</pre>"; }	

if (!$opcao) $opcao="cadastrar";
if (strtolower($acao)=="cadastrar") $opcao="cadastrar";
if (strtolower($acao)=="atualizar") $opcao="atualizar";

if (strtolower($opcao)=="cadastrar")  {
	if (strtolower($acao)=="cadastrar") {
		if (!$pad->sjd_ref) {
			$sql="SELECT MAX(sjd_ref) AS ultimo FROM pad WHERE sjd_ref_ano='".$pad->sjd_ref_ano."'";
			$row=mysql_fetch_array(mysql_query($sql));
			$pad->sjd_ref=($row["ultimo"]+1);
		}
		//pre($pad); die;
		
		pad::insere($pad);
		echo "<h2>pad cadastrado com sucesso!</h2>";
		echo "<a id='foco' href='?module=pad&opcao=listar'>Clique aqui para voltar.</a>";
	}
	else {
		include ("menu.inc.php");
		include ("formulario.inc.php");
	}
}
elseif (strtolower($opcao)=="atualizar") {
	if (strtolower($acao)=="atualizar") {
		if (pad::atualiza($pad)) {
			echo "<h2>pad atualizado com sucesso!</h2>";
			echo "<a id='foco' href='?module=pad&opcao=listar'>Clique aqui para voltar.</a>";
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
       include ("lista.inc.php");
}
elseif ($opcao=="apagar") {
	if (pad::apaga($pad)) {
		echo "<h2>pad apagado com sucesso!</h2>";
		echo "<a id='foco' href='?module=pad&opcao=listar'>Clique aqui para voltar à lista</a>";
	}
	else {
		echo "Houve um problema durante a execução da solicitação!";
	}
}
elseif ($opcao) {
	include ("$opcao.php");
}
?>
<script language='javascript'>document.getElementById('foco').focus()</script>

