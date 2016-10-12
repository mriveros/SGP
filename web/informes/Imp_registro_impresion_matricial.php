<?php
session_start();$ruta=$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT']."";
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
        $this->SetFont('Arial','I',10);
        // Print centered page number
	$this->Cell(0,2,utf8_decode('Página: ').$this->PageNo().' de {nb}',0,0,'R');
	$this->text(10,283,'Datos Generados en: '.date('d-M-Y').' '.date('h:i:s'));
          */
         
}
function Header()
{
   // Select Arial bold 15
   //------------------------RECIBIMOS LOS VALORES DE GET-----------
    
    //$codigo_precintado=obtenerUltimo('precintado','prec_cod');
    
    $conectate=pg_connect("host=localhost port=5432 dbname=SGP user=postgres password=postgres"
                    . "")or die ('Error al conectar a la base de datos');
    $query = pg_query("select max(prec_cod) from precintado");
    $row1 = pg_fetch_array($query);
    $codigo_precintado=$row1[0];
    $consulta=pg_exec($conectate,"select pre.prec_cod,pre.prec_nrorem,pre.prec_nrobib,pues.pues_des,pre.prec_fecha,em.em_nom,pre.cam_cod,
        pre.prec_destino,pre.prec_cantprecinto,pre.prec_gasoil,pre.prec_alconafta,pre.prec_nafta85,
        pre.prec_nafta95,pre.prec_kerosene,pre.prec_turbo,pre.prec_avigas,pre.prec_fueloil,
        pre.prec_alcohol,pre.prec_nafta90,pre.prec_transportista,pre.prec_destino,pre.prec_cantprecinto,
        preci.pre_nom ||' ' ||preci.pre_ape as precintador,enc.en_nom ||' ' ||enc.en_ape as encargado
        from precintado pre, emblemas em, puestos pues, encargado enc,precintador preci
        where pre.pues_cod=pues.pues_cod
        and pre.em_cod=em.em_cod
        and pre.enc_cod=enc.en_cod
        and pre.preci_cod=preci.pre_cod
        and pre.prec_cod=26");
    $row1 = pg_fetch_array($consulta);
    $puesto=$row1['pues_des'];
    $fecha=$row1['prec_fecha'];
    $emblema=$row1['em_nom'];
    $codigo_camion=$row1['cam_cod'];
    $destino=$row1['prec_destino'];
    $gasoil=$row1['prec_gasoil'];
    $alconafta=$row1['prec_alconafta'];
    $nafta85=$row1['prec_nafta85'];
    $nafta90=$row1['prec_nafta90'];
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
    //table header CABECERA        
    $this->SetFont('Arial','',12);
    $this->SetTitle('Precintado');
    //---------------------Encabezado Izquierda--------------------------------
   
    $this->text(64,36,$puesto);
    
    $this->text(64,41,$emblema);
   
    //$this->text(35,55,$transportista);
    
     $this->text(89,52,$destino);
    //---------------------Encabezado Derecha--------------------------------
   
    $this->text(140,36,$fecha);
   
    $this->text(168,41,$codigo_camion);
    
    //$this->text(155,55,$nro_remision);
    //$this->text(130,60,utf8_decode('Nro. Bibliorato:'));
    //$this->text(155,60,$nro_bibliorato);
    //-----------------------Datos Adjuntos-----------------------------------
   
    $this->SetFont('Arial','B',9);
    
    $this->text(58,62,$gasoil);
    $this->text(58,66,$alconafta);
    $this->text(58,70,$nafta85);
    $this->text(58,74,$nafta95);
    $this->text(31,78,'Nafta 90: ');
    $this->text(58,78,$nafta90);
    $this->text(145,62,$kerosene);
    $this->text(145,66,$turbo);
    $this->text(145,70,$avigas);
    $this->text(145,74,$fueloil);

    
    $this->text(113,83  ,' '.$cantidad);
    $this->text(128,83,$letra_cantidad);
    
   

    $this->SetFont('Arial','',10);
   
    $this->text(48,153,utf8_decode($precintador));
    $this->text(110,153,utf8_decode($encargado));
    $this->text(170,153,utf8_decode($transportista));
    }
}

$pdf= new PDF('P','mm','Legal');//'P'=vertical o 'L'=horizontal,'mm','A4' o 'Legal'
$pdf->AddPage();

 
//------------------------QUERY and data cargue y se reciben los datos-----------
$conectate=pg_connect("host=localhost port=5432 dbname=SGP user=postgres password=postgres"
                    . "")or die ('Error al conectar a la base de datos');
$query = pg_query("select max(prec_cod) from precintado");
$row1 = pg_fetch_array($query);
$codigo_precintado=$row1[0];
$consulta=pg_exec("select pre_nro from precintado_detalle where prec_cod=26");

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
$pdf->SetFont('Arial','B',12);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0);
   
//----------------------------Build table---------------------------------------
$pdf->SetXY(10,112 );
$pdf->text(33,93,$precinto1);
$pdf->text(33,99,$precinto2);
$pdf->text(33,105,$precinto3);
$pdf->text(59,93,$precinto4);
$pdf->text(59,99,$precinto5);
$pdf->text(59,105,$precinto6);
$pdf->text(86,93,$precinto7);
$pdf->text(86,99,$precinto8);
$pdf->text(86,105,$precinto9);
$pdf->text(111,93,$precinto10);
$pdf->text(111,99,$precinto11);
$pdf->text(111,105,$precinto12);
$pdf->text(138,93,$precinto13);
$pdf->text(138,99,$precinto14);
$pdf->text(138,105,$precinto15);
$pdf->text(166,93,$precinto16);
$pdf->text(166,99,$precinto17);
$pdf->text(166,105,$precinto18);
$pdf->text(194,93,$precinto19);
$pdf->text(194,99,$precinto20);
$pdf->text(194,105,$precinto21);

$fill=false;
$i=0;
$pdf->SetFont('Arial','',10);





//-------------------------TEXTO  DE OBSERVACION--------------------------------------



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
