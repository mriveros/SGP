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
          if  (empty($_POST['txtStock'])){$codstock=0;}else{ $codstock = $_POST['txtStock'];}
          if  (empty($_POST['txtDescripcion'])){$descripcion=0;}else{ $descripcion = $_POST['txtDescripcion'];}
          if  (empty($_POST['txtObservacion'])){$observacion=0;}else{ $observacion= $_POST['txtObservacion'];}
          if  (empty($_POST['txtUnidades'])){$unidades=0;}else{ $unidades= $_POST['txtUnidades'];}
          if  (empty($_POST['txtPuesto'])){$puesto=0;}else{ $puesto= $_POST['txtPuesto'];}
          if  (empty($_POST['txtEncargado'])){$encargado=0;}else{ $encargado= $_POST['txtEncargado'];}
          if  (empty($_POST['txtActivo'])){$activo='f';}else{ $activo = 't';}
          
           $database = 'PRECINTOS';
            //invoca al php en donde estan contenidas las funciones
           // include '../conexion.php';
            include '../funciones.php';
            $var= $_GET['nuevo'];
             // si el registro es la pantalla nuevo
           if ($var==1){
               $Stock=cantidad_Stock($codstock);
               if($Stock<$unidades){
                     
                      echo '<script type="text/javascript">
			alert("la Cantidad supera la Entrega a realizar. Debe ser menor a '.$Stock.'");
                            window.location="http://localhost/Precintos/precintado/index.php";
			 </script>';
                       
                      }else{              
                            //se define el Query   
                            $query = "INSERT INTO entrega(st_cod,en_des,en_obs,en_unidad,en_fecha,pues_cod,enc_cod,en_activo) VALUES ($codstock,'$descripcion','$observacion',$unidades,'now()',$puesto,$encargado,'$activo');";
                            //ejecucion del query
                            $ejecucion = pg_query($query)or die('Error al realizar la carga');
                            $query = '';
                            $var=0;
                            
                            //En esta parte debemos actualizar el stock que tenemos en realidad
                            $query = "update stock set st_stock_actual=(st_stock_actual-$unidades) where st_cod=$codstock";
                            //ejecucion del query
                            $ejecucion = pg_query($query)or die('Error al realizar la carga');
                            $query = '';
                            header("Refresh:0; url=http://localhost/Precintos/precintado/index.php");
                            }
         }
           //si el registro es en modificar modificar
        elseif ($var==2){
                conexionlocal();
                //para modificar una entrega se debe reestablecer la cantidad que ha sido quitada del stock
                $query ='';
                $query = "update entrega set st_cod=$codstock,en_des= '$descripcion',en_obs='$observacion',en_activo='$activo',en_unidad=$unidades where en_cod= ".$codigo.";";
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
