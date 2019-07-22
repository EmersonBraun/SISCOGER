<?php

require ("menu.inc.php");

//Campos padrao para serem mostrados na lista
if (!isset($_REQUEST['mostrar'])) {
    $_REQUEST['mostrar']=Array("id_localdeapresentacao","localdeapresentacao","municipio");
}

$sessionuri = isset($_SESSION['REQUEST_URI']) ? $_SESSION['REQUEST_URI'] : '';

echo "<form id='localdeapresentacao' action='".$sessionuri."' method='POST'>";
echo "<table width='100%' class='bordasimples' style='border-top:0px;'>";


form::openTR();
    form::openTD("colspan='5'");
        ?>
        <h2>Filtro
            <a href='#noplace' onclick="$('#linhafiltro').show(); $('#linhafiltro3').show();">+</a>
            <a href='#noplace' onclick="$('#linhafiltro').hide(); $('#linhafiltro3').hide();">-</a>
        </h2>
         <?php
    form::closeTD();
form::closeTR();
form::openTR("id='linhafiltro' style='display:none;'");
    form::openTD();
        form::openLabel("Nome");
            echo "<input name='filtro[localdeapresentacao]' type='text' size='20' maxlenght='100' value='$localdeapresentacao->localdeapresentacao'>\r\n";
        form::closeLabel();
    form::closeTD();
    form::openTD();
        form::openLabel("Munic&iacute;pio");
            echo "<select name='filtro[id_municipio]''>";
            include ("includes/option_municipios.php");
            echo "</select>";
        form::closeLabel();
    form::closeTD();
    openTD();
        form::openLabel("Acao");
        echo "<input type='submit' value='Listar' name='$opcao'>";
        form::closeLabel();
    closeTD();
form::closeTR();


echo "</table>";
echo "</form>";

formulario::values($localdeapresentacao);
?>
<br>
