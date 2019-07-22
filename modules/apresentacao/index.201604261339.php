<?php
//error_reporting(E_ALL);
//ini_set('display_errors', TRUE);
//ini_set('display_startup_errors', TRUE);

if (isset($_REQUEST['ajax']) && isset($_REQUEST['acao'])) {
    ob_end_clean();
    header("Content-Type: application/json; charset=utf-8");

    $atCodigo = isset($_REQUEST['codigo']) && !empty($_REQUEST['codigo']) ? $_REQUEST['codigo'] : null;
    $atCsrf =  isset($_REQUEST['csrf']) && !empty($_REQUEST['csrf']) ? $_REQUEST['csrf'] : null;
    $atAno =  isset($_REQUEST['ano']) && !empty($_REQUEST['ano']) ? $_REQUEST['ano'] : null;
    $atIdApresentacao =  isset($_REQUEST['id_apresentacao']) && !empty($_REQUEST['id_apresentacao']) ? $_REQUEST['id_apresentacao'] : null;
    $atIdObjeto =  isset($_REQUEST['id_objeto']) && !empty($_REQUEST['id_objeto']) ? $_REQUEST['id_objeto'] : null;
    $atCsrfModulo = isset($_SESSION['atualizacao_csrf']) ? $_SESSION['atualizacao_csrf'] : null;

    if (is_null($atCsrfModulo) || is_null($atCsrf) || $atCsrf != $atCsrfModulo) {
    enviarResposta(array(
        'valido' => false,
            'mensagem' => utf8_encode("Erro na valida��o da p�gina. Recarregue a p�gina e tente novamente."),
        ));
    }

    switch ($_REQUEST['acao']) {
        case 'buscar':
            require 'ajax/buscar.php';
            break;
        case 'desfazer':
            require 'ajax/desfazer.php';
            break;
        default:
            require 'ajax/erro.php';
            exit();
            break;
    }
    exit();
}

function enviarResposta($resposta) {
    echo json_encode($resposta);
    exit();
}

if ($opcao == 'download') {
    include $opcao . '.php';
    exit();
}

if ($opcao == 'removerlembrete') {

    $idEmail = isset($_REQUEST['email']['id']) && !empty($_REQUEST['email']['id']) ? $_REQUEST['email']['id'] : null;

    if (!is_null($idEmail)) {
        $email = new email();
        $email->setValues(array('id' => $idEmail), '','');

        $email->dh_cancelamento = date("Y-m-d H:i:s");
        $email->usuario_rg_cancelamento = $user['UserLogin'];

        email::atualiza($email);
    }
    $opcao = 'atualizar';
}

if ($opcao == 'atualizacao') {
    include ("menu.inc.php");
    include $opcao . '.php';
    exit();
}

if ($opcao == 'buscarpelonome') {
    include $opcao . '.php';
    exit();
}

$cdopm_selected = isset($opm_login) ? $opm_login->obtemOpmResp()->codigoBase : null;

if ($opcao == 'apresentacaoselecionaropm') {
    include $opcao . '.php';
    exit();
}

if ($opcao == 'apresentacaoselecionarlocal') {
    include $opcao . '.php';
    exit();
}

if ($opcao == 'apresentacaomassificado') {
    include ("menu.inc.php");
    include dirname(__DIR__) . DIRECTORY_SEPARATOR . 'apresentacaomassificado' . DIRECTORY_SEPARATOR . 'cadastro.php';
    exit();
}

//Core
if ((isset($_REQUEST['apresentacao']['id'])) && ($_REQUEST['apresentacao']['id']) && (empty($acao)))
    $opcao = "atualizar";
if (!$opcao)
    $opcao = "cadastrar";
if ($acao == 'cadastrar e novo')
    $opcao = 'cadastrar';

//Defini��o de vari�veis, incluindo pais e filhos
$apresentacao = new apresentacao();
if ((isset($_REQUEST['apresentacao']))) {
    $apresentacao->setValues($_REQUEST['apresentacao']);
}

if (property_exists($apresentacao, 'id_localdeapresentacao') && (!empty($apresentacao->id_localdeapresentacao))) {
    $localdeapresentacao = new localdeapresentacao();
    $localdeapresentacao->setValues(array('id' => $apresentacao->id_localdeapresentacao));
} else {
    $localdeapresentacao = new localdeapresentacao();
    $localdeapresentacao->localdeapresentacao = 'N�o selecionado';
}

if ((isset($_REQUEST['notacomparecimento']['id']))) {
    $notacomparecimento = new notacomparecimento();
    $notacomparecimento->setValues(array('id' => $_REQUEST['notacomparecimento']['id']));
}

