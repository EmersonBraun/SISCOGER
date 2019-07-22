<?
if ($opcao=="logout"){
	if (valida::logout()) echo "<h2>Até a próxima</h2>";
	die;
}
elseif ($opcao=="login") {
	$user=$_REQUEST['user'];
	if (valida::login($user)) echo "<h2>Seja bem-vindo</h2>";
        echo "<a id='foco' href='index.php'>Entrar r&aacute;pido (ENTER)</a>";
        echo "<script>document.getElementById('foco').focus();</script>";
	die;
}
//Melhorar -> passar tudo isso pro módulo de login.
elseif ($opcao=="esqueci minha senha") {
	$user=$_REQUEST[user];
	if (!$user[UserLogin]) {
		echo "<font color='red'>Preencha o seu login para recuperar sua senha</font>";
	}
	else {
		$sql="SELECT * FROM PPUsuarios WHERE UserLogin='".$user[UserLogin]."'";
		if ($_SESSION[debug]) echo $sql;
		$res=@mssql_query($sql,$con[3]);
		if ($res) $row=@mssql_fetch_assoc($res);
		if ($row[UserEMail]) {
			$headers ="MIME-Version: 1.0\r\n";
			$headers.="Content-type: text/html; charset=utf-8\r\n";
			$headers.="From: coger-adm@pm.pr.gov.br\r\n";
			$headers.="Reply-To: coger-adm@pm.pr.gov.br\r\n";
			$headers.="X-Mailer: PHP/".phpversion();

			$texto="Sua senha &eacute; ".$row[UserSenha]."<br>\r\n"
				."<a href='http://10.47.1.8/sjd'>Clique aqui para acessar o sistema</a>";
			mail($row[UserEMail],"Sistema: ".NOME_SISTEMA, $texto, $headers);
			echo "<h2>Foi enviado um e-mail para $row[UserEMail] com a sua senha!</h2>";
		}
		else {
			echo "<font color='red'>Você não tem e-mail cadastrado junto ao CTI!</font>";
		}
	}
}
else {
   echo "<center>";
   ?>
   <h1><?=NOME_SISTEMA;?></h1>
   
   <?php 
   
   //include ("index.html"); die;
   ?>
   
   <div class='login'>
   <form action='index.php' method=post>
   <input type='hidden' name='refresh[url]' value="index.php">
	<br>
   
   <table style='border: 1px solid #F0F0F0; margin-bottom:4px;' border=0>
   <tr>
   
   
   <td><span class='branco'>Login:</span></td><td><input id='foco' type=text size=15 name=user[UserLogin]></td></tr>
   <tr>
   <td><span class='branco'>Senha:</span></td><td><input type=password size=15 name=user[UserSenha]></td></tr>
   <td><span class='branco'>Imagem:</span></td><td><input type=text size=15 name=captcha></td></tr>
   <td><span class='branco'>Validação</span></td><td align='center'><img src='../lib/captcha/CaptchaSecurityImages.php?characters=4'></td>
   </tr>
   </table>
   <input type=submit name='opcao' value='login'><br><br>
   <input type=submit name='opcao' value='Esqueci minha senha'>
   </form>
	<br>

	
<p class='branco'>N&atilde;o tem acesso ao sistema?<br> Solicite sua senha junto &agrave; Corregedoria-Geral</p>
<p class='branco'>Email: coger-adm@pm.pr.gov.br</p>
<br>
   </div>
	<script language='javascript'>document.getElementById('foco').focus();</script>
   <? echo "\r\n\r\n<".$_SESSION["security_code"].">";
}
?>
