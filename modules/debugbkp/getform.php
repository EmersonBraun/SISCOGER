<?php
//error_reporting(E_ALL);

$formulario=$_REQUEST["formulario"]; //o caminho para o formulário que será transformado

if ($acao=="getform") {
	//if (file_exists($formulario)) {
	$sessao=curl_init();

	//Define a URL de consulta, com as informacoes do veiculo em GET
	$pagina=$formulario;

	//Define parametros curl para que o resultado possa ser lido em formato string
	curl_setopt($sessao, CURLOPT_URL, "$pagina");
	curl_setopt($sessao, CURLOPT_RETURNTRANSFER, true);

	$output=curl_exec($sessao);

	//Fecha a conexao com o DETRAN
	curl_close($sessao);

	//$arquivo=file_get_contents($formulario);
	$arquivo=$output;

	echo "<h1>Getform</h1>";
	echo "<h2>Capturando informações de $formulario</h2>";

	//Contagem dos inputs
	preg_match_all("/<input(.*)>/",$arquivo,$out);
	//pre($out);
	foreach ($out[0] as $input) {
		//Corta o texto ate o fim do select
		$posicao=strpos($input,">");
		$campos[]=substr($input, 0, $posicao);
	}
	//contagem dos Selects
	preg_match_all("/<select(.*)>/",$arquivo,$out);
	//pre($out);
	foreach ($out[0] as $input) {
		//Corta o texto ate o fim do select
		$posicao=strpos($input,">");
		$campos[]=substr($input, 0, $posicao);
	}
	//Contagem das textareas
	preg_match_all("/<textarea(.*)>/",$arquivo,$out);
	//pre($out);
	foreach ($out[0] as $input) {
		//Corta o texto ate o fim do select
		$posicao=strpos($input,">");
		$campos[]=substr($input, 0, $posicao);
	}
	//pega a informacao de cada campo e transforma em instrucao SQL
	$i=0;
	foreach ($campos as $campo) {
	$i++;
		unset($bancoDados); unset($tipo); unset($tamanho);

		$campo=str_replace("  "," ",$campo);
		$propriedades=explode(" ", $campo);

		//define o tipo da variavel
		if ($propriedades[0]=="<input") $tipo="VARCHAR";
		if ($propriedades[0]=="<select") $tipo="VARCHAR";
		if ($propriedades[0]=="<textarea") $tipo="TEXT";
		unset($propriedades[0]);

		//pega demais informacoes a partir das propriedades		
		foreach ($propriedades as $propriedade) {
			unset($nome); unset($pos);
			$pos=strpos($propriedade, "=");
			$nome=substr($propriedade, 0, $pos);
			
			unset($valor); unset($pos);
			$pos=strpos($propriedade, '"');
			if (!$pos) $pos=strpos($propriedade, "'");
			if (!$pos) $pos=strpos($propriedade, "=")+1;
			$valor=substr($propriedade, $pos);
			$valor=str_replace("\"","",$valor);
			$valor=str_replace("'","",$valor);
		
			//pre ($nome."=".$valor);
			
			if (strtolower($nome)=="name") { 
				//pre($nome."=".$valor);				
				$posColchete=strpos($valor, "[");
				if ($posColchete) $bancoDados=substr($valor,0,$posColchete);

				$posColchete=strpos($valor, "[");
				$coluna=substr($valor,$posColchete+1); $coluna=str_replace("]","",$coluna);

				if (substr($coluna,0,3)=="id_") {
					$tipo="BIGINT";
					if ($posColchete) $bancoDados=substr($valor,0,$posColchete);
					if (substr($coluna,3)==$bancoDados) 
						$tipo="BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY";
				}
				elseif (substr($coluna,-5)=="_data") {
					$tipo="DATE";
					if ($posColchete) $bancoDados=substr($valor,0,$posColchete);
				}
				else {
					$coluna=$coluna;
				}
			}
		
			if (strtolower($nome)=="maxlength") {
				$tamanho=$valor;
			}
			
		}
		//rodou todas as propriedades, define o comando
		if ($tipo) {
			if ($tipo=="VARCHAR" and !$tamanho) $tamanho="80";
			if ($tamanho) $tipo.=" ($tamanho) ";

			if (!strpos($tipo,"NOT NULL")) $tipo.=" NOT NULL ";
			$cmd="`".$coluna."` ".$tipo;
			$comando[$bancoDados][]=$cmd;
		}
		//debug
		//pre ($propriedades);
	}	
	if ($_SESSION[debug]) pre($comando);

	$chaves=array_keys($comando);
	foreach ($chaves as $chave) {
		$sql="CREATE TABLE `$chave` (<br>\r\n";
		$todosOsCampos=implode(" ,<br>\r\n", $comando[$chave]);
		$sql.=$todosOsCampos."<br>\r\n) ENGINE = MYISAM";		
		echo "SQL[$chave]=".$sql."<br>\r\n<br><br>";
	}
}
//acao != getform
else {
	echo "<h1>Getform</h1>";
	echo "<form action='?module=debug&opcao=getform' method='POST'>";
	form::openTable();
		form::openTR();
			form::openTD();
			form::input("Caminho para o formulário","formulario");
			form::closeTD();
			form::openTD();
				form::openLabel("Getform");
				echo "<input type='submit' name='acao' value='getform'>";
				form::closeLabel();
			form::closeTD();					

		form::closeTR();
	form::closeTable();
	echo "</form>";
}

?>
