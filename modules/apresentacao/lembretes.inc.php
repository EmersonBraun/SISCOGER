<?php

//error_reporting( E_ALL );

echo '<br />';

echo '<table class="bordasimples" width="100%" cellpadding="0px">';
echo '<tbody>';
echo '<tr>';

// titulo
echo "<td colspan='7'><h1><center>";
echo "LEMBRETES AGENDADOS";
echo '</center></h1></td>';

echo '</tr>';

echo '<tr>';
echo '<th>ID</th>';
echo '<th>Email</th>';
echo '<th>Cadastro</th>';
echo '<th>Situação</th>';
echo '<th>Mensagem</th>';
echo '<th>Ação</th>';
echo '</tr>';

$objetoPdo = new PDO($pdo['dsn']['sjd'], $pdo['user'], $pdo['password']);

$sql = ("SELECT email.*,"
        . "CASE
		WHEN `email`.`dh_confirmacao_de_leitura`THEN 'Leitura Confirmada' is not null
                WHEN `email`.`dh_cancelamento` is not null THEN 'Cancelado'
                WHEN `email`.`dh_envio` is not null THEN 'Enviado'
                WHEN `email`.`dh_ult_tentativa_com_erro` is not null THEN concat('Erro:',`email`.`nr_tentativas_com_erro`)
                WHEN `email`.`dh_agendamento` is not null THEN 'Agendado'
                ELSE 'Pendente' END AS 'status',
            CASE
                WHEN `email`.`dh_confirmacao_de_leitura`THEN `email`.`dh_confirmacao_de_leitura` is not null
                WHEN `email`.`dh_cancelamento` is not null THEN `email`.`dh_cancelamento`
                WHEN `email`.`dh_envio` is not null THEN `email`.`dh_envio`
                WHEN `email`.`dh_ult_tentativa_com_erro` is not null THEN `email`.`dh_ult_tentativa_com_erro`
                WHEN `email`.`dh_agendamento` is not null THEN `email`.`dh_agendamento`
                ELSE `email`.`dh` END AS 'dh_status'"
        . " FROM email WHERE contexto_email = 'apresentacao' AND id_contexto_email = :id_apresentacao ORDER BY dh DESC, dh DESC LIMIT 15");

$stmt = $objetoPdo->prepare($sql);

$stmt->bindValue(':id_apresentacao', $apresentacao->id_apresentacao);

$stmt->execute();

$i = 0;
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $i % 2 ? ($cor = 'white') : ($cor = '#EEEEEE');
    echo "<tr bgcolor='{$cor}'>";
    echo "<td><a href='?module=email&email[id]={$row['id_email']}'>{$row['id_email']}</a></td>";
    echo "<td>{$row['destinatario_email']}</td>";
    echo "<td>{$row['dh']}</td>";
    echo "<td>{$row['status']} ({$row['dh_status']})</td>";
    $mensagem = $row['mensagem_txt'];
    $mensagemAbreviada = substr($mensagem, 0, 30);
    $mensagemHtml = converterEmHtml($mensagem);
    echo "<td><span title='{$mensagem}'>{$mensagemAbreviada} ...</span></td>";
    if (in_array($row['status'], array('Agendado'))) {
        echo "<td><a href='?module=apresentacao&apresentacao[id]={$apresentacao->id_apresentacao}&email[id]={$row['id_email']}&opcao=removerlembrete'><img src='img/wrong.gif' /></a></td>";
    } else {
        echo "<td>---</td>";
    }
    echo '</tr>';
    $i++;
}

echo '<tr>';

// titulo
echo "<td colspan='7'><button onclick='javascript: adicionarLembrete(this, event);'>Adicionar lembrete</button></td>";

echo '</tr>';

echo '</table>';
?>
<script>
    function adicionarLembrete(obj, event) {
        event.preventDefault();
        window.location="?module=email&opcao=cadastrar&email[contexto_email]=apresentacao&email[id_contexto_email]=<?=$apresentacao->id_apresentacao;?>";
    }
</script>
