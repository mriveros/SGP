<?php
/*
 * Autor: Marcos A. Riveros.
 * Año: 2015
 * Sistema de Compras y Pagos SGP-INTN
 */
session_start();
$codusuario=  $_SESSION["codigo_usuario"];

    include '../funciones.php';
    conexionlocal();
    
    //Datos del Form Agregar
    if  (empty($_POST['txtUsuarioA'])){$usuarioA='';}else{ $usuarioA = $_POST['txtUsuarioA'];}
    if  (empty($_POST['txtPuestoA'])){$puestoA='';}else{ $puestoA= $_POST['txtPuestoA'];}
    

    //Datos del Form Modificar
    if  (empty($_POST['txtCodigo'])){$codigoModif=0;}else{$codigoModif=$_POST['txtCodigo'];}
    if  (empty($_POST['txtUsuarioM'])){$usuarioM=0;}else{ $usuarioM = $_POST['txtUsuarioM'];}
    if  (empty($_POST['txtPuestoM'])){$puestoM=0;}else{ $puestoM= $_POST['txtPuestoM'];}
    if  (empty($_POST['txtEstadoM'])){$estadoM='f';}else{ $estadoM= 't';}
    
    //DAtos para el Eliminado Logico
    if  (empty($_POST['txtCodigoE'])){$codigoElim=0;}else{$codigoElim=$_POST['txtCodigoE'];}
    
    
        //Si es agregar
        if(isset($_POST['agregar'])){
            if(func_existeDato($usuarioA, 'puesto_usuario', 'usu_cod')==true){
                echo '<script type="text/javascript">
		alert("El Usuario ya esta en este puesto. Ingrese otro Usuario");
                window.location="http://localhost/SGP/web/puesto_usuario/ABMpuesto_usuario.php";
		</script>';
                }else{              
                //se define el Query   
                $query = "INSERT INTO puesto_usuario(usu_cod,pues_cod,pues_usu_activo)"
                    . "VALUES ($usuarioA,$puestoA,'t');";
                //ejecucion del query
                $ejecucion = pg_query($query)or die('Error al realizar la carga');
                $query = '';
                header("Refresh:0; url=http://localhost/SGP/web/puesto_usuario/ABMpuesto_usuario.php");
                }
            }
        //si es Modificar    
        if(isset($_POST['modificar'])){
            
            pg_query("update puesto_usuario set usu_cod=$usuarioM,"
                     ."pues_cod= $puestoM,"
                    . "pues_usu_activo='$estadoM'"
                    . "WHERE pues_usu_cod=$codigoModif");
            $query = '';
           header("Refresh:0; url=http://localhost/SGP/web/puesto_usuario/ABMpuesto_usuario.php");
        }
        //Si es Eliminar
        if(isset($_POST['borrar'])){
            pg_query("update puesto_usuario set pues_usu_activo='f' WHERE pues_usu_cod=$codigoElim");
           header("Refresh:0; url=http://localhost/SGP/web/puesto_usuario/ABMpuesto_usuario.php");
	}
