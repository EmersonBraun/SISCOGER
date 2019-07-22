<br />
<div class="erros">
    <?php
    foreach ($erros as $erro) {
        echo '<h2><font color="red">' . $erro . '</font></h2>';
    }
    ?>
<br />
</div>
<form method="POST">
    <?php  h1("Assinantes"); ?>
    <table width='100%' class='bordasimples' style='border-top:0px;'>
        <tr bgcolor='#E0E0E0'>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Observa&ccedil;&atilde;o</th>
            <th>Ativo</th>
            <th>A&ccedil;&atilde;o</th>
        </tr>
        <?php for ($i = 0, $total = count($vetorSubscriptions); $i <= $total; $i++): ?>
            <?php $cor=($i%2)?($cor="#F0F0F0"):($cor="white"); ?>
            <input type="hidden" name="subscriptions[<?= $i ?>][id_subscription]" value="<?= isset($vetorSubscriptions[$i]['id_subscription']) ? $vetorSubscriptions[$i]['id_subscription'] : "" ?>"/>
            <input type="hidden" name="subscriptions[<?= $i ?>][processo_tipo]" value="<?= $proc; ?>"/>
            <input type="hidden" name="subscriptions[<?= $i ?>][processo_id]" value="<?= $idProcesso; ?>"/>
            <tr bgcolor='<?=$cor;?>'>
                <th><input type="text" name="subscriptions[<?= $i ?>][nome]" value="<?= $vetorSubscriptions[$i]['nome'] ?>"/>&nbsp;</th>
                <th><input type="email" name="subscriptions[<?= $i ?>][email]" value="<?= $vetorSubscriptions[$i]['email'] ?>"/>&nbsp;</th>
                <th><input type="text" name="subscriptions[<?= $i ?>][observacao]" value="<?= $vetorSubscriptions[$i]['observacao'] ?>"/>&nbsp;</th>

                <th><input type="checkbox" name="subscriptions[<?= $i ?>][ativo]" value="1" <?php if (($vetorSubscriptions[$i]['ativo'] == 1) || ($i == $total)) echo 'checked'; ?>/>&nbsp;</th>

                <th><?php if ($i != $total): ?>
                        <script type="text/javascript">
                            function removerSubscription(id) {
                                if (confirm('Confirma a exclusão do registro?')) {
                                    document.getElementById('subscription_id_a_remover').value = id;
                                    return true;
                                }
                                document.getElementById('subscription_id_a_remover').value = "";
                                return false;
                            }
                        </script>
                        <input type="submit" name="acao" value="Remover" onclick="javascript:return removerSubscription(<?= $vetorSubscriptions[$i]['id_subscription']; ?>);"/>
                    <?php endif; ?></th>
            </tr>
        <?php endfor; ?>
    </table>
    <input type="hidden" name="subscription_id_a_remover" id="subscription_id_a_remover" value=""/>
    <input type="submit" name="acao" value="Salvar" />&nbsp;
</form>