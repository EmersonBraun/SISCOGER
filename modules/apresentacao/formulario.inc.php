<?php
if ($user['nivel'] == 6 || $user['nivel'] == 7) {
    $opcaoGeral = "readonly";
    $opcaoGeral2 = "disabled";
} // alteracao solicitada pelo Cap Todisco

if (!$apresentacao->sjd_ref_ano)
    $apresentacao->sjd_ref_ano = $_SESSION[sjd_ano];

if (!isset($apresentacao->id_apresentacaosituacao) && isset($notacomparecimento) && $notacomparecimento->status == notacomparecimento::PENDENTE) {
    $apresentacao->id_apresentacaosituacao = apresentacaosituacao::SITUACAO_AG_PUBLICACAO;
} else if (!isset($apresentacao->id_apresentacaosituacao) && isset($notacomparecimento) && $notacomparecimento->status == notacomparecimento::PUBLICADA) {
    $apresentacao->id_apresentacaosituacao = apresentacaosituacao::SITUACAO_PREVISTA;
}

if (!$apresentacao->id_apresentacaosituacao)
    $apresentacao->id_apresentacaosituacao = apresentacaosituacao::SITUACAO_PREVISTA;
if (!$apresentacao->id_apresentacaoclassificacaosigilo)
    $apresentacao->id_apresentacaoclassificacaosigilo = 1;
if (!$apresentacao->id_apresentacaotipoprocesso)
    $apresentacao->id_apresentacaotipoprocesso = 1;
if (!$apresentacao->id_apresentacaocondicao)
    $apresentacao->id_apresentacaocondicao = 1;
if (!$apresentacao->id_apresentacaonotificacao)
    $apresentacao->id_apresentacaonotificacao = apresentacaonotificacao::NOTIFICACAO_PENDENTE;
?>

