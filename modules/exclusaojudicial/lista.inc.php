<?php

include ("menu.inc.php");
include ("filtro.inc.php");


$sql="SELECT DISTINCT exclusaojudicial.*, opm.ABREVIATURA AS opmexclusao FROM exclusaojudicial
	 LEFT JOIN RHPARANA.opmPMPR opm ON opm.CODIGOBASE=exclusaojudicial.cdopm_quandoexcluido";
include ("includes/filtro.php");
?>

<br>
<?php

include("listatabela.inc.php");

?>
</div>
<br>
