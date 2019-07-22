<?
global $login,$login_unidade,$nivel;

$id_ipm=$_REQUEST['id_ipm'];
$id_proc_outros=$_REQUEST['id_proc_outros'];

$procedimento=$_REQUEST[procedimento];

$sobrestamento=new sobrestamento();
$sobrestamento->setvalues($_REQUEST[sobrestamento],"","simples");

if ($_SESSION[debug]) pre($sobrestamento);

if ($acao=="gravar") {
//---para atualizar o andamento para SOBRESTADO no formulário
$mov=$_REQUEST[sobrestamento];

if ($mov[id_cj]) { $procedimento="cj"; $idp=$mov[id_cj]; $andamento='14'; }
if ($mov[id_cd]) { $procedimento="cd"; $idp=$mov[id_cd]; $andamento='11';}
if ($mov[id_sindicancia]) { $procedimento="sindicancia"; $idp=$mov[id_sindicancia]; $andamento='8';}
if ($mov[id_fatd]) { $procedimento="fatd"; $idp=$mov[id_fatd]; $andamento='3';}
if ($mov[id_it]) { $procedimento="it"; $idp=$mov[id_it]; $andamento='23';}
if ($mov[id_adl]) { $procedimento="adl"; $idp=$mov[id_adl]; $andamento='17';}


$sql="UPDATE $procedimento SET $procedimento.id_andamento='$andamento' WHERE $procedimento.id_$procedimento='$idp'";
if ($_SESSION[debug]) pre($sql);
mysql_query($sql);
//---
	if (!$sobrestamento->insere($sobrestamento,"sobrestamento")) {
		echo "<h2>Houve um erro ao cadastrar o sobrestamento!</h2>";	
	}
}
if ($opcao=="atualizar") {
	if ($acao=="atualizar") {
	//---para atualizar o andamento para ANDAMENTO no formulário
	$mov=$_REQUEST[sobrestamento];

	if ($mov[id_cj]) { $procedimento="cj"; $idp=$mov[id_cj]; $andamento='12'; }
	if ($mov[id_cd]) { $procedimento="cd"; $idp=$mov[id_cd]; $andamento='9';}
	if ($mov[id_sindicancia]) { $procedimento="sindicancia"; $idp=$mov[id_sindicancia]; $andamento='6';}
	if ($mov[id_fatd]) { $procedimento="fatd"; $idp=$mov[id_fatd]; $andamento='1';}
	if ($mov[id_it]) { $procedimento="it"; $idp=$mov[id_it]; $andamento='21';}
	if ($mov[id_adl]) { $procedimento="adl"; $idp=$mov[id_adl]; $andamento='15';}


	$sql="UPDATE $procedimento SET $procedimento.id_andamento='$andamento' WHERE $procedimento.id_$procedimento='$idp'";
	if ($_SESSION[debug]) pre($sql);
	mysql_query($sql);
	//---
		if (sobrestamento::atualiza($sobrestamento)) {
			echo "<h2>sobrestamento atualizado com sucesso!</h2>";			
			$link="?module=sobrestamento&sobrestamento[id_$procedimento]=".$_REQUEST[sobrestamento]["id_$procedimento"];
			echo "<a href='$link'>Clique aqui para voltar</a>";
		}
	}
	elseif ($acao=="apagar") {
		sobrestamento::apaga($sobrestamento);
		echo "<h2>Sobrestamento apagado com sucesso</h2>";
		$link="?module=sobrestamento&sobrestamento[id_$procedimento]=".$_REQUEST[sobrestamento]["id_$procedimento"];
		echo "<a href='$link'>Clique aqui para voltar</a>";
		log::insere ("O usuario ".$usuario->rg." apagou um sobrestamento do procedimento $procedimento $idp ","sobrestamento");
		die;
	}
	else {
		include("frm_atualiza.inc");
	}
die;
}
	



$ano=$_SESSION[sjd_ano];

$mov=$_REQUEST[sobrestamento];

if ($mov[id_ipm]) { $procedimento="ipm"; $idp=$mov[id_ipm]; }
if ($mov[id_cj]) { $procedimento="cj"; $idp=$mov[id_cj]; }
if ($mov[id_cd]) { $procedimento="cd"; $idp=$mov[id_cd]; }
if ($mov[id_sindicancia]) { $procedimento="sindicancia"; $idp=$mov[id_sindicancia]; }
if ($mov[id_fatd]) { $procedimento="fatd"; $idp=$mov[id_fatd]; }
if ($mov[id_desercao]) { $procedimento="desercao"; $idp=$mov[id_desercao]; }
if ($mov[id_apfd]) { $procedimento="apfd"; $idp=$mov[id_apfd]; }
if ($mov[id_iso]) { $procedimento="iso"; $idp=$mov[id_iso]; }
if ($mov[id_it]) { $procedimento="it"; $idp=$mov[id_it]; }
if ($mov[id_adl]) { $procedimento="adl"; $idp=$mov[id_adl]; }
if ($mov[id_sai]) { $procedimento="sai"; $idp=$mov[id_sai]; }
if ($mov[id_proc_outros]) { $procedimento="proc_outros"; $idp=$mov[id_proc_outros]; }

$sql="SELECT * FROM $procedimento WHERE (id_$procedimento = '$idp') LIMIT 0,1";

$resultado=@mysql_query($sql);
$row=@mysql_fetch_array($resultado);

?>
<table cellpadding="0" cellspacing="0" width="100%" border="0"><tr><td colspan='2' bgcolor="white"><!-- #4682B4 -->
<?
include ("formulario.inc");
?>
