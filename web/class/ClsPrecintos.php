 <?php
/*
 * Autor: Marcos A. Riveros.
 * Año: 2015
 * Sistema de Precintos INTN
 */
    session_start();
    $codusuario=  $_SESSION["codigo_usuario"];
    include '../funciones.php';
    conexionlocal();
        
        
    
            //recupera los datos del form
          if  (empty($_POST['txtCodigoE'])){$codigo=0;}else{$codigo=$_POST['txtCodigoE'];}
          if  (empty($_POST['txtCodigoGenerar'])){$codigo_entrega=0;}else{ $codigo_entrega= $_POST['txtCodigoGenerar'];}
         
          
        
             // si el registro es la pantalla nuevo
    if(isset($_POST['generar'])){
                    
                        //Consultamos Datos acerca de la entrega
                        $query = pg_query("select en_cantidad,pues_cod,rem_cod,en_nro_inicio,en_nro_fin from entrega where en_cod=$codigo_entrega");
                        $row1 = pg_fetch_array($query);
                        $cantidad= $row1[0];
                        $puesto= $row1[1];
                        $remision= $row1[2];
                        $inicio= $row1[3];
                        $fin= $row1[4];
                          for ($X=0;$X<$cantidad;$X++){
                              $query = "INSERT INTO precinto(pre_nro,pre_fec,en_cod,pues_cod,pre_activo,pre_estado) VALUES ($inicio,'now()',$codigo_entrega,$puesto,'t','Disponible');";
                              $ejecucion = pg_query($query)or die('Error al realizar la carga'.$query);
                              $inicio=$inicio+1;
                          }
                            echo '<script type="text/javascript">alert("La serie de Precintos se ha generado Exitosamente..!");</script>';
                            //Ahora debemos poner la entrega con estado inactivo porque la entrega fue realizada con exito
                            $query = "update entrega set en_activo='f' where en_cod=$codigo_entrega";
                            $ejecucion = pg_query($query)or die('<script type="text/javascript">alert("Error al dar de baja la Entrega..");</script>');
                            //ejecucion del query
                            header("Refresh:0; url=http://<?php echo $ruta;?>/SGP/web/generar_precintos/ABMprecinto.php");
                            }
         
           //si el registro es en modificar modificar
        if(isset($_POST['anularprecinto'])){
                conexionlocal();
                $query = "update precinto set pre_activo= 'f' where pre_cod=$codigo;";
                $ejecucion = pg_query($query)or die ('<script type="text/javascript">alert("Error al Anular el Precinto.Intente mas tarde..");</script>');
                header("Refresh:0; url=http://<?php echo $ruta;?>/SGP/web/generar_precintos/ABMprecinto.php");
            }
       //
        ?>
