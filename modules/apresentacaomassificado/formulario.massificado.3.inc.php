<?php

@apache_setenv('no-gzip', 1);
@ini_set('zlib.output_compression', 0);
@ini_set('implicit_flush', 1);

$apresentacaocondicao = new apresentacaocondicao();
if (isset($_REQUEST['apresentacao']['id_apresentacaocondicao'])) {
    $apresentacaoCondicaoPadraoId = $_REQUEST['apresentacao']['id_apresentacaocondicao'];
    $apresentacaocondicao->setValues(array('id' => $apresentacaoCondicaoPadraoId));
}

if (!property_exists($apresentacaocondicao, 'apresentacaocondicao')) {
    $apresentacaoCondicaoPadraoId = apresentacaocondicao::CONDICAO_NAO_INFORMADO;
    $apresentacaocondicao->setValues(array('id' => $apresentacaoCondicaoPadraoId));
}


// verificar se o arquivo tem inconsistências novamente;
if (!isset($apresentacaomassificado->qtde_registros_inconsistentes) && ($apresentacaomassificado->qtde_registros_inconsistentes > 0)) {
        echo '<br/><h3>O arquivo possui registros inconsistentes. Realize o upload novamente.</h3>';
        exit();
}

// verificar se o arquivo já foi concluído;
if ($apresentacaomassificado->situacao == apresentacaomassificado::CONCLUIDA) {
        echo '<br/><h3>O arquivo já foi importado.</h3>';
        exit();
}

// alterar a situacao de apresentacaomassificado para 'importacao'
$apresentacaomassificado->situacao = apresentacaomassificado::IMPORTANDO;
$apresentacaomassificado->id_apresentacaocondicao = $apresentacaoCondicaoPadraoId;
$apresentacaomassificado->apresentacaocondicao = $apresentacaocondicao;
apresentacaomassificado::atualiza($apresentacaomassificado);



    echo '<br />';
    echo '<table class="bordasimples" width="100%" cellpadding="0px">';
    form::openTR();
    form::openTD('colspan="2"');
    echo "<h1>Cadastro Massificado - Etapa 4";
    form::closeTD();
    form::closeTR();
    form::openTR();
    form::openTD();
    form::openLabel("Importação dos dados");
        echo '<b>Iniciando importação final dos registros... </b><br /><br />';
// realizar importacao
$pdo = new PDO($pdo['dsn']['sjd'],$pdo['user'],$pdo['password']);

$importador = new FImportadorDeApresentacaoMassificado($pdo, $apresentacaomassificado);

$resultado = $importador->executar(true);

if ($resultado === true) {
    $apresentacaomassificado->situacao = apresentacaomassificado::CONCLUIDA;
    apresentacaomassificado::atualiza($apresentacaomassificado);
    echo '<br /><b>Importação concluída! </b><br />';
} else {
    echo '<h3>Erro no processo de importação. Tente novamente. Caso o erro persista entre em contato com o suporte</h3>';
}
ob_flush(); flush();
form::closeLabel();
form::closeTD();
form::closeTR();
echo '</table>';