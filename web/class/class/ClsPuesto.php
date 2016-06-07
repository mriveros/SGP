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
          if  (empty($_POST['txtObservacion'])){$observacion=0;}else{ $observacion= $_POST['txtObservacion'];}
          if  (empty($_POST['txtActivo'])){$activo='f';}else{ $activo = 't';}
          
           $database = 'PRECINTOS';
            
            
            //invoca al php en donde estan contenidas las funciones
           // include '../conexion.php';
            include '../funciones.php';
            $var= $_GET['nuevo'];
             // si el registro es la pantalla nuevo
           if ($var==1){
                 if(func_existeDato($descripcion, 'puesto', 'pues_des', $database)){
                     
                      echo '<script type="text/javascript">
			alert("El Puesto ya existe. Intente ingresar otro Puesto");
			 </script>';
                       
                      }else{              
                            //se define el Query   
                            $query = "INSERT INTO puesto(pues_des,pues_obs,pues_activo) VALUES ('$descripcion','$observacion','$activo');";
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
                $query = "update puesto set pues_des= '$descripcion',pues_obs='$observacion',pues_activo='$activo' where pues_cod= ".$codigo.";";
                $descripcion='';$observacion='';$activo='';$codigo=0;
                $var=0;
                //ejecucion del query
                $ejecucion = pg_query($query)or die('Error al modificar los datos');
                    header("Refresh:0; url=http://localhost/Precintos/precintado/index.php");
            }
       //
        ?>
    </body>
</html>
