<?

if (!$opcao) $opcao="cadastrar";


if ($opcao=="cadastrar") {
	if ($acao=="concordo") {

		$termocompromisso=new termocompromisso();
		$termocompromisso->setValues($_REQUEST['termocompromisso']);

		$policial=new policial($termocompromisso->rg);
		$termocompromisso->opm=$policial->opm->abreviatura;

		$termocompromisso->ip=$_SERVER['REMOTE_ADDR'];
		$termocompromisso->datahora=date("d/m/Y H:i");
		$termocompromisso->concorda_bl="On";
		enviaEmailComObjeto($termocompromisso, "coger-adm@pm.pr.gov.br","Termo de compromisso");

		echo "<h2>Termo de compromisso preenchido com sucesso!</h2>";
		termocompromisso::insere($termocompromisso);
	}
	elseif ($acao=="não concordo") {
		valida::logout();
	}
	else {
		echo "<table class='bordasimples'>";
		echo "<tr><td>";
			echo "<h1 align='center'>POL&Iacute;CIA MILITAR DO PARAN&Aacute;</h1>";
		echo "<h1 align='center'>TERMO DE RESPONSABILIDADE DE USU&Aacute;RIO DO SISTEMA DE CONTROLE PROCESSUAL DA SE&Ccedil;&Atilde;O DE JUSTI&Ccedil;A E DISCIPLINA - DIRETORIA DE PESSOAL</h1>";

		echo "</td></tr>";
		echo "<tr><td class='padded' bgcolor='white'>";
			include("termodecompromisso.html");
		echo "</td></tr>";
	}
}


//Falta filtrar com PPUsuarios
if ($opcao=="lista") {
	$sql="SELECT * FROM termocompromisso";
	
	if (!$order) $order="datahora DESC";
	include("/var/www/matrix/includes/filtro.php");

	mysql_select_db("sjd",$con[8]);
	$res=mysql_query($sql, $con[8]);

	
	openTable(" style='border: 1px solid #A0A0A0;' ");
		openLine(10);
		h1("Termos de compromisso");
		closeLine();

		openTR("class='header2'");
			echo lista::td("Nome","nome");
			echo "<td>Email</td>";
			echo "<td>Expresso</td>";
			echo "<td>Telefone</td>";
			echo "<td>Celular</td>";
			echo "<td>OPM</td>";
			echo lista::td("Data","datahora");
		closeTR();

	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="white"):($cor="#E0E0E0");
		openTR("bgcolor='$cor'");
			echo "<td>$row[nome]</td>";
			echo "<td>$row[email]</td>";
			echo "<td>$row[UserExpresso]</td>";
			echo "<td>$row[telefone]</td>";
			echo "<td>$row[celular]</td>";
			echo "<td>$row[opm]</td>";
			echo "<td>".udf($row["datahora"], "datahora")."</td>";
		closeTR();
	$i++;
	}

	closeTable();

}


?>
