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
          if  (empty($_POST['txtInicio'])){$inicio=0;}else{$inicio=$_POST['txtInicio'];}
          if  (empty($_POST['txtFin'])){$fin=0;}else{ $fin = $_POST['txtFin'];}
          if  (empty($_POST['txtEntrega'])){$entrega=0;}else{ $entrega= $_POST['txtEntrega'];}
          if  (empty($_POST['txtActivo'])){$activo='f';}else{ $activo = 't';}
          
           $database = 'PRECINTOS';
            include '../funciones.php';
            $var= $_GET['nuevo'];
             // si el registro es la pantalla nuevo
           if ($var==1){
                 if(func_existeColor($inicio,$fin,$database)){
                     //aca debe mostrar el ultimo numero que ha sido generado...
                      echo '<script type="text/javascript">
			alert("El Precinto ya existe. Ingrese un margen que no ha sido generado aun..");
			 </script>';
                        header("Refresh:0; url=http://localhost/Precintos/precintado/index.php");
                      }else{              
                            //se define el Query
                          for ($X=$inicio;$X<=$fin;$X++){
                              
                              $query = "INSERT INTO precinto(pre_nro,pre_fec,en_cod,pre_activo) VALUES ('$inicio','now()',$entrega,'t');";
                              $inicio=$inicio+1;
                              //ejecucion del query
                              $ejecucion = pg_query($query)or die('Error al realizar la carga');
                          }
                             echo '<script type="text/javascript">alert("La serie de Precintos se ha generado Exitosamente..!");</script>';
                            $query = '';
                            $var=0;
                            //Ahora debemos poner la entrega con estado inactivo porque la entrega fue realizada con exito
                            $query = "update entrega set en_activo='f' where en_cod=$entrega";
                            $ejecucion = pg_query($query)or die('<script type="text/javascript">alert("Error al dar de baja la Entrega..");</script>');
                            //ejecucion del query
                            header("Refresh:0; url=http://localhost/Precintos/precintado/index.php");
                            }
         }
           //si el registro es en modificar modificar
        elseif ($var==2){
                conexionlocal();
                $query ='';
                $query = "update puesto set pues_des= '$descripcion',pues_obs='$observacion',pues_activo='$activo' where pues_cod= ".$codigo.";";
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
