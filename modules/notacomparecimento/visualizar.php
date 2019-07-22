<center><h1>Nota de Comparecimento</h1></center>

<?php include 'opcoes.inc.php'; ?>

<table class='bordasimples' width='100%'>
    <?php
    form::openTR();
    form::openTD();
    form::openLabel("Nº");
    echo "{$notacomparecimento->sjd_ref}/{$notacomparecimento->sjd_ref_ano}";
    echo "&nbsp;";
    form::closeLabel();
    form::closeTD();
    form::openTD("colspan=2");
    form::openLabel("Data");
    echo "{$notacomparecimento->expedicao_data}";
    echo "&nbsp;";
    form::closeLabel();
    form::closeTD();

    form::openTD();
    form::openLabel("Tipo");
    echo mb_strtoupper($notacomparecimento->tiponotacomparecimento->tiponotacomparecimento);
    echo "&nbsp;";
    form::closeLabel();
    form::closeTD();
    form::openTD("colspan=2");
    form::openLabel("Situação");
    echo strtoupper($notacomparecimento->status);
    echo "&nbsp;";
    form::closeLabel();
    form::closeTD();
    form::closeTR();

    form::openTR();
    form::openTD("colspan=3");
    form::openLabel("Observação");
    echo empty($notacomparecimento->observacao_txt) ? "-----" : $notacomparecimento->observacao_txt;
    form::closeLabel();
    form::closeTD();

    form::openTD("colspan=2");
    form::openLabel("Arquivo PDF para download");
    echo empty($notacomparecimento->nota_file) ? "Não disponível" : "<a href='arquivo/{$notacomparecimento->nota_file}'>{$notacomparecimento->nota_file}</a>";
    form::closeLabel();
    form::closeTD();

    form::closeTR();

    form::openTR();
    form::openTD("colspan=2");
    form::openLabel("Autoridade");
    echo mb_strtoupper($notacomparecimento->autoridade_cargo);
    echo "&nbsp;";
    echo mb_strtoupper($notacomparecimento->autoridade_quadro);
    echo "&nbsp;";
    echo mb_strtoupper($notacomparecimento->autoridade_nome);
    echo "&nbsp;";
    form::closeLabel();
    form::closeTD();
    form::openTD();
    form::openLabel("RG");
    echo $notacomparecimento->autoridade_rg;
    echo "&nbsp;";
    form::closeLabel();
    form::closeTD();
    form::openTD("colspan=2");
    form::openLabel("Função");
    echo mb_strtoupper($notacomparecimento->autoridade_funcao);
    echo "&nbsp;";
    form::closeLabel();
    form::closeTD();


    form::closeTR();
    ?>
</table>
