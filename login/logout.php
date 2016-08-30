<?php 
	session_start(); 
	session_destroy(); 
	header("Location:http://<?php echo $ruta;?>/SGP/login/acceso.html");
?>