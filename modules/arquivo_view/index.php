<?php 
$opcao=$_REQUEST['opcao'];
if ($opm_login->codigoBase==="") $opm_login->codigoBase="0";
//var_dump($opm_login->codigoBase);exit;
h1("Controle de arquivo de processos e procedimentos");
echo "<br>\r\n";
include("menu.php");

//if (!$opcao) $opcao="cadastrar";

if($opcao == 'inserir') {
	include("formulario.php");
} elseif($opcao == 'cadastrar'){
	//Definição de variáveis, incluindo pais e filhos
	$arquivo=new arquivo();
	$arquivo->setValues($_REQUEST['arquivo']);

	if (!$arquivo->insere($arquivo,"arquivo")) {
	    echo "<h2>Houve um erro ao cadastrar o arquivo!</h2>";
	    $link="?module=arquivo_view&opcao=inserir";
		echo "<a href='$link'>Clique aqui para voltar</a>";
	} else {

		//pre($arquivo);
		$id = 'id_'.$arquivo->procedimento;
		echo "<h2>arquivo inserido com sucesso</h2>";
		$link="?module=arquivo_view&opcao=inserir";
		echo "<a href='$link'>Clique aqui para voltar para inser&ccedil;&atilde;o</a><br><br>";

		$link="?module=arquivo_view&opcao=prateleiras";
		echo "<a href='$link'>Clique aqui para ir para prateleiras</a><br><br>";

		$link="?module=arquivo&arquivo[id_".$arquivo->procedimento."]=".$arquivo->$id."";
		echo "<a href='$link'>Clique aqui para ir para o procedimento</a>";
	}
	//pre($arquivo);exit;
} elseif ($opcao=="atualizar") {
	if (strtolower($acao)=="atualizar") {
		if ($id=arquivo::atualiza($arquivo)) {
			echo "<h2>Arquivo atualizado com sucesso!</h2>";
            echo "<a id='foco' href='?module=arquivo&opcao=prateleiras'><button>Clique aqui para voltar &agrave; lista.</button></a><br><br>";
            echo "<a href='?module=arquivo&arquivo[id]=".$arquivo->id_arquivo."'><button>Clique aqui para voltar ao Arquivo.</button></a>";
            js::foco();
		}
		else {
			echo "Houve um problema durante a execução da solicitação!";
		}
	}
	else {
		include ("frm_atualiza.inc.php");
	}
} else {
	include ("arquivo_$opcao.php");
}
die;
?>