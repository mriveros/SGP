<?php

/*
 * Autor: Marcos A. Riveros.
 * Año: 2015
 * Sistema de Precintos INTN
 */    
session_start();
$codusuario=  $_SESSION["codigo_usuario"];
 $ruta=$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT']."/web";
    include '../funciones.php';
    conexionlocal();
            //recupera los datos del form
          if  (empty($_POST['txtCodigoE'])){$codigoElim=0;}else{$codigoElim=$_POST['txtCodigoE'];}
          if  (empty($_POST['txtDescripcionA'])){$descripcion=0;}else{ $descripcion = $_POST['txtDescripcionA'];}
          if  (empty($_POST['txtEncargado'])){$encargado=0;}else{ $encargado= $_POST['txtEncargado'];}
          if  (empty($_POST['txtCantidadA'])){$cantidad=0;}else{ $cantidad= $_POST['txtCantidadA'];}
          if  (empty($_POST['txtPuestoA'])){$puesto=0;}else{ $puesto= $_POST['txtPuestoA'];}
          if  (empty($_POST['txtRemisionA'])){$codstock=0;}else{ $codstock = $_POST['txtRemisionA'];}
          if  (empty($_POST['txtNroInicioA'])){$nro_inicio=0;}else{ $nro_inicio= $_POST['txtNroInicioA'];}
          if  (empty($_POST['txtNroFinA'])){$nro_fin=0;}else{ $nro_fin= $_POST['txtNroFinA'];}
         
          
          
           
           if(isset($_POST['agregar'])){
               $Stock=cantidad_Stock($codstock);
               if($Stock<$cantidad){
                     
                      echo '<script type="text/javascript">
			alert("La Cantidad supera el Stock disponible. Debe ser menor a '.$Stock.'");
                            window.location="http://$ruta/SGP/web/entregas/ABMentrega.php";
			 </script>';
                      }else{              
                            //se define el Query   
                            $query = "INSERT INTO entrega(rem_cod,en_des,en_cantidad,en_nro_inicio,en_nro_fin,en_fecha,pues_cod,enc_cod,en_activo)
                            VALUES ($codstock,'$descripcion',$cantidad,$nro_inicio,$nro_fin,'now()',$puesto,$encargado,'t');";
                            //ejecucion del query
                            $ejecucion = pg_query($query)or die('Error al realizar la carga Entregas'.$query);
                            $query = '';
                            $var=0;
                            
                            //En esta parte debemos actualizar el stock que tenemos en realidad
                            $query = "update remisiones set rem_stock_actual=(rem_stock_actual-$cantidad) where rem_cod=$codstock";
                            //ejecucion del query
                            $ejecucion = pg_query($query)or die('Error al realizar la carga'.$query);
                            header("Refresh:0; url=http://$ruta/SGP/web/entregas/ABMentrega.php");
                            }
                        }
         //Si es Eliminar
        if(isset($_POST['borrar'])){
            
            //Obtenemos la cantidad que fue entregada y que ahora queremos eliminar
            $query="select en_cantidad, rem_cod from entrega  where en_cod=$codigoElim";
            $result = pg_query($query);
            $row = pg_fetch_row($result); 
            $cantidad=$row[0];
            $codigo_remision=$row[1];

            //Procedemos a eliminar el registro
             $query="delete from entrega  where en_cod=$codigoElim";
             $ejecucion = pg_query($query)or die('<script type="text/javascript">
		alert("La Entrega ya ha sido utilizado. No se puede Eliminar'.$query.'");
                window.location="http://$ruta/SGP/web/entregas/ABMentrega.php";
		</script>');
             
             //sumamos la cantidad de la entrega 
            $query = "update remisiones set rem_stock_actual=(rem_stock_actual+$cantidad) where rem_cod=$codigo_remision";
            //ejecucion del query
            $ejecucion = pg_query($query)or die('Error al realizar la carga'.$query);
            
             header("Refresh:0; url=http://$ruta/SGP/web/entregas/ABMentrega.php");
             
	}

      
        ?>
   
