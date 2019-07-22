<form id='envolvido' action='?module=envolvido&opcao=cadastrar_exclusao&noheader' method='POST'>

<?php
//SEM ACAO, mostra o formulario
if ($user['nivel']==6 || $user['nivel']==7) { $opcaoGeral="readonly"; $opcaoGeral2="disabled"; } // alteracao solicitada pelo Cap Todisco

echo "<input type='hidden' name='envolvido[id_envolvido]' value='".$envolvido->id_envolvido."'>";

if (!$acao) {
	//pre($envolvido);
	
	if ($envolvido->id_cd) { $proc="cd"; $cd=new cd("WHERE id_cd='".$envolvido->id_cd."'"); } 
	if ($envolvido->id_cj) { $proc="cj"; $cj=new cj("WHERE id_cj='".$envolvido->id_cj."'"); } 
	if ($envolvido->id_adl) { $proc="adl"; $adl=new adl("WHERE id_adl='".$envolvido->id_adl."'"); } 
	
	h1("Cadastro de exclus&atilde;o de policial militar");
	openTable("class='bordasimples' width='100%'");
			openTR();
				openTD();
				form::openLabel("Policial excluido");
					//Se nao tiver nome, eh pq foi excluido antes do Meta4
					if ($envolvido->nome=="") {
					echo "<select>";
					$sqlO="SELECT * FROM RHPARANA.posto ORDER BY id_posto";
					$resO=mysql_query($sqlO);
					while ($rowO=mysql_fetch_assoc($resO)) {
					echo "<option value='$rowO[posto]'>$rowO[posto]</option>";
					}
					echo "</select>";

					echo "<input size='40' type='text' name='envolvido[nome]'>";
					echo " - RG ".$envolvido->rg;
					}
					else {
					echo $envolvido->cargo." ".$envolvido->nome." RG $envolvido->rg";
					}
				form::closeLabel();
				closeTD();
				openTD();
					$opcoes=" onkeypress='return dntr(this,event)' size='4' maxlength='4' $opcaoGeral2";
					form::input("N&ordm; da portaria de exclus&atilde;o","envolvido[exclusaoportaria_numero]");
				closeTD();
			
				openTD();
					form::input("Data da portaria da exclusao","envolvido[exclusaoportaria_data]");
				closeTD();
					
				
				
			closeTR();
			openTR();
				openTD();
					form::openLabel("Publicado em Boletim");
					echo "<select name='envolvido[exclusaoboletim]'>";
						echo "<option value='BG'>BG</option>";
						echo "<option value='BR'>BR</option>";
					echo "</select>";

					echo " n&ordm;<input name='envolvido[exclusaobg_numero]' type='text' onkeypress='return dntr(this,event)' size='3' maxlength='3' $opcaoGeral2>";
					echo "/";
					echo "<input name='envolvido[exclusaobg_ano]' type='text' onkeypress='return dntr(this,event)' size='4' maxlength='4' $opcaoGeral2>";
					form::closeLabel();
				closeTD();
				openTD("colspan='1'");
					form::input("Data do BG","envolvido[exclusaobg_data]");
				closeTD();
			
				openTD();
					form::openLabel("OPM");
						echo "<select name='envolvido[exclusaoopm]' $opcaoGeral2>";
							include ("includes/option_opm.php");
						echo "</select>";
					form::closeLabel();
				closeTD();
			
			closeTR();
		
			
	closeTable();
	if (!$opcaoGeral2) echo "<input type='submit' name='acao' value='Gravar exclusao'>";
	formulario::values($envolvido,"envolvido");
}

//COM ACAO, ATUALIZA A TABELA ENVOLVIDO E RETORNA A TELA ANTERIOR
else {
	if (envolvido::atualiza($envolvido)) {
		h1("Exclus&atilde;o cadastrada com sucesso!");
		
		echo "<a onclick='retornarAtualizar(this)' href='#'>Clique aqui para voltar</a>";
	}
}

?>

</form>
