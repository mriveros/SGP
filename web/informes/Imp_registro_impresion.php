<?php
session_start();$ruta=$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT']."/web";
require('./fpdf.php');
include '../MonedaTexto.php';
class PDF extends FPDF{
    
function Footer()
{
	/*$this->SetDrawColor(0,0,0);
	$this->SetLineWidth(.2);
	$this->Line(230,280,9,280);//largor,ubicacion derecha,inicio,ubicacion izquierda
        // Go to 1.5 cm from bottom
        $this->SetY(-15);
        // Select Arial italic 8
        $this->SetFont('Arial','I',8);
        // Print centered page number
	$this->Cell(0,2,utf8_decode('Página: ').$this->PageNo().' de {nb}',0,0,'R');
	$this->text(10,283,'Datos Generados en: '.date('d-M-Y').' '.date('h:i:s'));
          */
         
}
function Header()
{
   // Select Arial bold 15
    $this->SetFont('Arial','',12);
    $this->Image('img/intn.jpg',10,14,-300,0,'','../../InformeCargos.php');
    // Move to the right
    $this->Cell(80);
    // Framed title
    $this->text(45,19,utf8_decode('Instituto Nacional de Tecnología, Normalización y Metrología'));
    $this->SetFont('Arial','',8);
    $this->text(80,24,utf8_decode("Organismo Nacional de Metrología"));
    $this->text(75,29,utf8_decode("Programa Precintado de Camiones Cisterna"));
    $this->text(84,34,utf8_decode("Nota de Remisión de Precintos"));
    $this->text(95,38,"F-PP-001");
        $this->Ln(30);
        $this->Ln(30);
	$this->SetDrawColor(0,0,0);
	$this->SetLineWidth(.2);
	$this->Line(200,40,10,40);//largor,ubicacion derecha,inicio,ubicacion izquierda
    //------------------------RECIBIMOS LOS VALORES DE GET-----------
    
    //$codigo_precintado=obtenerUltimo('precintado','prec_cod');
    
    $conectate=pg_connect("host=localhost port=5432 dbname=SGP user=postgres password=postgres"
                    . "")or die ('Error al conectar a la base de datos');
    $query = pg_query("select max(prec_cod) from precintado");
    $row1 = pg_fetch_array($query);
    $codigo_precintado=$row1[0];
    $consulta=pg_exec($conectate,"select pre.prec_cod,pre.prec_nrorem,pre.prec_nrobib,pues.pues_des,pre.prec_fecha,em.em_nom,pre.cam_cod,
        pre.prec_destino,pre.prec_cantprecinto,
        trunc(pre.prec_gasoil) as prec_gasoil ,
        trunc(pre.prec_alconafta) as prec_alconafta ,
        trunc(pre.prec_nafta85) as prec_nafta85,
        trunc(pre.prec_nafta95) as prec_nafta95,
        trunc(pre.prec_kerosene) as prec_kerosene,
        trunc(pre.prec_turbo) as prec_turbo,
        trunc(pre.prec_avigas) as prec_avigas,
	trunc(pre.prec_fueloil) as prec_fueloil,
        pre.prec_transportista,pre.prec_destino,pre.prec_cantprecinto,
        preci.pre_nom ||' ' ||preci.pre_ape as precintador,usu.usu_nom ||' ' ||usu.usu_ape as encargado
        from precintado pre, emblemas em, puestos pues, precintador preci,usuarios usu
        where pre.pues_cod=pues.pues_cod
        and pre.em_cod=em.em_cod
        and pre.cod_usuario=usu.usu_cod
        and pre.preci_cod=preci.pre_cod
        and pre.prec_cod=$codigo_precintado");
    $row1 = pg_fetch_array($consulta);
    $puesto=$row1['pues_des'];
    $fecha=$row1['prec_fecha'];
    $emblema=$row1['em_nom'];
    $codigo_camion=$row1['cam_cod'];
    $destino=$row1['prec_destino'];
    $gasoil=$row1['prec_gasoil'];
    $alconafta=$row1['prec_alconafta'];
    $nafta85=$row1['prec_nafta85'];
    $nafta95=$row1['prec_nafta95'];
    $kerosene=$row1['prec_kerosene'];
    $turbo=$row1['prec_turbo'];
    $avigas=$row1['prec_avigas'];
    $fueloil=$row1['prec_fueloil'];
    $transportista=$row1['prec_transportista'];
    $destino=$row1['prec_destino'];
    $cantidad=$row1['prec_cantprecinto'];
    $letra_cantidad=get_CantidadLetras($cantidad);
    $precintador=$row1['precintador'];
    $encargado=$row1['encargado'];
    $nro_remision=$row1['prec_nrorem'];
    $nro_bibliorato=$row1['prec_nrobib'];
    
    //Obtener color precintado--------------------------------------------------
    $consulta=pg_exec($conectate,"select max(col.col_des)as color 
        from precintado prec, precinto pre,color col,remisiones rem, entrega en,precintado_detalle predet
        where rem.rem_cod=en.rem_cod
	and rem.col_cod=col.col_cod
	and en.en_cod=pre.en_cod
	and prec.prec_cod=predet.prec_cod
	and pre.pre_cod=predet.pre_cod
        and prec.prec_cod=$codigo_precintado");
    $row1 = pg_fetch_array($consulta);
    $color=$row1['color'];
    //table header CABECERA        
    $this->SetFont('Arial','',10);
    $this->SetTitle('Precintado');
    //---------------------Encabezado Izquierda--------------------------------
    $this->text(12,45,'Lugar de Precintado:');
    $this->text(47,45,$puesto);
    $this->text(12,50,utf8_decode('Emblema del Camión:'));
    $this->text(50,50,$emblema);
    $this->text(12,55,utf8_decode('Transportista:'));
    $this->text(35,55,$transportista);
    $this->text(12,60,utf8_decode('Estacion de Servicio destino de la carga:'));
     $this->text(80,60,$destino);
    //---------------------Encabezado Derecha--------------------------------
    $this->text(130,45,'Fecha:');//Titulo
    $this->text(143,45,$fecha);
    $this->text(130,50,utf8_decode('Código de Camión Cisterna:'));
    $this->text(175,50,$codigo_camion);
    $this->text(130,55,utf8_decode('Nro. Remisión:'));
    $this->text(155,55,$nro_remision);
    //$this->text(130,60,utf8_decode('Nro. Bibliorato:'));
    //$this->text(155,60,$nro_bibliorato);
    //-----------------------Datos Adjuntos-----------------------------------
    $this->Line(200,65,10,65);//largor,ubicacion derecha,inicio,ubicacion izquierda
    $this->Line(10,65,10,40);//largor,ubicacion derecha,inicio,ubicacion izquierda
    $this->Line(200,65,200,40);//largor,ubicacion derecha,inicio,ubicacion izquierda
    $this->SetFont('Arial','B',10);
    $this->text(60,69,'Datos Proporcionados por el transportista');
    $this->SetFont('Arial','',10);
    $this->text(10,73,'Producto');//Columna 1
    $this->text(50,73,'Cantidad');//Columna 2
    $this->text(110,73,'Producto');//Columna 3
    $this->text(150,73,'Cantidad');//Columna 4
    $this->text(10,78,'Gasoil:');
    $this->text(10,83,'Alconafta:');
    $this->text(10,88,'Nafta 85:');
    $this->text(10,98,'Nafta 95:');
    $this->text(50,78,$gasoil);
    $this->text(50,83,$alconafta);
    $this->text(50,88,$nafta85);
    $this->text(50,98,$nafta95);
    $this->text(110,78,'Kerosene:');
    $this->text(110,83,'Turbo:');
    $this->text(110,88,'Avigas:');
    $this->text(110,93,'Fuel-Oil:');
    $this->text(150,78,$kerosene);
    $this->text(150,83, $turbo);
    $this->text(150,88,$avigas);
    $this->text(150,93,$fueloil);
    $this->Line(200,100,10,100);//largor,ubicacion derecha,inicio,ubicacion izquierda
    
    $this->text(10,105  ,'Precintos aplicados al camion cisterna. Cantidad: '.$cantidad);
    $this->text(105,105,'('.$letra_cantidad.')');
    $this->text(145,105,'Color: '.$color);
    $this->Line(160,40,10,40);//largor,ubicacion derecha,inicio,ubicacion izquierda
    $this->text(10,180,'------------------------------ ');
    $this->text(80,180,'------------------------------ ');
    $this->text(160,180,'------------------------------ ');
    $this->SetFont('Arial','',8);
    $this->text(15,183,'Firma Precintador');
    $this->text(82,183,'Firma Encargado INTN');
    $this->text(165,183,'Firma Transportista');
    $this->text(10,189,utf8_decode('Aclaración: '.$precintador.''));
    $this->text(80,189,utf8_decode('Aclaración: '.$encargado.''));
    $this->text(160,189,utf8_decode('Aclaración: '.$transportista.''));
    }
}

$pdf= new PDF();//'P'=vertical o 'L'=horizontal,'mm','A4' o 'Legal'
$pdf->AddPage();

 
//------------------------QUERY and data cargue y se reciben los datos-----------
$conectate=pg_connect("host=localhost port=5432 dbname=SGP user=postgres password=postgres"
                    . "")or die ('Error al conectar a la base de datos');
$query = pg_query("select max(prec_cod) from precintado");
$row1 = pg_fetch_array($query);
$codigo_precintado=$row1[0];
$consulta=pg_exec("select pre_nro from precintado_detalle where prec_cod=$codigo_precintado");

$precinto1=  pg_result($consulta,0,'pre_nro');
$precinto2=pg_result($consulta,1,'pre_nro');
$precinto3=pg_result($consulta,2,'pre_nro');
$precinto4=pg_result($consulta,3,'pre_nro');
$precinto5=pg_result($consulta,4,'pre_nro');
$precinto6=pg_result($consulta,5,'pre_nro');
$precinto7=pg_result($consulta,6,'pre_nro');
$precinto8=pg_result($consulta,7,'pre_nro');
$precinto9=pg_result($consulta,8,'pre_nro');
$precinto10=pg_result($consulta,9,'pre_nro');
$precinto11=pg_result($consulta,10,'pre_nro');
$precinto12=pg_result($consulta,11,'pre_nro');
$precinto13=pg_result($consulta,12,'pre_nro');
$precinto14=pg_result($consulta,13,'pre_nro');
$precinto15=pg_result($consulta,14,'pre_nro');
$precinto16=pg_result($consulta,15,'pre_nro');
$precinto17=pg_result($consulta,16,'pre_nro');
$precinto18=pg_result($consulta,17,'pre_nro');
$precinto19=pg_result($consulta,18,'pre_nro');
$precinto20=pg_result($consulta,19,'pre_nro');
$precinto21=pg_result($consulta,20,'pre_nro');
$pdf->AliasNbPages();
$pdf->SetFont('Arial','B',8);
$pdf->SetFillColor(224,235,255);
$pdf->SetTextColor(0);
   
//----------------------------Build table---------------------------------------
$pdf->SetXY(10,112 );
$pdf->Cell(25,7,'Compart. 1',1,0,'C',10);
$pdf->Cell(25,7,'Compart. 2',1,0,'C',50);
$pdf->Cell(25,7,'Compart. 3',1,0,'C',50);
$pdf->Cell(25,7,'Compart. 4',1,0,'C',50);
$pdf->Cell(25,7,'Compart. 5',1,0,'C',50);
$pdf->Cell(25,7,'Compart. 6',1,0,'C',50);
$pdf->Cell(25,7,'Compart. 7',1,1,'C',50);
$pdf->Cell(25,7,$precinto1,1,0,'C',10);
$pdf->Cell(25,7,$precinto2,1,0,'C',50);
$pdf->Cell(25,7,$precinto3,1,0,'C',50);
$pdf->Cell(25,7,$precinto4,1,0,'C',50);
$pdf->Cell(25,7,$precinto5,1,0,'C',50);
$pdf->Cell(25,7,$precinto6,1,0,'C',50);
$pdf->Cell(25,7,$precinto7,1,1,'C',50);
$pdf->Cell(25,7,$precinto8,1,0,'C',10);
$pdf->Cell(25,7,$precinto9,1,0,'C',50);
$pdf->Cell(25,7,$precinto10,1,0,'C',50);
$pdf->Cell(25,7,$precinto11,1,0,'C',50);
$pdf->Cell(25,7,$precinto12,1,0,'C',50);
$pdf->Cell(25,7,$precinto13,1,0,'C',50);
$pdf->Cell(25,7,$precinto14,1,1,'C',50);
$pdf->Cell(25,7,$precinto15,1,0,'C',10);
$pdf->Cell(25,7,$precinto16,1,0,'C',50);
$pdf->Cell(25,7,$precinto17,1,0,'C',50);
$pdf->Cell(25,7,$precinto18,1,0,'C',50);
$pdf->Cell(25,7,$precinto19,1,0,'C',50);
$pdf->Cell(25,7,$precinto20,1,0,'C',50);
$pdf->Cell(25,7,$precinto21,1,1,'C',50);

$fill=false;
$i=0;
$pdf->SetFont('Arial','',10);




$pdf->SetFont('Arial','B',10);
$pdf->text(10,146,'Declaramos');
$pdf->SetFont('Arial','',10);
$pdf->text(30,146,utf8_decode('nuestra conformidad en relación a los datos que anteceden asi como de la correcta aplicación de los precintos'));
$pdf->text(10,150,utf8_decode('de las bocas de carga y descarga cuyos numeros se citan en esta Nota de Remisión de Precintos.'));
$pdf->text(10,154,utf8_decode('El chofer transportista es responsable de la devolución en buenas condiciones del total de los precintos utilizados'));
$pdf->text(10,158,utf8_decode('y la nota de Remisión de Precintos. '));
$pdf->SetFont('Arial','B',10);
$pdf->text(68,158,utf8_decode('No volverá a cargar si no devuelve conforme o si tuviere observaciones de la '));
$pdf->text(10,162,utf8_decode('Estacion de Servicios. No se premitirá enmienda en los números de precintos. '));
$pdf->SetFont('Arial','',10);
$pdf->text(10,166,utf8_decode('Para la nueva carga debe pasar por el INTN para la solución del inconveniente presentado conforme las disposiciones al'));
$pdf->text(10,170,utf8_decode('respecto.'));

//-------------------------TEXTO  DE OBSERVACION--------------------------------------


$pdf->SetFont('Arial','B',10);
$pdf->text(10,197,'OBSERVACION:');
$pdf->SetFont('Arial','',10);
$pdf->text(39,197,'.................................................................................................................................................................');
$pdf->SetFont('Arial','B',10);
$pdf->text(10,203,utf8_decode('Controles en la estación de Servicio: '));
$pdf->SetFont('Arial','',10);
$pdf->text(73,203,'Antes de proceder a la descarga del combustible transportado y en presencia ');
$pdf->text(10,207,'del transportista, el Operador de la Estacion de Servicio debe:');
$pdf->text(10,211,utf8_decode('1. Verificar si las medidas marcadas en el dispositivo de referencia del camión cisterna corresponden a las anotadas'));
$pdf->text(10,215,utf8_decode('en el respectivo certificado de verificación de camiones tanque.'));
$pdf->text(10,219,utf8_decode('2. Verificar la correcta aplicación de los precintos cuyos números se hallan anotados en esta Nota de Remisión.'));
$pdf->text(10,223,utf8_decode('3. Cortar las cuerdas de amarre para devolver los precintos en buenas condiciones con ésta Nota de Remisión, por '));
$pdf->text(10,227,utf8_decode('intermedio del chofer transportista, a los funcionarios del INTN destacados en las oficinas correspondientes.'));
$pdf->text(10,231,utf8_decode('4. Verificar los niveles de combustible de cada compartimietno por medio de l dispositivo de referencia.'));
$pdf->text(10,235,utf8_decode('Nota: La estación de servicio a través del operador es responsable del cumplimineto de los ítems arriba citados.'));
$pdf->SetFont('Arial','B',10);
$pdf->text(40,239,utf8_decode('Conformidad del Operador Receptor del Combustible por cada Compartimento'));
$pdf->SetFont('Arial','',8);
$pdf->SetXY(10,240);
$pdf->Cell(25,7,'Compart. 1',1,0,'C',10);
$pdf->Cell(25,7,'Compart. 2',1,0,'C',50);
$pdf->Cell(25,7,'Compart. 3',1,0,'C',50);
$pdf->Cell(25,7,'Compart. 4',1,0,'C',50);
$pdf->Cell(25,7,'Compart. 5',1,0,'C',50);
$pdf->Cell(25,7,'Compart. 6',1,0,'C',50);
$pdf->Cell(25,7,'Compart. 7',1,1,'C',50);
$pdf->Cell(25,20,'',1,0,'C',10);
$pdf->Cell(25,20,'',1,0,'C',50);
$pdf->Cell(25,20,'',1,0,'C',50);
$pdf->Cell(25,20,'',1,0,'C',50);
$pdf->Cell(25,20,'',1,0,'C',50);
$pdf->Cell(25,20,'',1,0,'C',50);
$pdf->Cell(25,20,'',1,1,'C',50);
//---------------------------Ultima parte---------------------------------------
$pdf->text(10,270,utf8_decode('La conformidad debe ser hecha mediante firma, aclaración, fecha y sello de la Estación de Servicios. En caso que hubiese'));
$pdf->text(10,273,utf8_decode('observaciones se pueden ampliar abajo.'));
$pdf->SetFont('Arial','B',10);
$pdf->text(10,278,utf8_decode('OBSERVACIÓN:'));
$pdf->SetFont('Arial','',10);
$pdf->text(40,278,'....................................................................................................................................................');
$pdf->text(10,282,'..................................................................................................................................................................................');
$pdf->text(10,286,'..................................................................................................................................................................................');
$pdf->Output("Precintado_".$codigo_precintado,"I");
$pdf->Close();

  function get_CantidadLetras($m) { 
        switch ($m) { 
         case '1': $cant_text = "Uno"; break; 
         case '2': $cant_text = "Dos"; break; 
         case '3': $cant_text = "Tres"; break; 
         case '4': $cant_text = "Cuatro"; break; 
         case '5': $cant_text = "Cinco"; break; 
         case '6': $cant_text = "Seis"; break; 
         case '7': $cant_text = "Siete"; break; 
         case '8': $cant_text = "Ocho"; break; 
         case '9': $cant_text = "Nueve"; break; 
         case '10': $cant_text = "Diez"; break; 
         case '11': $cant_text = "Once"; break; 
         case '12': $cant_text = "Doce"; break;
         case '13': $cant_text = "Trece"; break; 
         case '14': $cant_text = "Catorce"; break; 
         case '15': $cant_text = "Quince"; break; 
         case '16': $cant_text = "Dieciseis"; break; 
         case '17': $cant_text = "Diecisiete"; break; 
         case '18': $cant_text = "Dieciocho"; break; 
         case '19': $cant_text = "Diecinueve"; break; 
         case '20': $cant_text = "Veinte"; break; 
         case '21': $cant_text = "Veintiuno"; break; 
        } 
        return ($cant_text); 
       } 
