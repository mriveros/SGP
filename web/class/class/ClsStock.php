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
          if  (empty($_POST['txtDescripcion'])){$descripcion=0;}else{ $descripcion = $_POST['txtDescripcion'];}
          if  (empty($_POST['txtProveedor'])){$proveedor=0;}else{ $proveedor= $_POST['txtProveedor'];}
          if  (empty($_POST['txtCantidad'])){$cantidad=0;}else{ $cantidad= $_POST['txtCantidad'];}
          if  (empty($_POST['txtColor'])){$color=0;}else{ $color= $_POST['txtColor'];}
          if  (empty($_POST['txtActivo'])){$activo='f';}else{ $activo = 't';}
          
           $database = 'PRECINTOS';
            
            
            //invoca al php en donde estan contenidas las funciones
           // include '../conexion.php';
            include '../funciones.php';
            conexionlocal();
            $var= $_GET['nuevo'];
             // si el registro es la pantalla nuevo
           if ($var==1){
                               
                            //se define el Query   
                            $query = "INSERT INTO stock(st_des,st_prov,st_cantidad,st_stock_actual,col_cod,st_estado,st_fecha) VALUES ('$descripcion','$proveedor',$cantidad,$cantidad,$color,'$activo',now());";
                            //ejecucion del query
                            $ejecucion = pg_query($query)or die('<script type="text/javascript">alert("Error al cargarel Stock. Contacte con el Programador..");</script>');
                            $query = '';
                            $var=0;
                            header("Refresh:0; url=http://localhost/Precintos/precintado/index.php");
                            
         }
           //si el registro es en modificar modificar
        elseif ($var==2){
                $query ='';
                $query = "update stock set st_des= '$descripcion',st_prov='$proveedor',st_cantidad=$cantidad where st_cod= ".$codigo.";";
                $descripcion='';$proveedor='';$cantidad='';$codigo=0;
                $var=0;
                //ejecucion del query
                $ejecucion = pg_query($query)or die('<script type="text/javascript">alert("Error al modificar los datos");</script>');
                    header("Refresh:0; url=http://localhost/Precintos/precintado/index.php");
            }
       //
        ?>
    </body>
</html>
