<?
//$PPUsuario=$_REQUEST['usuario'];
$login=$usuario->rg;
$PPUsuario=$_REQUEST[PPUsuario];
mssql_select_db("passowrds",$con[3]);

if ($acao=="alterar") {
		$sql="UPDATE PPUsuarios SET UserEMail='".$PPUsuario[UserEMail]."', UserSenha='".$PPUsuario[UserSenha]."' WHERE UserLogin='".trim($login)."'";
		if (mssql_query($sql,$con[3])) {
			echo "<h2>Dados de usu�rio alterados com sucesso!</h2>";
		}
		else {
			echo "<h2>Houve um problema na execu��o da solicita��o!</h2>";
			echo "O sistema tentou executar: $sql <br>\r\n";
			echo "Por favor, copie essa mensagem e encaminhe-a ao Centro de Tecnologia da Informa��o para provid�ncias.";
		}
}
else {
		$sql="SELECT * FROM PPUsuarios WHERE UserLogin='$login'";
		$res=mssql_query($sql,$con[3]);
		$row=mssql_fetch_array($res);
		?>
		<center>
		<form onsubmit="return confirmaSenha();" name="usuario" action="?module=usuario&acao=alterar" method="POST">
		<table width="75%" class="bordasimples">
			<tr><TD colspan="2"><h1 align="center">Informa��es do usu�rio <?echo $login;?></h1></TD></tr>
			<TR>
				<TD>Nome:</TD><td><input readonly type="text" size="60" name="PPUsuario[UserNome]" value="<?echo $row['UserNome'];?>"></td>
			</tr>
			<tr>
				<TD>E-mail:</TD><td><input type="text" size="30" name="PPUsuario[UserEMail]" value="<?echo trim($row['UserEMail']);?>"></td>
				</tr>
			<tr><TD colspan="2"><h2>Troca de senha</h2></TD></tr>
			<tr>
				<TD>Senha:</TD><td><input type="password" size="15" id="senha1" name="PPUsuario[UserSenha]"></td>
			</tr>
			<tr>
				<TD>Confirme a senha:</TD><td><input type="password" size="15" name="PPUsuario[UserSenha]" id="senha2" onblur="confirmaSenha();">&nbsp;
			</TR>
			<tr><td>As senhas est�o iguais?</td><TD><div id="senhaOK"></div></td></TD></tr>
			<TR><TD colspan="2"><input type="submit" value="Atualizar"></TD></TR>
		</table>
		</table>
		</center>
		<?
}
?>