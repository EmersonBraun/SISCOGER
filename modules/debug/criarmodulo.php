<?php

//Pega a variavel do request
$novomodulo=$_REQUEST['novomodulo'];
$nomelegivel=$_REQUEST['nomelegivel'];
$nomeplural=$_REQUEST['nomeplural'];

//Tratamento de erro, 
if ($acao=="criarmodulo") {
	//a pessoa mandou criar o modulo mas nao disse qual
	if (!$novomodulo) { h3("Digite o nome do novo modulo!"); $acao=""; }
	//o nome do modulo tem espacos
	if (strpos($novomodulo," ")) { h3("O nome do modulo tem espacos!"); $acao=""; }
	//nao informou o nome legivel
	if (!$nomelegivel) { h3("Digite o nome legível!"); $acao=""; }
}


//1 nao tem acao, mostra o formulario
if (!$acao) {

	h1("Criar novo modulo no sistema");
	?>

	<br>
	<form action='?module=debug&opcao=criarmodulo' method='POST'>
	Digite abaixo o nome do modulo a ser criado<br>
	Lembre-se de que o nome do modulo deve ser o mesmo nome da TABELA no banco de dados.<br>
	Nome do modulo. Ex: grupomaterial   <input type='text' name='novomodulo' type='text'><br>
	Nome legivel: Ex: Grupo de material <input type='text' name='nomelegivel' type='text'><br>
	Nome legivel no plural: Ex: Grupos <input type='text' name='nomeplural' type='text'><br>
	<br>
	
	<input type='submit' name='acao' value='criarmodulo'>
	</form>
	<br>
	
	<?php

}

//tem acao, cria o modulo novo
else {

	//Cria o diretorio
	if (mkdir("modules/$novomodulo")) {
		h1("Pasta modules/$novomodulo criada com sucesso!");
	}
	else h3 ("Nao foi possivel criar a pasta modules/$novomodulo. Verifique as permissões da pasta modules");


	//1 Criar os arquivos principais
	
	//1.1 Cria o arquivo index
	$file=fopen("modules/$novomodulo/index.php","w");
	$textoindex=file_get_contents("modules/debug/new_index.txt.php");
	//Faz as adaptacoes necessarias
	$textoindex=str_replace("novomodulo","$novomodulo",$textoindex);
	$textoindex=str_replace("nomelegivel","$nomelegivel",$textoindex);
	if (fwrite($file,$textoindex)) {
		h1("Arquivo index.php criado com sucesso!");
	}
	else h3("Nao foi possivel ciar o arquivo index.php!");
	fclose($file);
	
	//1.2 Cria o arquivo lista
	$file=fopen("modules/$novomodulo/lista.inc.php","w");
	$textoindex=file_get_contents("modules/debug/new_lista.txt.php");
	//Faz as adaptacoes necessarias
	$textoindex=str_replace("novomodulo","$novomodulo",$textoindex);
	$textoindex=str_replace("nomelegivel","$nomelegivel",$textoindex);
	$textoindex=str_replace("nomeplural","$nomeplural",$textoindex);
	if (fwrite($file,$textoindex)) {
		h1("Arquivo lista.inc.php criado com sucesso!");
	}
	else h3("Nao foi possivel ciar o arquivo menu.inc.php!");
	fclose($file);

	//1.3 Cria o arquivo menu
	$file=fopen("modules/$novomodulo/menu.inc.php","w");
	$textoindex=file_get_contents("modules/debug/new_menu.txt.php");
	//Faz as adaptacoes necessarias
	$textoindex=str_replace("novomodulo","$novomodulo",$textoindex);
	$textoindex=str_replace("nomelegivel","$nomelegivel",$textoindex);
	$textoindex=str_replace("nomeplural","$nomeplural",$textoindex);
	if (fwrite($file,$textoindex)) {
		h1("Arquivo menu.inc.php criado com sucesso!");
	}
	else h3("Nao foi possivel ciar o arquivo menu.inc.php!");
	fclose($file);
	
	//1.3 Cria o arquivo formulaio
	$file=fopen("modules/$novomodulo/formulario.inc.php","w");
	$textoindex=file_get_contents("modules/debug/new_formulario.txt.php");
	//Faz as adaptacoes necessarias
	$textoindex=str_replace("novomodulo","$novomodulo",$textoindex);
	$textoindex=str_replace("nomelegivel","$nomelegivel",$textoindex);
	$textoindex=str_replace("nomeplural","$nomeplural",$textoindex);
	if (fwrite($file,$textoindex)) {
		h1("Arquivo formulario.inc.php criado com sucesso!");
	}
	else h3("Nao foi possivel ciar o arquivo formulario.inc.php!");
	fclose($file);


}












?>
