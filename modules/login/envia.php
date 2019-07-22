<?php

session_start();
// Cria variáveis ************

error_reporting(E_ALL);

require("/var/www/sjd/classes/class.PHPMailer.php"); // envio de e-mail com autenticacao do provedor

$mail = new PHPMailer(); // envodo de email com autenticacao do provedor
$mail->SetLanguage("br", "/var/www/sjd/language/");
$mail->IsSMTP();

//Cria PHPmailer class
$mail->From = "kravetz@pm.pr.gov.br"; //email do remetente
$mail->FromName = "DDTQ"; //Nome de formatado do remetente
$mail->Host = "200.189.113.92"; //Pegando dados do alterar_esse_arquivo.php
$mail->Mailer = "smtp"; //Usando protocolo SMTP
$mail->AddAddress("kravetzpm@gmail.com"); //pegando dados do alterar_esse_arquivo.php
$mail->Subject = "Assunto";

//Assunto do email
$mail->Body = "Teste de envio de email. <br> Teste <b> Teste </b>"; //Body of the message assunto que veio do from.htm

//SMTP
$mail->SMTPAuth = true;
$mail->Username = "kravetz@pm.pr.gov.br"; 
$mail->Password = "KR975461";

//Verifica se email sera enviado
if(!$mail->Send())
{ //Checa erros no envo do email
echo "Ocorreram erros ao enviar email"; //Imprime mensagem de que email nào foi enviado
	echo $mail->ErrorInfo;
	print_r($mail->smtp->do_debug);
exit; 
}
else
{
echo "Sucesso.";
exit; 
}

?>
