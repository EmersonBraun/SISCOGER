<?php

include 'visualizar.php';

if (in_array($user["nivel"], array(4,5))) {
    echo "<br /><a href='?module=apresentacao&opcao=cadastrar&notacomparecimento[id]={$notacomparecimento->id_notacomparecimento}'> + Cadastrar apresentação</a> | ";
    echo "<a href='?module=notacomparecimento&opcao=download&notacomparecimento[id]={$notacomparecimento->id_notacomparecimento}&noheader&nomenu'>Download</a>";
}

include 'apresentacoes.inc.php';