<?php
session_start();
require('./fpdf.php');
include '../MonedaTexto.php';
class PDF extends FPDF{
    
function Footer()
{
	$this->SetDrawColor(0,0,0);
	$this->SetLineWidth(.2);
	$this->Line(230,280,9,280);//largor,ubicacion derecha,inicio,ubicacion izquierda
    // Go to 1.5 cm from bottom
        $this->SetY(-15);
    // Select Arial italic 8
        $this->SetFont('Arial','I',8);
    // Print centered page number
	$this->Cell(0,2,utf8_decode('Página: ').$this->PageNo().' de {nb}',0,0,'R');
	$this->text(10,283,'Datos Generados en: '.date('d-M-Y').' '.date('h:i:s'));
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
    //-----------------------TRAEMOS LOS DATOS DE CABECERA-----
   
    //---------------------------------------------------------
        $this->Ln(30);
        $this->Ln(30);
	$this->SetDrawColor(0,0,0);
	$this->SetLineWidth(.2);
	$this->Line(200,40,10,40);//largor,ubicacion derecha,inicio,ubicacion izquierda
    //------------------------RECIBIMOS LOS VALORES DE POST-----------
    
    if  (empty($_POST['txtCodigoA'])){$codPago='';}else{ $codPago = $_POST['txtCodigoA'];}
    
    $conectate=pg_connect("host=localhost port=5432 dbname=precintos user=postgres password=postgres"
                    . "")or die ('Error al conectar a la base de datos');
    $consulta=pg_exec($conectate,"");
    $numregs=pg_numrows($consulta);
 
    $nombreProveedor=pg_result($consulta,0,'proveedor');
    $proveedor=pg_result($consulta,0,'pro_razon');
    $ruc=pg_result($consulta,0,'pro_ruc');
    $direccion=pg_result($consulta,0,'pro_dir');
    $banco=pg_result($consulta,0,'ban_nom');
    $cuenta=pg_result($consulta,0,'cuen_nom');
    $cheque=pg_result($consulta,0,'pag_cheque');
    $monto=pg_result($consulta,0,'pag_monto');
    $nrofactura=pg_result($consulta,0,'fac_nro');
    $fuente=pg_result($consulta,0,'pag_fuente');
   
    //table header CABECERA        
    $this->SetFont('Arial','',10);
    $this->SetTitle('Precintado');
    //---------------------Encabezado Izquierda--------------------------------
    $this->text(12,45,'Lugar de Precintado:');//Titulo
    $this->text(44,45,$puesto_precintado);
    $this->text(12,50,utf8_decode('Emblema del Camión:'));
    $this->text(20,50,$emblema);
    $this->text(12,55,utf8_decode('Transportista:'));
    $this->text(20,55,$emblema);
    //---------------------Encabezado Derecha--------------------------------
    $this->text(130,45,'Fecha:');//Titulo
    $this->text(157,45,$fecha);
    $this->text(130,50,utf8_decode('Código de Camión Cisterna:'));
    $this->text(143,50,$codigo_camion);
    
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
    $this->text(10,93,'Nafta 90:');
    $this->text(10,98,'Nafta 95:');
    $this->text(50,78,'..................');
    $this->text(50,83,'..................');
    $this->text(50,88,'..................');
    $this->text(50,93,'..................');
    $this->text(50,98,'..................');
    $this->text(110,78,'Kerosene:');//Columna 3
    $this->text(110,83,'Turbo:');//Columna 3
    $this->text(110,88,'Avigas:');//Columna 3
    $this->text(110,93,'Fuel-Oil:');//Columna 3
    $this->text(150,78,'..................');
    $this->text(150,83,'..................');
    $this->text(150,88,'..................');
    $this->text(150,93,'..................');
    $this->Line(200,100,10,100);//largor,ubicacion derecha,inicio,ubicacion izquierda
    
    $this->text(10,105  ,'Precintos aplicados al camion cisterna: Cantidad:......(LETRAS)');
    
    $this->Line(160,40,10,40);//largor,ubicacion derecha,inicio,ubicacion izquierda
}
}

$pdf= new PDF();//'P'=vertical o 'L'=horizontal,'mm','A4' o 'Legal'
$pdf->AddPage();
//------------------------RECIBIMOS LOS VALORES DE POST-----------
if  (empty($_POST['txtCodigoA'])){$codPago='';}else{ $codPago = $_POST['txtCodigoA'];}
//-------------------------Damos formato al informe-----------------------------    

    
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

//------------------------QUERY and data cargue y se reciben los datos-----------
$conectate=pg_connect("host=localhost port=5432 dbname=precintos user=postgres password=postgres"
                    . "")or die ('Error al conectar a la base de datos');
$consulta=pg_exec($conectate,"");
$numregs=pg_numrows($consulta);
    if($numregs<=0)
    {
         $consulta=pg_exec($conectate,"");
    }


global $codfactura,$monto,$montoResta;
$monto=pg_result($consulta,0,'pag_monto');
$codfactura=pg_result($consulta,0,'fac_cod');
while($i<$numregs)
{   
    $descripcion=pg_result($consulta,0,'con_nom');
    $monto=pg_result($consulta,0,'pag_monto');
    $observacion=pg_result($consulta,0,'fac_obs');
    $codfactura=pg_result($consulta,0,'fac_cod');
    $pdf->Cell(100,5,$descripcion,1,0,'L',$fill);
    $pdf->Cell(60,5,number_format($monto,0,'.','.'),1,1,'C',$fill);
   
    $fill=!$fill;
    $i++;
}
 
//-------------------Restar las retenciones de la factura---------------

//-----------------------------Cuerpo derecha----------------------------------
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

//-------------------------Parte izquierda--------------------------------------
$pdf->text(10,180,'Son: ');
$pdf->text(20,180,convertirMonto((int)$montoResta));
$pdf->text(10,190,'Firma Girador: ');
$pdf->text(10,200,'Firma Director Administrativo: ');
$pdf->text(10,210,'Firma Ordenador de Gastos: ');
$pdf->text(10,220,'Recibi(mos) del Instituto Nacional de Tecnologia, Normalizacion y Metrologia la suma de Guaranies: ');
$pdf->text(10,225,convertirMonto((int)$montoResta));
$pdf->text(10,235,'Gs:');
$pdf->text(20,235,$montoResta);
$pdf->text(10,245,'Fecha:');
$pdf->text(20,245,'');
$pdf->text(10,255,'En Concepto:');
$pdf->text(30,255,'');
//----------------------------Parte derecha-------------------------------------
$pdf->text(100,235,'Firma:');
$pdf->text(100,245,'Aclaracion:');
$pdf->text(100,255,'C.I. Nro:');
//---------------------------Ultima parte---------------------------------------
$pdf->text(10,275,'Preparado Por:');
$pdf->text(70,275,'Rendicion de Cuentas:');
$pdf->text(150,275,'Contabilizado Por:');
$pdf->text(250,275,'Contabilizado Presupuesto:');
$pdf->Output("Orden Pago_".$codPago,"I");
$pdf->Close();
