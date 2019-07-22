<?php

$query = isset($_REQUEST['query']) && !empty($_REQUEST['query']) ? trim($_REQUEST['query']) : '';

$queryLimpo = escaparHtml($query);

$query = str_replace(" ", "%", $query);
$query = str_replace(".", "%", $query);
$query = str_replace("-", "%", $query);

$query = mysql_real_escape_string($_GET['query']);

mysql_select_db("sjd",$con[8]);

$sql="SELECT id_localdeapresentacao, localdeapresentacao, l.logradouro, l.numero, l.uf, l.telefone, l.cep, l.bairro, m.municipio FROM sjd.localdeapresentacao l
      LEFT JOIN municipio m ON m.id_municipio = l.id_municipio ";

$sql .= sprintf(" WHERE l.localdeapresentacao like '%s' ", "%{$query}%");
$sql .= sprintf(" OR m.municipio like '%s' ", "%{$query}%");
$sql .= sprintf(" OR l.bairro like '%s' ", "%{$query}%");
$sql .= sprintf(" OR l.logradouro like '%s' ", "%{$query}%");
$sql .= sprintf(" OR l.complemento like '%s' ", "%{$query}%");


$sql .= ' order by l.localdeapresentacao';

// pre($sql);

$res=mysql_query($sql);

?>

<script>
function atualizaLocal(id_localdeapresentacao, localdeapresentacao, bairro, municipio, telefone, descricaocompleta) {
    window.opener.document.getElementsByName('apresentacao[id_localdeapresentacao]')[0].value = id_localdeapresentacao;
    window.opener.document.getElementById('localdeapresentacao[localdeapresentacao]').innerHTML = localdeapresentacao;
    window.opener.document.getElementById('localdeapresentacao[bairro]').innerHTML = bairro;
    window.opener.document.getElementById('localdeapresentacao[municipio]').innerHTML = municipio;
    window.opener.document.getElementById('localdeapresentacao[telefone]').innerHTML = telefone;
    window.opener.document.getElementsByName('apresentacao[comparecimento_local_txt]')[0].value = descricaocompleta;

    window.opener.document.getElementById('busca_localapresentacao').value = '';
    window.opener.document.getElementsByName('apresentacao[observacao_txt]')[0].focus();
    window.close();
}

function adicionar(obj, event) {
    event.preventDefault();
    window.location = "?module=localdeapresentacao&opcao=cadastrar&voltar=apresentacaoselecionarlocal&q=<?=$query;?>&nomenu";
}
</script>
<div>
<form method="GET">
    <label for="query">Digite parte do nome do local</label>
    <input type="text" id="query" name="query" />
    <input type="hidden" name="module" value="apresentacao" />
    <input type="hidden" name="opcao" value="apresentacaoselecionarlocal" />
    <input type="hidden" name="noheader" value="1" />
    <input type="hidden" name="nomenu" value="1" />
    <input type="submit" value="Pesquisar" />
</form>
</div>
<br />
<button onclick="javascript: adicionar(this, event)">Adicionar</button>
<div>
    <h2>Resultados para (<?=$queryLimpo;?>)</h2>
    <table class="bordasimples" width="100%" cellpadding="0px">
        <thead>
            <th>Nome</th>
            <th>Bairro</th>
            <th>Município</th>
        </thead>
        <tbody>
            <?php if ($res === false || mysql_num_rows($res) == 0): ?>
            <tr>
                <td colspan="3">Nada encontrado.</td>
            </tr>
            <?php endif; ?>

            <?php $i=0; ?>
            <?php while ($row=@mysql_fetch_array($res)): ?>


            <?php

            $descricaoCompleta  = "{$row['localdeapresentacao']}. {$row['logradouro']}";

            $descricaoCompleta .= (!empty($row['numero'])) ? ", {$row['numero']}" :"";
            $descricaoCompleta .= (!empty($row['bairro'])) ? " - {$row['bairro']}" :"";
            $descricaoCompleta .= " - {$row['municipio']}/{$row['uf']}.";
            $descricaoCompleta .= (!empty($row['telefone'])) ? " Tel.: {$row['telefone']}." : "";
            $descricaoCompleta .= (!empty($row['cep'])) ? " CEP: {$row['cep']}." : "";

            $descricaoCompleta = escaparHtml($descricaoCompleta);

            ?>


            <?php $i%2?($cor='white'):($cor='#EEEEEE'); $i++; ?>
            <tr bgcolor='<?=$cor;?>'>
                <td><?=$row['localdeapresentacao'];?></td>
                <td><?=$row['bairro'];?></td>
                <td><?=$row['municipio'];?></td>
                <td><?=$row['telefone'];?></td>
                <td><input type="button" value="Selecionar"
                           onclick="atualizaLocal(
                                       '<?=$row['id_localdeapresentacao'];?>',
                                       '<?=$row['localdeapresentacao'];?>',
                                       '<?=$row['bairro'];?>',
                                       '<?=$row['municipio'];?>',
                                       '<?=$row['telefone'];?>',
                                       '<?=$descricaoCompleta;?>'
                                    )"/></td>
            </tr>
            <?php endwhile; ?>

        </tbody>
    </table>
</div>