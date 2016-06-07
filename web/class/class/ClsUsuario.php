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
          if  (empty($_POST['txtCi'])){$ci=0;}else{ $ci = $_POST['txtCi'];}
          if  (empty( $_POST['txtUsername'])){$nick =' ';}else{$nick = $_POST['txtUsername'];}
          if  (empty( $_POST['txtNombre'])){$nombre =' ';}else{  $nombre = $_POST['txtNombre'];}
          if  (empty( $_POST['txtApellido'])){$apellido =' ';}else{$apellido = $_POST['txtApellido'];}
          if  (empty($_POST['txtPassword'])){ $password =' ';}else { $password = $_POST['txtPassword'];}
          if  (empty($_POST['txtCategoria'])){ $categoria =' ';}else { $categoria = $_POST['txtCategoria'];}
          if  (empty($_POST['txtActivo'])){ $activo ='f';}else { $activo ='t';}
          //if  (empty(  $_POST['txtemail'])){$mail=' ' ;}else{$mail= $_POST['txtemail'];}
          $database = 'PRECINTOS';
            
            
            //invoca al php en donde estan contenidas las funciones
           // include '../conexion.php';
            include '../funciones.php';
           $var= $_GET['nuevo'];
             // si el registro es la pantalla nuevo
           if ($var==1){
                 if(func_existeDato($ci, 'usuario', 'usu_ci', $database)){
                     
                       echo('<script type="text/javascript">alert("El usuario ya existe")</script>');
                       
                      }else{              
                            //se define el Query   
                            $query = "INSERT INTO usuario(usu_ci, usu_nick, usu_nom, usu_ape, usu_pass,usu_cat,usu_fecha,usu_activo) 
                            VALUES ($ci, '$nick', '$nombre', '$apellido', MD5('$password'),$categoria,current_date,'$activo');";
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
                $query = "update usuario set usu_ci='$ci', usu_nick='$nick',usu_activo= '$activo', 
                usu_nom='$nombre', usu_ape='$apellido', usu_pass=MD5('$password'),usu_cat='$categoria',usu_fecha=current_date 
                where usu_cod= ".$codigo.";";
                $ci=0;$nick='';$nombre='';$apellido='';$password='';$mail='';$codigo=0;
                //ejecucion del query
                $ejecucion = pg_query($query)or die('Error al realizar la carga');
                $var=0;
                header("Refresh:0; url=http://localhost/Precintos/precintado/index.php");
            }
        ?>
    </body>
</html>
