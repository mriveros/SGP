<?php
session_start();
if(!isset($_SESSION['codigo_usuario']))
header("Location:http://localhost/SGP/login/acceso.html");
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

    <title>SGP INTN-Precintado</title>
    <!-- Bootstrap Core CSS -->
    <link href="../../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="../../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
	<!-- DataTables CSS -->
    <link href="../../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
    <!-- DataTables Responsive CSS -->
    <link href="../../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="../../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- jQuery -->
    <script src="../../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../bower_components/metisMenu/dist/metisMenu.min.js"></script>
	
    <!-- DataTables JavaScript -->
    <script src="../../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>
	    
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
                      <h3 class="page-header">Precintado - <small>SGP INTN</small></h3>
                </div>	
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <form  autocomplete="off" class="form-horizontal" name="agregarform" action="../class/ClsPrecintados.php" method="post" role="form"> 
                    <div class="panel panel-default">
                        
                        <div class="panel-heading">
                           <div class="row">
                              
                            <div class="col-md-6">
                                         <div class="form-group">
                                            <label  class="col-sm-2 control-label" for="input01">Nro Remisión</label>
                                            <div class="col-sm-10">
                                            <input type="number" name="txtRemisionA" class="form-control" id="txtRemisionA" placeholder="ingrese número remisión" required="true"/>
                                            </div>
					</div>
                            </div>
                            <div class="col-md-6">
                                        <div class="form-group">
                                            <label  class="col-sm-2 control-label" for="input01">Emblema</label>
                                            <div class="col-sm-10">
                                           <select name="txtEmblemaA" class="form-control" id="txtEmblemaA" required="true">
                                                <?php
                                                //esto es para mostrar un select que trae datos de la BDD
                                                conexionlocal();
                                                $query = "select em_cod, em_des from emblemas where em_activo='t'";
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
                            </div>
                               
                      </div>
                      <div class="row">
                            <div class="col-md-6">
                                         
                                        <div class="form-group">
                                            <label  class="col-sm-2 control-label" for="input01">Nro Bibliorato</label>
                                            <div class="col-sm-10">
                                            <input type="number" name="txtNroBiblioratoA" class="form-control" id="txtNroBiblioratoA" placeholder="ingrese número bibliorato" required="true"/>
                                            </div>
					</div>
                            </div>
                            
                               
                            <div class="col-md-6">
                                        <div class="form-group">
                                            <label  class="col-sm-2 control-label" for="input01">Encargado</label>
                                            <div class="col-sm-10">
                                           <select name="txtEncargadoA" class="form-control" id="txtEncargadoA" required="true">
                                                <?php
                                                //esto es para mostrar un select que trae datos de la BDD
                                                conexionlocal();
                                                $query = "select en_cod, en_nom||' '||en_ape  from encargado where en_activo='t'";
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
                            </div>
                      </div>
                            <div class="row">
                            <div class="col-md-6">
                                         
                                        <div class="form-group">
                                            <label  class="col-sm-2 control-label" for="input01">Codigo Camión</label>
                                            <div class="col-sm-10">
                                            <input type="number" name="txtCodCamionA" class="form-control" id="txtCodCamionA" placeholder="ingrese código camión" required="true"/>
                                            </div>
					</div>
                            </div>
                            
                               
                            <div class="col-md-6">
                                        <div class="form-group">
                                            <label  class="col-sm-2 control-label" for="input01">Nombre Chofer</label>
                                            <div class="col-sm-10">
                                           <input type="text" name="txtTransportistaA" class="form-control" id="txtTransportistaA" placeholder="ingrese nombre transportista" required="true"/>
                                            </div>
					</div>
                                        
                            </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                            <label  class="col-sm-2 control-label" for="input01">Precintador</label>
                                            <div class="col-sm-10">
                                               
                                                <select name="txtPrecintadorA" class="form-control" id="txtPrecintadorA" required="true" >
                                                <?php
                                                //esto es para mostrar un select que trae datos de la BDD
                                                conexionlocal();
                                                $query = "select pre_cod, pre_nom||' '||pre_ape  from precintador where pre_activo='t'";
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
                                </div>
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label  class="col-sm-2 control-label" for="input01">Estación Destino</label>
                                            <div class="col-sm-10">
                                           <input type="text" name="txtDestinoA" class="form-control" id="txtDestinoA" placeholder="ingrese destino" required="true"/>
                                            </div>
					</div>
                            </div>
                      </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-heading">
                             <div class="row">
                                <div class="col-lg-12">
                                    <h4 class="page-header">Producto-Cantidad</h4>
                                </div>
                                </div>
                           <div class="row">
                                    <div class="col-md-4">

                                                <div class="form-group">
                                                    <label  class="col-sm-2 control-label" for="input01">Gasoil</label>
                                                    <div class="col-sm-10">
                                                    <input type="number" name="txtGasoilA" class="form-control" id="txtGasoilA"/>
                                                    </div>
                                                </div>
                                    </div>


                                    <div class="col-md-4">
                                                <div class="form-group">
                                                    <label  class="col-sm-2 control-label" for="input01">Alconafta </label>
                                                    <div class="col-sm-10">
                                                     <input type="number" name="txtAlconaftaA" class="form-control" id="txtAlconaftaA"/>
                                                    </div>
                                                </div>
                                    </div>
                               <div class="col-md-4">
                                                <div class="form-group">
                                                    <label  class="col-sm-2 control-label" for="input01">Nafta 85 </label>
                                                    <div class="col-sm-10">
                                                     <input type="number" name="txtNafta85" class="form-control" id="txtNafta85"/>
                                                    </div>
                                                </div>
                                    </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-4">

                                                <div class="form-group">
                                                    <label  class="col-sm-2 control-label" for="input01">Nafta 90</label>
                                                    <div class="col-sm-10">
                                                    <input type="number" name="txtNafta90A" class="form-control" id="txtNafta90A"/>
                                                    </div>
                                                </div>
                                    </div>


                                    <div class="col-md-4">
                                                <div class="form-group">
                                                    <label  class="col-sm-2 control-label" for="input01">Nafta 95 </label>
                                                    <div class="col-sm-10">
                                                     <input type="number" name="txtNafta95A" class="form-control" id="txtNafta95A"/>
                                                    </div>
                                                </div>
                                    </div>
                               <div class="col-md-4">
                                                <div class="form-group">
                                                    <label  class="col-sm-2 control-label" for="input01">Kerosene </label>
                                                    <div class="col-sm-10">
                                                     <input type="number" name="txtKerosene" class="form-control" id="txtKerosene"/>
                                                    </div>
                                                </div>
                                </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-4">

                                                <div class="form-group">
                                                    <label  class="col-sm-2 control-label" for="input01">Turbo</label>
                                                    <div class="col-sm-10">
                                                    <input type="number" name="txtTurboA" class="form-control" id="txtTurboA"/>
                                                    </div>
                                                </div>
                                    </div>


                                    <div class="col-md-4">
                                                <div class="form-group">
                                                    <label  class="col-sm-2 control-label" for="input01">Avigas </label>
                                                    <div class="col-sm-10">
                                                     <input type="number" name="txtAvigasA" class="form-control" id="txtAvigasA"/>
                                                    </div>
                                                </div>
                                    </div>
                               <div class="col-md-4">
                                                <div class="form-group">
                                                    <label  class="col-sm-2 control-label" for="input01">Fuel Oil </label>
                                                    <div class="col-sm-10">
                                                     <input type="number" name="txtFueloil" class="form-control" id="txtFueloil"/>
                                                    </div>
                                                </div>
                                </div>
                            </div>
                                <div class="row">
                                    <div class="col-md-4">

                                                <div class="form-group">
                                                    <label  class="col-sm-2 control-label" for="input01">Alcohol</label>
                                                    <div class="col-sm-10">
                                                    <input type="number" name="txtAlcoholA" class="form-control" id="txtAlcoholA"/>
                                                    </div>
                                                </div>
                                    </div>
                                </div>
                            
                                <div class="row">
                                    <div class="col-lg-12">
                                            <h4 class="page-header">Precintos</h4>
                                    </div>
                                </div>
                             <div class="row">
                                    <div class="col-md-2">

                                                <div class="form-group">
                                                     <label  class="col-sm-2 control-label" for="input01">1.</label>
                                                    <div class="col-sm-10">
                                                    <input type="number" name="txtPrecinto1" class="form-control" id="txtPrecinto1"/>
                                                    </div>
                                                </div>
                                    </div>


                                    <div class="col-md-2">
                                                <div class="form-group">
                                                     <label  class="col-sm-2 control-label" for="input01">2.</label>
                                                    <div class="col-sm-10">
                                                     <input type="number" name="txtPrecinto2" class="form-control" id="txtPrecinto2"/>
                                                    </div>
                                                </div>
                                    </div>
                               <div class="col-md-2">
                                                <div class="form-group">
                                                     <label  class="col-sm-2 control-label" for="input01">3.</label>
                                                    <div class="col-sm-10">
                                                     <input type="number" name="txtPrecinto3" class="form-control" id="txtPrecinto3"/>
                                                    </div>
                                                </div>
                                </div>
                                 <div class="col-md-2">
                                                <div class="form-group">
                                                     <label  class="col-sm-2 control-label" for="input01">4.</label>
                                                    <div class="col-sm-10">
                                                     <input type="number" name="txtPrecinto4" class="form-control" id="txtPrecinto4"/>
                                                    </div>
                                                </div>
                                </div>
                                 <div class="col-md-2">
                                                <div class="form-group">
                                                     <label  class="col-sm-2 control-label" for="input01">5.</label>
                                                    <div class="col-sm-10">
                                                     <input type="number" name="txtPrecinto5" class="form-control" id="txtPrecinto5"/>
                                                    </div>
                                                </div>
                                </div>
                                 <div class="col-md-2">
                                                <div class="form-group">
                                                     <label  class="col-sm-2 control-label" for="input01">6.</label>
                                                    <div class="col-sm-10">
                                                     <input type="number" name="txtPrecinto6" class="form-control" id="txtPrecinto6"/>
                                                    </div>
                                                </div>
                                </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-2">

                                                <div class="form-group">
                                                     <label  class="col-sm-2 control-label" for="input01">7.</label>
                                                    <div class="col-sm-10">
                                                    <input type="number" name="txtPrecinto7" class="form-control" id="txtPrecinto7"/>
                                                    </div>
                                                </div>
                                    </div>


                                    <div class="col-md-2">
                                                <div class="form-group">
                                                     <label  class="col-sm-2 control-label" for="input01">8.</label>
                                                    <div class="col-sm-10">
                                                     <input type="number" name="txtPrecinto8" class="form-control" id="txtPrecinto8"/>
                                                    </div>
                                                </div>
                                    </div>
                               <div class="col-md-2">
                                                <div class="form-group">
                                                     <label  class="col-sm-2 control-label" for="input01">9.</label>
                                                    <div class="col-sm-10">
                                                     <input type="number" name="txtPrecinto9" class="form-control" id="txtPrecinto9"/>
                                                    </div>
                                                </div>
                                </div>
                                 <div class="col-md-2">
                                                <div class="form-group">
                                                     <label  class="col-sm-2 control-label" for="input01">10.</label>
                                                    <div class="col-sm-10">
                                                     <input type="number" name="txtPrecinto10" class="form-control" id="txtPrecinto10"/>
                                                    </div>
                                                </div>
                                </div>
                                 <div class="col-md-2">
                                                <div class="form-group">
                                                     <label  class="col-sm-2 control-label" for="input01">11.</label>
                                                    <div class="col-sm-10">
                                                     <input type="number" name="txtPrecinto11" class="form-control" id="txtPrecinto11"/>
                                                    </div>
                                                </div>
                                </div>
                                 <div class="col-md-2">
                                                <div class="form-group">
                                                     <label  class="col-sm-2 control-label" for="input01">12.</label>
                                                    <div class="col-sm-10">
                                                     <input type="number" name="txtPrecinto12" class="form-control" id="txtPrecinto12"/>
                                                    </div>
                                                </div>
                                </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-2">

                                                <div class="form-group">
                                                     <label  class="col-sm-2 control-label" for="input01">13.</label>
                                                    <div class="col-sm-10">
                                                    <input type="number" name="txtPrecinto13" class="form-control" id="txtPrecinto13"/>
                                                    </div>
                                                </div>
                                    </div>


                                    <div class="col-md-2">
                                                <div class="form-group">
                                                     <label  class="col-sm-2 control-label" for="input01">14.</label>
                                                    <div class="col-sm-10">
                                                     <input type="number" name="txtPrecinto14" class="form-control" id="txtPrecinto14"/>
                                                    </div>
                                                </div>
                                    </div>
                               <div class="col-md-2">
                                                <div class="form-group">
                                                     <label  class="col-sm-2 control-label" for="input01">15.</label>
                                                    <div class="col-sm-10">
                                                     <input type="number" name="txtPrecinto15" class="form-control" id="txtPrecinto15"/>
                                                    </div>
                                                </div>
                                </div>
                                 <div class="col-md-2">
                                                <div class="form-group">
                                                     <label  class="col-sm-2 control-label" for="input01">16.</label>
                                                    <div class="col-sm-10">
                                                     <input type="number" name="txtPrecinto16" class="form-control" id="txtPrecinto16"/>
                                                    </div>
                                                </div>
                                </div>
                                 <div class="col-md-2">
                                                <div class="form-group">
                                                     <label  class="col-sm-2 control-label" for="input01">17.</label>
                                                    <div class="col-sm-10">
                                                     <input type="number" name="txtPrecinto17" class="form-control" id="txtPrecinto17"/>
                                                    </div>
                                                </div>
                                </div>
                                 <div class="col-md-2">
                                                <div class="form-group">
                                                     <label  class="col-sm-2 control-label" for="input01">18.</label>
                                                    <div class="col-sm-10">
                                                     <input type="number" name="txtPrecinto18" class="form-control" id="txtPrecinto18"/>
                                                    </div>
                                                </div>
                                </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-2">

                                                <div class="form-group">
                                                     <label  class="col-sm-2 control-label" for="input01">19.</label>
                                                    <div class="col-sm-10">
                                                    <input type="number" name="txtPrecinto19" class="form-control" id="txtPrecinto19"/>
                                                    </div>
                                                </div>
                                    </div>


                                    <div class="col-md-2">
                                                <div class="form-group">
                                                     <label  class="col-sm-2 control-label" for="input01">20.</label>
                                                    <div class="col-sm-10">
                                                     <input type="number" name="txtPrecinto20" class="form-control" id="txtPrecinto20"/>
                                                    </div>
                                                </div>
                                    </div>
                               <div class="col-md-2">
                                                <div class="form-group">
                                                     <label  class="col-sm-2 control-label" for="input01">21.</label>
                                                    <div class="col-sm-10">
                                                     <input type="number" name="txtPrecinto21" class="form-control" id="txtPrecinto21"/>
                                                    </div>
                                                </div>
                                </div>
                                 
                            </div>
                            
                            </div>
                        </div>
                       <div class="modal-footer">
                                            <button type="reset" onclick="location.reload();" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
                                            <button type="submit" name="agregar" class="btn btn-primary">Registrar</button>
                        </div>
                   </form>  
                        
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
        </div>
        <!-- /#page-wrapper -->

    </div>
   
	
	
    
</html>