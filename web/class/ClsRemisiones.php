<?php
/*
 * Autor: Marcos A. Riveros.
 * Año: 2016
* Sistema de Gestion de Precintos ONM-INTN
 */
session_start();
$codusuario=  $_SESSION["codigo_usuario"];
 $ruta=$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT']."";
    include '../funciones.php';
    conexionlocal();
    
    //Datos del Form Agregar
    if  (empty($_POST['txtDescripcionA'])){$descripcionA='';}else{ $descripcionA = $_POST['txtDescripcionA'];}
    if  (empty($_POST['txtProveedorA'])){$proveedorA='';}else{ $proveedorA= $_POST['txtProveedorA'];}
    if  (empty($_POST['txtNroInicioA'])){$nro_inicioA='';}else{ $nro_inicioA= $_POST['txtNroInicioA'];}
    if  (empty($_POST['txtNroFinA'])){$nro_finA='';}else{ $nro_finA= $_POST['txtNroFinA'];}
    if  (empty($_POST['txtColorA'])){$colorA='';}else{ $colorA= $_POST['txtColorA'];}
    if  (empty($_POST['txtCantidadA'])){$cantidadA='';}else{ $cantidadA= $_POST['txtCantidadA'];}
    
    
    
    //DAtos para el Eliminado Logico
    if  (empty($_POST['txtCodigoE'])){$codigoElim=0;}else{$codigoElim=$_POST['txtCodigoE'];}
    
    
        //Si es agregar
        if(isset($_POST['agregar'])){
            if(func_existeDato($nombreA, 'remisiones', 'rem_des')==true){
                echo '<script type="text/javascript">
		alert("La Remision ya existe. Ingrese otra Remision");
                window.location="http://$ruta/SGP/web/remisiones/ABMremision.php";
		</script>';
                }else{              
                //se define el Query   
                $query = "INSERT INTO remisiones(rem_des, pro_cod, rem_nro_ini, rem_nro_fin, col_cod, 
                rem_cantidad, rem_fecha, rem_activo,rem_stock_actual)
                VALUES ('$descripcionA',$proveedorA,$nro_inicioA,$nro_finA,$colorA,$cantidadA,'now()','t',$cantidadA)";
                //ejecucion del query
                $ejecucion = pg_query($query)or die('Error al realizar la carga');
                $query = '';
                header("Refresh:0; url=http://$ruta/SGP/web/remisiones/ABMremision.php");
                }
            }
      
        //Si es Eliminar
        if(isset($_POST['borrar'])){
            pg_query("delete from remisiones WHERE rem_cod=$codigoElim")or die('<script type="text/javascript">
		alert("La Remisión ya ha sido utilizado. No se puede Eliminar");
                window.location="http://$ruta/SGP/web/remisiones/ABMremision.php";
		</script>');
            header("Refresh:0; url=http://$ruta/SGP/web/remisiones/ABMremision.php");
	}
