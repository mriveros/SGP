<?php
/*
 * Autor: Marcos A. Riveros.
 * Año: 2016
* Sistema de Gestion de Precintos ONM-INTN
 */
session_start();$ruta=$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT']."/web";
$codusuario=  $_SESSION["codigo_usuario"];
 $ruta=$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT']."/web";
include '../funciones.php';
conexionlocal();
    
    //Datos del Form Agregar
    
    if  (empty($_POST['txtDescripcionA'])){$descripcionA='';}else{ $descripcionA= $_POST['txtDescripcionA'];}
    if  (empty($_POST['txtPrecio1A'])){$precio1A='';}else{ $precio1A= $_POST['txtPrecio1A'];}
    if  (empty($_POST['txtPrecio2A'])){$precio2A='';}else{ $precio2A= $_POST['txtPrecio2A'];}
    if  (empty($_POST['txtPrecio3A'])){$precio3A='';}else{ $precio3A= $_POST['txtPrecio3A'];}
    if  (empty($_POST['txtfechaA'])){$fechaA='';}else{ $fechaA= $_POST['txtfechaA'];}
    
    
    //Datos del Form Modificar
    if  (empty($_POST['txtCodigo'])){$codigoModif=0;}else{$codigoModif=$_POST['txtCodigo'];}
    if  (empty($_POST['txtDescripcionM'])){$descripcionM='';}else{ $descripcionM= $_POST['txtDescripcionM'];}
    if  (empty($_POST['txtPrecio1M'])){$precio1='';}else{ $precio1= $_POST['txtPrecio1M'];}
    if  (empty($_POST['txtPrecio2M'])){$precio2='';}else{ $precio2= $_POST['txtPrecio2M'];}
    if  (empty($_POST['txtPrecio3M'])){$precio3='';}else{ $precio3= $_POST['txtPrecio3M'];}
    if  (empty($_POST['txtfechaM'])){$fechaM='';}else{ $fechaM= $_POST['txtfechaM'];}
    if  (empty($_POST['txtEstadoM'])){$estadoM='f';}else{ $estadoM= 't';}
    
    //Datos para el Eliminado Logico
    if  (empty($_POST['txtCodigoE'])){$codigoElim=0;}else{$codigoElim=$_POST['txtCodigoE'];}
    
    
        //Si es agregar
        if(isset($_POST['agregar'])){
            if(func_existeDato($descripcionA, 'precios', 'pre_des')==true){
                echo '<script type="text/javascript">
		alert("El Precio ya existe. Ingrese otro Precio");
                window.location="http://'.$ruta.'/SGP/web/precios/ABMprecio.php";
		</script>';
                }else{              
                //se define el Query   
                $query = "INSERT INTO precios(pre_des,precio1,precio2,precio3,pre_fecha,pre_activo)"
                    . "VALUES ('$descripcionA',$precio1A,$precio2A,$precio3A,'$fechaA','t');";
                //ejecucion del query
                $ejecucion = pg_query($query)or die('Error al realizar la carga'.$query);
                $codigo_precio=obtenerUltimo('precios', 'pre_cod');
                $query ="update precios set pre_activo='f' where pre_cod<>$codigo_precio";
                pg_query($query)or die('Error al realizar la carga. Error: '.$query);
                
                //actualizamos precintados con precio 1
                $query = "update precintado set prec_precio=$precio1A where prec_cantprecinto <= 6 and prec_fecha >= '$fechaA'";
                pg_query($query)or die('Error al realizar la carga'.$query);
                //actualizamos precintados con precio 2
                $query = "update precintado set prec_precio=$precio2A where prec_cantprecinto > 6 and prec_cantprecinto <= 10 and prec_fecha >= '$fechaA'";
                pg_query($query)or die('Error al realizar la carga'.$query);
                
                //actualizamos precintados con precio 3
                $query = "update precintado set prec_precio=$precio3A where prec_cantprecinto > 10 and prec_fecha >= '$fechaA'";
                pg_query($query)or die('Error al realizar la carga'.$query);
                
                
                header("Refresh:0; url=http://$ruta/SGP/web/precios/ABMprecio.php");
                }
            }
            
            
        //si es Modificar    
        if(isset($_POST['modificar'])){
            
            pg_query("update precios set pre_des='$descripcionM',precio1= $precio1,precio2= $precio2,precio3= $precio3,pre_fecha='$fechaM',pre_activo='$estadoM'
                    WHERE pre_cod=$codigoModif");
            
             //actualizamos precintados con precio 1
                $query = "update precintado set prec_precio=$precio1 where prec_cantprecinto <= 7 and prec_fecha >= '$fechaM'";
                pg_query($query)or die('Error al realizar la carga'.$query);
                //actualizamos precintados con precio 2
                $query = "update precintado set prec_precio=$precio2 where prec_cantprecinto > 7 and prec_cantprecinto <= 12 and prec_fecha >= '$fechaM'";
                pg_query($query)or die('Error al realizar la carga'.$query);
                
                //actualizamos precintados con precio 3
                $query = "update precintado set prec_precio=$precio3 where prec_cantprecinto > 12 and prec_fecha >= '$fechaM'";
                pg_query($query)or die('Error al realizar la carga'.$query);
                
                
            header("Refresh:0; url=http://$ruta/SGP/web/precios/ABMprecio.php");
        }
        

        //Si es Eliminar
        if(isset($_POST['borrar'])){
            pg_query("update precios set pre_activo='f' WHERE pre_cod=$codigoElim");
            header("Refresh:0; url=http://$ruta/SGP/web/precios/ABMprecio.php");
	}
