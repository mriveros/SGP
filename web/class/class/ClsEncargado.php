<!DOCTYPE html>
<!--
/*
 * Autor: Marcos A. Riveros.
 * Año: 2015
 * Sistema de Sueldos INTN
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
          if  (empty($_POST['txtNombre'])){$nombre=0;}else{ $nombre = $_POST['txtNombre'];}
          if  (empty($_POST['txtApellido'])){$apellido=0;}else{ $apellido = $_POST['txtApellido'];}
          if  (empty($_POST['txtCI'])){$ci=0;}else{ $ci = $_POST['txtCI'];}
          if  (empty($_POST['txtActivo'])){$activo='f';}else{ $activo= 't';}
          $database = 'PRECINTOS';
            include '../funciones.php';
            conexionlocal();
            
            $var= $_GET['nuevo'];
            echo $var;
             // si el registro es la pantalla nuevo
           if ($var==1){
                 if(func_existeDato($ci,'encargado', 'en_ci', $database)){
                     
                      echo '<script type="text/javascript">
			alert("El Encargado ya existe. Intente Ingresar otro Encargado..");
			 window.location="http://localhost/Precintos/precintado/index.php";
			 </script>';
                      }else{              
                            //se define el Query   
                            $query = "INSERT INTO encargado( en_nom,en_ape,en_ci,en_fecha,en_activo) VALUES ('$nombre','$apellido',$ci,current_date,'$activo');";
                            //ejecucion del query
                            $ejecucion = pg_query($query)or die('Error al realizar la carga');
                            $query = '';
                            $var=0;
                            header("Refresh:0; url=http://localhost/Precintos/precintado/index.php");
                            }
         }
           //si el registro es en modificar modificar
        elseif ($var==2){
                
                $query ='';
                $query = "update encargado set en_nom= '$nombre',en_ape='$apellido',en_ci=$ci,en_activo='$activo' where en_cod= ".$codigo.";";
                $codigo=0;
                //ejecucion del query
                $ejecucion = pg_query($query)or die('Error al realizar la carga');
                $codigo=0;
                $var=0;
                header("Refresh:0; url=http://localhost/Precintos/precintado/index.php");
            }
       //
        ?>
    </body>
</html>
