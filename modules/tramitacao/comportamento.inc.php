<?php
if ($user['nivel']==6 || $user['nivel']==7) { $opcaoGeral="readonly"; $opcaoGeral2="disabled"; } // alteracao solicitada pelo Cap Todisco

//Campos padrao para serem mostrados na lista
if (!$_REQUEST['mostrar']) {
	$_REQUEST['mostrar']=Array("ultimodia_data","classpunicao","gradacao","descricao_txt","opm_abreviatura");
}
//h3("EM TESTES NAO MEXA!");
//Tabela com as mudancas de comportamento
$sql1="SELECT * FROM comportamentopm 
	LEFT JOIN comportamento ON
		comportamento.id_comportamento=comportamentopm.id_comportamento
		WHERE rg='$rg' ORDER BY id_comportamentopm DESC";

//pre($sql);

if ($_SESSION['debug']) pre($sql1);
$res=mysql_query($sql1);

openTable("class='bordasimples' width='100%'");

	$informacao="Esta &eacute; a ficha disciplinar individual, destinada a cadastrar as puni&ccedil;&otilde;es e as classifica&ccedil;&otilde;es de comportamento, bem como eventuais cancelamentos de puni&ccedil;&atilde;o, em conformidade com o RDE.";

	openLine(5); h2("Ficha Disciplinar Individual (<a href='#lugarnenhum' title='$informacao'>?</a>) "); closeLine();

	if (mysql_num_rows($res)==0) {
		openLine(2);
			echo "Nao ha mudan&ccedil;as de comportamento para esse policial.";
		closeLine();
	}
	else {
		openTR("bgcolor='#E0E0E0'");
			echo "<td></td>";
			//echo "<td>Motivo</td>";
			//echo "<td>Publica&ccedil;&atilde;o</td>";
			//echo "<td>Comportamento</td>";
			//echo "<td class='noprint'>A&ccedil;&atilde;o</td>";
		closeTR();
	}

	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="#EEEEEE"):($cor="#FFFFFF");
		openTR("bgcolor='$cor'");
			echo "<td align='justify'><b>Data:</b>".data::inverte($row["data"])."<br>\r\n";
			echo "<b>Novo Comportamento:</b>$row[comportamento]<br>\r\n";
			//echo "<td>$row[opm_abreviatura]</td>";
			echo "<b>Sintese:</b> $row[motivo_txt]<br>\r\n";
			echo "<b>Publicacao:</b>$row[publicacao]<br><br>\r\n";
			closeTD();
			
			echo "<td class='noprint'>";
		if (!$opcaoGeral2) {
			link::popup("?module=comportamentopm&comportamentopm[id]=$row[id_comportamentopm]&noheader");
			echo "<img src='img/lapis.gif'>&nbsp;</a>";
			if ($user['nivel'] >=5 )
			echo "<a onclick='return Confirma();' href='?module=comportamentopm&opcao=apagar&acao=apagar&comportamentopm[id]=$row[id_comportamentopm]'><img border=0 src='img/delete.png'></a>";
		}
			
			echo "</td>";

		closeTR();
		$i++;
	}

closeTable();

openTable("class='bordasimples' width='100%' style='margin-top:4px;'");

openLine(10);
	h2("Elogios");
closeLine();

//query dos elogios
$sql2="SELECT * FROM elogio WHERE rg='".$rg."' ORDER BY elogio_data DESC";
if ($_SESSION['debug']) pre($sql2);
$res=mysql_query($sql2);
if (mysql_num_rows($res)) {
	//cabecalho
	openTR();
		echo "<td>Data</td>";
		echo "<td>OPM</td>";
		echo "<td colspan='3'>Descri&ccedil;&atilde;o</td>";
		echo "<td>A&ccedil;&atilde;o</td>";
	closeTR();

	$i=0;
	//imprime os elogios um a um
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="#EEEEEE"):($cor="#FFFFFF");
		openTR("bgcolor='$cor'");
			echo "<td>".data::inverte($row["elogio_data"])."</td>";
			echo "<td>$row[opm_abreviatura]</td>";
			echo "<td colspan='3'>$row[descricao_txt]</td>";

			echo "<td class='noprint'>";
			if (!$opcaoGeral2) {
			//BOTAO EXCLUIR
			if ($user['nivel'] >=2 )
			echo "<a onclick='return Confirma();' href='?module=elogio&opcao=apagar&acao=apagar&elogio[id]=$row[id_elogio]'><img border=0 src='img/delete.png'></a>";
			
			//BOTAO LAPIS
			link::popup("?module=elogio&opcao=atualizar&elogio[id]=$row[id_elogio]&noheader","800","600");
			echo "<img border='0' src='img/lapis.gif'></a>";
			echo "";			
			}
			echo "</td>\r\n";
		closeTR();
		$i++;
	}
}

//nao tem elogio
else {
	openLine(10);
		echo "N&atilde;o h&aacute; elogios para este policial.";
	closeLine();
}

closeTable();

//Tabela com as punicoes
$sql3="SELECT * FROM punicao 
	LEFT JOIN gradacao ON gradacao.id_gradacao=punicao.id_gradacao
	LEFT JOIN classpunicao ON classpunicao.id_classpunicao=punicao.id_classpunicao
	LEFT JOIN comportamento ON comportamento.id_comportamento = punicao.id_comportamento
	WHERE rg='$rg' ORDER BY ultimodia_data DESC, id_punicao DESC";
	
if ($_SESSION['debug']) pre($sql3);
$res=mysql_query($sql3);

//h3("Em testes, favor nao mexer");



/*$mostrar=$_REQUEST['mostrar'];
if ($_SESSION['debug']) pre($mostrar);
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
echo "</a>";*/

link::popup("?module=comportamentopm&rg=$rg&opcao=cadastrar&noheader",650,450);
echo "<input class='noprint' type='button' value='adicionar PUNI&Ccedil;&Atilde;O/mudanca COMPORTAMENTO'>";
echo "</a>";

link::popup("?module=elogio&rg=$rg&opcao=cadastrar&noheader",780,450);
echo "<input class='noprint' type='button' value='Adicionar Elogio'>";
echo "</a>";

echo "<br>";
echo "<b>Este documento n&atilde;o substitui a Certid&atilde;o das Varas Criminais Estaduais e Federais.</b><br>\r\n";
echo "<b>Certid&atilde;o emitida por ".$usuario->cargo." ".$usuario->nome.".</b>";

echo "<br><br><br><br><br>";
echo "<p align='right'>_______________________________________________</p>";

?>
