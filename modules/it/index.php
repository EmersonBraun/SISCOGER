<?php
//Core
if ($_REQUEST['it']['id']) $opcao="atualizar";
if (!$opcao) $opcao="cadastrar";

//Definição de variáveis, incluindo pais e filhos
$it=new it();
$it->setValues($_REQUEST['it']);

$vetorEnvolvidos=$_REQUEST['envolvido'];
if ($vetorEnvolvidos) {
	$i=0;
	foreach ($vetorEnvolvidos as $elemento) {
		$it->envolvido[$i]=new envolvido();
		$it->envolvido[$i]->setValues($elemento,"","simples");
	$i++;
	}
}

$vetorOfendidos=$_REQUEST['ofendido'];
if ($vetorOfendidos) {
	$i=0;
	foreach ($vetorOfendidos as $elemento) {
		$it->ofendido[$i]=new ofendido();
		$it->ofendido[$i]->setValues($elemento,"","simples");
	$i++;
	}
}
//Fim definição de variáveis.

//Debug
if ($_SESSION['debug']) { pre($it); }

//include ("menu.inc");
if (strtolower($opcao)=="cadastrar")  {
	echo $sql;
	if (strtolower($acao)=="cadastrar") {
		if (!$it->sjd_ref) {
			$sql="SELECT MAX(sjd_ref) AS ultimo FROM it WHERE sjd_ref_ano='".$it->sjd_ref_ano."'";
			$row=mysql_fetch_array(mysql_query($sql));
			$it->sjd_ref=($row[ultimo]+1);
			
		}
		$id=it::insere($it);
		log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", inseriu o <a href=\"?module=it&it[id]=$id\">".$it->sjd_ref."/".$_SESSION[sjd_ano]."</a>","it");
		//echo $sql;
		echo "<h2>Inqu&eacute;rito T&eacute;cnico cadastrado com sucesso!</h2>";
		echo "<a href='?module=it&opcao=lista'>Clique aqui para voltar.</a>";
	}
	else {
		include ("formulario.inc.php");
	}
}
elseif (strtolower($opcao)=="atualizar") {
	if (strtolower($acao)=="atualizar") {
		if ($id=it::atualiza($it)) {
                        log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", atualizou o <a href=\"?module=it&it[id]=$id\">".$it->sjd_ref."/".$_SESSION[sjd_ano]."</a>","it");

			echo "<h2>Inqu&eacute;rito T&eacute;cnico atualizado com sucesso!</h2>";
			echo "<a href='?module=it&opcao=lista'>Clique aqui para voltar.</a>";
		}
		else {
			echo "Houve um problema durante a execução da solicitação!";
		}
	}
	else {
                log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", visualizou o <a href=\"?module=it&it[id]=$it->id_it\">".$it->sjd_ref."/".$_SESSION[sjd_ano]."</a>","it");
		include ("formulario.inc.php");
	}
}
elseif ($opcao=="lista" or $opcao=="listar") {
	include ("menu.inc");
    include ("lista.inc");
}
elseif ($opcao=="apagar") {
	if ($acao=="apagar") {
		if (it::apaga($it)) {
			echo "<h2>Inquerito Tecnico apagado com sucesso!</h2>";
			echo "<a href='?module=it&opcao=lista'>Clique aqui para voltar à lista</a>";
			log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", apagou o it nº ".$it->sjd_ref."/".$_SESSION[sjd_ano]."</a>","it");
		}
		else {
			echo "Houve um problema durante a execução da solicitação!";
		}
	}
	else {
		echo "<h1>Deseja realmente apagar o it n&ordm; ".$it->sjd_ref."?</h1>";
		echo "<form name='it'><input type=hidden name=it[id_it] value='".$it->id_it."'><input 
type=submit name='acao' value='Apagar'></form>";
	}
}
/*elseif ($opcao=="apagar") {
	if ($acao=="apagar") {
		if (it::apaga($it)) {
			echo "<h2>Inquerito Tecnico apagado com sucesso!</h2>";
			echo "<a href='?module=it&opcao=lista'>Clique aqui para voltar à lista</a>";
			log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", apagou o it nº ".$it->sjd_ref."/".$_SESSION[sjd_ano]."</a>","it");
		}
		else {
			echo "Houve um problema durante a execução da solicitação!";
		}
	}
	else {
		echo "<h1>Deseja realmente apagar o it n&ordm; ".$it->sjd_ref."?</h1>";
		echo "<form name='it'><input type=hidden name=it[id_it] value='".$it->id_it."'><input 
type=submit name='acao' value='Apagar'></form>";*/

elseif ($opcao=="buscar") {
	include ("menu.inc");
	include ("lista.inc");
}
elseif ($opcao=="rel_valores") {
	include ("menu.inc");
	include ("rel_valores.php");
}
else {
	include ("$opcao.php");
}

?>
