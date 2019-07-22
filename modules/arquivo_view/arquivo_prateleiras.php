<table class='noprint' class='bordasimples noprint' style='border-top:0px;'>
	<h1>Busca arquivo:
		<a href='#' onclick='$("#linhafiltro").show()'>+</a>&nbsp;
		<a href='#' onclick='$("#linhafiltro").hide()'>-</a>
	</h1> 
		<?php
		form::openTR("id='linhafiltro' style='display: none'");
			form::openTD();
				$textoForm="<select name=arquivo[procedimento] class='procedimento' $opcaoGeral2 >
					<option>ipm</option>
				    <option>sindicancia</option>
				    <option>cd</option>
				    <option>cj</option>
				    <option>apfdc</option>
				    <option>apfdm</option>
				    <option>fatd</option>
				    <option>iso</option>
				    <option>desercao</option>
				    <option>it</option>
				    <option>adl</option>
				    <option>pad</option>
				    <option>sai</option>
				    <option>proc_outros</option>
				</select>";
				form::input("Procedimento","",$textoForm);
			form::closeTD();
			form::openTD();
				$textoForm="<input name=arquivo[sjd_ref] class='ref' $opcaoGeral2 onblur='ajaxArquivo()''>";
				form::input("Numero","",$textoForm);
				//form::input("Numero", "arquivo[numero]");
			form::closeTD();
			form::openTD();
				$textoForm="<input name=arquivo[sjd_ref_ano] class='ano' $opcaoGeral2 onblur='ajaxArquivo()''>";
				form::input("Ano","",$textoForm);
			form::closeTD();
			form::openTD();
				$textoForm="<input id='proc' required $opcaoGeral2 >";
				form::input("Local","",$textoForm);
			form::closeTD();
		form::closeTR();
		 ?>
        <br>
</table>
<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// total de colunas
$stmt = $conn[1]->prepare("SELECT max(numero) as maxn FROM arquivo");
$stmt->execute();
$colunas = $stmt->fetch(PDO::FETCH_OBJ);
$colunas = $colunas->maxn;

// total de linhas
// $stmt = $conn[1]->prepare("SELECT max(letra) as maxl FROM arquivo");
// $stmt->execute();
// $linhas = $stmt->fetch(PDO::FETCH_OBJ);
// $linhas = $linhas->maxl;
// $linhas++;
$linhas = 'i';

h1("Prateleiras");
echo "<br>";

for ($i = 1; $i < $colunas; $i++) {

	openTable("class='bordasimples' width='100%'");

	echo "<center><h1>$i</h1><center>";
	$cont = 0;
	for ($j = 'a'; $j < $linhas; $j++) {

		$stmt2 = $conn[1]->prepare("SELECT * FROM arquivo WHERE local_atual='Arquivo COGER' AND numero ='".$i."' AND letra ='".$j."' ");
		$stmt2->execute();
		$arquivos = $stmt2->fetchAll(PDO::FETCH_OBJ);
		($cont%2)?($cor="#FFFFFF"):($cor="#F0F0F0");
		echo "<tr bgcolor='$cor'>";
		if($arquivos){

			foreach ($arquivos as $a) {
				$link = "?module=arquivo&opcao=atualizar&arquivo[id]=".$a->id_arquivo."&procedimento=".$a->procedimento."&ref=".$a->sjd_ref."&ano=".$a->sjd_ref_ano;
				echo "<td><a href='$link' target='_blank'><b> ".strtoupper($a->letra)."</b> ".$a->procedimento." ".$a->sjd_ref."/".$a->sjd_ref_ano."</a></td>";
				// echo "<td><b> ".strtoupper($a->letra)."</b> ".$a->procedimento." ".$a->sjd_ref."/".$a->sjd_ref_ano."</td>";

			}
			$link = "?module=arquivo_view&opcao=inserir&numero=$i&letra=$j";
			echo "<td><a class='btn btn-primary' href='$link'><b>".strtoupper($j)."</b> Cadastrar</a></td>";

		}else{
			$link = "?module=arquivo_view&opcao=inserir&numero=$i&letra=$j";
			echo "<td><a class='btn btn-primary' href='$link'><b>".strtoupper($j)."</b> Cadastrar</a></td>";

		}
		echo "</tr>";
		$cont++;
	}

	closeTable();
	echo "<br>";
}
// strtoupper($j)
?>
