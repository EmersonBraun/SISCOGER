<script language='javascript'>
function selectAll() { document.getElementById('selectAll').select(); }
</script>

<?php

$id=$_REQUEST['id'];

$sql="SELECT * FROM PPUsuarios WHERE UserID='$id'";
$res=mssql_query($sql, $con[3]);
$row=mssql_fetch_assoc($res);

echo "<h1>URL de conexao: </h1>";
$url=URL_SISTEMA."/?user[UserLogin]=".trim($row['UserRG'])."&bfl&opcao=login";

echo "<input id='selectAll' onclick='selectAll();' type='text' size='80' readonly value='$url'><br><br>\r\n";

echo "<b>Obs:</b>Voce devera fazer logoff do usuario atual para poder usar essa URL de conexao.";


?>
