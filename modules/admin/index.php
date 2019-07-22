<?
if ($opcao=="lista") {
	include ("form_lista_user.php");
}
elseif ($opcao=="modificar") {
	include ("form_muda_user.php");
}
elseif ($opcao=="new_user") {
	if ($acao=="new_user") {
		$newUser=$_REQUEST[policial];
		if ($_SESSION[debug]) echo "Descobrindo ID de $newUser[rg]<br>\r\n";
		$userid=get_userid_by_rg($newUser[rg]);
		if (!$userid) { echo "<h2>Não foi encontrado usuário com esse RG!</h2>"; die; }
		mssql_select_db("passowrds",$con[3]);
		$sql="SELECT * FROM  PPUsuarioGrupo WHERE UserID='$userid' AND GrupoID= '".ID_SISTEMA."'";
		if ($_SESSION[debug]) echo $sql;
		$res=@mssql_query($sql,$con[3]);
		$row=@mssql_fetch_array($res);
		if ($row['UserID']!="") {
			echo "<h2>Usuário já está inserido!</h2></td>";
		}
		else {
			$novo_nivel=$_POST['novo_nivel'];
	
			mssql_query("INSERT INTO PPUsuarioGrupo ( UserID , GrupoID ,direitos) VALUES ('$userid', 
'".ID_SISTEMA."', '$novo_nivel')", $con[3]);
			echo "<h2>Usuário inserido com sucesso!</h2>";
		}
	}
}
elseif ($opcao=="deletar") {
	$UserID=$_REQUEST['UserID'];
	$sql="DELETE FROM PPUsuarioGrupo WHERE UserID='$UserID' AND GrupoID='".ID_SISTEMA."'";
	if ($_SESSION[debug]) echo $sql;
	mssql_query($sql,$con[3]);
	echo "<h2>Usuário  ".get_name_by_id($UserID)." removido do Sistema <i>".NOME_SISTEMA."</i> com sucesso!</h2>";
	echo "<a href='?module=admin&opcao=lista'>Clique aqui para voltar à lista</a>";
}
elseif ($opcao=="logacessos") {
	include ("logacessos.php");
}
elseif ($opcao=="enviaemailcomsenha") {
	include ("enviaemailcomsenha.php");
}
elseif ($opcao=="urlconexao") {
	include ("urlconexao.php");
}
elseif ($opcao=="editar") {
	include ("editar.php");
}
else {
	include ("form_new_user.php");
}
?>

