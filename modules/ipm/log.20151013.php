<?php

openTable("width='100%' class='bordasimples'");


openLine();
	h1("Inqu&eacute;rito Policial Militar - LOG");
closeLine();
openLine();
	h2("<a href='log/ipm'>Arquivos antigos, clique aqui</a>");
closeLine();

?>

<tr bgcolor=white><TD bgcolor=white><? include ("log/ipm.html");?></TD></tr>


<?php
closeTable();
?>
