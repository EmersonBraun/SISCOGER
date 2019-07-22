<script language="JavaScript">
function atualiza_usermail(campo,ipm){
    var relato=campo.value
    campo.value='....ATUALIZANDO.....'           
    xmlhttp.open("GET", "ajax/ajax.admin.php?ajax_UserMail="+relato+"&UserID="+ipm,true);
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4){
            var texto=xmlhttp.responseText
	    campo.value=texto
        }
	}
    xmlhttp.send(null)
}

function atualiza_usernivel(campo,userid){
    var usernivel=campo.value
    campo.value='....ATUALIZANDO.....'           
    xmlhttp.open("GET", "ajax/ajax.admin.php?ajax_UserNivel="+usernivel+"&UserID="+userid+"&GrupoID=<?=ID_SISTEMA;?>",true);
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4){
            var texto=xmlhttp.responseText
	    campo.value=texto
        }
	}
    xmlhttp.send(null)
}
</script>

<?
$order=$_REQUEST[order];
if (!$order) $order="nome";

mssql_select_db("passowrds",$con[3]);

$sql="SELECT DISTINCT
PPUsuarios.UserNome AS nome, PPUsuarios.UserRG AS rg, PPUsuarios.UserLogin AS login, UserEMail as email, opm.ABREVIATURA as 
unidade, PPUsuarios.UserID as UserID, PPUsuarioGrupo.direitos as nivel, rh.STD_ID_JOB_CODE AS posto, opmT.ABREVIATURA
as opmtrabalho
FROM PPUsuarios
LEFT OUTER JOIN PPUsuarioGrupo ON
	PPUsuarioGrupo.UserID = PPUsuarios.UserID
LEFT OUTER JOIN RHPARANA2.dbo.opmPMPR AS opm ON
	opm.CODIGO = PPUsuarios.UserOPM
LEFT OUTER JOIN RHPARANA2.dbo.EFETIVO_PMPR AS rh ON
   rh.CBR_NUM_RG = PPUsuarios.UserRG
LEFT JOIN RHPARANA2.dbo.opmPMPR AS opmT ON
opmT.CODIGO = PPUsuarios.opm_trabalho
WHERE PPUsuarioGrupo.GrupoID='".ID_SISTEMA."'
ORDER BY $order
";
if ($_SESSION[debug]) echo $sql;
$res=mssql_query($sql,$con[3]);
?>

		<!-- Content -->
		<table cellpadding="0" class='bordacinza'>

<center>
<h2>Lista de Usuários</h2>
<form>
<table align="center" class='bordacinza'>
<tr bgcolor=silver>
	<td>Cargo</td>
	<TD>Nome</TD>
	<td>RG/Login</td>
	<td>Email</td>
	<td><a href='?module=admin&opcao=lista&order=unidade'>Unidade</a></td>
	<td><a href='?module=admin&opcao=lista&order=unidade'>Trabalho</a></td>
	<td>N&iacute;vel</td>
	<TD width='56px'>Op&ccedil;&otilde;es</TD>
</tr>

<?php

$i=0;
while ($row=mssql_fetch_array($res)){
	($i%2==0)?($cor='white'):($cor='#EEEEEE');
	
	echo "<tr bgcolor='$cor'>";
	echo "<td bgcolor='$cor'>".$row[posto]."</td>"
	   ."<td bgcolor='$cor'>".$row['nome']."</td>"
		."<td bgcolor='$cor'><a href='http://10.47.1.8/pm/mostrapm.php?rg=".$row['rg']."' target='_blank'>".$row['rg']."</a></td>"
		."<td bgcolor='$cor'><input type=text size=20 id=UserMail name=UserMail value='".trim($row['email'])."' onblur=\"atualiza_usermail(this,'".$row['UserID']."')\"></td>"
		."<td bgcolor='$cor'>".$row['unidade']."</td>";
		echo "<td>$row[opmtrabalho]</td>";
		echo "<td bgcolor='$cor'><input type=text size=1 id=UserNivel name=UserNivel value='".trim($row['nivel'])."' onblur=\"atualiza_usernivel(this,'".$row['UserID']."')\"></td>";
		echo "<td width='100px'>";
		
		echo "<a title='Editar' href='?module=admin&opcao=editar&id=$row[UserID]'><img src='img/lapis.gif'></a>&nbsp;";
		
		echo "<a onclick='return confirm(\"Apagar usuario?\");' title='Deletar usuário' href=\"index.php?module=admin&opcao=deletar&UserID=".$row['UserID']."\"><img border=0  src=img/delete.png></a>&nbsp;"
		."<a title='Enviar email com senha' href='?module=admin&opcao=enviaemailcomsenha&id=$row[UserID]'><img border='0' src='img/email_ico2.gif'></a>&nbsp;"
		."<a title='Conectar como esse usuario' href='?module=admin&opcao=urlconexao&id=$row[UserID]'>"
		."<img border='0' src='img/login.png'></a>"
		."</td>"
		."</tr>";
		echo "</td>";
	echo "</tr>\n";
$i++;
}	
?>
</table>
<!--<input type=submit value='Inserir'>-->
</form>

<??>