<script language=javascript>
    function validar(form) {

        if (aguardando == true) {
            window.alert("Aguarde enquanto o nome é preenchido");
            return false;
        }

        var camposObrigatorios = {
            'cdopm': 'Unidade de Cadastro',
            'id_apresentacaonotificacao': 'Situação da notificação',
            'id_apresentacaosituacao': 'Situação da apresentacao',
            'id_apresentacaoclassificacaosigilo': 'Publicidade',
            'id_apresentacaotipoprocesso' : 'Tipo de Processo/Procedimento',
            'comparecimento_local_txt': 'Local de Comparecimento',
            'comparecimento_data': 'Data de Comparecimento',
            'comparecimento_hora': 'Hora de Comparecimento',
            'pessoa_nome': 'Nome da Pessoa',
            'id_apresentacaocondicao': 'Condição da pessoa referente a apresentação'
        }


        for (campoNome in camposObrigatorios) {
            campo = document.getElementsByName('apresentacao[' + campoNome + ']')[0];

            if (campo.value.trim() == "") {
                window.alert("Preencha o " + camposObrigatorios[campoNome] + "!");
                campo.focus();
                return false;
            }
        }

        if (Verifica_Hora('apresentacao[comparecimento_hora]') === false) {
            campo = document.getElementsByName('apresentacao[comparecimento_hora]')[0];
            window.alert("A hora está em formato errado!");
            campo.focus();
            return false;
        }

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
<? ?>

<form class="controlar-modificacao" ID='apresentacao' name="apresentacao" action="index.php?module=apresentacao" method="post" onSubmit="return validar(this);" enctype="multipart/form-data">
    <input type="hidden" name="apresentacao[id_apresentacao]">
    <input type="hidden" name="apresentacao[sjd_ref]">
    <input type="hidden" name="apresentacao[sjd_ref_ano]">

    <!-- iso -->
    <br />
    <? if ($opcao == "cadastrar") { ?><center><h1>Nova Requisição de Apresentação</h1></center><? } ?>
    <? if ($opcao == "atualizar") { ?><center><h1>Requisição de Apresentação</h1></center><? } ?>

    <table cellpadding="0" cellspacing="1" width="100%" border="0"><tr><td colspan=2 bgcolor="#4682B4">
                <table cellspacing="1" width="100%" border="0">
                    <? if ($opcao == "cadastrar") { ?>
                        <tr><th colspan="5" bgcolor="#DBEAF5"><font face="tahoma, verdana" size="2">Formulário de
                                preenchimento</font></th></tr> 	<? } ?>

        </tr></table>
</table>

<table border=0 width=100%>

    <?
    form::openTR();

    form::openTD("colspan='2'");
    form::openLabel("N&ordm; da apresentação");
    if ($apresentacao->sjd_ref) {
        echo "<input readonly size='10' name='numeracao' type='text' value='" . $apresentacao->sjd_ref . "/" . $apresentacao->sjd_ref_ano . "'>";
    } else {
        echo "<input readonly size='10' name='numeracao' type='text' value='*/" . $_SESSION[sjd_ano] . "'>";
    }
    form::closeLabel();
    form::closeTD();

    openTD("colspan='2'");
    form::openLabel("OPM");

    if ((isset($apresentacao->id_apresentacao) && !in_array($user["nivel"],array(4,5)))) {
        $opm = new opm(str_pad($apresentacao->cdopm,10,'0',STR_PAD_RIGHT));
        echo "<input type='text' value='{$opm->abreviatura}' readonly='true' />";
        echo "<input type='hidden' name='apresentacao[cdopm]' value='{$apresentacao->cdopm}' />";
    } else {
        echo "<select name='apresentacao[cdopm]'>";
        include("includes/option_opm.php");
        echo "</select>";
    }

    form::closeLabel();
    closeTD();

    form::openTD("colspan='2'");
    form::openLabel("Notificação");
    formulario::option("apresentacao", "apresentacaonotificacao", "WHERE ativo=1 ORDER BY ordem", "", 0, 0);
    form::closeLabel();
    form::closeTD();

    form::openTD("colspan='3'");
    form::openLabel("Situação");
    if ((in_array($user['nivel'], array(5)))) {
        formulario::option("apresentacao", "apresentacaosituacao", "WHERE 1=1 ORDER BY ordem", "", 0, 0);
    } else if (isset($notacomparecimento) && (in_array($user['nivel'], array(4,5)))) {
        formulario::option("apresentacao",
                "apresentacaosituacao",
                sprintf(
                        "WHERE ativo = %d ORDER BY ordem",
                        1),
                "", 0, 0);
    } else {
        $condicao = sprintf(
                        "WHERE ((ativo = %d) AND (id_apresentacaosituacao not in (%d, %d))) ORDER BY ordem",
                        1, apresentacaosituacao::SITUACAO_AG_PUBLICACAO,apresentacaosituacao::SITUACAO_APAGADA);
        formulario::option("apresentacao",
                "apresentacaosituacao",
                $condicao,
                "", 0, 0);
    }

    form::closeLabel();
    form::closeTD();




    openTD("colspan='3'");
    form::openLabel("Publicidade");
    if (isset($notacomparecimento) && isset($notacomparecimento->id_notacomparecimento)) {
        formulario::option("apresentacao", "apresentacaoclassificacaosigilo", "WHERE ativo=1 AND id_apresentacaoclassificacaosigilo IN (1)", "", 0, 0);
    } else {
        formulario::option("apresentacao", "apresentacaoclassificacaosigilo", "WHERE ativo=1", "", 0, 0);
    }
    form::closeLabel();
    closeTD();
    form::closeTR();




    form::openTR();




    form::openTD("colspan='6'");
    form::input("Documento de Origem(Nº Of.)", "apresentacao[documento_de_origem]");
    form::closeTD();


    if (isset($notacomparecimento)) {
        form::openTD("colspan='3'");
        form::input("Data do documento", "apresentacao[documento_de_origem_data]");
        form::closeTD();
        form::openTD("colspan='3'");
        form::openLabel("Nota COGER");
        echo "<input type='hidden' name='notacomparecimento[id]' value='{$notacomparecimento->id_notacomparecimento}' />";
        echo "<input type='hidden' name='apresentacao[id_notacomparecimento]' value='{$notacomparecimento->id_notacomparecimento}' />";
        echo "<input type='text' value='{$notacomparecimento->sjd_ref}/{$notacomparecimento->sjd_ref_ano}' readonly='true' />";
        echo "<a href='?module=notacomparecimento&notacomparecimento[id]={$notacomparecimento->id_notacomparecimento}'>Ir para nota</a>";
        form::closeLabel();
        form::closeTD();
    } else {
        form::openTD("colspan='6'");
        form::input("Data do documento", "apresentacao[documento_de_origem_data]");
        form::closeTD();
    }

    form::closeTR();




    form::openTR();
    form::openTD("colspan='6'");
    form::openLabel("Processo/Procedimento");
    formulario::option("apresentacao", "apresentacaotipoprocesso", "WHERE ativo=1 order by ordem", "", 0, 0);
    form::closeLabel();
    form::closeTD();
    form::openTD("colspan='6'");
    form::input("Autos Nº", "apresentacao[autos_numero]");
    form::closeTD();
    form::closeTR();

    form::openTR();

    form::openTD("colspan='12'");
    ?>

    <table class="borda" width="100%" align="left" cellpadding="1" bgcolor="#F2F2F2">
        <tbody>
            <tr>
                <td class="borda" bgcolor="#FFFFFF">Acusados: </td>
            </tr>
            <tr>
                <td>
                    <input type="text" size="56" name="apresentacao[acusados]">
                </td>
            </tr>
        </tbody>
    </table>

    <?php
    form::closeTD();

    form::closeTR();

    form::openTR();

    form::openTD("colspan='6'");
    ?>
    <table class="borda" cellpadding="1" bgcolor="#F2F2F2" width="100%" align="left">
        <tr>
            <td class="borda" bgcolor="#FFFFFF">Selecione o local: </td>
        </tr>
        <tr>
            <td>
                <input type="hidden" name="apresentacao[id_localdeapresentacao]" />
                <input type="text" id="busca_localapresentacao" /> <button onclick="buscaLocalApresentacao(this,event)">Procurar</button><br />
                <table border="0">
                    <tr>
                        <td>Nome:</td>
                        <td><span id="localdeapresentacao[localdeapresentacao]"><?=$localdeapresentacao->localdeapresentacao;?></span></td>
                    </tr>
                    <tr>
                        <td>Bairro:</td>
                        <td><span id="localdeapresentacao[bairro]"><?=$localdeapresentacao->bairro;?></span></td>
                    </tr>
                    <tr>
                        <td>Município:</td>
                        <td><span id="localdeapresentacao[municipio]"><?=$localdeapresentacao->municipio->nomecomacento;?></span></td>
                    </tr>
                    <tr>
                        <td>Telefone:</td>
                        <td><span id="localdeapresentacao[telefone]"><?=$localdeapresentacao->telefone;?></span></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table><?php
    form::closeTD();
    form::openTD("colspan='6'");
    ?>
    <table class="borda" cellpadding="1" bgcolor="#F2F2F2" width="100%" align="left">
        <tr>
            <td class="borda" bgcolor="#FFFFFF">Descrição do local:</td>
        </tr>
        <tr>
            <td><textarea name="apresentacao[comparecimento_local_txt]" id='comparecimento_local_txt' rows='7' cols='80' readonly ></textarea></td>
        </tr>
    </table><?php
    form::closeTD();





    form::closeTR();




    form::openTR();

        form::openTD("width='50%' colspan='6'");
        form::input("Documento de origem", "apresentacao[documento_de_origem_file]");
        form::closeTD();

        form::openTD("colspan='6'");


        ?>

    <table class="borda" width="100%" align="left" cellpadding="1" bgcolor="#F2F2F2">
        <tbody>
            <tr>
                <td class="borda" bgcolor="#FFFFFF">Memorando de apresentação: </td>
            </tr>
            <tr>
                <?php if (property_exists($apresentacao, 'id_apresentacao') && $apresentacao->id_apresentacao > 0 && !isset($apresentacao->memorando_pdf)): ?>
                <td><button onclick="gerarMemorando(this, event, <?=$apresentacao->id_apresentacao;?>)">Gerar</button></td>
                <?php elseif (!property_exists($apresentacao, 'id_apresentacao') || empty($apresentacao->id_apresentacao)): ?>
                <td>&nbsp;</td>
                <?php else: ?>
                <td><a href="<?=$apresentacao->memorando_pdf;?>">Memorando</a><input type="hidden" name="apresentacao[memorando_pdf]" /> <button onclick="gerarMemorando(this, event, <?=$apresentacao->id_apresentacao;?>)">Alterar</button></td>
                <?php endif; ?>
            </tr>
        </tbody>
    </table>

    <?php


    form::closeTD();

    form::closeTR();

    form::openTR();
    form::openTD("width='100%' colspan='12'");
    $opcoes = " id='observacao_txt' rows='3' cols='80' ";
    form::input("Observação", "apresentacao[observacao_txt]");
    form::closeTD();
    form::closeTR();



    form::openTR();
    form::openTD("colspan='6'");
    form::input("Data do comparecimento", "apresentacao[comparecimento_data]");
    form::closeTD();
    form::openTD("colspan='6'");
    form::input("Hora do comparecimento", "apresentacao[comparecimento_hora]", "##:##");
    form::closeTD();
    form::closeTR();
    form::openTR();
    form::openTD("colspan='12'");
    ?>


    <table border=0 width=100%>
        <tr><td>

                <table cellpadding="1" cellspacing="1" width="100%" bgcolor="#EEEEEE"><tr><td>
                            <table align=center border=0 cellpadding="0" cellspacing="1" width="100%">
                                <tr><th colspan="6" bgcolor="#EEEEEE"><font face="tahoma, verdana" size="2">Pessoa</font></th></tr>
                                <tr bgcolor=white align=center><td>RG</td><td valign="center">Nome<img border=0 src='img/lupa.gif' width="20" onclick="buscapmpelonome(this, event)"/></td><td>Posto/Graduação</td><td>Quadro</td><td>OPM</td><td>Condição</td></tr>
                                <tr bgcolor=white>
                                    <td><input type=text size=12 name=apresentacao[pessoa_rg] onkeypress='return DigitaNumeroTempoReal(this, event)' onblur="ajaxFormPessoa(this, 'policial', Array('pessoa_nome', 'pessoa_posto', 'pessoa_quadro', 'pessoa_unidade_lotacao_meta4', 'pessoa_unidade_lotacao_descricao', 'pessoa_unidade_lotacao_sigla', 'pessoa_unidade_lotacao_codigo'));" <?php echo $opcaoGeral2; ?>></td>
                                    <td><input type=text size=30 ajax=1 name=apresentacao[pessoa_nome]></td>
                                    <td><input type=text size=10 name="apresentacao[pessoa_posto]"></td>
                                    <td><input type=text size=10 name="apresentacao[pessoa_quadro]"></td>
                                    <td><input type=text size=10 name="apresentacao[pessoa_unidade_lotacao_sigla]" readonly="true"><button onclick="buscaopm(this, event);"><img border=0 src='img/lupa.gif' width="16" /></button></td>
                                <input type="hidden" name="apresentacao[pessoa_unidade_lotacao_meta4]">
                                <input type="hidden" name="apresentacao[pessoa_unidade_lotacao_descricao]">
                                <input type="hidden" name="apresentacao[pessoa_unidade_lotacao_codigo]">

                                <td><?php formulario::option("apresentacao", "apresentacaocondicao", "WHERE ativo=1", "", 0, 0); ?></td>
                    </tr>
                </table>
            </td></tr></table>

    <br>
    </td></tr>
    <tr><td><label><input type="checkbox" name="duplicarapresentacao" value="1">Duplicar</label></td></tr><tr><td>
            <?
            if ($user['nivel'] <> 6 && $user['nivel'] <> 7) {
                if (($opcao == "cadastrar") || (is_null($apresentacao->id_apresentacao)))
                    echo "<input type='submit' name='acao' value='Cadastrar'> <input type='submit' name='acao' value='Cadastrar e Novo'>";
                if ((($opcao == "cadastrar") || (is_null($apresentacao->id_apresentacao))) && (isset($notacomparecimento)))
                    echo "<input type='button' value='Voltar' onclick='javascript:voltarparanota()'> ";
                if (($opcao == "atualizar") && (!is_null($apresentacao->id_apresentacao)))
                    echo "<input type='submit' name='acao' value='Atualizar'> ";
                if ((isset($apresentacao->id_apresentacao)) && ($apresentacao->id_apresentacaosituacao != apresentacaosituacao::SITUACAO_APAGADA) && ($apresentacao->usuario_rg == $user['UserLogin'] || in_array($user['nivel'], array(5) )))
                    echo "&nbsp;<input type='submit' name='opcao' value='Apagar'> ";
            }
            ?>
        </td></tr>

</table>
    <?php
    form::closeTD();
    form::closeTR();
    ?>
</table>

</form>

<?php

if (isset($apresentacao->id_apresentacao)) {
    include 'lembretes.inc.php';
    include 'historico.inc.php';
}


//Preenchimento automático formulário
if ($apresentacao) {
    formulario::values($apresentacao);

    formulario::values($encarregado, "envolvido[encarregado]");
    $i = 1;
    while ($row = @mysql_fetch_assoc($resI)) {
        formulario::values($row, "envolvido[$i]");
        if ($row[rg] and $user['nivel'] <> 5)
            echo "<script>document.getElementsByName('envolvido[$i][rg]')[0].disabled=true;</script>";
        $i++;
    }
    if ($ligacoes) {
        $i = 1;
        while ($rowL = mysql_fetch_assoc($resL)) {
            formulario::values($rowL, "ligacao[$i]");
            $i++;
        }
    }
}
?>

<script>


    function ajaxFormPessoa(campo, tabela, vetor) {
        //Parâmetros: O índice da tabela campo será procurado na tabela tabela e retornará os resultados nos campos da tabela vetor.
        //window.alert('rocks');
        if (aguardando)
            return false;
        aguardando = true;

        //Definição de variáveis
        var strposIni = campo.name.lastIndexOf("[");
        var strposFim = (campo.name.lastIndexOf("]") - strposIni);
        var coluna = campo.name.substr(strposIni + 1, strposFim - 1);
        var prefixo = campo.name.substr(0, strposIni);

        //Exibe o texto carregando nos campos da Array vetor
        for (var i = 0; i < vetor.length; i++) {
            document.getElementsByName(prefixo + '[' + vetor[i] + ']')[0].value = '...carregando...';
        }

<?php /* vetor2 = ['nome', 'cargo', 'quadro', 'id_meta4', 'opm_descricao',]; */ ?>
        coluna2 = 'rg';

        var valor = campo.value;

        //Abre a url
        var urlAjax = "ajax/ajax.form2.php?tabela=" + tabela + "&" + tabela + "[" + coluna2 + "]=" + valor;
<?php /* for (var i=0; i<vetor2.length ; i++) { */ ?>
        urlAjax += "&ret[]=nome&ret[]=cargo&ret[]=quadro&ret[][opm]=meta4&ret[][opm]=descricao&ret[][opm]=abreviatura&ret[][opm]=codigo";
<?php /* } */ ?>
        xmlhttp.open("GET", urlAjax, true);

        //Executada quando o navegador obtiver o código
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4) {
                //Lê o texto
                var texto = xmlhttp.responseText
                //window.alert(texto);
                //Desfaz o urlencode
                texto = texto.replace(/\+/g, " ")
                texto = unescape(texto)
                //Split no texto
                texto = texto.split(";");

                //Exibe o texto no campo escolhido
                aguardando = false;
                for (var i = 0; i < vetor.length; i++) {
                    document.getElementsByName(prefixo + '[' + vetor[i] + ']')[0].value = texto[i];
                }
                //campo.value=texto

            }
        }
        xmlhttp.send(null)
    }

    function buscaopm(object, event) {
        console.log(object, event);
        event.preventDefault();
        window.open('?module=apresentacao&opcao=apresentacaoselecionaropm&nomenu=true&noheader=true', 'childWindow', 'width=600,height=400,resizable=yes,scrollbars=yes,status=no,location=no,left=0,top=0');
    }

    function buscapmpelonome(object, event) {
        console.log(object, event);
        event.preventDefault();
        var nome = document.getElementsByName('apresentacao[pessoa_nome]')[0].value;
        window.open('?module=apresentacao&opcao=buscarpelonome&nomenu=true&noheader=true&nome_a_localizar='+nome, 'childWindow', 'width=1024,height=600,resizable=yes,scrollbars=yes,status=no,location=no,left=0,top=0');
    }

