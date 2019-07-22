<?php
@apache_setenv('no-gzip', 1);
@ini_set('zlib.output_compression', 0);
@ini_set('implicit_flush', 1);
    echo '<br />';
    echo '<table class="bordasimples" width="100%" cellpadding="0px">';
    form::openTR();
    form::openTD('colspan="2"');
    echo "<h1>Cadastro Massificado - Etapa 2";
    form::closeTD();
    form::closeTR();
    form::openTR();
    form::openTD();
    form::openLabel("Carregamento do arquivo");
    try {
        $plan = new FPlanilha();
        $plan->carregarDeUmArquivo($nomeDoArquivoCriado);
        $plan->setFolhaSelecionada($nomeDaFolha);
        $arquivoNome = $plan->getNomeDoArquivo();

        if (!isset($apresentacaomassificado->id_apresentacaomassificao) || ((integer)$apresentacaomassificado->id_apresentacaomassificao < 1)) {
            $apresentacaomassificado->cdopm = $cdopm;
            $apresentacaomassificado->nome_do_arquivo = $arquivoNome;
            $apresentacaomassificado->nome_original_do_arquivo = $nomeOriginalDoArquivoCriado;
            $apresentacaomassificado->id_notacomparecimento = $notacomparecimentoId;
            $apresentacaomassificado->nome_da_folha = $nomeDaFolha;
            $apresentacaomassificado->usuario_rg = $user['UserLogin'];
            $apresentacaomassificado->qtde_registros = $plan->getTotalDeLinhas();
            $apresentacaomassificado->id_apresentacaomassificado = apresentacaomassificado::insere($apresentacaomassificado);
        }

        echo '<b>Iniciando Leitura do arquivo... </b><br />';

        $leitor = new FLeitorDeCadastroMassificadoDeApresentacao($plan);

        $notacomparecimentoId = isset($notacomparecimentoId) ? $notacomparecimentoId : null;

        $situacaoApresentacaoId = apresentacaosituacao::SITUACAO_PREVISTA;

        if (isset($notacomparecimento) && $notacomparecimento->status == notacomparecimento::PUBLICADA) {
            $situacaoApresentacaoId = apresentacaosituacao::SITUACAO_PREVISTA;
        } else if (isset($notacomparecimento) && $notacomparecimento->status == notacomparecimento::PENDENTE) {
            $situacaoApresentacaoId = apresentacaosituacao::SITUACAO_AG_PUBLICACAO;
        }

        $leitor->processarApresentacaoTemporaria($notacomparecimentoId, true, $situacaoApresentacaoId);

        echo '<b>Leitura do arquivo concluída! </b><br />';
    } catch (Exception $ex) {
        $apresentacaomassificado->situacao = apresentacaomassificado::ERRO_NA_PLANILHA;
        apresentacaomassificado::atualiza($apresentacaomassificado);
        echo '<b>Ocorreu um erro na leitura do arquivo: </b><br />';
        $errosPlanilha[] = $ex->getMessage();
    }
    ob_flush(); flush();
    form::closeLabel();
    form::closeTD();
    form::closeTR();
    form::openTR();
    form::openTD();
    form::openLabel("Resultado");
    if (!empty($errosPlanilha)) {

        foreach ($errosPlanilha as $e) {
            echo "<h3>{$e}</h3>";
        }
        echo '<br />';
        echo "<a href='{$caminhoRelativoDoArquivoCriado}'>{$nomeDoArquivoCriado}</a><br /><br /> <a href='index.php?reiniciarcadastro=1&" .http_build_query($urlQuery). "'>Retornar</a>";
    } else {
        $urlQuery['apresentacaomassificado']['id'] = $apresentacaomassificado->id_apresentacaomassificado;
        ?>
        <h2>O arquivo foi lido corretamente</h2>
        <form id='notacomparecimento' name='notacomparecimento' action='index.php?<?= http_build_query($urlQuery); ?>' method='post'>
            <input type="hidden" name="apresentacaomassificado[id]" value="<?=$apresentacaomassificado->id_apresentacaomassificado;?>" />
            <input type="hidden" name="nome_do_arquivo_criado" value="<?=htmlentities($plan->getNomeDoArquivo(), ENT_QUOTES, 'ISO-8859-1');?>" />
            <input type="hidden" name="nome_da_folha" value="<?=htmlentities($plan->getNomeDaFolhaSelecionada(), ENT_QUOTES, 'ISO-8859-1');?>" />
            <input type="hidden" name="etapamassificado" value="2" />
            <input type='submit' value='Próximo'>
        </form>
        <?php
    }
    form::closeLabel();
    form::closeTD();
    form::closeTR();
    echo '</table>';
