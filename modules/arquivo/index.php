<?
$opcao=$_REQUEST['opcao'];
global $login,$login_unidade,$nivel;

$procedimento=$_REQUEST[procedimento];

$arquivo=new arquivo();
$arquivo->setvalues($_REQUEST[arquivo],"","simples");

if ($_SESSION[debug]) pre($arquivo);

if ($acao=="gravar") {
	if (!$arquivo->insere($arquivo,"arquivo")) {
	    echo "<h2>Houve um erro ao cadastrar o arquivo!</h2>";
	} else {
            if ($_REQUEST['notificar_assinantes_por_email'] == 1) {
                $notificacaoDeAarquivo = new NotificacaoDearquivo($arquivo);
                $resultadoNotificacao = $notificacaoDeAarquivo->notificar();

                if (is_array($resultadoNotificacao)){

                   if (count($resultadoNotificacao) == 0) {
                       echo "<h2>Nenhum email cadastrado para envio</h2><br />";
                   }

                    foreach ($resultadoNotificacao as $resultadoAssinante => $resultadoResultado) {
                        echo sprintf("<h2>Mensagem para %s: %s</h2>",  htmlentities($resultadoAssinante), htmlentities($resultadoResultado));
                    }

                    echo "<br />";
                }
            }
        }
}
if ($opcao=="atualizar") {
	if ($acao=="atualizar") {
		//CAP TODISCO 04/12/2013, NAO EH MAIS POSSIVEL ALTERAR arquivoS
		//die("<h3>Imposs&iacute;vel atualizar arquivos</h3>");
		//if (trim($arquivo->descricao)=="") h3("arquivo s/ descri&ccedil;&atilde;o");
		//else {
		if (arquivo::atualiza($arquivo)) {
			echo "<h2>arquivo atualizado com sucesso!</h2>";

			$link="?module=arquivo_view&opcao=prateleiras";
			echo "<a href='$link'>Clique aqui para voltar</a>";
		}
		//}
	}
	elseif ($acao=="apagar") {
		arquivo::apaga($arquivo);
		echo "<h2>arquivo apagado com sucesso</h2>";

		$link="?module=arquivo_view&opcao=inserir";
		echo "<a href='$link'>Clique aqui para voltar para inser&ccedil;&atilde;o</a><br><br>";

		$link="?module=arquivo_view&opcao=prateleiras";
		echo "<a href='$link'>Clique aqui para ir para prateleiras</a><br><br>";

		die;
	}
	else {
		include("frm_atualiza.inc");
	}
die;
}


$ano=$_SESSION[sjd_ano];

$arquivo=$_REQUEST[arquivo];

if ($arquivo[id_ipm]) { $procedimento="ipm"; $idp=$arquivo[id_ipm]; }
if ($arquivo[id_cj]) { $procedimento="cj"; $idp=$arquivo[id_cj]; }
if ($arquivo[id_cd]) { $procedimento="cd"; $idp=$arquivo[id_cd]; }
if ($arquivo[id_sindicancia]) { $procedimento="sindicancia"; $idp=$arquivo[id_sindicancia]; }
if ($arquivo[id_fatd]) { $procedimento="fatd"; $idp=$arquivo[id_fatd]; }
if ($arquivo[id_desercao]) { $procedimento="desercao"; $idp=$arquivo[id_desercao]; }
if ($arquivo[id_apfd]) { $procedimento="apfd"; $idp=$arquivo[id_apfd]; }
if ($arquivo[id_iso]) { $procedimento="iso"; $idp=$arquivo[id_iso]; }
if ($arquivo[id_it]) { $procedimento="it"; $idp=$arquivo[id_it]; }
if ($arquivo[id_adl]) { $procedimento="adl"; $idp=$arquivo[id_adl]; }
if ($arquivo[id_sai]) { $procedimento="sai"; $idp=$arquivo[id_sai]; }

$sql="SELECT * FROM $procedimento
	LEFT JOIN andamento ON andamento.id_andamento=$procedimento.id_andamento
	LEFT JOIN andamentocoger ON andamentocoger.id_andamentocoger=$procedimento.id_andamentocoger
WHERE (id_$procedimento = '$idp')
LIMIT 0,1";

$resultado=@mysql_query($sql);
$row=@mysql_fetch_array($resultado);

include ("formulario.inc.php");




?>
