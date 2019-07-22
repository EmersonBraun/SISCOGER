<?php
// ini_set('display_errors',1);
// ini_set('display_startup_erros',1);
// error_reporting(E_ALL ^E_STRICT ^E_DEPRECATED ^E_NOTICE);

if (isset($_REQUEST['email']['id'])) $opcao="atualizar";

if (strtolower($opcao) == 'cadastrar') {
    if (isset($_REQUEST['email']['contexto_email']) && isset($_REQUEST['email']['id_contexto_email']) ) {
        switch ($_REQUEST['email']['contexto_email']) {
            case 'apresentacao':
                $contexto = new apresentacao();
                $contexto->setValues(array('id' => $_REQUEST['email']['id_contexto_email']));

                $icalcOptions = array(
                    'SUMMARY' => 'Apresentação',
                    'DESCRIPTION' => $contexto->criarResumo(),
                    'LOCATION' => $contexto->comparecimento_local_txt,
                );

                $icalcDt = DateTime::createFromFormat('d/m/Y H:i:00', "{$contexto->comparecimento_data} {$contexto->comparecimento_hora}:00");

                $icalc = new FSimpleICalendar($icalcOptions, $icalcDt, $icalcDt);
                break;
            default:
                break;
        }
    }
}

$email=new email();
//pre($email);exit();
if (isset($_REQUEST['email'])) {
	$email->setValues($_REQUEST['email'],'','');
}
$email->usuario_rg = $user['UserLogin'];

if ($contexto instanceof apresentacao) {
    $policial = $contexto->policial;

    $emailPolicial = $policial->email;

    if (empty($emailPolicial)) {
        $policial_email = new policial_email();
        $policial_email->setValues('', sprintf("WHERE rg = '%s'", $row['pessoa_rg']));
        $emailPolicial = $policial_email->email;
    }

    $email->mensagem_txt = $contexto->criarMensagem();
    $email->destinatario_nome = FHelperICO::obtemNomeConformeAIco($policial);
    $email->destinatario_email = $emailPolicial;
    $email->assunto = 'Lembrete de apresentação';
    $email->dh_agendamento = date('Y-m-d H:i:s');
}

if (isset($_REQUEST['email_']['dh_agendamento_hora']) && isset($_REQUEST['email_']['dh_agendamento_data'])) {
    $dh_agendamentoObj = DateTime::createFromFormat("d/m/Y H:i", "{$_REQUEST['email_']['dh_agendamento_data']} {$_REQUEST['email_']['dh_agendamento_hora']}");
    if ($dh_agendamentoObj instanceof DateTime) {
        $email->dh_agendamento = $dh_agendamentoObj->format("Y-m-d H:i:s");
        $dh_agendamento_data = $dh_agendamentoObj->format("d/m/Y");
        $dh_agendamento_hora = $dh_agendamentoObj->format("H:i");
    } else {
        $email->dh_agendamento = '';
        $dh_agendamento_data = '';
        $dh_agendamento_hora = '';
    }
}

if (isset($_SESSION['debug'])) { pre($email); }

// inclui o menu
if (strtolower($opcao)=="cadastrar")  {
	if ($user["nivel"]<2) die;

	if (strtolower($acao)=="cadastrar") {
        if (isset($icalc) && $icalc instanceof FSimpleICalendar) {
            try {
                $arquivo = $icalc->gerarArquivo();
                if (is_string($arquivo)) {
                    $emailAnexos = $email->getAnexos();
                    $emailAnexos[] = $arquivo;
                    $email->setAnexos($emailAnexos);
                }
            } catch (\Exception $e) {

            }
        }

		$id=email::insere($email);
		log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", inseriu o <a href=\"?module=email&email[id]=$id\">Email nº ".$id."</a>","email");
		echo "<h2>Email cadastrado com sucesso!</h2>";
                echo "<a href='?module=email&email[id]=".$id."'><button>Clique aqui para voltar ao Email.</button></a><br><br>";
		echo "<a href='?module={$email->contexto_email}&{$email->contexto_email}[id]=".$email->id_contexto_email."'><button>Clique aqui para voltar a {$email->contexto_email}.</button></a>";
	}
	else {
		include ("formulario.inc.php");
	}
} elseif (strtolower($opcao)=="apagar") {
    $email->dh_cancelamento = date("Y-m-d H:i:s");
    $email->usuario_rg_cancelamento = $user['UserLogin'];
    if ($id=email::atualiza($email)) {
        echo "<h2>Email cancelado com sucesso!</h2>";
        echo "<a href='?module=email&email[id]=".$email->id_email."'><button>Clique aqui para voltar ao Email.</button></a><br><br>";
        echo "<a href='?module={$email->contexto_email}&{$email->contexto_email}[id]=".$email->id_contexto_email."'><button>Clique aqui para voltar a {$email->contexto_email}.</button></a>";
        log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", cancelou o <a href=\"?module=email&email[id]=$id\">Email nº ".$id."</a>","email");
    } else {
        echo "Houve um problema durante a execução da solicitação!";
    }
} elseif (strtolower($opcao)=="atualizar") {
	if (strtolower($acao)=="atualizar") {
        if (isset($icalc) && $icalc instanceof FSimpleICalendar) {
            @$arquivo = $icalc->gerarArquivo();
            if (is_string($arquivo)) {
                $emailAnexos = $email->getAnexos();
                $emailAnexos[] = $arquivo;
                $email->setAnexos($emailAnexos);
            }
        }
		if ($id=email::atualiza($email)) {
			log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", atualizou o <a href=\"?module=email&email[id]=$id\">Email nº ".$id."</a>","email");

			echo "<h2>Email atualizado com sucesso!</h2><br>";
			echo "<a href='?module=email&email[id]=".$email->id_email."'><button>Clique aqui para voltar ao Email.</button></a><br><br>";
                        echo "<a href='?module={$email->contexto_email}&{$email->contexto_email}[id]=".$email->id_contexto_email."'><button>Clique aqui para voltar a {$email->contexto_email}.</button></a>";

			js::foco();
		}
		else {
			echo "Houve um problema durante a execução da solicitação!";
		}
	}
	else {
            log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", visualizou o <a href=\"?module=email&email[id]=$email->id_email\">Email nº ".$email->id_email."</a>","email");
            include ("formulario.inc.php");

	}
}
else {
	include ("$opcao.php");
}
