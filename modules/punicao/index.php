<?php

$punicao=new punicao();
$posto=$_REQUEST['posto'];

if ($_REQUEST['punicao']['id'] and !$opcao) $opcao="atualizar";

$punicao->setValues($_REQUEST['punicao']);
if ($_SESSION['debug']) { echo "<pre>";print_r($tramitacao); echo "</pre>"; }

if (strtolower($acao)=="cadastrar") $opcao="cadastrar";
if (strtolower($acao)=="atualizar") $opcao="atualizar";

if ($acao=="cadastrar" or $acao=="atualizar") {
	//Validacao do link da punicao com o envolvido punido
	//Liga as tabelas punicao e envolvido, cadastrando o campo id_fatd na tabela punicao
	
	//faz a validacao para 
	$proc=$punicao->procedimento;
		if ($punicao->procedimento!="" and $punicao->procedimento !="NA") {
		//Ve se a punicao ja nao foi cadastrada para aquele envolvimento
		$sql="SELECT envolvido.* FROM envolvido 
				INNER JOIN $proc ON
					$proc.id_$proc = envolvido.id_$proc 
			WHERE $proc.sjd_ref='".$punicao->sjd_ref."' AND $proc.sjd_ref_ano='".$punicao->sjd_ref_ano."'
			AND resultado='Punido' AND rg='".$punicao->rg."'";
		
		$res=mysql_query($sql);
		if ($_SESSION['debug']) pre($sql);
		
		
		if (mysql_num_rows($res)==0) {
			echo "<h3>O Policial ".$punicao->nome." n&atilde;o &eacute; o acusado do ".strtoupper($proc)." ".$punicao->sjd_ref."/".$punicao->sjd_ref_ano."</h3>";
			$acao="";
		}
		else {
			$row=mysql_fetch_assoc($res);
			$idEnvolvido=$row['id_envolvido'];
		}
	//die;	
	}
	
}



if (strtolower($opcao)=="cadastrar")  {
	if (strtolower($acao)=="cadastrar") {
		$opmPUNI=new opm(completaZeros($punicao->cdopm));
		$punicao->opm_abreviatura=$opmPUNI->abreviatura;
		
		$idPunicao=punicao::insere($punicao);
		
		$sql="UPDATE envolvido set id_punicao='$idPunicao' WHERE id_envolvido='$idEnvolvido' ";
		if ($_SESSION['debug']) pre($sql);
		mysql_query($sql);
		
		echo "<h2>Puni&ccedil;&atilde;o cadastrada com sucesso!</h2>";
		echo "<a id='foco' onclick='retornarAtualizar(this)' href='#'>Clique aqui para voltar.</a>";
	}
	else {
		include ("formulario.inc.php");
	}
}
elseif (strtolower($opcao)=="atualizar") {
	if (strtolower($acao)=="atualizar") {
		$opmPUNI=new opm(completaZeros($punicao->cdopm));
		$punicao->opm_abreviatura=$opmPUNI->abreviatura;
		
		if ($idPunicao=punicao::atualiza($punicao)) {
				$sql="UPDATE envolvido set id_punicao='$idPunicao' WHERE id_envolvido='$idEnvolvido' ";
			if ($_SESSION['debug']) pre($sql);
			mysql_query($sql);
			echo "<h2>Puni&ccedil;&atilde;o atualizada com sucesso!</h2>";
		echo "<a id='foco' onclick='retornarAtualizar(this)' href='#'>Clique aqui para voltar.</a>";
		}
		else {
			echo "Houve um problema durante a execução da solicitação!";
		}
	}
	else {
		//include ("menu.inc.php");
		include ("formulario.inc.php");
	}
}
elseif ($opcao=="lista" or $opcao=="listar") {
       include ("lista.inc.php");
}
elseif ($opcao=="apagar") {
	$proc=$punicao->procedimento;
	if (punicao::apaga($punicao)) {

		$$proc=new $proc("WHERE sjd_ref='".$punicao->sjd_ref."' AND sjd_ref_ano='".$punicao->sjd_ref_ano."'");
		
		$var="id_$proc";
		$sql="UPDATE envolvido
			SET id_punicao=''
			WHERE id_$proc = '".$$proc->$var."' AND rg='".$punicao->rg."'";
			//pre($sql);
			mysql_query($sql);
		
		echo "<h2>Puni&ccedil;&atilde;o apagada com sucesso!</h2>";
		echo "<a id='foco' href='?module=tramitacao&opcao=punicao&policial[rg]=".$punicao->rg."'>Clique aqui para voltar a ficha do policial.</a>";
	}
	else {
		echo "Houve um problema durante a execução da solicitação!";
	}
}
elseif ($opcao) {
	include ("$opcao.php");
}
?>
<script language='javascript'>document.getElementById('foco').focus()</script>

