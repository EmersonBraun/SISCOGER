<?php
//error_reporting( E_ALL );

if ($opcao=='removerautoridade') {
    include $opcao . '.php';
}

if ($opcao=='buscarpelonome') {
    include $opcao . '.php';
    exit();
}

if ($opcao=='listar') {
    include ("menu.inc.php");
    include 'lista.inc.php';
    exit();
}

if ($opcao=='apresentacaoselecionaropm') {
    include $opcao . '.php';
    exit();
}

$cadastroopmcoger = new cadastroopmcoger();

$autoridades = array();

$cdopm_selected = $opm_login->codigoBase == '' ? '0' : $opm_login->codigoBase;

if(isset($_REQUEST['editar_cdopm']) && !empty($_REQUEST['editar_cdopm'])) {
    $cdopm_selected = $_REQUEST['editar_cdopm'];
    $cadastroopmcoger->setValues('', sprintf(" WHERE cdopm = '%s'", mysql_real_escape_string($cdopm_selected)));
} else if (isset($_REQUEST['cadastroopmcoger'])) {
    $cdopm_selected = (isset($_REQUEST['cadastroopmcoger']['cdopm']) && !empty($_REQUEST['cadastroopmcoger']['cdopm'])) ? $_REQUEST['cadastroopmcoger']['cdopm'] : $cdopm_selected;
    $cadastroopmcoger->setValues($_REQUEST['cadastroopmcoger']);
    $cdopm_selected = (isset($cadastroopmcoger->cdopm) && !empty($cadastroopmcoger->cdopm)) ? $cadastroopmcoger->cdopm : $cdopm_selected;
} else {
    $cadastroopmcoger->setValues('', sprintf(" WHERE cdopm = '%s'", mysql_real_escape_string($cdopm_selected)));
    $cadastroopmcoger->cdopm = $cdopm_selected;
}

if (isset($cadastroopmcoger->opm_autoridade_rg) && !empty($cadastroopmcoger->opm_autoridade_rg)) {
    $autoridade = new policial($cadastroopmcoger->opm_autoridade_rg);
} else {
    $autoridade = new policial();
}

$opmResp = new opm(str_pad($cdopm_selected,10,'0',STR_PAD_RIGHT));

if ( isset($cadastroopmcoger->id_cadastroopmcoger) && !empty($cadastroopmcoger->id_cadastroopmcoger)) {
    $opcao="atualizar";

} else {
    if (!$opcao) $opcao="cadastrar";
    $cadastroopmcoger->cdopm = $cdopm_selected;
}

//Debug
if (isset($_SESSION['debug']) && $_SESSION['debug']) { pre($cadastroopmcoger); }

if (strtolower($opcao)=="cadastrar")  {
        include ("menu.inc.php");
	if (strtolower($acao)=="cadastrar") {
            $id=cadastroopmcoger::insere($cadastroopmcoger);

            $cadastroDeAutoridades = salvarAutoridades($id);

            log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", inseriu o cadastro da opm <a href=\"?module=cadastroopmcoger&cadastroopmcoger[id]=$id\">Cadastro nº ".$cadastroopmcoger->id_cadastroopmcoger ."</a>","cadastroopmcoger");
            echo "<h2>";
            echo escaparHtml("Dados de Unidade cadastrados com sucesso!");
            echo "</h2>";

	}
        include ("formulario.inc.php");
}
elseif (strtolower($opcao)=="atualizar") {
    include ("menu.inc.php");

    if (strtolower($acao)=="atualizar") {
            if ($id=cadastroopmcoger::atualiza($cadastroopmcoger)) {

                $cadastroDeAutoridades = salvarAutoridades($id);

                log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", atualizou a <a href=\"?module=cadastroopmcoger&cadastroopmcoger[id]=$id\">Cadastro nº ".$cadastroopmcoger->id_cadastroopmcoger ."</a>","cadastroopmcoger");
                echo "<h2>";
                echo escaparHtml("Dados atualizados com sucesso!");
                echo "</h2>";

            }
            else {
                echo "<h3>Houve um problema durante a execução da solicitação!</h3>";
            }
    }
    include ("formulario.inc.php");
}
elseif ($opcao=="log") {
	include ("log.php");
}
else {
	include ("menu.inc.php");
	include ("$opcao.php");
}

function salvarAutoridades($id_cadastrocogeropm) {
    if (!isset($_REQUEST['autoridades']) || !is_array($_REQUEST['autoridades'])) {
        return true;
    }

    $autoridades = $_REQUEST['autoridades'];

    foreach ($autoridades as $aut) {
        $cadastroopmcogerautoridade = new cadastroopmcogerautoridade();

        if (!empty($aut['id']) && $aut['id'] > 0) {
            $cadastroopmcogerautoridade->setValues($aut);
        }

        $cadastroopmcogerautoridade->id_cadastroopmcoger = $id_cadastrocogeropm;
        $cadastroopmcogerautoridade->rg = $aut['rg'];
        $cadastroopmcogerautoridade->funcao = $aut['funcao'];

        if ((empty($cadastroopmcogerautoridade->rg) && empty($cadastroopmcogerautoridade->funcao) && !empty($cadastroopmcogerautoridade->id_cadastroopmcogerautoridade))) {
            $id = cadastroopmcogerautoridade::apaga($cadastroopmcogerautoridade);
        } else if ((empty($cadastroopmcogerautoridade->rg) && empty($cadastroopmcogerautoridade->funcao) && empty($cadastroopmcogerautoridade->id_cadastroopmcogerautoridade))) {
            continue;
        }

        if (!empty($aut['id']) && $aut['id'] > 0) {
            $id = cadastroopmcogerautoridade::atualiza($cadastroopmcogerautoridade);
        } else {
            $id = cadastroopmcogerautoridade::insere($cadastroopmcogerautoridade);
        }

    }
}