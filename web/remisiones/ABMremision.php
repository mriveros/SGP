<?php
session_start();$ruta=$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT']."/web";
if(!isset($_SESSION['codigo_usuario']))
header("Location:http://$ruta/SGP/login/acceso.html");
$catego=  $_SESSION["categoria_usuario"];

?>
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SGP INTN-Lote Precintos</title>
    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
	<!-- DataTables CSS -->
    <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
    <!-- DataTables Responsive CSS -->
    <link href="../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>
	
    <!-- DataTables JavaScript -->
    <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
	    
	<!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
			responsive: true
        });
    });
    </script>
	<script type="text/javascript">
		function eliminar(codigo){
			document.getElementById("txtCodigoE").value = codigo;
		};
	</script>
</head>

<body>

    <div id="wrapper">

        <?php 
        include("../funciones.php");
        if ($catego==1){
             include("../menu.php");
        }elseif($catego==2){
             include("../menu_usuario.php");
        }elseif($catego==3){
             include("../menu_supervisor.php");
        }
       
        conexionlocal();
        ?>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                      <h1 class="page-header">Lotes - <small>SGP INTN</small></h1>
                </div>	
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Listado de Lotes de Precintos
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr class="success">
                                            <th style='display:none'>Codigo</th>
                                            <th>Lote</th>
                                            <th>Proveedor</th>
                                            <th>Color</th>
                                            <th>Cantidad</th>
                                            <th>Stock Actual</th>
                                            <th>Fecha</th>
                                            <th>Estado</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                    <?php
                    $query = "select * from remisiones rem, proveedores pro, color col where rem.pro_cod=pro.pro_cod and col.col_cod=rem.col_cod;";
                    $result = pg_query($query) or die ("Error al realizar la consulta");
                    while($row1 = pg_fetch_array($result))
                    {
                        $estado=$row1["rem_activo"];
                        if($estado=='t'){$estado='Activo';}else{$estado='Inactivo';}
                        echo "<tr><td style='display:none'>".$row1["rem_cod"]."</td>";
                        echo "<td>".$row1["rem_des"]."</td>";
                        echo "<td>".$row1["pro_razon"]."</td>";
                        echo "<td>".$row1["col_des"]."</td>";
                        echo "<td>".$row1["rem_cantidad"]."</td>";
                        echo "<td>".$row1["rem_stock_actual"]."</td>";
                        echo "<td>".$row1["rem_fecha"]."</td>";
                        echo "<td>".$estado."</td>";
                        echo "<td>";?>
                        
                       
                        <a onclick='eliminar(<?php echo $row1["rem_cod"];?>)' class="btn btn-danger btn-xs active" data-toggle="modal" data-target="#modalbor" role="button">Borrar</a>
                        <?php
                        echo "</td></tr>";
                    }
                    pg_free_result($result);
                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <a  class="btn btn-primary" data-toggle="modal" data-target="#modalagr" role="button">Nuevo</a>
                        </div>
                        <!-- /.panel-body -->
                        
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
	<!-- /#MODAL AGREGACIONES -->
	<div class="modal fade" id="modalagr" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header"><button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h3 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-floppy-disk"></i> Agregar Registro</h3>
				</div>
            
				<!-- Modal Body -->
				<div class="modal-body">
                                    <form  autocomplete="off" class="form-horizontal" name="agregarform" action="../class/ClsRemisiones.php" method="post" role="form">
						
                                        <div class="form-group">
                                            <label  class="col-sm-2 control-label" for="input01">Descripcion</label>
                                            <div class="col-sm-10">
                                            <input type="text" name="txtDescripcionA" class="form-control" id="txtDescripcionA" placeholder="ingrese descripcion"/>
                                            </div>
					</div>
                                        <div class="form-group">
                                            <label  class="col-sm-2 control-label" for="input01">Proveedor</label>
                                            <div class="col-sm-10">
                                           <select name="txtProveedorA" class="form-control" id="txtProveedorA" required="true">
                                                <?php
                                                //esto es para mostrar un select que trae datos de la BDD
                                                conexionlocal();
                                                $query = "Select pro_cod,pro_razon from proveedores where pro_activo='t' ";
                                                $resultadoSelect = pg_query($query);
                                                while ($row = pg_fetch_row($resultadoSelect)) {
                                                echo "<option value=".$row[0].">";
                                                echo $row[1];
                                                echo "</option>";
                                                }
                                                ?>
                                             </select>
                                            </div>
					</div>
                                        <div class="form-group">
                                            <label  class="col-sm-2 control-label" for="input01">Color</label>
                                            <div class="col-sm-10">
                                           <select name="txtColorA" class="form-control" id="txtColorA" required="true">
                                                <?php
                                                //esto es para mostrar un select que trae datos de la BDD
                                                conexionlocal();
                                                $query = "Select col_cod,col_des from color where col_activo='t' ";
                                                $resultadoSelect = pg_query($query);
                                                while ($row = pg_fetch_row($resultadoSelect)) {
                                                echo "<option value=".$row[0].">";
                                                echo $row[1];
                                                echo "</option>";
                                                }
                                                ?>
                                             </select>
                                            </div>
					</div>
					<div class="form-group">
                                            <label  class="col-sm-2 control-label" for="input01">Cantidad</label>
                                            <div class="col-sm-10">
                                            <input type="number" name="txtCantidadA" class="form-control" id="txtCantidadA"  />
                                            </div>
					</div>	
                                        <div class="form-group">
                                            <label  class="col-sm-2 control-label" for="input01">Nro. Inicio</label>
                                            <div class="col-sm-10">
                                            <input type="number" name="txtNroInicioA" class="form-control" id="txtNroInicioA"  />
                                            </div>
					</div>	
                                        <div class="form-group">
                                            <label  class="col-sm-2 control-label" for="input01">Nro. Fin</label>
                                            <div class="col-sm-10">
                                            <input type="number" name="txtNroFinA" class="form-control" id="txtNroFinA"  />
                                            </div>
					</div>	
				</div>
				<!-- Modal Footer -->
				<div class="modal-footer">
					<button type="reset" onclick="location.reload();" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
					<button type="submit" name="agregar" class="btn btn-primary">Guardar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	
	
	
	<!-- /#MODAL ELIMINACIONES -->
	<div class="modal fade" id="modalbor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header"><button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h3 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-trash"></i> Borrar Registro</h3>
				</div>
            
				<!-- Modal Body -->
				<div class="modal-body">
                                    <form class="form-horizontal" name="borrarform" action="../class/ClsRemisiones.php" onsubmit="return submitForm();" method="post" role="form">
						<div class="form-group">
							<input type="numeric" name="txtCodigoE" class="hide" id="txtCodigoE" />
							<div class="alert alert-danger alert-dismissable col-sm-10 col-sm-offset-1">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								¡¡¡ATENCION!!! ...Se borrara el siguiente registro..
							</div>
						</div>
				</div>
				
				<!-- Modal Footer -->
				<div class="modal-footer">
					<button type="" onclick="location.reload();" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
					<button type="submit" name="borrar" class="btn btn-danger">Borrar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
    
</html>