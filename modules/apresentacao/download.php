<?php

//error_reporting(E_ALL);
//ini_set('display_errors', TRUE);
//ini_set('display_startup_errors', TRUE);

$id = isset($_REQUEST['_id']) ? $_REQUEST['_id'] : 0;

if (isset($_SESSION['sqlParaPlanilha'][$id])) {

    $sql = $_SESSION['sqlParaPlanilha'][$id];

    $objetoPdo = new PDO($pdo['dsn']['sjd'], $pdo['user'], $pdo['password']);

    $colunas = array(
        'sjd_ref' => 'Número',
        'sjd_ref_ano' => 'Ano',
        'pessoa_rg' => 'RG',
        'pessoa_posto' => 'Cargo',
        'pessoa_nome' => 'Nome',
        'pessoa_unidade_lotacao_sigla' => 'Unidade',
        'pessoa_unidade_lotacao_descricao' => 'Descrição',
        'documento_de_origem' => 'Nº Of.',
        'autos_numero' => 'Autos',
        'acusados' => 'Acusados',
        'comparecimento_local_txt' => 'Local',
        'comparecimento_data' => 'Data',
        'comparecimento_hora' => 'Hora',
        'apresentacaotipoprocesso' => 'Processo/Procedimento',
        'apresentacaocondicao' => 'Condição',
        'apresentacaosituacao' => 'Situação',
        'observacao_txt' => 'Observação',
    );

    $construtor = new FConstrutorDePlanilha($objetoPdo, $sql, $colunas);

    $contents = ob_get_clean();
    //unset($_SESSION['sqlParaPlanilha'][$id]);
    try {
        $construtor->criarEEnviarParaOutput('ods');
    } catch (Exception $e) {
        echo $contents;
        echo "<h3>{$e->getMessage()}</h3>";
    }

}