if ((isset($apresentacao->id_notacomparecimento) && ($apresentacao->id_notacomparecimento > 0))) {
    $notacomparecimento = $apresentacao->notacomparecimento;
}

// verifica se o usuario tem permissao para visualizar a apresentacao
if (!in_array($user["nivel"], array(4, 5, 7))) {
    if ($apresentacao->id_apresentacaoclassificacaosigilo == 3) {
        $sql = sprintf(" SELECT id_posto FROM `RHPARANA`.`posto` WHERE posto = '%s' LIMIT 1 ", $apresentacao->pessoa_posto);
        $res = mysql_query($sql);
        if ($row = mysql_fetch_assoc($res)) {
            $idPostoApresentacao = $row['id_posto'];
        }

        if (($idPostoApresentacao <= $usuario->id_posto) && ($apresentacao->usuario_rg != $user['UserLogin'])) {
            echo "<h3>N�o possui permiss�o para visualizar esta apresenta��o. (1)</h3>";
            exit();
        }
    }

    if (($apresentacao->id_apresentacaoclassificacaosigilo == 4) && ($apresentacao->pessoa_rg != $user['UserLogin'])) {
        echo "<h3>N�o possui permiss�o para visualizar esta apresenta��o. (2)</h3>";
        exit();
    }

    if (($apresentacao->id_apresentacaoclassificacaosigilo == 4) && ($apresentacao->usuario_rg != $user['UserLogin'])) {
        echo "<h3>N�o possui permiss�o para visualizar esta apresenta��o. (3)</h3>";
        exit();
    }

    if (($apresentacao->id_apresentacaoclassificacaosigilo == 5)) {
        $sql = sprintf(" SELECT id_posto FROM `RHPARANA`.`posto` WHERE posto = '%s' LIMIT 1 ", $apresentacao->pessoa_posto);
        $res = mysql_query($sql);
        if ($row = mysql_fetch_assoc($res)) {
            $idPostoApresentacao = $row['id_posto'];
        }
        if (($usuario->id_posto > 7 and $idPostoApresentacao <= 7) && !($usuarioComandoIntermediario === true && $policial->funcao == 'INATIVO')) {
            echo "<h3>N�o possui permiss�o para visualizar esta apresenta��o. (4)</h3>";
            die;
        }
    }
}


//Debug
if (isset($_SESSION['debug']) && $_SESSION['debug']) {
    pre($apresentacao);
}

