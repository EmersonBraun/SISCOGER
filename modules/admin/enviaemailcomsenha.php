<?php
ini_set('display_errors', E_ALL);

//error_reporting(E_ALL);

$id=$_REQUEST['id'];

$sql="SELECT * FROM PPUsuarios WHERE UserID='$id'";
mssql_select_db("passowrds",$con[3]);
$res=mssql_query($sql, $con[3]);

$row=mssql_fetch_assoc($res);

if (!$row['UserEMail']) die ("<h3>Pessoa sem email cadstrado.</h3>");

$subject="Recuperacao de senha";

//Envia o email com a senha
$message="Prezado usu&aacute;rio<br>\r\n"
	."Seu login &eacute; seu RG (".trim($row['UserRG']).") e sua senha &eacute;:<br>\r\n"
	."<b>".$row['UserSenha']."</b><br>\r\n"
	."<br>Guarde-a com cuidado.<br>\r\n"
	."No sistema, &eacute; possivel a troca da senha por outra de sua escolha.<br>\r\n"
	."Atenciosamente,<br>\r\nAdministra&ccedil;&atilde;o.<br>\r\n"
	."URL do sistema: <a href='http://10.22.9.210/sjd'>http://10.22.9.210/sjd</a>";
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html;
	charset=iso-8859-1\r\n";
$headers .= "From: naoresponda@pm.pr.gov.br \r\n" .
	"Reply-To: naoresponda@pm.pr.gov.br \r\n" .
	"X-Mailer: PHP/" . phpversion();
$to=$row['UserEMail'];
echo "<h2>Enviando email para: $to</h2>";

if (mail($to, $subject, $message, $headers)) {
	echo "<h2>Email enviado com sucesso!</h2>";
}
else {
	echo "<h3>N&atilde;o foi poss&iacute;vel enviar o email!</h3>";
}

echo "<a href='?module=admin&opcao=lista'>Clique aqui para voltar à lista de usuários.</a>";
?>
