<?
//Core
if ($_REQUEST['cd']['id']) $opcao="atualizar";
if (!$opcao) $opcao="cadastrar";

//Definição de variáveis, incluindo pais e filhos
$cd=new cd();
$cd->setValues($_REQUEST['cd']);

if (!$cd->ac_desempenho_bl) $cd->ac_desempenho_bl="";
if (!$cd->ac_conduta_bl) $cd->ac_conduta_bl="";
if (!$cd->ac_honra_bl) $cd->ac_honra_bl="";


$vetorEnvolvidos=$_REQUEST['envolvido'];
if ($vetorEnvolvidos) {
	$i=0;
	foreach ($vetorEnvolvidos as $elemento) {
		$cd->envolvido[$i]=new envolvido();
		$cd->envolvido[$i]->setValues($elemento,"","simples");
	$i++;
	}
}

$vetorOfendidos=$_REQUEST['ofendido'];
if ($vetorOfendidos) {
	$i=0;
	foreach ($vetorOfendidos as $elemento) {
		$cd->ofendido[$i]=new ofendido();
		$cd->ofendido[$i]->setValues($elemento,"","simples");
	$i++;
	}
}
//Captura ligacoes
$vetorLigacao=$_REQUEST['ligacao'];
if ($vetorLigacao) {
	$i=0;
	foreach ($vetorLigacao as $elemento) {
		$cd->ligacao[$i]=new ligacao();
		$cd->ligacao[$i]->setValues($elemento,"","simples");
		$cd->ligacao[$i]->destino_proc="cd";
		$cd->ligacao[$i]->destino_sjd_ref=$cd->sjd_ref;
		$cd->ligacao[$i]->destino_sjd_ref_ano=$cd->sjd_ref_ano;
	$i++;
	}
}

//Fim definição de variáveis.

//Debug
if ($_SESSION['debug']) { pre($cd); }

if (strtolower($opcao)=="cadastrar")  {
	if (strtolower($acao)=="cadastrar") {
		$cd->cdopm="0";
		if (!$cd->sjd_ref) {
			$sql="SELECT MAX(sjd_ref) AS ultimo FROM cd WHERE sjd_ref_ano='".$cd->sjd_ref_ano."'";
			if ($_SESSION[debug]) echo "$sql<br>\r\n";
			$row=mysql_fetch_array(mysql_query($sql));
			$cd->sjd_ref=($row[ultimo]+1);
			
		}
				
		$id=cd::insere($cd);
		log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", inseriu o <a href=\"?module=cd&cd[id]=$id\">cd nº ".$cd->sjd_ref."/".$_SESSION[sjd_ano]."</a>","cd");
		echo "<h2>Conselho de Disciplina cadastrado com sucesso!</h2>";
		echo "<a href='?module=cd&opcao=lista'>Clique aqui para voltar.</a>";
	}
	else {
		include ("formulario.inc.php");
	}
}
elseif (strtolower($opcao)=="atualizar") {
	$cd->cdopm="0";
	if (strtolower($acao)=="atualizar") {
		if ($id=cd::atualiza($cd)) {
                        log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", atualizou o <a href=\"?module=cd&cd[id]=$id\">cd nº ".$cd->sjd_ref."/".$_SESSION[sjd_ano]."</a>","cd");

			echo "<h2>Conselho de Disciplina atualizado com sucesso!</h2>";
			//echo "<a href='?module=cd&opcao=lista'>Clique aqui para voltar.</a>";
                        echo "<a id='foco' href='?module=cd&opcao=lista'><button>Clique aqui para voltar &agrave; lista.</button></a><br><br>";
                        echo "<a href='?module=cd&cd[id]=".$cd->id_cd."'><button>Clique aqui para voltar ao Conselho.</button></a>";
                        js::foco();


		}
		else {
			echo "Houve um problema durante a execução da solicitação!";
		}
	}
	else {
		if($cd->id_cd){
		        log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", visualizou o <a href=\"?module=cd&cd[id]=$cd->id_cd\">cd nº ".$cd->sjd_ref."/".$_SESSION[sjd_ano]."</a>","cd");
			include ("formulario.inc.php");
		}
	}
}
elseif ($opcao=="lista" or $opcao=="listar") {
       include ("menu.inc");
       include ("lista.inc");
}
elseif ($opcao=="apagar") {
	if ($acao=="apagar") {
		if (cd::apaga($cd)) {
			echo "<h2>Conselho de Disciplina apagado com sucesso!</h2>";
			echo "<a href='?module=cd&opcao=lista'>Clique aqui para voltar à lista</a>";
			log::insere("O(a) ".$usuario->cargo." ".$usuario->quadro." ".$usuario->nome.", da unidade ".$usuario->opm->abreviatura.", apagou o cd nº ".$cd->sjd_ref."/".$_SESSION[sjd_ano]."</a>","cd");
		}
		else {
			echo "Houve um problema durante a execução da solicitação!";
		}
	}
	else {
		echo "<h1>Deseja realmente apagar o CD n&ordm; ".$cd->sjd_ref."?</h1>";
		echo "<form name='cd'><input type=hidden name=cd[id_cd] value='".$cd->id_cd."'><input 
type=submit name='acao' value='Apagar'></form>";
	}
}
elseif ($opcao=="buscar") {
	include ("filtro.inc");
	include ("lista.inc");
}
else {
	include ("menu.inc");
	include ("$opcao.php");
}

?>
