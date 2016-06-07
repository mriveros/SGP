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
          if  (empty($_POST['txtPuesto'])){$codpuesto=0;}else{ $codpuesto = $_POST['txtPuesto'];}
          if  (empty($_POST['txtUsuario'])){$codusuario=0;}else{ $codusuario = $_POST['txtUsuario'];}
          if  (empty($_POST['txtActivo'])){$activo='f';}else{ $activo = 't';}
          
           $database = 'PRECINTOS';
            //invoca al php en donde estan contenidas las funciones
           // include '../conexion.php';
            include '../funciones.php';
            $var= $_GET['nuevo'];
             // si el registro es la pantalla nuevo
           if ($var==1){
                 if(func_existeDatoDetalle($codpuesto,$codusuario,'puesto_usuario','usu_cod','pues_cod','PRECINTOS')){
                     
                      echo '<script type="text/javascript">
			alert("El usuario ya ha sido asignado al puesto. Intente ingresar otro Puesto o Usuario.");
			 </script>';
                       
                      }else{              
                            //se define el Query   
                            $query = "INSERT INTO puesto_usuario(usu_cod,pues_cod,pues_activo,pues_fecha) VALUES ($codusuario,$codpuesto,'$activo',now());";
                            //ejecucion del query
                            $ejecucion = pg_query($query)or die('<script type="text/javascript">
                            alert("Error al ejecutar la accion. Contacte con el Programador");
                            </script>');
                            $query = '';
                            $var=0;
                            header("Refresh:0; url=http://localhost/Precintos/precintado/index.php");
                            }
         }
           //si el registro es en modificar modificar
        elseif ($var==2){
                conexionlocal();
                $query ='';
                $query = "update puesto_usuario set pues_cod= $codpuesto,usu_cod=$codusuario,pues_activo='$activo' where pues_det_cod= ".$codigo.";";
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
