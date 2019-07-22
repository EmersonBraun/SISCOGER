<?php

$opmEncontradas = array();

if (isset($_GET['opm_a_localizar'])) {
    $opmALocalizar = mysql_real_escape_string($_GET['opm_a_localizar']);
    mssql_select_db("RHPARANA",$con[4]);
    $sql="SELECT * FROM opmPMPR WHERE DESCRICAO LIKE '%{$opmALocalizar}%' OR ABREVIATURA LIKE '%{$opmALocalizar}%' ORDER BY ABREVIATURA;";
    $res=mssql_query($sql);
    while ($row=@mssql_fetch_array($res)) {
        $opmEncontradas[] = array(
            'meta4'  => $row['META4'],
            'codigo' => $row['CODIGO'],
            'descricao'  => $row['NOME_META4'],
            'sigla' => $row['ABREVIATURA'],
        );
    }
}

?>

<script>
function atualizaOpm(sigla,meta4,descricao,codigo) {
    window.opener.document.getElementsByName('apresentacao[pessoa_unidade_lotacao_sigla]')[0].value = sigla;
    window.opener.document.getElementsByName('apresentacao[pessoa_unidade_lotacao_meta4]')[0].value = meta4;
    window.opener.document.getElementsByName('apresentacao[pessoa_unidade_lotacao_descricao]')[0].value = descricao;
    window.opener.document.getElementsByName('apresentacao[pessoa_unidade_lotacao_codigo]')[0].value = codigo;
    window.close();
}
</script>
<div>
<form method="GET">
    <label for="opm_a_localizar">Digite parte do nome da opm</label>
    <input type="text" id="opm_a_localizar" name="opm_a_localizar" />
    <input type="hidden" name="module" value="apresentacao" />
    <input type="hidden" name="opcao" value="apresentacaoselecionaropm" />
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
            <th>Sigla</th>
            <th>Descricao</th>
            <th>Ação</th>
        </thead>
        <tbody>
            <?php if (empty($opmEncontradas)): ?>
            <tr>
                <td colspan="3">Nada encontrado.</td>
            </tr>
            <?php else: ?>
            <?php $i=0; ?>
            <?php foreach ($opmEncontradas as $o): ?>
            <?php $i%2?($cor='white'):($cor='#EEEEEE'); $i++; ?>
            <tr bgcolor='<?=$cor;?>'>
                <td><?=$o['sigla'];?></td>
                <td><?=$o['descricao'];?></td>
                <td><input type="button" value="Selecionar"
                           onclick="atualizaOpm('<?=$o['sigla'];?>','<?=$o['meta4'];?>','<?=$o['descricao'];?>','<?=$o['codigo'];?>')"/></td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>