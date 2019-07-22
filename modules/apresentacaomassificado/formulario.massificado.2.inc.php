<?php

$urlQuery['module'] = $module;
$urlQuery['opcao'] = $opcao;
$urlQuery['nome_do_arquivo_criado'] = $nomeDoArquivoCriado;

if (!isset($_SESSION['planilhas'][$nomeDoArquivoCriado])) {
    try {
        $objetoPlanilha = new FPlanilha();

        $objetoPlanilha->carregarDeUmArquivo($nomeDoArquivoCriado);
        $folhasDaPlanilha = $objetoPlanilha->getNomesDasFolhas();

        $caminhoDoArquivoCriado = $objetoPlanilha->getPlanilhaPath();
        $caminhoRelativoDoArquivoCriado = $objetoPlanilha->getCaminhoRelativoDoArquivo();

        $_SESSION['planilhas'][$nomeTemporarioDoArquivo]['folhas'] = $folhasDaPlanilha;
        $_SESSION['planilhas'][$nomeTemporarioDoArquivo]['caminhoDoArquivoCriado'] = $caminhoDoArquivoCriado;
        $_SESSION['planilhas'][$nomeTemporarioDoArquivo]['caminhoRelativoDoArquivoCriado'] = $caminhoRelativoDoArquivoCriado;
    } catch (Exception $ex) {
        $errosPlanilha[] = $ex->getMessage();
    }
} else {
    $folhasDaPlanilha = $_SESSION['planilhas'][$nomeDoArquivoCriado]['folhas'];
    $caminhoDoArquivoCriado = $_SESSION['planilhas'][$nomeDoArquivoCriado]['caminhoDoArquivoCriado'];
    $caminhoRelativoDoArquivoCriado = $_SESSION['planilhas'][$nomeDoArquivoCriado]['caminhoRelativoDoArquivoCriado'];
}

$urlQueryTrocaDePlanilha = $urlQuery;

$urlQuery['etapamassificado'] = 2;
$urlQuery['nome_da_folha'] = $nomeDaFolha;

$sql = "
    SELECT
        count(*) as total
    FROM apresentacao_temp at

    WHERE
        (at.divergencia_nome = 1 OR
        at.divergencia_rg = 1 OR
        at.divergencia_opm = 1 OR
        at.erro_dia = 1 OR
        at.erro_horario = 1)
";

$sql .= sprintf(" AND (at.arquivo = '%s')", $nomeDoArquivoCriado);
$sql .= sprintf(" AND (at.folha = '%s')", $nomeDaFolha);

if (is_null($notacomparecimentoId)) {
    $sql .=" AND (at.id_notacomparecimento is null OR at.id_notacomparecimento = 0)";
} else {
    $sql .= sprintf(" AND (at.id_notacomparecimento = %s)", $notacomparecimentoId);
}

mysql_select_db("sjd", $con[8]);
$res = mysql_query($sql, $con[8]);
$linhasEncontradasDiv = mysql_fetch_assoc($res);

if (isset($linhasEncontradasDiv['total']) && $linhasEncontradasDiv['total'] > 0) {
    $apresentacaomassificado->qtde_registros_inconsistentes = $linhasEncontradasDiv['total'];
    $apresentacaomassificado->situacao = apresentacaomassificado::DADOS_DIVERGENTES;
} else {
    $apresentacaomassificado->qtde_registros_inconsistentes = 0;
}
apresentacaomassificado::atualiza($apresentacaomassificado);

echo '<br />';
echo '<table class="bordasimples" width="100%" cellpadding="0px">';
form::openTR();
form::openTD('colspan="3"');
echo "<h1>Cadastro Massificado - Etapa 3</h1>";
form::closeTD();
form::closeTR();
form::openTR();
form::openTD('colspan="3"');
echo "<h2>Revisão e conclusão</h2>";
form::closeTD();
form::closeTR();
form::openTR();
form::openTD('colspan="3"');

