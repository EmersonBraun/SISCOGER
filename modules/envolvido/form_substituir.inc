<h1>Substituir envolvido</h1>
<form id='envolvido' action='?module=envolvido&opcao=substituir&noheader' method='post' onsubmit='return validaCampo();'>

<script language='javascript'>
	function validaCampo() {
		if (document.getElementById("nome").value=="") {
			window.alert("Aguarde o preenchimento automático do nome");
			return false;
		}
		return true;
	}
</script>

<input type='hidden' name=envolvido[id_envolvido]>
<input type='hidden' name=envolvido[id_ipm]>
<input type='hidden' name=envolvido[id_cj]>
<input type='hidden' name=envolvido[id_cd]>
<input type='hidden' name=envolvido[id_adl]>
<input type='hidden' name=envolvido[id_sindicancia]>
<input type='hidden' name=envolvido[id_fatd]>
<input type='hidden' name=envolvido[id_apfd]>
<input type='hidden' name=envolvido[id_iso]>
<input type='hidden' name=envolvido[id_it]>

<input type='hidden' name=envolvido[rg_substituto]>

<?

//INICIO tabela formulario
echo "<table class='bordacinza' width='100%'>";

form::openTR();
	form::openTD("width=25%");
		$opcoes=" readonly='true' size='12'";
		form::input("RG","envolvido[rg]");
	form::closeTD();
	form::openTD("width=75%");
		$opcoes=" readonly='true' size='40'";
		$textoForm = "<input type='text' size='10' readonly name='envolvido[cargo]'>";
		$textoForm.= "<input type='text' name='envolvido[nome]' readonly size='40' >";
		form::input("Nome","", $textoForm);
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='2' width='100%'");
		$opcoes="readonly size='12'";	
		form::input("Situação","envolvido[situacao]");
	form::closeTD();
form::closeTR();
	
form::openTR();
	form::openTD();
		$opcoes=" size='12' onblur=\"ajaxForm(this,'policial',Array('nome','cargo'));\"";
		form::input("RG substituto","substituto[rg]");
	form::closeTD();
	form::openTD();
		form::openLabel("Policial substituto");
			echo "<input type='text' readonly size=10 name='substituto[cargo]'>";
			echo "<input type='text' readonly size=40 name='substituto[nome]' id='nome'>";
		form::closeLabel();
	form::closeTD();
form::closeTR();

form::openTR(); form::openTD();
	echo "<input type='submit' name='acao' value='Substituir'>";
form::closeTD(); form::closeTR();


echo "</table>";
//FIM tabela formulario

echo "</form>";

formulario::values($envolvido);
