<br />
<table width="100%" cellpadding="0px"  class="bordasimples">
    <tr>
        <td colspan="2"><h1 style="text-align: center">Atualização de situação de apresentação</h1></td>
    </tr>
    <tr>
        <td style="background: #dbeaf5 fixed">Digite o código:</td>
        <td><form onsubmit="javascript: tabela.buscar(this, event)"><input type="text" id="codigo" size="10" />-<span id="ano_curto"></span> <i>(Para outro ano digite o código completo. O hífen é obrigatório. Ex.: 12.345-15)</i></form>
            <span id="exibir_erro"> </span>
        </td>
    </tr>
</table>
<br />
<table width="100%" cellpadding="0px"  class="bordasimples">
    <thead>
        <tr>
            <td colspan="10"><h1 style="text-align: center">Atualizações registradas</h1></td>
        </tr>
        <tr>
            <td>Código</td>
            <td>Nº Apres.</td>
            <td>Doc. Origem</td>
            <td>Autos</td>
            <td>Policial</td>
            <td>Data</td>
            <td>Hora</td>
            <td>Anterior</td>
            <td>Nova</td>
            <td>Ação</td>
        </tr>
    </thead>
    <tbody id="apresentacoes_atualizadas">

    </tbody>
</table>

<script>

    var TabelaAtualiazacao;

    <?php

    $_SESSION['atualizacao_csrf'] = md5(date("YmdHis"));

    ?>

    var csrf = '<?=$_SESSION['atualizacao_csrf'];?>';

    var ano = '<?=date(y);?>';

    document.getElementById('ano_curto').innerHTML = ano;

    (function () {
        var instance;

        var apresentacoes;

        TabelaAtualiazacao = function () {
            if (instance) {
                return instance;
            }

            var criarUrl = function (acao, id) {
                return "?module=apresentacao&noheader&nomenu&ajax=true&ano=" + ano + "&csrf=" + csrf + "&acao=" + acao;
            }

            var getApresentacoes = function () {
                return apresentacoes;
            };

            this.getApresentacoes = getApresentacoes;

            var mostrarErro = function(mensagem) {
                document.getElementById('exibir_erro').innerHTML = '<h3>' + mensagem + '</h3>';
            }

            var limparErro = function() {
                document.getElementById('exibir_erro').innerHTML = '';
            }

            var desfazer = function(obj, event, id_apresentacao, objeto, id_objeto) {
                event.preventDefault();
                var acao = 'desfazer';
                var url = criarUrl(acao);
                url = url + '&id_apresentacao=' + id_apresentacao + '&id_objeto=' + id_objeto + '&objeto=' + objeto;
                limparErro();

                $.get(url, function (dados) {
                    if (dados.valido == true) {
                        inserir(dados.apresentacao, dados.objeto_anterior, dados.hash);
                        document.getElementById('codigo').focus();
                    } else {
                        mostrarErro(dados.mensagem);
                    }
                });
            }

            this.desfazer = desfazer;

            var inserir = function(apresentacao, objeto_anterior, hash) {
                var tbody = document.getElementById('apresentacoes_atualizadas');
                var qtdeLinhasAtual = document.getElementById('apresentacoes_atualizadas').rows.length;
                var linha;

                if ( (qtdeLinhasAtual == 0) || (qtdeLinhasAtual % 2 == 0) ) {
                    linha = '<tr>';
                } else {
                    linha = '<tr bgcolor="#EEEEEE">';
                }


                linha = linha +
                    '<td>'+hash+'</td><td><a href="?module=apresentacao&apresentacao[id]='+ apresentacao.id + '">' +
                    apresentacao.numero + '</a></td>' +
                    '<td>'+ apresentacao.origem +'</td>' +
                    '<td>'+ apresentacao.autos +'</td>' +
                    '<td>'+ apresentacao.nome +'</td>' +
                    '<td>'+ apresentacao.data +'</td>' +
                    '<td>'+ apresentacao.hora +'</td>' +
                    '<td>'+ objeto_anterior.nome +'</td>' +
                    '<td>'+ apresentacao.modificado.nome +'</td>' +
                    '<td><button onclick="tabela.desfazer(this,event,'+apresentacao.id+',\''+objeto_anterior.objeto+'\','+objeto_anterior.id+')">Desfazer</button></td>' +

                    '</tr>';

//                for (var l in linhasAtuais) {
//                    console.log(l,linhasAtuais);
//                    //$(tbody).append($(linhasAtuais[l]));
//                }
                var corpo = $("#apresentacoes_atualizadas").html();
                $("#apresentacoes_atualizadas").html('');
                $(tbody).append($(linha));
                $("#apresentacoes_atualizadas").html($("#apresentacoes_atualizadas").html()+corpo)


            }

            this.buscar = function (obj, event) {
                event.preventDefault();
                var acao = 'buscar';
                var codigo = document.getElementById('codigo').value;

                var url = criarUrl(acao);

                limparErro();

                $.get(url + '&codigo=' + codigo, function (dados) {
                    if (dados.valido === true) {
                        inserir(dados.apresentacao, dados.objeto_anterior, dados.hash);
                        document.getElementById('codigo').value = '';
                        document.getElementById('codigo').focus();
                    } else if (typeof dados.valido == 'undefined') {
                        mostrarErro('Erro na conexão. Verifique se está logado corretamente.')
                    }else {
                        mostrarErro(dados.mensagem);
                    }
                });
            }
            instance = this;
        }

    })();
    var tabela = new TabelaAtualiazacao();
    document.getElementById('codigo').focus();
</script>