if (isset($linhasEncontradasDiv['total']) && $linhasEncontradasDiv['total'] > 0) {

    $pdoLeitor = new PDO($pdo['dsn']['sjd'],$pdo['user'],$pdo['password']);

    $leitor = new FEscritorDePlanilhaDeApresentacao($apresentacaomassificado, $pdoLeitor);

    $leitor->escrever();

    $caminhoParaPlanilhaComErros = $leitor->getCaminhoRelativoDoArquivo();

    echo "<h3>Não é possível prosseguir. <br/ >A planilha possui inconsistências, deve ser corrigida e enviada novamente.</h3>";
    echo "<a href='{$caminhoParaPlanilhaComErros}'>Download</a><br />";
    echo "<a href='index.php?reiniciarcadastro=1&" . http_build_query($urlQuery) . "'>Clique aqui para reiniciar o processo.</a>";
} else {
    echo "<form name='apresentacaomassificado-t' action='index.php?" . http_build_query($urlQuery) . "' method='post' onsubmit='return validarConcluir(this,event);'>";
    echo "<input type='hidden' name='apresentacaomassificado[id]' value='{$apresentacaomassificado->id_apresentacaomassificado}' />";
    echo "<input type='hidden' name='etapamassificado' value='3' />";
    form::openLabel('Selecione uma condição de apresentação a ser aplicada a todos registros');
    formulario::option("apresentacao", "apresentacaocondicao", "WHERE ativo=1 ORDER BY ordem", "", 0, 0);
    form::closeLabel();
    echo "<br />";

    echo "<input type='submit' value='Concluir'>";
    echo "</form>";
}

form::closeTD();
form::closeTR();

form::openTR();
form::openTD();
form::openLabel("Arquivo");
echo "<form name='apresentacaomassificado' action='index.php?" . http_build_query($urlQueryTrocaDePlanilha) . "' method='post'>";
echo "<input type='hidden' name='nome_do_arquivo_criado' value='{$nomeDoArquivoCriado}'>";
echo "<a href='{$caminhoRelativoDoArquivoCriado}'>{$nomeDoArquivoCriado}</a> <a href='index.php?reiniciarcadastro=1&" . http_build_query($urlQuery) . "'><img border='0' src='img/wrong.gif'></a>";
form::closeLabel();
form::closeTD();
form::openTD();
form::openLabel("Selecione a planilha");
echo "<select name='nome_da_folha'>";
foreach ($folhasDaPlanilha as $s) {
    $sEsc = escaparHtml($s);
    echo '<option value="' . $sEsc . '" ';
    echo ($nomeDaFolha == $s) ? "selected='true'" : "";
    echo ">";
    echo $sEsc;
    echo "</option>";
}
echo "</select>";

form::closeLabel();

form::closeTD();
form::openTD();
form::openLabel("Ação");
echo "<input type='hidden' name='etapamassificado' value='1'>";
echo "<input type='submit' value='Alterar Planilha'>";

form::closeLabel();

form::closeTD();
form::closeTR();
echo '</table>';
echo "</form>";
echo '<br />';

include 'tabelaapresentacaotemp.inc.php';

echo '<br />';

echo '<table class="bordasimples" width="100%" cellpadding="0px">';
form::openTR();
form::openTD('colspan="3"');
echo "<h1>Cadastro Massificado - Etapa 3</h1>";
form::closeTD();
form::closeTR();
form::openTR();
form::openTD('colspan="3"');
echo "<h2>Revisão e conclusão</h2>";
form::closeTD();
form::closeTR();
form::openTR();
form::openTD('colspan="3"');

if (isset($linhasEncontradasDiv['total']) && $linhasEncontradasDiv['total'] > 0) {
    echo "<h3>Não é possível prosseguir. <br/ >A planilha possui inconsistências, deve ser corrigida e enviada novamente.</h3>";
    echo "<a href='{$caminhoParaPlanilhaComErros}'>Download</a><br />";
    echo "<a href='index.php?reiniciarcadastro=1&" . http_build_query($urlQuery) . "'>Clique aqui para reiniciar o processo.</a>";
} else {
    echo "<form name='apresentacaomassificado-b' action='index.php?" . http_build_query($urlQuery) . "' method='post' onsubmit='return validarConcluir(this,event);'>";
    echo "<input type='hidden' name='apresentacaomassificado[id]' value='{$apresentacaomassificado->id_apresentacaomassificado}' />";
    echo "<input type='hidden' name='etapamassificado' value='3' />";

    form::openLabel('Selecione uma condição de apresentação a ser aplicada a todos registros');
    formulario::option("apresentacao", "apresentacaocondicao", "WHERE ativo=1 ORDER BY ordem", "", 0, 0);
    form::closeLabel();
    echo "<br />";

    echo "<input type='submit' value='Concluir'>";
    echo "</form>";
}

form::closeTD();
form::closeTR();
echo "</table>";
?>
<script>
    function validarConcluir(obj, event) {
        if (obj['apresentacao[id_apresentacaocondicao]'].value == '') {
            alert ('Selecione a condição que será aplicada a todas as apresentações.');
            event.preventDefault();
            return false;
        }
    }
</script>