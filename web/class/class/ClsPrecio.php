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
          if  (empty($_POST['txtPrecio1'])){$precio1=0;}else{ $precio1= $_POST['txtPrecio1'];}
          if  (empty($_POST['txtPrecio2'])){$precio2=0;}else{ $precio2= $_POST['txtPrecio2'];}
          if  (empty($_POST['txtPrecio3'])){$precio3=0;}else{ $precio3= $_POST['txtPrecio3'];}
          if  (empty($_POST['txtActivo'])){$activo='f';}else{ $activo = 't';}
          
           $database = 'PRECINTOS';
            //invoca al php en donde estan contenidas las funciones
           // include '../conexion.php';
            include '../funciones.php';
            $var= $_GET['nuevo'];
             // si el registro es la pantalla nuevo
           if ($var==1){
                 if(func_existeDato($descripcion, 'precio', 'pre_des', $database)){
                     
                      echo '<script type="text/javascript">
			alert("El color ya existe. Intente ingresar otro Color");
                        window.location="http://localhost/Precintos/precintado/index.php";
			 </script>';
                       
                      }else{              
                            //se define el Query   
                            $query = "INSERT INTO precio(pre_des,precio1,precio2,precio3,pre_activo,pre_fecha) 
                            VALUES ('$descripcion',$precio1,$precio2,$precio3,'$activo',now());";
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
                $query = "update color set pre_des= '$descripcion',precio1='$precio1',precio2=$precio2,precio3=$precio3,pre_activo='$activo' where pre_cod= ".$codigo.";";
                $descripcion='';$precio1=0;$precio2=0;$precio3=0;$activo='';$codigo=0;
                $var=0;
                //ejecucion del query
                $ejecucion = pg_query($query)or die('Error al modificar los datos');
                header("Refresh:0; url=http://localhost/Precintos/precintado/index.php");
            }
       //
        ?>
    </body>
</html>
