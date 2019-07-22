<?php

/** Error reporting */
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

if ($opm_login instanceof opm) {
    $opmResp = $opm_login->obtemOpmResp();
    if ($opmResp instanceof opm) {
        $cdopm = $opmResp->codigoBase;
    } else {
        $cdopm = $opm_login->codigoBase;
    }
}

$module = $_REQUEST['module'];
$opcao = $_REQUEST['opcao'];
$urlQuery['module'] = $module;
$urlQuery['opcao'] = $opcao;

$etapa = isset($_REQUEST['etapamassificado']) ? $_REQUEST['etapamassificado'] : 0;
$nomeDaFolha = isset($_REQUEST['nome_da_folha']) ? $_REQUEST['nome_da_folha'] : null;
$nomeOriginalDoArquivoCriado = isset($_REQUEST['nome_original_do_arquivo']) ? $_REQUEST['nome_original_do_arquivo'] : null;
$nomeDoArquivoCriado = isset($_REQUEST['nome_do_arquivo_criado']) ? $_REQUEST['nome_do_arquivo_criado'] : null;

$apresentacaomassificado = new apresentacaomassificado();

if (isset($_REQUEST['apresentacaomassificado']['id'])) {

    $apresentacaomassificado->setValues(array('id' => $_REQUEST['apresentacaomassificado']['id']));

} else if (isset($nomeDoArquivoCriado) && isset($nomeDaFolha)) {
    $condicoes = sprintf(" WHERE nome_do_arquivo = '%s' AND nome_da_folha = '%s' ", mysql_real_escape_string($nomeDoArquivoCriado), mysql_real_escape_string($nomeDaFolha));

    if (is_object($notacomparecimento) && property_exists($notacomparecimento, 'id_notacomparecimento')) {
        $notacomparecimentoId = $notacomparecimento->id_notacomparecimento;
        $condicoes .= sprintf(" AND id_notacomparecimento = %s ", $notacomparecimentoId);
    }

    $apresentacaomassificado->setValues("", $condicoes);
}

if (
        is_object($notacomparecimento) &&
        property_exists($notacomparecimento, 'id_notacomparecimento') &&
        is_object($apresentacaomassificado) &&
        property_exists($apresentacaomassificado, 'id_notacomparecimento') &&
        ($notacomparecimento->id_notacomparecimento != $apresentacaomassificado->id_notacomparecimento))
{
    echo '<br />';
    echo "<h3>Ocorreu um erro.</h3>";
    echo "<a href='?module={$module}&opcao={$opcao}&notacomparecimento[id]={$notacomparecimento->id_notacomparecimento}'>Reinicie o processo.</a>";
    exit();
}

if ((isset($apresentacaomassificado->id_apresentacaomassificado)) && ($etapa == 0) && (is_null($nomeDaFolha)) && (is_null($nomeOriginalDoArquivoCriado)) && (is_null($nomeDoArquivoCriado)) ) {
    //decidir para qual etapa ir quando o
    if ($apresentacaomassificado->situacao == apresentacaomassificado::CONCLUIDA) {
        $etapa = 4;
    } else if ($apresentacaomassificado->situacao == apresentacaomassificado::IMPORTANDO) {
        $etapa = 3;
    } else if (empty($apresentacaomassificado->qtde_registros_inconsistentes)) {
        $etapa = 1;
    } else if ($apresentacaomassificado->qtde_registros_inconsistentes > 0) {
        $etapa = 2;
    } else {
        $etapa = 0;
    }

    $nomeDaFolha = $apresentacaomassificado->nome_da_folha;
    $nomeOriginalDoArquivoCriado = $apresentacaomassificado->nome_original_do_arquivo;
    $nomeDoArquivoCriado = $apresentacaomassificado->nome_do_arquivo;
    $notacomparecimentoId = (isset($apresentacaomassificado->id_notacomparecimento) && ($apresentacaomassificado->id_notacomparecimento > 0)) ? $apresentacaomassificado->id_notacomparecimento : null;
}

if (isset($_REQUEST['reiniciarcadastro']) && $_REQUEST['reiniciarcadastro'] == 1) {
    $etapa = 0;
    $nomeDaFolha = null;
    $nomeDoArquivoCriado = null;
}



if (is_object($notacomparecimento) && property_exists($notacomparecimento, 'id_notacomparecimento')) {

    $notacomparecimentoId = $notacomparecimento->id_notacomparecimento;
    $urlQuery['notacomparecimento']['id'] = $notacomparecimentoId;
}



/*
 * Para construir a query utilizar o comando abaixo
 * http_build_query($urlQuery)
 */
include 'formulario.massificado.' . $etapa . '.inc.php';
