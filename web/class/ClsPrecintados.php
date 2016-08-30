 <?php
/*
 * Autor: Marcos A. Riveros.
 * Año: 2015
 * Sistema de Precintos INTN
 */
    session_start();
    $codusuario=  $_SESSION["codigo_usuario"];
    $puesto_usuario= $_SESSION["puesto_usuario"];
    include '../funciones.php';
    conexionlocal();
     
        
    
          //Datos de Cabecera
          if  (empty($_POST['txtCodigoE'])){$codigo=0;}else{$codigo=$_POST['txtCodigoE'];}
          if  (empty($_POST['txtRemisionA'])){$remision=0;}else{$remision=$_POST['txtRemisionA'];}
          if  (empty($_POST['txtEmblemaA'])){$emblema=0;}else{$emblema=$_POST['txtEmblemaA'];}
          if  (empty($_POST['txtNroBiblioratoA'])){$bibliorato=0;}else{$bibliorato=$_POST['txtNroBiblioratoA'];}
          if  (empty($_POST['txtEncargadoA'])){$codigo_encargado=0;}else{$codigo_encargado=$_POST['txtEncargadoA'];}
          if  (empty($_POST['txtCodCamionA'])){$codigo_camion=0;}else{$codigo_camion=$_POST['txtCodCamionA'];}
          if  (empty($_POST['txtTransportistaA'])){$transportista='';}else{$transportista=$_POST['txtTransportistaA'];}
          if  (empty($_POST['txtDestinoA'])){$destino=0;}else{$destino=$_POST['txtDestinoA'];}
          if  (empty($_POST['txtPrecintadorA'])){$codigo_precintador='';}else{$codigo_precintador=$_POST['txtPrecintadorA'];}
          if  (empty($_POST['txtGasoilA'])){$gasoil=0;}else{$gasoil=$_POST['txtGasoilA'];}
          if  (empty($_POST['txtAlconaftaA'])){$alconafta=0;}else{$alconafta=$_POST['txtAlconaftaA'];}
          if  (empty($_POST['txtNafta85'])){$nafta85=0;}else{$nafta85=$_POST['txtNafta85'];}
          if  (empty($_POST['txtNafta90A'])){$nafta90=0;}else{$nafta90=$_POST['txtNafta90A'];}
          if  (empty($_POST['txtNafta95A'])){$nafta95=0;}else{$nafta95=$_POST['txtNafta95A'];}
          if  (empty($_POST['txtKerosene'])){$kerosene=0;}else{$kerosene=$_POST['txtKerosene'];}
          if  (empty($_POST['txtTurboA'])){$turbo=0;}else{$turbo=$_POST['txtTurboA'];}
          if  (empty($_POST['txtAvigasA'])){$avigas=0;}else{$avigas=$_POST['txtAvigasA'];}
          if  (empty($_POST['txtFueloil'])){$fueloil=0;}else{$fueloil=$_POST['txtFueloil'];}
          if  (empty($_POST['txtAlcoholA'])){$alcohol=0;}else{$alcohol=$_POST['txtAlcoholA'];}
          //Datos de Detalle
           if  (empty($_POST['txtPrecinto1'])){$precinto1=0;}else{$precinto1=$_POST['txtPrecinto1'];}
           if  (empty($_POST['txtPrecinto2'])){$precinto2=0;}else{$precinto2=$_POST['txtPrecinto2'];}
           if  (empty($_POST['txtPrecinto3'])){$precinto3=0;}else{$precinto3=$_POST['txtPrecinto3'];}
           if  (empty($_POST['txtPrecinto4'])){$precinto4=0;}else{$precinto4=$_POST['txtPrecinto4'];}
           if  (empty($_POST['txtPrecinto5'])){$precinto5=0;}else{$precinto5=$_POST['txtPrecinto5'];}
           if  (empty($_POST['txtPrecinto6'])){$precinto6=0;}else{$precinto6=$_POST['txtPrecinto6'];}
           if  (empty($_POST['txtPrecinto7'])){$precinto7=0;}else{$precinto7=$_POST['txtPrecinto7'];}
           if  (empty($_POST['txtPrecinto8'])){$precinto8=0;}else{$precinto8=$_POST['txtPrecinto8'];}
           if  (empty($_POST['txtPrecinto9'])){$precinto9=0;}else{$precinto9=$_POST['txtPrecinto9'];}
           if  (empty($_POST['txtPrecinto10'])){$precinto10=0;}else{$precinto10=$_POST['txtPrecinto10'];}
           if  (empty($_POST['txtPrecinto11'])){$precinto11=0;}else{$precinto11=$_POST['txtPrecinto11'];}
           if  (empty($_POST['txtPrecinto12'])){$precinto12=0;}else{$precinto12=$_POST['txtPrecinto12'];}
           if  (empty($_POST['txtPrecinto13'])){$precinto13=0;}else{$precinto13=$_POST['txtPrecinto13'];}
           if  (empty($_POST['txtPrecinto14'])){$precinto14=0;}else{$precinto14=$_POST['txtPrecinto14'];}
           if  (empty($_POST['txtPrecinto15'])){$precinto15=0;}else{$precinto15=$_POST['txtPrecinto15'];}
           if  (empty($_POST['txtPrecinto16'])){$precinto16=0;}else{$precinto16=$_POST['txtPrecinto16'];}
           if  (empty($_POST['txtPrecinto17'])){$precinto17=0;}else{$precinto17=$_POST['txtPrecinto17'];}
           if  (empty($_POST['txtPrecinto18'])){$precinto18=0;}else{$precinto18=$_POST['txtPrecinto18'];}
           if  (empty($_POST['txtPrecinto19'])){$precinto19=0;}else{$precinto19=$_POST['txtPrecinto19'];}
           if  (empty($_POST['txtPrecinto20'])){$precinto20=0;}else{$precinto20=$_POST['txtPrecinto20'];}
           if  (empty($_POST['txtPrecinto21'])){$precinto21=0;}else{$precinto21=$_POST['txtPrecinto21'];}
          
            //variables auxiliares
           $cantidad_precintos=0;
         
          
        
             // si el registro es la pantalla nuevo
    if(isset($_POST['agregar'])){
        
    //Insertamos la cabecera
    $query = "INSERT INTO precintado(prec_nrorem, prec_nrobib, pues_cod, em_cod, cam_cod, 
            prec_gasoil, prec_alconafta, prec_nafta85, prec_nafta95, prec_kerosene, 
            prec_turbo, prec_avigas, prec_fueloil,
            enc_cod, prec_transportista, prec_fecha, prec_alcohol, 
            prec_nafta90, cod_usuario, pre_estado,prec_destino,preci_cod)
    VALUES ($remision, $bibliorato, $puesto_usuario,$emblema, $codigo_camion, 
            $gasoil, $alconafta, $nafta85, $nafta95, $kerosene,
            $turbo, $avigas, $fueloil,
            $codigo_encargado,'$transportista','now()', $alcohol,
            $nafta90, $codusuario,'t','$destino',$codigo_precintador);";
    $ejecucion = pg_query($query)or die('Error al realizar la carga'.$query);
    header("Refresh:0; url=http://<?php echo $ruta;?>/SGP/web/registrar_precintos/registrar_precintos.php");   
    
    //Insertamos los detalles
    $codigo_precintado=obtenerUltimo('precintado','prec_cod');
    //desde aca cargamos los detalles
    if ($precinto1<>''){
        $codigo_precinto=  obtener_codigo_precinto('precinto', 'pre_cod', 'pre_nro', $precinto1,$codigo_precintado);
        $query = "INSERT INTO precintado_detalle(prec_cod, pre_cod, pre_nro, prec_activo)
            VALUES ($codigo_precintado, $codigo_precinto,$precinto1, 't')";
        $ejecucion = pg_query($query)or die('Error al realizar la carga'.$query);
        dar_baja_precinto($codigo_precinto);
        $cantidad_precintos=$cantidad_precintos+1;
    }
     if ($precinto2<>''){
        $codigo_precinto=  obtener_codigo_precinto('precinto', 'pre_cod', 'pre_nro', $precinto2,$codigo_precintado);
        $query = "INSERT INTO precintado_detalle(prec_cod, pre_cod, pre_nro, prec_activo)
            VALUES ($codigo_precintado, $codigo_precinto,$precinto2, 't')";
        $ejecucion = pg_query($query)or die('Error al realizar la carga'.$query);
        dar_baja_precinto($codigo_precinto);
       $cantidad_precintos=$cantidad_precintos+1;
    }
     if ($precinto3<>''){
        $codigo_precinto=  obtener_codigo_precinto('precinto', 'pre_cod', 'pre_nro', $precinto3,$codigo_precintado);
        $query = "INSERT INTO precintado_detalle(prec_cod, pre_cod, pre_nro, prec_activo)
            VALUES ($codigo_precintado, $codigo_precinto,$precinto3, 't')";
        $ejecucion = pg_query($query)or die('Error al realizar la carga'.$query);
        dar_baja_precinto($codigo_precinto);
       $cantidad_precintos=$cantidad_precintos+1;
    }
     if ($precinto4<>''){
        $codigo_precinto=  obtener_codigo_precinto('precinto', 'pre_cod', 'pre_nro', $precinto4,$codigo_precintado);
        $query = "INSERT INTO precintado_detalle(prec_cod, pre_cod, pre_nro, prec_activo)
            VALUES ($codigo_precintado, $codigo_precinto,$precinto4, 't')";
        $ejecucion = pg_query($query)or die('Error al realizar la carga'.$query);
        dar_baja_precinto($codigo_precinto);
       $cantidad_precintos=$cantidad_precintos+1;
    }
     if ($precinto5<>''){
        $codigo_precinto=  obtener_codigo_precinto('precinto', 'pre_cod', 'pre_nro', $precinto5,$codigo_precintado);
        $query = "INSERT INTO precintado_detalle(prec_cod, pre_cod, pre_nro, prec_activo)
            VALUES ($codigo_precintado, $codigo_precinto,$precinto5, 't')";
        $ejecucion = pg_query($query)or die('Error al realizar la carga'.$query);
        dar_baja_precinto($codigo_precinto);
       $cantidad_precintos=$cantidad_precintos+1;
    }
     if ($precinto6<>''){
        $codigo_precinto=  obtener_codigo_precinto('precinto', 'pre_cod', 'pre_nro', $precinto6,$codigo_precintado);
        $query = "INSERT INTO precintado_detalle(prec_cod, pre_cod, pre_nro, prec_activo)
            VALUES ($codigo_precintado, $codigo_precinto,$precinto6, 't')";
        $ejecucion = pg_query($query)or die('Error al realizar la carga'.$query);
        dar_baja_precinto($codigo_precinto);
       $cantidad_precintos=$cantidad_precintos+1;
    }
     if ($precinto7<>''){
        $codigo_precinto=  obtener_codigo_precinto('precinto', 'pre_cod', 'pre_nro', $precinto7,$codigo_precintado);
        $query = "INSERT INTO precintado_detalle(prec_cod, pre_cod, pre_nro, prec_activo)
            VALUES ($codigo_precintado, $codigo_precinto,$precinto7, 't')";
        $ejecucion = pg_query($query)or die('Error al realizar la carga'.$query);
        dar_baja_precinto($codigo_precinto);
       $cantidad_precintos=$cantidad_precintos+1;
    }
     if ($precinto8<>''){
        $codigo_precinto=  obtener_codigo_precinto('precinto', 'pre_cod', 'pre_nro', $precinto8,$codigo_precintado);
        $query = "INSERT INTO precintado_detalle(prec_cod, pre_cod, pre_nro, prec_activo)
            VALUES ($codigo_precintado, $codigo_precinto,$precinto8, 't')";
        $ejecucion = pg_query($query)or die('Error al realizar la carga'.$query);
        dar_baja_precinto($codigo_precinto);
       $cantidad_precintos=$cantidad_precintos+1;
    }
     if ($precinto9<>''){
        $codigo_precinto=  obtener_codigo_precinto('precinto', 'pre_cod', 'pre_nro', $precinto9,$codigo_precintado);
        $query = "INSERT INTO precintado_detalle(prec_cod, pre_cod, pre_nro, prec_activo)
            VALUES ($codigo_precintado, $codigo_precinto,$precinto9, 't')";
        $ejecucion = pg_query($query)or die('Error al realizar la carga'.$query);
        dar_baja_precinto($codigo_precinto);
       $cantidad_precintos=$cantidad_precintos+1;
    }
     if ($precinto10<>''){
        $codigo_precinto=  obtener_codigo_precinto('precinto', 'pre_cod', 'pre_nro', $precinto10,$codigo_precintado);
        $query = "INSERT INTO precintado_detalle(prec_cod, pre_cod, pre_nro, prec_activo)
            VALUES ($codigo_precintado, $codigo_precinto,$precinto10, 't')";
        $ejecucion = pg_query($query)or die('Error al realizar la carga'.$query);
        dar_baja_precinto($codigo_precinto);
       $cantidad_precintos=$cantidad_precintos+1;
    }
     if ($precinto11<>''){
        $codigo_precinto=  obtener_codigo_precinto('precinto', 'pre_cod', 'pre_nro', $precinto11,$codigo_precintado);
        $query = "INSERT INTO precintado_detalle(prec_cod, pre_cod, pre_nro, prec_activo)
            VALUES ($codigo_precintado, $codigo_precinto,$precinto11, 't')";
        $ejecucion = pg_query($query)or die('Error al realizar la carga'.$query);
        dar_baja_precinto($codigo_precinto);
       $cantidad_precintos=$cantidad_precintos+1;
    }
     if ($precinto12<>''){
        $codigo_precinto=  obtener_codigo_precinto('precinto', 'pre_cod', 'pre_nro', $precinto12,$codigo_precintado);
        $query = "INSERT INTO precintado_detalle(prec_cod, pre_cod, pre_nro, prec_activo)
            VALUES ($codigo_precintado, $codigo_precinto,$precinto12, 't')";
        $ejecucion = pg_query($query)or die('Error al realizar la carga'.$query);
        dar_baja_precinto($codigo_precinto);
       $cantidad_precintos=$cantidad_precintos+1;
    }
     if ($precinto13<>''){
        $codigo_precinto=  obtener_codigo_precinto('precinto', 'pre_cod', 'pre_nro', $precinto13,$codigo_precintado);
        $query = "INSERT INTO precintado_detalle(prec_cod, pre_cod, pre_nro, prec_activo)
            VALUES ($codigo_precintado, $codigo_precinto,$precinto13, 't')";
        $ejecucion = pg_query($query)or die('Error al realizar la carga'.$query);
        dar_baja_precinto($codigo_precinto);
       $cantidad_precintos=$cantidad_precintos+1;
    }
     if ($precinto14<>''){
        $codigo_precinto=  obtener_codigo_precinto('precinto', 'pre_cod', 'pre_nro', $precinto14,$codigo_precintado);
        $query = "INSERT INTO precintado_detalle(prec_cod, pre_cod, pre_nro, prec_activo)
            VALUES ($codigo_precintado, $codigo_precinto,$precinto14, 't')";
        $ejecucion = pg_query($query)or die('Error al realizar la carga'.$query);
        dar_baja_precinto($codigo_precinto);
       $cantidad_precintos=$cantidad_precintos+1;
    }
     if ($precinto15<>''){
        $codigo_precinto=  obtener_codigo_precinto('precinto', 'pre_cod', 'pre_nro', $precinto15,$codigo_precintado);
        $query = "INSERT INTO precintado_detalle(prec_cod, pre_cod, pre_nro, prec_activo)
            VALUES ($codigo_precintado, $codigo_precinto,$precinto15, 't')";
        $ejecucion = pg_query($query)or die('Error al realizar la carga'.$query);
        dar_baja_precinto($codigo_precinto);
       $cantidad_precintos=$cantidad_precintos+1;
    }
     if ($precinto16<>''){
        $codigo_precinto=  obtener_codigo_precinto('precinto', 'pre_cod', 'pre_nro', $precinto16,$codigo_precintado);
        $query = "INSERT INTO precintado_detalle(prec_cod, pre_cod, pre_nro, prec_activo)
            VALUES ($codigo_precintado, $codigo_precinto,$precinto16, 't')";
        $ejecucion = pg_query($query)or die('Error al realizar la carga'.$query);
        dar_baja_precinto($codigo_precinto);
       $cantidad_precintos=$cantidad_precintos+1;
    }
     if ($precinto17<>''){
        $codigo_precinto=  obtener_codigo_precinto('precinto', 'pre_cod', 'pre_nro', $precinto17,$codigo_precintado);
        $query = "INSERT INTO precintado_detalle(prec_cod, pre_cod, pre_nro, prec_activo)
            VALUES ($codigo_precintado, $codigo_precinto,$precinto17, 't')";
        $ejecucion = pg_query($query)or die('Error al realizar la carga'.$query);
        dar_baja_precinto($codigo_precinto);
       $cantidad_precintos=$cantidad_precintos+1;
    }
     if ($precinto18<>''){
        $codigo_precinto=  obtener_codigo_precinto('precinto', 'pre_cod', 'pre_nro', $precinto18,$codigo_precintado);
        $query = "INSERT INTO precintado_detalle(prec_cod, pre_cod, pre_nro, prec_activo)
            VALUES ($codigo_precintado, $codigo_precinto,$precinto18, 't')";
        $ejecucion = pg_query($query)or die('Error al realizar la carga'.$query);
        dar_baja_precinto($codigo_precinto);
       $cantidad_precintos=$cantidad_precintos+1;
    }
     if ($precinto19<>''){
        $codigo_precinto=  obtener_codigo_precinto('precinto', 'pre_cod', 'pre_nro', $precinto19,$codigo_precintado);
        $query = "INSERT INTO precintado_detalle(prec_cod, pre_cod, pre_nro, prec_activo)
            VALUES ($codigo_precintado, $codigo_precinto,$precinto19, 't')";
        $ejecucion = pg_query($query)or die('Error al realizar la carga'.$query);
        dar_baja_precinto($codigo_precinto);
       $cantidad_precintos=$cantidad_precintos+1;
    }
     if ($precinto20<>''){
        $codigo_precinto=  obtener_codigo_precinto('precinto', 'pre_cod', 'pre_nro', $precinto20,$codigo_precintado);
        $query = "INSERT INTO precintado_detalle(prec_cod, pre_cod, pre_nro, prec_activo)
            VALUES ($codigo_precintado, $codigo_precinto,$precinto20, 't')";
        $ejecucion = pg_query($query)or die('Error al realizar la carga'.$query);
        dar_baja_precinto($codigo_precinto);
       $cantidad_precintos=$cantidad_precintos+1;
    }
     if ($precinto21<>''){
        $codigo_precinto=  obtener_codigo_precinto('precinto', 'pre_cod', 'pre_nro', $precinto21,$codigo_precintado);
        $query = "INSERT INTO precintado_detalle(prec_cod, pre_cod, pre_nro, prec_activo)
            VALUES ($codigo_precintado, $codigo_precinto,$precinto21, 't')";
        $ejecucion = pg_query($query)or die('Error al realizar la carga'.$query);
        dar_baja_precinto($codigo_precinto);
       $cantidad_precintos=$cantidad_precintos+1;
    }
    //actualizar datos de cabeceras
     $query = "update precintado set prec_cantprecinto=$cantidad_precintos where prec_cod=$codigo_precintado";
     pg_query($query)or die('Error al realizar la carga. Error: '.$query);
     //traer el precio activo
     $query = "select precio1,precio2,precio3 from precios where pre_activo='t'";
     $resultados=pg_query($query)or die('Error al realizar la carga. Error: '.$query);
     $row1 = pg_fetch_array($resultados);
     $precio1=$row1[0];
     $precio2=$row1[1];
     $precio3=$row1[2];
     if ($cantidad_precintos <= 7)
     {
        $query = "update precintado set prec_precio=$precio1 where prec_cod=$codigo_precintado";
        pg_query($query)or die('Error al realizar la carga. Error: '.$query);
     }else if($cantidad_precintos > 7 and $cantidad_precintos <= 12)
     {
        $query = "update precintado set prec_precio=$precio2 where prec_cod=$codigo_precintado";
        pg_query($query)or die('Error al realizar la carga. Error: '.$query);  
     }else if ( $cantidad_precintos > 12)
     {
        $query = "update precintado set prec_precio=$precio3 where prec_cod=$codigo_precintado";
        pg_query($query)or die('Error al realizar la carga. Error: '.$query); 
     }
    //preparar para la impresion del registro de precintado
    header("Refresh:0; url=http://<?php echo $ruta;?>/SGP/web/informes/Imp_registro_impresion.php?codigo_precintado=$codigo_precintado");
    }
          
       
    ?>
