<?php 
	session_start(); 
	session_destroy(); 
        $ruta=$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT']."";
	header("Location:http://$ruta/SGP/login/acceso.html");
?>