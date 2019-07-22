<?php

if (in_array((integer)$user["nivel"],array(4,5))) {
    include ("formulario.editar.inc.php");
} else {
    include ("formulario.visualizar.inc.php");
}