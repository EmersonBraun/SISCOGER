<?

if ($acao=="substituir") {
	$substituto=new envolvido();
	$substituto->setValues($_REQUEST[substituto]);
	$substituto->situacao=$envolvido->situacao;

		$substituto->id_ipm=$envolvido->id_ipm;
		$substituto->id_cj=$envolvido->id_cj;
		$substituto->id_cd=$envolvido->id_cd;
		$substituto->id_adl=$envolvido->id_adl;
		$substituto->id_sindicancia=$envolvido->id_sindicancia;
		$substituto->id_fatd=$envolvido->id_fatd;
		$substituto->id_apfd=$envolvido->id_apfd;
		$substituto->id_iso=$envolvido->id_iso;
		$substituto->id_it=$envolvido->id_it;

	$envolvido->rg_substituto=$substituto->rg;

//	pre($substituto);
//	pre($envolvido);
//	die;

	if (envolvido::insere($substituto)) {
		echo "<h2>Substituto Cadastrado com sucesso!</h2><br>";
		if (envolvido::atualiza($envolvido)) {
			echo "<h2>Envolvido Atualizado com sucesso</h2><br>";
			
			if ($_SESSION[debug]) echo "<small>Criando movimento...</small><br>\r\n";
			$mov[descricao]="Substituição do(a) ".$envolvido->cargo." ".$envolvido->nome." pelo(a) ".$substituto->cargo." ".$substituto->nome.", na função de ".$envolvido->situacao;
			$mov[data]=Date("d/m/Y");
			$mov[rg]=$_SESSION[usuario]->rg;
			$mov[id_ipm]=$envolvido->id_ipm;			
			$mov[id_cj]=$envolvido->id_cj;
			$mov[id_cd]=$envolvido->id_cd;
			$mov[id_adl]=$envolvido->id_adl;
			$mov[id_sindicancia]=$envolvido->id_sindicancia;
			$mov[id_fatd]=$envolvido->id_fatd;
			$mov[id_apfd]=$envolvido->id_apfd;
			$mov[id_iso]=$envolvido->id_iso;
			$mov[id_it]=$envolvido->id_it;

			$movimento=new movimento();
			$movimento->setValues($mov,"","simples");

			if (movimento::insere($movimento)) {
				echo "<h2>Movimento cadastrado com sucesso!</h2>";
			}
		}
		else echo "Erro!";
	}
	else {
		echo "<h2>Erro ao cadastrar substituto!</h2>";
	}
echo "<br>";
echo "<input type='button' value='Retornar' onclick='javascript: retornarAtualizar(this);'>";
}
else {
	include ("form_substituir.inc");
}

?>
