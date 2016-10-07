<?php
/*
 * Autor: Marcos A. Riveros.
 * Año: 2015
 * Sistema de Compras y Pagos SGP INTN
 */
session_start();
$codusuario=  $_SESSION["codigo_usuario"];
 $ruta=$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT']."/web";
    include '../funciones.php';
    conexionlocal();
    
    //Datos del Form Agregar
    if  (empty($_POST['txtNombreA'])){$nombreA='';}else{ $nombreA = $_POST['txtNombreA'];}
    if  (empty($_POST['txtDescripcionA'])){$descripcionA='';}else{ $descripcionA= $_POST['txtDescripcionA'];}
    
    
    //Datos del Form Modificar
    if  (empty($_POST['txtCodigo'])){$codigoModif=0;}else{$codigoModif=$_POST['txtCodigo'];}
    if  (empty($_POST['txtNombreM'])){$nombreM='';}else{ $nombreM = $_POST['txtNombreM'];}
    if  (empty($_POST['txtDescripcionM'])){$descripcionM='';}else{ $descripcionM= $_POST['txtDescripcionM'];}
    if  (empty($_POST['txtEstadoM'])){$estadoM='f';}else{ $estadoM= 't';}
    
    //DAtos para el Eliminado Logico
    if  (empty($_POST['txtCodigoE'])){$codigoElim=0;}else{$codigoElim=$_POST['txtCodigoE'];}
    
    
        //Si es agregar
        if(isset($_POST['agregar'])){
            if(func_existeDato($nombreA, 'puestos', 'pues_des')==true){
                echo '<script type="text/javascript">
		alert("El Puesto ya existe. Ingrese otro Puesto de Precintado");
                window.location="http://$ruta/SGP/web/puestos/ABMpuesto.php";
		</script>';
                }else{              
                //se define el Query   
                $query = "INSERT INTO puestos(pues_des,pues_obs,pues_activo)"
                    . "VALUES ('$nombreA','$descripcionA','t');";
                //ejecucion del query
                $ejecucion = pg_query($query)or die('Error al realizar la carga');
                $query = '';
                header("Refresh:0; url=http://$ruta/SGP/web/puestos/ABMpuesto.php");
                }
            }
        //si es Modificar    
        if(isset($_POST['modificar'])){
            
            pg_query("update puestos set pues_des='$nombreM',"
                    . "pues_obs= '$descripcionM',"
                    . "pues_activo='$estadoM' "
                    . "WHERE pues_cod=$codigoModif");
            $query = '';
             header("Refresh:0; url=http://$ruta/SGP/web/puestos/ABMpuesto.php");
        }
        //Si es Eliminar
        if(isset($_POST['borrar'])){
            pg_query("update puestos set pues_activo='f' WHERE pues_cod=$codigoElim");
            header("Refresh:0; url=http://$ruta/SGP/web/puestos/ABMpuesto.php");
	}
