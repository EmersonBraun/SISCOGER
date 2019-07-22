<?

if ($user['nivel']==6 || $user['nivel']==7) { $opcaoGeral="readonly"; $opcaoGeral2="disabled"; } // alteracao solicitada pelo Cap Todisco

?>

<script language=javascript>
    function validar(form) {

        if (aguardando == true) {
            window.alert("Aguarde enquanto o nome é preenchido");
            return false;
        }

        var camposObrigatorios = {
            'remetente_nome': 'Nome do remetente',
            'remetente_email': 'Email do remetente',
            'destinatario_nome': 'Nome do destinatário',
            'destinatario_email': 'Email do destinatário',
            'assunto': 'Assunto',
            'mensagem_txt': 'Mensagem'
        }


        for (campoNome in camposObrigatorios) {
            campo = document.getElementsByName('email[' + campoNome + ']')[0];

            if (campo.value.trim() == "") {
                window.alert("Preencha o campo " + camposObrigatorios[campoNome] + "!");
                campo.focus();
                return false;
            }
        }
<?php /*
        if (Verifica_Hora('apresentacao[comparecimento_hora]') === false) {
            campo = document.getElementsByName('apresentacao[comparecimento_hora]')[0];
            window.alert("A hora está em formato errado!");
            campo.focus();
            return false;
        }
*/ ?>
        return true;
    }

    function Verifica_Hora(Campo) {

        Hora = document.getElementsByName(Campo)[0];
        hrs = (Hora.value.substring(0, 2));
        min = (Hora.value.substring(3, 5));

        estado = "";
        if ((hrs < 00) || (hrs > 23) || (min < 00) || (min > 59) || (min == '') || (min.length != 2))
        {
            return false
        }
        if (Hora == "")
        {
            return false
        }
        return true

    }
</script>

<form class="controlar-modificacao" id="email" name="email" onsubmit='return validar(this)' action="?module=email" method="POST" enctype="multipart/form-data">
<!-- campo obrigatorio, nao delete -->
<input type="hidden" name="email[id_email]">
<input type="hidden" name="email[contexto_email]">
<input type="hidden" name="email[id_contexto_email]">
<input type="hidden" name="email[anexos]">

<?if ($opcao=="cadastrar"){?><center><h1>Novo Email</h1></center><?}?>
<?if ($opcao=="atualizar"){?><center><h1>Editar Email</h1></center><?}?>

<table class='bordasimples' cellspacing="1" width="100%" border="0">
	<tr>
		<td bgcolor="#ffffff" valign="top">
		<?php
		//echo "<table width='100%'>";
		form ::openTR();
                        form::openTD("colspan='6'");
				form::openLabel("Nome do remetente");
				echo "<input name='email[remetente_nome]' type='text' size='60' maxlength='160'>";
				form::closeLabel();
			form::closeTD();
                        form::openTD("colspan='6'");
				form::openLabel("Email do remetente");
				echo "<input name='email[remetente_email]' type='text' size='60' maxlength='160' value='no-reply-pmpr@pm.pr.gov.br' readonly>";
				form::closeLabel();
			form::closeTD();
                form ::closeTR();
		form ::openTR();
			form::openTD("colspan='6'");
				form::openLabel("Nome do destinatário");
				echo "<input name='email[destinatario_nome]' type='text' size='60' maxlength='160'>";
				form::closeLabel();
			form::closeTD();
                        form::openTD("colspan='6'");
				form::openLabel("Email do destinatário");
				echo "<input name='email[destinatario_email]' type='text' size='60' maxlength='160'>";
				form::closeLabel();
			form::closeTD();
                form ::closeTR();
		form ::openTR();
                        form::openTD("colspan='6'");
				form::openLabel("Assunto");
                                echo "<input name='email[assunto]' type='text' size='60' maxlength='160'>";
				form::closeLabel();
			form::closeTD();
                        form::openTD("colspan='6'");
				form::openLabel("Envio");
                                if (!empty($email->dh_cancelamento)) {
                                    echo "O envio foi cancelado às: " . $email->dh_cancelamento;
                                } else if (!empty($email->dh_ult_tentativa_com_erro)) {
                                    echo "Ocorreu em erro no envio. Última tentativa às: " . $email->dh_ult_tentativa_com_erro;
                                } else if (!empty($email->dh_envio)) {
                                    echo "Enviado às: " . $email->dh_envio;
                                } else if (empty($email->dh_envio) && !empty($email->dh_agendamento)) {
                                    echo "Agendado para: " . $email->dh_agendamento;
                                } else {
                                    echo "Não enviado.";
                                }
				form::closeLabel();
			form::closeTD();
                form ::closeTR();
		form ::openTR();
                        form::openTD("colspan='12'");
                        form::openLabel("Mensagem");
                            echo "<textarea name='email[mensagem_txt]' cols='100' rows='30' >{$email->mensagem_txt}</textarea>";
                        form::closeLabel();
			form::closeTD();
		form ::closeTR();
if (empty($email->dh_envio) && empty($email->dh_ult_tentativa_com_erro) && empty($email->dh_cancelamento)) {
                form ::openTR();
                        form::openTD("colspan='6'");
                        form::input("Agendar envio para o dia", "email_[dh_agendamento_data]");
                        echo '<input type="hidden" name="email[dh_agendamento]">';
			form::closeTD();
                        form::openTD("colspan='6'");
                        form::input("às", "email_[dh_agendamento_hora]", "##:##");
			form::closeTD();
		form ::closeTR();
}


                form ::openTR();
                form::openTD("colspan='12'");
                if ($user['nivel'] <> 6 && $user['nivel'] <> 7) {
                    if ($opcao == "cadastrar")
                        echo "<input type='submit' name='acao' value='Cadastrar'>";
                    if ($opcao == "atualizar") {
                        echo "<input type='submit' name='acao' value='Atualizar'> ";
                        if (empty($email->dh_envio) && empty($email->dh_ult_tentativa_com_erro) && empty($email->dh_cancelamento)) {
                            echo "<input type='submit' name='acao' value='Apagar'> ";
                        }
                    }
                }
                if (!empty($email->contexto_email)) {
                    echo "<br /><br /><a href='?module={$email->contexto_email}&{$email->contexto_email}[id]=".$email->id_contexto_email."'>Voltar para {$email->contexto_email}</a>";
                }
                form::closeTD();
		form ::closeTR();

closeTable();
?>



</td></tr></table>

</form>
<script>
    var mensagem_txt = document.getElementsByName('email[mensagem_txt]')[0].value;
</script>
<?
//Preenchimento automático formulário
if ($email) {
    formulario::values($email);
}
?>

<script>
    if (isdefined(document.getElementsByName('email_[dh_agendamento_data]')[0])) document.getElementsByName('email_[dh_agendamento_data]')[0].value="<?=$email->dh_agendamento_data;?>";
    if (isdefined(document.getElementsByName('email_[dh_agendamento_hora]')[0])) document.getElementsByName('email_[dh_agendamento_hora]')[0].value="<?=$email->dh_agendamento_hora;?>";
    document.getElementsByName('email[mensagem_txt]')[0].value=mensagem_txt;
</script>
