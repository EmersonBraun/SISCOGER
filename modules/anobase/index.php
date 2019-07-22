<?

if ($opcao=="modificar") {
	if ($acao=="modificar") {
		$anobase=$_REQUEST[anobase];
		if ($anobase) {
			$_SESSION[sjd_ano]=$anobase;			
			echo "O ANO BASE foi modificado para <b>$anobase</b> com sucesso!";
		}
	}
	else {
		include ("formulario.inc");
	}
}
else {
	include ("formulario.inc");
}


?>
