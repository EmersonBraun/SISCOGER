<?

?>

<table cellpadding="0" cellspacing="1" border="0" width="100%">
<center>
<h2>Inserir usuário</h2>
<form name="novoUsuario" action="?module=admin&acao=new_user" method=post>
<table align="center">

<tr>
	<td>RG/Login:</td><td><input type=text size=20 name=policial[rg] onblur="ajaxForm(this,'policial',Array('nome'))"></td>
</tr>
<td>Nome:<br>Login:</td>
<td>
<input type=text size=30 readonly name=policial[nome]><br>
</td>	
</tr><tr>
<!--<tr>
	<td>Unidade</td>
	<td bgcolor='#EEEEE'>
	<div id='opm_nome'><? echo batalhao($opm_sigla);?></div>
	</td>
<tr>-->
<td>Nível:</td><td><input type=text size='4' name=novo_nivel></td></tr>

</table>
<input type=submit value='Inserir'>
</form>

<??>