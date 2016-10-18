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
     $ruta=$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT']."/web";
    //Datos del Form Agregar
    if  (empty($_POST['txtNombreA'])){$nombreA='';}else{ $nombreA = $_POST['txtNombreA'];}
    if  (empty($_POST['txtApellidoA'])){$apellidoA='';}else{ $apellidoA= $_POST['txtApellidoA'];}
    if  (empty($_POST['txtPuestoA'])){$puestoA='';}else{ $puestoA= $_POST['txtPuestoA'];}
    

    //Datos del Form Modificar
    if  (empty($_POST['txtCodigo'])){$codigoModif=0;}else{$codigoModif=$_POST['txtCodigo'];}
    if  (empty($_POST['txtNombreM'])){$nombreM='';}else{ $nombreM = $_POST['txtNombreM'];}
    if  (empty($_POST['txtApellidoM'])){$apellidoM='';}else{ $apellidoM= $_POST['txtApellidoM'];}
    if  (empty($_POST['txtPuestoM'])){$puestoM='';}else{ $puestoM= $_POST['txtPuestoM'];}
    if  (empty($_POST['txtEstadoM'])){$estadoM='f';}else{ $estadoM= 't';}
    
    //DAtos para el Eliminado Logico
    if  (empty($_POST['txtCodigoE'])){$codigoElim=0;}else{$codigoElim=$_POST['txtCodigoE'];}
    
    
        //Si es agregar
        if(isset($_POST['agregar'])){
            if(func_existeDato($nombreA, 'precintador', 'pre_nom')==true){
                echo '<script type="text/javascript">
		alert("El Precintador ya existe. Ingrese otro Precintador");
                window.location="http://$ruta/SGP/web/precintador/ABMprecintador.php";
		</script>';
                }else{              
                //se define el Query   
                $query = "INSERT INTO precintador(pre_nom,pre_ape,pues_cod,pre_activo,pre_fecha)"
                    . "VALUES ('$nombreA','$apellidoA',$puestoA,'t',now());";
                //ejecucion del query
                $ejecucion = pg_query($query)or die('Error al realizar la carga');
                $query = '';
                header("Refresh:0; url=http://$ruta/SGP/web/precintador/ABMprecintador.php");
                }
            }
        //si es Modificar    
        if(isset($_POST['modificar'])){
            
            pg_query("update precintador set pre_nom='$nombreM',"
                    . "pre_ape= '$apellidoM',"
                     ."pues_cod= '$puestoM',"
                    . "pre_activo='$estadoM' "
                    . "WHERE pre_cod=$codigoModif");
            $query = '';
           header("Refresh:0; url=http://$ruta/SGP/web/precintador/ABMprecintador.php");
        }
        //Si es Eliminar
        if(isset($_POST['borrar'])){
            pg_query("update precintador set pre_activo='f' WHERE pre_cod=$codigoElim");
            header("Refresh:0; url=http://$ruta/SGP/web/precintador/ABMprecintador.php");
	}
