<form action="?module=debug" method="POST">
<table width="100%" class="bordasimples">
	<tr><TD colspan="2"><h2>Escolha a opção de Debug</h2></TD></tr>
	<TR><TD>Modo de testes</TD><td><input type="submit" name="opcao" value="Debug"></td></TR>
	<tr><TD>Classes utilizadas</TD><td><input type="submit" name="opcao" value="Classes"></td></tr>
	<tr><TD colspan="2"><h2>Modificar $_SESSION[user]</h2></TD></tr>
	<tr><TD>Nível:<input type="text" size="3" maxlength="3" name="user[nivel]"></TD><td><input type="submit" name="opcao" value="user"></td></tr>
	<tr><TD colspan="2"><h2>Modificar opm_login</h2></TD></tr>
	<TR><TD>Novo código: <input type="text" size="8" maxlength="8" name=opm_login></TD><td><input type="submit" name="opcao" value="opm_login"></td></TR>
	<tr><TD colspan="2"><h2>Getform</h2></TD></tr>
	<TR><TD>URL: <input type="text" size="40" name=formulario></TD><td><input type="submit" name="acao" value="getform"></td></TR>
</table>
</form>
