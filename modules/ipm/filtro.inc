<?php

include ("menu.inc");

if ($ipm->confronto_armado_bl=="S") $ipm->confronto_armado_bl="On";

//Campos padrao para serem mostrados na lista
if (!$_REQUEST['mostrar']) {
	$_REQUEST['mostrar']=Array("NRSJD","eproc","NROPM","sintese_txt");
}

echo "<form id='ipm' action='".$_SESSION['REQUEST_URI']."' method='POST'>";
echo "<table width='100%' class='bordasimples' style='border-top:0px;'>";


form::openTR();
	form::openTD("colspan='5'");
		?>
		<h2>Filtro
			<a href='#noplace' onclick="$('#linhafiltro').show(); $('#linhafiltro3').show();">+</a>
			<a href='#noplace' onclick="$('#linhafiltro').hide(); $('#linhafiltro3').hide();">-</a>
		
		<?php if ($opcao=="lista" or $opcao=="listar") { ?>
			&nbsp;&nbsp;&nbsp;Campos
			<a href='#noplace' onclick="$('#linhafiltro2').show();">+</a>
			<a href='#noplace' onclick='$("#linhafiltro2").hide()'>-</a>
		</h2>
		<?php }
	form::closeTD();
form::closeTR();

form::openTR("id='linhafiltro' style='display:none;'");
	form::openTD();
		form::openLabel("OPM");
			echo "<select name=ipm[cdopm_st]>";
			include ("includes/option_opm.php");
			echo "</select>";
		form::closeLabel();
	form::closeTD();
	form::openTD();
		form::openLabel("Data do fato");
			echo "De&nbsp; ";
			formulario::data("ipm","fato_data_ini");
			calendario::cria(1,"ipm","ipm[fato_data_ini]");
			echo "At&eacute;&nbsp; ";
			formulario::data("ipm","fato_data_fim");
			calendario::cria(2,"ipm","ipm[fato_data_fim]");
		form::closeLabel();
	form::closeTD();
	form::openTD();
		form::openLabel("Vitima (apenas Lesao Corporal e Homicidio)");
			?>
			<select name='ipm[vitima]'>
				<option value=''>Independe</option>
				<option value='Civil'>Civil</option>
				<option value='Policial Militar'>Policial Militar</option>
				<option value='Civil e Militar'>Civil e Militar</option>
			</select>
			<?php
		form::closeLabel();
	form::closeTD();
	closeTR();
	openTR("id='linhafiltro3' style='display:none;'");
		openTD();
			form::openLabel("Motivo");		
				echo "<select name='ipm[crime]'>";
					echo "<option value=''>Todos</option>";
					include ("includes/option_crime.html");
				echo "</select>";
			form::closeLabel();
		closeTD();
		openTD();
			form::openLabel("Confronto armado");
				echo "<select name='ipm[confronto_armado_bl_eq]'>";
					echo "<option value=''>Independe";
					if ($ipm->confronto_armado_bl_eq) echo "<option selected value='On'>Apenas com confronto";
					else echo "<option value='On'>Apenas com confronto";
				echo "</select>";
			form::closeLabel();
		closeTD();

		openTD();
			form::openLabel("Acao");
			echo "<input type='submit' value='Listar' name='$opcao'>";
			form::closeLabel();
		closeTD();
form::closeTR();

openTR("id='linhafiltro2' style='display:none;'");
		openTD("colspan='3'");
			form::openLabel("Campos a serem mostrados");
			
			//$vetor=Array();
			//$vetor[0]["nome"]="mostrar[]";
			
			//echo "<form action='' method='POST'>\r\n";
			
			$mostrar=$_REQUEST['mostrar'];

			echo checkbox("mostrar[]","NRSJD","N&ordm; sjd",$mostrar);
			echo checkbox("mostrar[]","NROPM","N&ordm; OPM",$mostrar);
			echo checkbox("mostrar[]","eproc","N&ordm; Eproc",$mostrar);
			echo checkbox("mostrar[]","sintese_txt","Sintese do fato",$mostrar);
			echo checkbox("mostrar[]","crime","Crime",$mostrar);
			echo checkbox("mostrar[]","crime_especificar","Esp. Crime",$mostrar);
			echo checkbox("mostrar[]","confronto_armado_bl","Conf. armado",$mostrar);
			echo checkbox("mostrar[]","DEFENSOR","Defensor",$mostrar);
			echo checkbox("mostrar[]","municipio","Municipio",$mostrar);
			echo checkbox("mostrar[]","andamento","Andamento",$mostrar);
			echo checkbox("mostrar[]","fato_data","Data Fato",$mostrar);
			echo checkbox("mostrar[]","andamentocoger","And. COGER",$mostrar);
			//echo checkbox("mostrar[]","comportamento","Comportamento",$mostrar);
			?>
			<br><input type='submit' name='noname' value='Atualizar'>	
			</form>
			<?php
			form::closeLabel();
		closeTD();

closeTR();

echo "</table>";
echo "</form>";

formulario::values($ipm);
?>
<br>
