<?php
if ($user['nivel']==6 || $user['nivel']==7) { $opcaoGeral="readonly"; $opcaoGeral2="disabled"; } // alteracao solicitada pelo Cap Todisco

//Campos padrao para serem mostrados na lista
if (!$_REQUEST['mostrar']) {
	$_REQUEST['mostrar']=Array("ultimodia_data","classpunicao","gradacao","descricao_txt","opm_abreviatura");
}

//Tabela com as punicoes
$sql="SELECT * FROM punicao 
	LEFT JOIN gradacao ON gradacao.id_gradacao=punicao.id_gradacao
	LEFT JOIN classpunicao ON classpunicao.id_classpunicao=punicao.id_classpunicao
	LEFT JOIN comportamento ON comportamento.id_comportamento = punicao.id_comportamento
	WHERE rg='$rg' ORDER BY ultimodia_data DESC, id_punicao DESC";
	
if ($_SESSION['debug']) pre($sql);
$res=mysql_query($sql);

//h3("Em testes, favor nao mexer");



$mostrar=$_REQUEST['mostrar'];
//pre($mostrar);
openTable("class='bordasimples' width='100%'");

	openLine(10);
	h1("Aten&ccedil;&atilde;o! Nos casos de cancelamento de puni&ccedil;&atilde;o, nunca apagar ou alterar as informa&ccedil;&otilde;es das puni&ccedil;&otilde;es, pois elas geram estat&iacute;sticas dentro do sistema de controle, e v&atilde;o ocasionar pend&ecirc;ncias no cadastro dos militares estaduais. Para classifica&ccedil;&atilde;o e reclassifica&ccedil;&atilde;o de comportamento, utilizar a Ficha Disciplinar Individual (FDI). D&uacute;vidas, contactar a COGER.","class='noprint'");
	closeLine(10);
	openLine(10); h2("Puni&ccedil;&otilde;es <a onclick='$(\"#linhaA\").show()' href='#lugarnenhum'>(+)</a>"); closeLine();
	openTR("id='linhaA' style='display:none;'");
		openTD("colspan='10'");
			form::openLabel("Campos a serem mostrados");
			
			//$vetor=Array();
			//$vetor[0]["nome"]="mostrar[]";
			
			echo "<form action='' method='POST'>\r\n";
			
			echo checkbox("mostrar[]","ultimodia_data","Data",$_REQUEST['mostrar']);
			echo checkbox("mostrar[]","classpunicao","Classifica&ccedil;&atilde;o",$_REQUEST['mostrar']);
			echo checkbox("mostrar[]","gradacao","Grada&ccedil;&atilde;o",$_REQUEST['mostrar']);
			echo checkbox("mostrar[]","descricao_txt","Descricao",$_REQUEST['mostrar']);
			echo checkbox("mostrar[]","opm_abreviatura","OPM",$_REQUEST['mostrar']);
			echo checkbox("mostrar[]","procedimento","Proc.",$_REQUEST['mostrar']);
			echo checkbox("mostrar[]","sjd_ref","N&ordm; Proc.",$_REQUEST['mostrar']);
			echo checkbox("mostrar[]","sjd_ref_ano","Ano Proc.",$_REQUEST['mostrar']);
			echo checkbox("mostrar[]","dias","Dias",$_REQUEST['mostrar']);
			echo checkbox("mostrar[]","comportamento","Comportamento",$_REQUEST['mostrar']);
			?>
			<br><input type='submit' name='noname' value='Atualizar'>	
			</form>
			<?php
			form::closeLabel();
		closeTD();
	closeTR();
	
	
	if (mysql_num_rows($res)==0) {
		openLine(2);
			echo "Nao ha punicoes para esse policial.";
		closeLine();
	}
	else {
		openTR("bgcolor='#E0E0E0'");
			foreach ($mostrar as $campo) {
				if     ($campo=="ultimodia_data") echo "<td>Data (Art. 63)</td>";
				elseif ($campo=="classpunicao") echo "<td>Classificacao</td>"; 
				elseif ($campo=="gradacao") echo "<td>Gradacao</td>"; 
				elseif ($campo=="descricao_txt") echo "<td>Descricao</td>"; 
				elseif ($campo=="opm_abreviatura") echo "<td>OPM</td>"; 
				elseif ($campo=="procedimento") echo "<td>Proc.</td>"; 
				elseif ($campo=="sjd_ref") echo "<td>N&ordm; COGER</td>"; 
				elseif ($campo=="sjd_ref_ano") echo "<td>ANO</td>";
				elseif ($campo=="dias") echo "<td>Dias</td>";
				elseif ($campo=="comportamento") echo "<td>Comportamento</td>";
				else echo "<td>$campo</td>";
			}
			echo "<td class='noprint'>A&ccedil;&atilde;o</td>";
		closeTR();
	}

	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="#EEEEEE"):($cor="#FFFFFF");
		openTR("bgcolor='$cor'");
		
			foreach ($mostrar as $campo) {
				echo "<td align='justify'>".udf($row[$campo],"$campo")."</td>";
			}
		
			echo "<td class='noprint'>";
		if (!$opcaoGeral2) {
			//BOTAO EXCLUIR
			if ($user['nivel'] >=2 )
			echo "<a onclick='return Confirma();' href='?module=punicao&opcao=apagar&acao=apagar&punicao[id]=$row[id_punicao]'><img border=0 src='img/delete.png'></a>";
			
			//BOTAO LAPIS
			link::popup("?module=punicao&opcao=atualizar&punicao[id]=$row[id_punicao]&noheader","800","600");
			echo "<img border='0' src='img/lapis.gif'></a>";
			
			echo "";			
		}
			echo "</td>\r\n";


		closeTR();
		$i++;
	}

closeTable();



link::popup("?module=punicao&rg=$rg&opcao=cadastrar&noheader",780,450);
echo "<input class='noprint' type='button' value='Adicionar Puni&ccedil;&atilde;o'>";
echo "</a>";


?>