<?php if (isset($campoSetFocus)): ?>
        document.getElementsByName('<?= $campoSetFocus; ?>')[0].focus();
<?php endif; ?>

</script>

<script>

    var csrf = '<?php echo $csrf = md5('salt'. date('YmdHis')); $_SESSION['csrf_apresentacao'][$apresentacao->id_apresentacao]= $csrf; ?>';

    function voltarparanota() {
        window.location = "?module=notacomparecimento&opcao=listarapresentacoes&notacomparecimento[id]=<?= $notacomparecimento->id_notacomparecimento; ?>"
    }

    function selecionaLocal(elm, event) {
        elmLocal = document.getElementById('comparecimento_local_txt');
        elmLocal.value = elm.value;
    }

    function buscaLocalApresentacao(obj, event) {
        event.preventDefault();
        var queryLocal = document.getElementById('busca_localapresentacao').value;
        window.open('?module=apresentacao&opcao=apresentacaoselecionarlocal&query='+queryLocal+'&nomenu=true&noheader=true', 'childWindow', 'width=600,height=400,resizable=yes,scrollbars=yes,status=no,location=no,left=0,top=0');


    }

    function gerarMemorando(obj, event, id) {
        event.preventDefault();
        window.location = '?module=memorandoapresentacao&apresentacao[id]='+id+'&csrf_apresentacao='+csrf;
    }

 </script>