if (strtolower($opcao) == "cadastrar") {
    if (strtolower($acao) == "cadastrar" || strtolower($acao) == "cadastrar e novo") {
        if (!$apresentacao->sjd_ref) {
            $sql = "SELECT MAX(sjd_ref) AS ultimo FROM apresentacao WHERE sjd_ref_ano='" . $apresentacao->sjd_ref_ano . "'";
            $row = mysql_fetch_array(mysql_query($sql));
            $apresentacao->sjd_ref = ($row[ultimo] + 1);
        }

        $apresentacao->completarDados();

        $id = apresentacao::insere($apresentacao);

        log::insere("O(a) " . $usuario->cargo . " " . $usuario->quadro . " " . $usuario->nome . ", da unidade " . $usuario->opm->abreviatura . ", inseriu a <a href=\"?module=apresentacao&apresentacao[id]=$id\">Apresenta��o n� " . $apresentacao->sjd_ref . "/" . $apresentacao->sjd_ref_ano . "</a>", "apresentacao");
        echo "<h2>";
        echo escaparHtml("Apresenta��o cadastrada com sucesso!");
        echo "</h2>";

        if ($apresentacao->verificaSeConstaPrisao($apresentacao->pessoa_rg) === true) {
            echo '<br />';
            echo "<h2>";
            echo escaparHtml("RG {$apresentacao->pessoa_rg} possui registro no m�dulo 'Presos'!");
            echo "</h2>";
            $soFocarNaHoraSeNaoTiverMensagemDePrisao = false;
        } else {
            $soFocarNaHoraSeNaoTiverMensagemDePrisao = true;
        }

        echo '<br />';

        if (isset($_REQUEST['duplicarapresentacao']) && $_REQUEST['duplicarapresentacao'] == "1") {
            $atual = new apresentacao();
            $atual->setValues(array('id' => $id));
            $apresentacao = $atual->clonar();
            $campoSetFocus = $soFocarNaHoraSeNaoTiverMensagemDePrisao === true ? 'apresentacao[comparecimento_hora]' : '' ;
            include ("menu.inc.php");
            include ("formulario.inc.php");
        } else if (strtolower($acao) == "cadastrar e novo") {
            $atual = new apresentacao();
            $atual->setValues(array('id' => $id));
            $apresentacao = new apresentacao();
            $apresentacao->id_notacomparecimento = isset($atual->id_notacomparecimento) ? $atual->id_notacomparecimento : null;
            include ("menu.inc.php");
            include ("formulario.inc.php");
        } else {

            if (isset($notacomparecimento)) {
                echo "<a href='?module=notacomparecimento&opcao=listarapresentacoes&notacomparecimento[id]={$notacomparecimento->id_notacomparecimento}'>Clique aqui para voltar a Nota de Comparecimento.</a><br/>";
            }

            echo "<a href='?module=apresentacao&opcao=listar'>Clique aqui para voltar.</a>";
        }
    } else {
        include ("menu.inc.php");
        include ("formulario.inc.php");
    }
} elseif (strtolower($opcao) == "atualizar") {

    if (strtolower($acao) == "atualizar") {

        $apresentacao->completarDados();
        if ($id = apresentacao::atualiza($apresentacao)) {

            log::insere("O(a) " . $usuario->cargo . " " . $usuario->quadro . " " . $usuario->nome . ", da unidade " . $usuario->opm->abreviatura . ", atualizou a <a href=\"?module=apresentacao&apresentacao[id]=$id\">Apresenta��o n� " . $apresentacao->sjd_ref . "/" . $apresentacao->sjd_ref_ano . "</a>", "apresentacao");
            echo "<h2>";
            echo escaparHtml("Apresenta��o atualizada com sucesso!");
            echo "</h2>";

            if ($apresentacao->verificaSeConstaPrisao($apresentacao->pessoa_rg) === true) {
                echo '<br />';
                echo "<h2>";
                echo escaparHtml("RG {$apresentacao->pessoa_rg} possui registro no m�dulo 'Presos'!");
                echo "</h2>";
            } else {
                js::foco();
            }

            echo '<br />';



            if (isset($_REQUEST['duplicarapresentacao']) && $_REQUEST['duplicarapresentacao'] == "1") {
                $atual = new apresentacao();
                $atual->setValues(array('id' => $id));
                $apresentacao = $atual->clonar();
                $campoSetFocus = 'apresentacao[comparecimento_hora]';
                include ("menu.inc.php");
                include ("formulario.inc.php");
            } else {
                echo "<a id='foco' href='?module=apresentacao&opcao=listar'><button>Clique aqui para voltar &agrave; lista.</button></a><br><br>";
                echo "<a href='?module=apresentacao&apresentacao[id]=" . $apresentacao->id_apresentacao . "'><button>Clique aqui para voltar a apresenta��o.</button></a>";
            }
        } else {
            echo "Houve um problema durante a execu��o da solicita��o!";
        }
    } else {
        log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", visualizou a <a href=\"?module=apresentacao&apresentacao[id]=$apresentacao->id_apresentacao\">Apresenta��o n� " . $apresentacao->sjd_ref . "/" . $apresentacao->sjd_ref_ano . "</a>", "apresentacao");
        include ("menu.inc.php");
        include ("formulario.inc.php");
    }
} elseif ($opcao == "lista" or $opcao == "listar") {
    include ("menu.inc.php");
    include ("lista.inc.php");
} elseif ($opcao == "listatodas") {
    include ("menu.inc.php");
    include ("listatodas.inc.php");
} elseif ($opcao == "apagar") {
    if ($acao == "apagar") {
        if (apresentacao::apaga($apresentacao)) {
            echo "<h2>Apresenta��o apagada com sucesso!</h2>";
            echo "<a href='?module=apresentacao&opcao=lista'>Clique aqui para voltar � lista</a>";
            log::insere("O(a) " . $usuario->cargo . " " . $usuario->quadro . " " . $usuario->nome . ", da unidade " . $usuario->opm->abreviatura . ", apagou a <a href=\"?module=apresentacao&apresentacao[id]={$apresentacao->id_apresentacao}\">Apresenta��o n� " . $apresentacao->sjd_ref . "/" . $apresentacao->sjd_ref_ano . "</a>", "apresentacao");
        } else {
            echo "Houve um problema durante a execu��o da solicita��o!";
        }
    } else {
        echo "<h1>Deseja realmente apagar o Apresenta��o n&ordm; " . $apresentacao->sjd_ref . '/' . $apresentacao->sjd_ref_ano . "?</h1>";
        echo "<form class='controlar-modificacao' ID='apresentacao' name='apresentacao' action='index.php?module=apresentacao' method='post'><input type=hidden name=apresentacao[id] value='{$apresentacao->id_apresentacao}'><input
type=submit name='acao' value='Apagar'></form>";
    }
} elseif ($opcao == "buscar") {
    include ("filtro.inc.php");
    include ("lista.inc.php");
} elseif ($opcao == "log") {
    include ("log.php");
} else {
    include ("menu.inc.php");
    include ("$opcao.php");
}
