<!DOCTYPE html>
<!--
/*
 * Autor: Marcos A. Riveros.
 * Año: 2015
 * Sistema de Precintos INTN
 */
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
    
        
        
            <?php
            //recupera los datos del form
          if  (empty($_POST['txtcodigo'])){$codigo=0;}else{$codigo=$_POST['txtcodigo'];}
          if  (empty($_POST['txtDescripcion'])){$descripcion=0;}else{ $descripcion = $_POST['txtDescripcion'];}
          if  (empty($_POST['txtFecha'])){$fecha=0;}else{ $fecha = $_POST['txtFecha'];}
          if  (empty($_POST['txtActivo'])){$activo='f';}else{ $activo='t';}
          
           $database = 'salario';
            //invoca al php en donde estan contenidas las funciones
           // include '../conexion.php';
            include '../funciones.php';
            $var= $_GET['nuevo'];
             // si el registro es la pantalla nuevo
           if ($var==1){
                 if(func_existeDato($descripcion, 'emblema', 'em_des', $database)){
                     
                        echo '<script type="text/javascript">
			alert("El emblema ya existe. Intente Ingresar otro Emblema..");
                        window.location="http://localhost/Precintos/precintado/index.php";
			 </script>';
                      }else{              
                            //se define el Query   
                            $query = "INSERT INTO emblema(em_des,em_fecha,em_activo) VALUES ('$descripcion','$fecha','$activo');";
                            //ejecucion del query
                            $ejecucion = pg_query($query)or die('Error al realizar la carga');
                            $query = '';
                            $var=0;
                           header("Refresh:0; url=http://localhost/Precintos/precintado/index.php");
                            }
         }
           //si el registro es en modificar modificar
        elseif ($var==2){
            conexionlocal();
                $query ='';
                $query = "update emblema set em_des= '$descripcion',em_fecha='$fecha',em_activo='$activo' 
                where em_cod= ".$codigo.";";
                $descripcion=0;$codigo=0;
                $var=0;
                //ejecucion del query
                $ejecucion = pg_query($query)or die('Error al realizar la carga');
               header("Refresh:0; url=http://localhost/Precintos/precintado/index.php");
            }
        ?>
    </body>
</html>
