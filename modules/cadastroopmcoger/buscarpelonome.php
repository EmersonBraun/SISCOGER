<?php

$policiaisEncontrados = array();

$nome = isset($_GET['nome_a_localizar']) ? preg_replace('/[%_]/', '', $_GET['nome_a_localizar']) : "";

if (isset($nome) && strlen($nome) >= 3) {

    $nome = $_GET['nome_a_localizar'];

    // tratar nome
    $nome = preg_replace('/[ZSszMNmn]/', '_', $nome);

    $nome = preg_replace('/[\'\s]/', '%', $nome);

    $nome = $nome;

    mssql_select_db("RHPARANA", $con[4]);
    $sql = "select * FROM (SELECT
            pm.rg as pessoa_rg,
            pm.nome as pessoa_nome,
            pm.cargo as pessoa_posto,
            posto.descricao as posto_ordem,
            CONVERT ( VARCHAR(19) , pm.NASCIMENTO, 103 ) as data_nascimento,
            pm.CIDADE as cidade,
            pm.quadro as pessoa_quadro,
            pm.opm_meta4 as pessoa_unidade_lotacao_meta4,
            opm.nome_meta4 as pessoa_unidade_lotacao_descricao,
            opm.codigo as pessoa_unidade_lotacao_codigo,
            opm.abreviatura as pessoa_unidade_lotacao_sigla
            FROM policial pm
            LEFT JOIN posto on pm.cargo = posto.codigo
            LEFT JOIN opmPMPR opm ON pm.opm_meta4 = opm.meta4
            WHERE nome LIKE '%{$nome}%'
            UNION
            SELECT DISTINCT
            pm.CBR_NUM_RG as pessoa_rg,
            pm.NOME as pessoa_nome,
            pm.CARGO + ' RR' as pessoa_posto,
            posto.descricao as posto_ordem,
            CONVERT ( VARCHAR(19) , pm.DT_NASC, 103 ) as data_nascimento,
            pm.END_CIDADE as cidade,
            '' as pessoa_quadro,
            'W9127' as pessoa_unidade_lotacao_meta4,
            'DP SECAO DE PESSOAL CIVIL INATIVOS E PENSIONISTAS DP4' as pessoa_unidade_lotacao_descricao,
            '1100000400' as pessoa_unidade_lotacao_codigo,
            'DP/INATIVOS' as pessoa_unidade_lotacao_sigla
            FROM inativos PM
            LEFT JOIN posto on pm.cargo = posto.codigo
            WHERE nome LIKE '%{$nome}%' AND n_tipo_rh = 'APOSENTADO') as todos ORDER BY  posto_ordem, pessoa_nome ";


    $res = mssql_query($sql);


}
?>

<script>
    function atualizaPolicial(rg, nome, cargo, quadro, sigla, meta4, descricao, codigo) {
        window.opener.document.getElementsByName('apresentacao[pessoa_rg]')[0].value = rg;
        window.opener.document.getElementsByName('apresentacao[pessoa_nome]')[0].value = nome;
        window.opener.document.getElementsByName('apresentacao[pessoa_posto]')[0].value = cargo;
        window.opener.document.getElementsByName('apresentacao[pessoa_quadro]')[0].value = quadro;
        window.opener.document.getElementsByName('apresentacao[pessoa_unidade_lotacao_sigla]')[0].value = sigla;
        window.opener.document.getElementsByName('apresentacao[pessoa_unidade_lotacao_meta4]')[0].value = meta4;
        window.opener.document.getElementsByName('apresentacao[pessoa_unidade_lotacao_descricao]')[0].value = descricao;
        window.opener.document.getElementsByName('apresentacao[pessoa_unidade_lotacao_codigo]')[0].value = codigo;
        window.close();
    }
</script>
<div>
    <form method="GET">
        <label for="opm_a_localizar">Digite parte do nome do policial</label>
        <input type="text" id="nome_a_localizar" name="nome_a_localizar" value="<?=escaparHtml($_GET['nome_a_localizar']);?>"/>
        <input type="hidden" name="module" value="apresentacao" />
        <input type="hidden" name="opcao" value="buscarpelonome" />
        <input type="hidden" name="noheader" value="1" />
        <input type="hidden" name="nomenu" value="1" />
        <input type="submit" value="Pesquisar" />
    </form>
</div>
<br />
<div>
    <h2>Resultados</h2>
    <table class="bordasimples" width="100%" cellpadding="0px">
        <thead>
        <th>Cargo</th>
        <th>Quadro</th>
        <th>Nome</th>
        <th>RG</th>
        <th>Nascimento</th>
        <th>Cidade</th>
        <th>Unidade</th>
        <th>Ação</th>
        </thead>
        <tbody>
            <?php if (is_null($res) || mssql_num_rows($res) === 0): ?>
                <tr>
                    <td colspan="8">Nada encontrado.<br /> Ou quantidade de letras insuficientes. Devem ser no  mínimo 3</td>
                </tr>
            <?php else: ?>
                <?php $i = 0; ?>
                <?php while ($row = @mssql_fetch_assoc($res)): ?>
                    <?php $i % 2 ? ($cor = 'white') : ($cor = '#EEEEEE');
                    $i++; ?>
                    <tr bgcolor='<?= $cor; ?>'>
                        <td><?= $row['pessoa_posto']; ?></td>
                        <td><?= $row['pessoa_quadro']; ?></td>
                        <td><?= $row['pessoa_nome']; ?></td>
                        <td><?= formatarRg($row['pessoa_rg']); ?></td>
                        <td><?= $row['data_nascimento']; ?></td>
                        <td><?= $row['cidade']; ?></td>
                        <td><?= $row['pessoa_unidade_lotacao_descric']; ?></td>
                        <td><input type="button" value="Selecionar"
                                   onclick="atualizaPolicial('<?= $row['pessoa_rg']; ?>', '<?= $row['pessoa_nome']; ?>', '<?= $row['pessoa_posto']; ?>', '<?= $row['pessoa_quadro']; ?>', '<?= $row['pessoa_unidade_lotacao_sigla']; ?>', '<?= $row['pessoa_unidade_lotacao_meta4']; ?>', '<?= $row['pessoa_unidade_lotacao_descric']; ?>', '<?= $row['pessoa_unidade_lotacao_codigo']; ?>')"/></td>
                    </tr>
                <?php endwhile; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>