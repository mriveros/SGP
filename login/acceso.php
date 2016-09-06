<?php 
session_start();
?>
<?php
/*
 * Autor: Marcos A. Riveros.
 * Año: 2016
 * Sistema de Gestion de Precintos ONM-INTN
 */

 include '../web/funciones.php';
 
       conexionlocal();
       $usr= $_REQUEST['username'];
       $pwd=md5($_REQUEST['clave']);
       $ruta=$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT']."";
	$sql= "SELECT * FROM usuarios usu ,puestos pues, puesto_usuario puesusu
        WHERE usu.usu_username = '$usr'
        and usu.usu_pass =('$pwd')
        and usu.usu_activo='t' 
        and pues.pues_cod=puesusu.pues_cod
        and usu.usu_cod=puesusu.usu_cod" ;
	//echo "$sql";
	//echo $n.' ---'.$sql; 
	$datosusr = pg_query($sql);
        $row = pg_fetch_array($datosusr);
       
        $n=0;
        $n = count($row['usu_nom']);
	if($n==0)
	{
		echo '<script type="text/javascript">
                         alert("Nombre de Usuario o Password no valido..!");
			 window.location="http://<?php echo $ruta;?>/SGP/login/acceso.html";
                      </script>';
	}
	else
	{
           
            $_SESSION["username"] = $row['usu_nick'];
            $_SESSION["nombre_usuario"] = $row['usu_nom'];
            $_SESSION["codigo_usuario"] = $row['usu_cod'];
            $_SESSION["categoria_usuario"] = $row['cat_cod'];
            $_SESSION["puesto_usuario"] = $row['pues_cod'];
            if ($row['cat_cod']==1){
                 header("Location:http://$ruta/SGP/web/menu_principal.php");
                 
            }else if($row['cat_cod']==2){
                header("Location:http://$ruta/SGP/web/menu_usuario.php");
                 
            
            }else if($row['cat_cod']==3){
                 header("Location:http://$ruta/SGP/web/menu_supervisor.php");
            }
        }
