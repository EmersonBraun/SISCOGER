<?php

// obt�m o tipo e o id do processo a ser considerado para subscricao
$proc = $_GET['tipo_processo'];
$idProcesso = $_GET['id_processo'];
$campoId = 'id_' . $proc;

// instru��es para obter o processo
$objetoProcesso = new $proc;
$objetoProcesso->setValues(array('id' => $idProcesso));

// obt�m a a��o
$acao = $_POST['acao'];

// obt�m o id da subscription a ser removida
$subscriptionIdARemover = $_POST['subscription_id_a_remover'];

// obt�m as subscriptions do formulario
$subscriptions = isset($_POST['subscriptions']) ? $_POST['subscriptions'] : array();
$erros = array();

if ($acao == 'Salvar') {
    foreach ($subscriptions as $postSubscription) {

        if (!empty($postSubscription['nome']) && !empty($postSubscription['email'])) {
            $postSubscription['ativo'] = isset($postSubscription['ativo']) ? $postSubscription['ativo'] : 0;
            $subscription = new subscription();
            $subscription->setValues($postSubscription);

            if (empty($postSubscription['id_subscription'])) {
                $a = subscription::insere($subscription);
            } else {
                $a = subscription::atualiza($subscription);
            }
        } else if (!empty($postSubscription['nome']) xor !empty($postSubscription['email'])) {
            $erros[999] = "Os campos nome e email devem estar preenchidos.";
        }

        // registra erro ao violar a regra de unicidade nos campos (processo_tipo, processo_id, email)
        if(preg_match('/un_proc_email/', mysql_error()) !== 0){
            $erros[] = sprintf("O email '%s' j� est� cadastrado para este procedimento",$postSubscription['email']);
        }
    }
} else if (($acao == 'Remover') && (!empty($subscriptionIdARemover))) {
    $subscription = new subscription();
    $subscription->setValues(array('id' => $subscriptionIdARemover));
    subscription::apaga($subscription);
}
unset($subscription);
unset($subscriptionIdARemover);
unset($postSubscription);
unset($subscriptions);

$sqlSubscriptions = sprintf("select * from subscription where processo_tipo = '%s' and processo_id = '%s' order by nome,email", $proc, $idProcesso);

$resultSubscriptions = mysql_query($sqlSubscriptions);

$totalSubscriptions = mysql_num_rows($resultSubscriptions);

while ($row = mysql_fetch_assoc($resultSubscriptions)) {
    $vetorSubscriptions[] = $row;
}
unset($resultSubscriptions);
unset($row);

include 'menu.inc.php';

include 'formulario.inc.php';
