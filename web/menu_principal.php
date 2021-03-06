<?php 
    $conectate=pg_connect("host=localhost port=5432 dbname=SGP user=postgres password=postgres")or die ('Error al conectar a la base de datos');
    //$consulta= pg_exec($conectate,"select sum(reg_cant)as cantidad,sum(reg_aprob) as aprobados,sum(reg_reprob)
    //as reprobados,sum(reg_claus)as clausurados from registros where reg_fecha < now()");
    //$cantidad=pg_result($consulta,0,'cantidad');
    //$aprobados=pg_result($consulta,0,'aprobados');
    //$reprobados=pg_result($consulta,0,'reprobados');
    //$clausurados=pg_result($consulta,0,'clausurados');
    $ruta=$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT']."/web";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Bootstrap Core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
     <!-- jQuery -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>
    <title>SGP INTN</title>
 
</head>

<body>
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
           
            <div class="navbar-header">
                 
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    
                    <span class="sr-only">Toggle navigation</span>
                    
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <img src="http://<?php echo $ruta;?>/SGP/web/img/head.png" width=500 height=80 alt="Obra de K. Haring"> 
            </div>
            <center><a class="navbar-brand" href="#"><h2>Sistema de Gestión de Precintado - SGP INTN</h2></a></center>
            <!-- /.navbar-header -->
            <br><br>
            <ul class="nav navbar-top-links navbar-right">
                <br> 
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Precintos Aprobados</strong>
                                        <span class="pull-right text-muted"><?php echo $aprobados;?> Precintos</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $aprobados;?>" aria-valuemin="0" aria-valuemax="<?php echo $cantidad;?>" style="width: <?php echo $aprobados;?>%">
                                            <span class="sr-only"></span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Precintos Reprobados</strong>
                                        <span class="pull-right text-muted"><?php echo $reprobados;?> Precintos</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?php echo $aprobados;?>" aria-valuemin="0" aria-valuemax="<?php echo $cantidad;?>" style="width: <?php echo $reprobados;?>%">
                                            <span class="sr-only">20% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Precintos Clausurados</strong>
                                        <span class="pull-right text-muted"><?php echo $clausurados;?> Precintos</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?php echo $aprobados;?>" aria-valuemin="0" aria-valuemax="<?php echo $cantidad;?>" style="width: <?php echo $clausurados;?>%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Cerrar</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <?php echo "USUARIO"//$_SESSION['usernom']." ".$_SESSION['userape']; ?> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> Cambiar Contraseña</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Configuracion</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="http://<?php echo $ruta;?>/SGP/web/logout.php"><i class="fa fa-sign-out fa-fw"></i> Cerrar Sesion</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
          

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="http://<?php echo $ruta;?>/SGP/web/menu_principal.php" value="Load new document" onclick="location.reload();"><i class="fa  fa-tasks"></i> Menu Principal</a>
                        </li>
			<li>
                            <a href="#"><i class="fa fa-user"></i> USUARIOS<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="http://<?php echo $ruta;?>/SGP/web/usuarios/ABMusuario.php">Registros de Usuarios</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
			<li>
                            <a href="#"><i class="fa  fa-users"></i> PROVEEDORES<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="http://<?php echo $ruta;?>/SGP/web/proveedores/ABMproveedor.php"> Registros de Proveedores</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa  fa-home "></i>  PUESTO USUARIO<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="http://<?php echo $ruta;?>/SGP/web/puesto_usuario/ABMpuesto_usuario.php">Registros de Puestos y Usuarios</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                         <li>
                            <a href="#"><i class="fa fa-minus"></i> PUESTOS DE PRECINTADO<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="http://<?php echo $ruta;?>/SGP/web/puestos/ABMpuesto.php">Registros de Puestos</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                         <li>
                            <a href="#"><i class="fa  fa-flickr "></i> EMBLEMAS<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="http://<?php echo $ruta;?>/SGP/web/emblemas/ABMemblema.php">Registros de Emblemas</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa   fa-pencil"></i> PRECINTADOR<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="http://<?php echo $ruta;?>/SGP/web/precintador/ABMprecintador.php">Registros de Precintadores</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa  fa-dollar"></i> PRECIOS PRECINTOS<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="http://<?php echo $ruta;?>/SGP/web/precios/ABMprecio.php">Registros de Precios</a>
                                </li>
                            </ul>
                        
                        </li>
                         <li>
                            <a href="#"><i class="fa  fa-cubes"></i> LOTES<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="http://<?php echo $ruta;?>/SGP/web/remisiones/ABMremision.php">Registros de Lotes</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa  fa-bank"></i> ENTREGAS<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="http://<?php echo $ruta;?>/SGP/web/entregas/ABMentrega.php">Registros de Entregas</a>
                                </li>
                                
                            </ul> 
                        </li>

                        <li>
                            <a href="#"><i class="fa  fa-hand-o-right "></i>  GENERAR PRECINTOS<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="http://<?php echo $ruta;?>/SGP/web/generar_precintos/GenerarPrecintos.php">Generar Precintos</a>
                                    <a href="http://<?php echo $ruta;?>/SGP/web/generar_precintos/ABMprecinto.php">Registro de Precintos</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa  fa-automobile "></i>  PRECINTADO<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                 
                                    <a href="http://<?php echo $ruta;?>/SGP/web/registrar_precintos/registrar_precintos.php">Precintado de Camiones</a>
                                     <a href="http://<?php echo $ruta;?>/SGP/web/registrar_precintos/anular_remision.php">Anular Remisión</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                       
                      
                        
                        <li>
                            <a href="#"><i class="fa  fa-file-text "></i> INFORMES<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="http://<?php echo $ruta;?>/SGP/web/informes/Imp_registro_impresion_matricial.php">Imprimir Registro</a>
                                    <a href="http://<?php echo $ruta;?>/SGP/web/informes/Frm_Busqueda_Precinto.php">Impresión/Búsqueda por Precinto</a>
                                    <a href="http://<?php echo $ruta;?>/SGP/web/informes/Frm_Busqueda_Remision.php">Impresión/Búsqueda por Remisión</a>
                                    <a href="http://<?php echo $ruta;?>/SGP/web/informes/Frm_Busqueda_Remision_matricial.php">Reimpresión de Remisiones</a>
                                    <a href="http://<?php echo $ruta;?>/SGP/web/informes/Frm_Resumen_Emblemas.php">Resumen por Emblemas</a> 
                                    <a href="http://<?php echo $ruta;?>/SGP/web/informes/Frm_Resumen_Puestos.php">Resumen por Puestos</a> 
                                    <a href="http://<?php echo $ruta;?>/SGP/web/informes/Frm_Resumen_Camion.php">Resumen/Búsqueda por Código Camión</a> 
                                    <a href="http://<?php echo $ruta;?>/SGP/web/informes/Frm_Resumen_Puestos_Emblemas.php">Resumen por Puestos-Emblemas</a>
                                </li>
                               
                                    
                               
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class=""></i> Help <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                
                                    <a href="">Contacte con el Programador: mriveros@intn.gov.py</a>
                              
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>   

     <div id="wrapper">
         <div id="page-wrapper">

        
            <div class="row">
                
				
                <div class="col-lg-5">
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <center> <i class="fa fa-bar-chart-o fa-fw"></i><b> Estado Precintos</b></center>
                        </div>
                        <div class="panel-body">
							<div id="donut"></div>
                           
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    
                </div>
                 <div class="col-lg-5">
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <center> <i class="fa fa-bar-chart-o fa-fw"></i><b> Estado Precintos</b></center>
                        </div>
                        <div class="panel-body">
							<div id="donut2"></div>
                           
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    
                </div>
                <!-- /.col-lg-4 -->
            </div>

        
             
    <!-- /#wrapper -->
    </div>  
    </div>
       <?php
        $query = pg_query("select count (pre_cod) from precinto where pues_cod=5 and pre_estado='Disponible'");
        $row1 = pg_fetch_array($query);
        $precintos_disponibles=$row1[0];
        $query = pg_query("select count (pre_cod) from precinto where pues_cod=5 and pre_estado='Usado'");
        $row1 = pg_fetch_array($query);
        $precintos_usados=$row1[0];
        echo "
	<script type='text/javascript'>
        $( document ).ready(function() {
	Morris.Donut({
            element: 'donut',
            data: [
              {value: ".$precintos_disponibles.", label: 'Disponibles'},
              {value: ".$precintos_usados.", label: 'Usados'},
            ],
            formatter: function (x) { return x + ''}
          }).on('click', function(i, row){
            console.log(i, row);
          });
         });        
        </script>";
        
        echo "
	<script type='text/javascript'>
        $( document ).ready(function() {
	Morris.Donut({
            element: 'donut2',
            data: [
              {value: ".$precintos_disponibles.", label: 'Disponibles'},
              {value: ".$precintos_usados.", label: 'Usados'},
            ],
            formatter: function (x) { return x + ''}
          }).on('click', function(i, row){
            console.log(i, row);
          });
         });        
        </script>";
        
        
        ?>       


    <!-- Bootstrap Core JavaScript -->
    <script language="JavaScript" type="text/javascript" src="bower_components/bootstrap/dist/js/bootstrap.js"></script>
    <!-- Morris Charts JavaScript -->
    <script language="JavaScript" type="text/javascript" src="bower_components/raphael/raphael.js"></script>
    <script language="JavaScript" type="text/javascript" src="bower_components/morrisjs/morris.js"></script>
    <link rel="stylesheet" href="bower_components/morrisjs/morris.css">  
    <script language="JavaScript" type="text/javascript" src="js/morris-data.js"></script>
</body>

</html>
