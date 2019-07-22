<?php
//error_reporting(E_ALL);
//ini_set('display_errors', TRUE);
//ini_set('display_startup_errors', TRUE);

if (isset($_REQUEST['apresentacao']['id']) && isset($_REQUEST['csrf_apresentacao']) && isset ($_SESSION['csrf_apresentacao'][$_REQUEST['apresentacao']['id']]) && $_REQUEST['csrf_apresentacao'] == $_SESSION['csrf_apresentacao'][$_REQUEST['apresentacao']['id']]) {
    $_SESSION['idsApresentacoesSelecionadas'][] = $_REQUEST['apresentacao']['id'];
}

if (isset($_REQUEST['ajax']) && isset($_REQUEST['acao'])) {

    $idsApresentacoesSelecionadas = isset($_SESSION['idsApresentacoesSelecionadas']) ? $_SESSION['idsApresentacoesSelecionadas'] : array();

    switch ($_REQUEST['acao']) {
        case 'selecionar':
            ob_end_clean();
            require 'ajax/selecionar.php';
            break;
        case 'remover':
            ob_end_clean();
            require 'ajax/remover.php';
            break;
        case 'limpar':
            ob_end_clean();
            require 'ajax/limpar.php';
            break;
        default:
            ob_end_clean();
            require 'ajax/erro.php';
            exit();
            break;
    }
    $_SESSION['idsApresentacoesSelecionadas'] = $idsApresentacoesSelecionadas;
    header("Content-Type: application/json; charset=utf-8");
    echo json_encode(array('ids' => $idsApresentacoesSelecionadas));
    exit();
}

$cadastroopmcoger = new cadastroopmcoger();

$codigoBase = $opm_login->codigoBase == '' ? '0' : $opm_login->codigoBase;

$cadastroopmcoger->setValues('', " WHERE cdopm = '{$codigoBase}' " );

if (!property_exists($cadastroopmcoger, 'id_cadastroopmcoger')){
    echo sprintf('<h3>A unidade de trabalho: "%s" ainda não possui o cadastro completo</h3><br />', $opm_login->abreviatura);
    echo sprintf('<a href="%s">Clique aqui para editar.</a>',"?module=cadastroopmcoger");
    exit();
}

$memorandoapresentacao = new memorandoapresentacao($cadastroopmcoger);
$memorandoapresentacao->assunto = 'Determinação para comparecimento';

if (isset($_REQUEST['acao']) && in_array(strtolower($_REQUEST['acao']), array( 'alterar', 'gerar'))) {
    $memorandoapresentacao->numeroDeSequenciaInicial = (integer)$_REQUEST['memorandoapresentacao']['proximo_numero'];
    $memorandoapresentacao->sigla = $_REQUEST['memorandoapresentacao']['sigla'];
    $memorandoapresentacao->nrVias = $_REQUEST['memorandoapresentacao']['vias'];
    $autoridadeForm = explode('+', $_REQUEST['id_autoridade']);

    $autoridadeTipo = isset($autoridadeForm[0]) ? $autoridadeForm[0] : '';
    $autoridadeId = isset($autoridadeForm[1]) ? $autoridadeForm[1] : 0;
    $autoridadeRg = isset($autoridadeForm[2]) ? $autoridadeForm[2] : '';

    if ($autoridadeTipo == 'cadastroopmcogerautoridade') {

        $memorandoapresentacao->autoridadeTipo = isset($autoridadeForm[0]) ? $autoridadeForm[0] : '';
        $memorandoapresentacao->autoridadeId = isset($autoridadeForm[1]) ? $autoridadeForm[1] : 0;

        $cadastroopmcogerautoridade = new cadastroopmcogerautoridade();
        $cadastroopmcogerautoridade->setValues(array('id' => $autoridadeId));

        $memorandoapresentacao->autoridade = new policial($autoridadeRg);
        $memorandoapresentacao->funcaoDaAutoridade = $cadastroopmcogerautoridade->funcao;
    }


}

$idsApresentacoesSelecionadas = array();

if (isset($_SESSION['idsApresentacoesSelecionadas']) && !empty($_SESSION['idsApresentacoesSelecionadas'])) {
    $idsApresentacoesSelecionadas = $_SESSION['idsApresentacoesSelecionadas'];
}

if (isset($_REQUEST['acao']) && strtolower($_REQUEST['acao']) == 'gerar') {
    $memorandoapresentacao->idsDasApresentacoes = explode(',', $_REQUEST['ids']);
    $objetoPdo = new PDO($pdo['dsn']['sjd'],$pdo['user'],$pdo['password']);
    $gerador = new FGeradorDeMemorandoDeApresentacaoPdf($memorandoapresentacao, $pdo);
    $gerador->gerar();

    $arquivosCriados = true;
}

include 'menu.inc.php';

echo '<br />';
echo '<form method="post" action="?module=memorandoapresentacao" onsubmit="javascript: submeterFormulario()">';

include 'dados_cadastro_opm.inc.php';
echo '<br />';

if (isset($arquivosCriados) && $arquivosCriados == true) {
    include 'resultado_criados.inc.php';
    echo '<br />';
}

include 'lista_apresentacoes_selecionadas.inc.php';
echo '</form>';

