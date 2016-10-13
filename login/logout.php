<?php 
	session_start();$ruta=$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT']."/web"; 
	session_destroy(); 
        $ruta=$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT']."/web";
	header("Location:http://$ruta/SGP/login/acceso.html");
?>