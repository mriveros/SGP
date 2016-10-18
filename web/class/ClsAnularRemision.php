<?php

/*
 * Autor: Marcos A. Riveros.
 * Año: 2015
 * Sistema de Precintos INTN
 */    
session_start();$ruta=$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT']."/web";
$codusuario=  $_SESSION["codigo_usuario"];
$ruta=$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT']."/web";
include '../funciones.php';
//recupera los datos del form
if  (empty($_POST['txtRemision'])){$nroRemision=0;}else{$nroRemision=$_POST['txtRemision'];}
 $conectate=pg_connect("host=localhost port=5432 dbname=SGP user=postgres password=postgres"
                    . "")or die ('Error al conectar a la base de datos');
//se define el Query   
$consulta=pg_exec($conectate,"select max(pre.prec_cod)as prec_cod from precintado pre,precintado_detalle predet
where pre.prec_cod=predet.prec_cod and pre.prec_nrorem='$nroRemision'");
$row1 = pg_fetch_array($consulta);
$codigo_precintado=$row1['prec_cod'];

$query = "update precinto set pre_activo='t',pre_estado='Disponible'
from precintado_detalle
where  precinto.pre_cod = precintado_detalle.pre_cod
and precintado_detalle.prec_cod=$codigo_precintado";
//Borramos el Detalle del Precintado
$ejecucion = pg_query($query)or die('Error al realizar la carga 1');
$query = "delete from precintado_detalle where prec_cod=$codigo_precintado";
$ejecucion = pg_query($query)or die('Error al realizar la carga 2');
//Borramos los datos de cabecera del precintado
$query = "delete from precintado where prec_cod=$codigo_precintado";
$ejecucion = pg_query($query)or die('Error al realizar la carga 3');
header("Refresh:0; url=http://$ruta/SGP/web/registrar_precintos/registrar_precintos.php");